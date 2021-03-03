<?php

namespace frontend\models;

use Yii;

class EprClass extends \common\models\EprClassBase {
    public static function getAllClass($limit)
    {
        $cache = \Yii::$app->cache;
        $key = 'getAllClass_' . $limit;
        $data = $cache->get($key);
        if (!$data) {
            $data = EprClass::find()
                ->orderBy('id DESC')
                ->limit($limit)
                ->all();
            $cache->set($key, $data, CACHE_TIMEOUT_MEDIUM);
        }
        return $data;
    }

    public static function getClassById($id)
    {
        $data = EprClass::findOne($id);
        return $data;
    }
}