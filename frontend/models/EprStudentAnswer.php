<?php

namespace frontend\models;

use Yii;
use yii\web\UploadedFile;

class EprStudentAnswer extends \common\models\EprStudentAnswerBase
{
    public function upload($field, $file, $ext = ['pdf', 'png', 'jpg', 'docx'], $maxSize = 100)
    {

        if ($file['name']) {
            $fileUpload = new UploadedFile();
            $fileUpload->name = $file['name'];
            $fileUpload->tempName = $file['tmp_name'];
            $fileUpload->type = $file['type'];
            $fileUpload->size = $file['size'];
            $fileUpload->error = $file['error'];
            //$this->$field = $fileUpload;
            if (in_array(strtolower($fileUpload->extension), $ext)) {
                if ($fileUpload->size <= ($maxSize * 1024 * 1024)) {
                    $dir = Yii::getAlias('@frontend_upload');
                    $file = '/docs/' . \common\helpers\Helpers::generateStructurePath();
                    if (!is_dir($dir . $file)) {
                        mkdir($dir . $file, 0777, true);
                    }
                    $fileName = $file . uniqid() . '.' . $fileUpload->extension;
                    $fileUpload->saveAs($dir . $fileName);
                    $this->$field = $fileName;
                    return $fileName;
                } else {
                    return $this->addError($field, 'File quá lớn (' . $maxSize . 'MB).');
                }
            } else {
                return $this->addError($field, 'File không đúng định dạng (pdf, png, jpg).');
            }
        }
        return $this->$field;
    }

    public static function checkAnswerUploaded($user_id, $exec_id) {
        $res = false;
        $query = EprStudentAnswer::find()
            ->where(["exercise_id" => $exec_id])
            ->andFilterWhere(["student_id" => $user_id])
            ->all();
        if($query) {
            $res = true;
        }
        return $res;
    }
}