<?php

use common\models\User;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\BugReport */
/* @var $form yii\widgets\ActiveForm */

$users = User::find()->all();

$items = ArrayHelper::map($users, 'id', 'username');
?>

<div class="bug-report-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'title')
        ->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'description')
        ->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'playback_steps')
        ->textarea(['rows' => 6]) ?>

    <?php echo $form->field($model, 'severity')
        ->radioList([ 1 =>'Blocker', 2 => 'Critical', 3 => 'Major', 4 => 'Minor', 5 => 'Trivial',],
        ['multiple' => false]); ?>

    <?php echo $form->field($model, 'priority')
        ->radioList([1 => 'High', 2 => 'Medium', 3 => 'In Low',], ['multiple' => false]); ?>

    <?php echo $form->field($model, 'status')
        ->radioList([1 => 'Open', 2 => 'Closed', 3 => 'In progress',
        4 => 'Resolved', 5 => 'Reopened', 6 => 'In QA'], ['multiple' => false]); ?>

    <?= $form->field($model, 'reporter_id')
        ->dropDownList($items);
    ?>

    <?= $form->field($model, 'destination_id')
        ->dropDownList($items); ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Save'), ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
