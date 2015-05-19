<?php

namespace app\assets;

use yii\web\AssetBundle;

class AutocompleteAsset extends AssetBundle
{
    public $sourcePath = '@bower/devbridge-autocomplete';
    public $js = [
        'dist/jquery.autocomplete.min.js'
    ];
    public $depends = [
        'yii\web\JqueryAsset',
    ];
}