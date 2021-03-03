<?php

namespace frontend\models;

use yii\base\Model;

/**
 * Confirm Register form
 *
 * @property string $otp
 */
class OtpConfirmForm extends Model
{
    public $otp;

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return array_merge([
            [['otp'], 'string'],
            [['otp'], 'required', 'message' => 'Bạn chưa nhập OTP'],
        ], parent::rules());
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return array_merge([
            'otp' => 'Mã xác nhận',
        ], parent::attributeLabels());
    }
}
