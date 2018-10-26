<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "atricles".
 *
 * @property int $id
 * @property string $name
 * @property string $preview_text
 * @property string $detail_text
 * @property string $date
 */
class Atricles extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'atricles';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name', 'preview_text', 'detail_text'], 'required'],
            [['preview_text', 'detail_text'], 'string'],
            [['date', 'image'], 'safe'],
            [['name'], 'string', 'max' => 255],
        ];
    }
	
	public function upload()
	{

		$this->imageFile->saveAs('uploads/' . $this->image->baseName . '.' . $this->imageFile->extension);

	}

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Заголовок',
            'preview_text' => 'Текст анонса',
            'detail_text' => 'Детальный текст',
            'date' => 'Дата',
			'image' => 'Картинка',
        ];
    }
}
