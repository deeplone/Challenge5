<?php

namespace frontend\models;

use Yii;
use yii\base\Model;

/**
 * Login form
 */
class ForgotPasswordOtpForm extends Model
{
    public $msisdn;
    public $otp;
    public $password;
    public $re_password;

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            // msisdn and password are both required
            [['msisdn'], 'required'],
            [['msisdn'], 'trim'],
            [['msisdn'], 'match', 'pattern' => Yii::$app->params['viettel_phone_expression'],
                'message' => Yii::t('backend', 'Số điện thoại không đúng định dạng')],
            [['otp'], 'required'],
            [['otp'], 'string'],
            [['password'], 'required', 'message' => Yii::t('backend', 'Mật khẩu phải từ 6-20 ký tự và bao gồm chữ thường, chữ HOA, số và ký tự đặc biệt(!@#$%^&*)')],
            ['password', 'comparePasswords', 'message' => Yii::t('frontend', 'Mật khẩu mới không được giống mật khẩu cũ')],
            ['password', 'string', 'length' => [6, 20], 'tooShort' =>'Mật khẩu phải từ 6-20 ký tự và bao gồm chữ thường, chữ HOA, số và ký tự đặc biệt(!@#$%^&*).',
                'tooLong' =>'Mật khẩu phải từ 6-20 ký tự và bao gồm chữ thường, chữ HOA, số và ký tự đặc biệt(!@#$%^&*).'],
            [['password'], 'match', 'pattern' => Yii::$app->params['password_regex'],
                'message' => Yii::t('backend', 'Mật khẩu phải từ 6-20 ký tự và bao gồm chữ thường, chữ HOA, số và ký tự đặc biệt(!@#$%^&*)')],
            [['re_password'], 'required', 'message' => Yii::t('backend', 'Mật khẩu gõ lại chưa đúng')],
            [['re_password'], 'compare', 'compareAttribute' => 'password', 'message' => Yii::t('backend', 'Mật khẩu gõ lại chưa đúng')],
            [['re_password', 'password'], 'match', 'pattern' => Yii::$app->params['password_regex'],
                'message' => Yii::t('backend', 'Mật khẩu phải từ 6-20 ký tự và bao gồm chữ thường, chữ HOA, số và ký tự đặc biệt(!@#$%^&*)')],
        ];
    }

    public function comparePasswords($attribute)
    {
        $user = Enteprise::findByMsisdn($this->msisdn);
        if ($user->generatePasswordHash($this->password) === $user->password) {
            $this->addError($attribute, 'Mật khẩu mới không được giống mật khẩu cũ');
        }
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'msisdn' => 'Số điện thoại',
            'password' => 'Mật khẩu',
            're_password' => 'Nhập lại mật khẩu',
        ];
    }

}
