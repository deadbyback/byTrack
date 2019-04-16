<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\BugReportSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Bug Reports';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="bug-report-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Create Bug Report', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'bug_id',
            'title',
            'desription:ntext',
            'playback_steps:ntext',
            'severity',
            //'priority',
            //'status',
            //'reporter_id',
            //'destination_id',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>


</div>
