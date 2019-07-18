<?php

namespace app\models;
use dektrium\user\models\User;
use Yii;
use common\models\BitrixCrm;
/**
 * This is the model class for table "debet_cards".
 *
 * @property int $id
 * @property string $summ
 * @property string $residue
 * @property string $type
 * @property string $currency
 * @property string $system
 * @property string $status_type
 * @property int $percent_residue
 * @property int $service_id
 * @property int $free_card
 * @property int $cash_world
 * @property int $3d_secure
 * @property int $contactless_payment
 * @property int $sms
 * @property int $overdraft
 * @property int $transport
 * @property int $bonus
 * @property int $miles
 * @property int $user_id
 */
class DebetCards extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    
	public $name;
	public $last_name;
	public $second_name;
	public $phone;
	public $email;
    public $agree;
	public $secret_key;
	public $summ_display; 
	
	const SCENARIO_UPDATE = 'update';
	
	public static function tableName()
    {
        return 'debetcards';
    }
	
	public function afterFind() {
		
		
		$this->summ_display = number_format($this->summ, 0, '', ' ') . ' ' . Tools::true_wordform( $this->summ, 'рубль', 'рубля', 'рублей');
	}
	
	public function beforeSave($insert){
		if (parent::beforeSave($insert)) {
	 
			$arFields = Array('summ', 'residue');
			foreach ( $arFields as $field ){
				$this->$field = Tools::numUpdate($this->$field);
			}
			$this->service_id = 6;
			return true;
		}
		return false;
	}
	
	public function afterSave($insert, $changedAttributes){
		parent::afterSave($insert, $changedAttributes);
	 
		if ( $this -> scenario !== 'update' ){
			//отправляем в crm
			$arFields = DebetCards::makeBitrixCrmArray( $this );
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
            [['summ', 'residue', 'type', 'currency', 'system'], 'required', 'message'=>'Заполните поле', 'on' => 'new'],
            [['percent_residue', 'service_id', 'free_card', 'cash_world', 'secure_3d', 'contactless_payment', 'sms', 'overdraft', 'transport', 'bonus', 'miles'], 'integer', 'on' => 'new'],
            [['summ', 'residue', 'type', 'currency', 'system', 'secret_key'], 'string', 'max' => 255],
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
		$scenarios[self::SCENARIO_UPDATE] = ['summ', 'residue', 'type', 'currency', 'system', 'percent_residue', 'service_id', 'free_card', 'cash_world', 'secure_3d', 'contactless_payment', 'sms', 'overdraft', 'transport', 'bonus', 'miles'];
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
	
	public function validateEmail($attribute, $params) {
		
		if ( Yii::$app->user->isGuest && User::getUserByEmail( $this->$attribute ) ){
			$this->addError($attribute, 'Пользователь с таким email уже существует. Авторизуйтесь, пожалуйста.');
		}

	}


	
	public function makeBitrixCrmArray( $model ) {
	
		return Array(
			'TITLE' => 'Заявка на дебетовую карту',
			'CATEGORY_ID' => 5,
			'NAME' => $model->name,
			'SECOND_NAME' => $model->second_name,
			'LAST_NAME' => $model->last_name,
			'PHONE' => BitrixCrm::FormatePhone( $model->phone ),
			'EMAIL' => $model->email,
			'OPPORTUNITY' 		=> $model->summ,
			'UF_CRM_1559807131' => $model->id,
			'UF_CRM_1559920491' => $model->summ,
			'UF_CRM_1559920463' => $model->residue,
			'UF_CRM_1559920523' => BitrixCrm::GetListValue($model->currency),
			'UF_CRM_1559920648' => BitrixCrm::GetListValue($model->system),
			'UF_CRM_1559920831' => BitrixCrm::GetListValue($model->type),
			'UF_CRM_1559920939' => $model->percent_residue,
			'UF_CRM_1559920981' => $model->free_card,
			'UF_CRM_1559921055' => $model->cash_world,
			'UF_CRM_1559921080' => $model->secure_3d,
			'UF_CRM_1559921281' => $model-> contactless_payment,
			'UF_CRM_1559921307' => $model->sms,
			'UF_CRM_1559921327' => $model->overdraft,
			'UF_CRM_1560925142' => $model->transport,
			'UF_CRM_1559921367' => $model->miles,
			'UF_CRM_1559921400' => $model->bonus,
		);
	}
	
	public function getArrayFromBitrixCrm() {
	
		return Array(
			'UF_CRM_1559920491' => Array('field' => 'summ', 'type' => 'string'), 
			'UF_CRM_1559920463' => Array('field' => 'residue', 'type' => 'string'), 
			'UF_CRM_1559920523' => Array('field' => 'currency', 'type' => 'list'), 
			'UF_CRM_1559920648' => Array('field' => 'system', 'type' => 'list'), 		
			'UF_CRM_1559920831' => Array('field' => 'type', 'type' => 'list'), 
 			'UF_CRM_1559920939' => Array('field' => 'percent_residue', 'type' => 'string'),
			'UF_CRM_1559920981' => Array('field' => 'free_card', 'type' => 'string'),
			'UF_CRM_1559921055' => Array('field' => 'percent_residue', 'type' => 'string'),
			'UF_CRM_1559920939' => Array('field' => 'cash_world', 'type' => 'string'),
			'UF_CRM_1559921080' => Array('field' => 'secure_3d', 'type' => 'string'),
			'UF_CRM_1559921281' => Array('field' => 'contactless_payment', 'type' => 'string'),
			'UF_CRM_1559921307' => Array('field' => 'sms', 'type' => 'string'),
			'UF_CRM_1559921327' => Array('field' => 'overdraft', 'type' => 'string'),
			'UF_CRM_1560925142' => Array('field' => 'transport', 'type' => 'string'),
			'UF_CRM_1559921367' => Array('field' => 'miles', 'type' => 'string'),
			'UF_CRM_1559921400' => Array('field' => 'bonus', 'type' => 'string'),
	
		);
	}
	
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'summ' => 'Покупки по карте в месяц',
            'residue' => 'Среднемесячный остаток по счету',
            'type' => 'Тип карты',
            'currency' => 'Валюта',
            'system' => 'Платежная система',
            'percent_residue' => 'Процент на остаток ',
            'service_id' => 'Service ID',
            'free_card' => 'Бесплатное обслуживание ',
            'cash_world' => 'Наличные в любых банкоматах ',
            'secure_3d' => '3D Secure ',
            'contactless_payment' => 'Бесконтактная оплата ',
            'sms' => 'Бесплатное SMS оповещение ',
            'overdraft' => 'Овердрафт ',
            'transport' => 'Для оплаты проезда ',
            'bonus' => 'С бонусами',
            'miles' => 'С милями',
            'user_id' => 'User ID',
			'name' => 'Имя',
            'last_name' => 'Фамилия',
            'second_name' => 'Отчество',
            'phone' => 'Телефон',
            'email' => 'Email',
        ];
    }
}
