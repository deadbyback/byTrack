<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model frontend\models\BugReport */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="bug-report-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'title')
        ->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'desription')
        ->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'playback_steps')
        ->textarea(['rows' => 6]) ?>

    <?php echo $form->field($model, 'severity')
        ->radioList([ 'Blocker',  'Critical', 'Major',  'Minor', 'Trivial',],
        ['multiple' => false]); ?>

    <?php echo $form->field($model, 'priority')
        ->radioList(['1' => 'High', '2' => 'Medium', '3' => 'In Low',], ['multiple' => false]); ?>

    <?php echo $form->field($model, 'status')
        ->radioList(['1' => 'Open', '2' => 'Closed', '3' => 'In progress',
        '4' => 'Resolved', '5' => 'Reopened', '6' => 'In QA'], ['multiple' => false]); ?>

    <?= $form->field($model, 'reporter_id')
        ->textInput() ?>

    <?= $form->field($model, 'destination_id')
        ->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Save'), ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
