<?php

use yii\helpers\Html;
use yii\helpers\Url;
use dosamigos\editable\Editable;
use app\assets\UserAsset;

if (Yii::$app->user->can('admin'))
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

                    <?if(Yii::$app->user->can('admin')):?>
                        <?= Html::a($item->title, ['/link/update', 'id'=>$item->id]) ?>
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

                     <?else:?>
                        <?=$item->title?>
                    <?endif?>
                </li>
            <?endforeach?>
        </ul>
    </div>
</div>

<?endif?>

<?if(Yii::$app->user->can('admin')):?>
    <script type="text/javascript">
        $(function(){
            $( ".list-group" ).sortable({
                stop: function(event, ui) { // begin receive
                    updateLinks('<?=Url::toRoute(['/link/order'])?>');
                }
            }).disableSelection();
        });
    </script>
<?endif?>