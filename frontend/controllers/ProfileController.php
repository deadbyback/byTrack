<?php

namespace frontend\controllers;

use common\models\Project;
use frontend\models\ImageUpload;
use Yii;
use common\models\User;
use yii\data\ActiveDataProvider;
use yii\web\Controller;
use yii\filters\VerbFilter;
use yii\web\UploadedFile;

/**
 * ProfileController implements the CRUD actions for Profile model.
 */
class ProfileController extends Controller
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
        ];
    }

    public function actionIndex()
    {
        $id = Yii::$app->user->id;
        $dataProvider = new ActiveDataProvider([
            'query' => Project::find()
                ->innerJoin('{{project_participants}}', '{{project_participants}}.[[project_id]] = {{project}}.[[id]]' )
                ->andWhere('{{project_participants}}.[[user_id]] = :id', [':id' => $id]),
            'pagination' => [
                'pageSize' => 3,
            ],
        ]);

        return $this->render('index', [
            'model' => $this->findModel(),
            'listDataProvider' => $dataProvider,
        ]);
    }

    /**
     * Updates an existing Profile model.
     * If update is successful, the browser will be redirected to the 'index' page.
     * @return mixed
     */
    public function actionUpdate()
    {
        $image = new ImageUpload;
        $model = $this->findModel();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            $profile = $this->findModel();
            $file = UploadedFile::getInstance($image, 'image');
            if ($profile->saveImage($image->uploadFile($file, $profile->avatar))) {
                return $this->redirect(['profile/index', 'id' => $model->id]);
            }
        }
        return $this->render('update', [
            'model' => $model,
            'image' => $image
        ]);
    }

    /**
     * Finds the Profile model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @return User the loaded model

     */
    private function findModel()
    {
        return User::findOne(Yii::$app->user->identity->getId());
    }
}
