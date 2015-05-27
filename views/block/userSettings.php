<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;

/* @var $this yii\web\View */
/* @var $model app\models\Link */

$this->title = "$model->title - " . Yii::t('app', 'BUTTON_EDIT');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'BLOCK_LIST'), 'url' => ['/main']];
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
                    <?= Html::submitButton(Yii::t('app', 'BUTTON_UPDATE'), ['class' => 'btn btn-primary']) ?>
                    <?= Html::a(Yii::t('app', 'BUTTON_CANCEL'), ['/main'], ['class' => 'btn btn-default']) ?>
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
            <div class="panel-heading"><?=Yii::t('app', 'COLOR_SCHEME')?>:</div>
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

