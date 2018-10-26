<?php

namespace backend\controllers;

use Yii;
use backend\models\Atricles;
use backend\models\Files;
use backend\models\AtriclesSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\UploadedFile;

/**
 * AtriclesController implements the CRUD actions for Atricles model.
 */
class AtriclesController extends Controller
{
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }

    /**
     * Lists all Atricles models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new AtriclesSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Atricles model.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new Atricles model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Atricles();

        if ($model->load(Yii::$app->request->post())) {
		
			$file = UploadedFile::getInstance($model, 'image');
			$upFile = new Files;	
			if ( $file ){
				$model->image = $upFile -> upload( $file );
			}

		
			$model->save();
            return $this->redirect(['index']);
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing Atricles model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
		
		$image = $model->image;
		
		
        if ($model->load(Yii::$app->request->post())) {
			
			$file = UploadedFile::getInstance($model, 'image');
			$upFile = new Files;	
			if ( $image && $file ){
				$upFile -> deleteFile( $image );
			}
			if ( $file ){
				$model->image = $upFile -> upload( $file );
			}			
			elseif( $image ) {
				$model->image = $image;
			}
			$model->save();
            return $this->redirect(['index']);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }
	


    /**
     * Deletes an existing Atricles model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }
	
	
	public function actionUpload($id)
	{
		$model = new WhateverYourModel();

		$imageFile = UploadedFile::getInstance($model, 'image');

		$directory = Yii::getAlias('@frontend/web/img/temp') . DIRECTORY_SEPARATOR . Yii::$app->session->id . DIRECTORY_SEPARATOR;
		if (!is_dir($directory)) {
			FileHelper::createDirectory($directory);
		}

		if ($imageFile) {
			$uid = uniqid(time(), true);
			$fileName = $uid . '.' . $imageFile->extension;
			$filePath = $directory . $fileName;
			if ($imageFile->saveAs($filePath)) {
				$path = '/img/temp/' . Yii::$app->session->id . DIRECTORY_SEPARATOR . $fileName;
				return Json::encode([
					'files' => [
						[
							'name' => $fileName,
							'size' => $imageFile->size,
							'url' => $path,
							'thumbnailUrl' => $path,
							'deleteUrl' => 'image-delete?name=' . $fileName,
							'deleteType' => 'POST',
						],
					],
				]);
			}
		}

		return '';
	}

    /**
     * Finds the Atricles model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Atricles the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Atricles::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
