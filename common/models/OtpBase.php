<?php

namespace common\models;

use common\helpers\Helpers;
use frontend\models\OtpConfirm;
use Yii;
use yii\db\Expression;

class OtpBase extends \common\models\db\OtpDB
{

    public static function validateOtp($msisdn, $otp)
    {
        $query = OtpBase::find()->where(['msisdn' => Helpers::convertMsisdn($msisdn)])
            ->andWhere(['>=', 'expired_time', new Expression('now()')])
            ->orderBy('expired_time DESC');
        if ($data = $query->one()) {
            if ($data->otp == $otp) {
                OtpBase::deleteAll(['msisdn' => Helpers::convertMsisdn($msisdn)]);
                OtpConfirm::deleteByMsisdn($msisdn);
                return true;
            }
        }
        return false;
    }

    /**
     * Generate otp for msisdn
     * @param $msisdn
     * @return string|null
     */
    public static function gen($msisdn)
    {
        $code = Helpers::generateRandomNumber();
        $otp = new OtpBase();
        $otp->msisdn = Helpers::convertMsisdn($msisdn);
        $otp->otp = $code;
        $otp->expired_time = new Expression('NOW() + INTERVAL 30 MINUTE');
        if ($otp->save()) {
            return $code;
        }
        return null;
    }

    /**
     * Count Otp request time
     * @param string $msisdn msisdn for count
     * @param int $time time for limit count (second)
     * @return int|string
     */
    public static function countLimitOtp($msisdn, $time)
    {
        return OtpBase::find()
            ->where([
                'msisdn' => Helpers::convertMsisdn($msisdn)
            ])
            ->andWhere(['>=', 'expired_time', new Expression('NOW() - INTERVAL ' . ($time - 30 * 60) . ' SECOND')])
            // minus 30 seconds for expired time
            ->count();
    }

}
