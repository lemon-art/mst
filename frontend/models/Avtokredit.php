<?php

namespace app\models;
use app\models\Tools;
use dektrium\user\models\User;
use Yii;
use common\models\BitrixCrm;
/**
 * This is the model class for table "avtokredit".
 *
 * @property int $id
 * @property string $summ
 * @property int $income
 * @property int $confirmation_income
 * @property int $service_id
 * @property int $user_id
 * @property string $first_payment
 * @property string $term
 * @property string $condition
 * @property string $type
 * @property int $kasko
 * @property int $treid_in
 */
class Avtokredit extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
	 
	public $term_display;
	public $summ_display; 
	public $secret_key; 
	public $name;
	public $last_name;
	public $second_name;
	public $phone;
	public $email;
    public $agree;

	const SCENARIO_UPDATE = 'update';
	 
    public static function tableName()
    {
        return 'avtokredit';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['summ', 'income', 'confirmation_income', 'first_payment', 'term', 'condition', 'type'], 'required', 'message'=>'Заполните поле', 'on' => 'new'],
            [['summ', 'first_payment', 'term', 'condition', 'type', 'secret_key'], 'string', 'max' => 255, 'on' => 'new'],
			[['kasko', 'treid_in'], 'integer', 'on' => 'new'],
			[['email'], 'email', 'message'=>'Введите корректный email', 'on' => 'new'],
			[['email'], 'validateEmail', 'on' => 'new'],
			[['agree'], 'required', 'message'=>'Необходимо согласие', 'on' => 'new'],
			[['phone'], 'validatePhone', 'on' => 'new'],
			[['name', 'last_name', 'second_name', 'phone', 'email'], 'required', 'message'=>'Заполните поле', 'on' => 'new'],
        ];
    }
	
	public function scenarios()
	{
		$scenarios = parent::scenarios();
		$scenarios[self::SCENARIO_UPDATE] = ['summ', 'income', 'confirmation_income', 'first_payment', 'term', 'condition', 'type', 'kasko', 'treid_in'];
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
	
	public function afterFind() {
	

		$this->summ = Tools::numUpdate($this->summ);
		
		$this->term_display = $this->term . ' ' . Tools::true_wordform( $this->term, 'месяц', 'месяца', 'месяцев');
		$this->summ_display = number_format($this->summ, 0, '', ' ') . ' ' . Tools::true_wordform( $this->summ, 'рубль', 'рубля', 'рублей');
	}
	
	public function beforeSave($insert){
		if (parent::beforeSave($insert)) {
	 
			$arFields = Array('summ', 'income', 'first_payment');
			foreach ( $arFields as $field ){
				$this->$field = Tools::numUpdate($this->$field);
			}
			$this->service_id = 4;
			return true;
		}
		return false;
	}
	
	
	public function afterSave($insert, $changedAttributes){
		parent::afterSave($insert, $changedAttributes);
	 
		if ( $this -> scenario !== 'update' ){
			//отправляем в crm
			$arFields = Avtokredit::makeBitrixCrmArray( $this );
			$crmModel = new BitrixCrm;
			$crmModel -> LongRequest( $arFields );
		}
	}
	
	
	
	public function makeBitrixCrmArray( $model ) {
	
		return Array(
			'TITLE' => 'Заявка на автокредит',
			'CATEGORY_ID' => 6,
			'NAME' => $model->name,
			'SECOND_NAME' => $model->second_name,
			'LAST_NAME' => $model->last_name,
			'PHONE' => BitrixCrm::FormatePhone( $model->phone ),
			'EMAIL' => $model->email,
			'OPPORTUNITY' 		=> $model->summ,
			'UF_CRM_1559922051' => $model->summ,
			'UF_CRM_1559914035' => $model->first_payment,
			'UF_CRM_1559723367' => $model->term,
			'UF_CRM_1559890441' => $model->income,
			'UF_CRM_1559914502' => BitrixCrm::GetListValue($model->confirmation_income),
			'UF_CRM_1559922279' => $model->treid_in,
			'UF_CRM_1559922304' => BitrixCrm::GetListValue($model->type),
			'UF_CRM_1559922560' => BitrixCrm::GetListValue($model->condition),
			'UF_CRM_1559922623' => $model->kasko

		);
	}
	
	public function getArrayFromBitrixCrm() {
	
		return Array(
			'UF_CRM_1559922051' => Array('field' => 'summ', 'type' => 'string'), 
			'UF_CRM_1559914035' => Array('field' => 'first_payment', 'type' => 'string'), 
			'UF_CRM_1559723367' => Array('field' => 'term', 'type' => 'string'), 
			'UF_CRM_1559890441' => Array('field' => 'income', 'type' => 'string'), 		
			'UF_CRM_1559914502' => Array('field' => 'confirmation_income', 'type' => 'list'), 
			'UF_CRM_1559922279' => Array('field' => 'treid_in', 'type' => 'string'),
			'UF_CRM_1559922304' => Array('field' => 'type', 'type' => 'list'), 
			'UF_CRM_1559922560' => Array('field' => 'condition', 'type' => 'list'),
			'UF_CRM_1559922623' => Array('field' => 'kasko', 'type' => 'string'),			
		);
	}
	

	public function validateEmail($attribute, $params) {
		
		if ( Yii::$app->user->isGuest && User::getUserByEmail( $this->$attribute ) ){
			$this->addError($attribute, 'Пользователь с таким email уже существует. Авторизуйтесь, пожалуйста.');
		}

	}
	
    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'summ' => 'Стоимость автомобиля',
            'income' => 'Уровень дохода',
            'confirmation_income' => 'Подтверждение дохода',
            'first_payment' => 'Первоначальный взнос',
            'term' => 'Срок кредита',
            'condition' => 'Состояние',
            'type' => 'Тип транспорта',
            'kasko' => 'Без каско',
            'treid_in' => 'Трейд Ин',
			'agree' => 'Я даю свое согласие на обработку персональных данных',
            'service_id' => 'Service ID',
            'user_id' => 'User ID',
			'name' => 'Имя',
            'last_name' => 'Фамилия',
            'second_name' => 'Отчество',
            'phone' => 'Телефон',
            'email' => 'Email',
        ];
    }
}
