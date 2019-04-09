<?php

namespace app\models;
use backend\models\Mailer;
use common\models\CuiteCrm;
use backend\models\Services;
use app\models\Request;
use Yii;

/**
 * This is the model class for table "lost_orders".
 *
 * @property int $id
 * @property string $name
 * @property string $phone
 * @property int $service_id
 * @property string $secret_key
 * @property int $send
 * @property int $active
 */
class LostOrders extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'lost_orders';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name', 'phone', 'service_id', 'secret_key'], 'required'],
            [['service_id', 'send', 'active'], 'integer'],
            [['name', 'phone', 'secret_key'], 'string', 'max' => 255],
        ];
    }
	
	public function getServices()
    {
        return $this->hasOne(Services::className(),['id'=>'service_id']);
    }
	
	public function getModelByKey( $secret_key )
	{
		$model = LostOrders::findOne(['secret_key' => $secret_key]);
		if ( !$model ){
			return false;
		}
		else {
			return $model;
		}
	}
	
	//активируем брошенный заказ по ключу
	public function addLostOrder( $secret_key ){
		
		$model = LostOrders::getModelByKey( $secret_key );
		if ( $model ){
			$reqModel = new Request();
			$reqModel -> name = $model -> name;
			$reqModel -> phone = $model -> phone;
			$reqModel -> product_id = $model -> service_id;
			$reqModel -> save();
			
			$crmModel = new CuiteCrm;
			$crmModel -> name = $model -> name;
			$crmModel -> phone = $model -> phone;
			$crmModel -> ShortRequest();
			
			
			$model -> delete();
			Mailer::sendCallbackMessage( 'Требуется помощь в офомлении заявки', $reqModel );
		}
			
	
	}
	
	//обрабатываем все неактивные заказы, с истекшим сроком
	public function getNoactive( )
	{
		$date = date("Y-m-d H:i:s", mktime( date('H'),  date('i') - 15,  date('s'), date('m'), date('d'), date('Y')));
		$model = LostOrders::find()->andFilterWhere(['active' => 0])->with('services')->all();
		foreach ( $model as $order){
			if ( $order -> date < $date ){
				LostOrders::ActivateLostOrder( $order );
			}
		}
	}
	
	//активируем брошенный заказ, отправляем письмо и в crm
	public function ActivateLostOrder( $model ){
			
		

		$crmModel = new CuiteCrm;
		$crmModel -> name = $model -> name;
		$crmModel -> phone = $model -> phone;
		$crmModel -> ShortRequest();
		
		
		$model -> active = 1;
		$model -> save();
		Mailer::sendCallbackMessage( 'Недозаполненная заявка ('.$model -> services -> name.')', $model );
	}

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Name',
            'phone' => 'Phone',
            'service_id' => 'Service ID',
            'secret_key' => 'Secret Key',
            'send' => 'Send',
            'active' => 'Active',
        ];
    }
}
