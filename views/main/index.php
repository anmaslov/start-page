<?php
/* @var $this yii\web\View */

use app\assets\UiAsset;
use yii\helpers\Url;

UiAsset::register($this);
$this->title = 'Стартовая страница';
?>

<div class="row">
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
                        <button type="button" class="close toggle" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">‒</span></button>
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

<script type="text/javascript">
    $(function(){
        $('.column').sortable({
            connectWith: '.column',
            handle: '.panel-heading',
            cursor: 'move',
            placeholder: 'placeholder',
            forcePlaceholderSize: true,
            opacity: 0.6,
            start: function(event, ui){
                //Firefox, Safari/Chrome fire click event after drag is complete, fix for that
                /*if($.browser.mozilla || $.browser.safari)
                    $(ui.item).find('.dragbox-content').toggle();*/
            },
            stop: function(event, ui){
                ui.item.css({'top':'0','left':'0'}); //Opera fix
                //if(!$.browser.mozilla && !$.browser.safari)
                    updateWidgetData();
            }
        }).disableSelection();

        function updateWidgetData(){
            var items=[];
            $('.column').each(function(){
                var columnId=$(this).attr('id');
                $('.panel', this).each(function(i){
                    var collapsed=0;
                    if($(this).find('.list-group').css('display')=="none")
                        collapsed=1;
                    var item={
                        id: $(this).attr('id'),
                        collapsed: collapsed,
                        order : i,
                        column: columnId
                    };
                    items.push(item);
                });
            });
            $.get('<?=Url::toRoute(['update', 'id' => 'contact'])?>',{items: items},function(data){
                console.log(data);
            },"json");
        }

        $( '.panel-heading .toggle' ).click(function() {
            var icon = $( this );
            icon.find('span').text() == '+' ? icon.find('span').text('‒') : icon.find('span').text('+');
            $(this).closest( ".panel").find( ".list-group" ).toggle('slow').promise().done(function(){
                updateWidgetData();
            });
        });

        $('.panel-heading .config').click(function(){
            var itemId = $(this).closest( ".panel").attr('id');
            var link = "<?=Url::toRoute(['block/editUserBlock', 'id' => ''])?>";
            location.href=link+itemId;
        });

    });

</script>
