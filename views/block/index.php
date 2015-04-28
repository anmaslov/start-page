<?php
/* @var $this yii\web\View */
use yii\helpers\Html;
use yii\helpers\Url;
use dosamigos\editable\Editable;
use app\assets\UserAsset;

UserAsset::register($this);
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
                <div class="panel panel-<?=$arItem->state?>" id="item<?=$arItem->id?>">
                    <div class="panel-heading">
                        <?= Html::a($arItem->title, ['update', 'id'=>$arItem->id]) ?>

                        <?= Html::a('Добавить ссылку', ['/link/create', 'id'=>$arItem->id],
                            ['class' => 'btn btn-info btn-xs pull-right']) ?>
                    </div>
                    <ul class="list-group" id="block<?=$arItem->id?>">
                        <?foreach($arItem->links as $link):?>
                            <li class="list-group-item" id="link<?=$link->id?>">
                                <?= Html::a($link->title,
                                    ['/link/update', 'id'=>$link->id],
                                    ['class' => ($link->status == $link::STATUS_DISABLE?' disabled':'')])?>

                                <?= Editable::widget( [
                                    'model' => $link,
                                    'attribute' => 'status',
                                    'url' => 'block/link',
                                    'type' => 'select2',
                                    'mode' => 'pop',
                                    'options' => [
                                        'id' => 'link-status-'.$link->id,
                                        'class' => 'pull-right',
                                    ],
                                    'clientOptions' => [
                                        'pk' => $link->id,
                                        'autotext' => 'always',
                                        'select2' => [
                                            'width' => '150px'
                                        ],
                                        'value' => $link->status,
                                        'source' => $link::getStatusesArrayValue(),
                                    ]
                                ]);?>

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
                updateLinks('<?=Url::toRoute(['/link/order'])?>');
            }
        }).disableSelection();

        $('.column').sortable({
            connectWith: '.column',
            handle: '.panel-heading',
            cursor: 'move',
            placeholder: 'placeholder',
            forcePlaceholderSize: true,
            opacity: 0.6,
            stop: function(event, ui){
                updateWidgetData('<?=Url::toRoute(['block-update', 'id' => 'contact'])?>');
            }
        }).disableSelection();
    });
</script>

