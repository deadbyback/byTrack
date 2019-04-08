<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model frontend\models\BugReport */

$this->title = Yii::t('app', 'Create Bug Report');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Bug Reports'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="bug-report-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
