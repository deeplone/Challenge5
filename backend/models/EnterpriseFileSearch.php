<?php

namespace backend\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\models\EnterpriseFile;

/**
 * EnterpriseFileSearch represents the model behind the search form of `backend\models\EnterpriseFile`.
 */
class EnterpriseFileSearch extends EnterpriseFile {

    public $msisdn;
    public $rbt;

    /**
     * {@inheritdoc}
     */
    public function rules() {
        return [
            [['id', 'enterprise_id', 'accent', 'region', 'intonational', 'sound_background', 'requires_recording', 'status'], 'integer'],
            [['name', 'msisdn', 'rbt'], 'string'],
            [['name', 'msisdn', 'rbt'], 'trim'],
            [['business_license', 'copyright_license', 'recording_content', 'recording_file'], 'safe'],
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
        $query = EnterpriseFile::find();

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
            'id' => $this->id,
            'enterprise_id' => $this->enterprise_id,
            'accent' => $this->accent,
            'status' => $this->status,
            'region' => $this->region,
            'intonational' => $this->intonational,
            'sound_background' => $this->sound_background,
            'requires_recording' => $this->requires_recording,
        ]);

        $query->andFilterWhere(['like', 'business_license', $this->business_license])
                ->andFilterWhere(['like', 'copyright_license', $this->copyright_license])
                ->andFilterWhere(['like', 'recording_content', $this->recording_content])
                ->andFilterWhere(['like', 'name', $this->name])
                ->andFilterWhere(['like', 'recording_file', $this->recording_file]);

        return $dataProvider;
    }

    public function searchCp($params) {
        $query = EnterpriseFile::find()
                        ->from(EnterpriseFile::tableName() . ' a')
                        ->joinWith(['enterprise' => function ($q) {
                                $q->from(Enteprise::tableName() . ' b');
                            }])->joinWith(['rbt' => function ($q) {
                $q->from(EnterpriseRbt::tableName() . ' c');
            }]);

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
            'a.status' => $this->status,
        ]);

        $query->andFilterWhere(['like', 'a.name', $this->name])
                ->andFilterWhere(['like', 'b.msisdn', $this->msisdn])
                ->andFilterWhere(['like', 'c.tone_code', $this->rbt]);

        $query->andFilterWhere([
            'a.source' => \Yii::$app->user->identity->client_id,
        ]);

        return $dataProvider;
    }

}
