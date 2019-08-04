<?php
namespace frontend\controllers;

use backend\models\CreditFilter;
use Yii;
use app\models\Services;
use app\models\ServicesSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use app\models\OffersSearch;

class CreditController extends Controller
{

    
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


    public function actionView($code)
    {

        $model = Services::findOne(['code' => 'credit']);
        if ( !$model )
            throw new NotFoundHttpException;

        $credit_filter = CreditFilter::findOne(['code' => $code]);
        if ( !$credit_filter )
            throw new NotFoundHttpException;

        $offersModel    = new OffersSearch();
        $offersProvider = $offersModel->searchByService(1);
        $often_seek = CreditFilter::find()->all();


        return $this->render('view', [
            'model' => $model,
            'offersProvider' => $offersProvider,
            'often_seek' => $often_seek,
        ]);
    }
}