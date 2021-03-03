<?php

namespace backend\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\models\ChargingLog;

/**
 * ChargingLogSearch represents the model behind the search form of `backend\models\ChargingLog`.
 */
class ChargingLogSearch extends ChargingLog {

    public $fromDate;
    public $toDate;

    /**
     * {@inheritdoc}
     */
    public function rules() {
        return [
            [['id', 'enterprise_id'], 'integer'],
            [['msisdn', 'toDate', 'error_code', 'fromDate', 'charged_at'], 'safe'],
            [['msisdn', 'error_code'], 'trim'],
            [['fee'], 'number'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function scenarios() {
        // bypass scenarios() implementation in the parent class
        return Model::scenarios();
    }

    /**
     * Creates data provider instance with search query applied
     *
     * @param array $params
     *
     * @return ActiveDataProvider
     */
    public function search($params) {
        $query = ChargingLog::find();

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'sort' => ['defaultOrder' => ['charged_at' => SORT_DESC]]
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'fee' => $this->fee,
            'enterprise_id' => $this->enterprise_id,
        ]);

        $query->andFilterWhere(['like', 'msisdn', $this->msisdn])
                ->andFilterWhere(['error_code' => $this->error_code]);

        if ($this->charged_at) {
            if (strpos($this->charged_at, ' - ') > 0) {
                $dates = self::splitDate($this->charged_at, 'Y-m-d');
                $query->andFilterWhere(['between', 'charged_at', $dates[0], $dates[1] . ' 23:59:59']);
            } else {
                $query->andFilterWhere(['charged_at' => $this->charged_at]);
            }
        }

        return $dataProvider;
    }

    public static function splitDate($date, $display_format) {
        $dates = explode(' - ', $date);
        $dates[0] = date($display_format, strtotime($dates[0]));
        $dates[1] = date($display_format, strtotime($dates[1]));
        return $dates;
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels() {
        return [
            'id' => 'ID',
            'msisdn' => 'Số điện thoại',
            'fee' => 'Phí',
            'cmd' => 'Lệnh',
            'error_code' => 'Mã lỗi',
            'charged_at' => 'Thời gian',
            'enterprise_file_id' => 'Bài hát',
            'enterprise_id' => 'Doanh nghiệp',
            'content' => 'Content',
            'fromDate' => 'Từ ngày',
            'toDate' => 'Đến ngày',
        ];
    }

}
