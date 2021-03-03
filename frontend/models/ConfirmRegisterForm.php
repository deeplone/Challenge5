<?php

namespace frontend\models;

use common\helpers\Helpers;
use common\helpers\SendMT;
use Yii;
use yii\base\Model;

/**
 * Confirm Register form
 *
 * @property string $otp
 * @property string $agree
 */
class ConfirmRegisterForm extends Enteprise
{
    public $otp;
    public $agree;
    public $re_password;

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return array_merge([
            ['agree', 'required', 'on' => 'create', 'message' => 'Bạn chưa đồng ý với các điều khoản của dịch vụ'],
            ['agree', 'in', 'range' => [1], 'message' => 'Bạn chưa đồng ý với các điều khoản của dịch vụ'],
            [['agree'], 'integer'],
            [['otp'], 'string'],
        ], parent::rules());
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return array_merge([
            'agree' => 'Tôi hoàn toàn đồng ý với điều khoản dịch vụ',
            'otp' => 'Mã xác nhận',
        ], parent::attributeLabels());
    }

    public function beforeValidate()
    {
        $this->msisdn = Helpers::convertMsisdn($this->msisdn);
        return parent::beforeValidate();
    }

    /**
     * Copy Data from RegisterForm to ConfirmRegisterForm
     * @param RegisterForm $registerForm
     */
    public function copyDataFromRegisterForm($registerForm)
    {
        $this->setAttributes($registerForm->attributes);
        $this->re_password = $registerForm->re_password;
    }

    public function register()
    {
        if (!$this->validate()) {
            return false;
        }
        $pass = $this->password;
        $this->status = self::STATUS_ACTIVE;
        $this->setPassword($this->password);
        $this->generateAuthKey();
        $this->generatePasswordResetToken();
        if ($this->save(false)) {
            $mtContent = str_replace('<#mk#>', $pass, \Yii::$app->params['dang_ky_tai_khoan']);
            return SendMT::sendMT($this->msisdn, $mtContent);
        }
        return true;
    }

    public function login()
    {
        Yii::$app->user->setIdentity(null);
        return Yii::$app->user->login($this);
    }
}
