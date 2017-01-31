<?php

/* @var $this \yii\web\View */
/* @var $content string */

use yii\bootstrap\Button;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\helpers\Html;
use app\assets\AppAsset;
use yii\helpers\Url;

AppAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <?= Html::csrfMetaTags() ?>
    <link rel="shortcut icon" href="<?php echo Yii::$app->request->baseUrl; ?>/favicon.ico" type="image/x-icon" />
    <meta charset="<?= Yii::$app->charset ?>">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
</head>
<body>
<?php $this->beginBody() ?>

<!--HEADER-->
<?php
NavBar::begin([
    'brandLabel' => 'mini-blog',
    'brandUrl' => ['/site/index'],
]);

$menuItems = [
    ['label' => 'Посты', 'url' => ['/admin/records']],
    ['label' => 'Комментарии', 'url' => ['/admin/comments']],
    ['label' => 'Пользователи', 'url' => ['/rbac']],
];


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



echo Nav::widget([
    'items' => $menuItems,
//    'encodeLabels' => false,
    'options' => ['class' => 'navbar-nav navbar-right'],
]);
NavBar::end();
?>
<!--END HEADER-->

<!--CONTENT-->
<div class="content container-fluid">

<div class="container">
    <?= $content ?>
</div>


</div>
<!--END CONTENT-->

<?= $this->render('footer')?>

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
