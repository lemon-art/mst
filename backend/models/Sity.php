<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "sity".
 *
 * @property int $id
 * @property string $name
 * @property string $dec1
 * @property string $dec2
 * @property string $dec3
 * @property string $dec4
 * @property string $subdomain
 */
class Sity extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'sity';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name', 'dec1', 'dec2', 'dec3', 'dec4', 'subdomain'], 'required'],
            [['name', 'dec1', 'dec2', 'dec3', 'dec4', 'subdomain'], 'string', 'max' => 64],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Название города',
            'dec1' => 'Склонение (где?) Пример: в Москве',
            'dec2' => 'Склонение (куда?) Пример: в Москву',
            'dec3' => 'Склонение (какой?) Пример: Московский',
			'dec4' => 'Склонение (чего?) Пример: Москвы',
            'subdomain' => 'Поддомен',
        ];
    }
}
