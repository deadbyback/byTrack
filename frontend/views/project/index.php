<?php

use common\models\Project;
use common\models\User;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $projectSearchModel common\models\ProjectSearch */
/* @var $memberSearchModel common\models\ProjectParticipantsSearch */
/* @var $projectDataProvider yii\data\ActiveDataProvider */
/* @var $memberDataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Projects');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="project-index">

    <?php if (Yii::$app->user->can('admin')): ?>
    <h1><?= Html::encode( 'Addons for Admin')  ?></h1>
    <p>
        <?= Html::a(Yii::t('app', 'Create Project'), ['create'], ['class' => 'btn btn-success']) ?>
        <?= Html::a(Yii::t('app', 'Join a member'), ['create-member'], ['class' => 'btn btn-success']) ?>
    </p>
    <?php endif; ?>

    <?php
    if (Yii::$app->user->can('admin'))
    {
        $projectTemplate = '{view} {update} {delete} {report} {members}';
        $memberTemplate = '{view} {update} {delete}';
    } elseif (Yii::$app->user->can('manager'))
    {
        $projectTemplate = '{update} {report} {members}';
        $memberTemplate = '{update}';
    } else {
        $projectTemplate = '{report} {members}';
        $memberTemplate = '';
    }
    ?>

     <div class="card" style="max-width: 49%; float: left">
    <h1><?= Html::encode(Yii::t('app', 'Projects')) ?></h1>
    <?= GridView::widget([
        'dataProvider' => $projectDataProvider,
        'filterModel' => $projectSearchModel,
        'tableOptions' => [
            'class' => 'table table-bordered table-striped',
        ],
        'columns' => [
            [
                'class' => 'yii\grid\ActionColumn',
                'template' => $projectTemplate,
                'buttons' =>
                    [
                      'report' => function ($url, $model, $key)
                      {
                        return Html::a('<span class="glyphicon glyphicon-menu-right"></span>', ['bug-report/index', 'id' => $model->id], [
                          'title' => Yii::t('app', 'Go to reports'), 'class' =>'btn btn-xs',
                        ]);
                      }
                    ],
            ],
            ['class' => 'yii\grid\SerialColumn'],
            'title',
            'description',
        ],
    ]); ?>
    </div>

    <div class="card" style="max-width: 49%; float: right">
        <h1><?= Html::encode(Yii::t('app', 'Projects Members')) ?></h1>
        <?= GridView::widget([
        'dataProvider' => $memberDataProvider,
        'filterModel' => $memberSearchModel,
        'tableOptions' => [
            'class' => 'table table-bordered',
        ],
        'columns' => [
            [
                'attribute' => 'project_id',
                'value' => 'project.title',
                'label' => 'Project',
                //'filter' => ArrayHelper::map(Project::find()->asArray()->all(), 'id', 'title'),
            ],
            [
                'attribute' => 'user_id',
                'value' => 'user.username',
                'label' => 'User',
                //'filter' => ArrayHelper::map(User::find()->asArray()->all(), 'id', 'username'),
                'contentOptions' => function ($model, $key, $index, $grid) {
                    if ($model->user_id == Yii::$app->user->id) {$rv = 'success';}
                    else {$rv = '';}
                    return ['class' => $rv];
                }
            ],
            'user_role',
            [
                'class' => 'yii\grid\ActionColumn',
                'template' => $memberTemplate,
            ],
        ],

    ]); ?>

    </div>
</div>