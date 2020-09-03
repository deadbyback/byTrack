<?php
use yii\bootstrap\Modal;
use kartik\widgets\DateTimePicker;
use yii\helpers\Html;

?>

<div class="row">
    <div class="col-sm-4">
        <div style="margin-top: 20px">
            <?php
            Modal::begin([
                'header' => 'Logging Work to this bug-report',
                //'toggleButton' => ['label' => 'Log Work', 'class' => 'btn btn-primary'],
            ]);
            ?>
            <div class="row" style="margin-bottom: 8px">
                <div class="col-sm-6">
                    <?=
                    DateTimePicker::widget([
                        'name' => 'date_in_modal_1',
                        'options' => ['placeholder' => 'Start time...'],
                        'pluginOptions' => ['autoclose' => true]
                    ]); ?>
                </div>
                <div class="col-sm-6">
                    <?=
                    DateTimePicker::widget([
                        'name' => 'date_in_modal_2',
                        'options' => ['placeholder' => 'End time...'],
                        'pluginOptions' => ['autoclose' => true]
                    ]); ?>
                </div>
            </div>
            <?= Html::submitButton(Yii::t('app', 'Log'), ['class' => 'btn btn-primary']) ?>
            <?php Modal::end(); ?>
        </div>
    </div>
</div>
