<?
use yii\helpers\Html;
?>
<h4><?=Yii::t('app', 'SETTINGS_RESET')?>:</h4>

    <blockquote>
        <p><?=Yii::t('app', 'SETTINGS_CLICK_INFO')?> <b><?=Yii::t('app', 'SETTINGS_RESET')?></b></p>
        <footer><?=Yii::t('app', 'SETTINGS_CLICK_INFO1')?></footer>
        <footer><?=Yii::t('app', 'SETTINGS_CLICK_INFO2')?></footer>
    </blockquote>

<?= Html::a(Yii::t('app', 'SETTINGS_RESET'), ['reset'],
    ['class' => 'btn btn-danger',
        'data-confirm' => Yii::t('app', 'SETTINGS_RESET_CONFIRMATION'),
        'data-method' => 'post']) ?>