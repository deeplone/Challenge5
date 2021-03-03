<?php

namespace api\controllers;

use api\libs\ApiHelper;
use Yii;
use yii\filters\ContentNegotiator;
use yii\rest\Controller;
use yii\web\Response;

/**
 * Site controller
 */
class ApiController extends Controller {

    public function actionError() {
        return ApiHelper::errorResponse();
    }

    public function behaviors() {
        $behaviors = parent::behaviors();
        $behaviors['contentNegotiator'] = [
            'class' => ContentNegotiator::className(),
            'formats' => [
                'application/json' => Response::FORMAT_JSON,
            ],
        ];
        return $behaviors;
    }

    public function getParam($key, $default = '') {
        return Yii::$app->request->isPost ? trim(Yii::$app->request->post(trim($key), $default)) : trim(Yii::$app->request->get(trim($key), $default));
    }

    public function beforeAction($action) {
        $this->enableCsrfValidation = false;
        if (\Yii::$app->request->post()) {
            $client_id = trim($this->getParam('client_id'));
            $client_secret = trim($this->getParam('client_secret'));
            if (!$client_id || !$client_secret) {
                $this->asJson(ApiHelper::formatResponse(\api\libs\ApiResponseCode::AUTH_CLIENT_ID_SECRET_IS_REQUIRED));
                return false;
            }
            $apiClient = \api\models\ApiClient::getClientBySecret($client_id, $client_secret);
            if ($apiClient) {
                if ($apiClient->valid_ips) {
                    $ip = \common\libs\MobileRecognized::getRemoteIp();
                    if (!$this->checkValidateIp($ip, $apiClient->valid_ips)) {
                        $this->asJson(ApiHelper::formatResponse(\api\libs\ApiResponseCode::IP_NO_ACCESS));
                        return false;
                    }
                }
            } else {
                $this->asJson(ApiHelper::formatResponse(\api\libs\ApiResponseCode::AUTH_CLIENT_ID_SECRET_IS_REQUIRED));
                return false;
            }
        } else {
            $this->asJson(ApiHelper::formatResponse(\api\libs\ApiResponseCode::UNKNOWN_METHOD));
            return false;
        }
        return parent::beforeAction($action);
    }

    public function checkValidateIp($ip_check, $arrIp) {
        $arrIp = (explode(",", $arrIp));
        foreach ($arrIp as $item_ip) {
            if (strpos($item_ip, '/')) {
                if ($this->isInNetwork($arrIp, $ip_check)) {
                    return true;
                } else {
                    return false;
                }
            } else {
                if ($this->textCompare($ip_check, $item_ip) == 100) {
                    return true;
                }
            }
        }
        return false;
    }

    public function textCompare($t1, $t2) {
        $t1 = strtoupper(RemoveSign::removeSign($t1));
        $t2 = strtoupper(RemoveSign::removeSign($t2));
        similar_text($t1, $t2, $per);
        return $per;
    }

    public static function isInNetwork($netAddr, $ip) {
        if (!empty($netAddr)) {
            foreach ($netAddr as $addr) {
                $netArr = explode("/", $addr);
                if (self::ipInNetwork($ip, $netArr[0], $netArr[1])) {
                    return true;
                }
            }
        }
        return false;
    }

    public static function ipInNetwork($ip, $netAddr, $netMask) {
        if ($netMask <= 0) {
            return false;
        }
        $ipBinaryString = sprintf("%032b", ip2long($ip));
        $netBinaryString = sprintf("%032b", ip2long($netAddr));
        return (substr_compare($ipBinaryString, $netBinaryString, 0, $netMask) === 0);
    }

}
