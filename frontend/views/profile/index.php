<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use yii\widgets\ListView;

/* @var $this yii\web\View */
/* @var $searchModel common\models\UserSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */
/* @var $listDataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Profile');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="profile-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <p>
        <?= Html::a(Yii::t('app', 'Update '), ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
    </p>
    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            [
                'attribute' => 'authAssignment.item_name',
                'type' => 'text',
                'label' => 'Role',
            ],
            [
                'attribute' => 'username',
                'label' => 'Nickname'
            ],
            [
                'format' => 'html',
                'label' => 'Avatar',
                'value' => function($data){
                    return Html::img($data->getImage(), ['width' => 200]);
                }
            ],
            'first_name',
            'last_name',
            [
                'attribute' => 'email',
                'label' => 'Email'
            ],
            [
                'attribute' => 'gender',
                'value' => $model->gender == 0 ? 'Male' : 'Female',
            ],
        ],
    ]) ?>
    <hr>
    <h2>Projects with your participation </h2>
    <?php echo ListView::widget([
    'dataProvider' => $listDataProvider,
    'itemView' => '_list',

    'options' => [
        'tag' => 'div',
        'class' => 'project-list',
        'id' => 'project-list',
    ],

    'layout' => "{pager}\n{summary}\n{items}\n{pager}",
    'summary' => 'Showing {count} of {totalCount} items',
    'summaryOptions' => [
        'tag' => 'span',
        'class' => 'my-summary'
    ],

    'itemOptions' => [
        'tag' => 'div',
        'class' => 'project-item',
    ],

    'emptyText' => '<p>Sorry! There are no projects with your membership</p>',
    'emptyTextOptions' => [
        'tag' => 'p'
    ],

    'pager' => [
        'firstPageLabel' => 'First',
        'lastPageLabel' => 'Last',
        'nextPageLabel' => 'Next',
        'prevPageLabel' => 'Previous',
        'maxButtonCount' => 5,
    ],
]); ?>
</div>
