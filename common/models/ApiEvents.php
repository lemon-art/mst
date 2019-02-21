<?php
namespace common\models;
use Yii;
use backend\models\Banks;

class ApiEvents extends \yii\db\ActiveRecord
{


    public static function tableName()
    {
        return 'api_events';
    }
	

    public function rules()
    {
        return [
            [['order_id', 'request_id', 'status'], 'required'],
        ];
    }
	
	public function getBanks()
    {
        return $this->hasOne(Banks::className(),['id'=>'bank_id']);
    }


    public function attributeLabels()
    {
        return [
            'order_id' => 'ID заказа',
            'request_id' => 'ID заявки',
            'status' => 'Статус',
        ];
    }
}
