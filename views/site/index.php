<?php

/* @var $this yii\web\View */

$this->title = 'Mini-blog | Все записи';
?>

<!-- LIST ALL RECORDS-->
<div id="all-records">

        <!-- RECORD-->
        <div class="container">
            <strong><p>anon (<span>2016-09-20 11:23:45</span>)</p></strong>
            <p class="record-text">some post </p>
            <a href="<?= Yii::$app->urlManager->createUrl(['site/record-id']) ?>" class="comments-link>
                <p class="comments">Коментариев <span class="badge">1</span></p>
            </a>
            <a href="<?= Yii::$app->urlManager->createUrl(['site/record-id']) ?>" class="pull-right">
                Читать полностью
            </a>

        </div>
        <!-- END RECORD-->

</div>
<!-- END LIST ALL RECORDS-->
