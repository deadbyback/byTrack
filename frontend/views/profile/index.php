<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\DetailView;
use frontend\models\ImageUpload;

/* @var $this yii\web\View */
/* @var $searchModel common\models\UserSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

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
                'attribute' => 'role',
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
</div>
