<?php

namespace frontend\controllers;

use Yii;
use app\models\Orders;
use app\models\Ipoteka;
use app\models\Kredit;
use app\models\Debet;
use app\models\Rko;
use app\models\Avtokredit;
use app\models\KreditKards;
use app\models\DebetCards;
use app\models\LostOrders;
use yii\web\Controller;
use yii\widgets\ActiveForm;

/**
 * ServicesController implements the CRUD actions for Services model.
 */
class OrdersController extends Controller
{


	
	
	public function actionValidate()
    {
		$post = Yii::$app->request->post();
		
		//$post['service_id'] = 7;
		//$post['field'] = 'rko-inn';
		//$post['value'] = '123';

		if ( $post['service_id'] ){
		
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
				case 7:
					$model = new Rko();
					break;	
			}
			
			$arField = explode('-', $post['field']);

			$model -> $arField[1] = $post['value'];
			$arValidate = ActiveForm::validate($model, $arField[1]);
			return $this->renderPartial('validate', [
				'result' => json_encode( $arValidate )
			]);
			//echo json_encode( $arValidate );
		}

		
		//Yii::$app->response->format = Response::FORMAT_JSON;
		//return $arValidate;

        
    }
	
	

	public function actionSavelostorder()
    {
		$post = Yii::$app->request->post();

		$model = LostOrders::getModelByKey( $post['secret_key'] );
		if ( !$model )
			$model = new LostOrders();
			
		$model -> name  = $post['name'];
		$model -> phone = $post['phone'];
		$model -> service_id = $post['service_id'];
		$model -> secret_key = $post['secret_key'];
		$model -> send = 0;
		$model -> active = 0;
		$model -> save();
		return $this->renderPartial('validate', [
			'result' => ''
		]);
	}
	
	public function actionUpdatelostorder()
    {

		$model = LostOrders::getNoactive();

	}
	
	public function actionActivatelostorder( $code )
    {

		$model = LostOrders::addLostOrder( $code );

	}
}