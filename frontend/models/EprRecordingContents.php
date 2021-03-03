<?php

namespace frontend\models;

use Yii;

class EprRecordingContents extends \common\models\EprRecordingContentsBase
{
    public static function getRecordingContents($limit)
    {
        $cache = \Yii::$app->cache;
        $key = 'EprRecordingContents_getRecordingContents_' . $limit;
        $data = $cache->get($key);
        if (!$data) {
            $data = EprRecordingContents::find()
                ->select('recording_content')
                ->limit($limit)
                ->orderBy('updated_at DESC')
                ->all();
            $cache->set($key, $data, CACHE_TIMEOUT_MEDIUM);
        }
        return $data;
    }
}