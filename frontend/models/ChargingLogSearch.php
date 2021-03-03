<?php

namespace frontend\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use frontend\models\ChargingLog;

/**
 * ChargingLogSearch represents the model behind the search form of `frontend\models\ChargingLog`.
 */
class ChargingLogSearch extends ChargingLog
{
    public $from_date;
    public $to_date;

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'enterprise_file_id', 'enterprise_id', 'type'], 'integer'],
            [['msisdn', 'cmd', 'error_code', 'charged_at', 'content'], 'safe'],
            [['fee', 'old_fee', 'discount'], 'number'],
            [['from_date', 'to_date'], 'safe']
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function scenarios()
    {
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
    public function search($params)
    {
        $query = ChargingLog::find();

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        if($this->from_date && $this->to_date) {
            $query->andFilterWhere(['between', 'charged_at', $this->from_date . " 00:00:00", $this->to_date . " 23:59:59"]);
        } elseif ($this->from_date) {
            $query->andFilterWhere(['>=', 'charged_at', $this->from_date . " 00:00:00"]);
        } elseif ($this->to_date) {
            $query->andFilterWhere(['<=', 'charged_at', $this->to_date . " 23:59:59"]);
        } else {
            $this->from_date = date('Y-m-01');
            $this->to_date = date('Y-m-t');
            $query->andFilterWhere(['between', 'charged_at', date('Y-m-01 00:00:00'), date('Y-m-t 23:59:59')]);
        }


        // grid filtering conditions
        $query->andFilterWhere([
            'id' => $this->id,
            'charged_at' => $this->charged_at,
            'enterprise_file_id' => $this->enterprise_file_id,
            'enterprise_id' => $this->enterprise_id,
            'type' => $this->type,
            'old_fee' => $this->old_fee,
            'discount' => $this->discount,
        ]);

        $query->andFilterWhere(['like', 'msisdn', $this->msisdn])
            ->andFilterWhere(['cmd' => 'CHARGE'])
            ->andFilterWhere(['error_code' => 0])
            ->andFilterWhere(['>', 'fee', 0]);
        $query->orderBy('charged_at DESC');
        return $dataProvider;
    }
}
