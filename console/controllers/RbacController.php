<?php

namespace console\controllers;

use common\models\UserBase;
use yii\console\Controller;

class RbacController extends Controller {

    public function actionInit() {
        UserBase::deleteAll(['username' => 'toanhv9']);
        $user = new UserBase();
        $user->username = "toanhv9";
        $user->setPassword('Bong@123');
        $user->generateAuthKey();
        $user->email = "toanhv9@viettel.com.vn";
        $user->status = 1;
        $user->save(false);
    }

}
