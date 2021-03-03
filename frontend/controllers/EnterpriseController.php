<?php

namespace frontend\controllers;

use api\libs\Helper;
use common\helpers\Helpers as Helpersn;
use frontend\models\Enteprise;
use frontend\models\EprBackground;
use frontend\models\EprVoices;
use Yii;
use frontend\models\EprRecordingContents;

use function PHPSTORM_META\type;

/**
 * User controller
 */
class EnterpriseController extends AppController
{

    /**
     * Displays userpage.
     *
     * @return mixed
     */
    public function actionRegister()
    {
        // $this->layout = "register";
        $model = new \frontend\models\EnterpriseFile();
        $type = Yii::$app->request->queryParams['type'];
        return $this->render('register', [
            'model' => $model,
            'step' => 3,
            'type' => $type,
        ]);
    }

    public function actionIndex()
    {
        $this->layout = "register";
        $type = Yii::$app->request->queryParams['type'];
        // var_dump($type); die;
        $model = new \frontend\models\EnterpriseFile();
        return $this->render('index', [
            'model' => $model,
            'step' => 3,
            'type' => $type,
        ]);
    }

    public function actionRegister1()
    {
        $this->layout = 'register';
        $model = new \frontend\models\RegisterForm1();
        $type1 = Yii::$app->request->queryParams['type'];
        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            $msisdn_file = "";
            if ($model->msisdn_file != null) {
                $msisdn_file = $model->uploadTxt('msisdn_file', $_FILES[$model->formName()]);
            }
            $business_license = $model->upload('business_license', $_FILES[$model->formName()]);
            $copyright_license = $model->upload('copyright_license', $_FILES[$model->formName()]);
            if (!sizeof($model->getErrors())) {
                $model->business_license = $business_license;
                if ($msisdn_file != "") {
                    $model->msisdn_file = $msisdn_file;
                }
                $model->copyright_license = $copyright_license;
                $model->enterprise_id = \Yii::$app->user->getId();
                $model->status = 0;
                $model->requires_recording = 1;
                $model->created_at = new \yii\db\Expression('now()');
                if ($model->save()) {
                    $model->txt2Db();
                    $type = Yii::$app->getRequest()->getQueryParam('type');
                    if ($type === 'paid') {
                        return $this->redirect(\yii\helpers\Url::to(['/enterprise/payment', 'id' => $model->id, 'type' => 'paid']));
                    } else {
                        return $this->redirect(\yii\helpers\Url::to(['/enterprise/payment', 'id' => $model->id, 'type' => 'new']));
                    }
                }
            }
        }
        return $this->render('register', [
            'model' => $model,
            'step' => 1,
            'type' => $type1,
            'errors' => $model->getErrors()
        ]);
    }

    public function actionRegister2()
    {
        $this->layout = 'register';
        $model = new \frontend\models\RegisterForm2();
        $type1 = Yii::$app->request->queryParams['type'];
        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            if ($recording_file = $model->uploadMp3('recording_file', $_FILES[$model->formName()])) {
                $business_license = $model->upload('business_license', $_FILES[$model->formName()]);
                $msisdn_file = $model->uploadTxt('msisdn_file', $_FILES[$model->formName()]);
                $copyright_license = $model->upload('copyright_license', $_FILES[$model->formName()]);
                if (!sizeof($model->getErrors())) {
                    $model->copyright_license = "$copyright_license";
                    $model->business_license = "$business_license";
                    $model->msisdn_file = "$msisdn_file";
                    $model->recording_file = "$recording_file";
                    $model->enterprise_id = \Yii::$app->user->getId();
                    $model->status = 0;
                    $model->requires_recording = 0;
                    $model->created_at = new \yii\db\Expression('now()');
                    if ($model->save()) {
                        $model->txt2Db();
                        $type = Yii::$app->getRequest()->getQueryParam('type');
                        if ($type === 'paid') {
                            return $this->redirect(\yii\helpers\Url::to(['/enterprise/update2', 'id' => $model->id, 'rs' => 'success', 'type' => 'paid']));
                        } else {
                            return $this->redirect(\yii\helpers\Url::to(['/enterprise/payment', 'id' => $model->id]));
                        }
                    }
                }
            } else {
                $model->addError('recording_file', 'Bạn chưa up file quảng cáo');
            }
        }
        return $this->render('register', [
            'model' => $model,
            'step' => 2,
            'type' => $type1,
            'errors' => $model->getErrors()
        ]);
    }

    public function actionRegister3()
    {
        // $this->layout = "register";
        $model = new \frontend\models\RegisterForm3();
        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            $business_license = $model->upload('business_license', $_FILES[$model->formName()]);
            $msisdn_file = $model->uploadTxt('msisdn_file', $_FILES[$model->formName()]);
            $copyright_license = $model->upload('copyright_license', $_FILES[$model->formName()]);
            if (!sizeof($model->getErrors())) {
                $model->copyright_license = "$copyright_license";
                $model->business_license = "$business_license";
                $model->msisdn_file = "$msisdn_file";
                $model->enterprise_id = \Yii::$app->user->getId();
                $model->status = 0;
                $model->requires_recording = 3;
                $model->created_at = new \yii\db\Expression('now()');
                if ($model->save()) {
                    $model->txt2Db();
                    return $this->redirect(\yii\helpers\Url::to(['/enterprise/voice', 'id' => $model->id]));
                }
            }
        }
        return $this->render('register', [
            'model' => $model,
            'step' => 3,
            'errors' => $model->getErrors()
        ]);
    }

    public function actionUpdate3($id)
    {
        $this->layout = 'register';
        $model = \frontend\models\RegisterForm3::findOne($id);
        $status = $model->status;

        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            $business_license = $model->upload('business_license', $_FILES[$model->formName()]);
            $msisdn_file = $model->uploadTxt('msisdn_file', $_FILES[$model->formName()]);
            $copyright_license = $model->upload('copyright_license', $_FILES[$model->formName()]);
            if (!sizeof($model->getErrors())) {
                $model->copyright_license = "$copyright_license";
                $model->business_license = "$business_license";
                $model->msisdn_file = "$msisdn_file";
                $model->enterprise_id = \Yii::$app->user->getId();
                $model->status = ($status == 4) ? 1 : $status;
                $model->requires_recording = 3;
                if ($model->save()) {
                    $model->txt2Db();
                    \Yii::$app->session->setFlash('success', 'Cập nhật thành công!');
                    if (!$status) {
                        return $this->redirect(\yii\helpers\Url::to(['/enterprise/voice', 'id' => $model->id]));
                    } else {
                        $msisdn = Yii::$app->user->identity->msisdn;
                        $mtContent = str_replace('<#id#>', \common\helpers\Helpers::eprCode($id), \Yii::$app->params['cap_nhat_ho_so']);
                        \common\helpers\SendMT::sendMT($msisdn, $mtContent);
                        return $this->redirect('/home');
                    }
                }
            }
        }
        return $this->render('update', [
            'model' => $model,
            'step' => 3,
            'errors' => $model->getErrors()
        ]);
    }

    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        $this->layout = 'register';
        // var_dump($model); die;
        $enterprise = new \frontend\models\RegisterForm3();;
        $enterprise2 = new \frontend\models\VoiceForm();;
        $enterprise = $enterprise::findOne($id);
        $enterprise2 = $enterprise2::findOne($id);
        // $enterprise = new \frontend\models\RegisterForm3();
        $playback_speed = "1.0";
        $giongdoc = 'lethiyen';
        $voices = \frontend\models\EprVoices::find()->orderBy('name')->all();
        $backgroups = \frontend\models\EprBackground::find()->orderBy('name')->limit(5)->all();
        // var_dump($enterprise);
        // die;
        switch ($model->requires_recording) {
            case 0:
                $step = 2;
                break;
            case 1:
                $step = 1;
                break;
            case 3:
                $step = 3;
                break;
        }
        if ($step != 3) {
            return $this->render('update', [
                'model' => $model,
                'step' => $step,
            ]);
        } else {
            // $model->formName = 'VoiceForm';
            return $this->render('update', [
                'model' => $model,
                'formName' => 'VoiceForm',
                'step' => $step,
                'backgroups' => $backgroups,
                'voices' => $voices,
                'playback_speed' => $playback_speed,
                'giongdoc' => $giongdoc,
                'enterprise' => $enterprise2,
                'errors' => $model->getErrors(),
            ]);
        }
    }

    public function actionUpdate1($id)
    {
        $this->layout = 'register';
        $type = Yii::$app->getRequest()->getQueryParam('type');
        // var_dump($type); die;
        $model = \frontend\models\RegisterForm1::findOne($id);
        $status = $model->status;
        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            $business_license = $model->upload('business_license', $_FILES[$model->formName()]);
            $msisdn_file = $model->uploadTxt('msisdn_file', $_FILES[$model->formName()]);
            $copyright_license = $model->upload('copyright_license', $_FILES[$model->formName()]);
            if (!sizeof($model->getErrors())) {
                $model->business_license = "$business_license";
                $model->msisdn_file = "$msisdn_file";
                $model->copyright_license = "$copyright_license";
                $model->enterprise_id = \Yii::$app->user->getId();
                $model->requires_recording = 1;
                $model->status = ($status == 4) ? 1 : $status;
                if ($model->save()) {
                    $model->txt2Db();
                    \Yii::$app->session->setFlash('success', 'Cập nhật thành công!');
                    if (!$status) {
                        return $this->redirect(\yii\helpers\Url::to(['/enterprise/payment', 'id' => $model->id]));
                    } else {
                        $msisdn = Yii::$app->user->identity->msisdn;
                        $mtContent = str_replace('<#id#>', \common\helpers\Helpers::eprCode($id), \Yii::$app->params['cap_nhat_ho_so']);
                        \common\helpers\SendMT::sendMT($msisdn, $mtContent);
                        return $this->render('update', [
                            'model' => $model,
                            'step' => 1,
                            'type' => $type,
                            'errors' => $model->getErrors()
                        ]);
                    }
                }
            }
        }
        return $this->render('update', [
            'model' => $model,
            'step' => 1,
            'type' => $type,
            'errors' => $model->getErrors()
        ]);
    }

