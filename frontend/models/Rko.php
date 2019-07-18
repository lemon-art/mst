<?php

namespace app\models;
use dektrium\user\models\User;
use common\models\DataValidate;
use Yii;
use common\models\BitrixCrm;
/**
 * This is the model class for table "rko".
 *
 * @property int $id
 * @property string $date
 * @property string $name
 * @property string $last_name
 * @property string $second_name
 * @property string $phone
 * @property string $email
 * @property string $form
 * @property int $inn
 * @property string $city
 * @property int $service_id
 * @property int $user_id
 * @property int $status
 * @property int $agree
 * @property string $purpose
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
	 
	const SCENARIO_UPDATE = 'update'; 
	 
    public static function tableName()
    {
        return 'rko';
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
	
	public function scenarios()
	{
		$scenarios = parent::scenarios();
		$scenarios[self::SCENARIO_UPDATE] = ['name', 'last_name', 'second_name', 'phone', 'email', 'form', 'city', 'inn', 'snils', 'bithday', 'address', 'company_name', 'sn', 'sex', 'issuedate'];
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
	
	public function beforeSave($insert){
		if (parent::beforeSave($insert)) {
	 
			$this->service_id = 7;
			return true;
		}
		return false;
	}
	
	public function afterSave($insert, $changedAttributes){
		parent::afterSave($insert, $changedAttributes);
	 
		if ( $this -> scenario !== 'update' ){
			//отправляем в crm
			$arFields = Rko::makeBitrixCrmArray( $this );
			$crmModel = new BitrixCrm;
			$crmModel -> LongRequest( $arFields );
		}
	}
	
		
	
	public function makeBitrixCrmArray( $model ) {
	
		return Array(
			'TITLE' => 'Заявка на РКО',
			'CATEGORY_ID' => 7,
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
			
			
			'UF_CRM_1559723379' => $model->city,
			'UF_CRM_1559922932' => BitrixCrm::GetListValue($model->form),
			'UF_CRM_1559923098' => $model->inn,
			'UF_CRM_1559923054' => $model->company_name,
			'UF_CRM_1559896228' => $model->snils,
			'UF_CRM_1561550005' => BitrixCrm::GetListValue($model->sex)
		);
	}
	
	public function getArrayFromBitrixCrm() {
	
		return Array(
			'UF_CRM_1559723379' => Array('field' => 'city', 'type' => 'string'), 
			'UF_CRM_1559922932' => Array('field' => 'form', 'type' => 'list'), 
			'UF_CRM_1559923098' => Array('field' => 'inn', 'type' => 'string'), 		
			'UF_CRM_1559923054' => Array('field' => 'company_name', 'type' => 'string'),
			'UF_CRM_1559896228' => Array('field' => 'snils', 'type' => 'string'), 
			'UF_CRM_1561550005' => Array('field' => 'sex', 'type' => 'list'), 

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
