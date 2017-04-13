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
    <div class="col-md-12">
        <div class="list-group">
        <?foreach($model as $msg):?>
            <div class="panel panel-default">
                <div class="panel-heading">
                    <?=$msg->title?>
                    <b class="status pull-right">
                        <span class="badge"><?=$msg::getStatusesArray()[$msg->status] ?></span>
                        <?=Yii::t('app', 'MESSAGE_HIT')?>: <span class="badge"><?=$msg->hit?></span>
                    </b>
                </div>
                <div class="panel-body">
                    <div class="alert alert-<?=$msg->state?>" role="alert">
                        <?=nl2br($msg->text)?>
                    </div>
                </div>
                <div class="panel-footer">
                    <?= Html::a(Yii::t('app', 'BUTTON_EDIT'), ['update', 'id'=>$msg->id], ['class' => 'btn btn-primary']) ?>
                    <?= Html::a(Yii::t('app', 'BUTTON_DELETE'), ['delete', 'id'=>$msg->id], ['class' => 'btn btn-danger pull-right']) ?>
                </div>
            </div>
        <?endforeach?>
        </div>
    </div>
</div>
