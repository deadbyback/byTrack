<?php

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
    <h1><?= Html::encode( 'Admin\'s power!')  ?></h1>
    <p>
        <?= Html::a(Yii::t('app', 'Create Project'), ['create'], ['class' => 'btn btn-success']) ?>
        <?= Html::a(Yii::t('app', 'Join a member'), ['create-member'], ['class' => 'btn btn-success']) ?>
    </p>
    <?php endif; ?>

    <?php
    if (Yii::$app->user->can('admin'))
    {
        $projectTemplate = '{view} {update} {delete} {report}';
        $memberTemplate = '{view} {update} {delete}';
    } elseif (Yii::$app->user->can('manager'))
    {
        $projectTemplate = '{update} {report}';
        $memberTemplate = '{update}';
    } else {
        $projectTemplate = '{report}';
        $memberTemplate = '';
    }
    ?>

     <div class="card" style="max-width: 49%; float: left">
    <h1><?= Html::encode(Yii::t('app', 'Projects with your participation')) ?></h1>
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
                      },
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
            ],
            [
                'attribute' => 'user_id',
                'value' => 'user.username',
                'label' => 'User',
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
                'buttons' =>
                    [
                        'view' => function ($url, $model, $key)
                        {
                            return Html::a('<span class="glyphicon glyphicon-cog"></span>', ['project/view-member', 'id' => $model->id], [
                                'title' => Yii::t('app', 'View this membership'),
                            ]);
                        },
                        'update' => function ($url, $model, $key)
                        {
                            return Html::a('<span class="glyphicon glyphicon-pencil"></span>', ['project/update-member', 'id' => $model->id], [
                                'title' => Yii::t('app', 'Update this membership'),
                            ]);
                        },
                        'delete' => function ($url, $model) {
                            return Html::a('<span class="glyphicon glyphicon-trash"></span>', ['project/delete-member', 'id' => $model->id], [
                                'title' => Yii::t('app', 'Delete this membership'),
                            ]);
                        }
                    ],
            ],
        ],

    ]); ?>

    </div>
</div>