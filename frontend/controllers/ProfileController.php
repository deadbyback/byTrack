<?php

namespace frontend\controllers;

use common\models\ImageUpload;
use common\models\UploadForm;
use Yii;
use common\models\Profile;
use common\models\ProfileSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
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

    /**
     * Lists Profile model.
     * @return mixed
     */


    public function actionIndex()
    {
        return $this->render('index', [
            'model' => $this->findModel(),
        ]);
    }



    /**
     * Updates an existing Profile model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['profile/index', 'id' => $model->id]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }


    /**
     * Finds the Profile model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Profile the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    private function findModel()
    {
        return Profile::findOne(Yii::$app->user->identity->getId());
    }

    /*    protected function findModel($id)
        {
            if (($model = Profile::findOne($id)) !== null) {
                return $model;
            }

            throw new NotFoundHttpException(Yii::t('app', 'The requested page does not exist.'));
        }*/

    public function actionUpload()
    {
        $model = new UploadForm();

        if (Yii::$app->request->isPost) {
            if ($model->validate()) {
                $model->files = UploadedFile::getInstances($model, 'files');

                if ($model->upload()) {
                    return $this->render('uploadForm', ['model' => $model]);
                }
            }
        }
        return $this->render('uploadForm', ['model' => $model]);
    }
/*
 * (strtolower(md5(uniqid($file->baseName)) . '.' . $file->extension))
 * Получаем уникальное имя каждого файла, который был загружен на сервер
 * */
    public function actionSetImage()
    {
        $model = new ImageUpload;

        if (Yii::$app->request->isPost)
        {
            $profile = $this->findModel();
            $file = UploadedFile::getInstance($model, 'image');

            if ($profile->saveImage($model->uploadFile($file, $profile->avatar)))
            {
                return $this->redirect(['profile/index']);
            }
        }

        return $this->render('image', ['model' => $model]);
    }

}
