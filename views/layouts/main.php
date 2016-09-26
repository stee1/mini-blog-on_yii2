<?php

/* @var $this \yii\web\View */
/* @var $content string */

use yii\helpers\Html;
use app\assets\AppAsset;

AppAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?= Html::csrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
</head>
<body>
<?php $this->beginBody() ?>

<!--HEADER-->
<header id="header" class="container-fluid">
    <a href="<?= Yii::$app->urlManager->createUrl(["site/index"]) ?>">
        <h1 class="text-center">mini-blog</h1>
    </a>

</header>
<!--END HEADER-->

<!--CONTENT-->
<div class="content container-fluid">

    <!-- POPULAR RECORDS-->
    <div class="container">
        <p class="text-center form-caption">Популярные записи</p>

        <?php
        // Or image items
        $items = [
            ' <strong><p>Вася (<span>2016-09-14 16:11:45</span>)</p></strong>

                <p class="record-text">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Aliquam animi atque aut
                    beatae
                    commodi...</p>
               <a href="<?=Yii::$app->urlManager->createUrl([\'site/record-id\'])?>" class="comments-link">
                    <p class="comments">Коментариев <span class="badge">4</span></p>
                </a>
                 <a href="<?=Yii::$app->urlManager->createUrl([\'site/record-id\'])?>" class="pull-right">
                    Читать полностью
                </a>',
            ' <strong><p>Вася (<span>2016-09-14 16:11:45</span>)</p></strong>

                <p class="record-text">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Aliquam animi atque aut
                    beatae
                    commodi...</p>
               <a href="<?=Yii::$app->urlManager->createUrl([\'site/record-id\'])?>" class="comments-link">
                    <p class="comments">Коментариев <span class="badge">4</span></p>
                </a>
                 <a href="<?=Yii::$app->urlManager->createUrl([\'site/record-id\'])?>" class="pull-right">
                    Читать полностью
                </a>',
            ' <strong><p>Вася (<span>2016-09-14 16:11:45</span>)</p></strong>

                <p class="record-text">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Aliquam animi atque aut
                    beatae
                    commodi...</p>
               <a href="<?=Yii::$app->urlManager->createUrl([\'site/record-id\'])?>" class="comments-link">
                    <p class="comments">Коментариев <span class="badge">4</span></p>
                </a>
                 <a href="<?=Yii::$app->urlManager->createUrl([\'site/record-id\'])?>" class="pull-right">
                    Читать полностью
                </a>',

        ];

        echo yii2mod\bxslider\BxSlider::widget([
            'pluginOptions' => [
                'maxSlides' => 1,
                'controls' => true,
                'video' => false,
            ],
            'items' => $items
        ]);
        ?>
    </div>
    <!-- END POPULAR RECORDS-->

    <?= $content ?>

</div>
<!--END CONTENT-->


<!--FOOTER-->
<footer id="footer">
    <h3 class="text-center">2016 ©</h3>
</footer>
<!--END FOOTER-->

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
