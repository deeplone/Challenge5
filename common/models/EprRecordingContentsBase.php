<?php

namespace common\models;

use Yii;

class EprRecordingContentsBase extends \common\models\db\EprRecordingContentsDB {
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'recording_content' => 'Nội dung mẫu',
            'created_at' => 'Tạo lúc',
            'created_by' => 'Người tạo',
            'updated_at' => 'Cập nhật lúc',
            'updated_by' => 'Người cập nhật',
        ];
    }
}