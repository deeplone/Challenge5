<?php

namespace common\models\db;

use Yii;

/**
 * This is the model class for table "epr_mt_log".
 *
 * @property string $id ID
 * @property string $msisdn Số điện thoại
 * @property string $content Nội dung
 * @property string $send_time Gửi lúc
 * @property int $type Loại
 * @property string $returnCode Mã lỗi
 */
class MtLogDB extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'epr_mt_log';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['msisdn', 'content'], 'required'],
            [['send_time'], 'safe'],
            [['type'], 'integer'],
            [['msisdn'], 'string', 'max' => 15],
            [['content'], 'string', 'max' => 1000],
            [['returnCode'], 'string', 'max' => 10],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'msisdn' => 'Số điện thoại',
            'content' => 'Nội dung',
            'send_time' => 'Gửi lúc',
            'type' => 'Loại',
            'returnCode' => 'Mã lỗi',
        ];
    }
}
