<?php

namespace frontend\models;

use Yii;

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class RegisterForm1 extends \frontend\models\EnterpriseFile {

    /**
     * {@inheritdoc}
     */
    public function rules() {
        return [
            [['name', 'accent', 'region', 'intonational', 'sound_background', 'recording_content'], 'required'],
            [['enterprise_id', 'accent', 'region', 'intonational', 'sound_background', 'requires_recording', 'status', 'updated_by'], 'integer'],
            [['recording_content', 'name'], 'trim'],
            [['recording_content'], 'string'],
            [['reason', 'name'], 'string', 'max' => 255],
            [['name'], 'checkName'],
            [['created_at', 'updated_at'], 'safe'],
            [['business_license', 'copyright_license'], 'file', 'skipOnEmpty' => true, 'extensions' => 'pdf', 'maxSize' => 100 * 1024 * 1024,
                'tooBig' => Yii::t('frontend', 'File "{file}" quá lớn. Kích cỡ tối đa < {formattedLimit}.'),
                'wrongExtension' => Yii::t('frontend', 'File không đúng định dạng ({extensions}).'),
            ],
            [['msisdn_file'], 'file', 'skipOnEmpty' => true, 'extensions' => 'txt', 'maxSize' => 100 * 1024 * 1024,
                'tooBig' => Yii::t('frontend', 'File "{file}" quá lớn. Kích cỡ tối đa < {formattedLimit}.'),
                'wrongExtension' => Yii::t('frontend', 'File không đúng định dạng ({extensions}).'),
            ]
        ];
    }

}
