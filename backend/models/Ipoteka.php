<?php

namespace backend\models;
use dektrium\user\models\User;
use backend\models\Tools;
use dektrium\user\models\Profile;
use Yii;

/**
 * This is the model class for table "ipoteka".
 *
 * @property int $id
 * @property string $date
 * @property string $purpose
 * @property string $type
 * @property string $summ
 * @property string $type_zalog_house
 * @property string $summ_loan
 * @property string $city
 * @property string $summ_income
 * @property int $mother_capital
 * @property string $name
 * @property string $last_name Фамилия
 * @property string $second_name Отчество
 * @property string $phone Телефон
 * @property string $email
 * @property int $service_id
 * @property int $user_id
 * @property int $status Статус заявки
 * @property int $agree
 */
class Ipoteka extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
	 
	public $term_display;
	public $summ_display;
	
	public $name;
	public $last_name;
	public $second_name;
	public $phone;
	public $email;
	public $agree;
	
	public $bithday;
	public $birthplace;
	public $sn;
	public $issueDate;
	public $issueCode;
	public $issuer;
	public $address;
	public $registrationDate;
	public $registrationPhone; 
	 
	 
    public static function tableName()
    {
        return 'ipoteka';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['purpose', 'type', 'summ', 'term', 'confirmation_income', 'city', 'initial_payment', 'summ_income'], 'required', 'message'=>'Заполните поле'],
            [['agree'], 'required', 'message'=>'Необходимо согласие'],
			[['name', 'last_name', 'second_name', 'phone', 'email'], 'required', 'message'=>'Заполните поле'],
			[['bithday', 'birthplace', 'sn', 'issuedate', 'issuecode', 'issuer', 'address', 'registrationdate', 'registrationphone'], 'required', 'message'=>'Заполните поле'],
            [['purpose', 'type', 'summ', 'city', 'summ_income', 'name', 'last_name', 'second_name', 'phone', 'email'], 'string', 'max' => 255],
			[['bithday', 'issuedate', 'registrationdate'], 'date', 'format' => 'php:d.m.Y', 'message'=>'Введите корректную дату'],
			[['bithday', 'issuedate', 'registrationdate'], 'validateDate'], 
			[['email'], 'email', 'message'=>'Введите корректный email'],
			[['email'], 'validateEmail'],
		];
    }
	
	public function getProfile()
    {
        return $this->hasOne(Profile::className(),['user_id'=>'user_id']);
    }
	
	public function GetShowFields() {
		return ['summ_display', 'term_display', 'initial_payment', 'type', 'purpose', 'city', 'confirmation_income', 'summ_income', 'profile.name', 'profile.last_name', 'profile.second_name', 'profile.phone', 'profile.email', 'profile.bithday', 'profile.birthPlace', 'profile.sn', 'profile.issueDate', 'profile.issueCode', 'profile.issuer', 'profile.address', 'profile.registrationDate', 'profile.registrationPhone'];
	}
	
	
	
	public function afterFind() {
		
		$this->term_display = $this->term . ' ' . Tools::true_wordform( $this->term, 'год', 'года', 'лет');
		$this->summ_display = number_format($this->summ, 0, '', ' ') . ' ' . Tools::true_wordform( $this->summ, 'рубль', 'рубля', 'рублей');

	}
	

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'date' => 'Date',
            'purpose' => 'Цель кредита',
            'type' => 'Тип недвижимости',
            'summ_display' => 'Стоимость недвижимости',
			'initial_payment' => 'Первоначальный взнос',
			'term_display' => 'Срок кредита',
            'type_zalog_house' => 'Type Zalog House',
            'summ_loan' => 'Summ Loan',
            'city' => 'В каком городе покупаете?',
            'summ_income' => 'Ваш доход в месяц после уплаты налогов',
			'confirmation_income' => 'Форма подтверждения дохода',
            'mother_capital' => 'Mother Capital',
            'name' => 'Имя',
            'last_name' => 'Фамилия',
            'second_name' => 'Отчество',
            'phone' => 'Телефон',
            'email' => 'Email',
            'service_id' => 'Service ID',
            'user_id' => 'User ID',
            'status' => 'Status',
            'agree' => 'Agree',
			
			'bithday' => 'Дата рождения',
			'birthplace' => 'Место рождения',
			'sn' => 'Номер паспорта',
			'issueDate' => 'Дата выдачи',
			'issuecode' => 'Код подразделения',
			'issuer' => 'Кем выдан',
			'address' => 'Адрес регистрации (до дома)',
			'registrationdate' => 'Дата регистрации',
			'registrationphone' => 'Телефон по месту регистрации', 
        ];
    }
}
