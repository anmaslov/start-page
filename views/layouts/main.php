<?php
use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use app\assets\AppAsset;
use app\assets\IEJqueryAsset;

/* @var $this \yii\web\View */
/* @var $content string */

AppAsset::register($this);
//IEJqueryAsset::register($this);
$settings = Yii::$app->settings;
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta name="language" content="ru" />
    <meta http-equiv="X-UA-Compatible" content="IE=100" > <!-- IE8 mode -->
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <?= Html::csrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
</head>
<body>
<?php $this->beginBody() ?>
    <div class="wrap">
        <?php
            $brandImg = $settings->get('brand.brand-img');
            $brandTxt = $settings->get('brand.brand-text');

            NavBar::begin([
                'brandLabel' => ($brandImg ? '<img alt="Brand" src="'.$brandImg.'">' : '').
                    Html::tag('div', ($brandTxt ? $brandTxt : 'Стартовая страница'), ['class' => 'text-brand']),
                'brandUrl' => Yii::$app->homeUrl,
                'innerContainerOptions' => ['class' => 'container-fluid'],
                'options' => [
                    'class' => 'navbar navbar-default',
                ],
            ]);

            //echo Html::tag('p', 'brandtext', ['class' => 'navbar-text']);

            echo Nav::widget([
                'options' => ['class' => 'navbar-nav navbar-right'],
                'items' => [
                    ['label' => Yii::t('app', 'BLOCKS'), 'url' => ['/block/index'], 'visible' => Yii::$app->user->can('admin')],
                    ['label' => Yii::t('app', 'SETTINGS'), 'url' => ['/settings/index']],
                    ['label' => Yii::t('app', 'USERS'), 'url' => ['/user/index'], 'visible' => Yii::$app->user->can('admin')],
                    ['label' => Yii::t('app', 'STATISTICS'), 'url' => ['/stat/index']],
                    ['label' => Yii::t('app', 'MESSAGES'), 'url' => ['/message/index'], 'visible' => Yii::$app->user->can('moder')],
                    Yii::$app->user->isGuest ?
                        ['label' => Yii::t('app', 'SING_IN'), 'url' => ['/site/login']] :
                        ['label' => Yii::t('app', 'YOUR_ADDRESS {ip}', ['ip' => Yii::$app->user->identity->ip]),

                            'url' => ['/site/logout'],
                            'linkOptions' => ['data-method' => 'post']],
                ],
            ]);
            NavBar::end();
        ?>

        <div class="container-fluid">
            <?= Breadcrumbs::widget([
                'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
            ]) ?>
            <?= $content ?>
        </div>
    </div>

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
