<?php

namespace backend\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\models\EprRbtHot;

/**
 * EprRbtHotSearch represents the model behind the search form of `backend\models\EprRbtHot`.
 */
class EprRbtHotSearch extends EprRbtHot {

    /**
     * {@inheritdoc}
     */
    public function rules() {
        return [
            [['name'], 'safe'],
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
        $query = EprRbtHot::find();

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
        $name = trim($this->name," ");
        $query->andFilterWhere(['like', 'name', $name]);

        return $dataProvider;
    }

}
