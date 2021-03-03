<?php

namespace frontend\controllers;

use common\helpers\Helpers;
use common\helpers\SendMT;
use frontend\models\ChangePasswordForm;
use frontend\models\ChargingLog;
use frontend\models\ChargingLogSearch;
use frontend\models\ConfirmInternalRegisterForm;
use frontend\models\ConfirmRegisterForm;
use frontend\models\Enteprise;
use frontend\models\EnterpriseFile;
use frontend\models\EnterpriseFileSearch;
use frontend\models\ForgotPasswordForm;
use frontend\models\ForgotPasswordOtpForm;
use frontend\models\InternalRegisterForm;
use frontend\models\LoginForm;
use frontend\models\Otp;
use frontend\models\OtpConfirm;
use frontend\models\RegisterForm;
use frontend\models\UserRbtSearch;
use Yii;
use yii\helpers\Url;
use yii\web\Response;

/**
 * User controller
 */
class UserController extends AppController
{

    /**
     * Displays User.
     *
     * @return mixed
     */
    public function actionIndex()
    {
        if (Yii::$app->user->isGuest) {
            $this->redirect(Url::toRoute(['/']));
        }
        $this->layout = 'common';
        $searchModel = new EnterpriseFileSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    public function actionIndex1()
    {
        $this->layout = 'main1';
        $name = trim(\Yii::$app->request->queryParams['name']);
        $model = new \frontend\models\EnterpriseFile();
        if ($name) {
            $model->name = $name;
        }
        $files = $model->getRbtByUser(page_limit);
        $pages = new \yii\data\Pagination(['totalCount' => $files['total'], 'defaultPageSize' => page_limit]);
        return $this->render('index1', [
            'files' => $files['list'],
            'pages' => $pages,
            'name' => $name,
        ]);
    }

    public function actionLogin()
    {
        if (!Yii::$app->user->isGuest) {
            $this->redirect(Url::toRoute(['/user/index']));
        }
        $model = new LoginForm();
        if ($model->load(Yii::$app->request->post())) {
            $model->msisdn = Helpers::convertMsisdn($model->msisdn);
            if ($model->login()) {
                $this->redirect(Url::toRoute(['/']));
            }
        }
        return $this->render('login', ['model' => $model]);
    }

    public function actionRegister()
    {
        if (!Yii::$app->user->isGuest) {
            $this->redirect(Url::toRoute(['/user/index']));
        }
        $model = new RegisterForm();
        if ($model->load(Yii::$app->request->post())) {
            if ($model->validate()) {
                // transform data from RegisterForm to ConfirmRegisterForm
                $model->msisdn = Helpers::convertMsisdn($model->msisdn);
                if ($model->register() && $model->login()) {
                    Yii::info("[actionConfirmOtp] {$model->msisdn} validate, save and login successful !", "otp");
                    $this->redirect(Url::toRoute(['/']));
                }
                Yii::info("[actionConfirmOtp] {$model->msisdn} validate succeed but save and login failed !", "otp");

            }
        }
        return $this->render('register', ['model' => $model]);
    }

    public function actionInternalRegister()
    {
        if (!Yii::$app->user->isGuest) {
            $this->redirect(Url::toRoute(['/user/index']));
        }
        $model = new InternalRegisterForm();
        if ($model->load(Yii::$app->request->post())) {
            if ($model->validate()) {
                // transform data from RegisterForm to ConfirmRegisterForm
                $model->msisdn = Helpers::convertMsisdn($model->msisdn);
                //$model
                if ($model->register() && $model->login()) {
                    Yii::info("[actionConfirmOtp] {$model->msisdn} validate, save and login successful !", "otp");
                    $this->redirect(Url::toRoute(['/']));
                }
                Yii::info("[actionConfirmOtp] {$model->msisdn} validate succeed but save and login failed !", "otp");
            }
        }
        return $this->render('internalRegister', ['model' => $model]);
    }

    public function actionForgotPassword()
    {
        if (!Yii::$app->user->isGuest) {
            $this->redirect(Url::toRoute(['/user/index']));
        }
        $model = new ForgotPasswordForm();
        if (Yii::$app->request->validateCsrfToken()) {
            if ($model->load(Yii::$app->request->post())) {
                if ($model->validate()) {
                    // transform data from RegisterForm to ConfirmRegisterForm
                    $modelConfirm = new ForgotPasswordOtpForm();
                    $modelConfirm->msisdn = Helpers::convertMsisdn($model->msisdn);
                    if (Otp::countLimitOtp($model->msisdn, Yii::$app->params['otp']['duration']) > Yii::$app->params['otp']['limit'] - 1) {
                        $model->addError('msisdn', 'Số thuê bao đã vượt quá số lần lấy OTP');
                        return $this->render('forgotPassword', ['model' => $model]);
                    } else {
                        $otp = Otp::gen($model->msisdn);
                        OtpConfirm::deleteByMsisdn($model->msisdn);
                        $mtContent = str_replace('<#mk#>', $otp, \Yii::$app->params['xac_nhan_otp_doi_mk']);
                        SendMT::sendMT($model->msisdn, $mtContent);
                    }
                    return $this->render('resetPassword', ['model' => $modelConfirm, 'success' => false]);
                }
            }
        } else {
            $model->addError('msisdn', 'Giao dịch không hợp lệ!');
        }
        return $this->render('forgotPassword', ['model' => $model]);
    }

    public function actionChangePassword()
    {
        if (!Yii::$app->user->isGuest) {
            $this->redirect(Url::toRoute(['/user/index']));
        }
        $model = new ForgotPasswordOtpForm();
        $success = false;
        if (Yii::$app->request->validateCsrfToken()) {
            if ($model->load(Yii::$app->request->post())) {
                if ($model->validate()) {
                    if (!OtpConfirm::validateLimit($model->msisdn, Yii::$app->params['otp']['validate_limit'])) {
                        Yii::info("[actionChangePassword] {$model->msisdn} validate limit over {" . Yii::$app->params['otp']['validate_limit'] . "}", "otp");
                        $model->addError('otp', 'Bạn đã vượt quá số lần nhập sai mã OTP. Vui lòng lấy lại mã xác thực OTP khác!');
                    } else if (Otp::validateOtp($model->msisdn, $model->otp)) {
                        $user = Enteprise::findOne(['msisdn' => Helpers::convertMsisdn($model->msisdn)]);
                        $tmpNewPass = $model->password;
                        $user->setPassword($model->password);
                        if ($user->save(false)) {
                            $mtContent = str_replace('<#mk#>', $tmpNewPass, \Yii::$app->params['doi_mk_thanh_cong']);
                            SendMT::sendMT($model->msisdn, $mtContent);
                            $success = true;
                            Yii::info("[actionChangePassword] {$model->msisdn} validate, change password successful !", "otp");
                        }
                        Yii::info("[actionChangePassword] {$model->msisdn} validate succeed but change password failed !", "otp");
                    } else {
                        Yii::info("[actionChangePassword] {$model->msisdn} validate failed!", "otp");
                        $model->addError('otp', 'Mã xác thực OTP không hợp lệ');
                    }
                } else if ($model->hasErrors('msisdn')) {
                    // Error validate => Back to Register Form
                    $forgotPasswordForm = new ForgotPasswordForm();
                    $forgotPasswordForm->msisdn = $model->msisdn;
                    $forgotPasswordForm->addErrors($model->getErrors());
                    return $this->render('forgotPassword', ['model' => $forgotPasswordForm]);
                }
            }
        } else {
            $model->addError('msisdn', 'Giao dịch không hợp lệ!');
        }
        return $this->render('resetPassword', ['model' => $model, 'success' => $success]);
    }

    public function actionUpdatePassword()
    {
        if (Yii::$app->user->isGuest) {
            $this->redirect(Url::toRoute(['/']));
        }
        $model = new ChangePasswordForm();
        $message = null;
        if (Yii::$app->request->validateCsrfToken()) {
            if ($model->load(Yii::$app->request->post()) && $model->validate()) {
                $msisdn = Yii::$app->user->getIdentity()->msisdn;
                $user = Enteprise::findOne(['msisdn' => Helpers::convertMsisdn($msisdn)]);
                if (!$user->validatePassword($model->old_password)) {
                    $model->addError('old_password', Yii::t('frontend', 'Mật khẩu cũ không đúng!'));
                    Yii::info("[actionUpdatePassword] {$msisdn} validate FAILED => wrong old password !");
                } else {
                    $tmpNewPass = $model->password;
                    $user->setPassword($model->password);
                    if ($user->save(false)) {
                        $message = Yii::t('frontend', 'Đổi mật khẩu thành công');
                        $mtContent = str_replace('<#mk#>', $tmpNewPass, \Yii::$app->params['doi_mk_thanh_cong']);
                        SendMT::sendMT($msisdn, $mtContent);
                        Yii::info("[actionUpdatePassword] {$msisdn} validate, change password successful !");
                        Yii::$app->session->setFlash('success', 'Đổi mật khẩu thành công!');
                        return $this->redirect(['user/index']);
//                    $model = new ChangePasswordForm();
                    }
                    Yii::info("[actionUpdatePassword] {$msisdn} validate success but change password FAILED !");
                }
            }
        } else {
            $model->addError('password', 'Giao dịch không hợp lệ!');
        }
        return $this->render('changePassword', ['model' => $model, 'message' => $message]);
    }

    public function actionConfirmOtp()
    {
        if (!Yii::$app->user->isGuest) {
            $this->redirect(Url::toRoute(['/user/index']));
        }
        $model = new ConfirmRegisterForm();
        if ($model->load(Yii::$app->request->post())) {
            if ($model->validate()) {
                $model->msisdn = Helpers::convertMsisdn($model->msisdn);
                $model->type = USER_TYPE_NORMAL;
                if (!OtpConfirm::validateLimit($model->msisdn, Yii::$app->params['otp']['validate_limit'])) {
                    Yii::info("[actionConfirmOtp] {$model->msisdn} validate limit over {" . Yii::$app->params['otp']['validate_limit'] . "}", "otp");
                    $model->addError('otp', 'Bạn đã vượt quá số lần nhập sai mã OTP cho phép. Vui lòng lấy lại mã xác thực OTP!');
                } else if (Otp::validateOtp($model->msisdn, $model->otp)) {
                    if ($model->register() && $model->login()) {
                        Yii::info("[actionConfirmOtp] {$model->msisdn} validate, save and login successful !", "otp");
                        $this->redirect(Url::toRoute(['/user/index']));
                    }
                    Yii::info("[actionConfirmOtp] {$model->msisdn} validate succeed but save and login failed !", "otp");
                } else {
                    Yii::info("[actionConfirmOtp] {$model->msisdn} validate failed!", "otp");
                    $model->addError('otp', 'Mã xác thực OTP không hợp lệ');
                }
            } else if ($model->hasErrors('msisdn') || $model->hasErrors('full_name') ||
                $model->hasErrors('email') || $model->hasErrors('id_number') ||
                $model->hasErrors('password') || $model->hasErrors('re_password')) {
                // Error validate => Back to Register Form
                $registerFrom = new RegisterForm();
                $registerFrom->copyDataFromConfirmRegisterForm($model);
                $registerFrom->password = null;
                $registerFrom->re_password = null;
                $registerFrom->addErrors($model->getErrors());
                return $this->render('register', ['model' => $registerFrom]);
            }
        }
        return $this->render('confirmOtp', ['model' => $model]);
    }

    public function actionInternalConfirmOtp()
    {
        if (!Yii::$app->user->isGuest) {
            $this->redirect(Url::toRoute(['/user/index']));
        }
        $model = new ConfirmInternalRegisterForm();
        if ($model->load(Yii::$app->request->post())) {
            if ($model->validate()) {
                $model->msisdn = Helpers::convertMsisdn($model->msisdn);
                $model->type = USER_TYPE_INTERNAL;
                $model->id_number = trim($model->id_number);
                if ($model->id_number) {
                    $model->full_name = $model->id_number;
                }
                if (!OtpConfirm::validateLimit($model->msisdn, Yii::$app->params['otp']['validate_limit'])) {
                    Yii::info("[actionInternalConfirmOtp] {$model->msisdn} validate limit over {" . Yii::$app->params['otp']['validate_limit'] . "}", "otp");
                    $model->addError('otp', 'Bạn đã vượt quá số lần nhập sai mã OTP cho phép. Vui lòng lấy lại mã xác thực OTP!');
                } else if (Otp::validateOtp($model->msisdn, $model->otp)) {
                    if ($model->register() && $model->login()) {
                        Yii::info("[actionInternalConfirmOtp] {$model->msisdn} validate, save and login successful !", "otp");
                        $this->redirect(Url::toRoute(['/user/index']));
                    }
                    Yii::info("[actionInternalConfirmOtp] {$model->msisdn} validate succeed but save and login failed !", "otp");
                } else {
                    Yii::info("[actionInternalConfirmOtp] {$model->msisdn} validate failed!", "otp");
                    $model->addError('otp', 'Mã xác thực OTP không hợp lệ');
                }
            } else if ($model->hasErrors('msisdn') ||
                $model->hasErrors('email') || $model->hasErrors('id_number') ||
                $model->hasErrors('password') || $model->hasErrors('re_password')) {
                // Error validate => Back to Internal Register Form
                $registerFrom = new InternalRegisterForm();
                $registerFrom->copyDataFromConfirmRegisterForm($model);
                $registerFrom->password = null;
                $registerFrom->re_password = null;
                $registerFrom->addErrors($model->getErrors());
                return $this->render('internalRegister', ['model' => $registerFrom]);
            }
        }
        return $this->render('internalConfirmOtp', ['model' => $model]);
    }

    public function actionResendOtp()
    {
        Yii::$app->layout = false;
        Yii::$app->response->format = Response::FORMAT_JSON;
        $message = ['error' => 1, 'message' => 'Yêu cầu không hợp lệ'];
        if (Yii::$app->request->isAjax && Yii::$app->request->validateCsrfToken()) {
            $msisdn = Yii::$app->request->getBodyParam('msisdn');
            Yii::info("[actionResendOtp] {$msisdn}", "otp");
            $count = Otp::countLimitOtp($msisdn, Yii::$app->params['otp']['duration']);
            if ($count > Yii::$app->params['otp']['limit'] - 1) {
                Yii::info("[actionResendOtp] {$msisdn} count {$count} get otp limit over {" . Yii::$app->params['otp']['limit'] . "}", "otp");
                $message = [
                    'error' => 2,
                    'message' => '<p style="color: red">Bạn đã vượt quá số lần lấy mã OTP của số thuê bao <span class="txt-color">' . Helpers::hideMsisdn($msisdn) . '</span></p> '
                ];
            } else {
                Yii::info("[actionResendOtp] {$msisdn} count {$count} execute sentMT", "otp");
                $otp = Otp::gen($msisdn);
                OtpConfirm::deleteByMsisdn($msisdn);
                $mtContent = str_replace('<#mk#>', $otp, \Yii::$app->params['xac_nhan_otp_doi_mk']);
                SendMT::sendMT($msisdn, $mtContent);
                $message = [
                    'error' => 0,
                    'message' => '<p style="color: red">Hệ thống đã gửi một mã xác thực tới số thuê bao <span class=\'txt-color\'>' . Helpers::hideMsisdn($msisdn) . '</span></p>'
                ];
            }
        }
        return $message;
    }

    public function actionLogout()
    {
        Yii::$app->user->logout();
        return $this->goHome();
    }

    public function actionUserRbt($id)
    {
        if (Yii::$app->user->isGuest) {
            $this->goHome();
        }
        $this->layout = 'userRbt';
        $profile = EnterpriseFile::getOwnerById($id);
        if (!$profile) {
            $this->redirect(['/user/index']);
        }
        $searchModel = new UserRbtSearch();
        $searchModel->enterprise_file_id = $id;
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('userRbt', [
            'dataProvider' => $dataProvider,
            'searchModel' => $searchModel
        ]);
    }

    public function actionTransactionManage($id)
    {
        if (Yii::$app->user->isGuest) {
            $this->goHome();
        }
        $this->layout = 'chargingLog';
        $userLog = ChargingLog::findLogPayment($id);
        /* @var ChargingLog $userLog */
        $searchModel = new ChargingLogSearch();
        $searchModel->enterprise_id = $id;
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        $from_date = Yii::$app->request->get()[$searchModel->formName()]['from_date'];
        $to_date = Yii::$app->request->get()[$searchModel->formName()]['to_date'];

        if($from_date && !$to_date) {
            $to_date = date('Y-m-d');
        }

        if($from_date > date('Y-m-d')) {
            $to_date = date('Y-m-d', strtotime($to_date .'+3 months'));
        }

        if($from_date > $to_date) {
            Yii::$app->session->setFlash('error', "Ngày bắt đầu lớn hơn ngày kết thúc, vui lòng chọn lại!");
        }
        return $this->render('transactionManage', [
            'dataProvider' => $dataProvider,
            'searchModel' => $searchModel
        ]);
    }

}
