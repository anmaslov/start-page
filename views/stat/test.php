<?php

use yii\helpers\Url;
use app\assets\AutocompleteAsset;
AutocompleteAsset::register($this);
?>


<input type="text" name="country" id="autocomplete"/>

<script type="text/javascript">
    $(function(){

        var countries = <?= \yii\helpers\Json::encode($link);?>;

        /*var countries = [
            { value: 'Chicago Blackhawks', data: { category: 'NHL' } },
            { value: 'Chicago Bulls', data: { category: 'NBA' } },
            { value: 'Russia', data: { category: 'NBA' } },
            { value: 'Vild', data: { category: 'NBA' } },
            { value: 'Canada', data: { category: 'TEST' } }
        ];*/

        $('#autocomplete').autocomplete({
            lookup: countries,
            minChars: 2,
            groupBy: 'category',
            onSelect: function (suggestion) {
                alert('You selected: ' + suggestion.value + ', ' + suggestion.stat);
            }
        });

    });

</script>