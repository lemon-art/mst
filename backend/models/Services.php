<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "services".
 *
 * @property int $id
 * @property string $name
 * @property string $title_main
 * @property string $text_main
 * @property string $code
 */
class Services extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'services';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name', 'code', 'sort'], 'required'],
            [['text_main', 'preview_text_main'], 'string'],
            [['name', 'title_main', 'code'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Название',
            'title_main' => 'Заголовок',
			'preview_text_main' => 'Текст анонса на главной',
            'text_main' => 'Текст на главной',
            'code' => 'Код',
			'image' => 'Картинка',
			'sort' => 'Сортировка',
        ];
    }
}
