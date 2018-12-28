<?php

namespace backend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
/**
 * This is the model class for table "search".
 *
 * @property int $id
 * @property string $name
 * @property string $text
 * @property string $url
 * @property string $module
 */
class Search extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'search';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name', 'text', 'url'], 'required'],
            [['text'], 'string'],
            [['name', 'module'], 'string', 'max' => 255],
            [['url'], 'string', 'max' => 500],
        ];
    }
	
	public function GetByUrl( $url ){
	
		return Search::find()->where(['url' => $url])->one();

	}
	
	public function GetSearchResult( $q )
    {
		
		$query =  Search::find();
		$query->andFilterWhere(['or',
            ['like','name', $q],
            ['like','text', $q]]
		);
		$dataProvider = new ActiveDataProvider([
            'query' => $query,
			'pagination' => [
                'pageSize' => 10,
            ],
        ]);
		return $dataProvider;
	}

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Name',
            'text' => 'Text',
            'url' => 'Url',
            'module' => 'Module',
        ];
    }
}
