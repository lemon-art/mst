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
	public $seo_text_preview;
	public $seo_text_detail;
	 
    public static function tableName()
    {
        return 'services';
    }
	
	
	public function afterFind() {
	
		if ( $this->seo_text ){
			$arSeoText = explode('#MORE#', $this->seo_text);
			$this->seo_text_preview = $arSeoText['0'];
			if ( isset($arSeoText['1']))
				$this->seo_text_detail  = $arSeoText['1'];
		}
	}

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name', 'code', 'sort'], 'required'],
            [['text_main', 'preview_text_main','top_text', 'advantages', 'scheme'], 'string'],
            [['sort'], 'integer'],
            [['name', 'title_main', 'code'], 'string', 'max' => 255],
        ];
    }
	
	public function loadModel($id)
	{
		$model = Services::findOne(['id' => $id]);
		return $model;
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
