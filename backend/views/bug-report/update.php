<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\BugReport */

$this->title = 'Update Bug Report: ' . $model->title;
$this->params['breadcrumbs'][] = ['label' => 'Bug Reports', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->title, 'url' => ['view', 'id' => $model->bug_id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="bug-report-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
