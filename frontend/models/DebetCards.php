<?php

namespace app\models;
use dektrium\user\models\User;
use Yii;
use common\models\CuiteCrm;
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
			
			//подготавливаем для crm
			$arFields = DebetCards::makeCrmArray( $this );
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
            [['summ', 'residue', 'type', 'currency', 'system'], 'required', 'message'=>'Заполните поле'],
            [['percent_residue', 'service_id', 'free_card', 'cash_world', 'secure_3d', 'contactless_payment', 'sms', 'overdraft', 'transport', 'bonus', 'miles'], 'integer'],
            [['summ', 'residue', 'type', 'currency', 'system', 'secret_key'], 'string', 'max' => 255],
			[['email'], 'email', 'message'=>'Введите корректный email'],
			[['email'], 'validateEmail'],
			[['agree'], 'required', 'message'=>'Необходимо согласие'],
			[['phone'], 'validatePhone'],
			[['name', 'last_name', 'second_name', 'phone', 'email'], 'required', 'message'=>'Заполните поле'],
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
	
	public function validateEmail($attribute, $params) {
		
		if ( Yii::$app->user->isGuest && User::getUserByEmail( $this->$attribute ) ){
			$this->addError($attribute, 'Пользователь с таким email уже существует. Авторизуйтесь, пожалуйста.');
		}

	}


	public function makeCrmArray( $model ) {
	
		return Array(
			'action' => 'DebetCards',
			'name' => $model->name,
			'surname' => $model->last_name,
			'family_name' => $model->second_name,
			'phone' => CuiteCrm::FormatePhone( $model->phone ),
			'email' => $model->email,
			'purchase' => $model->summ,
			'avg_balance' => $model->residue,
			'currency' => $model->currency,
			'payment_system' => $model->system,
			'card_type' => $model->type,
			'payment_procent' => $model->percent_residue,
			'free_support' => $model->free_card,
			'any_atm' => $model->cash_world,
			'secure_3d' => $model->secure_3d,
			'nfc' => $model-> contactless_payment,
			'free_sms' => $model->sms,
			'overdraft' => $model->overdraft,
			'passage_payment' => $model->transport,
			'miles' => $model->miles,
			'bonuses' => $model->bonus,
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
            'status_type' => 'Статус карты',
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
