<?php

/* @var $this yii\web\View */
/* @var $current_record \app\controllers\SiteController */
/* @var $records_for_slider \app\controllers\SiteController */
/* @var $comments \app\controllers\SiteController */

$this->title = 'Mini-blog | ' . $current_record->author . '(' . $current_record->date . ')';

use yii\helpers\Html;
use yii\widgets\ActiveForm;

?>


<!-- POPULAR RECORDS-->
<div class="container">
    <p class="text-center form-caption">Популярные записи</p>

    <?php

    $items = array();
    foreach ($records_for_slider as $record) {
        array_push($items, '<strong><p>' . Html::encode("{$record->author}") . ' (<span>' . Html::encode("{$record->date}") . '</span>)</p></strong>

                <p class="record-text">' . Html::encode("{$record->trimmed_text}") . '</p>
               <a href="' . Yii::$app->urlManager->createUrl(['site/record', 'id' => $record->id]) . '" class="comments-link">
                    <p class="comments">Коментариев <span class="badge">' . Html::encode("{$record->comments_count}") . '</span></p>
                </a>
                 <a href="' . Yii::$app->urlManager->createUrl(['site/record', 'id' => $record->id]) . '" class="pull-right">
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

<!-- RECORD-->
<div class="container">
    <strong><p><?= $current_record->author ?> (<span><?= $current_record->date ?></span>)</p></strong>

    <p class="record-text"><?= $current_record->text ?></p>

    <!-- COMMENTS-->
    <div class="comments-container">
        <p class="form-caption">Комментарии:</p>
        <ul class="list-unstyled">
            <?php foreach ($comments as $comment) { ?>
                <li>
                    <strong><p><?= $comment->author ?> (<span><?= $comment->date ?></span>):</p></strong>

                    <p><?= $comment->text ?></p>
                </li>
            <?php } ?>
        </ul>
    </div>
    <!-- END COMMENTS-->
</div>
<!-- END RECORD-->

<!-- FORM NEW RECORD-->
<div class="container">
    <p class="form-caption">Добавить комментарий</p>

    <?php $form = ActiveForm::begin([
        'id' => 'form-input-comment',
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

    <?= $form->field($model, 'text')->textarea(['placeholder' => 'Текст комментария', 'rows' => '3'])->label("Текст") ?>
    <!--                <span class="glyphicon form-control-feedback" id="inputText1"></span>-->

    <div class="form-group">
        <div class="col-xs-12">
            <?= Html::submitButton('Отправить', ['class' => 'btn btn-primary pull-right']) ?>
        </div>
    </div>
    <?php ActiveForm::end(); ?>
</div>

<!-- END FORM NEW RECORD-->