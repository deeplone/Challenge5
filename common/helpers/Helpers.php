<?php

namespace common\helpers;

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 * author: Toanhv9
 */

use common\models\ChargingLogBase;
use Yii;

class Helpers
{

    public static $hasSign = array(
        "à", "á", "ạ", "ả", "ã", "â", "ầ", "ấ", "ậ", "ẩ", "ẫ", "ă", "ằ", "ắ", "ặ", "ẳ", "ẵ",
        "è", "é", "ẹ", "ẻ", "ẽ", "ê", "ề", "ế", "ệ", "ể", "ễ",
        "ì", "í", "ị", "ỉ", "ĩ",
        "ò", "ó", "ọ", "ỏ", "õ", "ô", "ồ", "ố", "ộ", "ổ", "ỗ", "ơ", "ờ", "ớ", "ợ", "ở", "ỡ",
        "ù", "ú", "ụ", "ủ", "ũ", "ư", "ừ", "ứ", "ự", "ử", "ữ",
        "ỳ", "ý", "ỵ", "ỷ", "ỹ",
        "đ",
        "À", "Á", "Ạ", "Ả", "Ã", "Â", "Ầ", "Ấ", "Ậ", "Ẩ", "Ẫ", "Ă", "Ằ", "Ắ", "Ặ", "Ẳ", "Ẵ",
        "È", "É", "Ẹ", "Ẻ", "Ẽ", "Ê", "Ề", "Ế", "Ệ", "Ể", "Ễ",
        "Ì", "Í", "Ị", "Ỉ", "Ĩ",
        "Ò", "Ó", "Ọ", "Ỏ", "Õ", "Ô", "Ồ", "Ố", "Ộ", "Ổ", "Ỗ", "Ơ", "Ờ", "Ớ", "Ợ", "Ở", "Ỡ",
        "Ù", "Ú", "Ụ", "Ủ", "Ũ", "Ư", "Ừ", "Ứ", "Ự", "Ử", "Ữ",
        "Ỳ", "Ý", "Ỵ", "Ỷ", "Ỹ",
        "Đ",
    );
    public static $noSign = array(
        "a", "a", "a", "a", "a", "a", "a", "a", "a", "a", "a", "a", "a", "a", "a", "a", "a",
        "e", "e", "e", "e", "e", "e", "e", "e", "e", "e", "e",
        "i", "i", "i", "i", "i",
        "o", "o", "o", "o", "o", "o", "o", "o", "o", "o", "o", "o", "o", "o", "o", "o", "o",
        "u", "u", "u", "u", "u", "u", "u", "u", "u", "u", "u",
        "y", "y", "y", "y", "y",
        "d",
        "a", "a", "a", "a", "a", "a", "a", "a", "a", "a", "a", "a", "a", "a", "a", "a", "a",
        "e", "e", "e", "e", "e", "e", "e", "e", "e", "e", "e",
        "i", "i", "i", "i", "i",
        "o", "o", "o", "o", "o", "o", "o", "o", "o", "o", "o", "o", "o", "o", "o", "o", "o",
        "u", "u", "u", "u", "u", "u", "u", "u", "u", "u", "u",
        "y", "y", "y", "y", "y",
        "d");
    public static $noSignOnly = array(
        "a", "a", "a", "a", "a", "a", "a", "a", "a", "a", "a", "a", "a", "a", "a", "a", "a",
        "e", "e", "e", "e", "e", "e", "e", "e", "e", "e", "e",
        "i", "i", "i", "i", "i",
        "o", "o", "o", "o", "o", "o", "o", "o", "o", "o", "o", "o", "o", "o", "o", "o", "o",
        "u", "u", "u", "u", "u", "u", "u", "u", "u", "u", "u",
        "y", "y", "y", "y", "y",
        "d",
        "A", "A", "A", "A", "A", "A", "A", "A", "A", "A", "A", "A", "A", "A", "A", "A", "A",
        "E", "E", "E", "E", "E", "E", "E", "E", "E", "E", "E",
        "I", "I", "I", "I", "I",
        "O", "O", "O", "O", "O", "O", "O", "O", "O", "O", "O", "O", "O", "O", "O", "O", "O",
        "U", "U", "U", "U", "U", "U", "U", "U", "U", "U", "U",
        "Y", "Y", "Y", "Y", "Y",
        "D");

    public static function generateStructurePath()
    {
        $uniqueFileName = uniqid();
        $mash = 255;
        $hashCode = crc32($uniqueFileName);
        $firstDir = $hashCode & $mash;
        $firstDir = vsprintf("%02x", $firstDir);
        $secondDir = ($hashCode >> 8) & $mash;
        $secondDir = vsprintf("%02x", $secondDir);
        $thirdDir = ($hashCode >> 4) & $mash;
        $thirdDir = vsprintf("%02x", $thirdDir);
        return $firstDir . "/" . $secondDir . "/" . $thirdDir . '/';
    }

