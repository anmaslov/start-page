<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Message */

$this->title = Yii::t('app', 'MESSAGE_UPDATE') . ' ' . $model->title;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'MESSAGES'), 'url' => ['index']];
$this->params['breadcrumbs'][] = Yii::t('app', 'BUTTON_UPDATE');
?>
<div class="row">

    <div class="col-md-6">
        <h3><?= Html::encode($this->title) ?></h3>

        <?= $this->render('_form', [
            'model' => $model,
        ]) ?>
    </div>
</div>
