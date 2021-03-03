<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <title>NHẠC CHỜ DOANH NGHIỆP</title>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="description" content="">
    <meta name="keyword" content="">
    <meta name="format-detection" content="telephone=no">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <link href="_images/icon.ico" rel="Shortcut Icon" type="image/x-icon" />
    <link href="_images/viettel-touch-icon.png" rel="apple-touch-icon" type="image/png" />
    <!--////////// Vendor CSS \\\\\\\\\\-->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.9.0/slick.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.9.0/slick-theme.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.carousel.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.theme.green.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.9.0/css/all.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/3.7.2/animate.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/hover.css/2.3.1/css/hover-min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/pretty-checkbox@3.0/dist/pretty-checkbox.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/MaterialDesign-Webfont/4.0.96/css/materialdesignicons.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Maven+Pro:400,500,700,900&display=swap&subset=vietnamese">
    <!--////////// Native CSS \\\\\\\\\\-->
    <link href="css/style.css" rel="stylesheet">
    <?php echo $this->render('_ga', array()); ?>

    
</head>

<body>
    <!---------- 01. Navigation bar ---------->
    <?php echo $this->render('_header'); ?>

    <div>
        <?= $content; ?>
    </div>

    <!---------- 09. Copyright ---------->
    <section class="mdl mdl-copyright">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <p>Cơ quan chủ quản: Tổng công ty viễn thông Viettel (Viettel Telecom) – Chi nhánh Tập đoàn Công nghiệp – Viễn thông Quân đội. <span class="float-right">Copyright © Imuzik.</span></p>
                    <p>Giấy phép MXH số 67/GP-BTTT cấp ngày 05/02/2016.</p>
                </div>
            </div>
        </div>
    </section>


    <div id="1@#%^-bottom" class="up-to-top"><a href="#top"><i class="mdi mdi-chevron-up-box"></i></a></div>

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
</body>

</html>