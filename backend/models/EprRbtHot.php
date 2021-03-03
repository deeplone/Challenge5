<?php

namespace backend\models;

use Yii;

class EprRbtHot extends \common\models\EprRbtHotBase {

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
            [['name', 'audio_path', 'img_path'], 'required'],
            [['created_by', 'updated_by'], 'integer'],
            [['created_at', 'updated_at'], 'safe'],
            [['name'], 'string', 'max' => 255],
            [['rbt_code'], 'string', 'max' => 20],
            [['name', 'rbt_code'], 'trim'],
            [['audio_path'], 'file', 'skipOnEmpty' => true, 'extensions' => 'mp3', 'maxSize' => 10 * 1024 * 1024,
                'tooBig' => Yii::t('frontend', 'File "{file}" quá lớn. Kích cỡ tối đa phải < {formattedLimit}.'),
                'wrongExtension' => Yii::t('frontend', 'File không đúng định dạng ({extensions}).'),
            ],
            [['img_path'], 'file', 'skipOnEmpty' => true, 'extensions' => 'png, jpg', 'maxSize' => 10 * 1024 * 1024,
                'tooBig' => Yii::t('frontend', 'File "{file}" quá lớn. Kích cỡ tối đa phải < {formattedLimit}.'),
                'wrongExtension' => Yii::t('frontend', 'File không đúng định dạng ({extensions}).'),
            ],
        ];
    }

    public function upload($field) {
        if ($this->validate()) {
            $dir = Yii::getAlias('@frontend_upload');
            $file = '/rbt-hot/' . \common\helpers\Helpers::generateStructurePath();
            if (!is_dir($dir . $file)) {
                mkdir($dir . $file, 0777, true);
            }
            $fileName = $file . uniqid() . '.' . $this->$field->extension;
            $this->$field->saveAs($dir . $fileName);

            return $fileName;
        }

        return '';
    }

}
