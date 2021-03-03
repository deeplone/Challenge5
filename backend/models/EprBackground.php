<?php

namespace backend\models;

use Yii;

class EprBackground extends \common\models\EprBackgroundBase {

    /**
     * {@inheritdoc}
     */
    public function rules() {
        return [
            [['name', 'path'], 'required'],
            [['name'], 'string', 'max' => 255],
            [['path'], 'file', 'extensions' => 'mp3', 'message' => 'File không đúng định dạng mp3'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels() {
        return [
            'id' => 'ID',
            'name' => 'Tên',
            'path' => 'File',
        ];
    }

}
