<?php

namespace backend\models;
use backend\models\Services;
use Yii;

/**
 * This is the model class for table "lost_orders".
 *
 * @property int $id
 * @property string $date
 * @property string $name
 * @property string $phone
 * @property int $service_id
 * @property string $secret_key
 * @property int $send
 * @property int $active
 */
class Lostorders extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'lost_orders';
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
            [['date'], 'safe'],
            [['name', 'phone', 'service_id', 'secret_key'], 'required'],
            [['service_id', 'send', 'active'], 'integer'],
            [['name', 'phone', 'secret_key'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'date' => 'Дата',
            'name' => 'Имя',
            'phone' => 'Телефон',
            'service_id' => 'Service ID',
            'secret_key' => 'Secret Key',
            'send' => 'Send',
            'active' => 'Active',
        ];
    }
}
