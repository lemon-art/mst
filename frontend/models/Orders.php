<?php

namespace app\models;

use Yii;
use app\models\Services;
use backend\models\Settings;
use backend\models\Mailer;
//use dektrium\user\models\User;
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
 * @property int $agree
 */
class Orders extends \yii\db\ActiveRecord
{
 
	public $term_display;
	public $summ_display;
	
	
	public $birthdate;
	public $birthplace;
	public $sn;
	public $issuedate;
	public $issuecode;
	public $issuer;
	public $address;
	public $registrationdate;
	public $registrationphone;
 
    public static function tableName()
    {
        return 'orders';
    }
	
	
	public function getServices()
    {
        return $this->hasOne(Services::className(),['id'=>'service_id']);
    }
	
	protected function getMailer()
    {
        return \Yii::$container->get(Mailer::className());
    }
	
	public function afterFind() {
		$this->date = Yii::$app->formatter->asDate($this->date, 'php:d.m.Y H:i');
		$this->term_display = $this->term . ' ' . $this ->true_wordform( $this->term, 'месяц', 'месяца', 'месяцев');
		$this->summ_display = number_format($this->summ, 0, '', ' ') . ' ' . $this ->true_wordform( $this->summ, 'рубль', 'рубля', 'рублей');
	}
	
	public function afterSave($insert, $changedAttributes){
		parent::afterSave($insert, $changedAttributes);
		
		
		
	}
	

	
	
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
			[['email'], 'email', 'message'=>'Введите корректный email'],
			[['email'], 'unique', 'message'=>'Пользователь с таким email уже существует. Авторизуйтесь, пожалуйста.'],
            [['name', 'last_name', 'second_name', 'purpose', 'phone', 'organizationname', 'jobtitle', 'jobtype', 'workaddress', 'workphone', 'areaofemployment', 'email', 'summ', 'term', 'city', 'employment', 'work_month', 'work_year', 'income', 'birthdate', 'birthplace', 'sn', 'issuedate', 'issuecode', 'issuer', 'address', 'registrationdate', 'registrationphone' ], 'required', 'message'=>'Заполните поле'],
			[['phone_dop', 'phone_dop_own', 'education', 'family', 'child', 'credit_history'], 'required', 'message'=>'Заполните поле'],
			[['agree'], 'required', 'message'=>'Необходимо согласие'],
			[['additional_income', 'rent_apartment', 'snils'], 'string', 'max' => 255],
            [['name', 'phone', 'last_name', 'second_name', 'city', 'employment', 'summ', 'income'], 'string', 'max' => 255],
			[['birthdate', 'issuedate', 'registrationdate'], 'date', 'format' => 'php:d.m.Y', 'message'=>'Введите корректную дату'],
			[['birthdate', 'issuedate', 'registrationdate'], 'validateDate'], 
		];
    }
	
	
	public function validateDate($attribute, $params) {
	
		
		$date1 = \DateTime::createFromFormat('d.m.Y', $this->$attribute);
		$date2 = \DateTime::createFromFormat('Y-m-d', date('Y-m-d'));
		if ($date2<=$date1) {
			$this->addError($attribute, 'Введите реальную дату');
		}
		elseif( $attribute == 'birthdate' ){
		
			$interval = $date1->diff($date2);
			$age = $interval->format('%y');
			if ( $age < 18 ){
				$this->addError($attribute, 'Вам должно быть больше 18 лет!');
			}
		}
		
		
		
    }
	
	public function validateBirthDate($attribute, $params) {
		if(strtotime($this->end_date) <= strtotime($this->start_date)){ 
			$this->addError('start_date','Please give correct Start and End dates'); 
			$this->addError('end_date','Please give correct Start and End dates'); 
		} 
    }
	
	private function true_wordform($num, $form_for_1, $form_for_2, $form_for_5){
	
		$num = abs($num) % 100; // берем число по модулю и сбрасываем сотни (делим на 100, а остаток присваиваем переменной $num)
		$num_x = $num % 10; // сбрасываем десятки и записываем в новую переменную
		if ($num > 10 && $num < 20) // если число принадлежит отрезку [11;19]
			return $form_for_5;
		if ($num_x > 1 && $num_x < 5) // иначе если число оканчивается на 2,3,4
			return $form_for_2;
		if ($num_x == 1) // иначе если оканчивается на 1
			return $form_for_1;
		return $form_for_5;
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
            'summ' => 'Сумма кредита',
            'term' => 'На какой срок (месяцев)',
            'city' => 'Город получения',
			'purpose' => 'Цель кредита',
            'employment' => 'Тип занятости',
            'work_month' => 'Начало работы на последнем месте',
            'work_year' => 'Work Year',
            'income' => 'Ежемесячный доход',
            'provision' => 'Обеспечение кредита',
            'have_auto' => 'Автомобиль',
            'agree' => 'Я даю свое согласие на обработку персональных данных',

			'birthdate' => 'Дата рождения',
			'birthplace' => 'Место рождения',
			'sn' => 'Номер паспорта',
			'issuedate' => 'Дата выдачи',
			'issuecode' => 'Код подразделения',
			'issuer' => 'Кем выдан',
			'address' => 'Адрес регистрации (до дома)',
			'registrationdate' => 'Дата регистрации',
			'registrationphone' => 'Телефон по месту регистрации',
			
			'organizationname' => 'Название организации',
			'areaofemployment' => 'Сфера деятельности*',
			'jobtitle' => 'Название должности',
			'jobtype' => 'Тип должности',
			'workaddress' => 'Рабочий адрес',
			'workphone' => 'Рабочий телефон',
			
			'phone_dop' => 'Дополнительный телефон',
			'phone_dop_own' => 'Владелец телефона',
			'education' => 'Образование',
			'family' => 'Семейное положение',
			'child' => 'Дети до 18 лет',
			'additional_income' => 'Дополнительный доход, мес.',
			'rent_apartment' => 'Аренда квартиры в месяц',
			'credit_history' => 'Кредитная история',
			'snils' => 'СНИЛС',
			
			
        ];
    }
}
