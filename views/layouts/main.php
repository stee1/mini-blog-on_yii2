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

<?= $this->render('header')?>

<!--CONTENT-->
<div class="content container-fluid">

    <!-- POPULAR RECORDS-->
    <div id="popular-records" class="container container-wrapper">
        <p class="text-center form-caption">Популярные записи</p>

        <?php

        $items = array();
        foreach ($this->params['records_for_slider'] as $record) {
            array_push($items, '<strong><p>'.Html::encode("{$record->author}").' (<span>'.Html::encode("{$record->date}").'</span>)</p></strong>

                <p class="record-text">'.Html::encode("{$record->trimmed_text}").'</p>
               <a href="'.Yii::$app->urlManager->createUrl(['site/record', 'id' => Html::encode("$record->id")]).'" class="comments-link">
                    <p class="comments">Коментариев <span class="badge">'.Html::encode("{$record->comments_count}").'</span></p>
                </a>
                 <a href="'.Yii::$app->urlManager->createUrl(['site/record', 'id' => Html::encode("$record->id")]).'" class="pull-right">
                    Читать полностью
                </a>');
        }

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

<?= $this->render('footer')?>

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
