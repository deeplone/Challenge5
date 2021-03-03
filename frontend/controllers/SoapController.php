<?php

namespace frontend\controllers;

use common\helpers\Helpers;
use common\helpers\SendMT;
use common\libs\Charging;
use common\libs\ChargingError;
use common\models\ChargingLogBase;
use frontend\models\Enteprise;
use frontend\models\EnterpriseFile;
use frontend\models\Event;
use frontend\models\Star;
use frontend\models\Voter;
use Yii;
use yii\web\Controller;

/**
 * Soap controller
 */
class SoapController extends Controller
{
    const USERNAME = 'imuzik_business';
    const PASSWORD = '4jZX4Mccs7F5F9bm';
    const ERROR_CODE_SUCCESS = 0;
    const ERROR_CODE_FAILED = 1;
    const ERROR_CODE_WRONG_PARAMS = 200;
    const ERROR_CODE_WRONG_USER_PASS = 201;
    const ERROR_CODE_SYSTEM_ERROR = 202;
    const ERROR_CODE_WRONG_COMMAND = 300;
    const ERROR_CODE_WRONG_REQUEST_CODE = 301;
    const ERROR_CODE_WRONG_ERP_INFO = 302;
    const ERROR_CODE_NOT_ENOUGH_MONEY = 401;


    /**
     * {@inheritdoc}
     */
    public function actions()
    {
        return [
            'vcrbt' => 'mongosoft\soapserver\Action',
            'serviceOptions' => [
//                'disableWsdlMode' => true,
                'soapVersion' => '1.1'
            ]
        ];
    }

    /**
     * @param $username
     * @param $password
     * @param $source
     * @param $dst
     * @param $content
     * @return int
     * @soap
     */
    public function moRequest($username, $password, $source, $dst, $content)
    {
        if ($username != self::USERNAME || $password != self::PASSWORD) {
            return self::ERROR_CODE_WRONG_USER_PASS;
        }
        // parse command
        $msisdn = Helpers::convertMsisdn($source);
//        $content = str_replace("  ", " ", trim($content));
        $content = preg_replace('!\s+!', ' ', trim($content));
        $contents = explode(" ", $content);
        if (count($contents) != 2 || strtoupper($contents[0]) != "YN") {
            return self::ERROR_CODE_WRONG_COMMAND;
        }
        $fileId = intval($contents[1]);
        $erpFile = EnterpriseFile::getPaymentById($fileId, $msisdn);
        if (!$erpFile) {
            return self::ERROR_CODE_WRONG_REQUEST_CODE;
        }
        $fee = FEE_KHOI_TAO;
        $type = TYPE_FEE_KHOI_TAO;
        $strType = 'INIT';
        if ($erpFile->requires_recording == 1) {
            $fee = FEE_KHOI_TAO + FEE_THU_AM;
            $type = TYPE_FEE_COMBINE;
            $strType = 'COMBINE';
        }
        // do charge -> TODO: update sale code
        $erp = Enteprise::findById($erpFile->enterprise_id);
        if (!$erp || $erp->type != USER_TYPE_INTERNAL || !$erp->id_number) {
            return self::ERROR_CODE_WRONG_ERP_INFO;
        }
        list($errorCode, $log) = Charging::chargeSaleCode($msisdn, $fee, 'CHARGE', $strType, $erp->id_number);
        /* @var ChargingLogBase $log */
        $log->enterprise_file_id = $erpFile->id;
        $log->enterprise_id = $erpFile->enterprise_id;
        $log->type = $type;
        $log->discount = 0;
        $log->old_fee = $fee;
        $log->save(false);

        if ($errorCode == 0) {
            if ($erpFile->requires_recording == 1) {
                $erpFile->status = RBT_STATUS_WAITING_RECORD;
            } else {
                $erpFile->status = RBT_STATUS_WAITING;
            }
            $erpFile->save(false);
            $mtContent = str_replace('<#fee#>', number_format($fee, 0, ",", "."), str_replace('<#code#>', Helpers::eprCode($erpFile->id), \Yii::$app->params['thanh_toan_thanh_cong']));
            SendMT::sendMT($msisdn, $mtContent);
            Yii::info("[molistener] {$msisdn} charge fee {$fee} successful !", "Charging");
            return self::ERROR_CODE_SUCCESS;
        } else if ($errorCode == '401') {
            $mtContent = str_replace('<#fee#>', number_format($fee, 0, ",", "."), ChargingError::getMessage(401));
            SendMT::sendMT($msisdn, $mtContent);
            Yii::info("[molistener] {$msisdn} charge fee {$fee} failed 401 !", "Charging");
            return self::ERROR_CODE_NOT_ENOUGH_MONEY;
        } else {
            Yii::info("[molistener] {$msisdn} charge fee {$fee} failed {$errorCode} !", "Charging");
            return self::ERROR_CODE_FAILED;
        }
    }

