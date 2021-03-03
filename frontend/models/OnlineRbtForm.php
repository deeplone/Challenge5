<?php

namespace frontend\models;

use Yii;

/**
 * Class VoiceForm
 * @package common\models
 *
 * @property string $background
 */

class OnlineRbtForm extends \frontend\models\EnterpriseFile
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name', 'recording_content'], 'required'],
            [['accent', 'intonational'], 'required', 'message' => 'Chưa lựa chọn {attribute}.'],
            [['recording_content', 'name'], 'trim'],
            [['name'], 'string', 'length' => [0, 255],
                'tooShort' => 'Tên bài hát ít nhất phải chứa 0 ký tự!', 'tooLong' => 'Tên bài hát không được quá 255 ký tự'],
            ['name', 'match', 'pattern' => '/^[a-zA-Z0-9]+(?:\s[a-zA-Z0-9]+)*$/', 'message' => 'Tên bài hát là tiếng Việt không dấu và không bao gồm ký tự đặc biệt'],
            ['msisdn_pay', 'trim'],
            [['msisdn_pay'], 'match', 'pattern' => Yii::$app->params['viettel_phone_expression'],
                'message' => Yii::t('backend', 'Số điện thoại không đúng định dạng')],
            [['recording_file', 'msisdn_file', 'copyright_license'], 'safe'],
            [['recording_content'], 'string', 'length' => [550, 1200],
                'tooShort' => 'Nội dung ít nhất phải chứa 550 ký tự!', 'tooLong' => 'Nội dung dài nhất chỉ chứa 1200 ký tự!'],
            [['sound_background', 'relate_id'], 'integer'],
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
            'name' => 'Tên bài hát',
        ];
    }

}
