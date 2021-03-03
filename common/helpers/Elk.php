<?php

namespace common\helpers;

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 * author: Toanhv9
 */
# cmd: cd /u01/imuzik/apps/enterprise; /u01/imuzik/env/php-7.1.30/bin/php yii report/recommend

class Elk {

    public static $url = 'http://10.240.175.94:9229/';

    public static function query($param, $index, $function = '_search') {
        $url = self::$url . $index . '/' . $function;
        $curl = curl_init();
        curl_setopt_array($curl, array(
            CURLOPT_PROXY => '',
            CURLOPT_URL => $url,
            CURLOPT_RETURNTRANSFER => 1,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 3,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "GET",
            CURLOPT_POSTFIELDS => json_encode($param),
            CURLOPT_HTTPHEADER => array(
                "Content-Type: application/json"
            ),
        ));
        $results = json_decode(curl_exec($curl), true);
        $err = curl_error($curl);
        \Yii::error('elastic . ' . json_encode($err));
        curl_close($curl);

        return $results;
    }

    public static function search($param, $index) {
        $results = self::query($param, $index);
        if (isset($results['hits']['hits'])) {
            return $results['hits']['hits'];
        }

        return null;
    }

    public static function count($param, $index) {
        $results = self::query($param, $index, '_count');
        if (sizeof($results)) {
            return $results['count'];
        }

        return 0;
    }

    public static function getDacRecommend($index = 'dac_recommend') {
        $params = [
            "query" => [
                "match_phrase" => [
                    "date" => date('Ymd', strtotime('-1 day'))
                ]
            ]
        ];
        $return = self::search($params, $index);

        return sizeof($return) ? $return[0]['_source']['total'] : 0;
    }

    public static function getImuzikMapping($index = 'song_recommend') {
        $params = [
            "query" => [
                "match_phrase" => [
                    "create_date" => date('Ymd', strtotime('-1 day'))
                ]
            ]
        ];
        return self::count($params, $index);
    }

    public static function getTtonline($index = 'song_recommend') {
        $params = [
            'query' => [
                'bool' => [
                    'must' => [
                        ['term' => ['create_date' => date('Ymd', strtotime('-1 day'))]],
                        ['term' => ['is_sync' => 1]],
                    ]
                ]
            ]
        ];
        return self::count($params, $index);
    }

}
