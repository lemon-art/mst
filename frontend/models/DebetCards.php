<?php

namespace app\models;
use dektrium\user\models\User;
use Yii;

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
            [['percent_residue', 'service_id', 'free_card', 'cash_world', '3d_secure', 'contactless_payment', 'sms', 'overdraft', 'transport', 'bonus', 'miles'], 'integer'],
            [['summ', 'residue', 'type', 'currency', 'system'], 'string', 'max' => 255],
			[['email'], 'email', 'message'=>'Введите корректный email'],
			[['email'], 'validateEmail'],
			[['agree'], 'required', 'message'=>'Необходимо согласие'],
			[['name', 'last_name', 'second_name', 'phone', 'email'], 'required', 'message'=>'Заполните поле'],
        ];
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
            '3d_secure' => '3D Secure ',
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
