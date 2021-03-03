<?php

use common\helpers\Helpers;
use yii\helpers\Url;
use yii\helpers\Html;

$currentRoute = Yii::$app->controller->getRoute();
$checked = false;

?>
<nav class="navbar navbar-expand-lg fixed-top">
    <div class="container">
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent">
        <span class="navbar-toggler-icon">
          <svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" viewBox="0 0 30 30" role="img"
               focusable="false">
            <title>Menu</title>
            <path stroke="currentColor" stroke-linecap="round" stroke-miterlimit="10" stroke-width="2"
                  d="M4 7h22M4 15h22M4 23h22"></path>
          </svg>
        </span>
        </button>
        <a class="navbar-brand" href="/">

        </a>
        <div class="collapse navbar-collapse justify-content-end" id="navbarSupportedContent">
            <ul class="navbar-nav">
                <li class="nav-item <?= Helpers::checkInfoUrl($currentRoute, 'home/index', null, $checked) ? 'active' : '' ?>">
                    <a class="nav-link" href="<?= Url::toRoute(['home/index']); ?>">Trang
                        chủ
                    </a>
                </li>
            </ul>
        </div>

        <?php if (!Yii::$app->user->isGuest): ?>
            <div class="my-2 my-lg-0">
                <div class="btn-group">
                    <span class="btn dropdown-toggle text-white" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" tabindex="0" role="button">
            <i class="fas fa-user"></i>
            <span title="<?= Html::encode(Yii::$app->user->getIdentity()->full_name) ?>" class="txt"><?= strlen(Html::encode(Yii::$app->user->getIdentity()->full_name)) >  20 ? mb_substr(Html::encode(Yii::$app->user->getIdentity()->full_name),0,17) . "...": Html::encode(Yii::$app->user->getIdentity()->full_name); ?></span>
          </span>
                    <div class="dropdown-menu">
                        <a class="dropdown-item" tabindex="0" data-toggle="modal" data-target="#changePasswordModal">Đổi mật
                            khẩu</a>
<!--                        <a href="--><?//= Url::toRoute(['user/index']) ?><!--" class="dropdown-item">Chi tiết thanh toán</a>-->
                        <a href="<?= Url::toRoute(['user/logout']) ?>" class="dropdown-item">Đăng xuất</a>
                    </div>
                </div>
            </div>
        <?php endif; ?>
    </div>
</nav>