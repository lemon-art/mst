<?php

namespace backend\models;

use Yii;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\data\ActiveDataProvider;
use yii\db\ActiveRecord;
use dosamigos\fileupload\FileUpload;
/**
 * This is the model class for table "files".
 *
 * @property int $id
 * @property string $path
 */
class Files extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'files';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['path'], 'required'],
            [['path'], 'string', 'max' => 255],
        ];
    }
	
	public function upload( $imageFile ) 
	{

		$directory = Yii::getAlias('@frontend/web/upload/img/');

		if ($imageFile) {
			$uid = uniqid(time(), true);
			$fileName = $uid . '.' . $imageFile->extension;
			$filePath = $directory . $fileName;
			if ($imageFile->saveAs($filePath)) {
				
				$model = new Files;
				$model -> path = $fileName;
				$model->save();  
				return $model->id;
			}
		}

		return false;
	}
	
	public function deleteFile( $id ) 
	{

		$model = Files::findOne($id);
		$directory = Yii::getAlias('@frontend/web/upload/img/');
		$fileName = $model -> path;
		$filePath = $directory . $fileName;
		unlink($filePath);
		$model->delete();
		return true;
	}
	
	public function getPath( $id = '' ) 
	{
		if ( !$id ){
			return false;
		}
		$model = Files::findOne($id);
		return '/upload/img/' . $model -> path;
	}
	

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'path' => 'Path',
        ];
    }
}
