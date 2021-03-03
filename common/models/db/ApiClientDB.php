<?php

namespace common\models\db;

use Yii;

/**
 * This is the model class for table "api_client".
 *
 * @property int $id
 * @property string $client_id
 * @property string $client_secret
 * @property string $permission
 * @property string $description
 * @property string $valid_ips Danh sach IP hoac dai dia chi IP, cach nhau boi dau Phay, Dung cho cac webservice cua CP 
 */
class ApiClientDB extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'api_client';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['description'], 'string'],
            [['client_id', 'client_secret'], 'string', 'max' => 32],
            [['permission'], 'string', 'max' => 2000],
            [['valid_ips'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'client_id' => 'Client ID',
            'client_secret' => 'Client Secret',
            'permission' => 'Permission',
            'description' => 'Description',
            'valid_ips' => 'Valid Ips',
        ];
    }
}
