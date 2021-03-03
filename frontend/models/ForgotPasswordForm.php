<?php

namespace frontend\models;

use Yii;
use yii\base\Model;

/**
 * Login form
 */
class ForgotPasswordForm extends Model {

    public $msisdn;
    public $captcha;

    /**
     * {@inheritdoc}
     */
    public function rules() {
        return [
            // msisdn and password are both required
            [['msisdn'], 'required'],
            [['msisdn'], 'trim'],
            ['captcha', 'captcha', 'message' => 'Mã xác thực không đúng'],
            ['msisdn', 'checkMsisdn', 'message' => Yii::t('frontend', 'Tài khoản không tồn tại')],
            [['msisdn'], 'match', 'pattern' => Yii::$app->params['viettel_phone_expression'],
                'message' => Yii::t('backend', 'Số điện thoại không đúng định dạng')],
        ];
    }

    public function checkMsisdn($attribute)
    {
        if (!Enteprise::findOne(['msisdn' => \common\helpers\Helpers::convertMsisdn($this->msisdn)])) {
            $this->addError($attribute, 'Tài khoản không tồn tại');
        }
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels() {
        return [
            'msisdn' => 'Số điện thoại',
            'captcha' => 'Mã xác thực',
        ];
    }
}
