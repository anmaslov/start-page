
<? if(count($model->links)>0):?>

<h4>Список ссылок:</h4>

<ul class="list-group">
    <?foreach($model->links as $item):?>
        <li class="list-group-item">
            <?if(strlen($item->icon)>0):?>
                <i class="glyphicon glyphicon-<?=$item->icon?>"></i>
            <?endif?>
            <?=$item['title']?>
        </li>
    <?endforeach?>
</ul>


<?endif?>