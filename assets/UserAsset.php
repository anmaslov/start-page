<?php
namespace app\assets;

use yii\web\AssetBundle;

class UserAsset extends AssetBundle
{
    public $sourcePath = null;
    public $basePath = '@webroot';
    public $baseUrl = '@web';
    public $js = [
        'js/user.js',
    ];

    public $depends = [
        'app\assets\UiAsset',
        'app\assets\jGrowlAsset',
    ];
}