<?php
namespace common\models;
use common\models\Api;
use common\models\ApiEvents;
use common\models\Absolute;

use yii\helpers\Html;


$this->title = 'О компании';
$this->params['breadcrumbs'][] = $this->title;
?>


<?

//обсолюте банк




//$objApi = Api::build( 8 );

//$aBank = new Absolute();
//$aBank -> Request();


/*
//ак барс

$ch = curl_init();
$header = Array("Content-type: application/json", "Accept: application/json, text/json, application/vnd.api+json");
$body = Array( 
	"grant_type" => "password",
	"client_id" => "ds_partners",
	"scope" => "offline_access",
	"username" => "OOOMOST",
	"password" => "qwerty234"
);

echo $postStr = json_encode( $body );

$url = 'https://authtest.akbars.ru:8443/connect/token';
curl_setopt($ch, CURLOPT_URL, $url);
curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'POST');
curl_setopt($ch, CURLOPT_POSTFIELDS, $postStr);
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
curl_setopt($ch, CURLOPT_AUTOREFERER, true );
curl_setopt( $ch, CURLOPT_FOLLOWLOCATION, true );
curl_setopt( $ch, CURLOPT_ENCODING, "" );
curl_setopt( $ch, CURLOPT_RETURNTRANSFER, true );
curl_setopt($ch, CURLOPT_HTTPHEADER, $header);
echo $output = curl_exec($ch);

        if (curl_errno($ch)) {
            echo "Error: " . curl_error($ch);
        } else {
            curl_close($ch);
			echo 'hmmm';
            // Show me the result
           
        }

*/

