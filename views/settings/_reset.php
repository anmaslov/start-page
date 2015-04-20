<?
use yii\helpers\Html;
?>
<h3>Сброс настроек:</h3>

<?= Html::a('Сброс настроек', ['reset'],
    ['class' => 'btn btn-danger',
        'data-confirm' => 'Вы действительно хотите сбросить настройки?',
        'data-method' => 'post']) ?>