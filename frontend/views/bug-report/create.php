<?php

use frontend\models\UploadForm;
use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\BugReport */
/** @var $uploadForm UploadForm */

$this->title = Yii::t('app', 'Create Bug Report');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Bug Reports'),
    'url' => ['bug-report/index', 'id' => $model->project_id]];
$this->params['breadcrumbs'][] = $this->title;
?>
<h1>Welcome,ID: <?= Yii::$app->user->id ?></h1>
<p>
    <?= Html::a(Yii::t('app', 'Go back'), Yii::$app->request->referrer, ['class' => 'btn btn-info']) ?>
</p>

<div class="bug-report-create">

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
