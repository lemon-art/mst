<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "debet".
 *
 * @property int $id
 * @property string $date
 * @property string $name
 * @property string $last_name
 * @property string $second_name
 * @property string $phone
 * @property string $email
 * @property int $summ
 * @property int $term
 * @property string $city
 * @property int $service_id
 * @property int $user_id
 * @property int $status
 * @property int $agree
 */
class Debet extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'debet';
    }
	
	public function getServices()
    {
        return $this->hasOne(Services::className(),['id'=>'service_id']);
    }
	
	protected function getMailer()
    {
        return \Yii::$container->get(Mailer::className());
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name', 'last_name', 'second_name', 'phone', 'email', 'summ', 'term', 'city'], 'required'],
            [['id',  'term', 'service_id', 'user_id', 'status'], 'integer'],
            [['date',  'agree'], 'safe'],
            [['name', 'last_name', 'second_name', 'purpose', 'city','summ'], 'string', 'max' => 255],
            [['id'], 'unique'],
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
            'last_name' => 'Фамилия',
            'second_name' => 'Отчество',
            'phone' => 'Телефон',
            'email' => 'Email',
            'summ' => 'Введите сумму вклада',
            'term' => 'На какой срок (месяцев)',
            'city' => 'Город получения',
            'service_id' => 'Service ID',
            'user_id' => 'User ID',
            'status' => 'Status',
			'purpose' => 'Цель вклада',
            'agree' => 'Я даю свое согласие на обработку персональных данных',
        ];
    }
}
