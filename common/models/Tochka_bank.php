<?php
namespace common\models;
use Yii;


class Tochka_bank 
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

		$arPasport = explode(' ', $orderModel -> sn); 
		$bithday  = \DateTime::createFromFormat('d.m.Y', $orderModel -> bithday);
		$dateStart = \DateTime::createFromFormat('d.m.Y', $orderModel -> issuedate);
	
		$body = array(
			'inn' => $orderModel -> inn,
			'name' => $orderModel -> company_name,
			'adrress' => $orderModel -> address,
			'last_name' => $orderModel -> last_name,
			'first_name' => $orderModel -> name,
			'second_name' => $orderModel -> second_name,
			'birthday' => $bithday->format('Y-m-d'),
			'telephone' => $orderModel -> phone,
			'typeDoc' => '21',
			'dateStart' => '2015-02-02',
			'serial' => $arPasport[0].$arPasport[1],
			'number' => $arPasport[2],
			'snils' => $orderModel -> snils,
			'comment' => '',
			'branch' => 'open',
			'acc_type' => $orderModel -> form,
			'sex' => 'M',
		);
		$body = Array( 
			"token" => $this -> tokken,
			"request" => $body, 
			"workMode" => "1",
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
		$result = file_get_contents($this -> apiUrl, false, $context);	
		$arResult = json_decode( $result, JSON_UNESCAPED_UNICODE);
		
		
		return $arResult['data'];
	
    }

}
