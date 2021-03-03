<?php

namespace frontend\models;

use Yii;

class EnterpriseRbt extends \common\models\EnterpriseRbtBase {
    public function getRbtByFileId($enterprise_id)
    {
        return EnterpriseRbt::findOne(['enterprise_file_id' => $enterprise_id]);
    }
}