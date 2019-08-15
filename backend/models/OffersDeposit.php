<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "offers_deposit".
 *
 * @property int $id
 * @property int $activ
 * @property int $bank_id
 * @property string $name
 * @property string $rate
 * @property string $preview_text
 * @property int $image
 * @property int $special
 * @property int $sort
 * @property int $main_page
 * @property string $depozit_term
 * @property string $depozit_summ
 * @property string $link
 */
class OffersDeposit extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'offers_deposit';
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
            [['activ', 'bank_id', 'image', 'special', 'sort', 'main_page'], 'integer'],
            [['bank_id', 'name'], 'required'],
            [['preview_text'], 'string'],
            [['rate'], 'double'],
            [['name', 'depozit_term', 'depozit_summ', 'link'], 'string', 'max' => 255],
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
            'depozit_summ' => 'Минимальная сумма',
            'depozit_term' => 'Срок депозита',
        ];
    }
}
