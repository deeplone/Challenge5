<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

namespace common\libs;

/**
 * Description of MobileRecognized
 *
 * @author nghiald
 */
use Yii;
use common\libs\ImuzikSoapClient;

class MobileRecognized {

    public static function getRemoteIp() {
        if ($_SERVER['HTTP_X_FORWARDED_FOR']) {
            return $_SERVER['HTTP_X_FORWARDED_FOR'];
        }
        return $_SERVER['REMOTE_ADDR'];
    }

    /**
     * xet xem ip có thuoc dải private ko
     * @param string $ip
     */
    public static function inPriateIpRange($ip) {
        $ip = ip2long($ip);
        return ($ip >= 167772160 && $ip <= 184549375) ||
                ($ip >= -1408237568 && $ip <= -1407188993) ||
                ($ip >= -1062731776 && $ip <= -1062666241) ||
                ($ip >= 2130706432 && $ip <= 2130706687);
    }

    /**
     * xet xem ip co thuoc tu ipmin den ipmax ko
     * @param <type> $ip
     * @param <type> $ipmin
     * @param <type> $ipmax
     * @return <type>
     */
    public static function ipInRange($ip, $ipmin, $ipmax) {
        $ip = sprintf('%u', ip2long($ip));
        $ipmin = sprintf('%u', ip2long($ipmin));
        $ipmax = sprintf('%u', ip2long($ipmax));

        return $ip >= $ipmin && $ip <= $ipmax;
    }

    /**
     * check ip co thuoc 1 dai mang hay khong. 192.168.133.31 co thuoc 192.168.133.0/24 ko?
     * @param string $IP
     * @param string $CIDR
     * @return string
     */
    public static function ipCIDRCheck($IP, $CIDR) {
        list ($net, $mask) = explode("/", $CIDR);

        $ip_net = ip2long($net);
        $ip_mask = ~((1 << (32 - $mask)) - 1);

        $ip_ip = ip2long($IP);

        $ip_ip_net = $ip_ip & $ip_mask;

        return ($ip_ip_net == $ip_net);
    }

    // The last octect of the IP address is removed to anonymize the user.
    private static function _GAGetIP($remoteAddress) {
        if (empty($remoteAddress)) {
            return "";
        }
        // Capture the first three octects of the IP address and replace the forth
        // with 0, e.g. 124.455.3.123 becomes 124.455.3.0
        $regex = "/^([^.]+\.[^.]+\.[^.]+\.).*/";
        if (preg_match($regex, $remoteAddress, $matches)) {
            return $matches[1] . "0";
        } else {
            return "";
        }
    }

    /**
     * @param string $msisdn
     * @return string
     */
    public static final function convertMsisdn($msisdn) {
        $msisdn = trim($msisdn);
//        $start = substr($msisdn, 0, 1);
//        if (empty($msisdn))
//            return null;
//        if ($start == '0') {
//            $msisdn = '84' . substr($msisdn, 1);
//        } elseif (in_array($start, array('1', '9'))) {
//            $msisdn = '84' . $msisdn;
//        }
//
//        return $msisdn;

        if ($msisdn[0] == '0')
            return '84' . substr($msisdn, 1);
        else if ($msisdn[0] . $msisdn[1] != '84')
            return '84' . $msisdn;
        else
            return $msisdn;
    }

    /**
     * Ham check ip pool va goi vaaa de nhan dien theo IP
     * @return string
     */
    public static function getMsisdnFromAgent() {
        $ipaddr = MobileRecognized::getRemoteIp();
        $pass = false;
        $ippools = Yii::$app->params['ip_pools'];
        foreach ($ippools as $ipcidr) {
            if ($ipcidr && MobileRecognized::ipCIDRCheck($ipaddr, $ipcidr)) {
                $pass = true;
                break;
            }
        }
        $msisdn = "";
        if ($pass) {
            $msisdn = MobileRecognized::callRadius($ipaddr);
        }

        return $msisdn;
    }

    /**
     * Kiem tra thue bao co phai thue bao dcom khong
     * @param string $msisdn
     * @return string
     * @author linhnt43
     * @created_at: 11/17/14 9:27 AM
     */
    public static function checkDcom($msisdn) {
        return false;
//        try {
//            $wsdlConfig = sfConfig::get("app_dcom_wsdl");
//            $msisdn = VtHelper::getMobileNumber($msisdn, VtHelper::MOBILE_GLOBAL);
//            $params = array(
//                'userName' => $wsdlConfig['username'],
//                'password' => $wsdlConfig['password'],
//                'msisdn' => $msisdn,
//            );
//            $method = "CheckDCOM";
//            $soapUtils = new SoapUtils($wsdlConfig['wsdl'], $params, $method);
//            $result = $soapUtils->callService();
//            if ($result->errorCode == 0) {
//                if(strtolower(trim($result->type)) == 'dcom'){
//                    return true;
//                } else {
//                    return false;
//                }
//            } else {
//                return array('code' => $result->errorCode, 'message' => "Hệ thống đang bận, vui lòng thử lại sau");
//            }
//        } catch (CallSoapErrorException $exc) {
//            //thuc hien ghi log
//            return array('code' => $exc->getCode(), 'message' => "Hệ thống đang bận, vui lòng thử lại sau");
//        }
    }

