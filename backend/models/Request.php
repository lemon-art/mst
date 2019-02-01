<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "request".
 *
 * @property int $id
 * @property string $name
 * @property string $phone
 * @property string $type
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
	
	public function afterFind() {
	
		$this->date = date('d.m.Y H:i', strtotime( $this->date ));


	}

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name', 'phone'], 'required'],
            [['product_id'], 'integer'],
            [['name', 'phone', 'type'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Имя',
            'phone' => 'Телефон',
            'type' => 'Тип',
            'product_id' => 'Продукт',
        ];
    }
}
