<?php

namespace app\models;

use Yii;
use backend\models\Search;
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
            [['code', 'title', 'h1', 'text', 'description'], 'required'],
            [['text'], 'string'],
            [['code', 'title', 'h1', 'description'], 'string', 'max' => 255],
        ];
    }
	
	public function afterSave($insert, $changedAttributes){
		parent::afterSave($insert, $changedAttributes);
	 
		$url = '/' . $this -> code;
	 
		if ( $search = Search::GetByUrl( $url ) ){
		
		}
		else {
			$search = new Search();
		}
	 
		
		$search -> name   = $this -> title;
		$search -> text   = strip_tags( $this -> text );
		$search -> url    = $url;
		$search -> module = 'pages';
		$search -> save();
		
	}

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'code' => 'Символьный код страницы',
            'title' => 'title',
            'h1' => 'Заголовок страницы',
            'text' => 'Содержание страницы',
            'description' => 'description',
        ];
    }
}
