<?php

namespace common\models\db;

use Yii;

/**
 * This is the model class for table "epr_charging_log".
 *
 * @property string $id ID
 * @property string $msisdn Số điện thoại
 * @property string $fee Phí
 * @property string $cmd Lệnh
 * @property string $error_code Mã lỗi
 * @property string $charged_at Trừ lúc
 * @property string $enterprise_file_id Bài hát
 * @property string $enterprise_id Doanh nghiệp
 * @property string $content Content
 * @property int $type Loại (1: phí khởi tạo, 2: phí thu âm)
 * @property double $old_fee Phí lúc đầu
 * @property double $discount Chiết khấu
 */
class ChargingLogDB extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'epr_charging_log';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['msisdn'], 'required'],
            [['fee', 'old_fee', 'discount'], 'number'],
            [['charged_at'], 'safe'],
            [['enterprise_file_id', 'enterprise_id', 'type'], 'integer'],
            [['msisdn'], 'string', 'max' => 15],
            [['cmd', 'error_code'], 'string', 'max' => 20],
            [['content'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'msisdn' => 'Msisdn',
            'fee' => 'Fee',
            'cmd' => 'Cmd',
            'error_code' => 'Error Code',
            'charged_at' => 'Charged At',
            'enterprise_file_id' => 'Enterprise File ID',
            'enterprise_id' => 'Enterprise ID',
            'content' => 'Content',
            'type' => 'Type',
            'old_fee' => 'Old Fee',
            'discount' => 'Discount',
        ];
    }
}
