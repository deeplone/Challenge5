<?php

namespace common\models;

use Yii;

class EprInfoBase extends \common\models\db\EprInfoDB {

    public function getUser($id) {
        $user = UserBase::findOne(intval($id));
        if ($user) {
            return $user->username;
        }
        return '';
    }

}
