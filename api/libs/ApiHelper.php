<?php

namespace api\libs;

class ApiHelper {

    static function formatResponse($errCode, $content = null, $customMessage = '') {
        if ($errCode) {
            $message = ($customMessage) ? $customMessage : ApiResponseCode::getMessage($errCode);
            if (!$message) {
                return self::errorResponse();
            }
            return [
                'errorCode' => $errCode,
                'message' => $message,
                'data' => $content,
            ];
        }
        return self::errorResponse();
    }

    static function errorResponse() {
        return [
            'errorCode' => ApiResponseCode::SYSTEM_ERROR,
            'message' => ApiResponseCode::getMessage(ApiResponseCode::SYSTEM_ERROR),
            'data' => [],
        ];
    }

    public static function time_elapsed_string($datetime, $full = false) {
        $now = new \DateTime();
        $ago = new \DateTime($datetime);
        $diff = $now->diff($ago);

        $diff->w = floor($diff->d / 7);
        $diff->d -= $diff->w * 7;

        $string = array(
            'y' => 'year',
            'm' => 'month',
            'w' => 'week',
            'd' => 'day',
            'h' => 'hour',
            'i' => 'minute',
            's' => 'second',
        );
        foreach ($string as $k => &$v) {
            if ($diff->$k) {
                $v = $diff->$k . ' ' . $v . ($diff->$k > 1 ? 's' : '');
            } else {
                unset($string[$k]);
            }
        }

        if (!$full) {
            $string = array_slice($string, 0, 1);
        }
        return $string ? implode(', ', $string) . ' ago' : 'just now';
    }

}
