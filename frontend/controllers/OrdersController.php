<?php

namespace frontend\controllers;

use Yii;
use app\models\Orders;
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
		

		
		$arField = explode('-', $post['field']);
        $model = new Orders;
		$model -> $arField[1] = $post['value'];
		$arValidate = ActiveForm::validate($model, $arField[1]);
		echo json_encode( $arValidate );

		
		//Yii::$app->response->format = Response::FORMAT_JSON;
		//return $arValidate;

        
    }



}