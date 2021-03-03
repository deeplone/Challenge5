<?php

namespace common\libs;

class RemoveSign {

    /**
     * KhanhNQ16 - 17/10/2015
     * @param $msisdn
     */
    public static function convertMsisdn($msisdn, $type = 'simple') {
        return \common\helpers\Helpers::convertMsisdn($msisdn, $type);
    }

    /**
     * KhanhNQ16
     * @param $str
     * @return string
     */
    public static function removeSign($str) {
        return \common\helpers\Helpers::removeSign($str);
    }

    public static function removeSignAndSpace($str) {
        return \common\helpers\Helpers::removeSignAndSpace($str);
    }

}
