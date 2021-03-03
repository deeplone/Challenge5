<?php

namespace frontend\models;

use Yii;

class EprVoices extends \common\models\EprVoicesBase
{
    public static function getAll()
    {
        $cache = \Yii::$app->cache;
        $key = 'EprVoices_getAll';
        $data = $cache->get($key);
        if (!$data) {
            $data = EprVoices::find()->orderBy('priority')->all();
            $cache->set($key, $data, CACHE_TIMEOUT_MEDIUM);
        }
        return $data;
    }

    public function getCodeById($id)
    {
        $query = EprVoices::findOne(['id' => $id]);
        return $query->code;
    }
}