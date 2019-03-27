<?php

namespace app\models;
use backend\models\Mailer;
use common\models\CuiteCrm;
use backend\models\Services;
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
	
	public function getNoactive( )
	{
		$date = date("Y-m-d H:i:s", mktime( date('H'),  date('i') - 15,  date('s'), date('m'), date('d'), date('Y')));
		$model = LostOrders::find()->andFilterWhere(['active' => 1])->with('services')->all();
		foreach ( $model as $order){
			if ( $order -> date < $date ){
				Mailer::sendCallbackMessage( 'Недозаполненная заявка ('.$order -> services -> name.')', $order );
				$crmModel = new CuiteCrm;
				$crmModel -> ShortRequest( $order );
				$order -> active = 1;
				$order -> save();
			}
		}
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
