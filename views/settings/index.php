<?php
/* @var $this yii\web\View */
use yii\bootstrap\Tabs;

$this->title = 'Персональные настройки';
?>

<?if($msg = \Yii::$app->session->getFlash('success')):?>
    <div class="alert alert-success">
        <?=\Yii::$app->session->getFlash('success')?>
    </div>
<?endif?>

<h3><?=$this->title?></h3>
<!--<p>Здесь можно сбросить настройки по умолчанию</p>-->

<?

$item = [];

if (Yii::$app->user->can('admin'))
    $item[] = [
        'label' => 'Справочники',
        'content' => $this->render('/reference/index'),
        'visible' => Yii::$app->user->can('admin')
    ];


echo Tabs::widget([
    'items' =>  array_merge([
        [
            'label' => 'Основные',
            'content' => $this->render('_common', [
                'model' => $user,
            ]),
            'active' => true,
        ],
        [
            'label' => 'Сброс настроек',
            'content' => $this->render('_reset'),
        ],
    ], $item),
    'options' => ['tag' => 'div'],
    'itemOptions' => ['tag' => 'div'],
    'headerOptions' => ['class' => 'my-class'],
    'clientOptions' => ['collapsible' => false],
]);
?>