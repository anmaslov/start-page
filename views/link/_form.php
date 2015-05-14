<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use app\models\Block;

/* @var $this yii\web\View */
/* @var $model app\models\Link */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="well">

    <?php $form = ActiveForm::begin(); ?>

    <div class="row">
        <div class="col-md-6">
            <?= $form->field($model, 'title')->textInput(['maxlength' => 64]) ?>
        </div>

        <div class="col-md-6">
            <?= $form->field($model, 'tooltip')->textInput(['maxlength' => 128]) ?>
        </div>
    </div>

    <?= $form->field($model, 'href')->textInput(['maxlength' => 128]) ?>

    <?= $form->field($model, 'block_id')->dropDownList(ArrayHelper::map(Block::find()->all(), 'id', 'title')) ?>

    <div class="row">
        <div class="col-md-4">
            <?= $form->field($model, 'order')->textInput() ?>
        </div>

        <div class="col-md-4">
            <?if($model->isNewRecord) $model->status = $model::STATUS_ACTIVE; ?>
            <?= $form->field($model, 'status')->dropDownList($model::getStatusesArray()) ?>
        </div>

        <div class="col-md-4">
            <?= $form->field($model, 'icon')->textInput(['maxlength' => 32]) ?>
        </div>

    </div>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Создать' : 'Обновить', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
        <?= Html::a('Отмена', ['/block/index'], ['class' => 'btn btn-default']) ?>

        <?if(!$model->isNewRecord):?>
            <?= Html::a('Удалить', ['/link/delete', 'id' => $model->id],
                ['class' => 'btn btn-danger pull-right',
                    'data-confirm' => 'Вы действительно хотите удалить ссылку?']) ?>
        <?endif?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
