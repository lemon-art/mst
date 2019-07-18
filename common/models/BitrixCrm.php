<?php
namespace common\models;
use Yii;
use yii\db\Transaction;
use yii\base\Widget;
use yii\helpers\Html;
use app\models\Orders;
use app\models\Ipoteka;
use app\models\Kredit;
use app\models\Debet;
use app\models\Rko;
use app\models\Avtokredit;
use app\models\KreditKards;
use app\models\DebetCards;
use dektrium\user\models\RegistrationForm;
use dektrium\user\models\LoginForm;
use dektrium\user\models\Profile;

class BitrixCrm 
{

	protected $apiUrl;
	public $name;
	public $phone;
	public $dealId;
	public $contactId;
	public $dealAuthKey;
	public $arAllFields;
	
	function __construct(){
	
		$this -> apiUrl = 'https://crm.most-st.ru/rest/1/qc7kordhkd9nfgj0/';
		$this -> dealAuthKey = Array('pvs0nmfo03y76yb6kb2be0e3zfajvexd', '4x0sbz4ieb7uey1o9qn0fuk2z69hzyqp');
		
		

	}
	
	public function ShortRequest()
    {
		
		$arFields = Array();
		$arFields['TITLE'] = 'Короткая заявка (MarketVibor)';
		$arFields['NAME'] = $this -> name;	
		$arFields['PHONE']['n1'] = array("VALUE"=>$this -> FormatePhone( $this -> phone ), "VALUE_TYPE"=>"WORK");
		$contactId = $this -> AddLead( $arFields );	
	
    }
	
	public function LongRequest( $arFields ) 
    {
		
		$this -> dealId = $this -> AddDeal( $arFields );	
		
		if ( !$this -> FindContact($arFields['PHONE']) ){	//проверяем контакт по телефону
			$this -> contactId = $this -> AddContact( $arFields );	
		}

		
		$this -> AddContactToDeal();
		
	
    }
	
	public function AddLead( $arFields ){
	
			$qr = array(
				'fields' => array(),
				'params' => array()
			);
			$qr['fields'] = $arFields;
			$qr['fields']['OPENED'] = 'Y'; 
			$qr['fields']['ASSIGNED_BY_ID'] = 1; 
			
			
			$result = $this -> SendRequest( $qr, 'crm.lead.add.json' );
			$contactId = $result["result"];
		
			
			return $contactId;
	
	}
	
	public function AddContact( $arFields ){
	
			$qr = array(
				'fields' => array(),
				'params' => array()
			);
			$phone = $arFields['PHONE'];
			$arFields['PHONE'] = Array();
			$arFields['PHONE'][] = array("VALUE"=>$this -> FormatePhone( $phone ), "VALUE_TYPE"=>"WORK");
			
			$email = $arFields['EMAIL'];
			$arFields['EMAIL'] = Array();
			$arFields['EMAIL'][] = array("VALUE"=> $email, "VALUE_TYPE"=>"WORK");
			
			$qr['fields'] = $arFields;
			$qr['fields']['OPENED'] = 'Y'; 
			$qr['fields']['ASSIGNED_BY_ID'] = 1; 
			
			
			$result = $this -> SendRequest( $qr, 'crm.contact.add.json' );
			$contactId = $result["result"];
		
			
			return $contactId;
	
	}
	
	
	public function FindContact( $phone ){
	
			$qr = array(
				'filter' => array('PHONE' => $this -> FormatePhone( $phone )),
				'select' => array('ID')
			);
	
			$result = $this -> SendRequest( $qr, 'crm.contact.list' );
			if ( count(  $result["result"] ) > 0 ){
				$this -> contactId = $result["result"][0]["ID"];
				return $this -> contactId;
			}
			else {
				return false;
			}
	}
	
	public function AddDeal( $arFields ){
	
			$qr = array(
				'fields' => array(),
				'params' => array()
			);
			$qr['fields'] = $arFields;
			$qr['fields']['OPENED'] = 'Y'; 
			$qr['fields']['ASSIGNED_BY_ID'] = 23; 
			$qr['params']['REGISTER_SONET_EVENT'] = 'Y'; 
			
			$result = $this -> SendRequest( $qr, 'crm.deal.add.json' );
			$dealID = $result["result"];
			
			return $dealID;
	
	}
	
