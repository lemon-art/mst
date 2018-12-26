<?php

namespace frontend\controllers;

use Yii;
use app\models\Orders;
use app\models\Ipoteka;
use app\models\Kredit;
use app\models\Debet;
use app\models\Avtokredit;
use app\models\KreditKards;
use app\models\DebetCards;
use yii\web\Controller;
use yii\widgets\ActiveForm;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
/**
 * ServicesController implements the CRUD actions for Services model.
 */
class OrdersController extends Controller
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
	
	
	public function actionValidate()
    {
		$post = Yii::$app->request->post();
		

		switch ( $post['service_id'] ) {
			case 1:
				$model = new Kredit();
				break;
			case 2:
				$model = new Ipoteka();
				break;
			case 3:
				$model = new Debet();
				break;
			case 4:
				$model = new Avtokredit();
				break;	
			case 5:
				$model = new KreditKards();
				break;
			case 6:
				$model = new DebetCards();
				break;	
		}
		
		$arField = explode('-', $post['field']);
		$model -> $arField[1] = $post['value'];
		$arValidate = ActiveForm::validate($model, $arField[1]);
		echo json_encode( $arValidate );

		
		//Yii::$app->response->format = Response::FORMAT_JSON;
		//return $arValidate;

        
    }



}