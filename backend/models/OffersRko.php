<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "offers_rko".
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
 * @property string $rko_service
 * @property string $rko_open
 */
class OffersRko extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'offers_rko';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name', 'bank_id'], 'required'],
            [['activ', 'special', 'main_page', 'bank_id', 'rate', 'image', 'sort'], 'integer'],
            [['preview_text'], 'string'],
            [['name', 'link', 'rko_service', 'rko_open'], 'string', 'max' => 255],
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
            'rko_service' => 'Обслуживание',
            'rko_open' => 'Открытие счета',
        ];
    }
}
