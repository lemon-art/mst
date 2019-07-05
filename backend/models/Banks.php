<?php

namespace backend\models;

use Yii;
use backend\models\Offers;
use backend\models\Search;
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
 * @property string $title
 * @property string $description
 * @property string $license
 * @property string $foundation_date
 * @property int $priority
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
	
	public function getOffers()
    {
        return $this->hasMany(Offers::className(),['bank_id'=>'id']);
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name', 'code', 'title', 'description'], 'required'],
            [['preview_text', 'adress', 'phone'], 'string'],
            [['name', 'link', 'title', 'description', 'license', 'foundation_date'], 'string', 'max' => 255],
			[['active', 'priority'], 'integer'],
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
			'active' => 'Активность',
			'license' => 'Лицензия',
			'title' => 'title',
			'description' => 'description',
			'foundation_date' => 'Дата основания',
			'priority' => 'Приоритет'
        ];
    }
	
	public function afterSave($insert, $changedAttributes){
		parent::afterSave($insert, $changedAttributes);
	 
		$url = '/banks/' . $this -> code;
	 
		if ( $search = Search::GetByUrl( $url ) ){
		
		}
		else {
			$search = new Search();
		}
	 
		
		$search -> name   = $this -> name;
		$search -> text   = strip_tags($this -> preview_text . ' ' . $this -> adress . ' ' . $this -> phone);
		$search -> url    = $url;
		$search -> module = 'banks';
		$search -> save();
		
	}
	
	
	//формирует список банков
	public function GetList()
	{
		$arItems = Banks::find()->asArray()->all(); 
		
		$arDropList = Array();
		foreach ( $arItems as $val){
			$arDropList[$val['id']] = $val['name'];
		}
		return $arDropList;
	}
}
