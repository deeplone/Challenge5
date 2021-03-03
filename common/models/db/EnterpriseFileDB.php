<?php

namespace common\models\db;

use Yii;

/**
 * This is the model class for table "epr_enterprise_file".
 *
 * @property string $id ID
 * @property int $enterprise_id Doanh nghiệp
 * @property int $accent Giọng đọc
 * @property int $region Miền
 * @property double $intonational Ngữ điệu
 * @property string $business_license Giấy phép kinh doanh
 * @property string $copyright_license Giấy tờ bản quyền
 * @property string $recording_content Nội dung thu âm
 * @property int $sound_background Nhạc nền
 * @property int $requires_recording Yêu cầu thu âm
 * @property string $recording_file File mp3
 * @property string $msisdn_file DS sđt kích hoạt
 * @property int $status 0:Khởi tạo; 1: Chờ phê duyệt; 3: Phê duyệt; 4: Từ chối duyệt
 * @property string $created_at Tạo lúc
 * @property string $updated_at Cập nhật lúc
 * @property int $updated_by Cập nhật bởi
 * @property string $reason Lý do từ chối duyệt
 * @property string $name Tên doanh nghiệp
 * @property int $brand_id brand_id gói cước crbt
 * @property string $source Nguồn tạo hồ sơ
 * @property string $background_music Tên bài nhạc nền
 * @property string $msisdn_pay Số điện thoại thanh toán
 * @property int $relate_id Mã hồ sơ liên quan
 */
class EnterpriseFileDB extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'epr_enterprise_file';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['enterprise_id', 'name'], 'required'],
            [['enterprise_id', 'accent', 'region', 'sound_background', 'requires_recording', 'status', 'updated_by', 'brand_id', 'relate_id'], 'integer'],
            [['intonational'], 'number'],
            [['recording_content'], 'string'],
            [['created_at', 'updated_at'], 'safe'],
            [['business_license', 'copyright_license', 'recording_file', 'msisdn_file', 'reason', 'name', 'background_music'], 'string', 'max' => 255],
            [['source'], 'string', 'max' => 100],
            [['msisdn_pay'], 'string', 'max' => 15],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'enterprise_id' => 'Enterprise ID',
            'accent' => 'Accent',
            'region' => 'Region',
            'intonational' => 'Intonational',
            'business_license' => 'Business License',
            'copyright_license' => 'Copyright License',
            'recording_content' => 'Recording Content',
            'sound_background' => 'Sound Background',
            'requires_recording' => 'Requires Recording',
            'recording_file' => 'Recording File',
            'msisdn_file' => 'Msisdn File',
            'status' => 'Status',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
            'updated_by' => 'Updated By',
            'reason' => 'Reason',
            'name' => 'Name',
            'brand_id' => 'Brand ID',
            'source' => 'Source',
            'background_music' => 'Background Music',
            'msisdn_pay' => 'Msisdn Pay',
            'relate_id' => 'Relate ID',
        ];
    }
}
