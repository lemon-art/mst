<?php

namespace app\models;
//use common\models\CuiteCrm;
use common\models\BitrixCrm;
use Yii;

/**
 * This is the model class for table "request".
 *
 * @property int $id
 * @property string $name
 * @property string $phone
 * @property int $type
 * @property int $product_id
 */
class Request extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'request';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name', 'phone'], 'required', 'message'=>'Заполните поле'],
            [['product_id'], 'integer'],
            [['type', 'name', 'phone'], 'string', 'max' => 255],
        ];
    }
	
	public function beforeSave($insert){
		if (parent::beforeSave($insert)) {
			
			return true;
		}
		return false;
	}
	
	public function afterSave($insert, $changedAttributes){
		parent::afterSave($insert, $changedAttributes);
	 
		
			//отправляем в crm
			$crmModel = new BitrixCrm;
			$crmModel -> name = $this -> name;
			$crmModel -> phone = $this -> phone;
			$crmModel -> ShortRequest();
		
	}
	
	

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Ваше имя',
            'phone' => 'Ваш телефон',
            'type' => 'Type',
            'product_id' => 'Product ID',
        ];
    }
}
