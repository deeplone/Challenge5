<?php

namespace backend\models;

use Yii;

class EnterpriseFile extends \common\models\EnterpriseFileBase {

    /**
     * {@inheritdoc}
     */
    public function rules() {
        return [
            [['enterprise_id', 'business_license', 'name'], 'required'],
            [['enterprise_id', 'accent', 'region', 'intonational', 'sound_background', 'requires_recording', 'status', 'updated_by'], 'integer'],
            [['recording_content'], 'string'],
            [['created_at', 'updated_at'], 'safe'],
            [['business_license', 'copyright_license', 'msisdn_file', 'reason', 'name'], 'string', 'max' => 255],
            [['recording_file'], 'file', 'skipOnEmpty' => true, 'extensions' => 'mp3', 'maxSize' => 500 * 1024,
                'tooBig' => Yii::t('frontend', 'File "{file}" quá lớn. Kích cỡ tối đa phải < {formattedLimit}.'),
                'wrongExtension' => Yii::t('frontend', 'File không đúng định dạng ({extensions}).'),
            ],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels() {
        return [
            'id' => 'Mã hồ sơ',
            'enterprise_id' => 'Doanh nghiệp',
            'accent' => 'Giọng đọc',
            'region' => 'Miền',
            'intonational' => 'Ngữ điệu',
            'business_license' => 'Giấy phép kinh doanh',
            'copyright_license' => 'Giấy tờ bản quyền',
            'recording_content' => 'Nội dung thu âm',
            'sound_background' => 'Nhạc nền',
            'requires_recording' => 'Yêu cầu thu âm',
            'recording_file' => 'File thu âm',
            'msisdn_file' => 'DS sđt kích hoạt',
            'status' => 'Trạng thái',
            'created_at' => 'Thời gian tiếp nhận',
            'updated_at' => 'Cập nhật lúc',
            'updated_by' => 'Cập nhật bởi',
            'reason' => 'Lý do từ chối duyệt',
            'name' => 'Tên bài hát',
            'brand_id' => 'Mã gói cước',
        ];
    }

    public function genToneCode() {
        $toneName = $this->name;
        $tone = \common\libs\CrbtService::uploadTone($toneName);
        if ($tone['returnCode'] == VCRBT_CODE_SUCCESS) {
            UserRbt::updateAll(['tone_id' => $tone['toneID'], 'tone_code' => $tone['toneCode']], ['enterprise_file_id' => $this->id]);
            $enterpriseTone = new EnterpriseRbt();
            $enterpriseTone->enterprise_id = $this->enterprise_id;
            $enterpriseTone->enterprise_file_id = $this->id;
            $enterpriseTone->tone_code = $tone['toneCode'];
            $enterpriseTone->tone_id = $tone['toneID'];
            $enterpriseTone->file_path = $this->recording_file;
            $enterpriseTone->created_by = Yii::$app->user->getId();
            $enterpriseTone->created_at = new \yii\db\Expression('now()');
            return $enterpriseTone->save(false);
        }

        return false;
    }

    public function pushFTP() {
        $toneFile = Yii::getAlias('@backend_upload') . str_replace('.mp3', '.wav', $this->recording_file);
        $msisdnFile = Yii::getAlias('@backend_upload') . $this->msisdn_file;
        $rbt = $this->rbt;
        try {
            $ftp = new \yii2mod\ftp\FtpClient();
            $ftp->connect(Yii::$app->params['ftp_vcrbt']['host']);
            $ftp->login(Yii::$app->params['ftp_vcrbt']['user'], Yii::$app->params['ftp_vcrbt']['pass']);
            $ftp->pasv(true);
            $ftp->put(Yii::$app->params['ftp_vcrbt']['folder'] . '/' . $rbt->tone_code . '.wav', $toneFile, FTP_BINARY);
            $ftp->put(Yii::$app->params['ftp_vcrbt']['folder'] . '/' . $rbt->tone_code . '.txt', $msisdnFile, FTP_TEXT);
            Yii::info('Push file to FTP success', 'backend');
        } catch (\yii\base\Exception $e) {
            \Yii::error($e->getMessage(), 'ftp-vcrbt');
        }
    }

    public static function getAll() {
        $data = EnterpriseFile::find()->orderBy(['name' => SORT_ASC])->all();
        $return = ['' => 'Tất cả'];
        foreach ($data as $item) {
            $return[$item->id] = \yii\helpers\Html::encode($item->name);
        }
        return $return;
    }

    public static function getRelatedRecordingFile($relatedId) {
        return EnterpriseFile::findOne($relatedId)->recording_file;
    }

}