	public function GetDeal( $id ){
	
			$qr = array(
				'id' => $id
			);
			$result = $this -> SendRequest( $qr, 'crm.deal.get' );
			return $result["result"];
	
	}
	
	
	public function AddContactToDeal( ){
	

			$qr = array(
				'id' => $this -> dealId,
				'fields' => array()
			);
			$qr['fields']['CONTACT_ID'] = $this -> contactId;
			
			
			$result = $this -> SendRequest( $qr, 'crm.deal.contact.add.json' );
			
			return $result["result"];
			
	
	}
	
	public function GetContact( $id ){
	

		
			$qr = array(
				'id' => $id
			);
			$result = $this -> SendRequest( $qr, 'crm.contact.get' );
			return $result["result"];
			
	
	}
	
	public function SaveCrmContact( $id, $arFields ){
	
			$qr = array(
				'id' => $id,
				'fields' => $arFields
			);
			$result = $this -> SendRequest( $qr, 'crm.contact.update' );
			return $result["result"];
	
	}
	
	public function SaveCrmDeal( $id, $arFields ){
	
			$qr = array(
				'id' => $id,
				'fields' => $arFields
			);
			$result = $this -> SendRequest( $qr, 'crm.deal.update' );
			return $result["result"];
	
	}
	
	public function MakeContact( $id ){
	
			$arContact = $this ->  GetContact( $id );
			
			$phone = '';
			$email = '';
			
			if ( isset($arContact['EMAIL'][0]['VALUE']) ){
				$email = $arContact['EMAIL'][0]['VALUE'];
			}
			
			if ( isset($arContact['PHONE'][0]['VALUE']) ){
				$phone = $arContact['PHONE'][0]['VALUE'];
			}
			
			
			if ( $arContact['UF_CRM_1560689565'] ){
				$user_id = $arContact['UF_CRM_1560689565'];
			}
			else {
			
				$modelUser = Yii::createObject(RegistrationForm::className());
				$password = $this -> generateRandomString();
				$modelUser -> email    = $email;
				$modelUser -> password = $password;	
				if ( $modelUser -> register()){
				
					//авторизуем пользователя
					$newUser = \Yii::createObject(LoginForm::className());
					$newUser -> login = $email;
					$newUser -> password = $password;
					$newUser -> login();
					
					$user_id = \Yii::$app->user->identity->id;
				
				}
				
				//сохраняем в црм id пользователя
				$arField = Array();
				$arField['UF_CRM_1560689565'] = $user_id;
				$this ->  SaveCrmContact( $id, $arField);
				
				
				
				
			}
			
				//заполняем профиль
				$profileUser = \Yii::createObject(Profile::className());
				$profileUser = Profile::find()->where(['user_id' => $user_id])->one();
				$profileUser -> name = $arContact['NAME'];
				$profileUser -> last_name = $arContact['LAST_NAME'];
				$profileUser -> second_name = $arContact['SECOND_NAME'];
				$profileUser -> phone = $phone;
				$profileUser -> email = $email;
				$profileUser -> public_email = $email;
				$profileUser -> bithday = $arContact['BIRTHDATE'];
				$profileUser -> issueDate = $arContact['UF_CRM_1559828675'];
				$profileUser -> registrationDate = $arContact['UF_CRM_1559829029'];
				$profileUser -> birthPlace = $arContact['UF_CRM_1559828608'];
				$profileUser -> sn =  $arContact['UF_CRM_1559828656'];
				$profileUser -> issueCode =  $arContact['UF_CRM_1559828690'];
				$profileUser -> issuer =  $arContact['UF_CRM_1559828703'];
				$profileUser -> address =  $arContact['UF_CRM_1559829011'];
				$profileUser -> registrationPhone =  $arContact['UF_CRM_1559829056'];
				$profileUser -> snils =  $arContact['UF_CRM_1561550193'];
				$profileUser -> sex =   $this -> GetListValueByKey( $arContact['UF_CRM_1561550005'] );
				
				$profileUser -> save();
			
			
			
			
			return $user_id;
			
	
	}
	
