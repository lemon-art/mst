<?php

namespace app\models;
use dektrium\user\models\User;
use app\models\Tools;
use Yii;
use common\models\CuiteCrm;
/**
 * This is the model class for table "kredit_kards".
 *
 * @property int $id
 * @property string $summ
 * @property string $income
 * @property string $confirmation_income
 * @property int $agree
 * @property int $service_id
 * @property int $user_id
 */
class KreditKards extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
	 
	public $name;
	public $last_name;
	public $second_name;
	public $phone;
	public $email;
	public $secret_key;
	public $summ_display; 
	 
    public static function tableName()
    {
        return 'kreditkards';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['summ', 'income', 'confirmation_income'], 'required', 'message'=>'Заполните поле'],
           	[['agree'], 'required', 'message'=>'Необходимо согласие'],
			[['name', 'last_name', 'second_name', 'phone', 'email'], 'required', 'message'=>'Заполните поле'],
            [['summ', 'income', 'confirmation_income'], 'string', 'max' => 255],
			[['email'], 'email', 'message'=>'Введите корректный email'],
			[['phone'], 'validatePhone'],
			[['email'], 'validateEmail']
        ];
    }
	
	public function validateEmail($attribute, $params) {
		
		if ( Yii::$app->user->isGuest && User::getUserByEmail( $this->$attribute ) ){
			$this->addError($attribute, 'Пользователь с таким email уже существует. Авторизуйтесь, пожалуйста.');
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
	
	public function afterFind() {
		
		
		$this->summ_display = number_format($this->summ, 0, '', ' ') . ' ' . Tools::true_wordform( $this->summ, 'рубль', 'рубля', 'рублей');
	}
	
	public function beforeSave($insert){
		if (parent::beforeSave($insert)) {
	 
			$arFields = Array('summ', 'income');
			foreach ( $arFields as $field ){
				$this->$field = Tools::numUpdate($this->$field);
			}
			
			//подготавливаем для crm
			$arFields = KreditKards::makeCrmArray( $this );
			//отправляем в crm
			$crmModel = new CuiteCrm;
			$crmModel -> LongRequest( $arFields );

			return true;
		}
		return false;
	}
	
	
	public function makeCrmArray( $model ) {
	
		return Array(
			'action' => 'CreditCards',
			'name' => $model->name,
			'surname' => $model->last_name,
			'family_name' => $model->second_name,
			'phone' => CuiteCrm::FormatePhone( $model->phone ),
			'email' => $model->email,
			'credit_limit' => $model->summ,
			'income' => $model->income,
			'income_docs' => $model->confirmation_income,
		);

	}

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'summ' => 'Желаемый кредитный лимит',
            'income' => 'Уровень вашей ЗП',
            'confirmation_income' => 'Подтверждение дохода',
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
