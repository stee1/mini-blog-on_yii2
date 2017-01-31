<?php
/**
 * Created by PhpStorm.
 * User: dmitry
 * Date: 29.10.2016
 * Time: 11:45
 */
use yii\bootstrap\NavBar;
use yii\bootstrap\Nav;
use yii\helpers\Url;
?>

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
//    $menuItems = [
//        [
//            'label' => 'Выйти('.Yii::$app->user->identity['username'].')',
//            'url' => ['/site/logout'],
//            'linkOptions' => ['data-method' => 'post']
//        ],
//    ];

    ?>
    <div class="navbar-form navbar-right">
        <button class="btn btn-sm btn-default"
                data-container="body"
                data-toggle="popover"
                data-trigger="focus"
                data-placement="bottom"
                data-html="true"
                data-title="<?= Yii::$app->user->identity['username'] ?>"
                data-content="
                    <a href='<?= Url::to(['/site/logout']) ?>' data-method='post'>Выход</a>
			    ">
            <span class="glyphicon glyphicon-user"></span>
        </button>
    </div>
    <?php
    $menuItems = [
        ['label' => 'Админка', 'url' => ['/admin']]
    ];
}

echo Nav::widget([
    'items' => $menuItems,
//    'encodeLabels' => false,
    'options' => ['class' => 'navbar-nav navbar-right'],
]);
NavBar::end();
?>
<!--END HEADER-->