	private function SendRequest( $qr, $url ){
	
			$url = $this -> apiUrl . $url;
	
			$queryData = http_build_query($qr);
		 
			$curl = curl_init();
			curl_setopt_array($curl, array(
				CURLOPT_SSL_VERIFYPEER => false,
				CURLOPT_SSL_VERIFYHOST => false,
				CURLOPT_POST => 1,
				CURLOPT_HEADER => 0,
				CURLOPT_RETURNTRANSFER => 1,
				CURLOPT_URL => $url,
				CURLOPT_POSTFIELDS => $queryData,
			));
			
		 
			if(!$result = curl_exec($curl))
			{
				 $result = curl_error($curl);
				 return false;
			}
			
			curl_close($curl);
			
			$result = json_decode($result, true);
			return $result;
	
	
	}
	
	public function GetDealWebhook( $arFields ){
	
		$application_token = $arFields['auth']['application_token'];
		if ( !in_array( $application_token, $this -> dealAuthKey)  ){	//проверка на подлинность запроса
			return false;
		}
		$action  = $arFields['event'];							//тип события
		$deal_id = $arFields['data']['FIELDS']['ID'];			//номер сделки
		$arResult = $this -> GetDeal( $deal_id );
		
		
		$contact_id = $arResult['CONTACT_ID'];	
		$service_id = $arResult['CATEGORY_ID'];		
		$order_id = $arResult['UF_CRM_1559807131'];
		
		if ( !$service_id ){
			return false;
		}
		
		$orderModel = $this -> GetOrderModel( $service_id, $order_id );
		
		$arCrmFields = $orderModel -> getArrayFromBitrixCrm();
		
	
		foreach ( $arCrmFields as $code => $arVal){
		
			if ( isset($arResult[$code]) ){
				if ( $arVal['type'] !== 'list' ){
					$orderModel -> $arVal['field'] = $arResult[$code];
				}
				else {
					$value = $this -> GetListValueByKey( $arResult[$code] );
					$orderModel -> $arVal['field'] = $value;
				}
			}
			
		}
		
		//если обновление ранее созданной сделки
		if ( !$order_id && $contact_id ){
		
			$user_id = $this -> MakeContact( $contact_id );
			$orderModel->user_id = $user_id;

		}
			
		$orderModel->scenario = 'update';
		
		$orderModel -> save();
		
		print_r($orderModel->errors);
		
		if ( !$order_id ){	//если это новый заказ
		
			$order = new Orders();
			$order -> order_id = $orderModel -> id;
			$order -> user_id = $user_id;
			$order -> service_id = $orderModel -> service_id;
			$order -> save();
			
			//сохраняем в црм id заказа
			$arField = Array();
			$arField['UF_CRM_1559807131'] = $orderModel -> id;
			$this ->  SaveCrmDeal( $deal_id, $arField);
		
		}
		

	}
	
	
	
