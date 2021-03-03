<?php

namespace common\models\db;

use Yii;

/**
 * This is the model class for table "epr_user_rbt".
 *
 * @property int $tone_id Tone ID
 * @property string $tone_code Mã nhạc
 * @property string $msisdn Số điện thoại
 * @property string $register_at Ngày đăng ký
 * @property string $exprired_at Ngày hết hạn
 * @property string $created_at Tạo lúc
 * @property string $updated_at Cập nhật lúc
 * @property int $status Trạng thái
 * @property string $enterprise_file_id Bài hát
 * @property string $id
 */
class UserRbtDB extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'epr_user_rbt';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['tone_id', 'status', 'enterprise_file_id', 'id'], 'integer'],
            [['msisdn', 'id'], 'required'],
            [['register_at', 'exprired_at', 'created_at', 'updated_at'], 'safe'],
            [['tone_code'], 'string', 'max' => 20],
            [['msisdn'], 'string', 'max' => 15],
            [['id'], 'unique'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'tone_id' => 'Tone ID',
            'tone_code' => 'Mã nhạc',
            'msisdn' => 'Số điện thoại',
            'register_at' => 'Ngày đăng ký',
            'exprired_at' => 'Ngày hết hạn',
            'created_at' => 'Tạo lúc',
            'updated_at' => 'Cập nhật lúc',
            'status' => 'Trạng thái',
            'enterprise_file_id' => 'Bài hát',
            'id' => 'ID',
        ];
    }
}
