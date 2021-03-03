<?php

namespace common\libs;

use common\helpers\Helpers;
use Yii;

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class Voices {

    public $url = 'https://www.vtcc.ai/voice/api/tts/v1/rest/syn';
    public $voice_url = 'https://www.vtcc.ai/voice/api/tts/v1/rest/voices';
    //public $token = '9LUtj7AO5e8382KeiY24KoJovC-Zsd755nV1Net4-TpH50awKaZoDTr7N5ayw05D';
//    public $token = 'plpRQixvVRd9icOgIPeJuEiJDms0sF9akpoAm9TyL5QTF9nku0FLk4FneZp-wWSW';
    public $token = 'hBuLI-AOHCs5ucv4a55cPuOwvmsyQcZbIg64p1vnhr41Iufe0puqma9qTTd1-d9i';

    public function callAPI($url, $method = 'GET', $param = null, $token = null) {
        
        \Yii::info('call api url: ' . $url, 'vtcc.ai');
        \Yii::info('call api method: ' . $method, 'vtcc.ai');
        \Yii::info('call api data: ' . json_encode($param), 'vtcc.ai');
        \Yii::info('call api token: ' . json_encode($token), 'vtcc.ai');
        $options = array(
            CURLOPT_RETURNTRANSFER => true, // return web page
            CURLOPT_HEADER => false, // don't return headers
            CURLOPT_FOLLOWLOCATION => true, // follow redirects
            CURLOPT_ENCODING => "", // handle all encodings
            //CURLOPT_USERAGENT => "spider", // who am i
            CURLOPT_AUTOREFERER => true, // set referer on redirect
            CURLOPT_CONNECTTIMEOUT => 30, // timeout on connect
            CURLOPT_TIMEOUT => 30, // timeout on response
            CURLOPT_MAXREDIRS => 10, // stop after 10 redirects
            CURLOPT_SSL_VERIFYPEER => false, // Disabled SSL Cert checks
            CURLOPT_IPRESOLVE => CURL_IPRESOLVE_V4,
            CURLOPT_CUSTOMREQUEST => $method,
        );
        
//        if (!YII_ENV_PROD) {
//            $options[CURLOPT_PROXY] = 'http://192.168.193.23:3128';
//        }
        if (sizeof($param)) {
            $options[CURLOPT_POSTFIELDS] = json_encode($param);
        }
        if ($token) {
            $options[CURLOPT_HTTPHEADER] = array("Content-Type: application/json", "token: $token");
        } else {
            $options[CURLOPT_HTTPHEADER] = array("Content-Type: application/json");
        }

        $ch = curl_init($url);
        curl_setopt_array($ch, $options);

        $content = curl_exec($ch);

        \Yii::info('content: ' . $content, 'vtcc.ai');
        $err = curl_errno($ch);
        \Yii::error('curl_errno: ' . json_encode($err), 'vtcc.ai');
        $errmsg = curl_error($ch);
        \Yii::error('curl_error: ' . json_encode($errmsg), 'vtcc.ai');
        $headers = curl_getinfo($ch);
        \Yii::info('curl_getinfo: ' . json_encode($headers), 'vtcc.ai');
        curl_close($ch);
        // var_dump($content); die;
        return $headers['http_code'] == 200 ? $content : null;
    }

    public static function getFormat() {
        $results = (new self)->callAPI((new self)->voice_url);

        return json_decode($results, true);
    }

    public static function getVoice($text = 'hệ thống tổng hợp tiếng nói trung tâm không gian mạng', $voice = 'doanngocle', $speed = '1.0') {
        \Yii::info('$text: ' . $text, 'vtcc.ai');
        \Yii::info('$voice: ' . $voice, 'vtcc.ai');
        \Yii::info('$speed: ' . $speed, 'vtcc.ai');

        $token = (new self)->token;
        $param = [
            "text" => trim($text),
            "voice" => $voice,
            "id" => uniqid(),
            "without_filter" => false,
            "speed" => $speed,
            "tts_return_option" => 3
        ];
        $content = (new self)->callAPI((new self)->url, 'POST', $param, $token);
        if ($content) {
            $dir = Yii::getAlias('@frontend_upload');
            $file = '/vtcc/' . Helpers::generateStructurePath();
            if (!is_dir($dir . $file)) {
                mkdir($dir . $file, 0777, true);
            }
            $fileName = $file . uniqid() . '.mp3';
            $myfile = fopen($dir . $fileName, "wb");
            fwrite($myfile, $content);
            fclose($myfile);
            \Yii::info($dir . $fileName, 'vtcc.ai');
            if (is_file($dir . $fileName)) {
                return $fileName;
            }
        }
        return '';
    }

}
