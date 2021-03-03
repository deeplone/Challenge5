<?php

namespace frontend\models;

use Yii;

class EnterpriseFile extends \common\models\EnterpriseFileBase
{

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['enterprise_id', 'name'], 'required'],
            [['enterprise_id', 'region', 'accent', 'sound_background', 'requires_recording', 'status', 'updated_by'], 'integer'],
            [['intonational'], 'double'],
            [['recording_content', 'msisdn_pay'], 'string'],
            [['msisdn_pay'], 'match', 'pattern' => Yii::$app->params['viettel_phone_expression'],
                'message' => Yii::t('backend', 'Số điện thoại không đúng định dạng')],
            [['recording_content'], 'string', 'length' => [550, 1200],
                'tooShort' => 'Nội dung ít nhất phải chứa 550 ký tự!', 'tooLong' => 'Nội dung dài nhất chỉ chứa 1200 ký tự!'],
            ['name', 'match', 'pattern' => '/^[ a-zA-Z0-9 ]+(?:\s[ a-zA-Z0-9 ]+)*$/', 'message' => 'Tên bài hát là tiếng Việt không dấu và không bao gồm ký tự đặc biệt'],
            [['created_at', 'updated_at'], 'safe'],
            [['business_license', 'copyright_license', 'recording_file', 'msisdn_file', 'reason', 'name'], 'string', 'max' => 255],
        ];
    }

    public function getRbtByUser($limit = 20, $page = 1)
    {
        if ($_GET['page']) {
            $page = intval($_GET['page']);
        }
        $query = EnterpriseFile::find();
        $dataProvider = new \yii\data\ActiveDataProvider([
            'query' => $query,
            'sort' => ['defaultOrder' => ['updated_at' => SORT_DESC]],
            'pagination' => [
                'pageSize' => $limit,
            ],
        ]);
        $query->andWhere(['enterprise_id' => Yii::$app->user->getId()]);
        if ($this->name) {
            $query->andFilterWhere(['like', 'name', $this->name]);
        }

        $data = ['list' => $dataProvider->getModels(), 'total' => $dataProvider->getTotalCount()];

        return $data;
    }

    public static function getUpdateById($id)
    {
        return EnterpriseFile::findOne(['id' => $id, 'status' => RBT_STATUS_NEW]);
    }

    public static function getUpdateOwnerById($id)
    {
        $userId = Yii::$app->user->getId();
        return EnterpriseFile::findOne(['id' => $id, 'status' => [RBT_STATUS_NEW, RBT_STATUS_WAITING,RBT_STATUS_REJECTED], 'enterprise_id' => $userId]);
    }

    public static function getApprovedOwnerById($id)
    {
        $userId = Yii::$app->user->getId();
        return EnterpriseFile::findOne(['id' => $id, 'status' => RBT_STATUS_APPROVED, 'enterprise_id' => $userId]);
    }

    /**
     * @param $id
     * @param int $type (1: online, 2: request, 3: upload)
     * @return EnterpriseFile|null
     */
    public static function getPaymentOwnerById($id, $type = 1)
    {
        $userId = Yii::$app->user->getId();
        $item = null;
        switch ($type) {
            case 1:
                $item = EnterpriseFile::find()
                    ->where(['id' => $id, 'status' => RBT_STATUS_NEW, 'enterprise_id' => $userId,
                        'requires_recording' => 0])
                    ->andWhere(['>', 'accent', '0'])
                    ->one();
                break;
            case 2:
                $item = EnterpriseFile::findOne(['id' => $id, 'status' => RBT_STATUS_NEW, 'enterprise_id' => $userId,
                    'requires_recording' => 1]);
                break;
            case 3:
                $item = EnterpriseFile::findOne(['id' => $id, 'status' => RBT_STATUS_NEW, 'enterprise_id' => $userId,
                    'requires_recording' => 0, 'accent' => null]);
                break;
        }
        return $item;
    }

    public static function getOwnerById($id)
    {
        $userId = Yii::$app->user->getId();
        return EnterpriseFile::findOne(['id' => $id, 'enterprise_id' => $userId]);
    }

    public static function getPaymentById($id, $msisdn)
    {
        return EnterpriseFile::findOne(['id' => $id, 'msisdn_pay' => $msisdn, 'status' => RBT_STATUS_NEW]);
    }

    public static function getFileById($id)
    {
        return EnterpriseFile::findOne(['id' => $id]);
    }
}