    /**
     * Che so dien thoai de dam bao ATTT
     * @param $msisdn
     * @return string
     */
    public static function hideMsisdn($msisdn)
    {
        return '0' . substr($msisdn, 0, -7) . 'xxxxxx' . substr($msisdn, -1);
    }

    public static function convertMsisdn($isdn, $type = 'simple')
    {
        $msisdn = trim(trim($isdn), '+');
        if (self::isPhoneNumber($msisdn)) {
            if ($msisdn != "") {
                switch ($type) {
                    case 'simple':
                        if ($msisdn[0] == '0') {
                            while ($msisdn[0] == '0') {
                                $msisdn = substr($msisdn, 1);
                            }
                            return $msisdn;
                        } else if ($msisdn[0] . $msisdn[1] == '84')
                            return substr($msisdn, 2);
                        else
                            return $msisdn;
                        break;
                    case '84':
                        if ($msisdn[0] == '0') {
                            while ($msisdn[0] == '0') {
                                $msisdn = substr($msisdn, 1);
                            }
                            return '84' . $msisdn;
                        } else if ($msisdn[0] . $msisdn[1] != '84')
                            return '84' . $msisdn;
                        else
                            return $msisdn;
                        break;

                    default:
                        if ($msisdn[0] == '0') {
                            while ($msisdn[0] == '0') {
                                $msisdn = substr($msisdn, 1);
                            }
                            return '84' . $msisdn;
                        } else if ($msisdn[0] . $msisdn[1] != '84')
                            return '84' . $msisdn;
                        else
                            return $msisdn;
                        break;
                }
            }
        }
        return '';
    }

    public static function isPhoneNumber($msisdn)
    {
        preg_match(\Yii::$app->params['viettel_phone_expression'], trim($msisdn), $matches);
        return $matches;
    }

    public static function generateRandomString($length = 8)
    {
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $charactersLength = strlen($characters);
        $randomString = '';
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[rand(0, $charactersLength - 1)];
        }
        return $randomString;
    }

    public static function generateRandomNumber($length = 6)
    {
        $characters = '0123456789';
        $charactersLength = strlen($characters);
        $randomString = '';
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[rand(0, $charactersLength - 1)];
        }
        return $randomString;
    }

    public static function isVietnamese($str)
    {
        if (!mb_check_encoding($str, 'ASCII')) {
            return true;
        }

        return false;
    }

    public static function eprCode($code)
    {
        while (strlen($code) < 6) {
            $code = '0' . $code;
        }

        return $code;
    }

    public static function verifyMp3($file)
    {
        $fileUpload = new \yii\web\UploadedFile();
        $fileUpload->name = $file['name'];
        $fileUpload->tempName = $file['tmp_name'];
        $fileUpload->type = $file['type'];
        $fileUpload->size = $file['size'];
        $fileUpload->error = $file['error'];

        $mp3file = new \common\libs\MP3File($fileUpload->tempName);
        $duration = $mp3file->getDuration();
        if ($duration >= 30 && $duration <= 43) {
            return true;
        }

        return false;
    }

    public static function checkInfoUrl($currentRoute, $route, $items, &$checked)
    {
        if ($checked) {
            return false;
        }
        if ($route != $currentRoute) {
            return false;
        }
        foreach ($items as $key => $value) {
            if (Yii::$app->request->getQueryParam($key) != $value) {
                return false;
            }
        }
        $checked = true;
        return true;
    }

    const COUNT_DISCOUNT_SESS = 'COUNT_DISCOUNT';

    public static function calDiscount($erpId, $fileId)
    {
        if (Yii::$app->params['discount']['enabled']) {
            $count = ChargingLogBase::countSuccessInPreviousMonth($erpId);
            if (!($count)) {
                $count = ChargingLogBase::countSuccessInMonth($erpId) + 1;
            }

            foreach (Yii::$app->params['discount']['rules'] as $key => $val) {
                if ($key >= $count) {
                    Yii::$app->session->set(Helpers::COUNT_DISCOUNT_SESS . '_' . $fileId, $val);
                    break;
                }
            }

        } else {
            Yii::$app->session->set(Helpers::COUNT_DISCOUNT_SESS . '_' . $fileId, 0);
        }
    }

    public static function getDiscount($fileId)
    {
        if (Yii::$app->params['discount']['enabled'] && Yii::$app->session->get(Helpers::COUNT_DISCOUNT_SESS . '_' . $fileId)) {
            return Yii::$app->session->get(Helpers::COUNT_DISCOUNT_SESS . '_' . $fileId);
        }
        return 0;
    }
}
