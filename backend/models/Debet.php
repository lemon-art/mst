<?php

namespace backend\models;
use backend\models\Tools;
use dektrium\user\models\User;
use dektrium\user\models\Profile;
use Yii;

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
	
	public $summ_display; 
	public $term_display;
		
    public static function tableName()
    {
        return 'debet';
    }
	

	

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
			[['email'], 'email', 'message'=>'Введите корректный email'],
            [['name', 'last_name', 'purpose', 'second_name', 'phone', 'email', 'summ', 'term', 'city'], 'required', 'message'=>'Заполните поле'],
            [['id',  'term', 'service_id', 'user_id', 'status'], 'integer'],
            [['date'], 'safe'],
			[['agree'], 'required', 'message'=>'Необходимо согласие'],
            [['name', 'last_name', 'second_name', 'purpose', 'city','summ'], 'string', 'max' => 255],
			[['bithday', 'issuedate', 'registrationdate'], 'validateDate'], 
			[['email'], 'validateEmail'],
        ];
    }
	

	
	public function afterFind() {
		
		$this->term_display = $this->term . ' ' . Tools::true_wordform( $this->term, 'месяц', 'месяца', 'месяцев');
		$this->summ_display = number_format($this->summ, 0, '', ' ') . ' ' . Tools::true_wordform( $this->summ, 'рубль', 'рубля', 'рублей');
	}
	
	
	public function getProfile()
    {
        return $this->hasOne(Profile::className(),['user_id'=>'user_id']);
    }
	
	public function GetShowFields() {
		return ['summ_display', 'term_display', 'city', 'purpose', 'profile.last_name', 'profile.name', 'profile.second_name', 'profile.phone', 'profile.email'];
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
            'summ_display' => 'Введите сумму вклада',
            'term_display' => 'На какой срок (месяцев)',
            'city' => 'Город получения',
            'service_id' => 'Service ID',
            'user_id' => 'User ID',
            'status' => 'Status',
			'purpose' => 'Цель вклада',
            'agree' => 'Я даю свое согласие на обработку персональных данных',
        ];
    }
}
