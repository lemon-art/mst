<?php
namespace common\models;
use Yii;
use backend\models\Banks;
use common\models\Absolute;
use common\models\Tochka_bank;
/**
 * This is the model class for table "api".
 *
 * @property int $id
 * @property int $service_id
 * @property int $bank_id
 */
class Api extends \yii\db\ActiveRecord
{

	public $service_id;
	public $arBanks;

	
	function GetServiceBanks ( $service_id ){
	
		
		return Api::find()->where(['service_id' => $service_id])->with('banks')->asArray()->all();
	}
	
	public static function build( $bank_name )
    {
	
		$bank_name = str_replace('-', '_', $bank_name);
		$product = "common\models\\" . ucfirst($bank_name);
        if (class_exists($product)) {
            return new $product;
        } else {
            throw new \Exception("Неверный тип продукта");
        }

    }


    public static function tableName()
    {
        return 'api';
    }
	
	public function getBanks()
    {
        return $this->hasOne(Banks::className(),['id'=>'bank_id']);
    }


    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['service_id', 'bank_id'], 'required'],
            [['service_id', 'bank_id'], 'integer'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'service_id' => 'Услуга',
            'bank_id' => 'Банк',
        ];
    }
}
