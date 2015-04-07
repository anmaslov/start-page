<?php
namespace app\assets;

use yii\web\AssetBundle;

class IEJqueryAsset extends AssetBundle
{
    public $sourcePath = null;
    public $basePath = '@webroot';
    public $baseUrl = '@web';
    public $js = [
        'js/html5shiv.js',
        'js/respond.min.js',
    ];
    public $jsOptions = [
        'condition' => 'lte IE9',
        'position' => \yii\web\View::POS_HEAD,
    ];

}