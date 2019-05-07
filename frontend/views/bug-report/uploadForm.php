<?php

use yii\web\YiiAsset;
use yii\widgets\ActiveForm;

/* @var $bug_report common\models\BugReport */

$this->title = Yii::t('app', 'Upload files to: {name}', [
    'name' => $bug_report->title,
]);
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Bug Reports'), 'url' => Yii::$app->request->referrer];
$this->params['breadcrumbs'][] = $this->title;
YiiAsset::register($this);
?>

<h1>Welcome, <?= Yii::$app->user->identity->first_name ?> (ID: <?= Yii::$app->user->id ?>)</h1>

<h4>You are uploading files to bug report №: <?= $bug_report->bug_id?></h4>
<?php $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data']]) ?>
<hr>
<?= $form->field($model, 'files[]')->fileInput(['multiple' => true]) ?>
<button>Submit</button>
<?php ActiveForm::end() ?>
