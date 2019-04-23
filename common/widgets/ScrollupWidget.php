<?php
/*
 * Кнопка вверх
 */
namespace common\widgets;
use Yii;
use yii\base\Widget;
use frontend\assets\WidgetAsset;
class ScrollupWidget extends Widget {
    public function run() {
        //Подключаем свой файл Asset
        WidgetAsset::register($this->view);
        return $this->render('scrollup',[
        ]);
    }
}