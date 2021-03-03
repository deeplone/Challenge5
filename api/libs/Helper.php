<?php

namespace api\libs;

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class Helper {

    public static function verifyMp3($file) {
        $fileUpload = new \yii\web\UploadedFile();
        $fileUpload->name = $file['name'];
        $fileUpload->tempName = $file['tmp_name'];
        $fileUpload->type = $file['type'];
        $fileUpload->size = $file['size'];
        $fileUpload->error = $file['error'];

        $mp3file = new \common\libs\MP3File($fileUpload->tempName);
        $duration = $mp3file->getDuration();
        if ($duration >= 30 && $duration <= 43) {
            return true;
        }

        return false;
    }

}
