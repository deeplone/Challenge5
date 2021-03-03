<?php


namespace frontend\models;


use common\helpers\Helpers;
use Yii;
use yii\redis\ActiveRecord;

/**
 * Class OtpConfirm
 * @property string $msisdn Số điện thoại
 * @property int $validation_count Số điện thoại
 * @property int $created_at Số điện thoại
 * @package frontend\models
 */
class OtpConfirm extends ActiveRecord
{
    public static function getDb()
    {
        return Yii::$app->get('redis_obj');
    }

    public static function primaryKey() {
        return ['msisdn'];
    }

    public function attributes()
    {
        return ['msisdn', 'validation_count', 'created_at'];
    }

    public static function validateLimit($msisdn, $limit) {
        $otpConfirm = OtpConfirm::findOne(['msisdn' => $msisdn]);
        if ($otpConfirm) {
            Yii::info("[actionConfirmOtp][validateLimit] OtpConfirm {$msisdn} count {$otpConfirm->validation_count} over {$limit}","otp");
            if ($otpConfirm->validation_count > $limit - 1) {
                return false;
            }
            $otpConfirm->updateCounters(['validation_count' => 1]);
        } else {
            Yii::info("[actionConfirmOtp][validateLimit] OtpConfirm {$msisdn} insert new","otp");
            $otpConfirm = new OtpConfirm();
            $otpConfirm->msisdn = Helpers::convertMsisdn($msisdn);
            $otpConfirm->validation_count = 1;
            $otpConfirm->created_at = time();
            $otpConfirm->save(false);
        }
        return true;
    }

    public static function deleteByMsisdn($msisdn) {
        return OtpConfirm::deleteAll(['msisdn' => Helpers::convertMsisdn($msisdn)]);
    }
}