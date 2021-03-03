<?php


namespace frontend\controllers;


use api\libs\ApiHelper;
use api\libs\ApiResponseCode;
use common\helpers\Helpers;
use common\helpers\SendMT;
use common\libs\Charging;
use common\libs\ChargingError;
use common\libs\MP3File;
use common\libs\Voices;
use common\models\ChargingLogBase;
use frontend\models\ConfirmRegisterForm;
use frontend\models\Enteprise;
use frontend\models\EnterpriseFile;
use frontend\models\EprBackground;
use frontend\models\EprRecordingContents;
use frontend\models\EprVoices;
use frontend\models\OnlineRbtForm;
use frontend\models\Otp;
use frontend\models\OtpConfirm;
use frontend\models\OtpConfirmForm;
use frontend\models\RequestRbtForm;
use frontend\models\UploadRbtForm;
use frontend\models\VoiceForm;
use Yii;
use yii\base\Model;
use yii\bootstrap\ActiveForm;
use yii\helpers\ArrayHelper;
use yii\helpers\Url;
use yii\web\Response;
use yii\web\View;

class RbtController extends AppController
{
    public function actionCreate()
    {
        if (Yii::$app->user->isGuest) {
            return $this->goHome();
        }
        $this->layout = 'rbt';
        $relateId = Yii::$app->request->getQueryParam('relate-id');
        return $this->render('create', ['relateId' => $relateId]);
    }

