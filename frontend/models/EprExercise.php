<?php

namespace frontend\models;

use Yii;
use yii\web\UploadedFile;

class EprExercise extends \common\models\EprExerciseBase {
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['class_id', 'teacher_id'], 'integer'],
            [['path', 'name'], 'string', 'max' => 255],
        ];
    }

    public static function getExerciseByClassId($classId)
    {
        $data = EprExercise::find()
            ->where(["class_id" => $classId])
            ->orderBy("id")
            ->all();
        return $data;
    }

    public static function getExerciseById($exe_iod)
    {
        $data = EprExercise::findOne($exe_iod);
        return $data;
    }

    public function upload($field, $file, $ext = ['pdf', 'png', 'jpg', 'docx'], $maxSize = 100)
    {
        if ($file['name'][$field]) {
            $fileUpload = new UploadedFile();
            $fileUpload->name = $file['name'][$field];
            $fileUpload->tempName = $file['tmp_name'][$field];
            $fileUpload->type = $file['type'][$field];
            $fileUpload->size = $file['size'][$field];
            $fileUpload->error = $file['error'][$field];
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


}