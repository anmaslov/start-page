<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use app\models\State;

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
        <h3><?=$this->title?></h3>

        <?php $form = ActiveForm::begin(); ?>

        <?= $form->field($userModel, 'state')->dropDownList(ArrayHelper::map(State::find()->all(), 'name', 'name')) ?>

        <div class="form-group">
            <?= Html::submitButton('Обновить', ['class' => 'btn btn-primary']) ?>
            <?= Html::a('Отмена', ['/main'], ['class' => 'btn btn-default']) ?>
        </div>

        <?php ActiveForm::end(); ?>
    </div>
</div>

<?= $this->render('_userLinks', [
    'model' => $model,
]) ?>