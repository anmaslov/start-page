<?php

use yii\bootstrap\Html;
use app\assets\AutocompleteAsset;

AutocompleteAsset::register($this);
?>

<div class="row">
    <div class="col-md-6 sub-brand-text">
        <h1><?=\Yii::$app->settings->get('brand.brand-sub-text')?></h1>
    </div>
    <div class="col-md-6">
        <form>
            <div class="form-group">
                <?=Html::textInput('links', null, [
                    'id' => 'autocomplete',
                    'class' => 'form-control',
                    'placeholder' => Yii::t('app', 'FAST_SEARCH')
                ]) ?>
            </div>
        </form>
    </div>
</div>

<script type="text/javascript">
    $(function(){
        var countries = <?= \yii\helpers\Json::encode($link);?>;
        $('#autocomplete').autocomplete({
            lookup: countries,
            minChars: 2,
            groupBy: 'category',
            onSelect: function (suggestion) {
                location.href = suggestion.stat;
            }
        }).focus();
    });
</script>