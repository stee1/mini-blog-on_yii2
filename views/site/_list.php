<?php
use yii\helpers\Html;

?>

<strong><p><?= Html::encode("{$model->author}"); ?> (<span><?= Html::encode("{$model->date}"); ?></span>)
    </p></strong>

<p class="record-text"><?= Html::encode("{$model->trimmed_text}"); ?> </p>
<a href="<?= Yii::$app->urlManager->createUrl(['site/record', 'id' => $model->id]) ?>" class="comments-link">
    <p class="comments">Коментариев <span class="badge"><?= Html::encode("{$model->comments_count}"); ?></span></p>
</a>
<a href="<?= Yii::$app->urlManager->createUrl(['site/record', 'id' => $model->id]) ?>" class="pull-right">
    Читать полностью
</a>