$docs = '{"swagger":"2.0","info":{"version":"v1","title":"Credits API"},"paths":{"/public/agents":{"post":{"tags":["Opportunities"],"summary":"Создает заявку на кредит","operationId":"PublicAgentsPost","consumes":["application/json-patch+json","application/json","text/json","application/*+json"],"produces":["text/plain","application/json","text/json","application/vnd.api+json"],"parameters":[{"name":"cmd","in":"body","description":"Данные по заявке","required":false,"schema":{"$ref":"#/definitions/NewCreditCommand"}}],"responses":{"200":{"description":"Success","schema":{"$ref":"#/definitions/DocumentRoot[Object]"}}}}}},"definitions":{"NewCreditCommand":{"description":"Создает новую заявку на кредит","type":"object","properties":{"branchCode":{"description":"Код отделения для подачи документов","type":"string"},"creditInfo":{"$ref":"#/definitions/CreditInfo","description":"Информация о кредите"},"clientInfo":{"$ref":"#/definitions/ClientInfo","description":"Информация о клиенте"}}},"CreditInfo":{"description":"Информация о кредите","type":"object","properties":{"amount":{"format":"double","description":"Сумма кредита","type":"number"},"term":{"format":"int32","description":"Срок кредита в месяцах","type":"integer"},"withInsurance":{"description":"Со страхованием","type":"boolean"}}},"ClientInfo":{"description":"Информация о клиенте","type":"object","properties":{"registrationDate":{"format":"date-time","description":"Дата регистрации","type":"string"},"maritalStatus":{"description":"Семейное положение","enum":["jenat","holost","grajdanskiy","razvod","povtorniy","vdovec"],"type":"string"},"familySize":{"format":"int32","description":"Численность семьи","type":"integer"},"numberOfChildren":{"format":"int32","description":"Количество детей","type":"integer"},"numberOfUnderageChildren":{"format":"int32","description":"Из них младше 18 лет","type":"integer"},"education":{"description":"Образование","enum":["nezakonchennoeSrednee","srednee","sredneeSpecialnoe","nezakonchennoeVysshee","vysshee","academic","neskolkoVysshih"],"type":"string"},"hasForeignPassport":{"description":"Наличие заграничного паспорта","type":"boolean"},"isBankEmployee":{"description":"Является ли сотрудником банка?","type":"boolean"},"hasPayrollCard":{"description":"Является ли держателем зарплатной карты?","type":"boolean"},"isPartnerMemberEmployee":{"description":"Является ли сотрудником организации партнера?","type":"boolean"},"hasBankAccount":{"description":"Наличие банковского счета","type":"boolean"},"placeOfBirth":{"description":"Место рождения","type":"string"},"countryOfRegistrationCode":{"description":"Страна регистрации - выдаем только россиянам (643)","type":"string"},"countryOfOriginCode":{"description":"Код страны происхождения - выдаем только россиянам (643)","type":"string"},"countryOfCitizenshipCode":{"description":"Код страны гражданства - выдаем только россиянам (643)","type":"string"},"surname":{"description":"Фамилия","type":"string"},"name":{"description":"Имя","type":"string"},"patronymic":{"description":"Отчество","type":"string"},"email":{"description":"Email клиента, маска ххх@ххх.хх","type":"string"},"residencePhoneNumber":{"description":"Телефон по месту проживания - без +7","type":"string"},"registrationPlacePhoneNumber":{"description":"Телефон по месту регистрации - без +7","type":"string"},"contactPersonPhoneNumber":{"description":"Телефон контактного лица - без +7","type":"string"},"surnameChanged":{"description":"Менялась фамилия","type":"boolean"},"previousSurname":{"description":"Прежняя фамилия","type":"string"},"birthdate":{"format":"date-time","description":"Дата рождения","type":"string"},"sex":{"description":"Пол","enum":["m","f"],"type":"string"},"livingPlace":{"description":"Место жительства (в городе, деревне и т.д.)","enum":["city"],"type":"string"},"insuranceNumber":{"description":"Номер СНИЛС","type":"string"},"passport":{"$ref":"#/definitions/PassportInfo","description":"Паспорт"},"phones":{"description":"Контактные телефоны","type":"array","items":{"$ref":"#/definitions/PhoneInfo"}},"actualAddress":{"$ref":"#/definitions/AddressInfo","description":"Фактический адрес"},"registrationAddress":{"$ref":"#/definitions/AddressInfo","description":"Адрес регистрации"},"employment":{"$ref":"#/definitions/EmploymentInfo","description":"Информация о трудовой занятости"},"incomes":{"description":"Список доходов клиента","type":"array","items":{"$ref":"#/definitions/IncomeInfo"}},"assets":{"description":"Собственность/недвижимость клиента","type":"array","items":{"$ref":"#/definitions/AssetInfo"}},"expenses":{"description":"Список расходов клиента","type":"array","items":{"$ref":"#/definitions/ExpenseInfo"}},"externalCredits":{"description":"Список кредитов и обязательств","type":"array","items":{"$ref":"#/definitions/ExternalCreditInfo"}}}},"PassportInfo":{"description":"Паспорт","type":"object","properties":{"series":{"description":"Серия\r\nМожет содержать лишние пробелы, тире и т.д.","type":"string"},"number":{"description":"Номер\r\nМожет содержать лишние пробелы, тире и т.д.","type":"string"},"unitCode":{"description":"Код подразделения\r\nМожет содержать лишние пробелы, тире и т.д.","type":"string"},"department":{"description":"Кем выдан","type":"string"},"dateOfIssue":{"format":"date-time","description":"Дата выдачи","type":"string"},"birthplace":{"description":"Место рождения","type":"string"}}},"PhoneInfo":{"description":"Телефон","type":"object","properties":{"number":{"description":"Номер без префикса +7 (номера с другими префиксами пока не поддерживаются)","type":"string"},"type":{"description":"Тип телефона (из спр. JET_FIN_PHONE_TYPE)\r\nСохранять, как PhoneName","enum":["mobile","work","contactPerson","atRegistration","home"],"type":"string"}}},"AddressInfo":{"description":"Адрес","type":"object","properties":{"countryCode":{"description":"Код страны","type":"string"},"region":{"description":"Регион","type":"string"},"settlement":{"description":"Населенный пункт","type":"string"},"street":{"description":"Улица","type":"string"},"house":{"description":"Дом","type":"string"},"block":{"description":"Корпус","type":"string"},"flat":{"description":"Квартира","type":"string"},"zip":{"description":"Почтовый индекс","type":"string"},"regionKladrId":{"description":"Код региона по КЛАДР","type":"string"},"districtKladrId":{"description":"Код района по КЛАДР","type":"string"},"cityKladrId":{"description":"Код города по КЛАДР","type":"string"},"settlementKladrId":{"description":"Код населенного пункта по КЛАДР","type":"string"},"streetKladrId":{"description":"Код улицы по КЛАДР","type":"string"},"type":{"description":"Тип адреса","enum":["registration","residential"],"type":"string"},"accomodation":{"description":"Тип размещения","enum":["ownApartments","rodstvenniki","kommunalka","obschaga","voinskayaChast","socialniyNaim"],"type":"string"}}},"EmploymentInfo":{"description":"Трудовая занятость клиента","type":"object","properties":{"jobs":{"description":"Места работы","type":"array","items":{"$ref":"#/definitions/JobInfo"}},"previousEmploymentMonths":{"format":"int32","description":"Длительность работы на предыдущем месте (мес)","type":"integer"}}},"IncomeInfo":{"description":"Источник дохода клиента","type":"object","properties":{"type":{"description":"Источник дохода","enum":["other","arenda","podrabotka","alimenty","pensia"],"type":"string"},"avgMonthIncome":{"format":"double","description":"Среднемесячный доход","type":"number"}}},"AssetInfo":{"description":"собственность/недвижимость клиента","type":"object","properties":{"type":{"description":"Тип неджижимости / собственности","enum":["apartments","uchastok","car","garaj","room","house"],"type":"string"},"assetBuyYear":{"format":"int32","description":"Год приобретения","type":"integer"},"assetValue":{"format":"double","description":"Рыночная стоимость по оценке","type":"number"},"totalArea":{"format":"double","description":"Общая площадь","type":"number"},"pledgedFlag":{"description":"Находится в залоге","type":"boolean"},"autoRegNum":{"description":"Регистрационный номер авто","type":"string"},"autoModelYear":{"format":"int32","description":"Год выпуска авто","type":"integer"},"vehicleModel":{"description":"Модель авто","type":"string"}}},"ExpenseInfo":{"description":"расходы клиента","type":"object","properties":{"type":{"description":"Тип расхода","enum":["other","alimenty","education","insurance"],"type":"string"},"expenseAmount":{"format":"double","description":"Сумма расхода","type":"number"}}},"ExternalCreditInfo":{"description":"кредит, займ или поручительство клиента","type":"object","properties":{"subjectRole":{"description":"Роль субьекта","type":"string"},"externalOrgName":{"description":"Кредитор","type":"string"},"loanBalance":{"format":"double","description":"Остаток по кредиту","type":"number"},"sum":{"format":"double","description":"Сумма кредита","type":"number"},"monthlyPayments":{"format":"double","description":"Размер ежемесячных выплат","type":"number"},"endDate":{"format":"date-time","description":"Срок окончания договора","type":"string"}}},"JobInfo":{"description":"Место работы","type":"object","properties":{"previousEmploymentYears":{"format":"int32","description":"Длительность работы на пред месте (лет)","type":"integer"},"previousEmploymentMonth":{"format":"int32","description":"Длительность работы на пред месте (мес)","type":"integer"},"currentEmploymentYears":{"format":"int32","description":"Длительность работы на текущем месте (лет)","type":"integer"},"currentEmploymentMonths":{"format":"int32","description":"Длительность работы на текущем месте (мес)","type":"integer"},"organizationAddress":{"description":"Фактический адрес организации","type":"string"},"organizationPhoneNumber":{"description":"Телефон организации","type":"string"},"supervisorPhoneNumber":{"description":"Номер непосредственного руководителя","type":"string"},"jobTitle":{"description":"Название должности","type":"string"},"position":{"description":"Занимаемая позиция","enum":["sotrudnik","specialist","rukovoditel","expert"],"type":"string"},"numberOfStaff":{"description":"Количество сотрудников организации","enum":["do20","ot21do100","ot101do500","bolee500"],"type":"string"},"industry":{"description":"Отрасль","enum":["architek","metall","science","realty","oil","education","restauran","security","pischProm","pravoohran","gos","telecom","agriculture","massMedia","insurance","retail","transport","tourism","personnelManagement","managementCompanies","financialInstitutions","healthCare","chemicalIndustry","powerIndustry","legalServices","entertainmentIndustry","it","culture","supplies","marketing","engineering","others"],"type":"string"},"institutionalLegalForm":{"description":"Организационно-правовая форма","enum":["ooo","oao","zao","ao","gos","foreign","others"],"type":"string"},"companyName":{"description":"Наименование организации","type":"string"},"inn":{"description":"ИНН организации","type":"string"},"type":{"description":"Тип работы","enum":["agent","fixedTermContract","indefiniteContract"],"type":"string"},"isPrimary":{"description":"Место работы (основное/дополнительное)","type":"boolean"},"monthIncomeAvg":{"format":"double","description":"Среднемесячный доход","type":"number"}}},"DocumentRoot[Object]":{"type":"object","properties":{"jsonapi":{"$ref":"#/definitions/VersionInfo"},"data":{"type":"object"},"included":{"type":"array","items":{"type":"object"}},"errors":{"type":"array","items":{"$ref":"#/definitions/Error"}},"links":{"type":"object","additionalProperties":{"$ref":"#/definitions/Link"}},"meta":{"type":"object","additionalProperties":{"type":"object"}}}},"VersionInfo":{"type":"object","properties":{"version":{"type":"string"},"meta":{"type":"object","additionalProperties":{"type":"object"}}}},"Error":{"type":"object","properties":{"id":{"type":"string"},"status":{"type":"string"},"code":{"type":"string"},"title":{"type":"string"},"detail":{"type":"string"},"source":{"$ref":"#/definitions/ErrorSource"},"links":{"type":"object","additionalProperties":{"$ref":"#/definitions/Link"}},"meta":{"type":"object","additionalProperties":{"type":"object"}}}},"Link":{"type":"object","properties":{"href":{"type":"string"},"meta":{"type":"object","additionalProperties":{"type":"object"}}}},"ErrorSource":{"type":"object","properties":{"pointer":{"type":"string"},"parameter":{"type":"string"}}}}}';
$docs = json_decode($docs);

