<?php

namespace frontend\models;

use Yii;

class EprInfo extends \common\models\EprInfoBase {
    public static function findOneByType($type)
    {
        $cache = \Yii::$app->cache;
        $key = 'findOneByType_' . $type;
        $data = $cache->get($key);
        if (!$data) {
            $data = EprInfo::findOne(['type' => $type]);
            $cache->set($key, $data, CACHE_TIMEOUT_MEDIUM);
        }
        return $data;
    }
}