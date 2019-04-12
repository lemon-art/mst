<?php

namespace app\models;
use app\models\Tools;
use dektrium\user\models\User;
use Yii;
use common\models\CuiteCrm;
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
            [['summ', 'income', 'confirmation_income', 'first_payment', 'term', 'condition', 'type'], 'required', 'message'=>'Заполните поле'],
            [['summ', 'first_payment', 'term', 'condition', 'type'], 'string', 'max' => 255],
			[['kasko', 'treid_in'], 'integer'],
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
			
			//подготавливаем для crm
			$arFields = Avtokredit::makeCrmArray( $this );
			//отправляем в crm
			$crmModel = new CuiteCrm;
			$crmModel -> LongRequest( $arFields );

			return true;
		}
		return false;
	}
	
	public function makeCrmArray( $model ) {
	
		return Array(
			'action' => 'Autocredit',
			'name' => $model->name,
			'surname' => $model->last_name,
			'family_name' => $model->second_name,
			'phone' => CuiteCrm::FormatePhone( $model->phone ),
			'email' => $model->email,
			'car_price' => $model->summ,
			'first_payment' => $model->first_payment,
			'autocredit_period' => $model->term,
			'income' => $model->income,
			'income_docs' => $model->confirmation_income,
			'trade_in' => $model->treid_in,
			'vehicle_type' => $model->type,
			'vehicle_status' => $model->condition,
			'without_casco' => $model->kasko
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
