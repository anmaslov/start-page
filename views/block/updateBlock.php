<?php

use yii\helpers\Html;
/* @var $this yii\web\View */
/* @var $model app\models\Link */

$this->title = 'Редактирование блока: ' . ' ' . $model->title;
$this->params['breadcrumbs'][] = ['label' => 'Список блоков', 'url' => ['index']];
$this->params['breadcrumbs'][] = 'Редактирование';
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