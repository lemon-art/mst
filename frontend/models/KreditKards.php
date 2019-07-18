<?php

namespace app\models;
use dektrium\user\models\User;
use app\models\Tools;
use Yii;
use common\models\BitrixCrm;
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
	
	const SCENARIO_UPDATE = 'update';
	 
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
            [['summ', 'income', 'confirmation_income'], 'required', 'message'=>'Заполните поле', 'on' => 'new'],
           	[['agree'], 'required', 'message'=>'Необходимо согласие', 'on' => 'new'],
			[['name', 'last_name', 'second_name', 'phone', 'email'], 'required', 'message'=>'Заполните поле', 'on' => 'new'],
            [['summ', 'income', 'confirmation_income', 'secret_key'], 'string', 'max' => 255, 'on' => 'new'],
			[['email'], 'email', 'message'=>'Введите корректный email', 'on' => 'new'],
			[['phone'], 'validatePhone', 'on' => 'new'],
			[['email'], 'validateEmail', 'on' => 'new']
        ];
    }
	
	public function scenarios()
	{
		$scenarios = parent::scenarios();
		$scenarios[self::SCENARIO_UPDATE] = ['name', 'last_name', 'second_name', 'phone', 'email', 'summ', 'income', 'confirmation_income'];
		return $scenarios;
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
			$this->service_id = 5;
			return true;
		}
		return false;
	}
	
	public function afterSave($insert, $changedAttributes){
		parent::afterSave($insert, $changedAttributes);
	 
		if ( $this -> scenario !== 'update' ){
			//отправляем в crm
			$arFields = KreditKards::makeBitrixCrmArray( $this );
			$crmModel = new BitrixCrm;
			$crmModel -> LongRequest( $arFields );
		}
	}
	

	
	public function makeBitrixCrmArray( $model ) {
	
		return Array(
			'TITLE' => 'Заявка на кредитную карту',
			'CATEGORY_ID' => 2,
			'NAME' => $model->name,
			'SECOND_NAME' => $model->second_name,
			'LAST_NAME' => $model->last_name,
			'PHONE' => BitrixCrm::FormatePhone( $model->phone ),
			'EMAIL' => $model->email,
			'UF_CRM_1559807131' => $model->id,
			'UF_CRM_1561551713' => $model->summ,
			'UF_CRM_1559890441' => $model->income, 
			'UF_CRM_1559914502' => BitrixCrm::GetListValue($model->confirmation_income),

		);
	}
	
	public function getArrayFromBitrixCrm() {
	
		return Array(
			'UF_CRM_1561551713' => Array('field' => 'summ', 'type' => 'string'), 
			'UF_CRM_1559890441' => Array('field' => 'income', 'type' => 'string'), 
			'UF_CRM_1559914502' => Array('field' => 'confirmation_income', 'type' => 'list'), 
			
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
