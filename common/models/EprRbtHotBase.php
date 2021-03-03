<?php

namespace common\models;

use Yii;
use yii\helpers\Html;

class EprRbtHotBase extends \common\models\db\EprRbtHotDB {

    /**
     * {@inheritdoc}
     */
    public function rules() {
        return [
            [['name', 'audio_path', 'img_path'], 'required'],
            [['created_by', 'updated_by'], 'integer'],
            [['created_at', 'updated_at'], 'safe'],
            [['name'], 'string', 'max' => 255],
            [['rbt_code'], 'string', 'max' => 20],
            [['name', 'rbt_code'], 'trim'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels() {
        return [
            'id' => 'ID',
            'name' => 'Tên doanh nghiệp',
            'audio_path' => 'File nhạc',
            'img_path' => 'Ảnh',
            'rbt_code' => 'Mã nhạc chờ',
            'created_at' => 'Tạo lúc',
            'created_by' => 'Người tạo',
            'updated_at' => 'Cập nhật lúc',
            'updated_by' => 'Cập nhật bởi',
        ];
    }

    public function getImage() {
        return Html::img(MEDIA_PATH . $this->img_path, ['class' => 'rbt-hot-img']);
    }

    public function getImagePath() {
        return MEDIA_PATH . $this->img_path;
    }

    public function getAudioPath() {
        return MEDIA_PATH . $this->audio_path;
    }

    public function getAudio() {
        return '<audio controls><source src="' . MEDIA_PATH . $this->audio_path . '"></audio>';
    }

}
