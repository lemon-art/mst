<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\OffersCredit;

/**
 * OffersCreditSearch represents the model behind the search form of `app\models\OffersCredit`.
 */
class OffersCreditSearch extends OffersCredit
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'activ', 'special', 'main_page', 'bank_id', 'rate', 'image', 'sort', 'min_summ', 'max_summ', 'min_term', 'max_term', 'min_age', 'max_age'], 'integer'],
            [['name', 'link', 'preview_text'], 'safe'],
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
        $query = OffersCredit::find()->joinWith(['banks']);
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
        $query = OffersCredit::find();

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
            'min_summ' => $this->min_summ,
            'max_summ' => $this->max_summ,
            'min_term' => $this->min_term,
            'max_term' => $this->max_term,
            'min_age' => $this->min_age,
            'max_age' => $this->max_age,
        ]);

        $query->andFilterWhere(['like', 'name', $this->name])
            ->andFilterWhere(['like', 'link', $this->link])
            ->andFilterWhere(['like', 'preview_text', $this->preview_text]);

        return $dataProvider;
    }
}