echo "<pre>";
print_r( $docs );
echo "</pre>";



		
$sURL = 'https://authtest.akbars.ru:8443/connect/token'; // URL-адрес POST 
$apiURL = 'https://apitest.akbars.ru/dsa_partner/v1/'; // URL-адрес POST 

//$apiURL = 'https://apitest.akbars.ru/dsa_partner/v1/catalogs/cities'; // URL-адрес POST 

$body = Array( 
	"grant_type" => "password",
	"client_id" => "ds_partners",
	"scope" => "offline_access",
	"username" => "OOOMOST",
	"password" => "qwerty234"
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
$result = file_get_contents($sURL, false, $context);
$arResult = json_decode( $result, JSON_UNESCAPED_UNICODE);
$tokken = $arResult['access_token'];


//получаем города
$cityUrl = $apiURL . 'catalogs/cities';
$sPD = '';

$aHTTP = array(
  'http' => 
    array(
    'method'  => 'GET', 
    'header'  => Array('Content-type: application/x-www-form-urlencoded', 'Authorization: Bearer ' . $tokken, 'Accept: application/json, text/json, application/vnd.api+json'),
   // 'content' => $sPD
  )
);
$context = stream_context_create($aHTTP);
$result = file_get_contents($cityUrl, false, $context);

echo "<pre>";
print_r( $result );
echo "</pre>";


//kreditrequest

$sPD = '{
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
      "dateOfIssue": "2019-02-20T07:46:39.207Z",
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
        "endDate": "2019-02-20T07:46:39.207Z"
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
    "birthdate": "2019-02-20T07:46:39.207Z",
    "sex": "m",
    "insuranceNumber": "string",
    "countryOfRegistrationCode": "string",
    "countryOfOriginCode": "string",
    "countryOfCitizenshipCode": "string",
    "registrationDate": "2019-02-20T07:46:39.207Z",
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

//$sPD = http_build_query( $body );
$aHTTP = array(
  'http' => // Обертка, которая будет использоваться
    array(
    'method'  => 'POST', // Метод запроса
    // Ниже задаются заголовки запроса
    'header'  => Array('Content-type: text/json', 'Authorization: Bearer ' . $tokken),
    'content' => $sPD
  )
);
$context = stream_context_create($aHTTP);
//$result = file_get_contents($apiURL, false, $context);

echo "<pre>";
print_r( $result );
echo "</pre>";

		
		
		
/*	

//точка банк 
$sURL = 'https://open.tochka.com:3000/rest/v1/request/new'; // URL-адрес POST 


$body = Array( 
	"token" => "1mo75abav8m7sj8l4lm3a8p54prlqr35m",
	"request" => Array('inn' => '1659169882', 'name' => 'ИП Тестовый', 'adrress' => 'Москва, Мароссейка 15', 'last_name' => 'Тестович', 'first_name' => 'Тест', 'second_name' => 'Тестовый', 'birthday' => '1987-02-02', 'telephone' => '+79046891755', 'typeDoc' => '21',  'dateStart' => '2015-02-02', 'number' => '878456',  'serial' => '9206', 'snils' => '12345678900', 'comment' => 'test', 'branch' => 'open', 'acc_type' => '0', 'sex' => 'F',),
	"workMode" => "0",
);

$sPD = json_encode( $body, JSON_UNESCAPED_UNICODE);
$aHTTP = array(
  'http' => // Обертка, которая будет использоваться
    array(
    'method'  => 'POST', // Метод запроса
    // Ниже задаются заголовки запроса
    'header'  => 'Content-type: application/json',
    'content' => $sPD
  )
);
$context = stream_context_create($aHTTP);
$result = file_get_contents($sURL, false, $context);	
$arResult = json_decode( $result, JSON_UNESCAPED_UNICODE);
 
*/	


/*		
$ch = curl_init();

$header = Array("Content-type: application/vnd.api+json", "Accept: application/vnd.api+json");
$body = Array( 
	"grant_type" => "client_credentials",
	"client_id" => 'm9CYmDLv',
	"client_secret" => "vwS2cFvA",
	"scope" => "standard:create standard:read standard:update standard:delete standard:delete standard:relationship:create standard:relationship:read standard:relationship:update standard:relationship:delete"
);



$url = 'https://pbx117.asterisk-ip.ru/api/oauth/access_token';
curl_setopt($ch, CURLOPT_URL, $url);
curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'POST');
curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, FALSE);
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
curl_setopt($ch, CURLOPT_POSTFIELDS, $body);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($ch, CURLOPT_HTTPHEADER, $header);
$output = curl_exec($ch);		
		if (curl_errno($ch)) {
            echo "Error: " . curl_error($ch);
        } else {
            curl_close($ch);
			echo 'hmmm';
            // Show me the result
           
        }	
		



$wsdlURL = "https://pbx117.asterisk-ip.ru/service/v4_1/soap.php?wsdl";
$client  = new SoapClient($wsdlURL, [
    "soap_version" => SOAP_1_1,
    "stream_context" => stream_context_create(
            [
                'ssl' => [
                    'verify_peer'       => false,
                    'verify_peer_name'  => false,
                ]
            ]
        )
]);
$userAuth = array(
        'user_name' => 'test',
        'password' => md5('test'),
);
$appName = 'My SuiteCRM SOAP Client';
$nameValueList = array();
$loginResults = $client->login($userAuth, $appName, $nameValueList);

$nameValueList = array();

$field = new stdClass;
$field  -> name = 'first_name';
$field  -> value = 'Александр';
$nameValueList [] = $field;

$field = new stdClass;
$field  -> name = 'last_name';
$field  -> value = 'Овечкин';
$nameValueList [] = $field;

$field = new stdClass;
$field  -> name = 'third_name_c';
$field  -> value = 'Геннадьевич';
$nameValueList [] = $field;

$field = new stdClass;
$field  -> name = 'phone_mobile';
$field  -> value = '+790455678123';
$nameValueList [] = $field;

$field = new stdClass;
$field  -> name = 'Contacts0emailAddress0';
$field  -> value = 'test@tttt.rt';
$nameValueList [] = $field;

$field = new stdClass;
$field  -> name = 'contacts_status_c';
$field  -> value = 'assent_recall';
$nameValueList [] = $field;

$field = new stdClass;
$field  -> name = 'project_template_c';
$field  -> value = 'bank';
$nameValueList [] = $field;




$operationResults = $client->set_entry($loginResults->id, 'Contacts', $nameValueList);	




var_dump( $loginResults );
*/



?>
