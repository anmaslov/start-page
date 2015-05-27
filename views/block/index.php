<?php
/* @var $this yii\web\View */
use yii\helpers\Html;
use yii\bootstrap\Tabs;
use yii\helpers\Url;

?>


<?
//Генерируем массив табов
$items = [];
foreach($blocks as $block)
{
    $items[] = [
        'label' => $block->title,
        'content' => $this->render('_tabs', [
            'model' => $block
        ]),
    ];
}
?>


<?
echo Tabs::widget([
    'items' => array_merge([
        [
            'label' => Yii::t('app', 'COMMON'),
            'content' => $this->render('_block', [
                'model' => $model,
            ]),
            'active' => true,
        ]
    ],
        $items
    ),
    'options' => ['tag' => 'div'],
    'navType' => 'nav-pills',
    'itemOptions' => ['tag' => 'div'],
    'headerOptions' => ['class' => 'my-class'],
    'clientOptions' => ['collapsible' => false],
]);
?>

<?= Html::a(Yii::t('app', 'BLOCK_ADD'), ['create'], ['class' => 'btn btn-success']) ?>

<script type="text/javascript">
    $(function(){
        $( ".list-group" ).sortable({
            connectWith: ".list-group",
            stop: function(event, ui) { // begin receive
                updateLinks('<?=Url::toRoute(['/link/order'])?>');
            }
        }).disableSelection();

        $('.column').sortable({
            connectWith: '.column',
            handle: '.panel-heading',
            cursor: 'move',
            placeholder: 'placeholder',
            forcePlaceholderSize: true,
            opacity: 0.6,
            stop: function(event, ui){
                updateWidgetData('<?=Url::toRoute(['block-update', 'id' => 'contact'])?>');
            }
        }).disableSelection();
    });
</script>
