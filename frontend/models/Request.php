<?php

namespace app\models;
use common\models\CuiteCrm;

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
			
			$post = Yii::$app->request->post();
			if ( $post['Request']['name'] && $post['Request']['phone'] ){
				$crmModel = new CuiteCrm;
				$crmModel -> name = $post['Request']['name'];
				$crmModel -> phone = $post['Request']['phone'];
				$crmModel -> ShortRequest();
			}

			return true;
		}
		return false;
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
