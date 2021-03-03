<?php

namespace common\models;

use Yii;

class EprBackgroundBase extends \common\models\db\EprBackgroundDB {

    public function audio() {
        return '<audio controls><source src="' . $this->getFile() . '"></audio>';
    }

    public function getFile() {
        return '/uploads' . $this->path;
    }

}
