<?php

namespace console\controllers;

use yii\console\Controller;

class ReportController extends Controller {

    public function actionRecommend() {
        $dacRecommend = \common\helpers\Elk::getDacRecommend();
        $imuzikMapping = \common\helpers\Elk::getImuzikMapping();
        $ttonline = \common\helpers\Elk::getTtonline();

        $content = "DAC Recommend: $dacRecommend. IMZ portal map: $imuzikMapping. IMZ suggest TTOL: $ttonline";
        foreach (\Yii::$app->params['recommend']['isdn'] as $isdn) {
            \common\helpers\SendMT::sendMT($isdn, $content);
        }
    }

}
