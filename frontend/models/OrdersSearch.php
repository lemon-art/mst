<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Orders;
use app\models\Services;
use app\models\Kredit;
use app\models\Ipoteka;
use app\models\Avtokredit;
use app\models\KreditKards;
  
class OrdersSearch extends Orders
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
	
	public function searchUserOrders( )
    {
		
		$user_id = Yii::$app->user->identity->id;
		$query =  Orders::find()->with(['services'])->with(['kredit'])->with(['avtokredit'])->with(['ipoteka'])->with(['kreditKards'])->with(['debetCards'])->with(['debet']);
		$query -> addOrderBy('date DESC');
		$query -> andFilterWhere([
            'user_id' => $user_id
		]);
		$dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);
		return $dataProvider;
	}
	
	
}