    public function moRewardRequest($username, $password, $source, $dst, $content)
    {
        if ($username != self::USERNAME || $password != self::PASSWORD) {
            return self::ERROR_CODE_WRONG_USER_PASS;
        }
        // parse command
        $msisdn = Helpers::convertMsisdn($source);
//        $content = str_replace("  ", " ", trim($content));
        $content = preg_replace('!\s+!', ' ', trim($content));
        $contents = explode(" ", $content);
        if (count($contents) != 2 || strtoupper($contents[0]) != "YN") {
            return self::ERROR_CODE_WRONG_COMMAND;
        }
        $fileId = intval($contents[1]);
        $erpFile = EnterpriseFile::getPaymentById($fileId, $msisdn);
        if (!$erpFile) {
            return self::ERROR_CODE_WRONG_REQUEST_CODE;
        }
        $fee = FEE_KHOI_TAO;
        $type = TYPE_FEE_KHOI_TAO;
        $strType = 'INIT';
        if ($erpFile->requires_recording == 1) {
            $fee = FEE_KHOI_TAO + FEE_THU_AM;
            $type = TYPE_FEE_COMBINE;
            $strType = 'COMBINE';
        }
        // do charge -> TODO: update sale code
        $erp = Enteprise::findById($erpFile->enterprise_id);
        if (!$erp || $erp->type != USER_TYPE_INTERNAL || !$erp->id_number) {
            return self::ERROR_CODE_WRONG_ERP_INFO;
        }
        list($errorCode, $log) = Charging::chargeSaleCode($msisdn, $fee, 'CHARGE', $strType, $erp->id_number);
        /* @var ChargingLogBase $log */
        $log->enterprise_file_id = $erpFile->id;
        $log->enterprise_id = $erpFile->enterprise_id;
        $log->type = $type;
        $log->discount = 0;
        $log->old_fee = $fee;
        $log->save(false);

        if ($errorCode == 0) {
            if ($erpFile->requires_recording == 1) {
                $erpFile->status = RBT_STATUS_WAITING_RECORD;
            } else {
                $erpFile->status = RBT_STATUS_WAITING;
            }
            $erpFile->save(false);
            $mtContent = str_replace('<#fee#>', number_format($fee, 0, ",", "."), str_replace('<#code#>', Helpers::eprCode($erpFile->id), \Yii::$app->params['thanh_toan_thanh_cong']));
            SendMT::sendMT($msisdn, $mtContent);
            Yii::info("[molistener] {$msisdn} charge fee {$fee} successful !", "Charging");
            return self::ERROR_CODE_SUCCESS;
        } else if ($errorCode == '401') {
            $mtContent = str_replace('<#fee#>', number_format($fee, 0, ",", "."), ChargingError::getMessage(401));
            SendMT::sendMT($msisdn, $mtContent);
            Yii::info("[molistener] {$msisdn} charge fee {$fee} failed 401 !", "Charging");
            return self::ERROR_CODE_NOT_ENOUGH_MONEY;
        } else {
            Yii::info("[molistener] {$msisdn} charge fee {$fee} failed {$errorCode} !", "Charging");
            return self::ERROR_CODE_FAILED;
        }
    }
}
