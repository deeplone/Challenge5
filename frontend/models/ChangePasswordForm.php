<?php

namespace frontend\models;

use Yii;
use yii\base\Model;

/**
 * Login form
 */
class ChangePasswordForm extends Model {

    public $old_password;
    public $password;
    public $re_password;

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return array_merge([
            [['re_password', 'password', 'old_password'], 'required'],
            [['old_password'], 'string'],
            ['password', 'comparePasswords', 'message' => Yii::t('frontend', 'Mật khẩu mới không được giống mật khẩu cũ')],
            ['password', 'string', 'length' => [6, 20], 'tooShort' =>'Mật khẩu phải từ 6-20 ký tự và bao gồm chữ thường, chữ HOA, số và ký tự đặc biệt(!@#$%^&*).',
                'tooLong' =>'Mật khẩu phải từ 6-20 ký tự và bao gồm chữ thường, chữ HOA, số và ký tự đặc biệt(!@#$%^&*).'],
            [['re_password'], 'compare', 'compareAttribute' => 'password', 'message' => Yii::t('backend', 'Mật khẩu gõ lại chưa đúng')],
            [['re_password', 'password'], 'match', 'pattern' => Yii::$app->params['password_regex'],
                'message' => Yii::t('backend', 'Mật khẩu phải từ 6-20 ký tự và bao gồm chữ thường, chữ HOA, số và ký tự đặc biệt(!@#$%^&*)')],
        ], parent::rules());
    }

    public function comparePasswords($attribute)
    {
        if ($this->password === $this->old_password) {
            $this->addError($attribute, 'Mật khẩu mới không được giống mật khẩu cũ');
        }
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'old_password' => 'Mật khẩu cũ',
            'password' => 'Mật khẩu',
            're_password' => 'Nhập lại mật khẩu',
        ];
    }
}
