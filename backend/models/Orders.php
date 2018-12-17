<?php

namespace backend\models;

use Yii;
use backend\models\Services;
/**
 * This is the model class for table "orders".
 *
 * @property int $id
 * @property string $name
 * @property string $last_name
 * @property string $second_name
 * @property string $phone
 * @property string $email
 * @property int $summ
 * @property int $term
 * @property string $city
 * @property string $employment
 * @property int $work_month
 * @property int $work_year
 * @property int $income
 * @property string $provision
 * @property int $have_auto
 * @property int $service_id
 * @property int $user_id
 */
class Orders extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
	 
	public $fullName; 
	public $statusName; 
	public $statusCode; 
	public $orderUrl;
	 
    public static function tableName()
    {
        return 'orders';
    }
	
	public function getServices()
    {
        return $this->hasOne(Services::className(),['id'=>'service_id']);
    }
	
	public function afterFind() {
	
		$this->fullName = $this->last_name . ' ' . $this->name . ' ' . $this->second_name;
		$this->orderUrl = "/admin/orders/view?id=" . $this->id;
		
		$this->date = Yii::$app->formatter->asDate($this->date, 'php:d.m.Y H:i');
	
		switch ( $this->status ) {
			case 0:
				$this->statusName = 'Новая';
				$this->statusCode = 'label-warning';
				break;
			case 1:
				$this->statusName = 'На обработке';
				$this->statusCode = 'label-info';
				break;
			case 2:
				$this->statusName = 'Одобрено';
				$this->statusCode = 'label-success';
				break;
			case 3:
				$this->statusName = 'Отказано';
				$this->statusCode = 'label-danger';
				break;	
		}
	
	}

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name', 'last_name', 'second_name', 'phone', 'email', 'summ', 'term', 'city', 'employment', 'work_month', 'work_year', 'income', 'provision'], 'required'],
            [['summ', 'term', 'work_month', 'work_year', 'income', 'have_auto', 'service_id', 'user_id'], 'integer'],
            [['name', 'last_name', 'second_name', 'city', 'employment', 'provision'], 'string', 'max' => 255],
            [['phone'], 'string', 'max' => 20],
            [['email'], 'string', 'max' => 200],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
			'fullName' => 'ФИО клиента',
            'name' => 'Name',
            'last_name' => 'Last Name',
            'second_name' => 'Second Name',
            'phone' => 'Телефон',
            'email' => 'Email',
            'summ' => 'Сумма',
            'term' => 'Срок',
            'city' => 'Город',
            'employment' => 'Занятость',
            'work_month' => 'Месяц начала работы',
            'work_year' => 'Год начала работы',
            'income' => 'Доход',
            'provision' => 'Provision',
            'have_auto' => 'Есть автомобиль',
            'service_id' => 'Услуга',
            'user_id' => 'User ID',
        ];
    }
}
