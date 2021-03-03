<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace common\helpers;

/**
 * Description of SendMT
 *
 * @author TOANHV9
 */
class SendMT {

    public static function sendMT($isdn, $content, $type = 1) {
        $msisdn = Helpers::convertMsisdn($isdn);
        if ($isdn && $content) {
            try {
                $result = \common\libs\CrbtService::sendMT($msisdn, $content);
            } catch (\Exception $e) {
                \Yii::error($e->getMessage());
            }
            $mt = new \common\models\MtLogBase();
            $mt->msisdn = $msisdn;
            $mt->content = $content;
            $mt->type = $type;
            $mt->returnCode = $result['returnCode'];
            return $mt->save(false);
        }
    }

}
