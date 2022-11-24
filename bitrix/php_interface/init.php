<?
AddEventHandler("sale", "OnOrderNewSendEmail", "bxModifySaleMails");

function bxModifySaleMails($orderID, &$eventName, &$arFields)
{
	$arOrder = CSaleOrder::GetByID($orderID);

	$order_props = CSaleOrderPropsValue::GetOrderProps($orderID);
	$phone="";
	$index = ""; 
	$country_name = "";
	$city_name = "";  
	$address = "";
	while ($arProps = $order_props->Fetch()) {
		if ($arProps["CODE"] == "PHONE") {
			$phone = htmlspecialchars($arProps["VALUE"]);
		}
		if ($arProps["CODE"] == "LOCATION") {
			$arLocs = CSaleLocation::GetByID($arProps["VALUE"]);
			$country_name =  $arLocs["COUNTRY_NAME_ORIG"];
			$city_name = $arLocs["CITY_NAME_ORIG"];
		}

		if ($arProps["CODE"] == "INDEX") {
			$index = $arProps["VALUE"];   
		}

		if ($arProps["CODE"] == "ADDRESS") {
			$address = $arProps["VALUE"];
		}
	}

	$full_address = $index.", ".$country_name."-".$city_name.", ".$address;

  //-- получаем название службы доставки
	$arDeliv = CSaleDelivery::GetByID($arOrder["DELIVERY_ID"]);
	$delivery_name = "";
	if ($arDeliv) {
		$delivery_name = $arDeliv["NAME"];
	}

  //-- получаем название платежной системы   
	$arPaySystem = CSalePaySystem::GetByID($arOrder["PAY_SYSTEM_ID"]);
	$pay_system_name = "";
	if ($arPaySystem) {
		$pay_system_name = $arPaySystem["NAME"];
	}

  //-- добавляем новые поля в массив результатов
	$arFields["PHONE"] =  $phone;
	$arFields["DELIVERY_NAME"] =  $delivery_name;
	$arFields["PAY_SYSTEM_NAME"] =  $pay_system_name;
	$arFields["FULL_ADDRESS"] = $full_address;   
}


define("TDSK_404", "/404.php");
AddEventHandler("main", "OnAfterEpilog", "Check404Error");
function Check404Error() {
	global $APPLICATION;
	if (!defined('ERROR_404') || ERROR_404 != 'Y') {
		return;
	}
	if ($APPLICATION->GetCurPage() != TDSK_404) {
		header('X-Accel-Redirect: '.TDSK_404);
		header("HTTP/1.0 404 Not Found");
		exit();
	}
}

AddEventHandler("main", "OnBeforeUserRegister", "OnBeforeUserUpdateHandler");
AddEventHandler("main", "OnBeforeUserUpdate", "OnBeforeUserUpdateHandler");
function OnBeforeUserUpdateHandler(&$arFields)
{

	$arFields["LOGIN"] = $arFields["EMAIL"];
	return $arFields;
}

AddEventHandler("sale", "OnBeforeOrderAdd", "OnBeforeOrderAddHandler");

function OnBeforeOrderAddHandler(&$arFields) {
	
	if($arFields['PERSON_TYPE_ID'] == 1){
		$userType = 2;
		$phone = $arFields['ORDER_PROP']['3'];
	} else {
		$userType = 1;
		$phone = $arFields['ORDER_PROP']['14'];
	}
	$user = new CUser;
	$fields = Array(
		"WORK_COMPANY" => $arFields['ORDER_PROP']['8'], //Наименование компании
		"PERSONAL_PHONE" => $phone,
		"UF_LEGAL_ADDRESS" => $arFields['ORDER_PROP']['9'], //Юридический адрес
		"UF_INN" => $arFields['ORDER_PROP']['10'], //ИНН
		"UF_USER_TYPE" => $userType,
		);
	$user->Update($arFields['USER_ID'], $fields);
}

AddEventHandler("iblock", "OnBeforeIBlockElementAdd", "AddElementOrSectionCode"); 
AddEventHandler("iblock", "OnBeforeIBlockElementUpdate", "AddElementOrSectionCode"); 
AddEventHandler("iblock", "OnBeforeIBlockSectionAdd", "AddElementOrSectionCode"); 
AddEventHandler("iblock", "OnBeforeIBlockSectionUpdate", "AddElementOrSectionCode"); 

function AddElementOrSectionCode(&$arFields) { 
	$params = array(
		"max_len" => "100", 
		"change_case" => "L", 
		"replace_space" => "_", 
		"replace_other" => "_", 
		"delete_repeat_replace" => "true", 
		"use_google" => "false", 
		);

	if (strlen($arFields["NAME"])>0 && strlen($arFields["CODE"])<=0 && $arFields["IBLOCK_ID"] == 6) {
		$arFields['CODE'] = CUtil::translit($arFields["NAME"], "ru", $params);    
	}
}

