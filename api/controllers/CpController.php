<?php

namespace api\controllers;

use \frontend\models\RequestRbtForm;
use \frontend\models\UploadRbtForm;
use \api\models\Enteprise;
use \api\libs\ApiHelper;
use \api\libs\ApiResponseCode;

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class CpController extends ApiController {

    public function actionCreateCrbt() {
        $type = $this->getParam('type', '');
        $name = $this->getParam('name', '');
        $amMail = $this->getParam('am_mail', '');
        $amIsdn = \common\helpers\Helpers::convertMsisdn($this->getParam('am_isdn', ''));
        $brandId = $this->getParam('brand_id', '');

        if (!preg_match(\Yii::$app->params['viettel_phone_expression'], $amIsdn)) {
            return \api\libs\ApiHelper::formatResponse(\api\libs\ApiResponseCode::ISDN_INVALID);
        }
        $entepriseIsDelete = false;
//        $enteprise = \api\models\Enteprise::find()->where(['msisdn' => $amIsdn])->one();
        $enteprise = Enteprise::findByMsisdn($amIsdn);
        if (!$enteprise) {
            $entepriseIsDelete = true;
            $enteprise = new Enteprise();
            $enteprise->msisdn = $amIsdn;
            $enteprise->email = $amMail;
            $enteprise->full_name = $amIsdn;
            $enteprise->setPassword($amIsdn);
            $enteprise->generateAuthKey();
            $enteprise->generatePasswordResetToken();
            $enteprise->status = 1;
            $enteprise->created_at = new \yii\db\Expression('now()');
            $enteprise->type = 4;
            if (!$enteprise->save()) {
                \Yii::error($enteprise->getErrors());
                $message = '';
                if ($error = $enteprise->getErrors('msisdn')) {
                    $message = $error[0];
                } else if ($error = $enteprise->getErrors('email')) {
                    $message = $error[0];
                }
                return ApiHelper::formatResponse(ApiResponseCode::PARAM_INVALID, null, $message);
            }
        }
        $enterpriseFile = ($type == 1) ? new UploadRbtForm() : new RequestRbtForm();
        $enterpriseFile->enterprise_id = $enteprise->id;
        $enterpriseFile->business_license = '';

        if ($_FILES['isdn_file']) {
            $fileUpload['name']['msisdn_file'] = $_FILES['isdn_file']['name'];
            $fileUpload['tmp_name']['msisdn_file'] = $_FILES['isdn_file']['tmp_name'];
            $fileUpload['type']['msisdn_file'] = $_FILES['isdn_file']['type'];
            $fileUpload['size']['msisdn_file'] = $_FILES['isdn_file']['size'];
            $fileUpload['error']['msisdn_file'] = $_FILES['isdn_file']['error'];
            $enterpriseFile->msisdn_file = $enterpriseFile->uploadTxt('msisdn_file', $fileUpload);
            if ($message = $enterpriseFile->getErrors('msisdn_file')) {
                return ApiHelper::formatResponse(ApiResponseCode::PARAM_INVALID, null, $message[0]);
            }
        }

        if ($_FILES['copyright_license']) {
            $fileUpload['name']['copyright_license'] = $_FILES['copyright_license']['name'];
            $fileUpload['tmp_name']['copyright_license'] = $_FILES['copyright_license']['tmp_name'];
            $fileUpload['type']['copyright_license'] = $_FILES['copyright_license']['type'];
            $fileUpload['size']['copyright_license'] = $_FILES['copyright_license']['size'];
            $fileUpload['error']['copyright_license'] = $_FILES['copyright_license']['error'];
            $enterpriseFile->copyright_license = $enterpriseFile->upload('copyright_license', $fileUpload);
            if ($message = $enterpriseFile->getErrors('copyright_license')) {
                return ApiHelper::formatResponse(ApiResponseCode::PARAM_INVALID, null, $message[0]);
            }
        } else {
            return ApiHelper::formatResponse(ApiResponseCode::PARAM_INVALID, "Chưa gửi giấy tờ bản quyền", $message[0]);
        }

        if ($type == 1) {
            $enterpriseFile->requires_recording = 0;
            $fileUpload['name']['recording_file'] = $_FILES['mp3_file']['name'];
            $fileUpload['tmp_name']['recording_file'] = $_FILES['mp3_file']['tmp_name'];
            $fileUpload['type']['recording_file'] = $_FILES['mp3_file']['type'];
            $fileUpload['size']['recording_file'] = $_FILES['mp3_file']['size'];
            $fileUpload['error']['recording_file'] = $_FILES['mp3_file']['error'];

            $enterpriseFile->recording_file = $enterpriseFile->uploadMp3('recording_file', $fileUpload);
            if ($message = $enterpriseFile->getErrors('recording_file')) {
                return ApiHelper::formatResponse(ApiResponseCode::MP3_INVALID, null, $message[0]);
            }
        } else {
            $enterpriseFile->requires_recording = 1;
            $enterpriseFile->recording_content = $this->getParam('content', '');
            $enterpriseFile->accent = $this->getParam('accent', '');
            $enterpriseFile->region = $this->getParam('region');
            $enterpriseFile->intonational = $this->getParam('intonational');
            $enterpriseFile->sound_background = $this->getParam('sound_background', 0);
        }
        $enterpriseFile->status = 6;

        $enterpriseFile->name = $name;
        $enterpriseFile->source = $this->getParam('client_id', '');
        $enterpriseFile->brand_id = $brandId;
        $enterpriseFile->created_at = new \yii\db\Expression('now()');
        if (!$enterpriseFile->save()) {
            \Yii::error(json_encode($enterpriseFile->getErrors()));
            $message = '';
            if ($error = $enterpriseFile->getErrors('name')) {
                $message = $error[0];
            } else if ($error = $enterpriseFile->getErrors('msisdn_file')) {
                $message = $error[0];
            } else if ($error = $enterpriseFile->getErrors('recording_content')) {
                $message = $error[0];
            } else if ($error = $enterpriseFile->getErrors('recording_file')) {
                $message = $error[0];
            }
            return ApiHelper::formatResponse(ApiResponseCode::PARAM_INVALID, null, $message);
        }

        if ($enterpriseFile->genToneCode()) {
            $enterpriseFile->txt2Db();
            if (is_file(\Yii::getAlias('@frontend_upload') . $enterpriseFile->recording_file)) {
                $enterpriseFile->mp3ToWav(\Yii::getAlias('@frontend_upload') . $enterpriseFile->recording_file);
                $enterpriseFile->pushFTP();
            }
            $rbt = $enterpriseFile->rbt;
            return ApiHelper::formatResponse(ApiResponseCode::SUCCESS, [
                        'tone_code' => $rbt->tone_code,
                        'tone_id' => $rbt->tone_id,
            ]);
        } else {
            $enterpriseFile->delete();
            if ($entepriseIsDelete) {
                $enteprise->delete();
            }
            return ApiHelper::formatResponse(ApiResponseCode::GEN_TONE_CODE_INVALID);
        }

        return ApiHelper::formatResponse(ApiResponseCode::SYSTEM_ERROR);
    }

    public function actionBackground() {
        $data = null;
        $model = \common\models\EprBackgroundBase::find()->all();
        foreach ($model as $item) {
            $data[]['id'] = $item->id;
            $data[]['name'] = $item->name;
            $data[]['path'] = DOMAIN . $item->path;
        }

        return ApiHelper::formatResponse(ApiResponseCode::SUCCESS, $data);
    }

    public function actionVoice() {
        $data = null;
        $model = \common\models\EprVoicesBase::find()->all();
        foreach ($model as $item) {
            $data[]['code'] = $item->code;
            $data[]['name'] = $item->name;
            $data[]['path'] = DOMAIN . $item->path;
        }

        return ApiHelper::formatResponse(ApiResponseCode::SUCCESS, $data);
    }

}
