<?php
use dosamigos\editable\Editable;

?>

<? if(count($model->links)>0):?>
<h4>Список ссылок:</h4>

<ul class="list-group">
    <?foreach($model->links as $item):?>
        <li class="list-group-item">
            <?if(strlen($item->icon)>0):?>
                <i class="glyphicon glyphicon-<?=$item->icon?>"></i>
            <?endif?>
            <?=$item['title']?>

            <?= Editable::widget( [
                'model' => $item,
                'attribute' => 'status',
                'url' => 'block/link',
                'type' => 'select2',
                'mode' => 'pop',
                //'id' => 'test',
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
        </li>
    <?endforeach?>
</ul>


<?endif?>