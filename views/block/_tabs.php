<?php
use dosamigos\editable\Editable;
use yii\helpers\Html;
?>

<div class="row">
    <div class="col-md-5 block">
        <?if(count($model->links)>0):?>
        <ul class="list-group" id="block<?=$model->id?>">
            <?foreach($model->links as $link):?>
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
        <?else:?>
            <div class="jumbotron">
                <p><?=Yii::t('app', 'LINKS_NOT_FOUND')?></p>
            </div>
        <?endif?>

        <p>
            <?= Html::a(Yii::t('app', 'BLOCK_EDIT'), ['update', 'id'=>$model->id], ['class' => 'btn btn-success']) ?>

            <?= Html::a(Yii::t('app', 'LINK_ADD'), ['/link/create', 'id'=>$model->id], ['class' => 'btn btn-info']) ?>
        </p>
    </div>
</div>