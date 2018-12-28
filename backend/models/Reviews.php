<?php

namespace backend\models;

use Yii;
use backend\models\Search;
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
    public static function tableName()
    {
        return 'reviews';
    }
	
	public function afterSave($insert, $changedAttributes){
		parent::afterSave($insert, $changedAttributes);
	 
		$url = '/reviews/' . $this -> id;
	 
		if ( $search = Search::GetByUrl( $url ) ){
		
		}
		else {
			$search = new Search();
		}
	 
		
		$search -> name   = $this -> name;
		$search -> text   = strip_tags( $this -> text );
		$search -> url    = $url;
		$search -> module = 'reviews';
		$search -> save();
		
	}

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
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
            'image' => 'Фото',
            'name' => 'Имя',
            'text' => 'Текст отзыва',
        ];
    }
}
