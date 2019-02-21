<?php

namespace app\models;
use dektrium\user\models\User;
use Yii;

/**
 * This is the model class for table "rko".
 *
 * @property int $id
 * @property string $date
 * @property string $name
 * @property string $last_name
 * @property string $second_name
 * @property string $phone
 * @property string $email
 * @property string $form
 * @property int $inn
 * @property string $city
 * @property int $service_id
 * @property int $user_id
 * @property int $status
 * @property int $agree
 * @property string $purpose
 */
class Rko extends \yii\db\ActiveRecord
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
	
	public $summ_display; 
	public $term_display; 
	 
	 
	 
    public static function tableName()
    {
        return 'rko';
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
            [['name', 'last_name', 'second_name', 'phone', 'email', 'form', 'city', 'inn'], 'required', 'message'=>'Заполните поле'],
            [['id',  'service_id', 'user_id', 'status'], 'integer'],
            [['date'], 'safe'],
			[['agree'], 'required', 'message'=>'Необходимо согласие'],
            [['name', 'last_name', 'second_name', 'city'], 'string', 'max' => 255],
			[['email'], 'validateEmail'],
			
        ];
    }
	
	
	public function validateEmail($attribute, $params) {
		
		if ( Yii::$app->user->isGuest && User::getUserByEmail( $this->$attribute ) ){
			$this->addError($attribute, 'Пользователь с таким email уже существует. Авторизуйтесь, пожалуйста.');
		}

	}
	
	public function afterFind() {
		
	}

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'date' => 'Date',
            'name' => 'Имя',
            'last_name' => 'Фамилия',
            'second_name' => 'Отчество',
            'phone' => 'Телефон',
            'email' => 'Email',
            'form' => 'Организационно правовая форма',
            'inn' => 'ИНН организации',
            'city' => 'Населенный пункт',
            'service_id' => 'Service ID',
            'user_id' => 'User ID',
            'status' => 'Status',
            'agree' => 'Я даю свое согласие на обработку персональных данных'
        ];
    }
}
