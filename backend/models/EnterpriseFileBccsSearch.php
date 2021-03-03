<?php

namespace backend\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\models\EnterpriseFile;

/**
 * EnterpriseFileBccsSearch represents the model behind the search form of `backend\models\EnterpriseFile`.
 */
class EnterpriseFileBccsSearch extends EnterpriseFile
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'enterprise_id', 'accent', 'region', 'sound_background', 'requires_recording', 'status', 'updated_by', 'brand_id', 'relate_id'], 'integer'],
            [['intonational'], 'number'],
            [['business_license', 'copyright_license', 'recording_content', 'recording_file', 'msisdn_file', 'created_at', 'updated_at', 'reason', 'name', 'source', 'background_music', 'msisdn_pay'], 'safe'],
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
        $query = EnterpriseFile::find();
        $query->leftJoin('epr_enteprise', '`epr_enteprise`.`id` = `epr_enterprise_file`.`enterprise_id`')
            ->where(['epr_enteprise.type' => 4]);

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
            'enterprise_id' => $this->enterprise_id,
            'accent' => $this->accent,
            'region' => $this->region,
            'intonational' => $this->intonational,
            'sound_background' => $this->sound_background,
            'requires_recording' => $this->requires_recording,
            'status' => $this->status,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
            'updated_by' => $this->updated_by,
            'brand_id' => $this->brand_id,
            'relate_id' => $this->relate_id,
        ]);

        $query->andFilterWhere(['like', 'business_license', $this->business_license])
            ->andFilterWhere(['like', 'copyright_license', $this->copyright_license])
            ->andFilterWhere(['like', 'recording_content', $this->recording_content])
            ->andFilterWhere(['like', 'recording_file', $this->recording_file])
            ->andFilterWhere(['like', 'msisdn_file', $this->msisdn_file])
            ->andFilterWhere(['like', 'reason', $this->reason])
            ->andFilterWhere(['like', 'name', $this->name])
            ->andFilterWhere(['like', 'source', $this->source])
            ->andFilterWhere(['like', 'background_music', $this->background_music])
            ->andFilterWhere(['like', 'msisdn_pay', $this->msisdn_pay]);

        return $dataProvider;
    }
}
