<?php
/* @var $this yii\web\View */

use yii\helpers\Url;
use app\assets\UserAsset;
use yii\bootstrap\Tabs;

UserAsset::register($this);
$this->title = 'Стартовая страница';
?>

<?
echo Tabs::widget([
    'items' => [
        [
            'label' => 'Основные',
            'content' => $this->render('_block', [
                'model' => $model,
            ]),
            'active' => true,
        ],
        [
            'label' => 'Ресурсы интернет',
            'content' => $this->render('_internet'),
        ],
    ],
    'options' => ['tag' => 'div'],
    'itemOptions' => ['tag' => 'div'],
    'headerOptions' => ['class' => 'my-class'],
    'clientOptions' => ['collapsible' => false],
]);
?>


<div class="row block">
<?$colId = array(1, 2, 3);?>

<?foreach($colId as $col):?>
    <?if(count($colId)<3 && $col==2):?>
        <div class="column col-xs-4" id="column1"></div>
    <?endif?>
    <div class="column col-xs-4" id="column<?=$col?>">
        <?foreach($model as $arItem):?>
            <?if($arItem->column == $col):?>
                <div class="panel panel-<?=$arItem->state?>" id="item<?=$arItem->id?>">
                    <div class="panel-heading">
                        <?=$arItem->block->title?>
                        <a href="#" class="close config" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true" class="glyphicon glyphicon-cog"></span>
                        </a>
                    </div>
                    <? $links = $arItem->block->infolink ?>
                    <?if(count($links)>0):?>
                        <div class="list-group">
                            <?foreach($links as $link):?>
                                <?if($link->status != $link::STATUS_HIDDEN):?>
                                <a <?=($link->status == $link::STATUS_DISABLE?'':"href='$link->href'")?>
                                    class="list-group-item<?=($link->status == $link::STATUS_DISABLE?' disabled':'')?>"
                                    data-toggle="tooltip" data-placement="top" title="<?=$link->tooltip?>">
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
<div id="jGrowl-container1" class="jGrowl top-right"></div>
<script type="text/javascript">
    $(function(){
        $('.column').sortable({
            connectWith: '.column',
            handle: '.panel-heading',
            cursor: 'move',
            placeholder: 'placeholder',
            forcePlaceholderSize: true,
            opacity: 0.6,
            stop: function(event, ui){
                updateWidgetData('<?=Url::toRoute(['update', 'id' => 'contact'])?>');
            }
        }).disableSelection();

        $('[data-toggle="tooltip"]').tooltip();

        $('.panel-heading .config').click(function(){
            var itemId = $(this).closest( ".panel").attr('id');
            var link = "<?=Url::toRoute(['block/edit-user-block', 'id' => ''])?>";
            location.href=link+itemId;
        });

        //$.jGrowl("Stick this!", { sticky: true });

    });

</script>
