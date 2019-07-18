<?php
namespace common\models;
use Yii;


class Vostbank 
{

	public $authUrl;
	public $apiUrl;
	protected $auth_email;
	protected $auth_password;
	protected $tokken;
	protected $authUser;
	
	function __construct(){
	
		$this -> apiUrl = 'https://www.vostbank.ru/s/credit_pb/';
		$this -> apiKey   = '136f71f3-4064-4a01-9b95-df71c86cf350';
		$this -> apiShortKey   = 'M7jb6zZQjCPnSBSZ';

	}
	
	

	
	public function Request( $orderModel )
    {

		$bithday  = \DateTime::createFromFormat('d.m.Y', $orderModel -> bithday);

	
		$body = array(
			'request_id' => $orderModel -> id,
			'request_type' => 'TEST',
			'summ' => $orderModel -> summ,
			'initial_payment' => 0,
			'period' => $orderModel -> term,
			'full_name' => $orderModel -> last_name . ' ' . $orderModel -> name . ' ' . $orderModel -> second_name,
			'date_time' => date('Y-m-d'),
			'telephone' => $orderModel -> phone,
			'email' => $orderModel -> email,
			'source' => 'test_request',
		);
		
		//получаем хеш
		$str = '';
		foreach ( $body as $value){
			$str += $value;
		}
		$str += $this -> apiShortKey;
		$h = md5($str);
		$body['h']	= $h;
		$body['birthdate']	= $bithday->format('Y-m-d');
		$body['apikey']	= $this -> apiKey;
		
		
		/*
		$sPD = http_build_query( $body );
		
		echo $sPD;
		
		$aHTTP = array(
		  'http' => 
			array(
			'method'  => 'POST', 
			'header'  => 'Content-type: application/x-www-form-urlencoded',
			'content' => $sPD
		  )
		);
		$context = stream_context_create($aHTTP);
		$result = file_get_contents($this -> apiUrl, false, $context);	
		$arResult = '';
		*/
		$sPD = http_build_query( $body );
		$cityUrl = $this -> apiUrl;
		//$cityUrl .= '?' . $sPD;
		
		$ch = curl_init();  
		curl_setopt($ch, CURLOPT_URL, $cityUrl);
		curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'POST');
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
		curl_setopt($ch, CURLOPT_HEADER,0);
		curl_setopt($ch, CURLOPT_HTTPHEADER, Array('cache-control: no-cache', 'content-type: application/x-www-form-urlencoded'));
		curl_setopt($ch, CURLOPT_AUTOREFERER, true );
		curl_setopt( $ch, CURLOPT_FOLLOWLOCATION, true );
		curl_setopt( $ch, CURLOPT_ENCODING, "" );
		curl_setopt($ch, CURLOPT_POST, true);
		curl_setopt($ch, CURLOPT_POSTFIELDS, $sPD);
		curl_setopt( $ch, CURLOPT_RETURNTRANSFER, true );
		curl_setopt($ch, CURLOPT_TIMEOUT, 10);
		echo $res = curl_exec ($ch);
		
		$arCulrResult = json_decode(curl_exec ($ch));
		
		

		echo "<pre>";
		print_r( $arCulrResult );
		echo "</pre>---";

        if (curl_errno($ch)) {
            echo "Error: " . curl_error($ch);
        } else {
            // Show me the result
           echo 'ok';
        }
		curl_close($ch);
		
		
		
		return $arCulrResult;
	
    }

}
