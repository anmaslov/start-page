<?php
/* @var $this yii\web\View */

use yii\bootstrap\Tabs;
use app\assets\UserAsset;

UserAsset::register($this);
$this->title = Yii::t('app', 'APP_NAME');
?>

<?
    //Генерируем массив табов
    $items = [];
    foreach($blocks as $block)
    {
        $items[] = [
            'label' => $block->title,
            'content' => $this->render('_tabs', [
                'model' => $block
            ]),
        ];
    }
?>

    <?=$this->render('_message', [
        'messages' => $messages
    ]);?>

    <?=$this->render('_subtext', [
        'link' => $link
    ]);?>

<?
echo Tabs::widget([
    'items' => array_merge([
        [
            'label' => Yii::t('app', 'COMMON'),
            'content' => $this->render('_block', [
                'model' => $model,
            ]),
            'active' => true,
        ]
    ],
        $items
    ),
    'options' => ['tag' => 'div'],
    'navType' => 'nav-pills',
    'itemOptions' => ['tag' => 'div'],
    'headerOptions' => ['class' => 'my-class'],
    'clientOptions' => ['collapsible' => false],
]);
?>

