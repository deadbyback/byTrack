<?php

namespace app\common\widgets;

use yii\base\Widget;
use yii\helpers\Html;
use Yii;

class BackUrl extends Widget
{
    public $url;
    public function init()
    {
        parent::init();
        if ($this->url === null) {
            if (Yii::$app->request->referrer){
                $this->url = Yii::$app->request->referrer;
            } else {
                $this->url = ['index'];
            }
        }
    }
    public function run()
    {
        return Html::tag('div', Html::a('<i class="fa fa-chevron-left"></i> <----', $this->url),['class'=>'back-url']);
    }
}