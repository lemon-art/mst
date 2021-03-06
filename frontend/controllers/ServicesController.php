<?php

namespace frontend\controllers;

use app\models\OffersCreditSearch;
use app\models\OffersCreditcardsSearch;
use app\models\OffersAutocreditSearch;
use app\models\OffersDebetcardsSearch;
use app\models\OffersDepositSearch;
use app\models\OffersIpotekaSearch;
use app\models\OffersRkoSearch;
use backend\models\CreditFilter;
use Yii;
use app\models\Services;
use app\models\ServicesSearch;
use yii\data\Pagination;
use yii\data\ActiveDataProvider;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use app\models\OffersSearch;
use frontend\components\ShortTag;
/**
 * ServicesController implements the CRUD actions for Services model.
 */
class ServicesController extends Controller
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
     * Lists all Services models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new ServicesSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Services model.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($code)
    {
		
		$model = Services::findOne(['code' => $code]);
		if ( !$model )
			throw new NotFoundHttpException;

        $filter = '';
        $often_seek = '';
        
        if ($model->id == 1) {
            $offersModel    = new OffersCreditSearch();
            $offersProvider = $offersModel->searchByService();
            $often_seek = CreditFilter::find()->all();
            
        } else if ($model->id == 5) {
            $offersModel    = new OffersCreditcardsSearch();
            $offersProvider = $offersModel->searchByService();
        } else if ($model->id == 4) {
            $offersModel    = new OffersAutocreditSearch();
            $offersProvider = $offersModel->searchByService();
        } else if ($model->id == 2) {
            $offersModel    = new OffersIpotekaSearch();
            $offersProvider = $offersModel->searchByService();
        } else if ($model->id == 3) {
            $offersModel    = new OffersDepositSearch();
            $offersProvider = $offersModel->searchByService();
        } else if ($model->id == 6) {
            $offersModel    = new OffersDebetcardsSearch();
            $offersProvider = $offersModel->searchByService();
        } else if ($model->id == 7) {
            $offersModel    = new OffersRkoSearch();
            $offersProvider = $offersModel->searchByService();
        } else {
            $offersModel    = new OffersSearch();
            $offersProvider = $offersModel->searchByService( $model->id );
        }

        //шорт теги
        $model->title = ShortTag::cityTag($model->title);
        $model->description = ShortTag::cityTag($model->description);
        $model->name = ShortTag::cityTag($model->name);
        $model->top_text = ShortTag::cityTag($model->top_text);
        $model->text_main = ShortTag::cityTag($model->text_main);
        $model->scheme = ShortTag::cityTag($model->scheme);
        $model->advantages = ShortTag::cityTag($model->advantages);
        $model->short_name = ShortTag::cityTag($model->short_name);
        $model->title_main = ShortTag::cityTag($model->title_main);
        $model->preview_text_main = ShortTag::cityTag($model->preview_text_main);
        $model->text_main_title = ShortTag::cityTag($model->text_main_title);
        $model->text_main_text = ShortTag::cityTag($model->text_main_text);
        $model->seo_text_preview = ShortTag::cityTag($model->seo_text_preview);
        $model->seo_text_detail = ShortTag::cityTag($model->seo_text_detail);
        
		return $this->render('view', [
            'model' => $model,
			'offersProvider' => $offersProvider,
            'often_seek' => $often_seek,
            'filter' => $filter
        ]);
    }
	
	public function actionSpecindex( )
    {
		
		$searchModel = new ServicesSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
		
		$offersModel    = new OffersSearch();
		$offersProvider = $offersModel->searchSpecial( );
		
		
		return $this->render('specindex', [
            'dataProvider' => $dataProvider,
			'offersProvider' => $offersProvider
        ]);
    }
	

	public function actionSpecoffers( $code )
    {
		$searchModel = new ServicesSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
		
		$model = Services::findOne(['code' => $code]);
		if ( !$model )
			throw new NotFoundHttpException;
		
		$offersModel    = new OffersSearch();
		$offersProvider = $offersModel->searchSpecialByService( $model->id );
		
		
		return $this->render('specindex', [
            'code' => $code,
			'dataProvider' => $dataProvider,
			'offersProvider' => $offersProvider
        ]);
    }
    /**
     * Creates a new Services model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {

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
