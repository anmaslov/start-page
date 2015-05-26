<?php

use yii\helpers\Html;
/* @var $this yii\web\View */
/* @var $model app\models\Link */

$this->title = Yii::t('app', 'BLOCK_EDIT') . ': ' . $model->title;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'BLOCK_LIST'), 'url' => ['index']];
$this->params['breadcrumbs'][] = Yii::t('app', 'BUTTON_EDIT');
?>

<?if($msg = \Yii::$app->session->getFlash('danger')):?>
    <div class="alert alert-danger">
        <?=\Yii::$app->session->getFlash('danger')?>
    </div>
<?endif?>

<div class="row">
    <div class="col-md-5 col-md-offset-1">
        <h3><?= Html::encode($this->title) ?></h3>

        <?= $this->render('_form', [
            'model' => $model,
        ]) ?>
    </div>
</div>