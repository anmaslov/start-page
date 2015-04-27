<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;

/* @var $this yii\web\View */
/* @var $model app\models\UserSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="row collapse" id="searchUsers">
    <div class="col-md-3">
        <div class="well">
            <h4>Поиск:</h4>
            <?php $form = ActiveForm::begin([
                'action' => ['index'],
                'method' => 'get',
            ]); ?>

            <?php echo $form->field($model, 'ip') ?>

            <?= $form->field($model, 'role')->dropDownList(ArrayHelper::map(Yii::$app->authManager->getRoles(), 'name', 'description')) ?>

            <div class="form-group">
                <?= Html::submitButton('Поиск', ['class' => 'btn btn-primary']) ?>
                <?= Html::resetButton('Сброс', ['class' => 'btn btn-default']) ?>
            </div>

            <?php ActiveForm::end(); ?>

        </div>
    </div>

    <div class="col-md-3">
        <div class="well">
            <h4>Список доступных ролей:</h4>

            <?foreach(Yii::$app->authManager->getRoles() as $role):?>
                <p><?=$role->name?> - <?=$role->description?></p>
            <?endforeach?>
        </div>
    </div>
</div>

