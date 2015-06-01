<?php

use anmaslov\autocomplete\AutoComplete;
use yii\web\JsExpression;
?>

<div class="row">
    <div class="col-md-6 sub-brand-text">
        <h1><?=\Yii::$app->settings->get('brand.brand-sub-text')?></h1>
    </div>
    <div class="col-md-6">
            <?= AutoComplete::widget([
                'name' => 'link',
                'id' => 'autocomplete',
                'data' =>  $link,
                'options' => [
                    'placeholder' => Yii::t('app', 'FAST_SEARCH'),
                ],
                'clientOptions' => [
                    'minChars' => 2,
                    'groupBy' => 'category',
					'onSelect' => new JsExpression("function(suggestion) { location.href = suggestion.stat }"),
                ],
            ])?>

    </div>
</div>

<script type="text/javascript">
    $(function(){
        $('#autocomplete').focus();
    });
</script>