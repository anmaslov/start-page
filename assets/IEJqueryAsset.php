<?php
namespace app\assets;

use yii\web\AssetBundle;

class IEJqueryAsset extends AssetBundle
{
    public $sourcePath = null;
    public $basePath = '@webroot';
    public $baseUrl = '@web';
    public $js = [
        'js/html5shiv.min.js',
        'js/respond.min.js',
    ];
    public $jsOptions = [
        'condition' => 'lt IE 9',
        'position' => \yii\web\View::POS_HEAD,
    ];

}