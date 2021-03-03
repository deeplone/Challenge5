<?php


/* @var $this \yii\web\View */
/* @var $class \frontend\models\EprClass */
/* @var $user */

/* @var \frontend\models\EprExercise[] $exces */


use yii\helpers\Url;
use yii\widgets\ActiveForm;
use \frontend\models\EprStudentAnswer;

?>


<section class="mdl mdl-recording" xmlns="http://www.w3.org/1999/html">
    <p>Tên lớp học: <?= $class->name ?></p>
    <p>Tên giáo viên: </p>
    <?php if ($user["type"] == 1) { ?>
        <div class="btn-excercise-upload">
            <a href="/epc-class/excersice-upload" class="play">Upload bài tập</a>
        </div>
    <?php } ?>
    <div class="col-md-12">
        <ul class="list-unstyled tutorial-section-list">
            <?php foreach ($exces as $exce): ?>
                <li>
                    <h3><?= $exce->name ?></h3>
                    <p>
                        <span class="mr-2 mb-2">1hr 24m</span>
                    </p>
                    <a style="margin-right: 75px" href="<?= $exce->path ?>" class="play" download>Download</a>
                    <?php if ($user["type"] == 2 && !EprStudentAnswer::checkAnswerUploaded($user["id"], $exce->id)) { ?>
                        <div id="upload-answer-<?= $exce->id ?>">
                            <input id="exce-id" value="<?= $exce->id ?>" type="hidden">
                            <input type="file" id="file" name="file"/>
                            <input type="button" class="button" value="Upload" id="but_upload"
                                   onclick="uploadAns(this)">
                        </div>
                    <?php } ?>
                </li>
            <?php endforeach; ?>

        </ul>
    </div>
</section>
