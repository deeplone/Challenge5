<?php

namespace frontend\controllers;

use common\helpers\Helpers;
use frontend\models\ResendVerificationEmailForm;
use frontend\models\VerifyEmailForm;
use frontend\models\Enteprise;
use Yii;
use yii\base\InvalidArgumentException;
use yii\web\BadRequestHttpException;
use frontend\models\LoginForm;
use frontend\models\PasswordResetRequestForm;
use frontend\models\ContactForm;
use frontend\models\RbtHot;

/**
 * Site controller
 */
class SiteController extends \yii\web\Controller
{

    /**
     * {@inheritdoc}
     */
    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
            'captcha' => [
                'class' => 'yii\captcha\CaptchaAction',
//                'fixedVerifyCode' => YII_ENV_DEV ? 'testme' : null,
            ],
        ];
    }

    /**
     * Displays homepage.
     *
     * @return mixed
     */
    public function actionIndex()
    {
        $rbtHot = \frontend\models\RbtHot::getRbtHot(9);
//        var_dump($rbtHot); die;
        //$this->layout = 'home';
        return $this->render('index', ['rbtHot' => $rbtHot]);
    }

    /**
     * Logs in a user.
     *
     * @return mixed
     */
//    public function actionLogin()
//    {
//        if (!Yii::$app->user->isGuest) {
//            return $this->redirect('/user');
//        }
//
//        $model = new LoginForm();
//
//        if ($_POST) {
//            $result = array('code' => 0, 'message' => "Đăng nhập không thành công!");
//            if ($model->load(Yii::$app->request->post())) {
//                $model->msisdn = Helpers::convertMsisdn($model->msisdn);
//                if ($model->login()) {
//                    $result = array('code' => 200, 'message' => "Đăng nhập thành công!");
//                }
//            }
//            return json_encode($result);
//        }
//
//        $model->password = '';
//        return $this->render('login', [
//            'model' => $model,
//        ]);
//    }

    /**
     * Logs out the current user.
     *
     * @return mixed
     */
    public function actionLogout()
    {
        Yii::$app->user->logout();

        return $this->goHome();
    }

    /**
     * Signs user up.
     *
     * @return mixed
     */
    public function actionSignup()
    {
        if (!Yii::$app->user->isGuest) {
            return $this->goHome();
        }
//        $this->layout = 'login';
        $model = new \frontend\models\Enteprise();
        $model->scenario = 'create';

        if ($_POST) {
            $model->msisdn = \common\helpers\Helpers::convertMsisdn($_POST['msisdn']);
            $model->captcha = $_POST['captcha'];
            $model->password = $_POST['password'];
            $model->re_password = $_POST['repeatPassword'];
            $model->id_number = $_POST['idNumber'];
            $model->full_name = $_POST['fullName'];
            $model->email = $_POST['email'];
            $model->otp = $_POST['otp'];
            $model->agree = $_POST['agree'];

            if ($model->validate()) {
                if (\frontend\models\Otp::validateOtp($model->msisdn, $model->otp)) {
                    if ($model->signup()) {
                        Yii::$app->user->logout();
                        $result = array('code' => 200, 'message' => "Đăng ký thành công!");
                        return json_encode($result);
                    }
                } else {
                    $result = array('code' => 0, 'message' => "Mã xác nhận không đúng!");
                    return json_encode($result);
                }
            } else {
                $result = array('code' => 0, 'message' => "Validate thất bại!");
                return json_encode($result);
            }
        }

        return $this->render('signup', [
            'model' => $model,
        ]);
    }

    /**
     * Displays contact page.
     *
     * @return mixed
     */
    public function actionContact()
    {
        $model = new ContactForm();
        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            if ($model->sendEmail(Yii::$app->params['adminEmail'])) {
                Yii::$app->session->setFlash('success', 'Thank you for contacting us. We will respond to you as soon as possible.');
            } else {
                Yii::$app->session->setFlash('error', 'There was an error sending your message.');
            }

            return $this->refresh();
        } else {
            return $this->render('contact', [
                'model' => $model,
            ]);
        }
    }

    public function actionResetMe()
    {
//        $this->layout = 'default';
        $model = new \frontend\models\ResetMe();
//        if ($model->load(Yii::$app->request->post())) {
//            $model->msisdn = \common\helpers\Helpers::convertMsisdn($model->msisdn);
//            if ($model->validate()) {
//                if (\frontend\models\Otp::validateOtp($model->msisdn, $model->otp)) {
//                    $pass = \common\helpers\Helpers::generateRandomString();
//                    $user = \frontend\models\Enteprise::findOne(['msisdn' => \common\helpers\Helpers::convertMsisdn($model->msisdn)]);
//                    $user->setPassword($pass);
//                    if ($user->save(false, ['password'])) {
//                        $mtContent = str_replace('<#mk#>', $pass, \Yii::$app->params['new_mk']);
//                        \common\helpers\SendMT::sendMT($model->msisdn, $mtContent);
//                        Yii::$app->session->setFlash('success', 'Mật khẩu mới đã được gửi về số điện thoại của bạn!');
//                        return $this->redirect('/login');
//                    }
//                } else {
//                    $model->addError('otp', 'Mã xác thực không đúng!');
//                }
//            }
//        }

        if ($_POST) {
            $model->msisdn = \common\helpers\Helpers::convertMsisdn($_POST['msisdn']);
            $model->password = $_POST['password'];
            $model->otp = $_POST['otp'];
            $model->captcha = $_POST['captcha'];
            if ($model->validate()) {

                if (\frontend\models\Otp::validateOtp($model->msisdn, $model->otp)) {

                    $pass = $_POST['password'];
                    $user = \frontend\models\Enteprise::findOne(['msisdn' => \common\helpers\Helpers::convertMsisdn($_POST['msisdn'])]);
                    $user->setPassword($pass);
                    if ($user->save(false, ['password'])) {

                        $mtContent = \Yii::$app->params['doi_mk_thanh_cong'];
                        \common\helpers\SendMT::sendMT($model->msisdn, $mtContent);
                        $result = array('code' => 200, 'message' => "đổi mật khẩu thành công");
                        return json_encode($result);
                    }
                } else {
                    $result = array('code' => 0, 'message' => "Mã xác thực không đúng");
                    return json_encode($result);
                }
            } else {
                $result = array('code' => 0, 'message' => "Validate tạch");
                $errors = $model->errors;
                foreach ($errors as $key => $value) {
                    $result[$key] = $value;
                }
                return json_encode($result);
            }
        }

        return $this->render('resetMe', [
            'model' => $model,
        ]);
    }

    public function actionGetOtp()
    {
        $this->layout = 'default';
        \Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
        if (Yii::$app->request->post()) {
            $this->layout = false;
            $model = new \frontend\models\ResetMe();
            if ($post = Yii::$app->request->post()) {
                $actionType = $post['actionType'];
                if ($actionType === "create_user") {
                    $model = new \frontend\models\CreateUser();
                    $msisdn = \common\helpers\Helpers::convertMsisdn($post['msisdn']);
                    $captcha = $post['captcha'];
                    $email = $post['email'];
                    $model->msisdn = $msisdn;
                    $model->captcha = $captcha;
                    if (Enteprise::findOne(['msisdn' => $msisdn])) {
                        $model->addError('msisdn', 'Số điện thoại ' . $msisdn . ' đã đăng ký dịch vụ!');
                    }

                    if (Enteprise::findOne(['email' => $email])) {
                        $model->addError('email', 'Email ' . $email . ' đã đăng ký dịch vụ!');
                    }

                    if (!$model->getErrors()) {
                        if ($model->validate()) {
                            if ($otp = \frontend\models\Otp::gen($msisdn)) {
                                $mtContent = str_replace('<#mk#>', $otp, \Yii::$app->params['xac_nhan_otp_doi_mk']);
                                \common\helpers\SendMT::sendMT($msisdn, $mtContent);
                                return ['code' => 200, 'message' => 'Mã otp mới đã gửi về số điện thoại '. $post['msisdn'] .' của quý khách!'];
//                                $result = array('code' => 200, 'message' => 'Mã xác thực đã được gửi về số điện thoại ' . $msisdn . ' của Quý khách!');
//                                return json_encode($result);
                            } else {
                                $result = array('code' => 0, 'message' => 'Lấy mã xác thực không thành công');
                                $errors = $model->getErrors();
                                foreach ($errors as $key => $value) {
                                    $result[$key] = $value;
                                }
                                return $result;
                            }
                        } else {
                            $result = array('code' => 0, 'message' => "Validate không thành công");
                            $errors = $model->getErrors();
                            foreach ($errors as $key => $value) {
                                $result[$key] = $value;
                            }
                            return $result;
                        }
                    } else {
                        $result = array('code' => 0, 'message' => "Có lỗi");
                        $errors = $model->getErrors();
                        foreach ($errors as $key => $value) {
                            $result[$key] = $value;
                        }
                        return $result;
                    }
                }

                if ($actionType == "reset_password") {
                    $msisdn = \common\helpers\Helpers::convertMsisdn($post['msisdn']);
                    $model->msisdn = $msisdn;
                    $model->captcha = $post['captcha'];
                    if (!$model->getErrors()) {
                        if (!Enteprise::findOne(['msisdn' => $msisdn])) {
                            return ['code' => 0, 'otp' => 'Số điện thoại ' . $post['msisdn'] . ' chưa đăng ký dịch vụ'];
                        }

                        if ($model->validate()) {
                            if ($otp = \frontend\models\Otp::gen($msisdn)) {
                                $mtContent = str_replace('<#mk#>', $otp, \Yii::$app->params['xac_nhan_otp_doi_mk']);
                                \common\helpers\SendMT::sendMT($msisdn, $mtContent);
                                return ['code' => 200, 'message' => 'Mã otp mới đã gửi về'. $post['msisdn'] .' số điện thoại của quý khách!'];
                            } else {
                                return ['code' => 0, 'message' => 'Gửi mã xác thực không thành công'];
                            }
                        }
                    } else {
                        return ['code' => 0, 'message' => 'Có lỗi xảy ra'];
                    }
                }
            }
        }
        return [];
    }

    /**
     * Displays info page.
     *
     * @return mixed
     */
    public function actionInfo($id)
    {
        $this->layout = 'home';
        $model = \frontend\models\EprInfo::findOne(['type' => intval($id)]);
        if ($model) {
            return $this->render('info', [
                'model' => $model
            ]);
        }
        return $this->goHome();
    }
}
