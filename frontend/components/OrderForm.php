<?php

namespace frontend\components;

use Yii;
use yii\db\Transaction;
use yii\base\Widget;
use yii\helpers\Html;
use app\models\Orders;
use app\models\Kredit;
use app\models\Ipoteka;
use app\models\Debet;
use app\models\Rko;
use app\models\DebetCards;
use app\models\Avtokredit;
use app\models\KreditKards;
use app\models\LostOrders;
use dektrium\user\models\RegistrationForm;
use dektrium\user\models\LoginForm;
use dektrium\user\models\Profile;
use backend\models\Mailer;
use common\models\Api;
use common\models\ApiEvents;

class OrderForm extends Widget {

	public $service_id;
	public $service_name;
	



    public function init()
    {   
        parent::init();
    }

    public function run( )
    {   
	
		
		switch ( $this->service_id ) {
			case 1:
				$orderModel = new Kredit();
				$orderModel->scenario="new";
				$formView = 'order_form';
				break;
			case 2:
				$orderModel = new Ipoteka();
				$orderModel->scenario="new";
				$formView = 'ipoteka_form';
				break;			
			case 3:
				$orderModel = new Debet();
				$orderModel->scenario="new";
				$formView = 'debet_form';
				break;
			case 4:
				$orderModel = new Avtokredit();
				$orderModel->scenario="new";
				$formView = 'avtokredit_form';
				break;	
			case 5:
				$orderModel = new KreditKards();
				$orderModel->scenario="new";
				$formView = 'kredit_kards_form';
				break;	
			case 6:
				$orderModel = new DebetCards();
				$orderModel->scenario="new";
				$formView = 'debet_kards_form';
				break;	
			case 7:
				$orderModel = new Rko();
				$orderModel->scenario="new";
				$formView = 'rko_form';
				break;	
				
		}
		
		
		$orderModel -> service_id = $this->service_id;
		
		
		if ($orderModel->load(Yii::$app->request->post()) && $orderModel->validate()) {
		
			$haveUserProfile = false;
	
			if ( Yii::$app->user->isGuest){
				

				//регистрируем пользователя
				$modelUser = Yii::createObject(RegistrationForm::className());
				$password = $this -> generateRandomString();
				$modelUser -> email    = $orderModel -> email;
				$modelUser -> password = $password;
				if ( $modelUser -> register()){
				
					//авторизуем пользователя
					$newUser = \Yii::createObject(LoginForm::className());
					$newUser -> login = $orderModel -> email;
					$newUser -> password = $password;
					$newUser -> login();
					
					$user_id = \Yii::$app->user->identity->id;
				
				}
				else {
					echo 'Ошибка регистрации.<br>';
					
					
				}

			}
			else {
				$user_id = \Yii::$app->user->identity->id;
				
				if ( Profile::find()->where(['user_id' => $user_id])->one() ){
					$haveUserProfile = true;
				}
				
				
			}
			
			if ( !$haveUserProfile ){		//сохраняем профиль
			
					//заполняем профиль
					$profileUser = \Yii::createObject(Profile::className());
					$profileUser = Profile::find()->where(['user_id' => $user_id])->one();
					$profileUser -> name = $orderModel -> name;
					$profileUser -> last_name = $orderModel -> last_name;
					$profileUser -> second_name = $orderModel -> second_name;
					$profileUser -> phone = $orderModel -> phone;
					$profileUser -> email = $orderModel -> email;
					$profileUser -> public_email = $orderModel -> email;
					
					if ( isset( $orderModel -> bithday )){
						$bithday = \DateTime::createFromFormat('d.m.Y', $orderModel -> bithday);
						$profileUser -> bithday = $bithday->format('Y-m-d');
						
					}
					
					if ( isset( $orderModel -> issuedate )){
						$issuedate = \DateTime::createFromFormat('d.m.Y', $orderModel -> issuedate);
						$profileUser -> issueDate = $issuedate->format('Y-m-d');
						
						$registrationdate = \DateTime::createFromFormat('d.m.Y', $orderModel -> registrationdate);
						$profileUser -> registrationDate = $issuedate->format('Y-m-d');
						
						$profileUser -> birthPlace = $orderModel -> birthplace;
						$profileUser -> sn = $orderModel -> sn;
						$profileUser -> issueCode = $orderModel -> issuecode;
						$profileUser -> issuer = $orderModel -> issuer;
						$profileUser -> address = $orderModel -> address;
						$profileUser -> registrationPhone = $orderModel -> registrationphone;
					}
					
					$profileUser -> save();
			
			}
			
			
			
			$orderModel->user_id = $user_id;
		
			if ( $orderModel->save()){
			
				$order = new Orders();
				$order -> order_id = $orderModel -> id;
				$order -> user_id = $user_id;
				$order -> service_id = $this->service_id;
				$order -> save();
			
				Yii::$app->session->setFlash('requestOrderFormSubmitted');
				
				//удаляем незаполненную заявку
				if ( $orderModel -> secret_key ){
					$lostModel = LostOrders::getModelByKey( $orderModel -> secret_key );
					if ( $lostModel )
						$lostModel -> delete();
				}
				

				
				
				
				
				//отправляем заявки в банки
				/*
				$arBanks = Api::GetServiceBanks( $this->service_id );
				foreach ( $arBanks as $arBank){
					$objApi = Api::build( $arBank['banks']['code'] );
					$id_request = $objApi -> Request( $orderModel );
					
					$objEvent = new ApiEvents;
					$objEvent -> order_id 	= $orderModel -> id;
					$objEvent -> request_id = $id_request;
					$objEvent -> bank_id 	= $arBank['banks']['id'];
					$objEvent -> status 	= 'Заявка отправлена';
					$objEvent -> save();
				}
				*/
				
				Mailer::sendUserOrderMessage( 'Заявка на ' . $this->service_name, $orderModel, $this->service_name, $this->service_id );
				
				
			}
			else {
				Yii::$app->session->setFlash('requestOrderFormFalse');
			}

		}
		
		//получаем профиль авторизованного пользователя
		if ( !Yii::$app->user->isGuest){
			$user_id = $user_id = \Yii::$app->user->identity->id;
			$profileUser = Profile::find()->where(['user_id' => $user_id])->one();
			
			$profileUser->bithday = Yii::$app->formatter->asDate($profileUser->bithday, 'php:d.m.Y');
			$profileUser->issueDate = Yii::$app->formatter->asDate($profileUser->issueDate, 'php:d.m.Y');
			$profileUser->registrationDate = Yii::$app->formatter->asDate($profileUser->registrationDate, 'php:d.m.Y');
			
			return $this->render( $formView, [
				'model'      	=> $orderModel,
				'profileUser'   => $profileUser
			]);
		}
		else {
			return $this->render($formView, [
				'model'      	=> $orderModel
			]);
		}
		
		
		
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