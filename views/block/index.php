<?php
/* @var $this yii\web\View */
use yii\helpers\Html;
?>
<h3>Список основных блоков:</h3>

<ul>
<?foreach($model as $block):?>
 <li><?= Html::a($block->title, ['update', 'id'=>$block->id]) ?></li>
    <?if(count($block->links)>0):?>
        <ul>
        <?foreach($block->links as $link):?>
            <li><a href="<?=$link->href?>"><?=$link->title?></a>
            </li>
        <?endforeach?>
        </ul>
    <?endif?>
<?endforeach?>
</ul>

<?= Html::a('Добавить блок', ['create'], ['class' => 'btn btn-success']) ?>

<?= Html::a('Добавить ссылку', ['linkCreate'], ['class' => 'btn btn-info']) ?>

