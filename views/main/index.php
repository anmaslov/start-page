<?php
/* @var $this yii\web\View */

use yii\bootstrap\Tabs;

$this->title = 'Стартовая страница';
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

<?
echo Tabs::widget([
    'items' => array_merge([
        [
            'label' => 'Основные',
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

