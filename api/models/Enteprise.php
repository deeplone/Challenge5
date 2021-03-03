<?php

namespace api\models;

use Yii;
use yii\base\NotSupportedException;

class Enteprise extends \common\models\EntepriseBase {

    /**
     * @inheritdoc
     */
    public function behaviors() {
        return [
            [
                'class' => \yii\behaviors\TimestampBehavior::className(),
                'createdAtAttribute' => 'created_at',
                'updatedAtAttribute' => 'updated_at',
                'value' => new \yii\db\Expression('NOW()'),
            ]
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function rules() {
        return [
            [['email', 'msisdn', 'full_name'], 'required'],
            [['password'], 'required', 'message' => Yii::t('backend', 'Mật khẩu phải từ 6-20 ký tự và bao gồm chữ thường, chữ HOA, số và ký tự đặc biệt(!@#$%^&*)')],
            [['updated_by'], 'integer'],
            [['created_at', 'updated_at', 'type'], 'safe'],
            [['full_name', 'password_reset_token'], 'string', 'max' => 255, 'message' => Yii::t('backend', '{attribute} không được vượt quá 255 ký tự.')],
            ['status', 'in', 'range' => [self::STATUS_ACTIVE, self::STATUS_DELETED]],
            [['email', 'full_name', 'msisdn', 'id_number'], 'trim'],
            ['email', 'string', 'length' => [6, 255],  'tooShort' => 'Email phải có ít nhất 6 ký tự.', 'tooLong' => 'Email không được vượt quá 255 ký tự.'],
            [['email'], 'email', 'message' => 'Email không hợp lệ. Email phải từ 6 ký tự và không quá 64 ký tự trước dấu @.'],
            [['auth_key'], 'string', 'max' => 32],
            [['msisdn'], 'unique', 'message' => 'Số điện thoại đã được sử dụng. Vui lòng chọn số điện thoại khác.'],
            [['email'], 'unique', 'message' => 'Email đã được sử dụng.'],
            [['id_number'], 'unique', 'message' => 'User bán hàng đã được sử dụng.'],
            [['id_number'], 'string', 'length' => [6, 32], 'tooShort' => Yii::t('backend', 'User bán hàng phải từ 6-32 ký tự.'),
                'tooLong' => Yii::t('backend', 'User bán hàng phải từ 6-32 ký tự.')],
            [['msisdn'], 'match', 'pattern' => Yii::$app->params['viettel_phone_expression'],
                'message' => Yii::t('backend', 'Số điện thoại không đúng định dạng')],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels() {
        return [
            'id' => 'ID',
            'email' => 'Email',
            'status' => 'Trạng thái',
            'created_at' => 'Tạo lúc',
            'updated_at' => 'Cập nhật lúc',
            'updated_by' => 'Người sửa',
            'msisdn' => 'Số điện thoại',
            'full_name' => 'Họ tên',
            'id_number' => 'User bán hàng',
            'password' => 'Mật khẩu',
            'name' => 'Tên BH',
        ];
    }

    /**
     * Signs user up.
     *
     * @return bool whether the creating new account was successful and email was sent
     */
    public function signup() {
        if (!$this->validate()) {
            return null;
        }
        $pass = $this->password;
        $msisdn = \common\helpers\Helpers::convertMsisdn($this->msisdn);
        if (\frontend\models\Enteprise::findOne(['msisdn' => $msisdn])) {
            $this->addError('msisdn', 'Số điện thoại ' . $msisdn . ' đã đăng ký dịch vụ!');
            return false;
        } else {
            $user = new Enteprise();
            $user->msisdn = $msisdn;
            $user->email = $this->email;
            $user->full_name = $this->full_name;
            $user->id_number = $this->id_number;
            $user->status = 1;
            $user->setPassword($this->password);
            $user->generateAuthKey();
            $user->generatePasswordResetToken();
            if ($user->save(false)) {
                $mtContent = str_replace('<#mk#>', $pass, \Yii::$app->params['dang_ky_tai_khoan']);
                return \common\helpers\SendMT::sendMT($msisdn, $mtContent);
            }
        }
        return true;
    }

    /**
     * @inheritdoc
     */
    public static function findIdentity($id) {
        $cache = \Yii::$app->cache;
        $key = 'findIdentity.' . $id;
        $data = $cache->get($key);

        if (!$data) {
            $data = static::findOne(['id' => $id, 'status' => self::STATUS_ACTIVE]);
            $cache->set($key, $data, CACHE_TIMEOUT_MEDIUM);
        }
        return $data;
    }

    public static function getMsisdnById($id) {
        return Enteprise::findOne($id)->msisdn;
    }

    /**
     * @inheritdoc
     */
    public static function findIdentityByAccessToken($token, $type = null) {
        throw new NotSupportedException('"findIdentityByAccessToken" is not implemented.');
    }

    /**
     * Finds user by username
     *
     * @param string $username
     * @return static|null
     */
    public static function findByMsisdn($msisdn) {
        return static::findOne(['msisdn' => \common\helpers\Helpers::convertMsisdn($msisdn), 'status' => self::STATUS_ACTIVE]);
    }

    /**
     * Finds user by Id
     *
     * @param int $id
     * @return static|null
     */
    public static function findById($id) {
        return static::findOne(['id' => $id, 'status' => self::STATUS_ACTIVE]);
    }

    /**
     * Finds user by password reset token
     *
     * @param string $token password reset token
     * @return static|null
     */
    public static function findByPasswordResetToken($token) {
        if (!static::isPasswordResetTokenValid($token)) {
            return null;
        }

        return static::findOne([
            'password_reset_token' => $token,
            'status' => self::STATUS_ACTIVE,
        ]);
    }

    /**
     * Finds out if password reset token is valid
     *
     * @param string $token password reset token
     * @return boolean
     */
    public static function isPasswordResetTokenValid($token) {
        if (empty($token)) {
            return false;
        }

        $timestamp = (int) substr($token, strrpos($token, '_') + 1);
        $expire = Yii::$app->params['user.passwordResetTokenExpire'];
        return $timestamp + $expire >= time();
    }

    /**
     * @inheritdoc
     */
    public function getId() {
        return $this->getPrimaryKey();
    }

    /**
     * @inheritdoc
     */
    public function getAuthKey() {
        return $this->auth_key;
    }

    /**
     * @inheritdoc
     */
    public function validateAuthKey($authKey) {
        return $this->getAuthKey() === $authKey;
    }

    /**
     * Validates password
     *
     * @param string $password password to validate
     * @return boolean if password provided is valid for current user
     */
    public function validatePassword($password) {
        return $this->password == $this->generatePasswordHash($password);
    }

    /**
     * Generates password hash from password and sets it to the model
     *
     * @param string $password
     */
    public function setPassword($password) {
        $this->password = $this->generatePasswordHash($password);
    }

    public function generatePasswordHash($password) {
        return sha1(\common\helpers\Helpers::convertMsisdn($this->msisdn) . $password);
    }

    /**
     * Generates "remember me" authentication key
     */
    public function generateAuthKey() {
        $this->auth_key = Yii::$app->security->generateRandomString();
    }

    /**
     * Generates new password reset token
     */
    public function generatePasswordResetToken() {
        $this->password_reset_token = Yii::$app->security->generateRandomString() . '_' . time();
    }

    /**
     * Removes password reset token
     */
    public function removePasswordResetToken() {
        $this->password_reset_token = null;
    }

}
