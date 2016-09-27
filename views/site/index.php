<?php

/* @var $this yii\web\View */
/* @var $validated \app\controllers\SiteController */
/* @var $records \app\controllers\SiteController */
/* @var $records_for_slider \app\controllers\SiteController */

$this->title = 'Mini-blog | Все записи';

use yii\helpers\Html;
use yii\widgets\ActiveForm;

?>

<!-- POPULAR RECORDS-->
<div class="container">
    <p class="text-center form-caption">Популярные записи</p>

    <?php

//    var_dump($records);

    $items = array();
    foreach ($records_for_slider as $record) {
        array_push($items, '<strong><p>'.Html::encode("{$record->author}").' (<span>'.Html::encode("{$record->date}").'</span>)</p></strong>

                <p class="record-text">'.Html::encode("{$record->trimmed_text}").'</p>
               <a href="'.Yii::$app->urlManager->createUrl(['site/record-id']).'" class="comments-link">
                    <p class="comments">Коментариев <span class="badge">'.Html::encode("{$record->comments_count}").'</span></p>
                </a>
                 <a href="'.Yii::$app->urlManager->createUrl(['site/record-id']).'" class="pull-right">
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

<!-- LIST ALL RECORDS-->
<div id="all-records">

    <!-- RECORD-->
    <?php foreach ($records as $record) { ?>
        <div class="container">
            <strong><p><?= Html::encode("{$record->author}"); ?> (<span><?= Html::encode("{$record->date}"); ?></span>)
                </p></strong>

            <p class="record-text"><?= Html::encode("{$record->trimmed_text}"); ?> </p>
            <a href="<?= Yii::$app->urlManager->createUrl(['site/record-id']) ?>" class="comments-link">
                <p class="comments">Коментариев <span class="badge"><?= Html::encode("{$record->comments_count}"); ?></span></p>
            </a>
            <a href="<?= Yii::$app->urlManager->createUrl(['site/record-id']) ?>" class="pull-right">
                Читать полностью
            </a>
        </div>
    <?php } ?>
    <!-- END RECORD-->

</div>
<!-- END LIST ALL RECORDS-->

<!-- FORM NEW RECORD-->
<div class="container">
    <p class="form-caption">Добавить запись</p>

    <?php $form = ActiveForm::begin([
        'id' => 'form-input-record',
        'options' => [
            'class' => 'form-horizontal col-xs-12'
        ],
        'fieldConfig' => [
            'template' => '{label}<div class="col-xs-11">{input}</div><div class="col-xs-12 col-xs-offset-1">{error}</div>',
            'labelOptions' => ['class' => 'col-xs-1 control-label'],
        ],
    ]); ?>

    <?= $form->field($model, 'author')->label('Автор')->textInput(['placeholder' => 'Имя']); ?>
    <!--                <span class="glyphicon form-control-feedback" id="recordform-author"></span>-->

    <?= $form->field($model, 'text')->textarea(['placeholder' => 'Текст публикации', 'rows' => '3'])->label("Текст") ?>
    <!--                <span class="glyphicon form-control-feedback" id="inputText1"></span>-->

    <div class="form-group">
        <div class="col-xs-12">
            <?= Html::submitButton('Отправить', ['class' => 'btn btn-primary pull-right']) ?>
        </div>
    </div>
    <?php ActiveForm::end(); ?>
</div>

<!-- END FORM NEW RECORD-->
