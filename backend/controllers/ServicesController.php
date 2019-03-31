<?php

namespace backend\controllers;

use Yii;
use backend\models\Services;
use backend\models\Files;
use yii\data\ActiveDataProvider;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\UploadedFile;
/**
 * ServicesController implements the CRUD actions for Services model.
 */
class ServicesController extends Controller
{
    /**
     * {@inheritdoc}
     */
	public $enableCsrfValidation = false;  
	 
	 
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
     * Lists all Services models.
     * @return mixed
     */
    public function actionIndex()
    {
        $dataProvider = new ActiveDataProvider([
            'query' => Services::find(),
        ]);

        return $this->render('index', [
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Services model.
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
     * Creates a new Services model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Services();

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
     * Updates an existing Services model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        $image = $model->image;
		$big_image = $model->big_image;
		$text_main_img = $model->text_main_img;
		
		
        if ($model->load(Yii::$app->request->post())) {
		
			
			
			$file1 = UploadedFile::getInstance($model, 'image');
			$upFile = new Files;	
			if ( $image && $file1 ){
				$upFile -> deleteFile( $image );
			}
			if ( $file1 ){
				$model->image = $upFile -> upload( $file1 );
			}			
			elseif( $image ) {
				$model->image = $image;
			}
			
			$file2 = UploadedFile::getInstance($model, 'big_image');
			$upFile = new Files;	
			if ( $big_image && $file2 ){
				$upFile -> deleteFile( $big_image );
			}
			if ( $file2 ){
				$model->big_image = $upFile -> upload( $file2 );
			}			
			elseif( $big_image ) {
				$model->big_image = $big_image;
			}
			
			$file3 = UploadedFile::getInstance($model, 'text_main_img');
			$upFile = new Files;	
			if ( $text_main_img && $file3 ){
				$upFile -> deleteFile( $text_main_img );
			}
			if ( $file3 ){
				$id = $upFile -> upload( $file3 );
				$model->text_main_img = $id;
			}			
			elseif( $text_main_img ) {
				$model->text_main_img = $text_main_img;
			}
			
			 
			
			$model->save();
            return $this->redirect(['index']);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing Services model.
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

    /**
     * Finds the Services model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Services the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Services::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
