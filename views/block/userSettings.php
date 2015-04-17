<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;

/* @var $this yii\web\View */
/* @var $model app\models\Link */

$this->title = "$model->title - редактирование";
$this->params['breadcrumbs'][] = ['label' => 'Список блоков', 'url' => ['/main']];
$this->params['breadcrumbs'][] = $this->title;
?>

<?if($msg = \Yii::$app->session->getFlash('success')):?>
    <div class="alert alert-success">
        <?=\Yii::$app->session->getFlash('success')?>
    </div>
<?endif?>

<div class="row">
    <div class="col-md-5 col-md-offset-1">
        <div class="panel panel-<?=$userModel->state?>">
            <div class="panel-heading"><?=$this->title?></div>
            <div class="panel-body">
                <?php $form = ActiveForm::begin(); ?>

                <?= $form->field($userModel, 'state')->dropDownList(ArrayHelper::map($states, 'name', 'title')) ?>

                <div class="form-group">
                    <?= Html::submitButton('Обновить', ['class' => 'btn btn-primary']) ?>
                    <?= Html::a('Отмена', ['/main'], ['class' => 'btn btn-default']) ?>
                </div>

                <?php ActiveForm::end(); ?>
            </div>
        </div>

        <?= $this->render('_userLinks', [
            'model' => $model
        ]) ?>
    </div>

    <div class="col-md-4 col-md-offset-1">
        <div class="panel panel-default">
            <div class="panel-heading">Пример цветового оформления</div>
            <div class="panel-body">
                <?foreach($states as $state):?>
                    <div class="panel panel-<?=$state->name?>">
                        <div class="panel-heading">
                            <?=$state->title?>
                        </div>
                    </div>
                <?endforeach?>
            </div>
        </div>
    </div>
</div>

