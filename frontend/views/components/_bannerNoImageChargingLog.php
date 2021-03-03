<?php
?>
<section class="mdl mdl-banner">
    <div class="item">
        <div class="container">

            <?php use yii\helpers\Url;

            if (Yii::$app->user->isGuest): ?>
            <button type="button" class="btn btn-banner rounded-pill" data-toggle="modal" data-target="#loginModal">
                Đăng nhập
            </button>
            <button type="button" class="btn btn-banner rounded-pill" data-toggle="modal" data-target="#signUpModal">
                Đăng ký
            </button>

            <?php endif; ?>
            <img src="/images/employee.png" alt="" srcset="" class="img-highlight">
        </div>
    </div>
</section>
