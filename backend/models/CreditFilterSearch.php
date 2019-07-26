<?php

namespace backend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\models\City;

/**
 * CitySearch represents the model behind the search form of `app\models\CreditFilter`.
 */
class CreditFilterSearch extends CreditFilter
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id'], 'integer'],
            [['code', 'url_name', 'category', 'title', 'description', 'name', 'top_text', 'seo_text', 'bank_id', 'term', 'summ', 'rate'], 'safe'],
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
        $query = CreditFilter::find();

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
        ]);

        $query->andFilterWhere(['like', 'code', $this->code])
            ->andFilterWhere(['like', 'url_name', $this->url_name])
            ->andFilterWhere(['like', 'category', $this->category])
            ->andFilterWhere(['like', 'title', $this->title])
            ->andFilterWhere(['like', 'description', $this->description])
            ->andFilterWhere(['like', 'name', $this->name])
            ->andFilterWhere(['like', 'top_text', $this->top_text])
            ->andFilterWhere(['like', 'seo_text', $this->seo_text])
            ->andFilterWhere(['like', 'bank_id', $this->bank_id])
            ->andFilterWhere(['like', 'term', $this->term])
            ->andFilterWhere(['like', 'summ', $this->summ])
            ->andFilterWhere(['like', 'min_age', $this->min_age])
            ->andFilterWhere(['like', 'max_age', $this->max_age])
            ->andFilterWhere(['like', 'rate', $this->rate]);
        return $dataProvider;
    }
}
