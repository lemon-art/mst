<?php

namespace app\models;

use Yii;
use app\models\Services;
use app\models\Kredit;
use app\models\Avtokredit;
use app\models\Ipoteka;
use app\models\Debet;
use app\models\KreditKards;
use app\models\DebetCards;
use backend\models\Settings;
use backend\models\Mailer;
use dektrium\user\models\User;
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
        return 'orders';
    }
	
	
	public function getServices()
    {
        return $this->hasOne(Services::className(),['id'=>'service_id']);
    }
	
	public function getKredit()
    {
        return $this->hasOne(Kredit::className(),['id'=>'order_id']);
    }
	
	public function getAvtokredit()
    {
        return $this->hasOne(Avtokredit::className(),['id'=>'order_id']);
    }
	
	public function getIpoteka()
    {
        return $this->hasOne(Ipoteka::className(),['id'=>'order_id']);
    }
	
	public function getDebet()
    {
        return $this->hasOne(Debet::className(),['id'=>'order_id']);
    }
	
	public function getKreditKards()
    {
        return $this->hasOne(KreditKards::className(),['id'=>'order_id']);
    }
	
	public function getDebetCards()
    {
        return $this->hasOne(DebetCards::className(),['id'=>'order_id']);
    }
	
	protected function getMailer()
    {
        return \Yii::$container->get(Mailer::className());
    }
	
	public function afterFind() {
		$this->date = Yii::$app->formatter->asDate($this->date, 'php:d.m.Y H:i');
	}
	
	public function afterSave($insert, $changedAttributes){
		parent::afterSave($insert, $changedAttributes);
		
		
		
	}
	
	public function beforeSave($insert){
		if (parent::beforeSave($insert)) {
	 
			
			return true;
		}
		return false;
	}
	

	
	
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [

           
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
