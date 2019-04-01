<?php
namespace common\models;
use Yii;


class CuiteCrm 
{


	public $apiUrl;
	protected $api_key;
	public $name;
	public $phone;
	
	function __construct(){
	
		$this -> apiUrl = 'https://pbx117.asterisk-ip.ru/index.php?entryPoint=API';
		$this -> api_key = 'BAF632941EF8C29C90859BD8B422D911';

	}
	
	public function ShortRequest()
    {
		
		
	
		$body = Array( 
			"action" => "CallMe",
			"api_key" => $this -> api_key,
			"name" => $this -> name,
			"phone" => $this -> FormatePhone( $this -> phone )
		);
		
		
		$sPD = json_encode( $body, JSON_UNESCAPED_UNICODE);
		
		
		$aHTTP = array(
		  'http' => 
			array(
			'method'  => 'POST', 
			'header'  => Array('Content-type: application/json'),
			'content' => $sPD
		  )
		);
		
		$context = stream_context_create($aHTTP);
		$result = file_get_contents($this -> apiUrl, false, $context);	
		$arResult = json_decode( $result, JSON_UNESCAPED_UNICODE);
		file_put_contents($_SERVER['DOCUMENT_ROOT'] . '/log.txt', PHP_EOL . $this -> name . ' - ' . $arResult['status'], FILE_APPEND);

		
		return $arResult['status'];
	
    }
	
	public function FormatePhone( $phone ){
	
		$del = array("(", ")", " ", "-");
		$emp   = array("", "", "", "");
		 
		return str_replace($del, $emp, $phone);
	}

	
	

}
