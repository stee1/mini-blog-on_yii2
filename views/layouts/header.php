<?php
/**
 * Created by PhpStorm.
 * User: dmitry
 * Date: 29.10.2016
 * Time: 11:45
 */
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar; ?>

<!--HEADER-->
<?php
NavBar::begin([
    'brandLabel' => 'mini-blog',
    'brandUrl' => ['site/index'],
]);

$menuItems = [];

if (Yii::$app->user->isGuest) {
    $menuItems = [
        ['label' => 'Регистрация', 'url' => ['/site/reg']],
        ['label' => 'Войти', 'url' => ['/site/login']],
    ];
}
else {
    $menuItems = [
        [
            'label' => 'Выйти('.Yii::$app->user->identity['username'].')',
            'url' => ['/site/logout'],
            'linkOptions' => ['data-method' => 'post']
        ],
    ];
}

echo Nav::widget([
    'items' => $menuItems,
    'options' => ['class' => 'navbar-nav navbar-right'],
]);
NavBar::end();
?>
<!--END HEADER-->