<?php

use yii\helpers\Url;
use app\assets\UserAsset;

UserAsset::register($this);
?>


<input type="text" id="autocomplete"/>

<script type="text/javascript">
    $(function(){
        var source = [ { value: "www.foo.com",
            label: "Spencer Kline"
        },
            { value: "www.example.com",
                label: "James Bond"
            }
        ];

        $("input#autocomplete").autocomplete({
            source: source,
            select: function( event, ui ) {
                window.location.href = ui.item.value;
            }
        });

    });

</script>