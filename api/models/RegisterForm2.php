<?php

namespace api\models;

use Yii;

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class RegisterForm2 extends \api\models\EnterpriseFile {

    /**
     * {@inheritdoc}
     */
    public function rules() {
        return [
            [['name', 'recording_file'], 'required'],
            [['enterprise_id', 'status', 'updated_by', 'brand_id'], 'integer'],
            [['reason', 'name'], 'string', 'max' => 100],
            [['name'], 'trim'],
            [['name'], 'checkName'],
            [['created_at', 'updated_at'], 'safe'],
            [['brand_id'], 'integer', 'max' => 1000, 'min' => 0],
            [['msisdn_file'], 'file', 'skipOnEmpty' => true, 'extensions' => 'txt', 'maxSize' => 100 * 1024 * 1024,
                'tooBig' => Yii::t('frontend', 'File "{file}" quá lớn. Kích cỡ tối đa < {formattedLimit}.'),
                'wrongExtension' => Yii::t('frontend', 'File không đúng định dạng ({extensions}).'),
            ],
            [['recording_file'], 'file', 'skipOnEmpty' => true, 'extensions' => 'mp3', 'maxSize' => 100 * 1024 * 1024,
                'tooBig' => Yii::t('frontend', 'File "{file}" quá lớn. Kích cỡ tối đa phải < {formattedLimit}.'),
                'wrongExtension' => Yii::t('frontend', 'File không đúng định dạng ({extensions}).'),
            ],
        ];
    }

}
