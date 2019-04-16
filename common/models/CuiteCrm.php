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
	
	public function LongRequest( $arFields )
    {
		
		
	
		$body = Array( 
			"api_key" => $this -> api_key,
		);

		$body = array_merge($body, $arFields);
		
		
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
		if ( isset($arResult['message']) ){
			file_put_contents($_SERVER['DOCUMENT_ROOT'] . '/log.txt', PHP_EOL . $arFields["name"] . ' - ' . $arFields["action"] . ' - ' . $arResult['status']. ' - ' . $arResult['message'], FILE_APPEND);
		}
		else {
			file_put_contents($_SERVER['DOCUMENT_ROOT'] . '/log.txt', PHP_EOL . $arFields["name"] . ' - ' . $arResult['status'], FILE_APPEND);
		}
		
		return $arResult['status'];
	
    }
	
	
	
	public function FormatePhone( $phone ){
	
		$del = array("(", ")", " ", "-");
		$emp   = array("", "", "", "");
		 
		return str_replace($del, $emp, $phone);
	}
	
	public function FormateDate( $date ){
	
		$bithday = \DateTime::createFromFormat('d.m.Y', $date );
		return $bithday->format('Y-m-d'); 
	}

	public function GetListValue( $value ){
	
		$arFields = Array(
			'Ремонт' => 'Remont',
			'Погашение кредитов' => 'PogashenieCredit',
			'Учеба' => 'Ucheba',
			'Развитие бизнеса' => 'RazvitieBiznesa',
			'Лечение' => 'Lechenie',
			'Погашение долгов (не кредиты)' => 'PogashenieDolgov',
			'Шоппинг' => 'Shopping',
			'Путешествие' => 'Putishestvie',
			'Торжество' => 'Torzhestvo',
			'Помощь близким' => 'PomoshBlizkim',
			'Иное' => 'Inoe',
			'Работа по найму' => 'RabotaPoNaimu',
			'Индивидуальный предприниматель' => 'IP',
			'Пенсионер' => 'Pensioner',
			'Военный' => 'Voenni',
			'Не работаю' => 'NeRabotau',
			'Горнодобывающая промышленность' => '1',
			'Государственное, муниципальное управление' => '2',
			'Здравоохранение, социальные услуги' => '3',
			'Культура, искусство, спортивная деятельность' => '4',
			'Оборона, правоохранительные органы' => '5',
			'Обрабатывающая промышленность (производство)' => '6',
			'Профессиональная, научная, техническая деятельность' => '7',
			'Сельское хозяйство, рыболовство, охота, лесоводство' => '8',
			'Сфера торговли, услуг, связи' => '9',
			'Транспорт' => '10',
			'Финансовая деятельность, страхование' => '11',
			'Иное' => '12',
			'Руководитель организации' => '1',
			'Руководитель подразделения' => '2',		
			'Неруководящий сотрудник - специалист' => '3',
			'Неруководящий сотрудник - обсл. персонал' => '4',	
			'Мой номер' => '1',
			'Номер родственника' => '2',	
			'Номер друга' => '3',
			'Начальное, среднее' => '1',	
			'Неполное высшее' => '2',
			'Высшее' => '3',		
			'Второе высшее' => '4',
			'Ученая степень' => '5',	
		
		);
		
		if ( $arFields[$value] ){
			return $arFields[$value];
		}
		else {
			return false;
		}
		
	}
	

}
