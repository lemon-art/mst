<?php

namespace app\models;

use Yii;
use app\models\Services;
use app\models\Tools;
use backend\models\Settings;
use backend\models\Mailer;
use dektrium\user\models\User;
use common\models\BitrixCrm;
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
 
	const SCENARIO_UPDATE = 'update';
 
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
	
	
	public function beforeSave($insert){
		if (parent::beforeSave($insert)) {
	 
			$arFields = Array('summ', 'income', 'additional_income', 'rent_apartment');
			foreach ( $arFields as $field ){
				$this->$field = Tools::numUpdate($this->$field);
			}
			$this->service_id = 1;
			return true;
		}
		return false;
	}
	
	public function afterSave($insert, $changedAttributes){
		parent::afterSave($insert, $changedAttributes);
	 
		if ( $this -> scenario !== 'update' ){
			//отправляем в crm
			$arFields = Kredit::makeBitrixCrmArray( $this );
			$crmModel = new BitrixCrm;
			$crmModel -> LongRequest( $arFields );
		}
	}

	
	
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
			[['email'], 'email', 'message'=>'Введите корректный email'],
			[['name', 'last_name', 'second_name', 'purpose', 'phone', 'organizationname', 'jobtitle', 'jobtype', 'workaddress', 'workphone', 'areaofemployment', 'email', 'summ', 'term', 'city', 'employment', 'work_month', 'work_year', 'income', 'bithday', 'birthplace', 'sn', 'issuedate', 'issuecode', 'issuer', 'address', 'registrationdate', 'registrationphone' ], 'required', 'message'=>'Заполните поле', 'on' => 'new'],
			[['phone_dop', 'phone_dop_own', 'education', 'family', 'child', 'credit_history'], 'required', 'message'=>'Заполните поле', 'on' => 'new'],
			[['agree'], 'required', 'message'=>'Необходимо согласие', 'on' => 'new'],
			[['additional_income', 'rent_apartment', 'snils', 'secret_key'], 'string', 'max' => 255],
            [['name', 'phone', 'last_name', 'second_name', 'city', 'employment', 'summ', 'income', 'have_auto'], 'string', 'max' => 255],
			[['bithday', 'issuedate', 'registrationdate'], 'date', 'format' => 'php:d.m.Y', 'message'=>'Введите корректную дату', 'on' => 'new'],
			[['bithday', 'issuedate', 'registrationdate'], 'validateDate', 'on' => 'new'], 
			[['email'], 'validateEmail', 'on' => 'new'],
            [['phone'], 'validatePhone', 'on' => 'new'],
		];
    }
	
	public function scenarios()
	{
		$scenarios = parent::scenarios();
		$scenarios[self::SCENARIO_UPDATE] = ['name', 'last_name', 'second_name', 'purpose', 'phone', 'organizationname', 'jobtitle', 'jobtype', 'workaddress', 'workphone', 'areaofemployment', 'email', 'summ', 'term', 'city', 'employment', 'work_month', 'work_year', 'income', 'bithday', 'birthplace', 'sn', 'issuedate', 'issuecode', 'issuer', 'address', 'registrationdate', 'registrationphone', 'phone_dop', 'phone_dop_own', 'education', 'family', 'child', 'credit_history', 'additional_income', 'rent_apartment', 'snils'];
		return $scenarios;
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
	
	
	
	
	
	public function makeBitrixCrmArray( $model ) {
	
		return Array(
			'TITLE' => 'Заявка на кредит',
			'CATEGORY_ID' => 1,
			'NAME' => $model->name,
			'SECOND_NAME' => $model->second_name,
			'LAST_NAME' => $model->last_name,
			'PHONE' => BitrixCrm::FormatePhone( $model->phone ),
			'EMAIL' => $model->email,
			'UF_CRM_1561550193' => $model->snils,
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
			'UF_CRM_1559826378' => BitrixCrm::GetListValue($model->purpose),
			'UF_CRM_1559890195' => BitrixCrm::GetListValue($model->employment),
			'UF_CRM_1559890345' => $model->work_month, 
			'UF_CRM_1559890404' => $model->work_year,
			'UF_CRM_1559890441' => $model->income,
			'UF_CRM_1559891085' => BitrixCrm::GetListValue($model->have_auto),
			'UF_CRM_1559891395' => $model->organizationname, 
			'UF_CRM_1559891798' => BitrixCrm::GetListValue($model->areaofemployment),
			'UF_CRM_1559891861' => $model->jobtitle,
			'UF_CRM_1559892030' => BitrixCrm::GetListValue($model->jobtype),
			'UF_CRM_1559892212' => $model->workaddress,
			'UF_CRM_1559892256' => $model->workphone,
			'UF_CRM_1559894928' => $model->phone_dop,
			'UF_CRM_1559895409' => BitrixCrm::GetListValue($model->phone_dop_own),
            'UF_CRM_1559895502' => BitrixCrm::GetListValue($model->education),
			'UF_CRM_1559895742' => BitrixCrm::GetListValue($model->family),
			'UF_CRM_1559895825' => BitrixCrm::GetListValue($model->child),
			'UF_CRM_1559895958' => $model->additional_income,
			'UF_CRM_1559896020' => $model->rent_apartment,
			'UF_CRM_1559896183' => BitrixCrm::GetListValue($model->credit_history),
		);
		
	
		
	}
	
	public function getArrayFromBitrixCrm() {
	
		return Array(
			'UF_CRM_1559828608' => Array('field' => 'birthplace', 'type' => 'string'),
			'UF_CRM_1559828656' => Array('field' => 'sn', 'type' => 'string'), 
			'UF_CRM_1559828675' => Array('field' => 'issuedate', 'type' => 'string'), 
			'UF_CRM_1559828690' => Array('field' => 'issuecode', 'type' => 'string'), 
			'UF_CRM_1559828703' => Array('field' => 'issuer', 'type' => 'string'), 
			'UF_CRM_1559829011' => Array('field' => 'address', 'type' => 'string'), 
			'UF_CRM_1559829029' => Array('field' => 'registrationdate', 'type' => 'string'), 
			'UF_CRM_1559829056' => Array('field' => 'registrationphone', 'type' => 'string'), 
			'UF_CRM_1559723329' => Array('field' => 'summ', 'type' => 'string'), 
			'UF_CRM_1559723367' => Array('field' => 'term', 'type' => 'string'), 
			'UF_CRM_1559723379' => Array('field' => 'city', 'type' => 'string'), 
			'UF_CRM_1559826378' => Array('field' => 'purpose', 'type' => 'list'), 
			'UF_CRM_1559890195' => Array('field' => 'employment', 'type' => 'list'), 
			'UF_CRM_1559890345' => Array('field' => 'work_month', 'type' => 'string'), 
			'UF_CRM_1559890404' => Array('field' => 'work_year', 'type' => 'string'), 
			'UF_CRM_1559890441' => Array('field' => 'income', 'type' => 'string'), 
			'UF_CRM_1559891085' => Array('field' => 'have_auto', 'type' => 'list'), 
			'UF_CRM_1559891395' => Array('field' => 'organizationname', 'type' => 'string'), 
			'UF_CRM_1559891798' => Array('field' => 'areaofemployment', 'type' => 'list'), 
			'UF_CRM_1559891861' => Array('field' => 'jobtitle', 'type' => 'string'), 
			'UF_CRM_1559892030' => Array('field' => 'jobtype', 'type' => 'list'),
			'UF_CRM_1559892212' => Array('field' => 'workaddress', 'type' => 'string'), 
			'UF_CRM_1559892256' => Array('field' => 'workphone', 'type' => 'string'), 
			'UF_CRM_1559894928' => Array('field' => 'phone_dop', 'type' => 'string'), 
			'UF_CRM_1559895409' => Array('field' => 'phone_dop_own', 'type' => 'list'), 
			'UF_CRM_1559895502' => Array('field' => 'education', 'type' => 'list'), 
			'UF_CRM_1559895742' => Array('field' => 'family', 'type' => 'list'), 
			'UF_CRM_1559895825' => Array('field' => 'child', 'type' => 'list'),
			'UF_CRM_1559895958' => Array('field' => 'additional_income', 'type' => 'string'),
			'UF_CRM_1559896020' => Array('field' => 'rent_apartment', 'type' => 'string'),
			'UF_CRM_1561550193' => Array('field' => 'snils', 'type' => 'string'),
			'UF_CRM_1559896183' =>  Array('field' => 'credit_history', 'type' => 'list')
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