	public function GetOrderModel( $service_id, $order_id = '' ){
	
			switch ( $service_id ) {
				case 1:
					if ( $order_id )
						$model = Kredit::findOne( $order_id );
					else
						$model = new Kredit( );
					break;
				case 3:
					if ( $order_id )
						$model = Ipoteka::findOne( $order_id );
					else
						$model = new Ipoteka( );
					break;
				case 4:
					if ( $order_id )
						$model = Debet::findOne( ['id'=>$order_id] );
					else
						$model = new Debet( );
					break;
				case 6:
					if ( $order_id )
						$model = Avtokredit::findOne( $order_id );
					else
						$model = new Avtokredit( );
					break;
				case 2:
					if ( $order_id )
						$model = KreditKards::findOne( $order_id );
					else
						$model = new KreditKards( );
					break;
				case 5:
					if ( $order_id )
						$model = DebetCards::findOne( $order_id );
					else
						$model = new DebetCards( );
					break;
				case 7:
					if ( $order_id )
						$model = Rko::findOne( $order_id );
					else
						$model = new Rko( );
					break;
			}
			return $model;
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
			'Ремонт' => '32',
			'Погашение кредитов' => '33',
			'Учеба' => '34',
			'Развитие бизнеса' => '35',
			'Лечение' => '36',
			'Погашение долгов (не кредиты)' => '37',
			'Шоппинг' => '38',
			'Путешествие' => '39',
			'Торжество' => '40',
			'Помощь близким' => '41',
			'Иное' => '42',
			'Работа по найму' => '43',
			'Индивидуальный предприниматель' => '44',
			'Пенсионер' => '45',
			'Военный' => '46',
			'Не работаю' => '47',
			'Горнодобывающая промышленность' => '51',
			'Государственное, муниципальное управление' => '52',
			'Здравоохранение, социальные услуги' => '53',
			'Культура, искусство, спортивная деятельность' => '54',
			'Оборона, правоохранительные органы' => '55',
			'Обрабатывающая промышленность (производство)' => '56',
			'Профессиональная, научная, техническая деятельность' => '57',
			'Сельское хозяйство, рыболовство, охота, лесоводство' => '58',
			'Сфера торговли, услуг, связи' => '59',
			'Транспорт' => '60',
			'Финансовая деятельность, страхование' => '61',
			'Иное' => '62',
			'Руководитель организации' => '63',
			'Руководитель подразделения' => '64',		
			'Неруководящий сотрудник - специалист' => '65',
			'Неруководящий сотрудник - обсл. персонал' => '66',	
			'Мой номер' => '67',
			'Номер родственника' => '68',	
			'Номер друга' => '69',
			'Начальное, среднее' => '70',	
			'Неполное высшее' => '71',
			'Высшее' => '72',		
			'Второе высшее' => '73',
			'Ученая степень' => '74',
			'Холост/не замужем' => '75',	
			'Разведен(а)' => '76',
			'Гражданский брак' => '77',		
			'Женат/замужем' => '78',
			'Вдовец/вдова' => '79',
			
			'Всегда плачу вовремя' => '85',
			'Бывают просрочки' => '86',	
			'Было много просрочек' => '87',
			'Есть текущие просрочки' => '88',		
			'Не было кредитов' => '89',
			'Не знаю' => '90',
			
			'Покупка квартиры' => '150',	
			'Покупка апартаментов' => '151',
			'Покупка загородного дома/таунхауса' => '152',		
			'Рефинансирование' => '153',
			'Вторичное жилье' => '154',		
			'Новостройка' => '155',
			
			'Найм, Справка 2-НДФЛ' => '156',
			'Найм, Справка по форме банка' => '157',
			'Найм, Устное подтверждение' => '158',
			'Созаемщик без учета дохода' => '159',
			'ИП, Налоговая декларация' => '160',
			'ИП, Иными документами' => '161',
			'ИП, Устное подтверждение' => '162',
			'Собственник бизнеса, Налоговая декларация' => '163',			
			'Собственник бизнеса, Иными документами' => '164',
			'Собственник бизнеса, Устное подтверждение' => '165',
			
			'Частичное снятие' => '166',
			'Для пенсионеров' => '167',
			'Пополнение счета' => '168',
			'Иное' => '169',
			
			'Рубль' => '170',
			'Доллар' => '171',
			'Евро' => '172',
		
			'Visa' => '173',
			'MasterCard' => '174',
			'Мир' => '175',
			'American Express' => '176',
			'Другая' => '177',
			
			'Стандартная' => '178',
			'Золотая' => '179',
			'Премиальная' => '180',
			'Электронная' => '181',
			'Другая ' => '182',
			
			'Легковой автомобиль' => '183',
			'Грузовой автомобиль' => '184',
			'Мотоцикл' => '185',
			'Снегоход' => '186',
			
			'Нет' => '48',
			'Отечественный' => '49',
			'Иномарка' => '50',
			
			'Новый автомобиль' => '187',
			'Автомобиль с пробегом' => '188',	

			'ИП' => '189',
			'ООО' => '190',	
			
			
			'Муж.' => '235',
			'Жен.' => '236',
			
			'No'   => '80',
			'1'   => '81',
			'2'   => '82',
			'3'   => '83',
			'Больше 3'   => '84',
			
		);	
		
