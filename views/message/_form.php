<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use app\models\State;

/* @var $this yii\web\View */
/* @var $model app\models\Message */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="well">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'title')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'text')->textarea(['rows' => 6]) ?>

    <div class="row">
        <div class="col-md-6">
            <?= $form->field($model, 'status')->dropDownList($model::getStatusesArray()) ?>
        </div>

        <div class="col-md-6">
            <?= $form->field($model, 'state')->dropDownList(ArrayHelper::map(State::find()->all(), 'name', 'name')) ?>
        </div>
    </div>
    <!--
    <div class="row">
        <div class="col-md-6"> <?= $form->field($model, 'date_start')->textInput(['maxlength' => true]) ?></div>
        <div class="col-md-6"> <?= $form->field($model, 'date_end')->textInput(['maxlength' => true]) ?></div>
    </div>-->

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? Yii::t('app', 'BUTTON_CREATE') : Yii::t('app', 'BUTTON_UPDATE'),
            ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
