<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\OffersIpoteka;

/**
 * OffersIpotekaSearch represents the model behind the search form of `app\models\OffersIpoteka`.
 */
class OffersIpotekaSearch extends OffersIpoteka
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'activ', 'special', 'main_page', 'bank_id', 'rate', 'image', 'sort'], 'integer'],
            [['name', 'link', 'preview_text', 'initial_payment', 'min_summ_ipoteka', 'max_summ_ipoteka'], 'safe'],
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

    public function searchByService()
    {
        $query = OffersIpoteka::find()->joinWith(['banks']);
        $query->andFilterWhere([
            //'service_id' => $service_id,
            'activ' => 1,
            'banks.active' => 1
        ]);
        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'sort' => ['defaultOrder' => ['sort' => SORT_DESC]],
            'pagination' => [
                'pageSize' => 80,
            ],
        ]);
        return $dataProvider;
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
        $query = OffersIpoteka::find();

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
            'activ' => $this->activ,
            'special' => $this->special,
            'main_page' => $this->main_page,
            'bank_id' => $this->bank_id,
            'rate' => $this->rate,
            'image' => $this->image,
            'sort' => $this->sort,
        ]);

        $query->andFilterWhere(['like', 'name', $this->name])
            ->andFilterWhere(['like', 'link', $this->link])
            ->andFilterWhere(['like', 'preview_text', $this->preview_text])
            ->andFilterWhere(['like', 'initial_payment', $this->initial_payment])
            ->andFilterWhere(['like', 'min_summ_ipoteka', $this->min_summ_ipoteka])
            ->andFilterWhere(['like', 'max_summ_ipoteka', $this->max_summ_ipoteka]);

        return $dataProvider;
    }
}
