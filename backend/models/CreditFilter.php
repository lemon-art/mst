<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "credit_filter".
 *
 * @property int $id
 * @property string $code
 * @property string $url_name
 * @property string $category
 * @property string $title
 * @property string $description
 * @property string $name
 * @property string $top_text
 * @property string $seo_text
 * @property int $bank_id
 * @property int $rate
 * @property int $term
 * @property int $summ
 * @property int $min_age
 * @property int $max_age
 */

class CreditFilter extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'credit_filter';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['code', 'url_name', 'category'], 'required'],
            [['code', 'url_name', 'title', 'description', 'name'], 'string', 'max' => 255],
            [['category', 'bank_id', 'rate', 'term', 'summ', 'min_age', 'max_age'], 'integer'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'code' => 'Символьный код страницы',
            'title' => 'title',
            'url_name' => 'Имя отображаемой ссылки',
            'category' => 'Категория ссылки',
            'description' => 'description',
            'name' => 'Название',
            'top_text' => 'Верхний текст на странице',
            'seo_text' => 'Сео текст',
            'bank_id' => 'Банк',
            'term' => 'Срок кредита, мес.',
            'summ' => 'Сумма кредита',
            'rate' => 'Процентная ставка',
            'min_age' => 'Мин. возраст',
            'max_age' => 'Макс. возраст',
        ];
    }
}
