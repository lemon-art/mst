<?php
namespace common\models;
use Yii;


class Tochka-bank 
{

	public $authUrl;
	public $apiUrl;
	protected $auth_email;
	protected $auth_password;
	protected $tokken;
	protected $authUser;
	
	function __construct(){
	
		$this -> authUrl = 'https://api-ipoteka.project30.pro/api/v1/user_token';
		$this -> apiUrl = 'https://inbox.project30.pro/api/v1/requests.json';
		$this -> auth_email = 'account_most';
		$this -> auth_password = 'kdUIjd9wkjre';
		
		$this -> GetTokken();

	}
	
	

	protected function GetTokken()
    {

		$body = Array( 
			"auth" => Array(
				"email" => $this -> auth_email,
				"password" => $this -> auth_password
			)
		);
		$sPD = json_encode( $body, JSON_UNESCAPED_UNICODE);
		
		$aHTTP = array(
		  'http' => 
			array(
			'method'  => 'POST', 
			'header'  => 'Content-type: application/json',
			'content' => $sPD
		  )
		);
		$context = stream_context_create($aHTTP);
		$result = file_get_contents($this -> authUrl, false, $context);	
		$arResult = json_decode( $result, JSON_UNESCAPED_UNICODE);
		
		$this -> tokken   = $arResult['result']['token'];
		$this -> authUser = $arResult['result']['user'];
		
		
		return true;
	
    }
	
	public function Request( $orderModel )
    {

		
		$body = array(
		    'request' => array (
				'calculation_attributes' =>	array(
					'credit_type'  		=> 'mortgage_new', 
					'apartment_price'   => $orderModel -> summ,
					'initial_fee'   	=> $orderModel -> initial_payment,
					'credit_term'   	=> $orderModel -> term,
					"partner_id"    	=> $this -> authUser['partner_id'],
                    "customer_type" 	=> "self_employed",
                    "services" => array (
                        "proof_of_income"  => "ndfl2",
                        "insurance_scheme" => "collective"
                    )

				),
				'external_data_attributes' => array (
					'partner_manager_contact' => array (
						'fio'  		=> $orderModel -> last_name . ' ' . $orderModel -> name . ' ' . $orderModel -> second_name, 
						'email'     => $orderModel -> email,
						'phone'   	=> $orderModel -> phone,
					)
				)
			)
		);
		$sPD = json_encode( $body, JSON_UNESCAPED_UNICODE);
		
		
		$aHTTP = array(
		  'http' => 
			array(
			'method'  => 'POST', 
			'header'  => Array('Content-type: application/json', 'Authorization: Bearer ' . $this -> tokken),
			'content' => $sPD
		  )
		);
		
		$context = stream_context_create($aHTTP);
		
		
		$result = file_get_contents($this -> apiUrl, false, $context);	
		$arResult = json_decode( $result, JSON_UNESCAPED_UNICODE);
		
		
		return $arResult['id'];
	
    }

}
