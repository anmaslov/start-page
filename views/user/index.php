<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\UserSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Список пользователей';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="user-index">

    <h1><?= Html::encode($this->title) ?>

        <small>
            <button class="btn btn-primary btn-small" type="button" data-toggle="collapse"
                    data-target="#searchUsers" aria-expanded="false" aria-controls="searchUsers">
                Поиск
            </button>
        </small>
    </h1>
    <?php echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'showHeader' => false,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            [
                'label' => 'Ip Адрес',
                'format' => 'raw',
                'value'=>function ($data) {
                    return Html::a($data->ip, ['view', 'id'=>$data->id]);
                },
            ],
            //'username',
            //'style',
            //['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>

</div>
