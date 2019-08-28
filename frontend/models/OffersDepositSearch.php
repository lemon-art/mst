<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\OffersDeposit;

/**
 * OffersDepositSearch represents the model behind the search form of `app\models\OffersDeposit`.
 */
class OffersDepositSearch extends OffersDeposit
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'activ', 'bank_id', 'image', 'special', 'sort', 'main_page'], 'integer'],
            [['name', 'rate', 'preview_text', 'depozit_term', 'depozit_summ', 'link'], 'safe'],
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
        $query = OffersDeposit::find()->joinWith(['banks']);
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
        $query = OffersDeposit::find();

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
            'bank_id' => $this->bank_id,
            'image' => $this->image,
            'special' => $this->special,
            'sort' => $this->sort,
            'main_page' => $this->main_page,
        ]);

        $query->andFilterWhere(['like', 'name', $this->name])
            ->andFilterWhere(['like', 'rate', $this->rate])
            ->andFilterWhere(['like', 'preview_text', $this->preview_text])
            ->andFilterWhere(['like', 'depozit_term', $this->depozit_term])
            ->andFilterWhere(['like', 'depozit_summ', $this->depozit_summ])
            ->andFilterWhere(['like', 'link', $this->link]);

        return $dataProvider;
    }
}
