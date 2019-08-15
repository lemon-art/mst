<?php

namespace app\models;

use Yii;
use app\models\Banks;

/**
 * This is the model class for table "offers_creditcards".
 *
 * @property int $id
 * @property string $name
 * @property int $activ
 * @property int $special
 * @property int $main_page
 * @property int $bank_id
 * @property int $rate
 * @property string $link
 * @property string $preview_text
 * @property int $image
 * @property int $sort
 * @property string $grace_period
 * @property int $min_summ_kreditcard
 * @property int $max_summ_kreditcard
 */
class OffersCreditcards extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'offers_creditcards';
    }

    public function getBanks()
    {
        return $this->hasOne(Banks::className(),['id'=>'bank_id']);
    }
    
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name', 'bank_id'], 'required'],
            [['activ', 'special', 'main_page', 'bank_id', 'image', 'sort', 'min_summ_kreditcard', 'max_summ_kreditcard'], 'integer'],
            [['preview_text'], 'string'],
            [['rate'], 'double'],
            [['name', 'link', 'grace_period'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'id',
            'name' => 'Название',
            'activ' => 'Активность',
            'special' => 'Спецпредложение',
            'main_page' => 'Отображать на главной',
            'bank_id' => 'Банк',
            'rate' => 'Процентная ставка',
            'link' => 'Ссылка на сайт банка',
            'preview_text' => 'Текст анонса',
            'image' => 'Картинка',
            'sort' => 'Приоритет',
            'grace_period' => 'Льготный период',
            'min_summ_kreditcard' => 'Минимальная сумма',
            'max_summ_kreditcard' => 'Максимальная сумма',
        ];
    }
}
