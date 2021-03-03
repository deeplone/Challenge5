<?php

namespace api\models;

use Yii;

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class RegisterForm1 extends \api\models\EnterpriseFile {

    /**
     * {@inheritdoc}
     */
    public function rules() {
        return [
            [['name', 'accent', 'region', 'intonational', 'recording_content'], 'required'],
            [['enterprise_id', 'accent', 'region', 'intonational', 'sound_background', 'requires_recording', 'status', 'updated_by', 'brand_id'], 'integer'],
            [['region', 'intonational', 'accent'], 'in', 'range' => [1, 2], 'message' => 'Tham số không hợp lệ'],
            [['sound_background'], 'in', 'range' => [0, 1], 'message' => 'Tham số không hợp lệ'],
            [['recording_content', 'name'], 'trim'],
            [['recording_content'], 'string', 'min' => 650, 'max' => 1200],
            [['reason', 'name'], 'string', 'max' => 100],
            [['brand_id'], 'integer', 'max' => 1000, 'min' => 0],
            [['name'], 'checkName'],
            [['created_at', 'updated_at', 'business_license'], 'safe'],
            [['msisdn_file'], 'file', 'skipOnEmpty' => true, 'extensions' => 'txt', 'maxSize' => 100 * 1024 * 1024,
                'tooBig' => Yii::t('frontend', 'File "{file}" quá lớn. Kích cỡ tối đa < {formattedLimit}.'),
                'wrongExtension' => Yii::t('frontend', 'File không đúng định dạng ({extensions}).'),
            ]
        ];
    }

}
