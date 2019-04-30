<?php

use common\models\AuthItem;
use common\models\Project;
use common\models\User;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\ProjectParticipants */
/* @var $form yii\widgets\ActiveForm */

$projects = Project::find()->all();
$projects = ArrayHelper::map($projects, 'id', 'title');
$users = User::find()->all();
$users = ArrayHelper::map($users, 'id', 'username');
$roles = AuthItem::find()->where(['type' => 1])->all();
$roles = ArrayHelper::map($roles, 'name', 'name');

?>

<div class="project-participants-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'project_id')->dropDownList($projects) ?>

    <?= $form->field($model, 'user_id')->dropDownList($users) ?>

    <?= $form->field($model, 'user_role')->dropDownList($roles) ?>

    <?/*= $form->field($model, 'last_update')->textInput() */?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Save'), ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
