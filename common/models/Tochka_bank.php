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
	
		$this -> apiUrl = 'https://open.tochka.com:3000/rest/v1/request/new';
		$this -> tokken   = '1mo75abav8m7sj8l4lm3a8p54prlqr35m';

	}
	
	

	
	public function Request( $orderModel )
    {

		$body = array(
			'inn' => $orderModel -> inn,
			'name' => $orderModel -> inn,
			'adrress' => $orderModel -> inn,
			'last_name' => $orderModel -> inn,
			'first_name' => $orderModel -> inn,
			'second_name' => $orderModel -> inn,
			'birthday' => $orderModel -> inn,
			'telephone' => $orderModel -> inn,
			'typeDoc' => $orderModel -> inn,
			'dateStart' => $orderModel -> inn,
			'serial' => $orderModel -> inn,
			'snils' => $orderModel -> inn,
			'comment' => $orderModel -> inn,
			'branch' => $orderModel -> inn,
			'acc_type' => $orderModel -> inn,
			'sex' => $orderModel -> inn,
		);
		$body = Array( 
			"token" => $this -> tokken,
			"request" => $body, 
			"workMode" => "0",
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
		$result = file_get_contents($sURL, false, $context);	
		$arResult = json_decode( $result, JSON_UNESCAPED_UNICODE);
		
		
		return $arResult['data'];
	
    }

}
