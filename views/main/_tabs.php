<?php

use yii\helpers\Html;
?>
<div class="row block">
    <div class="col-md-5">
        <?if(count($model->links)>0):?>
        <div class="list-group">
            <?foreach($model->links as $link):?>
                <?if($link->status != $link::STATUS_HIDDEN):?>
                    <a <?=($link->status == $link::STATUS_DISABLE?'':"href='$link->stat'")?>
                        class="list-group-item<?=($link->status == $link::STATUS_DISABLE?' disabled':'')?>"
                        data-toggle="tooltip" data-placement="top" title="<?=$link->tooltip?>">
                        <?if(strlen($link->icon)>0):?>
                            <i class="glyphicon glyphicon-<?=$link->icon?>"></i>
                        <?endif?>
                        <?=$link->title?>
                    </a>
                <?endif?>
            <?endforeach?>
        </div>
        <?else:?>
            <div class="jumbotron">
                <p><?=Yii::t('app', 'LINKS_NOT_FOUND')?></p>
            </div>
        <?endif?>
    </div>

</div>
