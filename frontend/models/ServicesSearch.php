<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Services;

/**
 * ServicesSearch represents the model behind the search form of `\app\models\Services`.
 */
class ServicesSearch extends Services
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'sort'], 'integer'],
            [['name', 'title_main', 'text_main', 'code'], 'safe'],
        ];
    }
	
	public function searchSearch( $q )
    {
		
		$query =  Services::find();
		$query -> addOrderBy('sort DESC');
		$query->andFilterWhere(['or',
            ['like','name', $q],
            ['like','title_main', $q],
			['like','text_main', $q]]
		);

		$dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);
		return $dataProvider;
	}
	
	public function kredit( )
    {
		
		$query =  Services::findOne(['id' => 1]);
		$dataProvider = new ActiveDataProvider([
            'query' => $query,
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
    public function search()
    {
        $query = Services::find()->limit(6);
		$query -> addOrderBy('sort ASC');
        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
			'pagination' => false,
        ]);

        //$this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'id' => $this->id,
            'sort' => $this->sort,
        ]);

        $query->andFilterWhere(['like', 'name', $this->name])
            ->andFilterWhere(['like', 'title_main', $this->title_main])
            ->andFilterWhere(['like', 'text_main', $this->text_main])
            ->andFilterWhere(['like', 'code', $this->code]);

        return $dataProvider;
    }
}
