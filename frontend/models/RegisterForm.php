<?php

namespace frontend\models;

use common\helpers\Helpers;
use common\helpers\SendMT;
use Yii;
use yii\base\Model;

/**
 * Confirm Register form
 *
 * @property string $re_password
 */
class RegisterForm extends Enteprise
{
    public $re_password;

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return array_merge([
            [['re_password'], 'required', 'message' => Yii::t('backend', 'Mật khẩu gõ lại chưa đúng')],
            [['re_password'], 'compare', 'compareAttribute' => 'password', 'message' => Yii::t('backend', 'Mật khẩu gõ lại chưa đúng')],
            [['re_password'], 'match', 'pattern' => Yii::$app->params['password_regex'],
                'message' => Yii::t('backend', 'Mật khẩu phải từ 6-20 ký tự và bao gồm chữ thường, chữ HOA, số và ký tự đặc biệt(!@#$%^&*)')],
        ], parent::rules());
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return array_merge([
            're_password' => 'Gõ lại mật khẩu',
        ], parent::attributeLabels());
    }

    public function beforeValidate()
    {
        $this->msisdn = Helpers::convertMsisdn($this->msisdn);
        return parent::beforeValidate();
    }

    /**
     * Copy Data from ConfirmRegisterForm to RegisterForm
     * @param ConfirmRegisterForm $registerForm
     */
    public function copyDataFromConfirmRegisterForm($registerForm) {
        $this->setAttributes($registerForm->attributes);
    }

    public function register()
    {
        $pass = $this->password;
        $this->status = self::STATUS_ACTIVE;
        $this->setPassword($this->password);
        $this->generateAuthKey();
        $this->generatePasswordResetToken();
        $this->type = 1;
        $this->save(false);
        return true;
    }

    public function login()
    {
        Yii::$app->user->setIdentity(null);
        return Yii::$app->user->login($this);
    }
}
