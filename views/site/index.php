<?php

/* @var $this yii\web\View */
/* @var $records \app\controllers\SiteController */

$this->title = 'Mini-blog | Все записи';

use yii\helpers\Html;
use yii\widgets\ActiveForm;

?>


<!-- LIST ALL RECORDS-->
<div id="all-records">

    <!-- RECORD-->
    <?php foreach ($records as $record) { ?>
        <div class="container">
            <strong><p><?= Html::encode("{$record->author}"); ?> (<span><?= Html::encode("{$record->date}"); ?></span>)
                </p></strong>

            <p class="record-text"><?= Html::encode("{$record->trimmed_text}"); ?> </p>
            <a href="<?= Yii::$app->urlManager->createUrl(['site/record', 'id' => $record->id]) ?>" class="comments-link">
                <p class="comments">Коментариев <span class="badge"><?= Html::encode("{$record->comments_count}"); ?></span></p>
            </a>
            <a href="<?= Yii::$app->urlManager->createUrl(['site/record', 'id' => $record->id]) ?>" class="pull-right">
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
            'class' => 'form-horizontal col-xs-12',
            'validate-with-icons' => 1,
        ],
        'fieldConfig' => [
            'template' => '{label}<div class="col-xs-11 has-feedback">{input}<span class="form-control-feedback"></span>{error}</div>',
            'labelOptions' => ['class' => 'col-xs-1 control-label'],
        ],
    ]); ?>

    <?= $form->field($model, 'author')->label('Автор')->textInput(['placeholder' => 'Имя']); ?>

    <?= $form->field($model, 'text')->textarea(['placeholder' => 'Текст публикации', 'rows' => '3'])->label("Текст") ?>

    <div class="form-group">
        <div class="col-xs-12">
            <?= Html::submitButton('Отправить', ['class' => 'btn btn-primary pull-right']) ?>
        </div>
    </div>
    <?php ActiveForm::end(); ?>
</div>

<!-- END FORM NEW RECORD-->

<?php
$this->registerJs("
//правило для валидации только формы с иконками
    $('form[validate-with-icons=1]').on('afterValidateAttribute', function (event, attribute, messages) {

        // результат валидации
        var hasError = messages.length !== 0;

        if(hasError)
            $(attribute.input).parent().find('.form-control-feedback').removeClass('glyphicon glyphicon-ok').addClass('glyphicon glyphicon-remove');
        else
            $(attribute.input).parent().find('.form-control-feedback').removeClass('glyphicon glyphicon-remove').addClass('glyphicon glyphicon-ok');

    });"
);?>