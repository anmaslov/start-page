<?php

use yii\helpers\Html;
?>
<h4>Справочники:</h4>
<div class="row">
    <div class="col-md-4">
        <div class="list-group">

            <?= Html::a('Состояния блоков', ['block'], ['class' => 'list-group-item']) ?>

            <?= Html::a('Визуальное оформление', ['block'], ['class' => 'list-group-item']) ?>

            <?= Html::a('Виды ролей', ['block'], ['class' => 'list-group-item']) ?>

            <?= Html::a('Группы ip адресов', ['block'], ['class' => 'list-group-item']) ?>

            <?= Html::a('Доступные иконки', ['block'], ['class' => 'list-group-item']) ?>

        </div>
    </div>
</div>