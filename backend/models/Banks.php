<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "banks".
 *
 * @property int $id
 * @property string $name
 * @property int $image
 * @property string $link
 * @property string $preview_text
 * @property string $adress
 * @property string $phone
 */
class Banks extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'banks';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name', 'code'], 'required'],
            [['preview_text', 'adress', 'phone'], 'string'],
            [['name', 'link'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
			'code' => 'Код',
            'name' => 'Название',
            'image' => 'Логотип',
            'link' => 'Ссылка на сайт',
            'preview_text' => 'Текст',
            'adress' => 'Адресс',
            'phone' => 'Телефон',
        ];
    }
}
