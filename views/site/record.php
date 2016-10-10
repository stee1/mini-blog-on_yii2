<?php

/* @var $this yii\web\View */
/* @var $current_record \app\controllers\SiteController */
/* @var $records_for_slider \app\controllers\SiteController */
/* @var $comments \app\controllers\SiteController */

$this->title = 'Mini-blog | ' . $current_record->author . ' (' . $current_record->date . ')';

use yii\helpers\Html;
use yii\widgets\ActiveForm;

?>

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
            'class' => 'form-horizontal col-xs-12',
            'validate-with-icons' => 1,
        ],
        'fieldConfig' => [
            'template' => '{label}<div class="col-xs-11 has-feedback">{input}<span class="form-control-feedback"></span>{error}</div>',
            'labelOptions' => ['class' => 'col-xs-1 control-label'],
        ],
    ]); ?>

    <?= $form->field($model, 'author')->label('Автор')->textInput(['placeholder' => 'Имя']); ?>

    <?= $form->field($model, 'text')->textarea(['placeholder' => 'Текст комментария', 'rows' => '3'])->label("Текст") ?>

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