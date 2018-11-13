<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "banks".
 *
 * @property int $id
 * @property string $code
 * @property string $name
 * @property int $image
 * @property string $link
 * @property string $preview_text
 * @property string $adress
 * @property string $phone
 */
class Banks extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'banks';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['code', 'name'], 'required'],
            [['image'], 'integer'],
            [['preview_text', 'adress', 'phone'], 'string'],
            [['code'], 'string', 'max' => 100],
            [['name', 'link'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'code' => 'Code',
            'name' => 'Name',
            'image' => 'Image',
            'link' => 'Link',
            'preview_text' => 'Preview Text',
            'adress' => 'Adress',
            'phone' => 'Phone',
        ];
    }
}
