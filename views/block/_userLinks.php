<?php
use dosamigos\editable\Editable;

?>

<? if(count($model->links)>0):?>
<div class="panel panel-default">
    <div class="panel-heading">Список ссылок:</div>

    <div class="panel-body">
        <ul class="list-group">
            <?foreach($model->links as $item):?>
                <li class="list-group-item">
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