AddEventHandler("catalog", "OnSuccessCatalogImport1C", "ImportBrands");
// при импорте актуализируется инфоблок бренды
function ImportBrands() {
	$NS = &$_SESSION['BX_CML2_IMPORT']['NS'];
	if ($NS['brands']['finish'])
		return true;

	@set_time_limit(0);

	$xbrands = array();
	$property_enums = CIBlockPropertyEnum::GetList(Array("SORT"=>"ASC"), Array("IBLOCK_ID"=>6, "PROPERTY_CODE" => "BREND"));
	while($enum_fields = $property_enums->GetNext(true, false)) {
		$brands[$enum_fields['VALUE']] = $enum_fields['EXTERNAL_ID'];
		$xbrands[$enum_fields['EXTERNAL_ID']] = $enum_fields['VALUE'];
	}

			//обновляем инфоблок бренды из обновленных свойств инфоблока
	$res = CIBlockElement::GetList(Array(), Array("IBLOCK_ID"=> 8), false, false, Array("ID", "NAME", "ACTIVE"));
	while($ob = $res->GetNextElement())
	{
		$obEl = new CIBlockElement();
		$arFields = $ob->GetFields();

		$xkey = 0;
		$xkey = array_search($arFields['NAME'],$xbrands);

		if($xkey>0 && $arFields['ACTIVE']=='Y') {unset($xbrands[$xkey]);}
		if($xkey>0 && $arFields['ACTIVE']=='N'){
			$boolResult = $obEl->Update($arFields['ID'],array('ACTIVE' => 'Y'));	
			unset($xbrands[$xkey]);
		}
	}


	if (!empty($xbrands))
	{
		foreach ($xbrands as $k=>$brand) {
			$el = new CIBlockElement;  

			$fields = array(
				'IBLOCK_ID' => 8,
				'NAME' => $brand,
				'ACTIVE' => "Y",
				'SEARCHABLE_CONTENT' => $brand,
				'CREATED_BY' => '1',
				'MODIFIED_BY' => '1',
				'CODE' => CUtil::translit($brand, "ru" , Array("max_len" => "100", "change_case" => "L", "replace_space" => "_", "replace_other" => "_", "delete_repeat_replace" => "true", "use_google" => "false", ) ),
				);

		if ($PRODUCT_ID = $el->Add($fields)) { /*echo 'Добавлен элемент, ID: ' . $PRODUCT_ID;*/  } else {/*echo "Error[" . $PRODUCT_ID . "]: " . $el->LAST_ERROR . '<br />'; */  }
	}

}
unset($xbrands);



$result = "progress\nБренды импортированы.";
$NS['brands']['finish'] = true;

if (toUpper(LANG_CHARSET) != "WINDOWS-1251")
	$result = $GLOBALS['APPLICATION']->ConvertCharset($result, LANG_CHARSET, "windows-1251");
header("Content-Type: text/html; charset=windows-1251");
echo $result;
die();
}


AddEventHandler('main', 'OnEpilog', array('CMainHandlers', 'OnEpilogHandler'));  
class CMainHandlers { 
	public static function OnEpilogHandler() {
		if (isset($_GET['PAGEN_1']) && intval($_GET['PAGEN_1'])>0) {
			global $APPLICATION;
			$title = $APPLICATION->GetPageProperty('title');
			$GLOBALS['APPLICATION']->SetPageProperty('title', $title.' – Страница '.intval($_GET['PAGEN_1']).$arResult['NAME']);
			$description = $GLOBALS['APPLICATION']->GetProperty("description");
			$GLOBALS['APPLICATION']->SetPageProperty('description', $description.' – Страница '.intval($_GET['PAGEN_1']));
		}
	}
}

/*Bitrix\Main\EventManager::getInstance()->addEventHandler(
    'sale',
    'onSalePaySystemRestrictionsClassNamesBuildList',
    'myPayFunction'
);

function myPayFunction()
{
    return new \Bitrix\Main\EventResult(
        \Bitrix\Main\EventResult::SUCCESS,
        array(
            '\MyPayRestriction' => '/bitrix/php_interface/include/mypayrestriction.php',
        )
    );
}

use Bitrix\Sale\Services\Base;
use Bitrix\Sale\Internals\Entity;

class MyPayRestriction extends Base\Restriction
{
    public static function getClassTitle()
    {
        return 'по лунным суткам';
    }

    public static function getClassDescription()
    {
        return 'платежная система будет выводится только в указанном диапазоне лунных суток';
    }

public static function check($params, array $restrictionParams, $serviceId = 0)
{
    if ($params < $restrictionParams['MIN_MOONDAY']
        || $params > $restrictionParams['MAX_MOONDAY'])
        return false;

    return true;
}
protected static function extractParams(Entity $entity)
{
    $json = file_get_contents('http://moon-today.com/api/index.php?get=moonday');
    $res = json_decode($json, true);
    return !empty($res['moonday']) ? intval($res['moonday']) : 0;
}
public static function getParamsStructure($entityId = 0)
    {
        return array(
            "MIN_MOONDAY" => array(
                'TYPE' => 'NUMBER',
                'DEFAULT' => "1",
                'LABEL' => 'Минимальные сутки'
            ),
            "MAX_MOONDAY" => array(
                'TYPE' => 'NUMBER',
                'DEFAULT' => "30",
                'LABEL' => 'Максимальные сутки'
            )
        );
    }
}*/


?>