    /**
     * Kiem tra thong tin client
     * Tra ve SDT dang 9xx
     * @param $ip - ip client
     * @return string - MSISDN dang 9xx
     * @author NghiaLD <nghiald@viettel.com>
     * @created_at: 8/21/14 1:27 PM
     */
    public static function callRadius($ip) {

        $startTime = date('Y-m-d H:i:s');
        $radiusConfig = Yii::$app->params['radius'];
        $wsdl = $radiusConfig['wsdl'];
        $params = array();
        $options = array();
        $method = $radiusConfig['method'];

        $options['connect_timeout'] = $radiusConfig['connect_timeout'];
        $options['timeout'] = $radiusConfig['timeout'];
        $options['cache_wsdl'] = WSDL_CACHE_NONE;
        $options['trace'] = 1;

        $params['username'] = $radiusConfig['username'];
        $params['password'] = $radiusConfig['password'];
        $params['ip'] = $ip;

        try {
            ini_set("default_socket_timeout", $radiusConfig['timeout']);

            $client = new \SoapClient($wsdl, $options);
            $result = $client->__soapCall($method, array($params));
        } catch (\Exception $e) {
            \Yii::error('[vaaa] CALL VAAA FAIL: CLIENT_IP=' . $ip . '; vaaa exception: ' . $e->getMessage(), "radius");
            return '';
        }

        if (is_object($result)) {
            if ($result->return->code == 0) {
                \Yii::info('[vaaa] CALL VAAA: CLIENT_IP=' . $ip . '|' . $result->return->desc . '|' . $startTime . '-' . date('Y-m-d H:i:s'), 'radius');
                return RemoveSign::convertMsisdn($result->return->desc);
            } else {
                \Yii::info('[vaaa] CALL VAAA: CLIENT_IP=' . $ip . ' -> ' . $result->return->desc, 'radius');
                return '';
            }
        } else {
            \Yii::error('[vaaa] CALL VAAA: CLIENT_IP=' . $ip . ' -> response no object!', 'radius');
            return '';
        }
    }

    /**
     * Nhận diện loại số điện thoại
     * @param string $msisdn
     * @author NghiaLD <nghiald@viettel.com>
     * @created_at: 8/21/14 2:48 PM
     */
    public static function callMobileRecognized($msisdn) {
        try {
            $mobileRecognizedCfg = sfConfig::get("app_mobile_recognize", array());
            $wsdl = $mobileRecognizedCfg['wsdl'];
            $method = $mobileRecognizedCfg['method'];
            $params = array();
            $params['username'] = $mobileRecognizedCfg['username'];
            $params['password'] = $mobileRecognizedCfg['password'];
            $params['msisdn'] = $msisdn;
            $soapClient = new SoapUtils($wsdl, $params, $method);

            $response = $soapClient->callService();
            $stdClass = $response->return;
//            sfContext::getInstance()->getLogger()->info("Mobile recognized: errorCode=" . $stdClass->errorCode . "&description=" . $stdClass->description);
            if ($stdClass->errorCode == '0000')
                return $stdClass;
            else {
                return null;
            }
        } catch (Exception $ex) {
//            sfContext::getInstance()->getLogger()->debug("Mobile recognized: call Mobile recognized with [msidn=" . $msisdn . "] failed," . var_export($ex, true));
            return null;
        };
    }

    /**
     * Lay so dien thoai tu header
     * @return string
     */
    public static function getMsisdnFromHeader() {
        if (isset($_SERVER['HTTP_MSISDN'])) {
            return $_SERVER['HTTP_MSISDN'];
        } else
            return '';
    }

    /**
     * Ham lay msisdn va so sanh voi header
     * Tra ve SDT dang 9xx
     * @return string
     */
    public static function getMsisdn() {
        // return self::getMsisdnFromAgent(); // chay tren beta, remove khi chạy thật
        $msisdn1 = RemoveSign::convertMsisdn(self::getMsisdnFromHeader());

        // Neu co SDT tren header thi moi lay theo VAAA
        // Neu detect duoc SDT nhung
        if ($msisdn1) {
            // check pool va goi vaaa
            $msisdn2 = self::getMsisdnFromAgent();

            if (!$msisdn2) {
                Yii::info('[vaaa] fail: CLIENT_IP=' . MobileRecognized::getRemoteIp() . '; header=' . $msisdn1 . '; vaaa=NULL', "radius");
                return '';
            } elseif ($msisdn1 == $msisdn2) {
                Yii::info('[vaaa] success: CLIENT_IP=' . MobileRecognized::getRemoteIp() . '; msisdn=' . $msisdn1, "radius");
                return $msisdn2;
            } else {
                Yii::info('[vaaa] fail: CLIENT_IP=' . MobileRecognized::getRemoteIp() . '; header=' . $msisdn1 . '; vaaa=' . $msisdn2, "radius");
                return '';
            }
        } else {
            Yii::info('[vaaa] fail: CLIENT_IP=' . MobileRecognized::getRemoteIp() . '; header=NULL', "radius");
            return '';
        }
    }

}
