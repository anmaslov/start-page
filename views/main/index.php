<?php
/* @var $this yii\web\View */
use yii\helpers\ArrayHelper;
$this->title = 'Стартовая страница';
?>

<div class="row">
<?$colId = ArrayHelper::map($model, 'column', 'column');?>
<pre>
    <? //print_r($model)?>
</pre>
<?foreach($colId as $col):?>
    <div class="col-md-4">
        <?foreach($model as $arItem):?>
            <?if($arItem->column == $col):?>
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <?=$arItem->block->title?> (<?=$arItem->block->id?>)
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    </div>
                    <? $links = $arItem->block->infolink ?>
                    <?if(count($links)>0):?>
                        <div class="list-group">
                            <?foreach($links as $link):?>
                                <a href="<?=$link->href?>" class="list-group-item">
                                    <?if(strlen($link->icon)>0):?>
                                        <i class="glyphicon glyphicon-<?=$link->icon?>"></i>
                                    <?endif?>
                                    <?=$link->title?>
                                </a>
                            <?endforeach?>
                        </div>
                    <?endif?>
                </div>
            <?endif?>
        <?endforeach?>
    </div>
<?endforeach?>
</div>


<div class="row">
    <div class="col-sm-4">
        <div class="panel panel-default">
            <div class="panel-heading">Заголовок панели</div>
            <div class="panel-body">
                Какой то контент
            </div>
            <div class="list-group">
                <a href="#" class="list-group-item">Dapibus ac facilisis in</a>
                <a href="#" class="list-group-item disabled">Morbi leo risus</a>
                <a href="#" class="list-group-item"><i class="glyphicon glyphicon-star"></i> Porta ac consectetur ac</a>
                <a href="#" class="list-group-item">Vestibulum at eros<span class="badge">14</span></a>
                <a href="#" class="list-group-item">Vestibulum at eros<span class="badge">5</span></a>
                <a href="#" class="list-group-item list-group-item-danger">
                    <i class="glyphicon glyphicon-asterisk"></i>
                    Тестовая ссылка</a>
            </div>
        </div>
    </div>

    <div class="col-sm-4">
        <div class="panel panel-success">
            <div class="panel-heading">И еще один
                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            </div>
            <div class="panel-body">
                Panel content
            </div>
        </div>
    </div>

    <div class="col-sm-4">
        <div class="panel panel-primary">
            <div class="panel-heading">Panel heading without title
                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            </div>
            <div class="panel-body">
                Panel content
            </div>
        </div>

        <div class="panel panel-success">
            <div class="panel-heading">И еще один</div>
            <div class="panel-body">
                Panel content
            </div>
        </div>
    </div>
</div>
