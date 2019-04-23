<?php

namespace app\models;
use dektrium\user\models\User;
use app\models\Tools;
use Yii;
use common\models\CuiteCrm;
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
            [['purpose', 'type', 'summ', 'city', 'summ_income', 'name', 'last_name', 'second_name', 'phone', 'email', 'secret_key'], 'string', 'max' => 255],
			[['bithday', 'issuedate', 'registrationdate'], 'date', 'format' => 'php:d.m.Y', 'message'=>'Введите корректную дату'],
			[['bithday', 'issuedate', 'registrationdate'], 'validateDate'], 
			[['email'], 'email', 'message'=>'Введите корректный email'],
			[['phone'], 'validatePhone'],
			[['email'], 'validateEmail'],
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
			
			//подготавливаем для crm
			$arFields = Ipoteka::makeCrmArray( $this );
			//отправляем в crm
			$crmModel = new CuiteCrm;
			$crmModel -> LongRequest( $arFields );

			return true;
		}
		return false;
	}
	
	public function makeCrmArray( $model ) {
	
		return Array(
			'action' => 'Ipoteka',
			'name' => $model->name,
			'surname' => $model->last_name,
			'family_name' => $model->second_name,
			'phone' => CuiteCrm::FormatePhone( $model->phone ),
			'email' => $model->email,
			'house_price' => $model->summ,
			'first_payment' => $model->initial_payment,
			'ipoteka_period' => $model->term,
			'house_city' => $model->city,
			'credit_gain' => $model->purpose,
			'house_type' => $model->type,
			'income' => $model->summ_income,
			'income_docs' => $model->confirmation_income,
			'birthdate' => CuiteCrm::FormateDate($model->bithday),
			'birthplace' => $model->birthplace,
			'passportnum' => $model->sn,
			'passportdate' => CuiteCrm::FormateDate($model->issuedate),
			'passportcode' => $model->issuecode,
			'passport_department' => $model->issuer,
			'register_address' => $model->address,
			'register_date' => CuiteCrm::FormateDate($model->registrationdate),
			'register_phone' => CuiteCrm::FormatePhone( $model->registrationphone ),
			
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
