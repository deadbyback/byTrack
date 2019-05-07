<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\ProjectParticipants */

$this->title = Yii::t('app', 'Update Member: {name}', [
    'name' => $model->id,
]);
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Project Participants'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view-member', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Update');
?>
<div class="project-participants-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form-member', [
        'model' => $model,
    ]) ?>

</div>