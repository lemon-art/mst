<?php

namespace backend\models;

use Yii;
use backend\models\Banks;
use backend\models\Services;
use backend\models\Search;
use backend\models\Tools;

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
	public $min_summ_display;
	public $max_summ_display;
	
    public static function tableName()
    {
        return 'offers';
    }
	
	public function getBanks()
    {
        return $this->hasOne(Banks::className(),['id'=>'bank_id']);
    }
	
	public function getServices()
    {
        return $this->hasOne(Services::className(),['id'=>'service_id']);
    }
	
	public function afterFind() {
	
		$arFields = Array('min_summ', 'max_summ', 'depozit_summ', 'min_summ_kreditcard', 'max_summ_kreditcard', 'min_summ_ipoteka', 'max_summ_ipoteka');
		foreach ( $arFields as $field ){
			if ( $this->$field ) {
				$this->$field = Tools::numDisplay($this->$field);
			}
		
		}

	}
	
	public function afterSave($insert, $changedAttributes){
		parent::afterSave($insert, $changedAttributes);
	}
	
	public function beforeSave($insert){
		if (parent::beforeSave($insert)) {
	 

			return true;
		}
		return false;
	}
	
	/*
	public function afterSave($insert, $changedAttributes){
		parent::afterSave($insert, $changedAttributes);
	 
		$url = '/offers/' . $this -> id;
	 
		if ( $search = Search::GetByUrl( $url ) ){
		
		}
		else {
			$search = new Search();
		}
	 
		
		$search -> name   = $this -> name . '(' . $this -> services -> name . ')';
		$search -> text   = strip_tags($this -> preview_text);
		$search -> url    = $url;
		$search -> module = 'offers';
		$search -> save();
		
	}
	*/
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['bank_id', 'service_id', 'name'], 'required'],
            [['bank_id', 'min_term', 'max_term', 'min_age', 'max_age', 'main_page'], 'integer'],
            [['preview_text', 'min_summ', 'max_summ', 'min_term', 'max_term', 'min_summ_kreditcard', 'max_summ_kreditcard', 'link', 'rate', 'depozit_term', 'depozit_summ', 'min_summ_ipoteka', 'max_summ_ipoteka', 'initial_payment', 'grace_period', 'grace_period', 'residue', 'cash_back', 'maintenance_cost', 'rko_service', 'rko_open'], 'safe'],
			[['special', 'activ'], 'boolean'],
            [['name'], 'string', 'max' => 255],
            //[['valut'], 'string', 'max' => 255],
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
            'min_summ' => 'Мин. сумма',
            'max_summ' => 'Макс. сумма',
            'min_term' => 'Мин. срок',
            'max_term' => 'Макс. срок',
            'rate' => 'Процентная ставка',
            'min_age' => 'Мин. возраст',
            'max_age' => 'Макс. возраст',
            'preview_text' => 'Текст анонса',
			'service_id' => 'Услуга',
			'special'    => 'Спецпредложение',
			'main_page'    => 'Отображать на главной',
			'image'    => 'Картинка',
			'sort'    => 'Сортировка',
            'depozit_term'=>'Срок депозита',
			'depozit_summ'=>'Мин. сумма',
			'initial_payment'=>'Первоначальный взнос',
			'grace_period' => 'Льготный период',
			'residue'    => 'Процент на остаток',
			'cash_back'    => 'Cash back',
			'maintenance_cost'    => 'Стоимость обслуживания',
			'link' => 'Ссылка на сайт банка(предложения)',
			'min_summ_kreditcard' => 'Сумма кредита (мин)',
			'max_summ_kreditcard' => 'Сумма кредита (макс)',
			'rko_service' => 'Обслуживание',
			'rko_open' => 'Открытие счета',
			'min_summ_ipoteka' => 'Мин. сумма', 
			'max_summ_ipoteka' => 'Макс. сумма',
			'activ' => 'Активность',
        ];
    }
}
