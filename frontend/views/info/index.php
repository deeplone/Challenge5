<?php



/* @var $this \yii\web\View */
/* @var $info \frontend\models\EprInfo|mixed|null */



?>

<section class="mdl mdl-customer" data-sr-id="0" style="padding-top:20px; min-height: 735px; background-color: white !important; visibility: visible; opacity: 1; transition: opacity 0.6s cubic-bezier(0.5, 0, 0, 1) 0.4s;">
    <div class="container">
        <div class="row">
            <div class="col-md-12 info-content">
                <?= $info->content; ?>
            </div>
        </div>
    </div>
</section>