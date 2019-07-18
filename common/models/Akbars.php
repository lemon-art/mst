<?php
namespace common\models;
use Yii;


class Akbars 
{

	public $authUrl;
	public $apiUrl;
	protected $username;
	protected $password;
	protected $tokken;
	protected $authUser;
	protected $cityID;
	protected $branchID;
	
	function __construct(){
	
		$this -> authUrl = 'https://authtest.akbars.ru:8443/connect/token';
		$this -> apiUrl = 'https://apitest.akbars.ru/dsa_partner/v1/';
		$this -> username = 'OOOMOST';
		$this -> password = 'qwerty234';
		
		$this -> GetTokken();

	}
	
	

	protected function GetTokken()
    {

		$body = Array( 
			"grant_type" => "password",
			"client_id" => "ds_partners",
			"scope" => "offline_access https://api.akbars.ru/dsa_partner",
			"username" => $this -> username,
			"password" => $this -> password
		);

		$sPD = http_build_query( $body );
		$aHTTP = array(
		  'http' => // Обертка, которая будет использоваться
			array(
			'method'  => 'POST', // Метод запроса
			// Ниже задаются заголовки запроса
			'header'  => 'Content-type: application/x-www-form-urlencoded',
			'content' => $sPD
		  )
		);
		$context = stream_context_create($aHTTP);
		$result = file_get_contents($this -> authUrl, false, $context);
		$arResult = json_decode( $result, JSON_UNESCAPED_UNICODE);
	
		$this -> tokken   = $arResult['access_token'];
	
		
		return true;
	
    }
	
