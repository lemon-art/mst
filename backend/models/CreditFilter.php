<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "credit_filter".
 *
 * @property int $id
 * @property string $code
 * @property string $title
 * @property string $description
 * @property string $name
 * @property string $top_text
 * @property string $seo_text
 * @property int $bank_id
 * @property string $rate
 * @property int $term
 * @property int $summ
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
            [['code', 'title', 'description'], 'required'],
            [['code', 'title', 'description', 'name', 'rate'], 'string', 'max' => 255],
            [['id',  'bank_id', 'term', 'summ'], 'integer'],
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
            'description' => 'description',
            'name' => 'Название',
            'top_text' => 'Верхний текст на странице',
            'seo_text' => 'Сео текст',
            'bank_id' => 'Банк',
            'term' => 'Срок кредита, мес.',
            'summ' => 'Сумма кредита',
            'rate' => 'Процентная ставка',
        ];
    }
}
