<!---------- 01. Navigator ---------->
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
                <li class="nav-item active">
                    <a class="nav-link" href="/">Trang chủ <span class="sr-only">(current)</span></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">Giới thiệu</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">Dịch vụ</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">Hướng dẫn</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">Điều khoản</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">Liên hệ</a>
                </li>
            </ul>
        </div>

        <?php
        if (!Yii::$app->user->isGuest) { ?>
            <div class="my-2 my-lg-0">
                <i class="fas fa-user-tie"></i>
                <div class="btn-group">
                        <span class="btn dropdown-toggle text-white" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <?php echo Yii::$app->user->getIdentity()->full_name ?>
                        </span>
                    <div class="dropdown-menu">
                        <a href="/user" class="dropdown-item">Thông tin cá nhân</a>
                        <a onclick="userResetPassword()" class="dropdown-item">Đổi mật khẩu</a>
                        <a href="/user" class="dropdown-item">Chi tiết thanh toán</a>
                        <a href="logout" class="dropdown-item">Đăng xuất</a>
                    </div>
                </div>
            </div>
        <?php } ?>

    </div>
</nav>

<div class="modal fade" id="changePasswordModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true"></div>