<?php

namespace backend\models;

use Yii;

class EprInfo extends \common\models\EprInfoBase {

    /**
     * @inheritdoc
     */
    public function behaviors() {
        return [
            [
                'class' => \yii\behaviors\TimestampBehavior::className(),
                'createdAtAttribute' => 'created_at',
                'updatedAtAttribute' => 'updated_at',
                'value' => new \yii\db\Expression('NOW()')
            ],
            [
                'class' => \yii\behaviors\BlameableBehavior::className(),
                'createdByAttribute' => 'created_by',
                'updatedByAttribute' => 'updated_by',
                'value' => \Yii::$app->user->getId()
            ],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function rules() {
        return [
            [['name', 'type', 'content'], 'required'],
            [['type', 'created_by', 'updated_by'], 'integer'],
            [['content', 'name'], 'trim'],
            [['content'], 'string'],
            [['created_at', 'updated_at'], 'safe'],
            [['name'], 'string', 'max' => 255],
            [['type'], 'unique'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels() {
        return [
            'id' => 'ID',
            'name' => 'Tên',
            'type' => 'Loại',
            'content' => 'Nội dung',
            'created_at' => 'Tạo lúc',
            'created_by' => 'Tạo bởi',
            'updated_at' => 'Cập nhật lúc',
            'updated_by' => 'Cập nhật bởi',
        ];
    }

}
