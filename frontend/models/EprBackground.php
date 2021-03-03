<?php

namespace frontend\models;

class EprBackground extends \common\models\EprBackgroundBase
{
    public static function getAll($limit)
    {
        $cache = \Yii::$app->cache;
        $key = 'EprBackground_getAll_' . $limit;
        $data = $cache->get($key);
        if (!$data) {
            $data = EprBackground::find()->orderBy('name')->limit(5)->all();
            $cache->set($key, $data, CACHE_TIMEOUT_MEDIUM);
        }
        return $data;
    }
}