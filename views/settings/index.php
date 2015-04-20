<?php
/* @var $this yii\web\View */
use yii\helpers\Html;

$this->title = 'Настройки';
?>

<?if($msg = \Yii::$app->session->getFlash('success')):?>
    <div class="alert alert-success">
        <?=\Yii::$app->session->getFlash('success')?>
    </div>
<?endif?>

<h3><?=$this->title?></h3>
<!--<p>Здесь можно сбросить настройки по умолчанию</p>-->
<div class="row">
    <div class="col-md-3">
        <?= Html::a('Сброс настроек', ['reset'],
            ['class' => 'btn btn-danger',
                'data-confirm' => 'Вы действительно хотите сбросить настройки?',
                'data-method' => 'post']) ?>
    </div>
</div>