//    public function actionUpdate2($id)
//    {
//        $this->layout = 'register';
//        $model = \frontend\models\RegisterForm2::findOne($id);
//        $status = $model->status;
//        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
//            if ($recording_file = $model->uploadMp3('recording_file', $_FILES[$model->formName()])) {
//                $business_license = $model->upload('business_license', $_FILES[$model->formName()]);
//                $msisdn_file = $model->uploadTxt('msisdn_file', $_FILES[$model->formName()]);
//                $copyright_license = $model->upload('copyright_license', $_FILES[$model->formName()]);
//                if (!sizeof($model->getErrors())) {
//                    $model->copyright_license = "$copyright_license";
//                    $model->business_license = "$business_license";
//                    $model->msisdn_file = "$msisdn_file";
//                    $model->recording_file = "$recording_file";
//                    $model->enterprise_id = \Yii::$app->user->getId();
//                    $model->requires_recording = 0;
//                    $model->status = ($status == 4) ? 1 : $status;
//                    if ($model->save()) {
//                        $model->txt2Db();
//                        \Yii::$app->session->setFlash('success', 'Cập nhật thành công!');
//                        // var_dump(!$status);die;
//                        if (!$status) {
//                            return $this->redirect(\yii\helpers\Url::to(['/enterprise/payment', 'id' => $model->id]));
//                        } else {
//                            $msisdn = Yii::$app->user->identity->msisdn;
//                            $mtContent = str_replace('<#id#>', \common\helpers\Helpers::eprCode($id), \Yii::$app->params['cap_nhat_ho_so']);
//                            \common\helpers\SendMT::sendMT($msisdn, $mtContent);
//                            return $this->render('update', [
//                                'model' => $model,
//                                'step' => 2,
//                                'errors' => $model->getErrors()
//                            ]);
//                            return $this->redirect('/user');
//                        }
//                    }
//                }
//            } else {
//                $model->addError('recording_file', 'Bạn chưa up file quảng cáo');
//            }
//        }
//        return $this->render('update', [
//            'model' => $model,
//            'step' => 2,
//            'errors' => $model->getErrors()
//        ]);
//    }

    public function actionPayment($id)
    {
        $this->layout = 'register';
        $type = Yii::$app->getRequest()->getQueryParam('type');
        $model = $this->findModel($id);
        $msisdn = Enteprise::getMsisdnById($model->enterprise_id);
        $msisdn = Helpersn::hideMsisdn($msisdn);
        // var_dump($msisdn); die;
        return $this->render('payment', [
            'model' => $model,
            'msisdn' => $msisdn,
            'type' => $type,
        ]);
    }

    public function actionOtp($id)
    {
        $this->layout = 'register';
        $type = Yii::$app->getRequest()->getQueryParam('type');
        $model = $this->findModel($id);
        $message = '';
        $errorCode = -1;
        $msisdn = Yii::$app->user->identity->msisdn;
        if ($msisdn && $model->status != 1) {
            $fee = ($model->requires_recording == 1) ? (FEE_KHOI_TAO + FEE_THU_AM) : FEE_KHOI_TAO;
            if ($post = Yii::$app->request->post()) {
                if (\frontend\models\Otp::validateOtp($msisdn, $post['otp-code'])) {
                    list($errorCode, $log) = \common\libs\Charging::charge($msisdn, $fee);
                    $message = $mtContent = str_replace('<#fee#>', $fee, \common\libs\ChargingError::getMessage($errorCode));
                    // $errorCode = 401;
                    // var_dump($errorCode);die;
                    if ($errorCode == 0) {
                        $model->status = ($model->requires_recording == 1) ? 5 : 1;
                        $model->save(false);
                        $log->enterprise_file_id = $model->id;
                        $log->enterprise_id = $model->enterprise_id;
                        $log->save(false);
                        $mtContent = str_replace('<#fee#>', $fee, str_replace('<#code#>', \common\helpers\Helpers::eprCode($model->id), \Yii::$app->params['thanh_toan_thanh_cong']));
                        \common\helpers\SendMT::sendMT($msisdn, $mtContent);
                        // return "abc";
                    } else if ($errorCode == '401') {
                        $mtContent = str_replace('<#fee#>', $fee, \common\libs\ChargingError::getMessage(401));
                        \common\helpers\SendMT::sendMT($msisdn, $mtContent);
                        $message = 'Tài khoản của quý khách không đủ để thực hiện giao dịch này. Vui lòng nạp thêm tiền vào tài khoản gốc và thao tác lại!';
                        // return "cèf";
                    }
                } else {
                    $message = 'Mã xác thực không đúng, Quý khách vui lòng kiểm tra lại!';
                    // return "qưe";
                }
            }
            return $this->render('otp', [
                'model' => $model,
                'fee' => $fee,
                'message' => $message,
                'errorCode' => $errorCode,
                'msisdn' => Helpersn::hideMsisdn($msisdn),
                'type' => $type,
            ]);
        }
        return $this->redirect('/');
    }

    public function actionGetOtp($id)
    {
        if (Yii::$app->request->post()) {
            $this->layout = false;
            $model = $this->findModel($id);
            $msisdn = Yii::$app->user->identity->msisdn;
            if ($msisdn) {
                $fee = ($model->requires_recording == 1) ? (FEE_KHOI_TAO + FEE_THU_AM) : FEE_KHOI_TAO;
                $otp = \frontend\models\Otp::gen($msisdn);
                $mtContent = str_replace('<#fee#>', $fee, str_replace('<#otp#>', $otp, \Yii::$app->params['otp_thanh_toan_phi_nhac_cho']));
                // var_dump($mtContent);
                \common\helpers\SendMT::sendMT($msisdn, $mtContent);
                return 1;
            }
        }
        return 0;
    }

    public function actionFinish($id)
    {
        $model = $this->findModel($id);
        $msisdn = Yii::$app->user->identity->msisdn;
        if ($msisdn) {
            if ($model->requires_recording == 1) {
                $mtContent = str_replace('<#id#>', \common\helpers\Helpers::eprCode($id), \Yii::$app->params['hoan_thanh_co_thu_am']);
            } else {
                $mtContent = str_replace('<#id#>', \common\helpers\Helpers::eprCode($id), \Yii::$app->params['hoan_thanh_ko_thu_am']);
            }
            \common\helpers\SendMT::sendMT($msisdn, $mtContent);
        }
        $this->redirect('/home');
    }

    public function actionVoice()
    {
        $this->layout = "register";
        $type1 = Yii::$app->request->queryParams['type'];
        $enterprise = new \frontend\models\RegisterForm3();
        $model = new \frontend\models\VoiceForm();
        $model->playback_speed = '1.0';
        $model->giongdoc = 'lethiyen';
        $recording_content = EprRecordingContents::getRecordingContents(5);
        $voices = EprVoices::find()->orderBy('name')->all();
        $backgrounds = EprBackground::find()->orderBy('name')->limit(5)->all();
        if ($model->load(Yii::$app->request->post()) && $enterprise->load(Yii::$app->request->post()) && $enterprise->validate()) {
            $msisdn_file = $enterprise->uploadTxt('msisdn_file', $_FILES[$enterprise->formName()]);
            $copyright_license = $enterprise->upload('copyright_license', $_FILES[$enterprise->formName()]);
            $business_license = $enterprise->upload('business_license', $_FILES[$enterprise->formName()]);
            if (!sizeof($enterprise->getErrors())) {
                $enterprise->copyright_license = "$copyright_license";
                $enterprise->business_license = "$business_license";
                $enterprise->msisdn_file = "$msisdn_file";
                $enterprise->recording_content = $model->recording_content;
                $enterprise->enterprise_id = \Yii::$app->user->getId();
                $enterprise->status = 0;
                $enterprise->requires_recording = 3;
                $enterprise->created_at = new \yii\db\Expression('now()');
                // $enterprise->recording_file = $model->recording_file;
                if ($enterprise->save()) {
                    $enterprise->txt2Db();

                    $type = Yii::$app->getRequest()->getQueryParam('type');
                    if ($type === 'paid') {
                            return $this->redirect(\yii\helpers\Url::to(['/enterprise/update', 'id' => $enterprise->id, 'rs' => 'success', 'type' => 'paid']));
                    } else {
                        return $this->redirect(\yii\helpers\Url::to(['/enterprise/payment', 'id' => $enterprise->id, 'type' => 'new']));
                    }
                } else {
                    // to do
                }
            }
        }
        return $this->render('voice', [
            'model' => $model,
            'backgroups' => $backgrounds,
            'voices' => $voices,
            'recording_content' => $recording_content,
            'enterprise' => $enterprise,
            'errors' => $model->getErrors(),
            'type' => $type1
        ]);
    }

    public function actionGetVoice()
    {
        $content = $_POST['content'];
        $giongdoc = $_POST['giongdoc'];
        $playback_speed = $_POST['playback_speed'];
        // $request_background = $_POST['request_background'];
        $background = $_POST['background'];
        if ($mp3File = \common\libs\Voices::getVoice($content, $giongdoc, $playback_speed)) {
            $endFile = trim($mp3File, '.mp3') . '1.mp3';
            $rootFile = \Yii::getAlias('@frontend_upload') . $mp3File;
            $endFileDir = \Yii::getAlias('@frontend_upload') . $endFile;
            $mp3file = new \common\libs\MP3File($rootFile);
            $duration = $mp3file->getDuration();
            if ($duration >= 30 && $duration <= 43) {
                if ($background != "" && is_file($backFile = \Yii::getAlias('@frontend_upload') . $background)) {
                    $cmd = str_replace('<#endmp3#>', $endFileDir, str_replace('<#background#>', $backFile, str_replace('<#mp3#>', $rootFile, \Yii::$app->params['ffmpeg_mer'])));
                    exec($cmd);
                    $arr = array('code' => 200, 'url' => $endFile, 'message' => "Tạo voice với nhạc nền thành công", 'mp3dir' => '/uploads' . $endFile);
                    return json_encode($arr);
                } else {
                    $arr = array('code' => 200, 'url' => $mp3File, 'message' => "Tạo voice thành công", 'mp3dir' => '/uploads' . $mp3File);
                    return json_encode($arr);
                }
            } else {
                if ($duration > 43) {
                    $arr = array('code' => 0, 'message' => "Nội dung quá dài (' . $duration . 's). Nội dung phải <= 43s hoặc >=30s.");
                    return json_encode($arr);
                } elseif ($duration < 30) {
                    $arr = array('code' => 0, 'message' => "Nội dung quá ngắn (' . $duration . 's). Nội dung phải <= 43s hoặc >=30s.");
                    return json_encode($arr);
                }
            }
        } else {
            $arr = array('code' => 401, 'message' => "Có lỗi xảy ra, vui lòng thử lại sau!");
            return json_encode($arr);
        }
    }

    /**
     * Finds the EnterpriseFile model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param string $id
     * @return EnterpriseFile the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = \frontend\models\EnterpriseFile::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
