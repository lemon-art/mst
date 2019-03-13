<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "request_partners".
 *
 * @property int $id
 * @property string $date
 * @property string $name
 * @property string $phone
 * @property string $type
 */
class Requestp extends \yii\db\ActiveRecord
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
            [['date'], 'safe'],
            [['name', 'phone', 'type'], 'string', 'max' => 255],
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
            'phone' => 'Телефон',
            'type' => 'Тип',
            'product_id' => 'Продукт',
        ];
    }
}
