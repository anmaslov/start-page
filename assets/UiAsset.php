<?php

namespace app\assets;

use yii\web\AssetBundle;

class UiAsset extends AssetBundle
{
    public $sourcePath = '@bower/jquery-ui';
    public $js = [
        'jquery-ui.min.js'
    ];
    public $depends = [
        'yii\web\JqueryAsset',
    ];
}