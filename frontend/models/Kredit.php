<?php

namespace app\models;

use Yii;
use app\models\Services;
use app\models\Tools;
use backend\models\Settings;
use backend\models\Mailer;
use dektrium\user\models\User;
use common\models\CuiteCrm;
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
	public $secret_key;
 
    public static function tableName()
    {
        return 'kredit';
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
		

		$this->summ = Tools::numUpdate($this->summ);
		
		$this->term_display = $this->term . ' ' . Tools::true_wordform( $this->term, 'месяц', 'месяца', 'месяцев');
		$this->summ_display = number_format($this->summ, 0, '', ' ') . ' ' . Tools::true_wordform( $this->summ, 'рубль', 'рубля', 'рублей');
	}
	
	public function afterSave($insert, $changedAttributes){
		parent::afterSave($insert, $changedAttributes);
		
		
		
	}
	
	public function beforeSave($insert){
		if (parent::beforeSave($insert)) {
	 
			$arFields = Array('summ', 'income', 'additional_income', 'rent_apartment');
			foreach ( $arFields as $field ){
				$this->$field = Tools::numUpdate($this->$field);
			}
			
			
			//подготавливаем для crm
			$arFields = Kredit::makeCrmArray( $this );
			//отправляем в crm
			$crmModel = new CuiteCrm;
			$crmModel -> LongRequest( $arFields );
			
			
			

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
			[['email'], 'email', 'message'=>'Введите корректный email'],
			[['name', 'last_name', 'second_name', 'purpose', 'phone', 'organizationname', 'jobtitle', 'jobtype', 'workaddress', 'workphone', 'areaofemployment', 'email', 'summ', 'term', 'city', 'employment', 'work_month', 'work_year', 'income', 'bithday', 'birthplace', 'sn', 'issuedate', 'issuecode', 'issuer', 'address', 'registrationdate', 'registrationphone' ], 'required', 'message'=>'Заполните поле'],
			[['phone_dop', 'phone_dop_own', 'education', 'family', 'child', 'credit_history'], 'required', 'message'=>'Заполните поле'],
			[['agree'], 'required', 'message'=>'Необходимо согласие'],
			[['additional_income', 'rent_apartment', 'snils', 'secret_key'], 'string', 'max' => 255],
            [['name', 'phone', 'last_name', 'second_name', 'city', 'employment', 'summ', 'income', 'have_auto'], 'string', 'max' => 255],
			[['bithday', 'issuedate', 'registrationdate'], 'date', 'format' => 'php:d.m.Y', 'message'=>'Введите корректную дату'],
			[['bithday', 'issuedate', 'registrationdate'], 'validateDate'], 
			[['email'], 'validateEmail'],
            [['phone'], 'validatePhone'],
		];
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
	
	public function validateEmail($attribute, $params) {
		
		if ( Yii::$app->user->isGuest && User::getUserByEmail( $this->$attribute ) ){
			$this->addError($attribute, 'Пользователь с таким email уже существует. Авторизуйтесь, пожалуйста.');
		}

	}
	
	
	public function makeCrmArray( $model ) {
	
		return Array(
			'action' => 'Credit',
			'name' => $model->name,
			'surname' => $model->last_name,
			'family_name' => $model->second_name,
			'phone' => CuiteCrm::FormatePhone( $model->phone ),
			'email' => $model->email,
			'credit_cash' => $model->summ,
			'period' => $model->term,
			'city' => $model->city,
			'credit_gain' => CuiteCrm::GetListValue($model->purpose),
			'clientincome' => $model->income,
			'birthdate' => CuiteCrm::FormateDate($model->bithday),
			'birthplace' => $model->birthplace,
			'passportnum' => $model->sn,
			'passportdate' => CuiteCrm::FormateDate($model->issuedate),
			'passportcode' => $model->issuecode,
			'passport_department' => $model->issuer,
			'register_address' => $model->address,
			'register_date' => CuiteCrm::FormateDate($model->registrationdate),
			'register_phone' => CuiteCrm::FormatePhone( $model->registrationphone ),
			'job_type' => CuiteCrm::GetListValue($model->employment),
			'job_org' => $model->organizationname,
			'job_area' => $model->areaofemployment,
			'job_start_year' => $model->work_year,
			'job_start_month' => $model->work_month,
			'job_position' => $model->jobtitle,
			'job_position_type' => CuiteCrm::GetListValue($model->jobtype),
			'job_address' => $model->workaddress,
			'job_phone' => CuiteCrm::FormatePhone( $model->workphone ),
			'ext_phone' => CuiteCrm::FormatePhone( $model->phone_dop ),
			'ext_phone_owner' => CuiteCrm::GetListValue($model->phone_dop_own ),
			'education' => CuiteCrm::GetListValue($model->education ),
			'family' => $model->family,
			'children' => $model->child,
			'ext_income' => $model->additional_income,
			'has_auto' => $model->have_auto,
			'house_lising' => $model->rent_apartment,
			'credit_history' => $model->credit_history,
			'snils' => $model->snils
		);
		
	
		
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
