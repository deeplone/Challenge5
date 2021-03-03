<?php

namespace common\models;

use Yii;

/**
 * Class VoiceForm
 * @package common\models
 *
 * @property string $background
 */

class VoiceForm extends \common\models\EnterpriseFileBase
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name', 'accent', 'intonational', 'recording_content'], 'required'],
            [['recording_content'], 'trim'],
            [['name'], 'string'],
            [['recording_file', 'msisdn_file', 'copyright_license'], 'safe'],
            [['recording_content'], 'string', 'length' => [550, 1200],
                'tooShort' => 'Nội dung ít nhất phải chứa 550 ký tự!', 'tooLong' => 'Nội dung dài nhất chỉ chứa 1200 ký tự!'],
//            [['recording_content'], 'checkLength'],
            [['sound_background'], 'integer'],
            [['accent'], 'in', 'range' => \backend\models\EprVoices::find()->select('id')->column(), 'message' => '{attribute} không tồn tại.'],
            [['intonational'], 'in', 'range' => ["0.7", "0.8", "0.9", "1.0", "1.1", "1.2", "1.3"], 'message' => '{attribute} không tồn tại.'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'accent' => 'Giọng đọc',
            'intonational' => 'Tốc độ đọc',
            'recording_content' => 'Nội dung thu âm',
            'background' => 'Nhạc nền',
        ];
    }

}
