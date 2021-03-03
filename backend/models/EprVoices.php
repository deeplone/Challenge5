<?php

namespace backend\models;

use Yii;

class EprVoices extends \common\models\EprVoicesBase {

    /**
     * {@inheritdoc}
     */
    public function rules() {
        return [
            [['content'], 'required'],
            [['priority'], 'integer'],
            [['name', 'description', 'code', 'content'], 'trim'],
            [['content'], 'string', 'max' => 1000],
            [['name', 'description', 'code', 'path'], 'string', 'max' => 255],
        ];
    }

}
