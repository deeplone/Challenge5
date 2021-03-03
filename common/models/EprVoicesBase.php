<?php

namespace common\models;

use Yii;

class EprVoicesBase extends \common\models\db\EprVoicesDB {

    /**
     * {@inheritdoc}
     */
    public function attributeLabels() {
        return [
            'id' => 'ID',
            'name' => 'Tên',
            'description' => 'Mô tả',
            'code' => 'Code',
            'path' => 'File',
            'content' => 'Nội dung giọng đọc mẫu',
            'priority' => 'Vị trí',
        ];
    }

    public function getFile() {
        if ($this->path) {
            return '/uploads' . $this->path;
        }
        return '';
    }

    public function audio() {
        return '<audio controls><source src="' . $this->getFile() . '"></audio>';
    }

}
