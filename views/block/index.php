<?php
/* @var $this yii\web\View */
use yii\helpers\Html;

$this->title = 'Список блоков по умолчанию';
$colId = array(1, 2, 3);
?>
<h3><?=$this->title?></h3>
<?if($msg = \Yii::$app->session->getFlash('success')):?>
    <div class="alert alert-success">
        <?=\Yii::$app->session->getFlash('success')?>
    </div>
<?endif?>

<div class="row">
    <?foreach($colId as $col):?>
        <?if(count($colId)<3 && $col==2):?>
            <div class="column col-xs-4" id="column1"></div>
        <?endif?>
        <div class="column col-xs-4" id="column<?=$col?>">
            <?foreach($model as $arItem):?>
                <?if($arItem->column == $col):?>
                <div class="panel panel-<?=$arItem->state?>" id="item<?=$arItem->id?>">
                    <div class="panel-heading">
                        <?= Html::a($arItem->title, ['update', 'id'=>$arItem->id]) ?>
                    </div>
                    <?if(count($arItem->links)>0):?>
                        <div class="list-group">
                            <?foreach($arItem->links as $link):?>
                                <?= Html::a($link->title,
                                    ['/link/update', 'id'=>$link->id],
                                    ['class' => 'list-group-item' . ($link->status == $link::STATUS_DISABLE?' disabled':'')])?>
                            <?endforeach?>
                        </div>
                    <?endif?>
                </div>
                <?endif?>
            <?endforeach?>
        </div>
    <?endforeach?>
</div>


<?= Html::a('Добавить блок', ['create'], ['class' => 'btn btn-success']) ?>

<?= Html::a('Добавить ссылку', ['/link/create'], ['class' => 'btn btn-info']) ?>

