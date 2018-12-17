<?php

namespace app\models;

use Yii;
use yii\helpers;
/**
 * This is the model class for table "reviews".
 *
 * @property int $id
 * @property int $image
 * @property string $name
 * @property string $text
 */
class Reviews extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
	 
	public $detailUrl;  
	public $preview_text;
	 
    public static function tableName()
    {
        return 'reviews';
    }
	
	public function afterFind() {
		$this->detailUrl = '/reviews/'.$this->id;
		$this->preview_text = \yii\helpers\StringHelper::truncate($this->text, 200, '...');
	}

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['image'], 'integer'],
            [['name', 'text'], 'required'],
            [['text'], 'string'],
            [['name'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'image' => 'Image',
            'name' => 'Name',
            'text' => 'Text',
        ];
    }
}
