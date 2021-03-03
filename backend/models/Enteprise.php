<?php

namespace backend\models;

use Yii;

class Enteprise extends \common\models\EntepriseBase {

    public static function getAll() {
        $data = Enteprise::find()->orderBy(['full_name' => SORT_ASC])->all();
        $return = ['' => 'Tất cả'];
        foreach ($data as $item) {
            $return[$item->id] = \yii\helpers\Html::encode($item->full_name);
        }
        return $return;
    }

}
