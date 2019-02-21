<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "api".
 *
 * @property int $id
 * @property int $service_id
 * @property int $bank_id
 */
class Api extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'api';
    }
	
	public function getBanks()
    {
        return $this->hasOne(Banks::className(),['id'=>'bank_id']);
    }
	
	public function getServices()
    {
        return $this->hasOne(Services::className(),['id'=>'service_id']);
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
