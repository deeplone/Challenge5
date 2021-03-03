<?php

namespace api\libs;

use Yii;

class ApiResponseCode {

    const SUCCESS = '000000';
    const SYSTEM_ERROR = '000001';
    const REQUIRE_LOGIN = '000002';
    const UNKNOWN_METHOD = '000003';
    const AUTH_CLIENT_ID_SECRET_IS_REQUIRED = '000004';
    const IP_NO_ACCESS = '000005';
    const NAME_INVALID = '000006';
    const ISDN_INVALID = '000007';
    const MP3_INVALID = '000008';
    const GEN_TONE_CODE_INVALID = '000009';
    const CONTENT_INVALID = '000010';
    const PARAM_INVALID = '100000';

    public static function getMessage($errorCode) {
        $mess = [
            self::SUCCESS => Yii::t('api', 'Successful'),
            self::SYSTEM_ERROR => Yii::t('api', 'Hệ thống đang bận, vui lòng thử lại sau.'),
            self::UNKNOWN_METHOD => Yii::t('api', 'Unknown method'),
            self::AUTH_CLIENT_ID_SECRET_IS_REQUIRED => Yii::t('api', 'Tài khoản không hợp lệ!'),
            self::IP_NO_ACCESS => Yii::t('api', 'IP không có quyền truy cập!'),
            self::NAME_INVALID => Yii::t('api', 'Tên bài hát không hợp lệ!'),
            self::ISDN_INVALID => Yii::t('api', 'Số điện thoại- không hợp lệ!'),
            self::MP3_INVALID => Yii::t('api', 'File nhạc không hợp lệ!'),
            self::GEN_TONE_CODE_INVALID => Yii::t('api', 'Tạo nhạc chờ không thành công!'),
            self::CONTENT_INVALID => Yii::t('api', 'Nội dung thu âm không hợp lệ!'),
            self::PARAM_INVALID => Yii::t('api', 'Tham số không hợp lệ!'),
        ];
        if ($mess[$errorCode]) {
            return $mess[$errorCode];
        }
        return '';
    }

}
