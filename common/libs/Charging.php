<?php

namespace common\libs;

use Yii;
use yii\base\ErrorException;

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class Charging
{

    /**
     * @param $msisdn
     * @param $fee
     * @param string $cmd
     * @return array
     */
    public static function charge($msisdn, $fee, $cmd = 'CHARGE')
    {
        ini_set('soap.wsdl_cache_enabled', 0);
        ini_set('soap.wsdl_cache_ttl', 0);
        $chargeReturnCode = -1;
        if (in_array($msisdn, \Yii::$app->params['charge_free'])) {
            $fee = 0;
        }
        $serviceid = Yii::$app->params['charging-acc']['serviceid'];
        $providerid = Yii::$app->params['charging-acc']['providerid'];
        $content = "$cmd|$serviceid|$providerid|$msisdn|||";
        $params = [
            'msisdn' => \common\helpers\Helpers::convertMsisdn($msisdn),
            'charging' => $fee,
            'reqTime' => date('YmdHis', time()),
            'requestId' => date('YmdHis', time()) + 1,
            'cmd' => $cmd,
            'contents' => $content,
            'serviceId' => $serviceid,
            'username' => Yii::$app->params['charging-acc']['username'],
            'password' => Yii::$app->params['charging-acc']['password'],
            'providerid' => $providerid,
        ];
        \Yii::info('Charging > params = ' . json_encode($params), 'Charging');
        $wsdl = Yii::$app->params['charging-acc']['wsdl'];

        try {
            \Yii::info('Charging > wsdl = ' . $wsdl, 'Charging');
            $client = new \SoapClient($wsdl, array('trace' => 1, 'connection_timeout' => 30, 'cache_wsdl' => WSDL_CACHE_NONE));
            $result = $client->__call('processCharging', array($params));
            \Yii::info('Charging > response=' . json_encode($result), 'Charging');
            $chargeReturnCode = isset($result->return) ? $result->return : $chargeReturnCode;
        } catch (\SoapFault $e) {
            Yii::error($e->getMessage());
            return [$chargeReturnCode, null];
        }

        $log = new \common\models\ChargingLogBase();
        $log->msisdn = \common\helpers\Helpers::convertMsisdn($msisdn);
        $log->cmd = $cmd;
        $log->fee = $fee;
        $log->content = $content;
        $log->error_code = $chargeReturnCode;
        $log->charged_at = new yii\db\Expression('now()');
        $log->save(false);

        return [$chargeReturnCode, $log];
    }

    /**
     * @param $msisdn
     * @param $fee
     * @param string $cmd
     * @param $type
     * @param $saleCode
     * @return array
     */
    public static function chargeSaleCode($msisdn, $fee, $cmd = 'CHARGE', $type = 'INIT', $saleCode = '')
    {
        ini_set('soap.wsdl_cache_enabled', 0);
        ini_set('soap.wsdl_cache_ttl', 0);
        $chargeReturnCode = -1;
        if (in_array($msisdn, \Yii::$app->params['charge_free'])) {
            $fee = 0;
        }
        $serviceid = Yii::$app->params['charging-acc']['serviceid'];
        $providerid = Yii::$app->params['charging-acc']['providerid'];
        $saleCode = 'IMZ_B_' . $saleCode;
        $content = "$cmd|$serviceid|$providerid|$msisdn|$type|$saleCode|";
        $params = [
            'msisdn' => \common\helpers\Helpers::convertMsisdn($msisdn),
            'charging' => $fee,
            'reqTime' => date('YmdHis', time()),
            'requestId' => date('YmdHis', time()) + 1,
            'cmd' => $cmd,
            'contents' => $content,
            'serviceId' => $serviceid,
            'username' => Yii::$app->params['charging-acc']['username'],
            'password' => Yii::$app->params['charging-acc']['password'],
            'providerid' => $providerid,
        ];
        \Yii::info('Charging > params = ' . json_encode($params), 'Charging');
        $wsdl = Yii::$app->params['charging-acc']['wsdl'];

        try {
            \Yii::info('Charging > wsdl = ' . $wsdl, 'Charging');
            $client = new \SoapClient($wsdl, array('trace' => 1, 'connection_timeout' => 30, 'cache_wsdl' => WSDL_CACHE_NONE));
            $result = $client->__call('processCharging', array($params));
            \Yii::info('Charging > response=' . json_encode($result), 'Charging');
            $chargeReturnCode = isset($result->return) ? $result->return : $chargeReturnCode;
        } catch (\SoapFault $e) {
            Yii::error($e->getMessage());
            return [$chargeReturnCode, null];
        }

        $log = new \common\models\ChargingLogBase();
        $log->msisdn = \common\helpers\Helpers::convertMsisdn($msisdn);
        $log->cmd = $cmd;
        $log->fee = $fee;
        $log->content = $content;
        $log->error_code = $chargeReturnCode;
        $log->charged_at = new yii\db\Expression('now()');
        $log->save(false);

        return [$chargeReturnCode, $log];
    }

    public static function checkBalance($msisdn)
    {
        ini_set('soap.wsdl_cache_enabled', 0);
        ini_set('soap.wsdl_cache_ttl', 0);
        $chargeReturnCode = -1;
        $fee = 0;
        $cmd = 'CHKBALANCE';
        $serviceId = Yii::$app->params['check-balance-acc']['serviceid'];
        $providerId = Yii::$app->params['check-balance-acc']['providerid'];
        $content = "$cmd|$serviceId|$msisdn";
        $params = [
            'msisdn' => \common\helpers\Helpers::convertMsisdn($msisdn),
            'charging' => $fee,
            'reqTime' => date('YmdHis', time()),
            'requestId' => date('YmdHis', time()) + 1,
            'cmd' => $cmd,
            'contents' => $content,
            'serviceId' => $serviceId,
            'username' => Yii::$app->params['check-balance-acc']['username'],
            'password' => Yii::$app->params['check-balance-acc']['password'],
            'providerid' => $providerId,
        ];
        \Yii::info('Charging > params = ' . json_encode($params), 'Charging');
        $wsdl = Yii::$app->params['check-balance-acc']['wsdl'];

        try {
            \Yii::info('Charging > wsdl = ' . $wsdl, 'Charging');
            $client = new \SoapClient($wsdl, array('trace' => 1, 'connection_timeout' => 30, 'cache_wsdl' => WSDL_CACHE_NONE));
            $result = $client->__call('processCharging', array($params));
            \Yii::info('Charging > response=' . json_encode($result), 'Charging');
            $result = explode("|", $result->return);
            if ($result[0] == '0') {
                $chargeReturnCode = intval($result[1]);
            }
        } catch (\SoapFault $e) {
            Yii::error($e->getMessage());
            return $chargeReturnCode;
        }
        return $chargeReturnCode;
    }

    public static function checkBalanceNew($msisdn)
    {
        $chargeReturnCode = -1;
        $fee = 0;
        $cmd = 'CHKBALANCE';
        $serviceId = Yii::$app->params['check-balance-acc']['serviceid'];
        $providerId = Yii::$app->params['check-balance-acc']['providerid'];
        $content = "$cmd|$serviceId|$msisdn";
        $params = [
            'msisdn' => \common\helpers\Helpers::convertMsisdn($msisdn),
            'charging' => $fee,
            'reqTime' => date('YmdHis', time()),
            'requestId' => date('YmdHis', time()) + 1,
            'cmd' => $cmd,
            'contents' => $content,
            'serviceId' => $serviceId,
            'username' => Yii::$app->params['check-balance-acc']['username'],
            'password' => Yii::$app->params['check-balance-acc']['password'],
            'providerid' => $providerId,
        ];
        \Yii::info('Charging > params = ' . json_encode($params), 'Charging');
        $wsdl = Yii::$app->params['check-balance-acc']['wsdl'];

        try {
            \Yii::info('Charging > wsdl = ' . $wsdl, 'Charging');
            $client = new \SoapClient($wsdl, array('connection_timeout' => 30, 'cache_wsdl' => WSDL_CACHE_NONE, 'exceptions' => true));
            $result = $client->__call('processCharging', array($params));
            \Yii::info('Charging > response=' . json_encode($result), 'Charging');
            $result = explode("|", $result->return);
            if ($result[0] == '0') {
                $chargeReturnCode = intval($result[1]);
            }
        } catch (ErrorException $ex1) {
            Yii::error("ErrorException: " . $ex1->getMessage());
            return $chargeReturnCode;
        }  catch (\SoapFault $e) {
            Yii::error("SoapFault: " . $e->getMessage());
            return $chargeReturnCode;
        } catch (\Exception $ex) {
            Yii::error("Exception: " . $ex->getMessage());
            return $chargeReturnCode;
        }
        return $chargeReturnCode;
    }
}
