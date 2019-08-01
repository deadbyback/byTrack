<?php
/*
 * Загрузчик картинок с предзагрузкой
 * */
namespace common\widgets;

use Yii;
use yii\base\Widget;
use frontend\assets\WidgetAsset;

class UploadPictureWidget extends Widget
{
    public function run()
    {
        WidgetAsset::register($this->view);
        return $this->render('picupload');
    }
}