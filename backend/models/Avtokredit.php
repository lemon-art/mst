<?php

namespace backend\models;
use backend\models\Tools;
use dektrium\user\models\User;
use dektrium\user\models\Profile;
use Yii;

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
			[['email'], 'email', 'message'=>'Введите корректный email'],
			[['email'], 'validateEmail'],
			[['agree'], 'required', 'message'=>'Необходимо согласие'],
			[['name', 'last_name', 'second_name', 'phone', 'email'], 'required', 'message'=>'Заполните поле'],
        ];
    }
	
	public function afterFind() {
	

		$this->summ = Tools::numUpdate($this->summ);
		
		$this->term_display = $this->term . ' ' . Tools::true_wordform( $this->term, 'месяц', 'месяца', 'месяцев');
		$this->summ_display = number_format($this->summ, 0, '', ' ') . ' ' . Tools::true_wordform( $this->summ, 'рубль', 'рубля', 'рублей');
	}
	
	public function getProfile()
    {
        return $this->hasOne(Profile::className(),['user_id'=>'user_id']);
    }
	
	public function GetShowFields() {
		return ['summ_display', 'first_payment', 'income', 'confirmation_income', 'term_display', 'condition', 'type', 'kasko', 'treid_in', 'profile.last_name', 'profile.name', 'profile.second_name', 'profile.phone', 'profile.email'];
	}
	
    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'summ_display' => 'Стоимость автомобиля',
            'income' => 'Уровень дохода',
            'confirmation_income' => 'Подтверждение дохода',
            'first_payment' => 'Первоначальный взнос',
            'term_display' => 'Срок кредита',
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
