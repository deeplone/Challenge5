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
class PromotionController extends Controller
{
    const USERNAME = 'imuzik_promotion';
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

        if (strtoupper($content) != "TT") {
            return self::ERROR_CODE_WRONG_COMMAND;
        }

        $mtContent = "";
        SendMT::sendMT($msisdn, $mtContent);
        Yii::info("[molistener] {$msisdn} charge fee  successful !", "Charging");
        return self::ERROR_CODE_SUCCESS;

    }
}
