<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\MessageSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'MESSAGES');
$this->params['breadcrumbs'][] = $this->title;
?>

<h1><?= Html::encode($this->title) ?></h1>
<p>
    <?= Html::a(Yii::t('app', 'BUTTON_CREATE'), ['create'], ['class' => 'btn btn-success']) ?>
</p>

<div class="row">
    <div class="col-md-5">
        <div class="list-group">
        <?foreach($model as $msg):?>
            <div class="panel panel-default">
                <div class="panel-body">
                    <div class="alert alert-<?=$msg->state?>" role="alert">
                        <strong><?=$msg->title?></strong><?=$msg->text?>
                    </div>
                    <?= Html::a(Yii::t('app', 'BUTTON_EDIT'), ['update', 'id'=>$msg->id], ['class' => 'btn btn-primary']) ?>
                    <span class="label label-warning"><?=$msg::getStatusesArray()[$msg->status] ?></span>
                </div>
            </div>
        <?endforeach?>
        </div>
    </div>
</div>
