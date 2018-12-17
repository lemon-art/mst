<?php

namespace app\models;

use Yii;
use app\models\Banks;
/**
 * This is the model class for table "offers".
 *
 * @property int $id
 * @property int $bank_id
 * @property string $name
 * @property int $min_summ
 * @property int $max_summ
 * @property int $min_term
 * @property int $max_term
 * @property int $rate
 * @property int $min_age
 * @property int $max_age
 * @property string $preview_text
 * @property string $valut
 */
class Offers extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
	 
	public $offerUrl;
	
	 
    public static function tableName()
    {
        return 'offers';
    }
	
	public function getBanks()
    {
        return $this->hasOne(Banks::className(),['id'=>'bank_id']);
    }
	
	public function afterFind() {
		$this->offerUrl = $this->id;
	}

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['bank_id', 'service_id', 'name', 'min_summ', 'max_summ', 'min_term', 'max_term', 'rate','valut'], 'required'],
            [['bank_id', 'min_summ', 'max_summ', 'min_term', 'max_term', 'min_age', 'max_age'], 'integer'],
            [['preview_text'], 'string'],
            [['name'], 'string', 'max' => 255],
            [['valut'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'bank_id' => 'Банк',
            'name' => 'Название',
            'min_summ' => 'Минимальная сумма',
            'max_summ' => 'Максимальная сумма',
            'min_term' => 'Минимальны срок',
            'max_term' => 'Максимальный срок',
            'rate' => 'Процентная ставка',
            'min_age' => 'Минимальный возраст',
            'max_age' => 'Максимальная возраст',
            'preview_text' => 'Текст анонса',
			'service_id' => 'Услуга',
            'valut'=>'Код валют'
        ];
    }
}
