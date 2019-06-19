<?php

namespace backend\models;

use Yii;
use backend\models\Tools;
use backend\models\Settings;
use backend\models\Mailer;
use dektrium\user\models\User;
use dektrium\user\models\Profile;
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
class Kredit extends \yii\db\ActiveRecord
{
 
	public $term_display;
	public $summ_display;
	
	
	public $bithday;
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
        return 'kredit';
    }
	
	
	
	public function afterFind() {
		$this->date = Yii::$app->formatter->asDate($this->date, 'php:d.m.Y H:i');
		

		$this->summ = Tools::numUpdate($this->summ);
		
		$this->term_display = $this->term . ' ' . Tools::true_wordform( $this->term, 'месяц', 'месяца', 'месяцев');
		$this->summ_display = number_format($this->summ, 0, '', ' ') . ' ' . Tools::true_wordform( $this->summ, 'рубль', 'рубля', 'рублей');
	}
	

	
	
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
			[['email'], 'email', 'message'=>'Введите корректный email'],
			[['name', 'last_name', 'second_name', 'purpose', 'phone', 'organizationname', 'jobtitle', 'jobtype', 'workaddress', 'workphone', 'areaofemployment', 'email', 'summ', 'term', 'city', 'employment', 'work_month', 'work_year', 'income', 'bithday', 'birthplace', 'sn', 'issuedate', 'issuecode', 'issuer', 'address', 'registrationdate', 'registrationphone' ], 'required', 'message'=>'Заполните поле'],
			[['phone_dop', 'phone_dop_own', 'education', 'family', 'child', 'credit_history'], 'required', 'message'=>'Заполните поле'],
			[['agree'], 'required', 'message'=>'Необходимо согласие'],
			[['additional_income', 'rent_apartment', 'snils'], 'string', 'max' => 255],
            [['name', 'phone', 'last_name', 'second_name', 'city', 'employment', 'summ', 'income'], 'string', 'max' => 255],
			[['bithday', 'issuedate', 'registrationdate'], 'date', 'format' => 'php:d.m.Y', 'message'=>'Введите корректную дату'],
			[['bithday', 'issuedate', 'registrationdate'], 'validateDate'], 
			[['email'], 'validateEmail'],
           
		];
    }
	
	public function getProfile()
    {
        return $this->hasOne(Profile::className(),['user_id'=>'user_id']);
    }
	
	public function GetShowFields() {
		return ['summ_display', 'term_display', 'purpose', 'city', 'income', 'organizationname', 'jobtitle', 'jobtype', 'workaddress', 'workphone', 'areaofemployment', 'employment', 'work_month', 'work_year', 'profile.last_name', 'profile.name', 'profile.second_name', 'profile.phone', 'profile.email', 'profile.bithday', 'profile.birthPlace', 'profile.sn', 'profile.issueDate', 'profile.issueCode', 'profile.issuer', 'profile.address', 'profile.registrationDate', 'profile.registrationPhone'];
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
            'summ_display' => 'Сумма кредита',
            'term_display' => 'На какой срок (месяцев)',
            'city' => 'Город получения',
			'purpose' => 'Цель кредита',
            'employment' => 'Тип занятости',
            'work_month' => 'Начало работы на последнем месте',
            'work_year' => 'Work Year',
            'income' => 'Ежемесячный доход',
            'provision' => 'Обеспечение кредита',
            'have_auto' => 'Автомобиль',
            'agree' => 'Я даю свое согласие на обработку персональных данных',

			'bithday' => 'Дата рождения',
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
