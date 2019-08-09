<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "offers_ipoteka".
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
 * @property string $initial_payment
 * @property int $min_summ_ipoteka
 * @property int $max_summ_ipoteka
 */
class OffersIpoteka extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'offers_ipoteka';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name', 'bank_id', 'max_summ_ipoteka'], 'required'],
            [['activ', 'special', 'main_page', 'bank_id', 'rate', 'image', 'sort', 'min_summ_ipoteka', 'max_summ_ipoteka'], 'integer'],
            [['preview_text'], 'string'],
            [['name', 'link', 'initial_payment'], 'string', 'max' => 255],
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
            'initial_payment' => 'Первоначальный взнос',
            'min_summ_ipoteka' => 'Минимальная сумма',
            'max_summ_ipoteka' => 'Максимальная сумма',
        ];
    }
}
