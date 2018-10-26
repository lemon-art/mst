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
 * @property int $sort
 */
class Services extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
	 
	public $preview_picture;
	 
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
            [['sort'], 'integer'],
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
            'name' => 'Name',
            'title_main' => 'Title Main',
			'preview_text_main' => 'Title Main',
            'text_main' => 'Text Main',
            'code' => 'Code',
            'sort' => 'Sort',
        ];
    }
}
