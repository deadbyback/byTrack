<?php

use common\models\User;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use common\models\File;
use frontend\models\UploadForm;

/* @var $this yii\web\View */
/* @var $model common\models\BugReport */
/* @var $uploadForm UploadForm */
/* @var $files File*/


$users = User::find()->all();
$items = ArrayHelper::map($users, 'id', 'username');
?>

<div class="modal-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'reporter_id')->dropDownList([$model->reporter_id => $model->reporter_id, Yii::$app->user->id => Yii::$app->user->id]) ?>

    <?= $form->field($model, 'destination_id')
        ->dropDownList($items); ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Send'), ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
