<?php

namespace backend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\models\Orders;


/**
 * OrdersSearch represents the model behind the search form of `\app\models\Orders`.
 */
class OrdersSearch extends Orders
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'summ', 'term', 'work_month', 'work_year', 'income', 'have_auto', 'service_id', 'user_id'], 'integer'],
            [['name', 'last_name', 'second_name', 'phone', 'email', 'city', 'employment', 'provision'], 'safe'],
        ];
    }
	
	public function searchForMain( )
    {
		
		$query =  Orders::find()->with(['services'])->limit(10);
		$query -> addOrderBy('id DESC');
		$dataProvider = new ActiveDataProvider([
            'query' => $query,
			'pagination' => false,
        ]);
		return $dataProvider;
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
        $query = Orders::find();
		$query -> addOrderBy('id DESC');
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
            'summ' => $this->summ,
            'term' => $this->term,
            'work_month' => $this->work_month,
            'work_year' => $this->work_year,
            'income' => $this->income,
            'have_auto' => $this->have_auto,
            'service_id' => $this->service_id,
            'user_id' => $this->user_id,
        ]);

        $query->andFilterWhere(['like', 'name', $this->name])
            ->andFilterWhere(['like', 'last_name', $this->last_name])
            ->andFilterWhere(['like', 'second_name', $this->second_name])
            ->andFilterWhere(['like', 'phone', $this->phone])
            ->andFilterWhere(['like', 'email', $this->email])
            ->andFilterWhere(['like', 'city', $this->city])
            ->andFilterWhere(['like', 'employment', $this->employment]);
            //->andFilterWhere(['like', 'provision', $this->provision]);

        return $dataProvider;
    }
}
