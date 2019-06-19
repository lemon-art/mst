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
use common\models\BitrixCrm;

/**
 * ServicesController implements the CRUD actions for Services model.
 */
class OrdersController extends Controller
{


	
	public function beforeAction($action)
	{

		
		if ($action->id == 'updatedeal') {
			Yii::$app->request->enableCsrfValidation = false;
			Yii::$app->request->enableCookieValidation = false;
			Yii::$app->request->enableCsrfCookie = false;	
		}
		return parent::beforeAction($action);
	}
	
	
	public function actionValidate()
    {
		$post = Yii::$app->request->post();
		
		//$post['service_id'] = 1;
		//$post['field'] = 'name';
		//$post['value'] = 'фвфывфывфыв';

		if ( $post['service_id'] ){
		
			switch ( $post['service_id'] ) {
				case 1:
					$model = new Kredit();
					$model->scenario="new";
					break;
				case 2:
					$model = new Ipoteka();
					$model->scenario="new";
					break;
				case 3:
					$model = new Debet();
					$model->scenario="new";
					break;
				case 4:
					$model = new Avtokredit();
					$model->scenario="new";
					break;	
				case 5:
					$model = new KreditKards();
					$model->scenario="new";
					break;
				case 6:
					$model = new DebetCards();
					$model->scenario="new";
					break;	
				case 7:
					$model = new Rko();
					$model->scenario="new";
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
	
	
	public function actionUpdatedeal()
    {
	
		$data = $_REQUEST;
		
		
		$title = 'incoming';

		$log = "\n------------------------\n"; 
		$log .= date("Y.m.d G:i:s") . "\n"; 
		$log .= (strlen($title) > 0 ? $title : 'DEBUG') . "\n"; 
		$log .= print_r( $data , 1); 
		$log .= count($data); 
		$log .= "\n------------------------\n"; 
		file_put_contents( getcwd() . '/hook.log', $log, FILE_APPEND); 
		
		
		/*
		$data = Array(
				'event' => 'ONCRMDEALUPDATE',
				'data' => Array	(
						'FIELDS' => Array('ID' => 85)
				),
				'auth' => Array(
						'application_token' => 'pvs0nmfo03y76yb6kb2be0e3zfajvexd'
				)

		);
		*/
		
		
		$crmModel = new BitrixCrm;
		$crmModel -> GetDealWebhook( $data );
		
		


       
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