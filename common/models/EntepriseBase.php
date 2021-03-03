<?php

namespace common\models;

use Yii;

class EntepriseBase extends \common\models\db\EntepriseDB {
    const STATUS_DELETED = 0;
    const STATUS_ACTIVE = 1;
}
