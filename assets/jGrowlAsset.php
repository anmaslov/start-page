<?php

namespace app\assets;

use yii\web\AssetBundle;

/**
 * @author Qiang Xue <qiang.xue@gmail.com>
 * @since 2.0
 */
class jGrowlAsset extends AssetBundle
{
    public $sourcePath = '@bower/jgrowl';
    public $css = [
        'jquery.jgrowl.min.css'
    ];
    public $js = [
        'jquery.jgrowl.min.js'
    ];
    public $depends = [
        'app\assets\IEJqueryAsset',
        'yii\web\YiiAsset',
    ];
}