<?php

namespace frontend\components;

use Yii;
use yii\base\Widget;
use yii\helpers\Html;
use app\models\Orders;

class OrderForm extends Widget {

	public $service_id;

    public function init()
    {   
        parent::init();
    }

    public function run( )
    {   
		
		$orderModel = new Orders();
		$orderModel -> service_id = $this->service_id;
		
		
		if ($orderModel->load(Yii::$app->request->post())) {
			if ( $orderModel->save()){
				Yii::$app->session->setFlash('requestOrderFormSubmitted');
			}
			else {
				Yii::$app->session->setFlash('requestOrderFormFalse');
			}

		}
		
		
		return $this->render('order_form', [
		  'model'      => $orderModel
		]);
    }
}
?>