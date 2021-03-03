<?php

namespace frontend\models;

use Yii;

class CreateUser extends \frontend\models\Enteprise {

    public $otp;
    public $captcha;

    /**
     * {@inheritdoc}
     */
    public function rules() {
        return [
            [['msisdn', 'captcha'], 'required'],
            [['otp'], 'string'],
            // [['msisdn'], 'unique'],
            ['captcha', 'captcha', 'message' => 'Mã xác thực không đúng'],
            [['msisdn'], 'match', 'pattern' => Yii::$app->params['viettel_phone_expression'],
                'message' => Yii::t('backend', 'Số điện thoại không đúng định dạng')],
            // [['msisdn'], 'in', 'range' => Enteprise::find()->select(['msisdn'])->column(), 'message' => 'Tài khoản không tồn tại!'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels() {
        return [
            'msisdn' => 'Số điện thoại',
            'otp' => 'Mã xác nhận',
            'captcha' => 'Mã xác thực',
        ];
    }

}
