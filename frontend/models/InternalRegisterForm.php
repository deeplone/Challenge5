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
class InternalRegisterForm extends Enteprise
{
    public $re_password;

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['email', 'msisdn', 'id_number'], 'required'],
            [['password'], 'required', 'message' => Yii::t('backend', 'Mật khẩu phải từ 6-20 ký tự và bao gồm chữ thường, chữ HOA, số và ký tự đặc biệt(!@#$%^&*)')],
            [['updated_by'], 'integer'],
            [['id_number'], 'trim'],
            [['created_at', 'updated_at', 'full_name'], 'safe'],
            [['password_reset_token'], 'string', 'max' => 255, 'message' => Yii::t('backend', '{attribute} không được vượt quá 255 ký tự.')],
            ['password', 'string', 'length' => [6, 20], 'tooShort' => 'Mật khẩu phải từ 6-20 ký tự và bao gồm chữ thường, chữ HOA, số và ký tự đặc biệt(!@#$%^&*)',
                'tooLong' => 'Mật khẩu phải từ 6-20 ký tự và bao gồm chữ thường, chữ HOA, số và ký tự đặc biệt(!@#$%^&*)'],
            [['id_number'], 'string', 'length' => [6, 32], 'tooShort' => Yii::t('backend', 'Username phải từ 6-32 ký tự.'),
                'tooLong' => Yii::t('backend', 'UUsername phải từ 6-32 ký tự.')],
            ['status', 'in', 'range' => [self::STATUS_ACTIVE, self::STATUS_DELETED]],
            [['email', 'full_name', 'msisdn', 'id_number'], 'trim'],
            ['email', 'string', 'length' => [6, 255], 'tooShort' => 'Email phải có ít nhất 6 ký tự.', 'tooLong' => 'Email không được vượt quá 255 ký tự.'],
            [['email'], 'email', 'message' => 'Email không hợp lệ. Email phải từ 6 ký tự và không quá 64 ký tự trước dấu @.'],
            [['auth_key'], 'string', 'max' => 32],
            [['msisdn'], 'match', 'pattern' => Yii::$app->params['viettel_phone_expression'],
                'message' => Yii::t('backend', 'Số điện thoại không đúng định dạng')],
            [['password'], 'match', 'pattern' => Yii::$app->params['password_regex'],
                'message' => Yii::t('backend', 'Mật khẩu phải từ 6-20 ký tự và bao gồm chữ thường, chữ HOA, số và ký tự đặc biệt(!@#$%^&*)')],
            [['re_password'], 'required', 'message' => Yii::t('backend', 'Mật khẩu gõ lại chưa đúng')],
            [['re_password'], 'compare', 'compareAttribute' => 'password', 'message' => Yii::t('backend', 'Mật khẩu gõ lại chưa đúng')],
            [['re_password'], 'match', 'pattern' => Yii::$app->params['password_regex'],
                'message' => Yii::t('backend', 'Mật khẩu phải từ 6-20 ký tự và bao gồm chữ thường, chữ HOA, số và ký tự đặc biệt(!@#$%^&*)')],
            [['id_number'], 'unique', 'message' => 'Username đã được sử dụng.'],
            [['msisdn'], 'unique', 'message' => 'Số điện thoại đã được sử dụng. Vui lòng chọn số điện thoại khác.'],
            [['email'], 'unique', 'message' => 'Email đã được sử dụng.'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return array_merge([
            're_password' => 'Gõ lại mật khẩu',
            'id_number' => 'Username',
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
    public function copyDataFromConfirmRegisterForm($registerForm)
    {
        $this->setAttributes($registerForm->attributes);
    }

    public function register()
    {
        $pass = $this->password;
        $this->status = self::STATUS_ACTIVE;
        $this->setPassword($this->password);
        $this->generateAuthKey();
        $this->generatePasswordResetToken();
        $this->type = 2;
        $this->save(false);
        return true;
    }

    public function login()
    {
        Yii::$app->user->setIdentity(null);
        return Yii::$app->user->login($this);
    }
}
