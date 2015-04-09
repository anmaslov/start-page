<?php
/* @var $this yii\web\View */
use yii\helpers\ArrayHelper;
$this->title = 'Стартовая страница';
?>

<div class="row">
<?$colId = ArrayHelper::map($model, 'column', 'column');?>

<?foreach($colId as $col):?>
    <div class="col-xs-4">
        <?foreach($model as $arItem):?>
            <?if($arItem->column == $col):?>
                <div class="panel panel-<?=$arItem->state?>">
                    <div class="panel-heading">
                        <?=$arItem->block->title?>
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    </div>
                    <? $links = $arItem->block->infolink ?>
                    <?if(count($links)>0):?>
                        <div class="list-group">
                            <?foreach($links as $link):?>
                                <?if($link->status != $link::STATUS_HIDDEN):?>
                                <a <?=($link->status == $link::STATUS_DISABLE?'':"href='$link->href'")?>
                                    class="list-group-item<?=($link->status == $link::STATUS_DISABLE?' disabled':'')?>">
                                    <?if(strlen($link->icon)>0):?>
                                        <i class="glyphicon glyphicon-<?=$link->icon?>"></i>
                                    <?endif?>
                                    <?=$link->title?>
                                </a>
                                <?endif?>
                            <?endforeach?>
                        </div>
                    <?endif?>
                </div>
            <?endif?>
        <?endforeach?>
    </div>
<?endforeach?>
</div>
