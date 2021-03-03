<?php


/* @var $this \yii\web\View */

use yii\helpers\Html;

/* @var \frontend\models\EprClass[] $allClass */

?>

<!---------- 04. Brand ---------->
<section class="mdl mdl-brand" id="page1">
    <div class="container">
        <!-- div.row>div.col-md-4*9>img.img-itm+div.overlay>span.mdi.mdi-play-circle+span.txt-1{Viettel ca}+a.text-reset>i.mdi.mdi-download -->
        <div class="row">
            <div class="col-md-12" style="text-align: justify;">
                <div class="ttl">
                    Danh sách lớp học
                </div>
            </div>

            <?php foreach ($allClass as $class): ?>
                <div class="col-xl-4 col-lg-4 col-md-6">
                    <!-- Single course -->
                    <div class="single-course mb-40">
                        <div class="course-img">
                            <a href="/epc-class/join-class?id=<?= $class->id ?>" class="text-reset text-decoration-none"><img src="https://preview.colorlib.com/theme/onlineedu/assets/img/gallery/popular_sub1.png" alt="">
                        </div>
                        <div class="course-caption">
                            <div class="course-cap-top">
                                <h4><a href="/epc-class/join-class?id=<?= $class->id ?>"><?= $class->name ?></a></h4>
                            </div>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
</section>