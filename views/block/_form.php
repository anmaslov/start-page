<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use app\models\State;

/* @var $this yii\web\View */
/* @var $model app\models\Link */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="well">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'title')->textInput(['maxlength' => 32]) ?>

    <?= $form->field($model, 'state')->dropDownList(ArrayHelper::map(State::find()->all(), 'name', 'name')) ?>

    <div class="row">
        <div class="col-md-6">
            <?= $form->field($model, 'column')->textInput() ?>
        </div>
        <div class="col-md-6">
            <?= $form->field($model, 'order')->textInput() ?>
        </div>
    </div>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Создать' : 'Обновить', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
        <?= Html::a('Отмена', ['index'], ['class' => 'btn btn-default']) ?>

        <?if(!$model->isNewRecord):?>
        <?= Html::a('Удалить', ['delete', 'id' => $model->id],
            ['class' => 'btn btn-danger pull-right',
             'data-confirm' => 'Вы действительно хотите удалить основной блок (Удалятся и все ссылки, входящие в этот блок)?']) ?>
        <?endif?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
