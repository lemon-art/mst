<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "settings".
 *
 * @property int $id
 * @property int $admin_email
 */
class Settings extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'settings';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'admin_email'], 'required'],
            [['id'], 'integer'],
            [['id'], 'unique'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'admin_email' => 'E-mail администратора',
        ];
    }
	
	
	public function GetSettings()
    {
        if (($model = Settings::findOne(0)) !== null) {
            return $model;
        }
    }
	
	
}
