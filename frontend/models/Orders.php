<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "orders".
 *
 * @property int $id
 * @property string $name
 * @property string $last_name
 * @property string $second_name
 * @property string $phone
 * @property string $email
 * @property int $summ
 * @property int $term
 * @property string $city
 * @property string $employment
 * @property int $work_month
 * @property int $work_year
 * @property int $income
 * @property string $provision
 * @property int $have_auto
 * @property int $agree
 */
class Orders extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'orders';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name', 'last_name', 'second_name', 'phone', 'email', 'summ', 'term', 'city', 'employment', 'work_month', 'work_year', 'income', 'provision'], 'required', 'message'=>'Заполните поле'],
            [['summ', 'term', 'work_month', 'work_year', 'income', 'have_auto'], 'integer'],
            [['name', 'last_name', 'second_name', 'city', 'employment', 'provision'], 'string', 'max' => 255],
            [['phone'], 'string', 'max' => 20],
            [['email'], 'string', 'max' => 200],
        ];
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
            'summ' => 'Сумма кредита',
            'term' => 'На какой срок (месяцев)',
            'city' => 'Город получения',
            'employment' => 'Тип занятости',
            'work_month' => 'Начало работы на последнем месте',
            'work_year' => 'Work Year',
            'income' => 'Ежемесячный доход',
            'provision' => 'Обеспечение кредита',
            'have_auto' => 'У меня есть автомобиль',
            'agree' => 'Я даю свое согласие на обработку персональных даных',
        ];
    }
}
