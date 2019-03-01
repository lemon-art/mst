<?php

namespace backend\controllers;

use Yii;
use backend\models\Offers;
use backend\models\OffersSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use backend\models\Files;
use yii\web\UploadedFile;
use backend\models\Tools;
/**
 * OffersController implements the CRUD actions for Offers model.
 */
class OffersController extends Controller
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
     * Lists all Offers models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new OffersSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Offers model.
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
     * Creates a new Offers model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
	public function actionCreate()
    {
        $model = new Offers();

        if ($model->load(Yii::$app->request->post())) {
		
			$file = UploadedFile::getInstance($model, 'image');
			$upFile = new Files;	
			if ( $file ){
				$model->image = $upFile -> upload( $file );
			}
			
			$arFields = Array('min_summ', 'max_summ', 'depozit_summ', 'min_summ_kreditcard', 'max_summ_kreditcard', 'min_summ_ipoteka', 'max_summ_ipoteka');
			foreach ( $arFields as $field ){
				$model->$field = Tools::numUpdate($model->$field);
			}

			$model->save();
		
			
		
		
            return $this->redirect(['index']);
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing Offers model.
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
			
			$arFields = Array('min_summ', 'max_summ', 'depozit_summ', 'min_summ_kreditcard', 'max_summ_kreditcard', 'min_summ_ipoteka', 'max_summ_ipoteka');
			foreach ( $arFields as $field ){
				$model->$field = Tools::numUpdate($model->$field);
			}
			
			$model->save();
            return $this->redirect(['index']);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing Offers model.
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
     * Finds the Offers model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Offers the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Offers::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