		if ( isset($arFields[$value] )){
			return $arFields[$value];
		}
		else {
			return false;
		}
	}
	
	public function GetListValueByKey( $crmValue ){
	
		$arFields = Array(
			'Ремонт' => '32',
			'Погашение кредитов' => '33',
			'Учеба' => '34',
			'Развитие бизнеса' => '35',
			'Лечение' => '36',
			'Погашение долгов (не кредиты)' => '37',
			'Шоппинг' => '38',
			'Путешествие' => '39',
			'Торжество' => '40',
			'Помощь близким' => '41',
			'Иное' => '42',
			'Работа по найму' => '43',
			'Индивидуальный предприниматель' => '44',
			'Пенсионер' => '45',
			'Военный' => '46',
			'Не работаю' => '47',
			'Горнодобывающая промышленность' => '51',
			'Государственное, муниципальное управление' => '52',
			'Здравоохранение, социальные услуги' => '53',
			'Культура, искусство, спортивная деятельность' => '54',
			'Оборона, правоохранительные органы' => '55',
			'Обрабатывающая промышленность (производство)' => '56',
			'Профессиональная, научная, техническая деятельность' => '57',
			'Сельское хозяйство, рыболовство, охота, лесоводство' => '58',
			'Сфера торговли, услуг, связи' => '59',
			'Транспорт' => '60',
			'Финансовая деятельность, страхование' => '61',
			'Иное' => '62',
			'Руководитель организации' => '63',
			'Руководитель подразделения' => '64',		
			'Неруководящий сотрудник - специалист' => '65',
			'Неруководящий сотрудник - обсл. персонал' => '66',	
			'Мой номер' => '67',
			'Номер родственника' => '68',	
			'Номер друга' => '69',
			'Начальное, среднее' => '70',	
			'Неполное высшее' => '71',
			'Высшее' => '72',		
			'Второе высшее' => '73',
			'Ученая степень' => '74',
			'Холост/не замужем' => '75',	
			'Разведен(а)' => '76',
			'Гражданский брак' => '77',		
			'Женат/замужем' => '78',
			'Вдовец/вдова' => '79',
			
			'Всегда плачу вовремя' => '85',
			'Бывают просрочки' => '86',	
			'Было много просрочек' => '87',
			'Есть текущие просрочки' => '88',		
			'Не было кредитов' => '89',
			'Не знаю' => '90',
			
			'Нет' => '48',
			'Отечественный' => '49',
			'Иномарка' => '50',
			
			'Покупка квартиры' => '150',	
			'Покупка апартаментов' => '151',
			'Покупка загородного дома/таунхауса' => '152',		
			'Рефинансирование' => '153',
			'Вторичное жилье' => '154',		
			'Новостройка' => '155',
			
			'Найм, Справка 2-НДФЛ' => '156',
			'Найм, Справка по форме банка' => '157',
			'Найм, Устное подтверждение' => '158',
			'Созаемщик без учета дохода' => '159',
			'ИП, Налоговая декларация' => '160',
			'ИП, Иными документами' => '161',
			'ИП, Устное подтверждение' => '162',
			'Собственник бизнеса, Налоговая декларация' => '163',			
			'Собственник бизнеса, Иными документами' => '164',
			'Собственник бизнеса, Устное подтверждение' => '165',
			
			'Частичное снятие' => '166',
			'Для пенсионеров' => '167',
			'Пополнение счета' => '168',
			'Иное' => '169',
			
			'Рубль' => '170',
			'Доллар' => '171',
			'Евро' => '172',
		
			'Visa' => '173',
			'MasterCard' => '174',
			'Мир' => '175',
			'American Express' => '176',
			'Другая' => '177',
			
			'Стандартная' => '178',
			'Золотая' => '179',
			'Премиальная' => '180',
			'Электронная' => '181',
			'Другая ' => '182',
			
			'Легковой автомобиль' => '183',
			'Грузовой автомобиль' => '184',
			'Мотоцикл' => '185',
			'Снегоход' => '186',
			
			'Новый автомобиль' => '187',
			'Автомобиль с пробегом' => '188',	

			'ИП' => '189',
			'ООО' => '190',

			'Муж.' => '235',
			'Жен.' => '236',
			
			'No'   => '80',
			'1'   => '81',
			'2'   => '82',
			'3'   => '83',
			'Больше 3'   => '84',

		);	
		
		if ( $key = array_search($crmValue, $arFields) ){
			return $key;
		}
		else {
			return false;
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
