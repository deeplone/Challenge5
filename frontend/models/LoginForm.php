<?php

namespace frontend\models;

use Yii;
use yii\base\Model;

/**
 * Login form
 */
class LoginForm extends Model {

    public $msisdn;
    public $password;
    public $rememberMe = true;
    private $_user;

    /**
     * {@inheritdoc}
     */
    public function rules() {
        return [
            // msisdn and password are both required
            [['msisdn', 'password'], 'required'],
            // rememberMe must be a boolean value
            ['rememberMe', 'boolean'],
            // password is validated by validatePassword()
            ['password', 'validatePassword'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels() {
        return [
            'msisdn' => 'Số điện thoại',
            'password' => 'Mật khẩu',
        ];
    }

    /**
     * Validates the password.
     * This method serves as the inline validation for password.
     *
     * @param string $attribute the attribute currently being validated
     * @param array $params the additional name-value pairs given in the rule
     */
    public function validatePassword($attribute, $params) {
        if (!$this->hasErrors()) {
            $user = $this->getUser();
            if (!$user || !$user->validatePassword($this->password)) {
                $this->addError($attribute, 'Số điện thoại hoặc mật khẩu không đúng!');
            }
        }
    }

    /**
     * Logs in a user using the provided username and password.
     *
     * @return bool whether the user is logged in successfully
     */
    public function login() {
        if ($this->validate()) {
            \Yii::$app->user->setIdentity(null);
            return Yii::$app->user->login($this->getUser(), $this->rememberMe ? LOGIN_TIMEOUT : 0);

        }

        return false;
    }

    /**
     * Finds user by [[username]]
     *
     * @return User|null
     */
    protected function getUser() {
        if ($this->_user === null) {
            $this->_user = Enteprise::findByMsisdn($this->msisdn);
        }

        return $this->_user;
    }

}
