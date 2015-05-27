<?php

use yii\helpers\Html;
?>
<h4><?=Yii::t('app', 'REFERENCE')?>:</h4>
<div class="row">
    <div class="col-md-4">
        <div class="list-group">

            <?= Html::a(Yii::t('app', 'BLOCK_STATE'), ['/reference/state'], ['class' => 'list-group-item']) ?>

            <?= Html::a(Yii::t('app', 'VISUAL_STYLE'), ['/reference/style'], ['class' => 'list-group-item']) ?>

            <?= Html::a(Yii::t('app', 'ROLES_TYPE'), ['/reference/roles'], ['class' => 'list-group-item']) ?>

            <?= Html::a(Yii::t('app', 'ICON_LIST'), ['/reference/icons'], ['class' => 'list-group-item']) ?>

        </div>
    </div>
</div>