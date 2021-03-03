<?php

namespace frontend\models;

use Yii;

/**
 * Class VoiceForm
 * @package common\models
 *
 * @property string $background
 */

class UploadRbtForm extends \frontend\models\EnterpriseFile
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name'], 'required'],
            [['name'], 'string'],
            [['name'], 'trim'],
            [['name'], 'string', 'length' => [0, 255],
                'tooShort' => 'Tên bài hát ít nhất phải chứa 0 ký tự!', 'tooLong' => 'Tên bài hát không được quá 255 ký tự'],
            ['name', 'match', 'pattern' => '/^[a-zA-Z0-9]+(?:\s[a-zA-Z0-9]+)*$/', 'message' => 'Tên bài hát là tiếng Việt không dấu và không bao gồm ký tự đặc biệt'],
            ['msisdn_pay', 'trim'],
            [['msisdn_pay'], 'match', 'pattern' => Yii::$app->params['viettel_phone_expression'],
                'message' => Yii::t('backend', 'Số điện thoại không đúng định dạng')],
            [['recording_file', 'msisdn_file', 'copyright_license'], 'safe'],
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
