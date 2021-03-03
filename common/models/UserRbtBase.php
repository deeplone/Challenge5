<?php

namespace common\models;

use Yii;

/**
 * @property EnterpriseFileBase $profile
 */
class UserRbtBase extends \common\models\db\UserRbtDB {

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProfile() {
        return $this->hasOne(EnterpriseFileBase::className(), ['id' => 'enterprise_file_id']);
    }

}
