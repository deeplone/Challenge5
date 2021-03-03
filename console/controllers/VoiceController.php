<?php

namespace console\controllers;

use yii\console\Controller;

class VoiceController extends Controller {

    public function actionIndex() {
        $voices = \common\libs\Voices::getFormat();
        var_dump($voices);die;
    }

}
