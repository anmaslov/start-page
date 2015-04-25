<?php
use dosamigos\editable\Editable;
use yii\helpers\Html;
?>

<h3>Визуальное оформление</h3>
<div class="row">
    <div class="col-md-4">

        <ul class="list-group">
            <? foreach ($model as $item):?>
            <li class="list-group-item">
                <?=$item->name?>

                <?= Editable::widget( [
                    'model' => $item,
                    'attribute' => 'title',
                    'url' => 'reference/updateStyle',
                    'mode' => 'pop',
                    'options' => [
                        'id' => 'state-'.$item->name,
                        'class' => 'pull-right'
                    ],
                ]);?>

            </li>
            <? endforeach ?>
        </ul>
    </div>
</div>

<?= $this->render('_back') ?>