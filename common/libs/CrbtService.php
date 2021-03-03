<?php

namespace common\libs;

/**
 * Description of CrbtService
 *
 * @author Toanhv9
 */
class CrbtService {

    public static function sendMT($msisdn, $content) {
        $param = [
            'SendSmEvt' => [
                'role' => '1',
                'smContent' => $content,
                'phoneNumbers' => ['item' => \common\helpers\Helpers::convertMsisdn($msisdn, '84')]
            ]
        ];
        return (new self)->soapCall($param, 'sendSm');
    }

    public static function uploadTone($toneName) {
        $ws = \Yii::$app->params['vcrbt-ws'];
        $validDay = date('Y-m-d H:m:s', strtotime('+3 years'));
        $param = [
            'UploadToneEvt' => [
                'role' => "1",
                'toneName' => $toneName,
                'partnerID' => "601825",
                'toneValidDay' => $validDay,
                'resourceServiceType' => "3",
                'uploadType ' => "14",
                'portalAccount' => $ws['portalAccount'],
                'portalPwd' => $ws['portalPwd']
            ]
        ];

        return (new self)->soapCall($param, 'uploadTone');
    }

    public static function subscribeBCCS($phoneNumber, $toneCode, $brandId) {
        $param = [
            'UploadToneEvt' => [
                'phoneNumber' => \common\helpers\Helpers::convertMsisdn($phoneNumber),
                'tradeMark' => $brandId,
                'triggerType' => "0",
                'resourceCode ' => $toneCode,
            ]
        ];

        return (new self)->soapCall($param, 'subscribeBCCS');
    }

    public static function checkStatus($toneName) {
        $ws = \Yii::$app->params['vcrbt-ws'];
        $validDay = date('Y-m-d H:m:s', strtotime('+3 years'));
        $param = [
            'UploadToneEvt' => [
                'role' => "1",
                'toneName' => $toneName,
                'partnerID' => "601825",
                'toneValidDay' => $validDay,
                'resourceServiceType' => "3",
                'uploadType ' => "14",
                'portalAccount' => $ws['portalAccount'],
                'portalPwd' => $ws['portalPwd']
            ]
        ];

        return (new self)->soapCall($param, 'uploadTone');
    }

    protected function soapCall($param, $funcion, $url = 'UserToneManage') {
        $wsdl = \Yii::$app->params['vcrbt_usertonemanage'];
        $result = ['returnCode' => null];

        $client = new \nusoap_client($wsdl, false, '', '', '', '');
//        $client->soap_defencoding = 'UTF-8';
//        $client->decode_utf8 = false;
        $client->setUseCurl('0');
        $client->useHTTPPersistentConnection();
        if ($client->getError()) {
            return ['returnCode' => null];
        }

        try {
            \Yii::info('crbt > wsdl = ' . $wsdl, 'api');
            \Yii::info($funcion . ': crbt > params=' . json_encode($param), 'api');
            $result = $client->call($funcion, $param, '', '');
            \Yii::info($funcion . ': crbt > request=' . $client->request, 'api');
            \Yii::info($funcion . ': crbt > response=' . $client->response, 'api');
        } catch (Exception $e) {
            \Yii::error($funcion . ': crbt > error=' . $e->getMessage(), 'crbt');
            return ['returnCode' => null];
        }

        return $result;
    }

}
