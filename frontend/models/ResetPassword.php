<?php

namespace frontend\models;

use yii\base\Model;

/**
 * Password reset
 */
class ResetPassword extends Model {

    public $captcha;
    public $msisdn;
    public $password;
    public $new_password;
    public $re_password;

    /**
     * @var \frontend\models\Enteprise
     */
    private $_user;

    public function __construct($config = []) {
        $this->_user = \Yii::$app->user->identity;
        $this->msisdn = $this->_user->msisdn;
        parent::__construct($config);
    }

    /**
     * {@inheritdoc}
     */
    public function rules() {
        return [
            [['password', 'new_password', 're_password', 'captcha'], 'required'],
            [['password', 'new_password', 're_password', 'captcha'], 'trim'],
            ['captcha', 'captcha', 'message' => 'Mã xác thực không đúng'],
            [['re_password'], 'compare', 'compareAttribute' => 'new_password', 'message' => \Yii::t('backend', 'Mật khẩu gõ lại chưa đúng')],
            [['new_password'], 'match', 'pattern' => '((?=.*\d)(?=.*[a-z])(?=.*[A-Z])(?=.*[@#$%]).{6,20})',
                'message' => \Yii::t('backend', 'Mật khẩu phải từ 6-20 ký tự và bao gồm chữ và số')],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels() {
        return [
            'password' => 'Mật khẩu cũ',
            'new_password' => 'Mật khẩu mới',
            're_password' => 'Gõ lại mật khẩu',
            'captcha' => 'Mã xác thực',
        ];
    }

    /**
     * Resets password.
     *
     * @return bool if password was reset.
     */
    public function resetPassword() {
        $user = $this->getUser();
        $this->msisdn = $user->msisdn;
        if ($user->password != $user->generatePasswordHash(trim($this->new_password))) {
            if ($user->password == $user->generatePasswordHash(trim($this->password))) {
                $user->setPassword(trim($this->new_password));
                $user->generateAuthKey();
                $user->generatePasswordResetToken();

                return $user->save(false);
            } else {
                $this->addError('password', 'Mật khẩu cũ không đúng!');
            }
        } else {
            $this->addError('new_password', 'Mật khẩu mới không được trùng với mật khẩu cũ!');
        }

        return false;
    }

    /**
     * Finds user by [[username]]
     *
     * @return User|null
     */
    protected function getUser() {
        $this->_user = Enteprise::findByMsisdn($this->msisdn);

        return $this->_user;
    }

}
