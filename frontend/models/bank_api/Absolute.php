<?php
namespace frontend\models;
use Yii;


class Absolute 
{

	public $sUrl;
	protected $auth_email;
	protected $auth_password;
	public $tokken;
	
	
	public function init() { 
	
		$this -> sUrl = 'https://api-ipoteka.project30.pro/api/v1/user_token';
		$this -> auth_email = 'account_most';
		$this -> auth_password = 'kdUIjd9wkjre';
		$this -> tokken = $this -> GetTokken();
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
		$result = file_get_contents($sURL, false, $context);	
		$arResult = json_decode( $result, JSON_UNESCAPED_UNICODE);
		return $arResult['result']['token'];
	
    }

}
