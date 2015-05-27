<?php
use yii\helpers\Html;
use dosamigos\editable\Editable;
use app\assets\UserAsset;

UserAsset::register($this);

$this->title = Yii::t('app', 'BLOCKS_DEFAULT');
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

                            <?= Html::a(Yii::t('app', 'LINK_ADD'), ['/link/create', 'id'=>$arItem->id],
                                ['class' => 'btn btn-info btn-xs pull-right']) ?>
                        </div>
                        <ul class="list-group" id="block<?=$arItem->id?>">
                            <?foreach($arItem->links as $link):?>
                                <li class="list-group-item" id="link<?=$link->id?>">
                                    <?= Html::a($link->subtitle,
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
