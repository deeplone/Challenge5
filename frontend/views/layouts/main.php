<?php
/* @var $this View */

/* @var $content string */

use frontend\assets\AppAsset;
use yii\helpers\Html;
use yii\web\View;

AppAsset::register($this);
?>
<?php $this->beginPage(); ?>
    <!DOCTYPE html>
    <html>
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="description" content="">
        <meta name="keyword" content="">
        <meta name="viewport"
              content="width=device-width, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0, user-scalable=no">

        <link href="/images/icon.ico" rel="Shortcut Icon" type="image/x-icon"/>
        <link href="/images/viettel-touch-icon.png" rel="apple-touch-icon" type="image/png"/>

        <?= Html::csrfMetaTags() ?>
        <title><?= Html::encode($this->title) ?></title>
        <?php $this->head() ?>
        <?= $this->render('_ga', array()); ?>
    </head>

    <body>
    <?php $this->beginBody() ?>
        <!---------- 01. Navigator ---------->
        <?= $this->render('/components/_header'); ?>
        <!---------- 02. Banner ---------->
        <?= $this->render('/components/_banner'); ?>
        <!---------- CONTENTS ---------->
        <?= $content; ?>
        <!---------- 14. Copyright ---------->
        <?= $this->render('/components/_footer'); ?>
        <!---------- 15. Popup ---------->
        <?= $this->render('/components/_popup'); ?>
        <?= $this->render('/components/_popupCommon'); ?>
    <?php $this->endBody() ?>
    </body>
    </html>
<?php $this->endPage() ?>