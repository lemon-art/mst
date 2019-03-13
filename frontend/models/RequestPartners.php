<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "request_partners".
 *
 * @property int $id
 * @property string $name
 * @property string $phone
 * @property string $type
 */
class RequestPartners extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'request_partners';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name', 'phone'], 'required', 'message'=>'Заполните поле'],
            [['type', 'name', 'phone'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Ваше имя',
            'phone' => 'Ваш телефон',
            'type' => 'Type'
        ];
    }
}
