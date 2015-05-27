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
            <?= $form->field($model, 'column')->dropDownList($model::getColumnsArray()) ?>
        </div>

        <div class="col-md-6">
            <?= $form->field($model, 'order')->textInput(['maxlength' => 5, 'type' => 'number']) ?>
        </div>
    </div>

    <?= $form->field($model, 'type')->dropDownList($model::getTypesArray()) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? Yii::t('app', 'BUTTON_CREATE') : Yii::t('app', 'BUTTON_UPDATE'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
        <?= Html::a(Yii::t('app', 'BUTTON_CANCEL'), ['index'], ['class' => 'btn btn-default']) ?>

        <?if(!$model->isNewRecord):?>
        <?= Html::a(Yii::t('app', 'BUTTON_DELETE'), ['delete', 'id' => $model->id],
            ['class' => 'btn btn-danger pull-right',
             'data-confirm' => Yii::t('app', 'BLOCK_DELETE_CONFIRMATION')]) ?>
        <?endif?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
