<?php

namespace app\models;
use dektrium\user\models\User;
use app\models\Tools;
use Yii;

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
			[['email'], 'validateEmail']
        ];
    }
	
	public function validateEmail($attribute, $params) {
		
		if ( Yii::$app->user->isGuest && User::getUserByEmail( $this->$attribute ) ){
			$this->addError($attribute, 'Пользователь с таким email уже существует. Авторизуйтесь, пожалуйста.');
		}

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

			return true;
		}
		return false;
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
