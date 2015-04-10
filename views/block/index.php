<?php
/* @var $this yii\web\View */
?>
<h3>Список основных блоков:</h3>

<ul>
<?foreach($model as $block):?>
 <li><a href="#"><?=$block->title?></a></li>
    <?if(count($block->links)>0):?>
        <ul>
        <?foreach($block->links as $link):?>
            <li><a href="<?=$link->href?>"><?=$link->title?></a></li>
        <?endforeach?>
        </ul>
    <?endif?>
<?endforeach?>
</ul>

<a href="#" class="btn btn-primary"><span class="glyphicon glyphicon-plus" aria-hidden="true"></span> Добавить блок</a>
<a href="#" class="btn btn-info"><span class="glyphicon glyphicon-plus" aria-hidden="true"></span> Добавить ссылку</a>

