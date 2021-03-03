<?php
/* @var $this View */
/* @var $content string */

use frontend\assets\AppAsset;
use yii\helpers\Html;
use yii\web\View;

AppAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="description" content="">
    <meta name="keyword" content="">
    <meta name="format-detection" content="telephone=no">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <link href="/_images/icon.ico" rel="Shortcut Icon" type="image/x-icon" />
    <link href="/_images/viettel-touch-icon.png" rel="apple-touch-icon" type="image/png" />
    <?= Html::csrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
    <?php echo $this->render('_ga', array()); ?>
</head>

<body style="background-color: #cccccc">
    <?php $this->beginBody() ?>
    <!---------- 01. Navigation bar ---------->
    <?php echo $this->render('_header'); ?>
    <!---------- 01. Intro ---------->
    <section class="mdl-intro">
        <?php if (Yii::$app->session->has('success')) { ?>
            <div class="alert alert-success alert-dismissible fade show" role="alert" id="error-message">
                <?php echo Yii::$app->session->getFlash('success'); ?>
                <?php Yii::$app->session->removeAllFlashes(); ?>
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        <?php } ?>
        <?php if (Yii::$app->session->has('error')) { ?>
            <div class="alert alert-error alert-dismissible fade show" role="alert" id="error-message">
                <?php echo Yii::$app->session->getFlash('error'); ?>
                <?php Yii::$app->session->removeAllFlashes(); ?>
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        <?php } ?>
        <?php if (Yii::$app->session->has('info')) { ?>
            <div class="alert alert-info alert-dismissible fade show" role="alert" id="error-message">
                <?php echo Yii::$app->session->getFlash('info'); ?>
                <?php Yii::$app->session->removeAllFlashes(); ?>
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        <?php } ?>
        <div class="content">
            <?= $content; ?>
        </div>
    </section>
    <?php echo $this->render('_footer'); ?>
    <script>
        // Example starter JavaScript for disabling form submissions if there are invalid fields
        (function() {
            'use strict';
            window.addEventListener('load', function() {
                // Fetch all the forms we want to apply custom Bootstrap validation styles to
                var forms = document.getElementsByClassName('needs-validation');
                // Loop over them and prevent submission
                var validation = Array.prototype.filter.call(forms, function(form) {
                    form.addEventListener('submit', function(event) {
                        if (form.checkValidity() === false) {
                            event.preventDefault();
                            event.stopPropagation();
                        }
                        form.classList.add('was-validated');
                    }, false);
                });
            }, false);
        })();
    </script>
    <?php $this->endBody() ?>
</body>

</html>
<?php $this->endPage() ?>