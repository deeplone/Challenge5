<?php

namespace backend\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\models\UserRbt;

/**
 * UserRbtSearch represents the model behind the search form of `backend\models\UserRbt`.
 */
class UserRbtSearch extends UserRbt {

    /**
     * {@inheritdoc}
     */
    public function rules() {
        return [
            [['tone_id', 'status', 'enterprise_file_id'], 'integer'],
            [['tone_code', 'msisdn', 'register_at', 'exprired_at', 'created_at', 'updated_at'], 'safe'],
            [['tone_code', 'msisdn'], 'trim'],
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
        $query = UserRbt::find();

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'sort' => ['defaultOrder' => ['updated_at' => SORT_DESC]]
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'tone_id' => $this->tone_id,
            'register_at' => $this->register_at,
            'exprired_at' => $this->exprired_at,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
            'status' => $this->status,
            'enterprise_file_id' => $this->enterprise_file_id,
        ]);

        $query->andFilterWhere(['like', 'tone_code', $this->tone_code])
                ->andFilterWhere(['like', 'msisdn', $this->msisdn]);

        return $dataProvider;
    }

}
