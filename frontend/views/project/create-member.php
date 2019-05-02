<?php

use common\models\ProjectParticipants;
use yii\helpers\Html;
use yii\web\View;

/* @var $this yii\web\View */
/* @var $model common\models\ProjectParticipants */

$this->title = Yii::t('app', 'Join a member');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Project Participants'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="project-participants-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form-member', [
        'model' => $model,
    ]) ?>

</div>
