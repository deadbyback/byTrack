<?php

namespace frontend\controllers;

use common\models\ReportFile;
use common\models\UploadForm;
use Yii;
use common\models\BugReport;
use common\models\BugReportSearch;
use yii\data\ActiveDataProvider;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\AccessControl;
use yii\filters\VerbFilter;
use yii\behaviors\BlameableBehavior;
use yii\web\UploadedFile;

/**
 * BugReportController implements the CRUD actions for BugReport model.
 */
class BugReportController extends Controller
{
    /**
     * {@inheritdoc}
     */

    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
            [
                'class' => BlameableBehavior::className(),
                'createdByAttribute' => 'reporter_id',
            ],
            'access' => [
                'class' => AccessControl::classname(),
                'rules' => [
                    [
                        'allow' => true,
                        'actions' => ['index', 'view'],
                        'roles' => ['@'],
                    ],
                    [
                        'allow' => true,
                        'actions' => ['find', 'to-me', 'create', 'update', 'index', 'view', 'upload'],
                        'roles' => ['worker', 'admin', 'manager'],
                    ],
                    [
                        'allow' => true,
                        'actions' => ['delete'],
                        'roles' => ['admin'],
                    ],
                    [
                      'allow' => false,
                    ],
                ]
            ]
        ];
    }

    /**
     * Lists all BugReport models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new BugReportSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single BugReport model.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new BugReport model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new BugReport();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            /*$form = Yii::$app->request->post();
            $model->reporter_id= Yii::$app->user->getId();*/
            Yii::$app->session->setFlash('success', 'Yeah! It is! Bug №' .  $model->bug_id . ' was added successfully!');
            return $this->redirect(['view', 'id' => $model->bug_id]);
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing BugReport model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            Yii::$app->session->setFlash('success', 'Yeah! It is! Bug №' .  $model->bug_id . ' was updated successfully!');
            return $this->redirect(['view', 'id' => $model->bug_id]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing BugReport model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the BugReport model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return BugReport the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = BugReport::findOne($id)) !== null) {
            return $model;
        }
        throw new NotFoundHttpException(Yii::t('app', 'The requested page does not exist.'));
    }

    public function actionFind()
    {
        $id = Yii::$app->user->id;
        $query = BugReport::find()->where('reporter_id=:id', [':id' => $id]);
        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'pagination' => ['pageSize' => 15],
        ]);
        $searchModel = new BugReportSearch();
        return $this->render('find', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }


    public function actionToMe()
    {
        $id = Yii::$app->user->id;
        $query = BugReport::find()->where('destination_id=:id', [':id' => $id]);
        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'pagination' => ['pageSize' => 15],
        ]);
        $searchModel = new BugReportSearch();
        return $this->render('toMe', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    public function actionWhat()
    {
        $model = new UploadForm();

        if ($model->load(Yii::$app->request->post())) {
            $model->imageFile = UploadedFile::getInstance($model, 'imageFile');
            if ($this->validate()) {
                if ($model->imageFile && $model->upload()) {
                    $model->image = $this->imageFile->baseName . '.' . $this->imageFile->extension;
                }
                if ($this->save()) {
                    return $this->redirect(['view', 'id' => $model->id]);
                }
            }
        }
    }

    public function actionUpload($id)
    {
        $model = new UploadForm();
        $tmodel = $this->findModel($id);
        if (Yii::$app->request->isPost) {
            if ($model->validate()) {
                $model->files = UploadedFile::getInstances($model, 'files');

                if ($model->upload($tmodel->bug_id)) {
                    return $this->redirect(['index']);
                }
            }
        }
        return $this->render('uploadForm', ['model' => $model]);
    }
}
