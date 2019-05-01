<?php

use frontend\models\UploadForm;
use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\BugReport */
/* @var $uploadForm UploadForm*/

$this->title = Yii::t('app', 'Update Bug Report: {name}', [
    'name' => $model->title,
]);
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Bug Reports'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->title, 'url' => ['view', 'id' => $model->bug_id]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Update');
?>
<h1>Welcome,ID: <?= Yii::$app->user->id ?></h1>
<p>
    <?= Html::a(Yii::t('app', 'Back to all reports'), 'javascript:history.back()', ['class' => 'btn btn-info']) ?>
</p>
<div class="bug-report-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?=
    $this->render('_form', [
        'model' => $model,
        'uploadForm' => $uploadForm,
    ]) ?>
    <?php if( Yii::$app->session->hasFlash('success') ): ?>
        <div class="alert alert-success alert-dismissible" role="alert">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <?php echo Yii::$app->session->getFlash('success'); ?>
        </div>
    <?php endif;?>
</div>
