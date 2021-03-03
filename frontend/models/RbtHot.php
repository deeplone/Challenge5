<?php

namespace frontend\models;

use Yii;

class RbtHot extends \common\models\EprRbtHotBase
{

    public static function getRbtHot($limit)
    {
        $cache = \Yii::$app->cache;
        $key = 'getRbtHot_' . $limit;
        $data = $cache->get($key);
        if (!$data) {
            $data = RbtHot::find()
                ->orderBy('updated_at DESC')
                ->limit($limit)
                ->all();
            $cache->set($key, $data, CACHE_TIMEOUT_MEDIUM);
        }
        return $data;
    }
}