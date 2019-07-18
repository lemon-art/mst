<?php

namespace app\models;
use dektrium\user\models\User;
use app\models\Tools;
use Yii;
use common\models\BitrixCrm;
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
	public $issuedate;
	public $issuecode;
	public $issuer;
	public $address;
	public $registrationdate;
	public $registrationphone; 
	public $secret_key; 
	
	const SCENARIO_UPDATE = 'update';
	 
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
            [['purpose', 'type', 'summ', 'term', 'confirmation_income', 'city', 'initial_payment', 'summ_income'], 'required', 'message'=>'Заполните поле', 'on' => 'new'],
            [['agree'], 'required', 'message'=>'Необходимо согласие', 'on' => 'new'],
			[['name', 'last_name', 'second_name', 'phone', 'email'], 'required', 'message'=>'Заполните поле', 'on' => 'new'],
			[['bithday', 'birthplace', 'sn', 'issuedate', 'issuecode', 'issuer', 'address', 'registrationdate', 'registrationphone'], 'required', 'message'=>'Заполните поле', 'on' => 'new'],
            [['purpose', 'type', 'summ', 'city', 'summ_income', 'name', 'last_name', 'second_name', 'phone', 'email', 'secret_key'], 'string', 'max' => 255],
			[['bithday', 'issuedate', 'registrationdate'], 'date', 'format' => 'php:d.m.Y', 'message'=>'Введите корректную дату', 'on' => 'new'],
			[['bithday', 'issuedate', 'registrationdate'], 'validateDate', 'on' => 'new'], 
			[['email'], 'email', 'message'=>'Введите корректный email', 'on' => 'new'],
			[['phone'], 'validatePhone', 'on' => 'new'],
			[['email'], 'validateEmail', 'on' => 'new'],
		];
    }
	
	public function scenarios()
	{
		$scenarios = parent::scenarios();
		$scenarios[self::SCENARIO_UPDATE] = ['purpose', 'type', 'summ', 'term', 'confirmation_income', 'city', 'initial_payment', 'summ_income', 'name', 'last_name', 'second_name', 'phone', 'email'];
		return $scenarios;
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
	
	public function afterFind() {
		
		$this->term_display = $this->term . ' ' . Tools::true_wordform( $this->term, 'год', 'года', 'лет');
		$this->summ_display = number_format($this->summ, 0, '', ' ') . ' ' . Tools::true_wordform( $this->summ, 'рубль', 'рубля', 'рублей');
	}
	
	
	public function beforeSave($insert){
		if (parent::beforeSave($insert)) {
	 
			$arFields = Array('summ', 'summ_income', 'initial_payment');
			foreach ( $arFields as $field ){
				$this->$field = Tools::numUpdate($this->$field);
			}
			$this->service_id = 2;
			return true;
		}
		return false;
	}
	
	public function afterSave($insert, $changedAttributes){
		parent::afterSave($insert, $changedAttributes);
	 
		if ( $this -> scenario !== 'update' ){
			//отправляем в crm
			$arFields = Ipoteka::makeBitrixCrmArray( $this );
			$crmModel = new BitrixCrm;
			$crmModel -> LongRequest( $arFields );
		}
	}
	
		
	public function makeBitrixCrmArray( $model ) {
	
		return Array(
			'TITLE' => 'Заявка на ипотеку',
			'CATEGORY_ID' => 3,
			'NAME' => $model->name,
			'SECOND_NAME' => $model->second_name,
			'LAST_NAME' => $model->last_name,
			'PHONE' => BitrixCrm::FormatePhone( $model->phone ),
			'EMAIL' => $model->email,
			'BIRTHDATE' => $model->bithday,
			'ADDRESS_CITY' => $model->city,
			'UF_CRM_1559828608' => $model->birthplace,
			'UF_CRM_1559828656' => $model->sn,
			'UF_CRM_1563181991' => $model->issuedate,
			'UF_CRM_1559828690' => $model->issuecode,
			'UF_CRM_1559828703' => $model->issuer,
			'UF_CRM_1559829011' => $model->address,
			'UF_CRM_1563182035' => $model->registrationdate,
			'UF_CRM_1559829056' => BitrixCrm::FormatePhone( $model->registrationphone ),
			'UF_CRM_1559807131' => $model->id,
			'UF_CRM_1559723329' => $model->summ,
			'UF_CRM_1559723367' => $model->term, 
			'UF_CRM_1559723379' => $model->city,
			'UF_CRM_1559913759' => BitrixCrm::GetListValue($model->purpose),
			'UF_CRM_1559913904' => BitrixCrm::GetListValue($model->type),
			'UF_CRM_1559914035' => $model->initial_payment, 
			'UF_CRM_1559890441' => $model->summ_income,
			'UF_CRM_1559914502' => BitrixCrm::GetListValue($model->confirmation_income),

		);
	}
	
	public function getArrayFromBitrixCrm() {
	
		return Array(
			'UF_CRM_1559723329' => Array('field' => 'summ', 'type' => 'string'), 
			'UF_CRM_1559723379' => Array('field' => 'city', 'type' => 'string'), 
			'UF_CRM_1559723367' => Array('field' => 'term', 'type' => 'string'), 
			'UF_CRM_1559890441' => Array('field' => 'summ_income', 'type' => 'string'), 		
			'UF_CRM_1559914502' => Array('field' => 'confirmation_income', 'type' => 'list'), 
			'UF_CRM_1559913759' => Array('field' => 'purpose', 'type' => 'list'), 
			'UF_CRM_1559914035' => Array('field' => 'initial_payment', 'type' => 'string'),
			'UF_CRM_1559913904' => Array('field' => 'type', 'type' => 'list'), 

	
		);
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
            'summ' => 'Стоимость недвижимости',
			'initial_payment' => 'Первоначальный взнос',
			'term' => 'Срок кредита',
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
			'issuedate' => 'Дата выдачи',
			'issuecode' => 'Код подразделения',
			'issuer' => 'Кем выдан',
			'address' => 'Адрес регистрации (до дома)',
			'registrationdate' => 'Дата регистрации',
			'registrationphone' => 'Телефон по месту регистрации', 
        ];
    }
}
