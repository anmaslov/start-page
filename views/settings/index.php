<?php
/* @var $this yii\web\View */
use yii\bootstrap\Tabs;

$this->title = Yii::t('app', 'SETTINGS_PERSONAL');
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
        'label' => Yii::t('app', 'REFERENCE'),
        'content' => $this->render('/reference/index'),
        'visible' => Yii::$app->user->can('admin')
    ];


echo Tabs::widget([
    'items' =>  array_merge([
        [
            'label' => Yii::t('app', 'COMMON'),
            'content' => $this->render('_common', [
                'model' => $user,
            ]),
            'active' => true,
        ],
        [
            'label' => Yii::t('app', 'SETTINGS_RESET'),
            'content' => $this->render('_reset'),
        ],
    ], $item),
    'options' => ['tag' => 'div'],
    'itemOptions' => ['tag' => 'div'],
    'headerOptions' => ['class' => 'my-class'],
    'clientOptions' => ['collapsible' => false],
]);
?>