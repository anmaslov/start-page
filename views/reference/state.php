<?php
use dosamigos\editable\Editable;
?>

<h3>Состояния блоков</h3>

<div class="row">
    <div class="col-md-4">
                <?foreach($model as $state):?>
                    <div class="panel panel-<?=$state->name?>">
                        <div class="panel-heading">
                            <?=$state->name?>
                        </div>
                        <div class="panel-body">

                            <?= Editable::widget( [
                                'model' => $state,
                                'attribute' => 'title',
                                'url' => 'reference/updateState',
                                'mode' => 'pop',
                                'options' => [
                                    'id' => 'state-'.$state->name,
                                ],
                            ]);?>

                        </div>
                    </div>
                <?endforeach?>
    </div>
</div>