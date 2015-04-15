<?php
/* @var $this yii\web\View */
use yii\helpers\Html;
use yii\helpers\Url;
use app\assets\UiAsset;

UiAsset::register($this);
$this->title = 'Список блоков по умолчанию';
$colId = array(1, 2, 3);
?>
<h3><?=$this->title?></h3>
<?if($msg = \Yii::$app->session->getFlash('success')):?>
    <div class="alert alert-success">
        <?=\Yii::$app->session->getFlash('success')?>
    </div>
<?endif?>

<div class="row block-default">
    <?foreach($colId as $col):?>
        <?if(count($colId)<3 && $col==2):?>
            <div class="column col-xs-4" id="column1"></div>
        <?endif?>
        <div class="column col-xs-4" id="column<?=$col?>">
            <?foreach($model as $arItem):?>
                <?if($arItem->column == $col):?>
                <div class="panel panel-<?=$arItem->state?>">
                    <div class="panel-heading">
                        <?= Html::a($arItem->title, ['update', 'id'=>$arItem->id]) ?>
                    </div>
                    <ul class="list-group" id="block<?=$arItem->id?>">
                        <?foreach($arItem->links as $link):?>
                            <li class="list-group-item" id="link<?=$link->id?>">
                                <?= Html::a($link->title,
                                    ['/link/update', 'id'=>$link->id],
                                    ['class' => ($link->status == $link::STATUS_DISABLE?' disabled':'')])?>
                            </li>
                        <?endforeach?>
                    </ul>
                </div>
                <?endif?>
            <?endforeach?>
        </div>
    <?endforeach?>
</div>


<?= Html::a('Добавить блок', ['create'], ['class' => 'btn btn-success']) ?>

<?= Html::a('Добавить ссылку', ['/link/create'], ['class' => 'btn btn-info']) ?>

<script type="text/javascript">
    $(function(){
        $( ".list-group" ).sortable({
            connectWith: ".list-group",
            stop: function(event, ui) { // begin receive
                updateLinks();
            }
        }).disableSelection();

        function updateLinks(){
            var blocks=[];
            $('.list-group').each(function(){
                var blockId = $(this).attr('id');
                $('.list-group-item', this).each(function(i){
                    var block={
                        id: blockId,
                        order: i,
                        linkId: $(this).attr('id')
                    }
                    blocks.push(block);
                });
            });
            //console.log(blocks);
            $.get('<?=Url::toRoute(['/link/order'])?>',{links: blocks},function(data){
                //console.log(data);
            },"json");
        }
    });
</script>

