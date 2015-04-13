<?php

use yii\helpers\Html;
use app\assets\UiAsset;
/* @var $this yii\web\View */
/* @var $model app\models\Link */

UiAsset::register($this);
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


    <div class="col-md-4 col-md-offset-1">
        <h4>Список ссылок:</h4>
        <ul id="main-group" class="list-group list-link">
            <?foreach($link as $item):?>
                <li class="list-group-item">
                    <?if(strlen($item->icon)>0):?>
                        <i class="glyphicon glyphicon-<?=$item->icon?>"></i>
                    <?endif?>
                    <?=$item['title']?>
                </li>
            <?endforeach?>
        </ul>

        <h4>Список ссылок из других блоков:</h4>
        <ul id="sec-group" class="list-group list-link">
            <?foreach($link_not as $item):?>
                <li class="list-group-item list-group-item-warning">
                    <?if(strlen($item->icon)>0):?>
                        <i class="glyphicon glyphicon-<?=$item->icon?>"></i>
                    <?endif?>
                    <?=$item['title']?>
                </li>
            <?endforeach?>
        </ul>
    </div>

</div>

<script type="text/javascript">
    $(function(){
        $( "#main-group, #sec-group" ).sortable({
            connectWith: ".list-group"
        }).disableSelection();
    });

</script>