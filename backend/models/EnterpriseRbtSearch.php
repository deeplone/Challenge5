<?php

namespace backend\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\models\EnterpriseRbt;

/**
 * EnterpriseRbtSearch represents the model behind the search form of `backend\models\EnterpriseRbt`.
 */
class EnterpriseRbtSearch extends EnterpriseRbt
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'tone_id', 'enterprise_id', 'created_by'], 'integer'],
            [['tone_code', 'created_at', 'expired_time'], 'safe'],
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
        $query = EnterpriseRbt::find();

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

        // grid filtering conditions
        $query->andFilterWhere([
            'id' => $this->id,
            'tone_id' => $this->tone_id,
            'enterprise_id' => $this->enterprise_id,
            'created_at' => $this->created_at,
            'created_by' => $this->created_by,
            'expired_time' => $this->expired_time,
        ]);

        $query->andFilterWhere(['like', 'tone_code', $this->tone_code]);

        return $dataProvider;
    }
}
