<?php

namespace common\models\db;

use Yii;

/**
 * This is the model class for table "epr_enteprise".
 *
 * @property int $id ID
 * @property string $email Email
 * @property int $status Trạng thái
 * @property string $created_at Tạo lúc
 * @property string $updated_at Cập nhật lúc
 * @property int $updated_by Người sửa
 * @property string $msisdn Số điện thoại
 * @property string $full_name Họ tên
 * @property string $id_number Số chứng minh thư
 * @property string $password Mật khẩu
 * @property string $password_reset_token
 * @property string $auth_key
 * @property int $type Loại người dùng (1: khách hàng lẻ, 2: kênh bán Viettel; 3: đại lý lớn)
 */
class EntepriseDB extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'epr_enteprise';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['email', 'msisdn', 'full_name', 'id_number', 'password'], 'required'],
            [['status', 'updated_by', 'type'], 'integer'],
            [['created_at', 'updated_at'], 'safe'],
            [['email', 'full_name', 'password', 'password_reset_token'], 'string', 'max' => 255],
            [['msisdn'], 'string', 'max' => 15],
            [['id_number'], 'string', 'max' => 20],
            [['auth_key'], 'string', 'max' => 32],
            [['msisdn'], 'unique'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'email' => 'Email',
            'status' => 'Status',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
            'updated_by' => 'Updated By',
            'msisdn' => 'Msisdn',
            'full_name' => 'Full Name',
            'id_number' => 'Id Number',
            'password' => 'Password',
            'password_reset_token' => 'Password Reset Token',
            'auth_key' => 'Auth Key',
            'type' => 'Type',
        ];
    }
}
