<?php

namespace common\models\db;

use Yii;

/**
 * This is the model class for table "epr_otp".
 *
 * @property string $id ID
 * @property string $msisdn Số điện thoại
 * @property string $otp OTP
 * @property string $expired_time Hết hạn
 */
class OtpDB extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'epr_otp';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['msisdn', 'otp'], 'required'],
            [['expired_time'], 'safe'],
            [['msisdn'], 'string', 'max' => 15],
            [['otp'], 'string', 'max' => 8],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'msisdn' => 'Số điện thoại',
            'otp' => 'OTP',
            'expired_time' => 'Hết hạn',
        ];
    }
}
