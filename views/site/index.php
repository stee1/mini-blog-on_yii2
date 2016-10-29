<?php

/* @var $this yii\web\View */
/* @var $records \app\controllers\SiteController */
/* @var $listDataProvider \app\controllers\SiteController */

$this->title = 'Mini-blog | Все записи';

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\widgets\ListView;

?>

<!-- LIST ALL RECORDS-->

    <!-- RECORD-->
    <?php
    echo ListView::widget([
        'dataProvider' => $listDataProvider,

        'itemView' => '_list',
        'itemOptions' => [
            'tag' => 'div',
            'class' => 'container container-wrapper',
        ],

        'options' => [
            'tag' => 'div',
            'id' => 'all-records',
        ],

        'layout' => "{items}\n<div class='container  my-summary'>{summary}</div>\n<div class='text-center'>{pager}</div>",
        'summary' => 'Показано {begin}-{end} из {totalCount} записей',

        'emptyText' => 'Записей в блоге еще не было',
        'emptyTextOptions' => [
            'tag' => 'p'
        ],

        'pager' => [
            'prevPageLabel' => '<span class="glyphicon glyphicon-chevron-left"></span>',
            'nextPageLabel' => '<span class="glyphicon glyphicon-chevron-right"></span>',
            'maxButtonCount' => 3,
        ],
    ]);
    ?>
    <!-- END RECORD-->

<!-- END LIST ALL RECORDS-->

<!-- FORM NEW RECORD-->
<div class="container container-wrapper">
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