<?php

namespace frontend\controllers;

use common\models\File;
use frontend\models\UploadForm;
use frontend\models\CommentForm;
use Yii;
use common\models\BugReport;
use common\models\BugReportSearch;
use common\models\Comment;
use yii\data\ActiveDataProvider;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\AccessControl;
use yii\filters\VerbFilter;
use yii\behaviors\BlameableBehavior;
use yii\web\UploadedFile;

/**
 * BugReportController implements the CRUD actions for BugReport model.
 * @property mixed filename
 * @property mixed bug_id
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
                        'actions' => ['find', 'to-me', 'create', 'update', 'index', 'view', 'upload', 'download',
                            'resolve', 'reopen', 'in-q-a', 'close', 'in-progress', 'log-work', 'comment'],
                        'roles' => ['worker', 'admin', 'manager'],
                    ],
                    [
                        'allow' => true,
                        'actions' => ['delete', 'delete-file'],
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
     * @param $id
     * @return mixed
     */
    public function actionIndex($id)
    {
        $searchModel = new BugReportSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams, $id);

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
        $query = File::find()
            ->innerJoin('{{file_in_report}}', '{{file_in_report}}.[[file_id]] = {{file}}.[[id]]' )
            ->andWhere('{{file_in_report}}.[[bug_id]] = :bug_id', [':bug_id' => $id]);
        

        $comments = $this->findModel($id)->comments;
        $commentForm = new CommentForm();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'pagination' => ['pageSize' => 5],
        ]);

        return $this->render('view', [
            'model' => $this->findModel($id),
            'dataProvider' => $dataProvider,
            'comments' => $comments,
            'commentForm' => $commentForm,
        ]);
    }
    /**
     * @param $id
     * @return \yii\web\Response
     * @throws NotFoundHttpException
     * @throws \yii\db\Exception
     */
    public function actionResolve($id)
    {
        $model = BugReport::findOne($id);
        if  (!(Yii::$app->user->id == $model->reporter_id || Yii::$app->user->id == $model->destination_id))
        {
            Yii::$app->session->setFlash('danger', 'You have not permissions to change "' . $model->title . '"\' status!');
            return $this->redirect(['view', 'id' => $model->bug_id]);
        }
        $transaction = Yii::$app->getDb()->beginTransaction();
        try {
            $model->status = 4;

            $model->save();
            if ($model->save())
            {
                $transaction->commit();
            } else {
                $transaction->rollBack();
            }
        } catch (Exception $e) {
            $transaction->rollBack();
        }

        return $this->redirect(['view', 'id' => $model->bug_id]);
    }
    public function actionClose($id)
    {
        $model = BugReport::findOne($id);
        if  (!(Yii::$app->user->id == $model->reporter_id || Yii::$app->user->id == $model->destination_id))
        {
            Yii::$app->session->setFlash('danger', 'You have not permissions to change "' . $model->title . '"\' status!');
            return $this->redirect(['view', 'id' => $model->bug_id]);
        }
        $transaction = Yii::$app->getDb()->beginTransaction();
        try {
            $model->status = 2;

            $model->save();
            if ($model->save())
            {
                $transaction->commit();
            } else {
                $transaction->rollBack();
            }
        } catch (Exception $e) {
            $transaction->rollBack();
        }

        return $this->redirect(['view', 'id' => $model->bug_id]);
    }
    public function actionInProgress($id)
    {
        $model = BugReport::findOne($id);
        if  (!(Yii::$app->user->id == $model->reporter_id || Yii::$app->user->id == $model->destination_id))
        {
            Yii::$app->session->setFlash('danger', 'You have not permissions to change "' . $model->title . '"\' status!');
            return $this->redirect(['view', 'id' => $model->bug_id]);
        }
        $transaction = Yii::$app->getDb()->beginTransaction();
        try {
            $model->status = 3;

            $model->save();
            if ($model->save())
            {
                $transaction->commit();
            } else {
                $transaction->rollBack();
            }
        } catch (Exception $e) {
            $transaction->rollBack();
        }

        return $this->redirect(['view', 'id' => $model->bug_id]);
    }
    public function actionReopen($id)
    {
        $model = BugReport::findOne($id);
        if  (!(Yii::$app->user->id == $model->reporter_id || Yii::$app->user->id == $model->destination_id))
        {
            Yii::$app->session->setFlash('danger', 'You have not permissions to change "' . $model->title . '"\' status!');
            return $this->redirect(['view', 'id' => $model->bug_id]);
        }
        $transaction = Yii::$app->getDb()->beginTransaction();
        try {
            $model->status = 5;

            $model->save();
            if ($model->save())
            {
                $transaction->commit();
            } else {
                $transaction->rollBack();
            }
        } catch (Exception $e) {
            $transaction->rollBack();
        }

        return $this->redirect(['view', 'id' => $model->bug_id]);
    }
    public function actionInQA($id)
    {
        $model = BugReport::findOne($id);
        if  (!(Yii::$app->user->id == $model->reporter_id || Yii::$app->user->id == $model->destination_id))
        {
            Yii::$app->session->setFlash('danger', 'You have not permissions to change "' . $model->title . '"\' status!');
            return $this->redirect(['view', 'id' => $model->bug_id]);
        }
        $transaction = Yii::$app->getDb()->beginTransaction();
        try {
            $model->status = 6;

            $model->save();
            if ($model->save())
            {
                $transaction->commit();
            } else {
                $transaction->rollBack();
            }
        } catch (Exception $e) {
            $transaction->rollBack();
        }

        return $this->redirect(['view', 'id' => $model->bug_id]);
    }

    /**
     * Creates a new BugReport model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new BugReport();
        $uploadForm = new UploadForm();
        $model->reporter_id = Yii::$app->user->id;
        $model->status = '1';

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            Yii::$app->session->setFlash('success', 'Yeah! It is! Bug №' . $model->bug_id . ' was added successfully!');
            return $this->redirect(['bug-report/index', 'id' => $model->project_id]);
        }

        return $this->render('create', [
            'model' => $model,
            'uploadForm' => $uploadForm,
        ]);
    }

    /**
     * Updates an existing BugReport model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     * @throws \Throwable
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        $bug_report = $this->findModel($id);
        $uploadForm = new UploadForm();

        if (Yii::$app->request->isPost && $uploadForm->validate())
        {
            $uploadForm->files = UploadedFile::getInstances($uploadForm, 'files');
            if ($uploadForm->upload($bug_report->bug_id))
            {
                if ($model->load(Yii::$app->request->post()) && $model->save())
                {
                    Yii::$app->session->setFlash('success', 'Yeah! It is! Bug №' . $model->bug_id . ' was updated successfully!');
                    return $this->redirect(['bug-report/view', 'id' => $model->bug_id]);
                }
            }
        }
        return $this->render('update', [
            'model' => $model,
            'uploadForm' => $uploadForm,
        ]);
    }

    /**
     * Deletes an existing BugReport model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     * @throws \Throwable
     * @throws \yii\db\StaleObjectException
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(Yii::$app->request->referrer ?: Yii::$app->homeUrl);
    }

    /**
     * @param $id
     * @return \yii\web\Response
     * @throws NotFoundHttpException
     * @throws \Throwable
     * @throws \yii\db\StaleObjectException
     */
    public function actionDeleteFile($id)
    {
        $this->findFile($id)->delete();

        return $this->redirect(Yii::$app->request->referrer ?: Yii::$app->homeUrl);
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

    /**
     * @param $id
     * @return File|null
     * @throws NotFoundHttpException
     */
    protected function findFile($id)
    {
        if (($model = File::findOne($id)) !== null) {
            return $model;
        }
        throw new NotFoundHttpException(Yii::t('app', 'The requested page does not exist.'));
    }

    protected function findComment($id)
    {
        if (($model = Comment::findOne($id)) !== null) {
            return $model;
        }
        throw new NotFoundHttpException(Yii::t('app', 'The requested page does not exist.'));
    }

    protected function findAllCommentsOfReport($id)
    {
        if (($model = Comment::findAll($id)) !== null) {
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


    /**
     * @param $id
     * @return string|\yii\web\Response
     * @throws NotFoundHttpException
     * @throws \Throwable
     */
    public function actionUpload($id)
    {
        $model = new UploadForm();
        $bug_report = $this->findModel($id);

        if (Yii::$app->request->isPost && $model->validate())
        {
                $model->files = UploadedFile::getInstances($model, 'files');
                if ($model->upload($bug_report->bug_id)) {
                    return $this->redirect('view?id=' . $bug_report->bug_id);
                }
        }
        return $this->render('uploadForm', [
            'model' => $model,
            'bug_report' => $bug_report,
        ]);
    }

    /**
     * @param $id
     * @return \yii\console\Response|\yii\web\Response
     * @throws NotFoundHttpException
     */
    public function actionDownload($id)
    {
        ini_set('max_execution_time', 5 * 60);
        $model = File::findOne($id);
        $filename = $model->filename;
        $path = Yii::getAlias('@web') . '/files';
        $file = $path . '/' . $model->filepath;

        if (file_exists($file)) {
            return Yii::$app->response->sendFile($file);
        } else {
            throw new NotFoundHttpException("Сan't find {$file->filename} file");
        }
    }
    /*TODO: Доделать переадресацию репорта*/
    public function actionResend($id, $sender, $recipient)
    {
        $model = $this->findModel($id);

        $transaction = Yii::$app->getDb()->beginTransaction();
        try {
            $model->reporter_id = $sender;
            $model->destination_id = $recipient;
            $model->save();
            if ($model->save())
            {
                $transaction->commit();
            } else {
                $transaction->rollBack();
            }
        } catch (Exception $e) {
            $transaction->rollBack();
        }

        return $this->redirect(['view', 'id' => $model->bug_id]);
    }
    /*TODO: Реализовать логику логирования*/
    public function actionLogWork()
    {
        return $this->render('logWork');
    }

    public function actionComment($id)
    {
/*         $bug_report = $this->findModel($id);
        $comments = $this->findAllCommentsOfReport($id);
        $author = Yii::$app->user->identity->id;
        var_dump($comments); die; */

        $model = new CommentForm();
            
        if(Yii::$app->request->isPost)
        {
            $model->load(Yii::$app->request->post());
            if($model->saveComment($id))
            {
                Yii::$app->getSession()->setFlash('comment', 'Done!');
                return $this->redirect(['view', 'id' => $model->bug_id]);
            }
        }
    }

}
