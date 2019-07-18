<?php

namespace app\models;
use dektrium\user\models\User;
use Yii;
use common\models\BitrixCrm;
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
class Debet extends \yii\db\ActiveRecord
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
	const SCENARIO_NEW = 'new';
	
    public static function tableName()
    {
        return 'debet';
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
            [['name', 'last_name', 'purpose', 'second_name', 'phone', 'email', 'summ', 'term', 'city'], 'required', 'message'=>'Заполните поле', 'on' => 'new'],
            [['id',  'term', 'service_id', 'user_id', 'status'], 'integer'],
            [['date'], 'safe', 'on' => 'new'],
			[['agree'], 'required', 'message'=>'Необходимо согласие', 'on' => 'new'],
            [['name', 'last_name', 'second_name', 'purpose', 'city','summ', 'secret_key'], 'string', 'max' => 255, 'on' => 'new'],
			[['bithday', 'issuedate', 'registrationdate'], 'validateDate', 'on' => 'new'], 
			[['phone'], 'validatePhone', 'on' => 'new'],
			[['email'], 'validateEmail', 'on' => 'new'],
        ];
    }
	
	public function scenarios()
	{
     $scenarios = parent::scenarios();
     $scenarios[self::SCENARIO_UPDATE] = ['summ' , 'term', 'purpose', 'city', 'user_id'];
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
		
		$this->term_display = $this->term . ' ' . Tools::true_wordform( $this->term, 'месяц', 'месяца', 'месяцев');
		$this->summ_display = number_format($this->summ, 0, '', ' ') . ' ' . Tools::true_wordform( $this->summ, 'рубль', 'рубля', 'рублей');
	}
	
	
	public function beforeSave($insert){
		if (parent::beforeSave($insert)) {
	 
			$arFields = Array('summ');
			foreach ( $arFields as $field ){
				$this->$field = Tools::numUpdate($this->$field);
			}
			
			$this->service_id = 3;
			return true;
		}
		return false;
	}
	
	public function afterSave($insert, $changedAttributes){
		parent::afterSave($insert, $changedAttributes);
	 
		if ( $this -> scenario !== 'update' ){
			$arFields = Debet::makeBitrixCrmArray( $this );
			//отправляем в crm
			$crmModel = new BitrixCrm;
			$crmModel -> LongRequest( $arFields );
		}
	}
	
	
	
	public function makeBitrixCrmArray( $model ) {
	
		return Array(
			'TITLE' => 'Заявка на депозит',
			'CATEGORY_ID' => 4,
			'NAME' => $model->name,
			'SECOND_NAME' => $model->second_name,
			'LAST_NAME' => $model->last_name,
			'PHONE' => BitrixCrm::FormatePhone( $model->phone ),
			'EMAIL' => $model->email,
			'UF_CRM_1559807131' => $model->id,
			'UF_CRM_1559918514' => $model->summ,
			'UF_CRM_1559723367' => $model->term, 
			'UF_CRM_1559723379' => $model->city, 
			'UF_CRM_1559918738' => BitrixCrm::GetListValue($model->purpose),
			
			
		);
	}
	
	public function getArrayFromBitrixCrm() {
	
		return Array(
			'UF_CRM_1559918514' => Array('field' => 'summ', 'type' => 'string'),
			'UF_CRM_1559723367' => Array('field' => 'term', 'type' => 'string'), 
			'UF_CRM_1559918738' =>  Array('field' => 'purpose', 'type' => 'list'),
			'UF_CRM_1559723379' => Array('field' => 'city', 'type' => 'string'), 
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
            'summ' => 'Введите сумму вклада',
            'term' => 'На какой срок (месяцев)',
            'city' => 'Город получения',
            'service_id' => 'Service ID',
            'user_id' => 'User ID',
            'status' => 'Status',
			'purpose' => 'Цель вклада',
            'agree' => 'Я даю свое согласие на обработку персональных данных',
        ];
    }
}
