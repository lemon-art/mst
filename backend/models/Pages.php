<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "pages".
 *
 * @property int $id
 * @property string $code
 * @property string $title
 * @property string $h1
 * @property string $text
 * @property string $description
 */
class Pages extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'pages';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['code', 'title', 'h1', 'text'], 'required'],
            [['text', 'description'], 'string'],
            [['code', 'title', 'h1'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'code' => 'Символьный код страницы',
            'title' => 'Заголовок браузера',
            'h1' => 'Заголовок страницы',
            'text' => 'Содержание страницы',
            'description' => 'Description',
        ];
    }
}
