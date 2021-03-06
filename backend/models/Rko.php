<?php

namespace backend\models;
use backend\models\Tools;
use dektrium\user\models\User;
use dektrium\user\models\Profile;
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
class Rko extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
	 
	public $bithday;
	public $birthplace;
	public $sn;
	public $issuedate;
	public $issuecode;
	public $issuer;
	public $address;
	public $registrationdate;
	public $registrationphone; 
	public $secret_key;
	public $summ_display; 
	public $term_display; 
		
    public static function tableName()
    {
        return 'rko';
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
	
			[['email'], 'email', 'message'=>'Введите корректный email'],
            [['name', 'last_name', 'second_name', 'phone', 'email', 'form', 'city', 'inn', 'snils', 'bithday', 'address', 'company_name', 'sn', 'sex', 'issuedate'], 'required', 'message'=>'Заполните поле', 'on' => 'new'],
            [['id',  'service_id', 'user_id', 'status'], 'integer'],
            [['date'], 'safe'],
			[['agree'], 'required', 'message'=>'Необходимо согласие', 'on' => 'new'],
            [['name', 'last_name', 'second_name', 'city', 'company_name', 'secret_key'], 'string', 'max' => 255, 'on' => 'new'],
			[['email'], 'validateEmail', 'on' => 'new'],
			[['inn'], 'validateInn', 'on' => 'new'],
			[['issuedate'], 'date', 'format' => 'php:d.m.Y', 'message'=>'Введите корректную дату', 'on' => 'new'],
			[['bithday'], 'date', 'format' => 'php:d.m.Y', 'message'=>'Введите корректную дату', 'on' => 'new'],
			[['bithday'], 'validateDate', 'on' => 'new'], 
			[['phone'], 'validatePhone', 'on' => 'new'],
			[['snils'], 'validateSnils', 'on' => 'new'],
			
        ];
    }
	

	
	public function validatePhone($attribute, $params){
	
		$del = array("(", ")", " ", "-");
		$emp   = array("", "", "", "");
		 
		$phone = str_replace($del, $emp, $this->$attribute);
		
		
		if (empty( $phone )) {
			$this->addError($attribute, 'Введите корректный номер');
			return false;
		}

		if (!preg_match('/^\+?\d{10,15}$/', $phone)) {
			$this->addError($attribute, 'Введите корректный номер');
			return false;
		}

		if (
			(mb_substr($phone, 0, 2) == '+7' and mb_strlen($phone) != 12) ||
			(mb_substr($phone, 0, 1) == '7'  and mb_strlen($phone) != 11) ||
			(mb_substr($phone, 0, 1) == '8'  and mb_strlen($phone) == 11) ||
			(mb_substr($phone, 0, 1) == '9'  and mb_strlen($phone) == 11)
		) {
			$this->addError($attribute, 'Введите корректный номер');
			return false;
		}
		return true;
	}
	
	public function validateDate($attribute, $params) {
	
		$date0 = \DateTime::createFromFormat('d.m.Y', '01.01.1930');
		$date1 = \DateTime::createFromFormat('d.m.Y', $this->$attribute);
		$date2 = \DateTime::createFromFormat('Y-m-d', date('Y-m-d'));
		if ( $date2<=$date1 || $date0>=$date1 ) {
			$this->addError($attribute, 'Введите реальную дату');
		}
		elseif( $attribute == 'bithday' ){
		
			$interval = $date1->diff($date2);
			$age = $interval->format('%y');
			if ( $age < 18 ){
				$this->addError($attribute, 'Вам должно быть больше 18 лет!');
			}
		}
		
		
		
    }
	
	
	public function validateEmail($attribute, $params) {
		
		
		
		if ( Yii::$app->user->isGuest && User::getUserByEmail( $this->$attribute ) ){
			$this->addError($attribute, 'Пользователь с таким email уже существует. Авторизуйтесь, пожалуйста.');
		}

	}
	
	
	public function validateInn($attribute, $params) {
		
		$resiltValidate = DataValidate::validateInn( $this->$attribute );
		
		if ( !$resiltValidate['result'] ){
			$this->addError($attribute, $resiltValidate['error']);
		}

	}
	
	public function validateSnils($attribute, $params) {
		
		$resiltValidate = DataValidate::validateSnils( $this->$attribute );
		
		if ( !$resiltValidate['result'] ){
			$this->addError($attribute, $resiltValidate['error']);
		}

	}
	
	public function afterFind() {
		
	}
	
	
	public function getProfile()
    {
        return $this->hasOne(Profile::className(),['user_id'=>'user_id']);
    }
	
	public function GetShowFields() {
		return ['form', 'city', 'inn', 'profile.snils', 'company_name', 'profile.last_name', 'profile.name', 'profile.second_name', 'profile.phone', 'profile.email', 'profile.bithday', 'profile.sn', 'profile.issueDate', 'profile.issueCode', 'profile.issuer', 'profile.address', 'profile.registrationDate', 'profile.sex'];
	}

    /**
     * {@inheritdoc}
     */
   public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'date' => 'Date',
            'name' => 'Имя',
            'last_name' => 'Фамилия',
            'second_name' => 'Отчество',
            'phone' => 'Телефон',
            'email' => 'Email',
            'form' => 'Организационно правовая форма',
            'inn' => 'ИНН организации',
			'snils' => 'СНИЛС',
            'city' => 'Населенный пункт',
            'service_id' => 'Service ID',
            'user_id' => 'User ID',
            'status' => 'Status',
			'bithday' => 'Дата рождения',
			'birthplace' => 'Место рождения',
			'company_name' => 'Наименование компании',
			'sn' => 'Номер паспорта',
			'sex' => 'Пол',
			'issuedate' => 'Дата выдачи паспорта',
			'issuecode' => 'Код подразделения',
			'issuer' => 'Кем выдан',
			'address' => 'Адрес регистрации (до дома)',
			'registrationdate' => 'Дата регистрации',
			'registrationphone' => 'Телефон по месту регистрации',
            'agree' => 'Я даю свое согласие на обработку персональных данных'
        ];
    }
}
