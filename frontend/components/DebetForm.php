<?php

namespace frontend\components;

use Yii;
use yii\db\Transaction;
use yii\base\Widget;
use yii\helpers\Html;
use app\models\Debet;
use dektrium\user\models\RegistrationForm;
use dektrium\user\models\LoginForm;
use dektrium\user\models\Profile;
use backend\models\Mailer;

class DebetForm extends Widget {

	public $service_id;
	public $service_name;
	



    public function init()
    {   
        parent::init();
    }

    public function run( )
    {   
		
		$orderModel = new Debet();
		$orderModel -> service_id = $this->service_id;



		if ($orderModel->load(Yii::$app->request->post())) {

			if (Yii::$app->user->isGuest){

				//регистрируем пользователя
				$modelUser = \Yii::createObject(RegistrationForm::className());
				$password = $this -> generateRandomString();
				$modelUser -> email    = $orderModel -> email;
				$modelUser -> password = $password;
				if ( $modelUser -> register()){

					//авторизуем пользователя
					$newUser = \Yii::createObject(LoginForm::className());
					$newUser -> login = $orderModel -> email;
					$newUser -> password = $password;
					$newUser -> login();

					$user_id = Yii::$app->user->identity->id;
					$orderModel -> user_id = $user_id;

					//заполняем профиль
					$profileUser = \Yii::createObject(Profile::className());
					$profileUser = Profile::find()->where(['user_id' => $user_id])->one();
					$profileUser -> name = $orderModel -> name;
					$profileUser -> last_name = $orderModel -> last_name;
					$profileUser -> second_name = $orderModel -> second_name;
					$profileUser -> phone = $orderModel -> phone;
					$profileUser -> email = $orderModel -> email;
					$profileUser -> save();



				}

			}



			if ( $orderModel->save()){
				Yii::$app->session->setFlash('requestOrderFormSubmitted');

				Mailer::sendUserOrderMessage( 'Заявка на ' . $this->service_name, $orderModel, $this->service_name );
				Mailer::sendAdminOrderMessage( 'Новая заявка: ' . $this->service_name, $orderModel );
			}
			else {
				Yii::$app->session->setFlash('requestOrderFormFalse');
			}

		}


		return $this->render('debet_form', [
		  'model'      => $orderModel
		]);
    }
	
	function generateRandomString($length = 10) {

		$characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
		$charactersLength = strlen($characters);
		$randomString = '';
		for ($i = 0; $i < $length; $i++) {
			$randomString .= $characters[rand(0, $charactersLength - 1)];
		}
		return $randomString;
	}
	
	
}
?>