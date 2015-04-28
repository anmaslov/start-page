<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\Link */

$this->title = 'Добавить ссылку';
$this->params['breadcrumbs'][] = ['label' => 'Блоки', 'url' => ['/block/index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="row">

    <div class="col-md-5 col-md-offset-1">
        <h3><?= Html::encode($this->title) ?></h3>

        <?= $this->render('_form', [
            'model' => $model,
        ]) ?>
    </div>

</div>
