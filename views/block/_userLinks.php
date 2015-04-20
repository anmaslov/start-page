<?php
use yii\helpers\Url;
use dosamigos\editable\Editable;
use app\assets\UserAsset;

UserAsset::register($this);
?>

<? if(count($model->links)>0):?>
<div class="panel panel-default">
    <div class="panel-heading">Список ссылок:</div>

    <div class="panel-body block-default">
        <ul class="list-group" id="block<?=$model->id?>">
            <?foreach($model->links as $item):?>
                <li class="list-group-item" id="link<?=$item->id?>">
                    <?if(strlen($item->icon)>0):?>
                        <i class="glyphicon glyphicon-<?=$item->icon?>"></i>
                    <?endif?>
                    <?=$item['title']?>

                    <?if(Yii::$app->user->can('admin')):?>
                        <?= Editable::widget( [
                            'model' => $item,
                            'attribute' => 'status',
                            'url' => 'block/link',
                            'type' => 'select2',
                            'mode' => 'pop',
                            'options' => [
                                'id' => 'link-status-'.$item->id,
                                'class' => 'pull-right',
                            ],
                            'clientOptions' => [
                                'pk' => $item->id,
                                'autotext' => 'always',
                                'placement' => 'right',
                                'select2' => [
                                    'width' => '150px'
                                ],
                                'value' => $item->status,
                                'source' => $item::getStatusesArrayValue(),
                            ]
                        ]);?>
                    <?endif?>
                </li>
            <?endforeach?>
        </ul>
    </div>
</div>

<?endif?>

<script type="text/javascript">
    $(function(){
        $( ".list-group" ).sortable({
            stop: function(event, ui) { // begin receive
                updateLinks('<?=Url::toRoute(['/link/order'])?>');
            }
        }).disableSelection();
    });
</script>