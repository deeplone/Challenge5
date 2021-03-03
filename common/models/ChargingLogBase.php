<?php

namespace common\models;

use Yii;

class ChargingLogBase extends \common\models\db\ChargingLogDB
{
    public static function countSuccessInMonth($erpId)
    {
        return ChargingLogBase::find()
            ->where([
                'cmd' => 'CHARGE',
                'error_code' => 0,
                'enterprise_id' => $erpId,
            ])
            ->andWhere('fee > :fee', ['fee' => 0])
            ->andWhere('charged_at >= :charged_at_min', ['charged_at_min' => date('Y-m-01 00:00:00')])
            ->andWhere('charged_at <= :charged_at_max', ['charged_at_max' => date('Y-m-t 23:59:59')])
            ->count();
    }

    public static function countSuccessInPreviousMonth($erpId)
    {
        $cache = \Yii::$app->cache;
        $key = 'ChargingLogBase_countSuccessInPreviousMonth_' . $erpId;
        $data = $cache->get($key);
        if (!$data) {
            $data = ChargingLogBase::find()
                ->where([
                    'cmd' => 'CHARGE',
                    'error_code' => 0,
                    'enterprise_id' => $erpId,
                ])
                ->andWhere('fee > :fee', ['fee' => 0])
                ->andWhere('charged_at >= :charged_at_min', ['charged_at_min' => date('Y-m-01 00:00:00', strtotime('first day of last month'))])
                ->andWhere('charged_at <= :charged_at_max', ['charged_at_max' => date('Y-m-t 23:59:59', strtotime('last day of previous month'))])
                ->count();
            $cache->set($key, $data, CACHE_TIMEOUT_MEDIUM);
        }
        return $data;
    }

    public static function findSuccessPayment($fileId)
    {
        return ChargingLogBase::find()
            ->where([
                'cmd' => 'CHARGE',
                'error_code' => 0,
                'enterprise_file_id' => $fileId,
            ])
            ->andWhere('fee > :fee', ['fee' => 0])
            ->all();
    }

    public static function findLogPayment($enterprise_id)
    {
        return ChargingLogBase::find()
            ->where([
                'cmd' => 'CHARGE',
                'enterprise_id' => $enterprise_id,
            ])
            ->andWhere('fee > :fee', ['fee' => 0])
            ->all();
    }
}