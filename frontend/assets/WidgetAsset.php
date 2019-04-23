<?php
namespace frontend\assets;
use yii\web\AssetBundle;
class WidgetAsset extends AssetBundle
{
    public $sourcePath = '@common/widgets';
    public $css = [
        'css/scrollup.css',
    ];
    public $js = [
        'js/scrollup.js',
    ];
    public $depends = [
        'yii\web\YiiAsset',
    ];
}