<?php

namespace api\models;

use Yii;

class ApiClient extends \common\models\ApiClientBase {

    static function getClientBySecret($client_id, $client_secret) {
        $cache = Yii::$app->cache;
        $key = "ApiClient_getClientBySecret_" . $client_id . '_' . $client_secret;
        $data = $cache->get($key);
        if (!$data) {
            $data = ApiClient::find()
                            ->where([
                                'client_id' => $client_id,
                                'client_secret' => $client_secret
                            ])->one();
            if ($data) {
                $cache->set($key, $data, LOGIN_TIMEOUT);
            }
        }
        return $data;
    }

}
