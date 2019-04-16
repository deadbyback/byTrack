<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\BugReportSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="bug-report-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'bug_id') ?>

    <?= $form->field($model, 'title') ?>

    <?= $form->field($model, 'desription') ?>

    <?= $form->field($model, 'playback_steps') ?>

    <?= $form->field($model, 'severity') ?>

    <?php // echo $form->field($model, 'priority') ?>

    <?php // echo $form->field($model, 'status') ?>

    <?php // echo $form->field($model, 'reporter_id') ?>

    <?php // echo $form->field($model, 'destination_id') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-outline-secondary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
