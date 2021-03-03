<?php

namespace common\models;

use common\helpers\Helpers;
use common\libs\MP3File;
use Yii;
use yii\web\UploadedFile;

/**
 * @property EnterpriseRbtBase $rbt
 * @property EntepriseBase $enterprise
 * @property UserRbtBase $userRbt
 */
class EnterpriseFileBase extends \common\models\db\EnterpriseFileDB
{

    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            [
                'class' => \yii\behaviors\TimestampBehavior::className(),
                'createdAtAttribute' => 'created_at',
                'updatedAtAttribute' => 'updated_at',
                'value' => new \yii\db\Expression('NOW()')
            ],
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRbt()
    {
        return $this->hasOne(EnterpriseRbtBase::className(), ['enterprise_file_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getEnterprise()
    {
        return $this->hasOne(EntepriseBase::className(), ['id' => 'enterprise_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUserRbt()
    {
        return $this->hasMany(UserRbtBase::className(), ['enterprise_file_id' => 'id'], function ($query) {
            $query->orderBy(['user_rbt.updated_at' => SORT_DESC]);
        })->all();
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'enterprise_id' => 'Doanh nghiệp',
            'accent' => 'Giọng đọc',
            'region' => 'Miền',
            'intonational' => 'Ngữ điệu',
            'business_license' => 'Giấy phép kinh doanh',
            'copyright_license' => 'Giấy tờ bản quyền',
            'recording_content' => 'Nội dung thu âm',
            'sound_background' => 'Nhạc nền',
            'requires_recording' => 'Yêu cầu thu âm',
            'recording_file' => 'File mp3',
            'msisdn_file' => 'DS sđt kích hoạt',
            'status' => '0:Khởi tạo; 1: Chờ phê duyệt; 3: Phê duyệt; 4: Từ chối duyệt',
            'created_at' => 'Tạo lúc',
            'updated_at' => 'Cập nhật lúc',
            'updated_by' => 'Cập nhật bởi',
            'reason' => 'Lý do từ chối duyệt',
            'name' => 'Tên bài hát',
        ];
    }

    public function getFile()
    {
        return '/uploads' . $this->recording_file;
    }

    public function audio()
    {
        return '<audio controls><source src="' . $this->getFile() . '"></audio>';
    }

    public function newAudio($id)
    {
        return '<audio id="'.$id.'" controls><source src="' . $this->getFile() . '"></audio>';
    }

    public function getUrlFile($file, $name = 'Xem file')
    {
        if (is_file(Yii::getAlias('@frontend_upload') . $file)) {
            return \yii\helpers\Html::a($name, '/uploads' . $file, ['target' => '_blank', 'class' => 'view-file-upload']);
        }
    }

    public function uploadWav($field, $file, $maxSize = 500, $ext = 'wav')
    {
        if ($file['name'][$field]) {
            $fileUpload = new \yii\web\UploadedFile();
            $fileUpload->name = $file['name'][$field];
            $fileUpload->tempName = $file['tmp_name'][$field];
            $fileUpload->type = $file['type'][$field];
            $fileUpload->size = $file['size'][$field];
            $fileUpload->error = $file['error'][$field];
            $this->$field = $fileUpload;
            if (strtolower($this->$field->extension) == strtolower($ext)) {
                if ($this->$field->size <= ($maxSize * 1024)) {
                    $mp3file = new \common\libs\MP3File($this->$field->tempName);
                    $duration = $mp3file->wavDur();
                    if ($duration >= 30 && $duration <= 43) {
                        $dir = Yii::getAlias('@frontend_upload');
                        $file = '/rbt/' . \common\helpers\Helpers::generateStructurePath();
                        if (!is_dir($dir . $file)) {
                            mkdir($dir . $file, 0777, true);
                        }
                        $fileName = $file . uniqid() . '.' . $this->$field->extension;
                        $this->$field->saveAs($dir . $fileName);

                        return $fileName;
                    } else {
                        return $this->addError($field, 'Thời lượng file nhạc phải trong khoảng từ 30s - 40s');
                    }
                } else {
                    return $this->addError($field, 'File quá lớn (' . $maxSize . 'KB).');
                }
            } else {
                return $this->addError($field, 'File không đúng định dạng (' . $ext . ').');
            }
        }
        return $this->$field;
    }

    public function uploadMp3($field, $file, $maxSize = 700, $ext = 'mp3')
    {
        if ($file['name'][$field]) {
            $fileUpload = new UploadedFile();
            $fileUpload->name = $file['name'][$field];
            $fileUpload->tempName = $file['tmp_name'][$field];
            $fileUpload->type = $file['type'][$field];
            $fileUpload->size = $file['size'][$field];
            $fileUpload->error = $file['error'][$field];
            $this->$field = $fileUpload;
            if (strtolower($this->$field->extension) == strtolower($ext)) {
                $mp3file = new MP3File($this->$field->tempName);
                $duration = $mp3file->getDuration();
                if ($duration >= 30 && $duration <= 43) {
                    $dir = Yii::getAlias('@frontend_upload');
                    $file = '/rbt/' . Helpers::generateStructurePath();
                    if (!is_dir($dir . $file)) {
                        mkdir($dir . $file, 0777, true);
                    }
                    $fileName = $file . uniqid() . '.' . $this->$field->extension;
                    $this->$field->saveAs($dir . $fileName);
                    $this->mp3ToWav($dir . $fileName);
                    $this->$field = $fileName;
                    return $fileName;
                } else {
                    return $this->addError($field, 'Thời lượng file nhạc phải trong khoảng từ 30s - 43s và bitrate phải từ 128kbps');
                }
            } else {
                return $this->addError($field, 'File không đúng định dạng (' . $ext . ').');
            }
        }
        return $this->$field;
    }

    public function mp3ToWav($file)
    {
        $wav = str_replace('.mp3', '.wav', $file);
        $cmd = str_replace('<#wav#>', $wav, str_replace('<#mp3#>', $file, Yii::$app->params['ffmpeg']));
        \Yii::info($cmd);
        exec($cmd);
    }

    public function uploadTxt($field, $file, $ext = 'txt', $maxSize = 100)
    {
        $root = Yii::getAlias('@frontend_upload');
        $dir = '/docs/' . \common\helpers\Helpers::generateStructurePath();
        if (!is_dir($root . $dir)) {
            mkdir($root . $dir, 0777, true);
        }
        if ($file['name'][$field]) {
            $fileUpload = new UploadedFile();
            $fileUpload->name = $file['name'][$field];
            $fileUpload->tempName = $file['tmp_name'][$field];
            $fileUpload->type = $file['type'][$field];
            $fileUpload->size = $file['size'][$field];
            $fileUpload->error = $file['error'][$field];
            //$this->$field = $fileUpload;
            if (strtolower($fileUpload->extension) == strtolower($ext)) {
                $fh = fopen($file['tmp_name'][$field], 'r');
                while ($line = fgets($fh)) {
                    $line = trim($line);
                    if ($line && !Helpers::isPhoneNumber($line)) {
                        return $this->addError($field, 'Yêu cầu danh sách thuê bao cài đặt là số Viettel.');
                    }
                }
                fclose($fh);

                if ($fileUpload->size <= ($maxSize * 1024 * 1024)) {
                    $fileName = $dir . uniqid() . '.' . $fileUpload->extension;
                    $fileUpload->saveAs($root . $fileName);
                } else {
                    return $this->addError($field, 'File quá lớn (' . $maxSize . 'MB).');
                }
            } else {
                return $this->addError($field, 'File không đúng định dạng (' . $ext . ').');
            }
        } else {
            if (!$this->$field) {
                $fileName = $dir . uniqid() . '.txt';
                $fp = fopen($root . $fileName, 'w');
                fwrite($fp, ' ');
                fclose($fp);
            }
        }
        $this->$field = $fileName;
        return $fileName;
    }

    public function uploadEmptyTxt($field)
    {
        $root = Yii::getAlias('@frontend_upload');
        $dir = '/docs/' . \common\helpers\Helpers::generateStructurePath();
        if (!is_dir($root . $dir)) {
            mkdir($root . $dir, 0777, true);
        }

        $fileName = $dir . uniqid() . '.txt';
        $fp = fopen($root . $fileName, 'w');
        fwrite($fp, ' ');
        fclose($fp);
        $this->$field = $fileName;
        return $fileName;
    }

    public function upload($field, $file, $ext = ['pdf', 'png', 'jpg'], $maxSize = 100)
    {
        if ($file['name'][$field]) {
            $fileUpload = new UploadedFile();
            $fileUpload->name = $file['name'][$field];
            $fileUpload->tempName = $file['tmp_name'][$field];
            $fileUpload->type = $file['type'][$field];
            $fileUpload->size = $file['size'][$field];
            $fileUpload->error = $file['error'][$field];
            //$this->$field = $fileUpload;
            if (in_array(strtolower($fileUpload->extension), $ext)) {
                if ($fileUpload->size <= ($maxSize * 1024 * 1024)) {
                    $dir = Yii::getAlias('@frontend_upload');
                    $file = '/docs/' . \common\helpers\Helpers::generateStructurePath();
                    if (!is_dir($dir . $file)) {
                        mkdir($dir . $file, 0777, true);
                    }
                    $fileName = $file . uniqid() . '.' . $fileUpload->extension;
                    $fileUpload->saveAs($dir . $fileName);
                    $this->$field = $fileName;
                    return $fileName;
                } else {
                    return $this->addError($field, 'File quá lớn (' . $maxSize . 'MB).');
                }
            } else {
                return $this->addError($field, 'File không đúng định dạng (pdf, png, jpg).');
            }
        }
        return $this->$field;
    }

    public function genToneCode()
    {
        $toneName = $this->name;
        $tone = \common\libs\CrbtService::uploadTone($toneName);
        if ($tone['returnCode'] == VCRBT_CODE_SUCCESS) {
            UserRbtBase::updateAll(['tone_id' => $tone['toneID'], 'tone_code' => $tone['toneCode']], ['enterprise_file_id' => $this->id]);
            $enterpriseTone = new EnterpriseRbtBase();
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

    public function pushFTP()
    {
        $toneFile = Yii::getAlias('@backend_upload') . str_replace('.mp3', '.wav', $this->recording_file);
        $msisdnFile = Yii::getAlias('@backend_upload') . $this->msisdn_file;
        $rbt = $this->rbt;
        try {
            $ftp = new \yii2mod\ftp\FtpClient();
            $ftp->connect(Yii::$app->params['ftp_vcrbt']['host']);
            $ftp->login(Yii::$app->params['ftp_vcrbt']['user'], Yii::$app->params['ftp_vcrbt']['pass']);
            $ftp->pasv(true);
            $ftp->put(Yii::$app->params['ftp_vcrbt']['folder'] . '/' . $rbt->tone_code . '.wav', $toneFile, FTP_BINARY);
            if ($this->source) {
                $root = Yii::getAlias('@frontend_upload');
                $dir = '/docs/' . \common\helpers\Helpers::generateStructurePath();
                if (!is_dir($root . $dir)) {
                    mkdir($root . $dir, 0777, true);
                }
                $fileName = $dir . uniqid() . '.txt';
                $fp = fopen($root . $fileName, 'w');
                fwrite($fp, ' ');
                fclose($fp);
                $ftp->put(Yii::$app->params['ftp_vcrbt']['folder'] . '/' . $rbt->tone_code . '.txt', $root . $fileName, FTP_TEXT);
            } else {
                $ftp->put(Yii::$app->params['ftp_vcrbt']['folder'] . '/' . $rbt->tone_code . '.txt', $msisdnFile, FTP_TEXT);
            }
            Yii::info('Push file to FTP success');
        } catch (\yii\base\Exception $e) {
            \Yii::error($e->getMessage(), 'ftp-vcrbt');
        }
    }

    public function txt2Db()
    {
        UserRbtBase::deleteAll(['enterprise_file_id' => $this->id]);
        $fh = fopen(Yii::getAlias('@frontend_upload') . $this->msisdn_file, 'r');
        while ($line = fgets($fh)) {
            if ($msisdn = \common\helpers\Helpers::convertMsisdn($line)) {
                if (!UserRbtBase::findOne(['enterprise_file_id' => $this->id, 'msisdn' => $msisdn])) {
                    $userRbt = new UserRbtBase();
                    $userRbt->msisdn = $msisdn;
                    $userRbt->enterprise_file_id = $this->id;
                    $userRbt->created_at = new \yii\db\Expression('now()');
                    $userRbt->status = 0;
                    $userRbt->save(false);
                }
            }
        }
        fclose($fh);
    }

    public function checkName()
    {
        $name = preg_replace('/\s+/', '', $this->name);
        if (preg_match('/[\W]+/', $name) || preg_match('/_/', $name)) {
            $this->addError('name', 'Tên không được chứa ký tự đặc biệt!');
        }
        if (\common\helpers\Helpers::isVietnamese($this->name)) {
            $this->addError('name', 'Tên phải là tiếng việt không dấu!');
        }
    }

    public function crbt() {
        if ($this->source) {
            $data = UserRbtBase::find()->where(['enterprise_file_id' => $this->id])->all();
            $msisdn = '';
            foreach ($data as $item) {
                $msisdn .= $item->msisdn . ',';
            }
            if ($msisdn) {
                $rbt = $this->rbt;
                if ($rbt) {
                    $postData = array(
                        'client_id' => 'bccs',
                        'client_secret' => '7729b60691769620f6ce45807ab6dc83',
                        'msisdn' => trim($msisdn, ','),
                        'tonecode' => $rbt->tone_code,
                        'tonename' => $this->name,
                        'tone_id' => $rbt->tone_id,
                        'brand_id' => $this->brand_id
                    );
                    $ch = curl_init('http://app.imuzik.com.vn/ncdn/bccs');
                    curl_setopt_array($ch, array(
                        CURLOPT_POST => TRUE,
                        CURLOPT_RETURNTRANSFER => TRUE,
                        CURLOPT_POSTFIELDS => json_encode($postData)
                    ));
                    curl_exec($ch);
                }
            }
        }
    }

}