    /*********** RECORD ONLINE ************/
    public function actionRecordOnline()
    {
        if (Yii::$app->user->isGuest) {
            return $this->goHome();
        }
        $this->layout = 'rbt';
        $id = Yii::$app->request->getQueryParam('id');
        $relateId = Yii::$app->request->getQueryParam('relate-id');
        $relateItem = EnterpriseFile::getApprovedOwnerById($relateId);
        $user = Yii::$app->user->getIdentity();
        /* @var Enteprise $user */
        $giong_doc = null;
        if (!$id) {
            $model = new OnlineRbtForm();
        } else {
            $model = OnlineRbtForm::getUpdateOwnerById($id);
            if (!$model) {
                return $this->redirect(['user/index']);
            }
            $giong_doc = EprVoices::getCodeById($model->accent);
            $model->name = trim($model->name);
            $tmpMsisdnFile = $model->msisdn_file;
            $tmpCopyrightLicense = $model->copyright_license;
        }
        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            if($user->type == 2 && !$model->msisdn_pay) {
                $model->addError('msisdn_pay', 'Chưa nhập số điện thoại thanh toán');
            }
            if ($id) {
                if ($_FILES[$model->formName()]['name']['msisdn_file'] == "") {
                    $model->msisdn_file = $tmpMsisdnFile;
                } else {
                    $model->uploadTxt('msisdn_file', $_FILES[$model->formName()]);
                }

                if ($_FILES[$model->formName()]['name']['copyright_license'] == "") {
                    $model->copyright_license = $tmpCopyrightLicense;
                } else {
                    $model->upload('copyright_license',  $_FILES[$model->formName()]);
                }
            } else {
                $model->uploadTxt('msisdn_file', $_FILES[$model->formName()]);

                if ($_FILES[$model->formName()]['name']['copyright_license'] == "" || !$_FILES[$model->formName()]['name']['copyright_license']) {
                    $model->addError("copyright_license", "Bạn chưa upload file bản quyền");
                } else {
                    $model->upload('copyright_license',  $_FILES[$model->formName()]);
                }
            }
            if (!$model->id) {
                $model->enterprise_id = \Yii::$app->user->getId();
                $model->status = RBT_STATUS_NEW;
                $model->requires_recording = 0;
                $model->created_at = date('Y-m-d H:i:s', time());
            }
            if ($relateItem || $model->status == RBT_STATUS_REJECTED) {
                $model->status = RBT_STATUS_WAITING;
            }
            if ($relateItem) {
                $model->relate_id = $relateId;
            }
            $model->name = trim($model->name);
            if ($model->msisdn_pay) {
                $model->msisdn_pay = Helpers::convertMsisdn($model->msisdn_pay);
            }
            if (!$model->getErrors()) {
                if ($model->save()) {
                    $model->txt2Db();
                    if ($user->type == USER_TYPE_INTERNAL && $model->status == RBT_STATUS_NEW && $model->msisdn_pay) {
                        return $this->redirect(['rbt/payment-online-internal', 'id' => $model->id]);
                    } else if ($model->status == RBT_STATUS_NEW) {
                        return $this->redirect(['rbt/payment-online', 'id' => $model->id]);
                    } else {

                        return $this->redirect(['user/index']);
                    }
                }
            }
        }
        $failStep = 0;
        if($model->getErrors()['msisdn_file'] || $model->getErrors('msisdn_pay') || $model->getErrors('copyright_license')){
            $failStep = 4;
        }
        $exampleVoices = EprVoices::getAll();
        $voiceSpeeds = ['0.9' => 'Chậm', '1.0' => 'Bình thường', '1.1' => 'Nhanh'];
        $exampleContents = EprRecordingContents::getRecordingContents(5);
        $backgroundMusics = EprBackground::getAll(5);
        return $this->render('online', [
            'model' => $model,
            'exampleContents' => $exampleContents,
            'exampleVoices' => $exampleVoices,
            'voiceSpeeds' => $voiceSpeeds,
            'failStep' => $failStep,
            'giongDoc' => $giong_doc,
            'backgroundMusics' => $backgroundMusics,
        ]);
    }

    public function actionPaymentOnline($id, $back = '')
    {
        if (Yii::$app->user->isGuest) {
            return $this->goHome();
        }
        $this->layout = 'rbt';
        $model = OnlineRbtForm::getPaymentOwnerById($id, 1);
        if (!$model) {
            return $this->redirect(['user/index']);
        } 
        Helpers::calDiscount(Yii::$app->user->getIdentity()->getId(), $model->id);
        $discount = Helpers::getDiscount($id);
        $fee = FEE_KHOI_TAO * (100 - $discount) / 100;
        $exampleVoices = ArrayHelper::map(EprVoices::getAll(), 'id', 'description');
        $voiceSpeeds = ['0.9' => 'Chậm', '1.0' => 'Bình thường', '1.1' => 'Nhanh'];
        return $this->render('paymentOnline', [
            'message' => null,
            'voiceSpeed' => $voiceSpeeds[number_format($model->intonational, 1)],
            'exampleVoice' => $exampleVoices[$model->accent],
            'model' => $model,
            'fee' => $fee,
            'back' => $back,
            'phoneNumber' => Helpers::hideMsisdn(Yii::$app->user->getIdentity()->msisdn),
        ]);
    }

    public function actionPaymentOnlineInternal($id, $back = '')
    {
        if (Yii::$app->user->isGuest) {
            return $this->goHome();
        }
        $this->layout = 'rbt';
        $model = OnlineRbtForm::getPaymentOwnerById($id, 1);
        if (!$model) {
            return $this->redirect(['user/index']);
        }
        $fee = FEE_KHOI_TAO;
        $exampleVoices = ArrayHelper::map(EprVoices::getAll(), 'id', 'description');
        $voiceSpeeds = ['0.9' => 'Chậm', '1.0' => 'Bình thường', '1.1' => 'Nhanh'];
        return $this->render('paymentOnlineInternal', [
            'message' => null,
            'voiceSpeed' => $voiceSpeeds[number_format($model->intonational, 1)],
            'exampleVoice' => $exampleVoices[$model->accent],
            'model' => $model,
            'fee' => $fee,
            'back' => $back,
            'phoneNumber' => Helpers::hideMsisdn($model->msisdn_pay),
        ]);
    }

    public function actionPaymentOnlineInternalConfirm()
    {
        if (Yii::$app->user->isGuest) {
            return $this->goHome();
        }
        $id = Yii::$app->request->getBodyParam('id');
        if (!$id) {
            $this->redirect(['user/index']);
        }
        $model = OnlineRbtForm::getPaymentOwnerById($id, 1);
        if (!$model) {
            return $this->redirect(['user/index']);
        }
        $message = "Hệ thống đã gửi yêu cầu thanh toán đến số điện thoại <b>" .
            Helpers::hideMsisdn($model->msisdn_pay) . "</b>. Hãy hướng dẫn khách hàng soạn <b>YN " .
            Helpers::eprCode($model->id) . "</b> gửi <b>1221</b> để xác thực thanh toán";
        $mtContent = str_replace('<#fee#>',
            number_format(FEE_KHOI_TAO, 0, ",", "."),
            str_replace('<#command#>', 'YN ' . Helpers::eprCode($model->id),
                str_replace('<#mahs#>', Helpers::eprCode($model->id),
                    str_replace('<#dauso#>', '1221', Yii::$app->params['yeu_cau_thanh_toan']))));
        SendMT::sendMT($model->msisdn_pay, $mtContent);
        return $this->render('_paymentOnlineInternal', [
            'id' => $model->id,
            'phoneNumber' => Helpers::hideMsisdn($model->msisdn_pay),
            'message' => $message,
            'success' => true
        ]);
    }

    public function actionPaymentOnlineConfirm1()
    {
        if (Yii::$app->user->isGuest) {
            return $this->goHome();
        }
        $id = Yii::$app->request->getBodyParam('id');
        if (!$id) {
            $this->redirect(['user/index']);
        }
        $model = OnlineRbtForm::getPaymentOwnerById($id, 1);
        if (!$model) {
            $this->redirect(['user/index']);
        }
        $msisdn = Helpers::convertMsisdn(Yii::$app->user->getIdentity()->msisdn);
        if (!Yii::$app->request->validateCsrfToken()) {
            return $this->goHome();
        }
        if (Otp::countLimitOtp($msisdn, Yii::$app->params['otp']['duration']) > Yii::$app->params['otp']['limit'] - 1) {
            return $this->render('_paymentOnline', ['id' => $id, 'phoneNumber' => Helpers::hideMsisdn($msisdn), 'message' => 'Số thuê bao <span class=\'txt-color\'>' . Helpers::hideMsisdn($msisdn) . '</span> đã vượt quá số lần lấy OTP']);
        }
        $otp = Otp::gen($msisdn);
        OtpConfirm::deleteByMsisdn($msisdn);
        $discount = Helpers::getDiscount($id);
        $fee = FEE_KHOI_TAO * (100 - $discount) / 100;
        $mtContent = str_replace('<#fee#>', number_format($fee, 0, ",", "."), str_replace('<#otp#>', $otp, \Yii::$app->params['otp_thanh_toan_phi_nhac_cho']));
        SendMT::sendMT($msisdn, $mtContent);
        $model = new OtpConfirmForm();
        return $this->render('_paymentOnlineOtp', [
            'phoneNumber' => Helpers::hideMsisdn($msisdn),
            'model' => $model,
            'msisdn' => $msisdn,
            'message' => null,
            'fee' => $fee,
            'id' => $id,
            'success' => false,
        ]);
    }

    public function actionPaymentOnlineConfirm2()
    {
        if (Yii::$app->user->isGuest) {
            return $this->goHome();
        }
        $id = Yii::$app->request->getBodyParam('id');
        if (!$id) {
            return $this->redirect(['user/index']);
        }
        $model = OnlineRbtForm::getPaymentOwnerById($id, 1);
        if (!$model) {
            return $this->redirect(['user/index']);
        }
        $model = new OtpConfirmForm();
        $msisdn = Helpers::convertMsisdn(Yii::$app->user->getIdentity()->msisdn);
        $message = '';
        $rbtFile = EnterpriseFile::getUpdateById($id);
        $success = false;
        $exampleVoices = ArrayHelper::map(EprVoices::getAll(), 'id', 'description');
        $voiceSpeeds = ['0.9' => 'Chậm', '1.0' => 'Bình thường', '1.1' => 'Nhanh'];
        // Charge only INIT FEE
        $discount = Helpers::getDiscount($rbtFile->id);
        $fee = FEE_KHOI_TAO * (100 - $discount) / 100;
        if ($msisdn && $model->load(Yii::$app->request->post()) && $model->validate()) {
            if (!OtpConfirm::validateLimit($msisdn, Yii::$app->params['otp']['validate_limit'])) {
                Yii::info("[actionPaymentOnlineConfirm2] {$msisdn} validate limit over {" . Yii::$app->params['otp']['validate_limit'] . "}", "otp");
                $message = 'Bạn đã vượt quá số lần nhập sai mã OTP (' . Yii::$app->params['otp']['validate_limit'] . ' lần) với số thuê bao ' .
                    $msisdn . ". Vui lòng lấy lại mã xác thực OTP!";
            } else if (Otp::validateOtp($msisdn, $model->otp)) {
                list($errorCode, $log) = Charging::charge($msisdn, $fee);
                /* @var ChargingLogBase $log */
                $message = $mtContent = str_replace('<#fee#>', $fee, ChargingError::getMessage($errorCode));
                if ($errorCode == 0) {
                    $rbtFile->status = RBT_STATUS_WAITING;
                    $rbtFile->save(false);
                    $log->enterprise_file_id = $rbtFile->id;
                    $log->enterprise_id = $rbtFile->enterprise_id;
                    $log->type = TYPE_FEE_KHOI_TAO;
                    $log->discount = $discount;
                    $log->old_fee = FEE_KHOI_TAO;
                    $log->save(false);
                    $mtContent = str_replace('<#fee#>', number_format($fee, 0, ",", "."), str_replace('<#code#>', Helpers::eprCode($rbtFile->id), \Yii::$app->params['thanh_toan_thanh_cong']));
                    SendMT::sendMT($msisdn, $mtContent);
                    $success = true;
                    Yii::info("[actionPaymentOnlineConfirm2] {$msisdn} charge fee {$fee} successful !", "Charging");
                } else if ($errorCode == '401') {
                    $mtContent = str_replace('<#fee#>', number_format($fee, 0, ",", "."), \common\libs\ChargingError::getMessage(401));
                    SendMT::sendMT($msisdn, $mtContent);
                    Yii::info("[actionPaymentOnlineConfirm2] {$msisdn} charge fee {$fee} failed 401 !", "Charging");
                    $log->enterprise_file_id = $rbtFile->id;
                    $log->enterprise_id = $rbtFile->enterprise_id;
                    $log->type = TYPE_FEE_KHOI_TAO;
                    $log->discount = $discount;
                    $log->old_fee = FEE_KHOI_TAO;
                    $log->save(false);
                    $message = 'Tài khoản của quý khách không đủ để thực hiện giao dịch thanh toán này. Vui lòng nạp thêm tiền vào tài khoản gốc và thao tác lại!';
                    return $this->render('paymentOnline', [
                        'message' => $message,
                        'discount' => Helpers::getDiscount($rbtFile->id),
                        'voiceSpeed' => $voiceSpeeds[number_format($rbtFile->intonational, 1)],
                        'exampleVoice' => $exampleVoices[$rbtFile->accent],
                        'model' => $rbtFile,
                        'fee' => $fee,
                        'back' => null,
                        'phoneNumber' => Helpers::hideMsisdn(Yii::$app->user->getIdentity()->msisdn),
                    ]);
                } else {
                    Yii::info("[actionPaymentOnlineConfirm2] {$msisdn} charge fee {$fee} failed {$errorCode} !", "Charging");
                    $log->enterprise_file_id = $rbtFile->id;
                    $log->enterprise_id = $rbtFile->enterprise_id;
                    $log->type = TYPE_FEE_KHOI_TAO;
                    $log->discount = $discount;
                    $log->old_fee = FEE_KHOI_TAO;
                    $log->save(false);
                    $message = 'Lỗi hệ thống, xin vui lòng thử lại!';
                    return $this->render('paymentOnline', [
                        'message' => $message,
                        'discount' => Helpers::getDiscount($rbtFile->id),
                        'voiceSpeed' => $voiceSpeeds[number_format($rbtFile->intonational, 1)],
                        'exampleVoice' => $exampleVoices[$rbtFile->accent],
                        'model' => $rbtFile,
                        'fee' => $fee,
                        'back' => null,
                        'phoneNumber' => Helpers::hideMsisdn(Yii::$app->user->getIdentity()->msisdn),
                    ]);
                }
            } else {
                Yii::info("[actionPaymentOnlineConfirm2] {$msisdn} validate failed!", "otp");
                $model->addError('otp', 'Mã xác thực OTP không hợp lệ');
            }
        }
        return $this->render('_paymentOnlineOtp', [
            'phoneNumber' => Helpers::hideMsisdn($msisdn),
            'model' => $model,
            'msisdn' => $msisdn,
            'message' => $message,
            'fee' => $fee,
            'success' => $success,
            'id' => $id,
        ]);
    }
    /*********** END RECORD ONLINE ************/

    /*********** RECORD REQUEST ************/
    public function actionRecordRequest()
    {
        if (Yii::$app->user->isGuest) {
            return $this->goHome();
        }
        $this->layout = 'rbt';
        $id = Yii::$app->request->getQueryParam('id');
        $relateId = Yii::$app->request->getQueryParam('relate-id');
        $user = Yii::$app->user->getIdentity();
        if (!$id) {
            $model = new RequestRbtForm();
        } else {
            $model = RequestRbtForm::getUpdateOwnerById($id);
            if (!$model) {
                return $this->redirect(['user/index']);
            }
            $tmpMsisdnFile = $model->msisdn_file;
            $tmpCopyrightLicense = $model->copyright_license;
        }
        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            if($user->type == 2 && !$model->msisdn_pay) {
                $model->addError('msisdn_pay', 'Chưa nhập số điện thoại thanh toán');
            }
            $model->name = trim($model->name);
            if ($id) {
                if ($_FILES[$model->formName()]['name']['msisdn_file'] == "") {
                    $model->msisdn_file = $tmpMsisdnFile;
                } else {
                    $model->uploadTxt('msisdn_file', $_FILES[$model->formName()]);
                }

                if ($_FILES[$model->formName()]['name']['copyright_license'] == "") {
                    $model->copyright_license = $tmpCopyrightLicense;
                } else {
                    $model->upload('copyright_license',  $_FILES[$model->formName()]);
                }

            } else {
                $model->uploadTxt('msisdn_file', $_FILES[$model->formName()]);

                if ($_FILES[$model->formName()]['name']['copyright_license'] == "" || !$_FILES[$model->formName()]['name']['copyright_license']) {
                    $model->addError("copyright_license", "Bạn chưa upload file bản quyền");
                } else {
                    $model->upload('copyright_license',  $_FILES[$model->formName()]);
                }
            }
            if (!$model->id) {
                $model->enterprise_id = \Yii::$app->user->getId();
                $model->status = RBT_STATUS_NEW;
                $model->requires_recording = 1;
                $model->created_at = date('Y-m-d H:i:s', time());
            }
            if ($model->status == RBT_STATUS_REJECTED) {
                $model->status = RBT_STATUS_WAITING;
            }
            if ($model->msisdn_pay) {
                $model->msisdn_pay = Helpers::convertMsisdn($model->msisdn_pay);
            }
            if ($relateId) {
                $model->relate_id = $relateId;
            }
            if (!$model->getErrors()) {
                if ($model->save()) {
                    $model->txt2Db();
                    if($relateId) {
                        if ($user->type == USER_TYPE_INTERNAL && $model->status == RBT_STATUS_NEW && $model->msisdn_pay) {
                            return $this->redirect(['rbt/payment-request-internal', 'id' => $model->id, 'relate-id' => $relateId]);
                        } else if ($model->status == RBT_STATUS_NEW) {
                            return $this->redirect(['rbt/payment-request', 'id' => $model->id, 'relate-id' => $relateId]);
                        } else {
                            Yii::$app->session->setFlash('success', "Cập nhật thông tin thành công");
                            return $this->redirect(['user/index']);
                        }
                    } else {
                        if ($user->type == USER_TYPE_INTERNAL && $model->status == RBT_STATUS_NEW && $model->msisdn_pay) {
                            return $this->redirect(['rbt/payment-request-internal', 'id' => $model->id]);
                        } else if ($model->status == RBT_STATUS_NEW) {
                            return $this->redirect(['rbt/payment-request', 'id' => $model->id]);
                        } else {
                            Yii::$app->session->setFlash('success', "Cập nhật thông tin thành công");
                            return $this->redirect(['user/index']);
                        }
                    }

                }
            }
        }
        $failStep = 0;
        if($model->getErrors()['msisdn_file'] || $model->getErrors('msisdn_pay') || $model->getErrors('copyright_license')){
            $failStep = 3;
        }
        $sound_background = $model->sound_background;
        $accents = Yii::$app->params['rbt_request_accent'];
        $linguistics = Yii::$app->params['rbt_request_intonational'];
        $exampleContents = EprRecordingContents::getRecordingContents(5);
        return $this->render('request', [
            'model' => $model,
            'exampleContents' => $exampleContents,
            'accents' => $accents,
            'failStep' => $failStep,
            'sound_background' => $sound_background,
            'linguistics' => $linguistics,
        ]);
    }

    public function actionPaymentRequest($id, $back = '')
    {
        if (Yii::$app->user->isGuest) {
            return $this->goHome();
        }
        $this->layout = 'rbt';
        $model = RequestRbtForm::getPaymentOwnerById($id, 2);
        if (!$model) {
            return $this->redirect(['user/index']);
        }
        Helpers::calDiscount(Yii::$app->user->getIdentity()->getId(), $model->id);
        $relateId = Yii::$app->request->getQueryParam('relate-id');
        $relateItem = EnterpriseFile::getApprovedOwnerById($relateId);
        // TODO: check type of fee to charge
        if ($relateItem) {
            $fee1 = 0;
        } else {
            $fee1 = FEE_KHOI_TAO;
        }

        $fee2 = FEE_THU_AM;
        $rbtFile = EnterpriseFile::getUpdateById($id);
        $payments = ChargingLogBase::findSuccessPayment($rbtFile->id);
        foreach ($payments as $payment) {
            /* @var ChargingLogBase $payment */
            if ($payment->type == TYPE_FEE_KHOI_TAO) {
                $fee1 = 0;
            } elseif ($payment->type == TYPE_FEE_THU_AM) {
                $fee2 = 0;
            }
        }
        $discount = Helpers::getDiscount($rbtFile->id);
        $fee1 = $fee1 * (100 - $discount) / 100;
        $fee2 = $fee2 * (100 - $discount) / 100;

        return $this->render('paymentRequest', [
            'message' => null,
            'intonational' => Yii::$app->params['rbt_request_intonational'][$model->intonational],
            'accent' => Yii::$app->params['rbt_request_accent'][$model->accent],
            'fee1' => $fee1,
            'fee2' => $fee2,
            'model' => $model,
            'back' => $back,
            'phoneNumber' => Helpers::hideMsisdn(Yii::$app->user->getIdentity()->msisdn),
        ]);
    }

    public function actionPaymentRequestInternal($id, $back = '')
    {
        if (Yii::$app->user->isGuest) {
            return $this->goHome();
        }
        $this->layout = 'rbt';
        $model = RequestRbtForm::getPaymentOwnerById($id, 2);
        if (!$model) {
            return $this->redirect(['user/index']);
        }
        $fee1 = FEE_KHOI_TAO;
        $fee2 = FEE_THU_AM;
        return $this->render('paymentRequestInternal', [
            'message' => null,
            'intonational' => Yii::$app->params['rbt_request_intonational'][$model->intonational],
            'accent' => Yii::$app->params['rbt_request_accent'][$model->accent],
            'fee1' => $fee1,
            'fee2' => $fee2,
            'model' => $model,
            'back' => $back,
            'phoneNumber' => Helpers::hideMsisdn($model->msisdn_pay),
        ]);
    }

    public function actionPaymentRequestInternalConfirm()
    {
        if (Yii::$app->user->isGuest) {
            return $this->goHome();
        }
        $id = Yii::$app->request->getBodyParam('id');
        if (!$id) {
            return $this->redirect(['user/index']);
        }
        $model = RequestRbtForm::getPaymentOwnerById($id, 2);
        if (!$model) {
            return $this->redirect(['user/index']);
        }
        $message = "Tạo nhạc chờ thành công. Hệ thống đã gửi yêu cầu thanh toán đến số điện thoại <b>" .
            Helpers::hideMsisdn($model->msisdn_pay) . "</b>. Hãy hướng dẫn khách hàng soạn <b>YN " .
            Helpers::eprCode($model->id) . "</b> gửi <b>1221</b> để xác thực thanh toán";
        $mtContent = str_replace('<#fee#>',
            number_format(FEE_KHOI_TAO + FEE_THU_AM, 0, ",", "."),
            str_replace('<#command#>', 'YN ' . Helpers::eprCode($model->id),
                str_replace('<#mahs#>', Helpers::eprCode($model->id),
                    str_replace('<#dauso#>', '1221', Yii::$app->params['yeu_cau_thanh_toan']))));
        SendMT::sendMT($model->msisdn_pay, $mtContent);
        return $this->render('_paymentRequestInternal', [
            'id' => $model->id,
            'phoneNumber' => Helpers::hideMsisdn($model->msisdn_pay),
            'message' => $message,
            'success' => true
        ]);
    }

    public function actionPaymentRequestConfirm1()
    {
        if (Yii::$app->user->isGuest) {
            return $this->goHome();
        }
        $id = Yii::$app->request->getBodyParam('id');
        if (!$id) {
            return $this->redirect(['user/index']);
        }
        $model = RequestRbtForm::getPaymentOwnerById($id, 2);
        if (!$model) {
            return $this->redirect(['user/index']);
        }
        $msisdn = Helpers::convertMsisdn(Yii::$app->user->getIdentity()->msisdn);
        if (!Yii::$app->request->validateCsrfToken()) {
            return $this->goHome();
        }
        if (Otp::countLimitOtp($msisdn, Yii::$app->params['otp']['duration']) > Yii::$app->params['otp']['limit'] - 1) {
            return $this->render('_paymentRequest',
                ['id' => $id, 'phoneNumber' => Helpers::hideMsisdn($msisdn), 'message' => 'Số thuê bao <span class=\'txt-color\'>' . Helpers::hideMsisdn($msisdn) . '</span> đã vượt quá số lần lấy OTP']
            );
        }
        $otp = Otp::gen($msisdn);
        OtpConfirm::deleteByMsisdn($msisdn);
        // TODO: check type of fee to charge
        $relateId = Yii::$app->request->getQueryParam('relate-id');
        $relateItem = EnterpriseFile::getApprovedOwnerById($relateId);
        // TODO: check type of fee to charge
        if ($relateItem) {
            $fee1 = 0;
        } else {
            $fee1 = FEE_KHOI_TAO;
        }
        $fee2 = FEE_THU_AM;
        $rbtFile = EnterpriseFile::getUpdateById($id);
        $payments = ChargingLogBase::findSuccessPayment($rbtFile->id);
        foreach ($payments as $payment) {
            /* @var ChargingLogBase $payment */
            if ($payment->type == TYPE_FEE_KHOI_TAO) {
                $fee1 = 0;
            } elseif ($payment->type == TYPE_FEE_THU_AM) {
                $fee2 = 0;
            }
        }
        $discount = Helpers::getDiscount($rbtFile->id);
        $fee1 = $fee1 * (100 - $discount) / 100;
        $fee2 = $fee2 * (100 - $discount) / 100;
        $fee = $fee1 + $fee2;
        $mtContent = str_replace('<#fee#>', number_format($fee, 0, ",", "."), str_replace('<#otp#>', $otp, \Yii::$app->params['otp_thanh_toan_phi_nhac_cho']));
        SendMT::sendMT($msisdn, $mtContent);
        $model = new OtpConfirmForm();
        return $this->render('_paymentRequestOtp', [
            'phoneNumber' => Helpers::hideMsisdn($msisdn),
            'model' => $model,
            'msisdn' => $msisdn,
            'message' => null,
            'fee1' => $fee1,
            'fee2' => $fee2,
            'id' => $id,
            'success' => false,
        ]);
    }

    public function actionPaymentRequestConfirm2()
    {
        if (Yii::$app->user->isGuest) {
            return $this->goHome();
        }
        $id = Yii::$app->request->getBodyParam('id');
        if (!$id) {
            return $this->redirect(['user/index']);
        }
        $model = RequestRbtForm::getPaymentOwnerById($id, 2);
        if (!$model) {
            return $this->redirect(['user/index']);
        }
        $model = new OtpConfirmForm();
        $msisdn = Helpers::convertMsisdn(Yii::$app->user->getIdentity()->msisdn);
        $message = '';
        $rbtFile = EnterpriseFile::getUpdateById($id);
        $success = false;
        // TODO: check type of fee to charge
        $relateId = Yii::$app->request->getQueryParam('relate-id');
        $relateItem = EnterpriseFile::getApprovedOwnerById($relateId);
        // TODO: check type of fee to charge
        if ($relateItem) {
            $fee1 = 0;
        } else {
            $fee1 = FEE_KHOI_TAO;
        }
        $fee2 = FEE_THU_AM;
        $payments = ChargingLogBase::findSuccessPayment($rbtFile->id);
        foreach ($payments as $payment) {
            /* @var ChargingLogBase $payment */
            if ($payment->type == TYPE_FEE_KHOI_TAO) {
                $fee1 = 0;
            } elseif ($payment->type == TYPE_FEE_THU_AM) {
                $fee2 = 0;
            }
        }
        $discount = Helpers::getDiscount($rbtFile->id);
        $fee1 = $fee1 * (100 - $discount) / 100;
        $fee2 = $fee2 * (100 - $discount) / 100;
//        $balance = Charging::checkBalanceNew($msisdn);
        if ($msisdn && $model->load(Yii::$app->request->post()) && $model->validate()) {
            if (!OtpConfirm::validateLimit($msisdn, Yii::$app->params['otp']['validate_limit'])) {
                Yii::info("[actionPaymentRequestConfirm2] {$msisdn} validate limit over {" . Yii::$app->params['otp']['validate_limit'] . "}", "otp");
                $message = 'Bạn đã vượt quá số lần nhập sai mã OTP (' . Yii::$app->params['otp']['validate_limit'] . ' lần) với số thuê bao ' .
                    $msisdn . ". Vui lòng lấy lại mã xác thực OTP!";
            } else if (Otp::validateOtp($msisdn, $model->otp)) {
                // Charge only INIT FEE = FEE_KHOI_TAO + FEE_THU_AM
                if ($fee1) {
                    $fee = $fee1;
                    list($errorCode, $log) = Charging::charge($msisdn, $fee);
                    /* @var ChargingLogBase $log */
                    $message = $mtContent = str_replace('<#fee#>', $fee, ChargingError::getMessage($errorCode));
                    $log->type = TYPE_FEE_KHOI_TAO;
                    $log->discount = $discount;
                    $log->old_fee = FEE_KHOI_TAO;
                    $log->enterprise_file_id = $rbtFile->id;
                    $log->enterprise_id = $rbtFile->enterprise_id;
                    $log->save(false);
                    if ($errorCode == 0) {
//                        $log->save(false);
                        $mtContent = str_replace('<#fee#>', $fee,
                            str_replace('<#fee_type#>', 'phi khoi tao',
                                str_replace('<#code#>', Helpers::eprCode($rbtFile->id),
                                    str_replace('<#dauso#>', '1221', Yii::$app->params['thanh_toan_thanh_cong_online']))));
                        SendMT::sendMT($msisdn, $mtContent);
                        Yii::info("[actionPaymentRequestConfirm2] {$msisdn} charge init fee {$fee} successful !", "Charging");

                        $rbtFile->status = RBT_STATUS_WAITING_RECORD;
                        $rbtFile->save(false);
                        $success = true;
                    } else if ($errorCode == '401') {
                        $mtContent = str_replace('<#fee#>', number_format($fee, 0, ",", "."), ChargingError::getMessage(401));
                        SendMT::sendMT($msisdn, $mtContent);
                        Yii::info("[actionPaymentRequestConfirm2] {$msisdn} charge init fee {$fee} failed 401 !", "Charging");
                        $message = 'Tài khoản của quý khách không đủ để thực hiện giao dịch thanh toán này. Vui lòng nạp thêm tiền vào tài khoản gốc và thao tác lại!';
                        return $this->render('paymentRequest', [
                            'message' => $message,
                            'intonational' => Yii::$app->params['rbt_request_intonational'][$rbtFile->intonational],
                            'accent' => Yii::$app->params['rbt_request_accent'][$rbtFile->accent],
                            'model' => $rbtFile,
                            'back' => null,
                            'fee1' => $fee1,
                            'fee2' => $fee2,
                            'phoneNumber' => Helpers::hideMsisdn(Yii::$app->user->getIdentity()->msisdn),
                        ]);
                    } else {
                        Yii::info("[actionPaymentRequestConfirm2] {$msisdn} charge init fee {$fee} failed {$errorCode} !", "Charging");
                        $message = 'Lỗi hệ thống, xin vui lòng thử lại!';
                        return $this->render('paymentRequest', [
                            'message' => $message,
                            'intonational' => Yii::$app->params['rbt_request_intonational'][$rbtFile->intonational],
                            'accent' => Yii::$app->params['rbt_request_accent'][$rbtFile->accent],
                            'model' => $rbtFile,
                            'back' => null,
                            'fee1' => $fee1,
                            'fee2' => $fee2,
                            'phoneNumber' => Helpers::hideMsisdn(Yii::$app->user->getIdentity()->msisdn),
                        ]);
                    }
                } else {
                    $success = true;
                }
                if ($fee2 && $success) {
                    $fee = $fee2;
                    list($errorCode, $log) = Charging::charge($msisdn, $fee);
                    /* @var ChargingLogBase $log */
                    $message = $mtContent = str_replace('<#fee#>', $fee, ChargingError::getMessage($errorCode));
                    $log->type = TYPE_FEE_THU_AM;
                    $log->discount = $discount;
                    $log->old_fee = FEE_THU_AM;
                    $log->enterprise_file_id = $rbtFile->id;
                    $log->enterprise_id = $rbtFile->enterprise_id;
                    $log->save(false);
                    if ($errorCode == 0) {
//                        $log->save(false);

                        $mtContent = str_replace('<#fee#>', $fee,
                            str_replace('<#fee_type#>', 'phi thu am',
                                str_replace('<#code#>', Helpers::eprCode($rbtFile->id),
                                    str_replace('<#dauso#>', '1221', Yii::$app->params['thanh_toan_thanh_cong_online']))));
                        SendMT::sendMT($msisdn, $mtContent);
                        Yii::info("[actionPaymentRequestConfirm2] {$msisdn} charge record fee {$fee} successful !", "Charging");
                        $success = true;
                    } else if ($errorCode == '401') {
                        $mtContent = str_replace('<#fee#>', number_format($fee, 0, ",", "."), ChargingError::getMessage(401));
                        SendMT::sendMT($msisdn, $mtContent);
                        Yii::info("[actionPaymentRequestConfirm2] {$msisdn} charge record fee {$fee} failed 401 !", "Charging");
                        $message = 'Tài khoản của quý khách không đủ để thực hiện giao dịch thanh toán này. Vui lòng nạp thêm tiền vào tài khoản gốc và thao tác lại!';
                        return $this->render('paymentRequest', [
                            'message' => $message,
                            'intonational' => Yii::$app->params['rbt_request_intonational'][$rbtFile->intonational],
                            'accent' => Yii::$app->params['rbt_request_accent'][$rbtFile->accent],
                            'model' => $rbtFile,
                            'back' => null,
                            'fee1' => $fee1,
                            'fee2' => $fee2,
                            'phoneNumber' => Helpers::hideMsisdn(Yii::$app->user->getIdentity()->msisdn),
                        ]);
                    } else {
                        Yii::info("[actionPaymentRequestConfirm2] {$msisdn} charge record fee {$fee} failed {$errorCode} !", "Charging");
                        $message = 'Lỗi hệ thống, xin vui lòng thử lại!';
                        return $this->render('paymentRequest', [
                            'message' => $message,
                            'intonational' => Yii::$app->params['rbt_request_intonational'][$rbtFile->intonational],
                            'accent' => Yii::$app->params['rbt_request_accent'][$rbtFile->accent],
                            'model' => $rbtFile,
                            'back' => null,
                            'fee1' => $fee1,
                            'fee2' => $fee2,
                            'phoneNumber' => Helpers::hideMsisdn(Yii::$app->user->getIdentity()->msisdn),
                        ]);
                    }
                }
                if ($success || (!$fee1 && !$fee2)) {
                    $rbtFile->status = RBT_STATUS_WAITING_RECORD;
                    $rbtFile->save(false);
                }
            } else {
                Yii::info("[actionPaymentRequestConfirm2] {$msisdn} validate failed!", "otp");
                $model->addError('otp', 'Mã xác thực OTP không hợp lệ');
            }
        }
        return $this->render('_paymentRequestOtp', [
            'phoneNumber' => Helpers::hideMsisdn($msisdn),
            'model' => $model,
            'msisdn' => $msisdn,
            'message' => $message,
            'success' => $success,
            'fee1' => $fee1,
            'fee2' => $fee2,
            'id' => $id,
        ]);
    }
    /*********** END RECORD REQUEST ************/

    /*********** RECORD UPLOAD ************/
    public function actionRecordUpload()
    {
        if (Yii::$app->user->isGuest) {
            return $this->goHome();
        }
        $this->layout = 'rbt';
        $id = Yii::$app->request->getQueryParam('id');
        $user = Yii::$app->user->getIdentity();
        /* @var Enteprise $user */
        $relateId = Yii::$app->request->getQueryParam('relate-id');
        $relateItem = EnterpriseFile::getApprovedOwnerById($relateId);
        if (!$id) {
            $model = new UploadRbtForm();
        } else {
            $model = UploadRbtForm::getUpdateOwnerById($id);
            $tmpMsisdnFile = $model->msisdn_file;
            $tmpRecordingFile = $model->recording_file;
            $tmpCopyrightLicense = $model->copyright_license;
            if (!$model) {
                return $this->redirect(['user/index']);
            }
        }
//        var_dump(Yii::$app->request->post()); die();
        if ($model->load(Yii::$app->request->post())) {
            $files = $_FILES[$model->formName()];
            if ($id) {
                if ($files['name']['msisdn_file'] == "") {
                    $model->msisdn_file = $tmpMsisdnFile;
                } else {
                    $model->uploadTxt('msisdn_file', $files);
                }

                if ($files['name']['copyright_license'] == "") {
                    $model->copyright_license = $tmpCopyrightLicense;
                } else {
                    $model->upload('copyright_license', $files);
                }

                if ($files['name']['recording_file']) {
                    $model->uploadMp3('recording_file', $files);
                } else {
                    $model->recording_file = $tmpRecordingFile;
                }
            } else {
                $model->uploadTxt('msisdn_file', $files);

                if ($files['name']['copyright_license'] == "" || !$files['name']['copyright_license']) {
                    $model->addError("copyright_license", "Bạn chưa upload file bản quyền");
                } else {
                    $model->upload('copyright_license', $files);
                }

                if ($files['name']['recording_file']) {
                    $model->uploadMp3('recording_file', $files);
                } else {
                    $model->addError('recording_file', Yii::t('frontend', 'Bạn chưa upload file nhạc chờ quảng cáo'));
                }

            }
            $model->name = trim($model->name);
            if (!$model->id) {
                $model->name = trim($model->name);
                $model->enterprise_id = \Yii::$app->user->getId();
                $model->status = RBT_STATUS_NEW;
                $model->requires_recording = 0;
                $model->created_at = date('Y-m-d H:i:s', time());
            }
            if ($relateItem || $model->status == RBT_STATUS_REJECTED) {
                $model->status = RBT_STATUS_WAITING;
            }
            if ($relateItem) {
                $model->relate_id = $relateId;
            }
            if ($model->msisdn_pay) {
                $model->msisdn_pay = Helpers::convertMsisdn($model->msisdn_pay);
            }
            if($user->type == 2 && !$model->msisdn_pay) {
                $model->addError('msisdn_pay', 'Chưa nhập số điện thoại thanh toán');
            }
            if (!$model->getErrors()) {
                if ($model->validate()) {
                    if ($model->save()) {
                        $model->txt2Db();
                        if ($user->type == USER_TYPE_INTERNAL && $model->status == RBT_STATUS_NEW && $model->msisdn_pay) {
                            return $this->redirect(['rbt/payment-upload-internal', 'id' => $model->id]);
                        } else if ($model->status == RBT_STATUS_NEW) {
                            return $this->redirect(['rbt/payment-upload', 'id' => $model->id]);
                        } else {
                            Yii::$app->session->setFlash('success', "Cập nhật thông tin thành công");
                            return $this->redirect(['user/index']);
                        }
                    }
                }
            }
        }
        return $this->render('upload', [
            'model' => $model
        ]);
    }

    public function actionPaymentUpload($id, $back = '')
    {
        if (Yii::$app->user->isGuest) {
            return $this->goHome();
        }
        $this->layout = 'rbt';
        $model = UploadRbtForm::getPaymentOwnerById($id, 3);
        if (!$model) {
            return $this->goHome();
        }
        Helpers::calDiscount(Yii::$app->user->getIdentity()->getId(), $model->id);
        $discount = Helpers::getDiscount($id);
        $fee = FEE_KHOI_TAO * (100 - $discount) / 100;

        return $this->render('paymentUpload', [
            'message' => '',
            'back' => $back,
            'model' => $model,
            'fee' => $fee,
            'phoneNumber' => Helpers::hideMsisdn(Yii::$app->user->getIdentity()->msisdn),
        ]);
    }

    public function actionPaymentUploadInternal($id, $back = '')
    {
        if (Yii::$app->user->isGuest) {
            return $this->goHome();
        }
        $this->layout = 'rbt';
        $model = UploadRbtForm::getPaymentOwnerById($id, 3);
        if (!$model) {
            return $this->goHome();
        }
        $fee = FEE_KHOI_TAO;

        return $this->render('paymentUploadInternal', [
            'message' => '',
            'back' => $back,
            'model' => $model,
            'fee' => $fee,
            'phoneNumber' => Helpers::hideMsisdn($model->msisdn_pay),
        ]);
    }

    public function actionPaymentUploadInternalConfirm()
    {
        if (Yii::$app->user->isGuest) {
            return $this->goHome();
        }
        $id = Yii::$app->request->getBodyParam('id');
        if (!$id) {
            return $this->redirect(['user/index']);
        }
        $model = UploadRbtForm::getPaymentOwnerById($id, 3);
        if (!$model) {
            return $this->redirect(['user/index']);
        }
        $message = "Tạo nhạc chờ thành công. Hệ thống đã gửi yêu cầu thanh toán đến số điện thoại <b>" .
            Helpers::hideMsisdn($model->msisdn_pay) . "</b>. Hãy hướng dẫn khách hàng soạn <b>YN " .
            Helpers::eprCode($model->id) . "</b> gửi <b>1221</b> để xác thực thanh toán";
        $mtContent = str_replace('<#fee#>',
            number_format(FEE_KHOI_TAO, 0, ",", "."),
            str_replace('<#command#>', 'YN ' . Helpers::eprCode($model->id),
                str_replace('<#mahs#>', Helpers::eprCode($model->id),
                    str_replace('<#dauso#>', '1221', Yii::$app->params['yeu_cau_thanh_toan']))));
        SendMT::sendMT($model->msisdn_pay, $mtContent);
        return $this->render('_paymentUploadInternal', [
            'id' => $model->id,
            'phoneNumber' => Helpers::hideMsisdn($model->msisdn_pay),
            'message' => $message,
            'success' => true
        ]);
    }

    public function actionPaymentUploadConfirm1()
    {
        if (Yii::$app->user->isGuest) {
            return $this->goHome();
        }
        $id = Yii::$app->request->getBodyParam('id');
        if (!$id) {
            return $this->redirect(['user/index']);
        }
        $model = UploadRbtForm::getPaymentOwnerById($id, 3);
        if (!$model) {
            return $this->redirect(['user/index']);
        }
        $msisdn = Helpers::convertMsisdn(Yii::$app->user->getIdentity()->msisdn);
        if (!Yii::$app->request->validateCsrfToken()) {
            return $this->goHome();
        }
        if (Otp::countLimitOtp($msisdn, Yii::$app->params['otp']['duration']) > Yii::$app->params['otp']['limit'] - 1) {
            return $this->render('_paymentUpload', ['id' => $id, 'phoneNumber' => Helpers::hideMsisdn($msisdn), 'message' => 'Số thuê bao <span class=\'txt-color\'>' . Helpers::hideMsisdn($msisdn) . '</span> đã vượt quá số lần lấy OTP']);
        }
        $otp = Otp::gen($msisdn);
        OtpConfirm::deleteByMsisdn($msisdn);
        $discount = Helpers::getDiscount($id);
        $fee = FEE_KHOI_TAO * (100 - $discount) / 100;
        $mtContent = str_replace('<#fee#>', number_format($fee, 0, ",", "."), str_replace('<#otp#>', $otp, \Yii::$app->params['otp_thanh_toan_phi_nhac_cho']));
        SendMT::sendMT($msisdn, $mtContent);
        $model = new OtpConfirmForm();
        return $this->render('_paymentUploadOtp', [
            'phoneNumber' => Helpers::hideMsisdn($msisdn),
            'model' => $model,
            'msisdn' => $msisdn,
            'message' => '',
            'fee' => $fee,
            'id' => $id,
            'success' => false,
        ]);
    }

    public function actionPaymentUploadConfirm2()
    {
        if (Yii::$app->user->isGuest) {
            return $this->goHome();
        }
        $id = Yii::$app->request->getBodyParam('id');
        if (!$id) {
            return $this->redirect(['user/index']);
        }
        $model = UploadRbtForm::getPaymentOwnerById($id, 3);
        if (!$model) {
            return $this->redirect(['user/index']);
        }
        $model = new OtpConfirmForm();
        $msisdn = Helpers::convertMsisdn(Yii::$app->user->getIdentity()->msisdn);
        $message = '';
        $rbtFile = EnterpriseFile::getUpdateById($id);
        $success = false;
        $discount = Helpers::getDiscount($rbtFile->id);
        $fee = FEE_KHOI_TAO * (100 - $discount) / 100;
        if ($msisdn && $model->load(Yii::$app->request->post()) && $model->validate()) {
            if (!OtpConfirm::validateLimit($msisdn, Yii::$app->params['otp']['validate_limit'])) {
                Yii::info("[actionPaymentUploadConfirm2] {$msisdn} validate limit over {" . Yii::$app->params['otp']['validate_limit'] . "}", "otp");
                $message = 'Bạn đã vượt quá số lần nhập sai mã OTP (' . Yii::$app->params['otp']['validate_limit'] . ' lần) với số thuê bao ' .
                    $msisdn . ". Vui lòng lấy lại mã xác thực OTP!";

            } else if (Otp::validateOtp($msisdn, $model->otp)) {
                // Charge only INIT FEE = FEE_KHOI_TAO
                $discount = Helpers::getDiscount($rbtFile->id);
                list($errorCode, $log) = Charging::charge($msisdn, $fee);
                /* @var ChargingLogBase $log */
                $message = $mtContent = str_replace('<#fee#>', $fee, ChargingError::getMessage($errorCode));
                $log->enterprise_file_id = $rbtFile->id;
                $log->enterprise_id = $rbtFile->enterprise_id;
                $log->type = TYPE_FEE_KHOI_TAO;
                $log->discount = $discount;
                $log->old_fee = FEE_KHOI_TAO;
                $log->save(false);
                if ($errorCode == 0) {
                    $rbtFile->status = RBT_STATUS_WAITING;
                    $rbtFile->save(false);
                    $mtContent = str_replace('<#fee#>', number_format($fee, 0, ",", "."), str_replace('<#code#>', Helpers::eprCode($rbtFile->id), \Yii::$app->params['thanh_toan_thanh_cong']));
                    SendMT::sendMT($msisdn, $mtContent);
                    $success = true;
                    Yii::info("[actionPaymentUploadConfirm2] {$msisdn} charge fee {$fee} successful !", "Charging");
                } else if ($errorCode == '401') {
                    $mtContent = str_replace('<#fee#>', number_format($fee, 0, ",", "."), ChargingError::getMessage(401));
                    SendMT::sendMT($msisdn, $mtContent);
                    Yii::info("[actionPaymentUploadConfirm2] {$msisdn} charge fee {$fee} failed 401 !", "Charging");
                    $message = 'Tài khoản của quý khách không đủ để thực hiện giao dịch thanh toán này. Vui lòng nạp thêm tiền vào tài khoản gốc và thao tác lại!';
                    return $this->render('paymentUpload', [
                        'message' => $message,
                        'discount' => Helpers::getDiscount($rbtFile->id),
                        'model' => $rbtFile,
                        'fee' => $fee,
                        'phoneNumber' => Helpers::hideMsisdn(Yii::$app->user->getIdentity()->msisdn),
                        'back' => null,
                    ]);
                } else {
                    Yii::info("[actionPaymentUploadConfirm2] {$msisdn} charge fee {$fee} failed {$errorCode} !", "Charging");
                    $message = 'Lỗi hệ thống, xin vui lòng thử lại!';
                    return $this->render('paymentUpload', [
                        'message' => $message,
                        'discount' => Helpers::getDiscount($rbtFile->id),
                        'model' => $rbtFile,
                        'fee' => $fee,
                        'phoneNumber' => Helpers::hideMsisdn(Yii::$app->user->getIdentity()->msisdn),
                        'back' => null,
                    ]);
                }
            } else {
                Yii::info("[actionPaymentUploadConfirm2] {$msisdn} validate failed!", "otp");
                $model->addError('otp', 'Mã xác thực OTP không hợp lệ');
            }
        }
        return $this->render('_paymentUploadOtp', [
            'phoneNumber' => Helpers::hideMsisdn($msisdn),
            'model' => $model,
            'msisdn' => $msisdn,
            'message' => $message,
            'success' => $success,
            'id' => $id,
            'fee' => $fee,
            'epr_id' => Helpers::eprCode($id)
        ]);
    }

    /*********** END RECORD UPLOAD ************/

    public function actionGenerateRbt()
    {
        $this->layout = false;
        Yii::$app->response->format = Response::FORMAT_JSON;
        if (Yii::$app->user->isGuest) {
            return array('code' => 403, 'message' => "Bạn chưa đăng nhập!");
        }
        $content = $_POST['content'];
        $giongdoc = $_POST['giongdoc'];
        $playback_speed = $_POST['playback_speed'];
        $background = $_POST['background'];
        if (!Yii::$app->user->isGuest && $mp3File = Voices::getVoice($content, $giongdoc, $playback_speed)) {
            Yii::info("result getVoice mp3File: $mp3File", "vtcc.ai");
            $endFile = trim($mp3File, '.mp3') . '1.mp3';
            $rootFile = Yii::getAlias('@frontend_upload') . $mp3File;
            $endFileDir = Yii::getAlias('@frontend_upload') . $endFile;
            $mp3file = new MP3File($rootFile);
            $duration = $mp3file->getDuration();
            Yii::info("duration mp3File: $mp3File => $duration", "vtcc.ai");
            if ($duration >= 30 && $duration <= 43) {
                if ($background && is_file($backFile = Yii::getAlias('@frontend_upload') . $background)) {
                    $cmd = str_replace('<#endmp3#>', $endFileDir, str_replace('<#background#>', $backFile, str_replace('<#mp3#>', $rootFile, Yii::$app->params['ffmpeg_mer'])));
                    exec($cmd);
                    Yii::info("create rbt success with background music /uploads$endFile", "vtcc.ai");
                    return array('code' => 200, 'url' => $endFile, 'message' => "Tạo voice với nhạc nền thành công", 'mp3dir' => '/uploads' . $endFile);
                } else {
                    return array('code' => 200, 'url' => $mp3File, 'message' => "Tạo voice thành công", 'mp3dir' => '/uploads' . $mp3File);
                }
            } else {
                if ($duration > 43) {
                    return array('code' => 0, 'message' => "Nội dung quá dài (" . $duration . "s). Nội dung phải >=30s hoặc <= 43s.");
                } elseif ($duration < 30) {
                    return array('code' => 0, 'message' => "Nội dung quá ngắn (" . $duration . "s). Nội dung phải >=30s hoặc <= 43s.");
                }
            }
        } else {
            sleep(1);
            return array('code' => 401, 'message' => "Có lỗi xảy ra, vui lòng thử lại sau!");
        }
    }
}