<?php

namespace eugenekei\news\models;

use common\models\User;
use DOMDocument;
use eugenekei\news\Module;
use Yii;
use yii\behaviors\TimestampBehavior;
use yii\db\Expression;
use yii\helpers\FileHelper;

/**
 * This is the model class for table "{{%news}}".
 *
 * @property integer $id
 * @property string $title
 * @property string $annonce
 * @property string $content
 * @property integer $status
 * @property string $created_at
 * @property string $updated_at
 * @property string $user_id
 *
 * @property User $user
 */
class News extends \yii\db\ActiveRecord
{
    const STATUS_NOT_ACTIVE = 0;
    const STATUS_ACTIVE = 1;

    public $imageGetUrl;
    public $imageUploadPath;
    public $uploadTempPath;
    public $imageGetTempUrl;

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%news}}';
    }

    /**
     * @return array
     */
    public static function getStatusArray()
    {
        return [
            self::STATUS_NOT_ACTIVE => Module::t('eugenekei-news', 'NOT ACTIVE'),
            self::STATUS_ACTIVE => Module::t('eugenekei-news', 'ACTIVE')
        ];
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['title', 'content'], 'required'],
            [['annonce'], 'string', 'max' => 1000],
            [['content'], 'string', 'max' => 30000],
            [['status'], 'in', 'range' => array_keys(self::getStatusArray())],
            [['status'], 'default', 'value' => self::STATUS_NOT_ACTIVE],
            [['created_at', 'updated_at', 'user_id'], 'safe'],
            [['title'], 'string', 'max' => 100],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Module::t('eugenekei-news', 'ID'),
            'title' => Module::t('eugenekei-news', 'Title'),
            'annonce' => Module::t('eugenekei-news', 'Annonce'),
            'content' => Module::t('eugenekei-news', 'Content'),
            'status' => Module::t('eugenekei-news', 'Status'),
            'created_at' => Module::t('eugenekei-news', 'Created At'),
            'updated_at' => Module::t('eugenekei-news', 'Updated At'),
            'user_id' => Module::t('eugenekei-news', 'Author'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(Yii::$app->controller->module->authorClass, ['id' => 'user_id']);
    }

    /**
     * @param bool $insert
     * @return bool
     */
    public function beforeSave($insert)
    {
        if ($insert) {
            if(!Yii::$app->user->id){
                return false;
            }
            $this->user_id = Yii::$app->user->id;
        } else {
            $this->annonce = $this->imageShift($this->annonce);
            $this->content = $this->imageShift($this->content);
        }
        if (!$this->annonce || !$this->content) {
            return false;
        }

        return parent::beforeSave($insert);
    }

    public function afterSave($insert, $changedAttributes)
    {
        parent::afterSave($insert, $changedAttributes);

        if ($insert) {
            //когда узнали id обновляем данные, beforeSave вызовет $this->imageShift();
            $this->save();
        }

    }

    /**
     * Парсит переданный html код, находит картинки находящиеся во временной директории,
     * переносит файлы в директориюю с названием id новости и правит линки на эти файлы.
     * Возвращает обработанный html.
     * @param $html
     * @return string
     * @throws Exception
     * @throws \yii\base\Exception
     */
    public function imageShift($html)
    {
        $pregQuoteTempUrl = preg_quote($this->imageGetTempUrl, '/');
        $pattern = '/<\\s?img(?:\\s[^<>]*?)?\\bsrc\\s*=\\s*(?|"([^"]*' . $pregQuoteTempUrl
            . '[^"]*)"|\'([^\']*' . $pregQuoteTempUrl . '[^\']*)\'|([^<>\'"\\s]*))[^<>]*>/i';

        if (preg_match_all($pattern, $html, $matches)) {
            if (!is_dir($this->imageUploadPath . DIRECTORY_SEPARATOR . $this->id)) {
                if (!FileHelper::createDirectory($this->imageUploadPath . DIRECTORY_SEPARATOR . $this->id, 0755, true)
                ) {
                    throw new Exception("can't create directory " . $this->imageUploadPath . DIRECTORY_SEPARATOR . $this->id);
                }
            }

            foreach ($matches[1] as $image) {
                $filename = basename($image);
                if (!empty($filename) && file_exists($this->uploadTempPath . $filename)) {
                    if (!rename($this->uploadTempPath . $filename,
                        $this->imageUploadPath . DIRECTORY_SEPARATOR . $this->id . DIRECTORY_SEPARATOR . $filename)
                    ) {
                        throw new Exception("can't create file " . $this->imageUploadPath . DIRECTORY_SEPARATOR
                            . $this->id . DIRECTORY_SEPARATOR . $filename);
                    }
                }
            }

            $newHtml = str_replace($this->imageGetTempUrl, $this->imageGetUrl . $this->id . '/', $html);
            return $newHtml;
        } else {
            return $html;
        }

    }

    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            [
                'class' => TimestampBehavior::className(),
                'value' => new Expression("'" . date('Y-m-d H:i:s') . "'"),
            ]
        ];
    }
}
