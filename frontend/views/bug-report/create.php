<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model frontend\models\BugReport */

$this->title = Yii::t('app', 'Create Bug Report');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Bug Reports'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<h1>Welcome,ID: <?= Yii::$app->user->id ?></h1>
<p>
    <?= Html::a(Yii::t('app', 'Back to all reports'), ['index'], ['class' => 'btn btn-info']) ?>
</p>

<div class="bug-report-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>
    <?php if( Yii::$app->session->hasFlash('success') ): ?>
        <div class="alert alert-success alert-dismissible" role="alert">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <?php echo Yii::$app->session->getFlash('success'); ?>
        </div>
    <?php endif;?>

</div>
