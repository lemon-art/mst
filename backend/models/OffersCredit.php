<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "offers_credit".
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
 * @property int $min_summ
 * @property int $max_summ
 * @property int $min_term
 * @property int $max_term
 * @property int $min_age
 * @property int $max_age
 */
class OffersCredit extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'offers_credit';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name', 'bank_id'], 'required'],
            [['activ', 'special', 'main_page', 'bank_id', 'rate', 'image', 'sort', 'min_summ', 'max_summ', 'min_term', 'max_term', 'min_age', 'max_age'], 'integer'],
            [['preview_text'], 'string'],
            [['name', 'link'], 'string', 'max' => 255],
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
            'min_summ' => 'Минимальная сумма',
            'max_summ' => 'Максимальная сумма',
            'min_term' => 'Минимальный срок',
            'max_term' => 'Максимальный срок',
            'min_age' => 'Минимальный возраст',
            'max_age' => 'Максимальный возраст',
        ];
    }
}
