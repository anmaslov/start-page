<?php

use yii\helpers\Html;
?>
<h4>Справочники:</h4>
<div class="row">
    <div class="col-md-4">
        <div class="list-group">

            <?= Html::a('Состояния блоков', ['/reference/state'], ['class' => 'list-group-item']) ?>

            <?= Html::a('Визуальное оформление', ['/reference/style'], ['class' => 'list-group-item']) ?>

            <?= Html::a('Виды ролей', ['/reference/roles'], ['class' => 'list-group-item']) ?>

            <?= Html::a('Список иконок', ['/reference/icons'], ['class' => 'list-group-item']) ?>

            <?= Html::a('Группы ip адресов', ['block'], ['class' => 'list-group-item']) ?>

            <?= Html::a('Доступные иконки', ['block'], ['class' => 'list-group-item']) ?>

        </div>
    </div>
</div>