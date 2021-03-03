<?php

namespace frontend\models;

use common\helpers\Helpers;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use frontend\models\UserRbt;

/**
 * UserRbtSearch represents the model behind the search form of `backend\models\UserRbt`.
 */
class UserRbtSearch extends UserRbt {

    /**
     * {@inheritdoc}
     */
    public function rules() {
        return [
            [['enterprise_file_id'], 'integer'],
            [['msisdn', 'tone_code'], 'string'],
            [['msisdn', 'tone_code'], 'trim'],
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
            'query' => $query
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        $query->andFilterWhere([
            'enterprise_file_id' => $this->enterprise_file_id,
        ]);

        $query->andFilterWhere(['like', 'tone_code', $this->tone_code])
                ->andFilterWhere(['like', 'msisdn', ltrim(ltrim(ltrim($this->msisdn, '+'), '0'), '84')]);
        $query->orderBy("updated_at DESC, id asc");

        return $dataProvider;
    }

}
