<?php

namespace app\models;

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
	 
	public $detailUrl;  
	 
    public static function tableName()
    {
        return 'atricles';
    }
	
	public function afterFind() {
		$this->detailUrl = '/articles/' . $this->code . '/';
	}

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name', 'preview_text', 'detail_text'], 'required'],
            [['preview_text', 'detail_text'], 'string'],
            [['date'], 'safe'],
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
            'name' => 'Name',
            'preview_text' => 'Preview Text',
            'detail_text' => 'Detail Text',
            'date' => 'Date',
        ];
    }
}
