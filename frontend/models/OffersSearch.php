<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Offers;
use app\models\Banks;
/**
 * OffersSearch represents the model behind the search form of `\app\models\Offers`.
 */
class OffersSearch extends Offers
{

	public $bankName;

    public function rules()
    {
        return [
            [['id', 'min_summ', 'max_summ', 'min_term', 'max_term', 'rate', 'min_age', 'max_age'], 'integer'],
            [['name',  'bank_id', 'preview_text', 'bankName'], 'safe'],
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
	
	
	public function searchSearch( $q )
    {
		
		$query =  Offers::find()->joinWith(['banks']);
		$query -> addOrderBy('sort DESC');
		$query->andFilterWhere(['or',
            ['like','offers.name', $q],
            ['like','offers.preview_text', $q]]
		);
		$query -> andFilterWhere([
			'banks.active' => 1,
			'active' => 1,
		]);
		$dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);
		return $dataProvider;
	}
	
	public function searchSpecial( )
    {
		
		$query =  Offers::find()->joinWith(['banks']);
		$query -> addOrderBy('sort DESC');
		$query -> andFilterWhere([
            'special' => 1,
			'banks.active' => 1,
			'activ' => 1,
		]);

		$dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);
		return $dataProvider;
	}
	
	public function searchMainSpecial( )
    {
		
		$query =  Offers::find()->limit(2)->joinWith(['banks']);
		$query -> addOrderBy('sort DESC');
		$query -> andFilterWhere([
            'main_page' => 1,
			'activ' => 1,
			'banks.active' => 1
		]);
		

		$dataProvider = new ActiveDataProvider([
            'query' => $query,
			'pagination' => false,
        ]);
		return $dataProvider;
	}
	
	public function searchSpecialByService( $service_id )
    {
		
		$query =  Offers::find()->joinWith(['banks']);
		$query -> addOrderBy('sort DESC');
		$query -> andFilterWhere([
            'special' => 1,
			'activ' => 1,
			'banks.active' => 1
		]);
		$dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);
		return $dataProvider;
	}
	 
	public function searchByService( $service_id )
    {
		
		$query = Offers::find()->joinWith(['banks']);
		$query->andFilterWhere([
            'service_id' => $service_id,
			'activ' => 1,
			'banks.active' => 1
		]);
		$dataProvider = new ActiveDataProvider([
            'query' => $query,
			'pagination' => [
				'pageSize' => 40,
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

		$query = Offers::find()->joinWith(['banks']);

		
        // add conditions that should always apply here
		$query->andFilterWhere([
			'activ' => 1,
			'banks.active' => 1
		]);
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
            'bank_id' => $this->bank_id,
            'min_summ' => $this->min_summ,
            'max_summ' => $this->max_summ,
            'min_term' => $this->min_term,
            'max_term' => $this->max_term,
            'rate' => $this->rate,
            'min_age' => $this->min_age,
            'max_age' => $this->max_age,
        ]);

        $query->andFilterWhere(['like', 'name', $this->name])
            ->andFilterWhere(['like', 'preview_text', $this->preview_text]);

        return $dataProvider;
    }
}