	//получает все города
	public function GetCyties( ){
	
		$cityUrl = $this -> apiUrl . 'catalogs/cities';

		$ch = curl_init();  
		curl_setopt($ch, CURLOPT_URL, $cityUrl);
		curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'GET');
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 0);
		curl_setopt($ch, CURLOPT_HEADER,0);
		curl_setopt($ch, CURLOPT_HTTPHEADER, Array('Authorization: Bearer ' . $this -> tokken, 'Accept: application/json, text/json, application/vnd.api+json'));
		curl_setopt($ch, CURLOPT_AUTOREFERER, true );
		curl_setopt( $ch, CURLOPT_FOLLOWLOCATION, true );
		curl_setopt( $ch, CURLOPT_ENCODING, "" );
		curl_setopt( $ch, CURLOPT_RETURNTRANSFER, true );
		curl_setopt($ch, CURLOPT_TIMEOUT, 10);
		$arCulrResult = json_decode(curl_exec ($ch));


        if (curl_errno($ch)) {
            echo "Error: " . curl_error($ch);
        } else {
            // Show me the result
           
        }
		curl_close($ch);
		
		$arResult = Array();
		foreach ( $arCulrResult as $item ){
			$arResult[ $item -> name ] = $item -> id;
		}

		return $arResult;
	}
	
	//получает ID города или false если города нет
	public function GetCityID( $cityName ){
	
		$arCity = $this -> GetCyties();
		if ( $arCity[$cityName] ){
			$this -> cityID = $arCity[$cityName];
			return $this -> cityID;
		}
		else {
			return false;
		}
	
	}
	
	//получает филиал в городе
	public function GetBranch( $cityID ){
	
		$branchUrl = $this -> apiUrl . 'catalogs/branches';
		
		$data = array(
			'serviceType' => 'credits',
			'cityId' => $cityID
		);
		
		$branchUrl .= '?' . http_build_query($data);
		
		$ch = curl_init();  
		curl_setopt($ch, CURLOPT_URL, $branchUrl);
		curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'GET');
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 0);
		curl_setopt($ch, CURLOPT_HEADER,0);
		curl_setopt($ch, CURLOPT_HTTPHEADER, Array('Authorization: Bearer ' . $this -> tokken, 'Accept: application/json, text/json, application/vnd.api+json'));
		curl_setopt($ch, CURLOPT_AUTOREFERER, true );
		curl_setopt( $ch, CURLOPT_FOLLOWLOCATION, true );
		curl_setopt( $ch, CURLOPT_ENCODING, "" );
		curl_setopt( $ch, CURLOPT_RETURNTRANSFER, true );

		curl_setopt($ch, CURLOPT_TIMEOUT, 10);
		$arCulrResult = json_decode(curl_exec ($ch));


        if (curl_errno($ch)) {
            echo "Error: " . curl_error($ch);
        } else {
            // Show me the result
           
        }
		curl_close($ch);

		
		foreach ( $arCulrResult as $item ){
			$this -> branchID = $item -> code;	
		}

	
	}
	
	
	
	public function Request( $orderModel )
    {

		$orderUrl = $this -> apiUrl . 'creditrequests';
	
		if ( !$this -> GetCityID( $orderModel -> city )){
			return false;
		}
		$this -> GetBranch( $this -> cityID );
		if ( !$this -> branchID ){
			return false;
		}
		
		$body = array(
				'branchCode' 		=> $this -> branchID,
				"surname"	 		=> "Тестович",
				"name" 		 		=> "Тест",
				"patronymic" 		=> "Тестович",
				"email"		 		=> "test@asadas@rt",
				"surnameChanged" 	=> false,
				"birthdate"			=> "1987-04-12T10:10:48.426Z",
				"sex"				=> "m",

				'creditInfo' =>	array(
					'amount'  		=> $orderModel -> summ, 
					'term'   		=> $orderModel -> term,
					'withInsurance' => true
				),
				'clientInfo' =>	array(
                    "passport" => array (
                        "series"  => "9205",
                        "number" => "123876",
						"unitCode" => '176345',
						"department" => "string",
						"dateOfIssue" => "2019-04-12T10:10:48.425Z",
						"birthplace" => "string"
                    ),
					'employment' => Array(
						"previousEmploymentMonths" => 0,
						"currentEmploymentMonths"  => 0,
					),
					"incomes" => Array(
						"type" => "other",
						"avgMonthIncome" => 0
					),
					'phones' =>	array(
						'type'  		=> "mobile", 
						'number'   		=> $orderModel -> phone,
					),
				),
				

		);
		

	/*
		{
  "branchCode": "string",
  "creditInfo": {
    "amount": 0,
    "term": 0,
    "withInsurance": true
  },
  "clientInfo": {
    "passport": {
      "series": "string",
      "number": "string",
      "unitCode": "string",
      "department": "string",
      "dateOfIssue": "2019-04-12T10:10:48.425Z",
      "birthplace": "string"
    },
    "employment": {
      "previousEmploymentMonths": 0,
      "currentEmploymentMonths": 0,
      "jobs": [
        {
          "position": "sotrudnik",
          "type": "fixedTermContract",
          "inn": "string",
          "companyName": "string",
          "institutionalLegalForm": "ooo",
          "industry": "architek",
          "numberOfStaff": "do20",
          "jobTitle": "string",
          "supervisorPhoneNumber": "string",
          "organizationPhoneNumber": "string",
          "organizationPhones": [
            {
              "type": "organization",
              "number": "string"
            }
          ],
          "organizationAddresses": [
            {
              "type": "juridical",
              "countryCode": "string",
              "region": "string",
              "settlement": "string",
              "street": "string",
              "house": "string",
              "block": "string",
              "flat": "string",
              "zip": "string",
              "regionKladrId": "string",
              "districtKladrId": "string",
              "cityKladrId": "string",
              "settlementKladrId": "string",
              "streetKladrId": "string"
            }
          ],
          "isPrimary": true,
          "monthIncomeAvg": 0
        }
      ]
    },
    "incomes": [
      {
        "type": "other",
        "avgMonthIncome": 0
      }
    ],
    "expenses": [
      {
        "type": "other",
        "expenseAmount": 0
      }
    ],
    "assets": [
      {
        "type": "apartments",
        "assetBuyYear": 0,
        "assetValue": 0,
        "totalArea": 0,
        "pledgedFlag": true,
        "autoRegNum": "string",
        "autoModelYear": 0,
        "vehicleModel": "string"
      }
    ],
    "externalCredits": [
      {
        "subjectRole": "borrower",
        "externalOrgName": "string",
        "loanBalance": 0,
        "sum": 0,
        "monthlyPayments": 0,
        "endDate": "2019-04-12T10:10:48.426Z"
      }
    ],
    "phones": [
      {
        "type": "mobile",
        "number": "string"
      }
    ],
    "addresses": [
      {
        "accomodation": "ownApartments",
        "type": "registration",
        "countryCode": "string",
        "region": "string",
        "settlement": "string",
        "street": "string",
        "house": "string",
        "block": "string",
        "flat": "string",
        "zip": "string",
        "regionKladrId": "string",
        "districtKladrId": "string",
        "cityKladrId": "string",
        "settlementKladrId": "string",
        "streetKladrId": "string"
      }
    ],
    "surname": "string",
    "name": "string",
    "patronymic": "string",
    "email": "string",
    "surnameChanged": true,
    "previousSurname": "string",
    "birthdate": "2019-04-12T10:10:48.426Z",
    "sex": "m",
    "insuranceNumber": "string",
    "countryOfRegistrationCode": "string",
    "countryOfOriginCode": "string",
    "countryOfCitizenshipCode": "string",
    "registrationDate": "2019-04-12T10:10:48.426Z",
    "maritalStatus": "jenat",
    "numberOfChildren": 0,
    "numberOfUnderageChildren": 0,
    "education": "nezakonchennoeSrednee",
    "isBankEmployee": true,
    "hasPayrollCard": true,
    "hasBankAccount": true,
    "isPartnerMemberEmployee": true,
    "hasForeignPassport": true
  }
}


		
		
		
		

		
		*/
		$sPD = json_encode( $body, JSON_UNESCAPED_UNICODE);
		
		
	$sPD = 	'{
  "branchCode": '.$this -> branchID.',
  "creditInfo": {
    "amount": 100000,
    "term": 12,
    "withInsurance": true
  },
  "clientInfo": {
    "passport": {
      "series": "9205",
      "number": "848870",
      "unitCode": "123-768",
      "department": "string",
      "dateOfIssue": "2009-04-15T13:18:14.756Z",
      "birthplace": "string"
    },
    "employment": {
      "previousEmploymentMonths": 0,
      "currentEmploymentMonths": 0,
    },
    "incomes": [
      {
        "type": "other",
        "avgMonthIncome": 30000
      }
    ],
    "expenses": [
      {
        "type": "other",
        "expenseAmount": 0
      }
    ],
    "assets": [
      {
        "type": "apartments",
        "assetBuyYear": 0,
        "assetValue": 0,
        "totalArea": 0,
        "pledgedFlag": true,
        "autoRegNum": "string",
        "autoModelYear": 0,
        "vehicleModel": "string"
      }
    ],
    "externalCredits": [
      {
        "loanBalance": 0,
        "sum": 0,
        "monthlyPayments": 0,
      }
    ],
    "phones": [
      {
        "type": "mobile",
        "number": "9045678956"
      },
	  {
		"type": "contactPerson",
        "number": "9045678955"
	  }
    ],
    "addresses": [
      {
        "accomodation": "ownApartments",
        "type": "registration",
        "countryCode": "643",
        "region": "string",
        "settlement": "string",
        "street": "string",
        "house": "string",
        "block": "string",
        "flat": "string",
        "zip": "string",
        "regionKladrId": "1600000000000",
        "cityKladrId": "1600000100000",
        "streetKladrId": "16000001000006300"
      },
	  {
        "accomodation": "ownApartments",
        "type": "residential",
        "countryCode": "643",
        "region": "string",
        "settlement": "string",
        "street": "string",
        "house": "string",
        "block": "string",
        "flat": "string",
        "zip": "string",
        "regionKladrId": "1600000000000",
        "cityKladrId": "1600000100000",
        "streetKladrId": "16000001000006300"
      },
    ],
    "surname": "Тестовый",
    "name": "Тест",
    "patronymic": "Тестович",
    "email": "asdasd@asdasd.ru",
    "surnameChanged": false,
    "birthdate": "1987-04-15T13:18:14.756Z",
    "sex": "m",
    "insuranceNumber": "string",
    "countryOfRegistrationCode": "643",
    "countryOfOriginCode": "643",
    "countryOfCitizenshipCode": "643",
    "registrationDate": "2009-04-15T13:18:14.756Z",
    "maritalStatus": "jenat",
    "numberOfChildren": 0,
    "numberOfUnderageChildren": 0,
    "education": "nezakonchennoeSrednee",
    "isBankEmployee": true,
    "hasPayrollCard": true,
    "hasBankAccount": true,
    "isPartnerMemberEmployee": true,
    "hasForeignPassport": true
  }
}';
		
		
		echo $sPD;
		
		$ch = curl_init();  
		curl_setopt($ch, CURLOPT_URL, $orderUrl);
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");                                                                     
		curl_setopt($ch, CURLOPT_POSTFIELDS, $sPD);
		curl_setopt($ch, CURLOPT_HEADER,1);
		curl_setopt($ch, CURLOPT_HTTPHEADER, Array('Content-Type: text/json', 'Content-Length: ' . strlen($sPD), 'Authorization: Bearer ' . $this -> tokken, 'Accept: application/json, text/json, application/vnd.api+json'));
		curl_setopt($ch, CURLOPT_AUTOREFERER, true );
		curl_setopt( $ch, CURLOPT_FOLLOWLOCATION, true );
		curl_setopt( $ch, CURLOPT_ENCODING, "" );
		curl_setopt( $ch, CURLOPT_RETURNTRANSFER, true );
		curl_setopt($ch, CURLOPT_TIMEOUT, 10);
		$arCulrResult = curl_exec ($ch);


        if (curl_errno($ch)) {
            echo "Error: " . curl_error($ch);
        } else {
            // Show me the result
           
        }
		curl_close($ch);
		
		
		/*
		$aHTTP = array(
		  'http' => 
			array(
			'method'  => 'POST', 
			'header'  => Array('Content-type: text/json', 'Authorization: Bearer ' . $this -> tokken, 'Accept: application/json, text/json, application/vnd.api+json'),
			'content' => $sPD
		  )
		);
		
		$context = stream_context_create($aHTTP);
		
		
		$result = file_get_contents($orderUrl, false, $context);	
		$arResult = json_decode( $result, JSON_UNESCAPED_UNICODE);
		*/
		
		echo "<pre>";
		print_r( $arCulrResult );
		echo "</pre>";
		
		//return $arResult['id'];
		
    }

}
