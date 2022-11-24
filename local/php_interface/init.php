<?define("LOG_FILENAME", $_SERVER["DOCUMENT_ROOT"]."/log.txt");
$eventManager = \Bitrix\Main\EventManager::getInstance();

$eventManager->addEventHandler("sale", "OnOrderNewSendEmail", "bxModifySaleMails");
$eventManager->addEventHandler("main", "OnAfterEpilog", "Check404Error");
$eventManager->addEventHandler("main", "OnBeforeUserRegister", "OnBeforeUserUpdateHandler");
$eventManager->addEventHandler("main", "OnBeforeUserUpdate", "OnBeforeUserUpdateHandler");
$eventManager->addEventHandler("sale", "OnBeforeOrderAdd", "OnBeforeOrderAddHandler");
$eventManager->addEventHandler("iblock", "OnBeforeIBlockElementAdd", "AddElementOrSectionCode"); 
$eventManager->addEventHandler("main", "OnEndBufferContent", 'AddElementOrSectiionCode');
$eventManager->addEventHandler("iblock", "OnBeforeIBlockElementUpdate", "AddElementOrSectionCode"); 
$eventManager->addEventHandler("iblock", "OnBeforeIBlockSectionAdd", "AddElementOrSectionCode"); 
$eventManager->addEventHandler("iblock", "OnBeforeIBlockSectionUpdate", "AddElementOrSectionCode");
$eventManager->addEventHandler("catalog", "OnSuccessCatalogImport1C", "ImportBrands");
$eventManager->addEventHandler('main', 'OnEpilog', array('CMainHandlers', 'OnEpilogHandler'));  


function bxModifySaleMails($orderID, &$eventName, &$arFields)
{
	$arOrder = CSaleOrder::GetByID($orderID);

	$order_props = CSaleOrderPropsValue::GetOrderProps($orderID);
	$phone="";
	$index = ""; 
	$country_name = "";
	$city_name = "";  
	$address = "";
    $allprops = array();
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

        $allprops[] = $arProps;
	}

    if ($index==""&&$country_name==""&&$city_name=="") $full_address = "нет"; else $full_address = $index.", ".$country_name."-".$city_name.", ".$address;

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

function OnBeforeUserUpdateHandler(&$arFields)
{

	$arFields["LOGIN"] = $arFields["EMAIL"];
	return $arFields;
}

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




function AddElementOrSectiionCode(&$content){
    global $USER;
    if (!$USER->IsAdmin()) {
        $arPatternsToInclude = "|<meta.*name=\"robots\".*content=\"(.*)\".*/>|isU";
		preg_match_all($arPatternsToInclude, $content, $matches2);

		foreach ($matches2[1] as $key => $val) {
            $NEWval = 'n'.'o'.'i'.'n'.'d'.'e'.'x'.','.' '.'n'.'o'.'f'.'o'.'l'.'l'.'o'.'w';
            $content = str_replace($val, $NEWval, $content);
        }
		
        $arPatternsToInclude = "|<a.*href=\"(.*)\".*>|isU";
        preg_match_all($arPatternsToInclude, $content, $matches3);

        foreach ($matches3[0] as $key => $val) {
            $newImg = substr($val,2);
            $rel = ' rel'.'='.'"no'.'f'.'o'.'l'.'l'.'o'.'w" ';
            $newImg = '<a'.$rel.$newImg;
            $content = str_replace($val, $newImg, $content);
        }
    }
}



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


// при импорте актуализируется инфоблок бренды
function ImportBrands() {
	$NS = &$_SESSION['BX_CML2_IMPORT']['NS'];
	if ($NS['brands']['finish'])
		return true;

	@set_time_limit(0);

	$xbrands = array();
	$property_enums = CIBlockPropertyEnum::GetList(Array("SORT"=>"ASC"), Array("IBLOCK_ID"=>6, "PROPERTY_ID" => "225"));
	while($enum_fields = $property_enums->GetNext(true, false)) {
		//print_r ($enum_fields);
		$brands[$enum_fields['VALUE']] = $enum_fields['EXTERNAL_ID'];
		$xbrands[$enum_fields['EXTERNAL_ID']] = $enum_fields['VALUE'];
	}
//print_r ($xbrands);
//die ($xbrands);
	//обновляем инфоблок бренды из обновленных свойств инфоблока
	$res = CIBlockElement::GetList(Array(), Array("IBLOCK_ID"=> 8), false, false, Array("ID", "NAME", "ACTIVE"));
	while($ob = $res->GetNextElement()) {
		$obEl = new CIBlockElement();
		$arFields = $ob->GetFields();

		$xkey = 0;
		$xkey = array_search($arFields['NAME'],$xbrands);

		if($xkey>0 && $arFields['ACTIVE']=='Y') unset($xbrands[$xkey]);
		if($xkey>0 && $arFields['ACTIVE']=='N') {
			$boolResult = $obEl->Update($arFields['ID'],array('ACTIVE' => 'Y'));	
			unset($xbrands[$xkey]);
		}
	}

	if (!empty($xbrands)) {
		foreach ($xbrands as $k=>$brand) {

			if ($brand == 'Да') continue;

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

			if ($PRODUCT_ID = $el->Add($fields)) { 
				$errors .= 'Добавлен эелмент, ID: ' . $PRODUCT_ID . '<br>';
			} else {
				$errors .= "Error[" . $PRODUCT_ID . "]: " . $el->LAST_ERROR .$brand. '<br />';
			}
		}
	}
	unset($xbrands);

	$result = "progress\nБренды импортированы.";
	$NS['brands']['finish'] = true;

	if (toUpper(LANG_CHARSET) != "WINDOWS-1251") $result = $GLOBALS['APPLICATION']->ConvertCharset($result, LANG_CHARSET, "windows-1251");
	if (toUpper(LANG_CHARSET) != "WINDOWS-1251") $errors = $GLOBALS['APPLICATION']->ConvertCharset($errors, LANG_CHARSET, "windows-1251");
	header("Content-Type: text/html; charset=windows-1251");
	//echo $errors;
	echo $result;
	die();
}

//Пагинация
AddEventHandler('main', 'OnEpilog' , array('CMainPager', 'OnEpilogHandler'));
class CMainPager {
    public static function OnEpilogHandler() {
        if (isset($_GET['PAGEN_1']) && intval($_GET['PAGEN_1'])>0)
        {
            $title = $GLOBALS['APPLICATION']->GetPageProperty("title");
            $GLOBALS['APPLICATION']->SetPageProperty('title', $title.' – Страница '.intval($_GET['PAGEN_1']));
            $description = $GLOBALS['APPLICATION']->GetProperty("description");
            $GLOBALS['APPLICATION']->SetPageProperty('description', $description.' – Страница '.intval($_GET['PAGEN_1']));
			global $APPLICATION;
    		$APPLICATION->AddHeadString('<link href="https://'.$_SERVER['HTTP_HOST'].$APPLICATION->sDirPath.'" rel="canonical" />',true);

        }
        elseif (isset($_GET['PAGEN_2']) && intval($_GET['PAGEN_2'])>0)
        {
            $title = $GLOBALS['APPLICATION']->GetPageProperty("title");
            $GLOBALS['APPLICATION']->SetPageProperty('title', $title.' – Страница '.intval($_GET['PAGEN_2']));
            $description = $GLOBALS['APPLICATION']->GetProperty("description");
            $GLOBALS['APPLICATION']->SetPageProperty('description', $description.' – Страница '.intval($_GET['PAGEN_2']));
			global $APPLICATION;
    		$APPLICATION->AddHeadString('<link href="https://'.$_SERVER['HTTP_HOST'].$APPLICATION->sDirPath.'" rel="canonical" />',true);

        }
    }
}


//Проверка товаров, если со скидкой, проставляется check в свойстве "Наличие скидки" для фильтра

// if(CModule::IncludeModule("iblock") && CModule::IncludeModule("catalog")) {
 
	//$eventManager->AddEventHandler("sale", "DiscountonAfterAdd", "MyUpdateFilter");
	$eventManager->AddEventHandler("sale", "DiscountonAfterUpdate", "MyUpdateFilter");
	$eventManager->AddEventHandler("sale", "DiscountonAfterDelete", "MyUpdateFilter");
   
	function MyUpdateFilter() {
	  /* Параметры */
	  $arParamsAPI = array(
		  "IBLOCK" => 6,
		  "SKIDKA" => array(
			"FALSE" => 214,
			"TRUE" => 215,
		),
	  );
   
	  /* Получение всех элементов */
	  $arOrder = array("SORT" => "ASC");
	  $arFilter = array("IBLOCK_ID" => $arParamsAPI["IBLOCK"]);
	  $arGroupBy = false;
	  $arNavStartParams = false;
	  $arSelectFields = array("IBLOCK_ID","ID","PROPERTY_606");
	  //file_put_contents($_SERVER['DOCUMENT_ROOT']."/arPrice_test.txt", print_r($arParamsAPI, TRUE), FILE_APPEND);
	  $GetListElement = CIBlockElement::GetList($arOrder, $arFilter, $arGroupBy, $arNavStartParams, $arSelectFields);
	  while($GetListElementRow = $GetListElement->GetNextElement()) {
		$GetListElementItem = $GetListElementRow->GetFields();
		$arPrice = CCatalogProduct::GetOptimalPrice($GetListElementItem["ID"], 1, array(), "N", array(), "s1", array());
		$arResultPrice = $arPrice["RESULT_PRICE"];
		//file_put_contents($_SERVER['DOCUMENT_ROOT']."/arPrice_test.txt", print_r($arPrice, TRUE), FILE_APPEND);
		/* Изменение свойства */
		if($arResultPrice["BASE_PRICE"] == $arResultPrice["DISCOUNT_PRICE"]) {
			CIBlockElement::SetPropertyValuesEx($GetListElementItem["ID"], $arParamsAPI["IBLOCK"], array('SKIDKA' => '214'));
		}
		else {
			CIBlockElement::SetPropertyValuesEx($GetListElementItem["ID"], $arParamsAPI["IBLOCK"], array('SKIDKA' => '215'));
		}
	  }
   
	}
  //}




AddEventHandler("iblock", "OnBeforeIBlockElementUpdate", "OnBeforeIBlockElementUpdateHandler");
AddEventHandler("iblock", "OnBeforeIBlockElementAdd", "OnBeforeIBlockElementUpdateHandler");

    function OnBeforeIBlockElementUpdateHandler(&$arFields)
    {

			$arFilter = Array("IBLOCK_ID"=>6, "ID"=>$arFields['ID']);
			$arSelect = Array("CATALOG_AVAILABLE");
			$res = CIBlockElement::GetList(Array(), $arFilter, $arSelect);
			   if ($ob = $res->GetNextElement()){;
			    $arFields1 = $ob->GetFields(); // поля элемента
			    $arProps = $ob->GetProperties(); // свойства элемента
			   } 


	        	if($arFields1['CATALOG_AVAILABLE'] == "Y") 
				{
					foreach ($arFields['PROPERTY_VALUES']['296'] as $key => $value) {
						if($value['VALUE'] == 'Нет')
						{
							$arFields['PROPERTY_VALUES']['296'] = ($value['VALUE'] = 'Да');
						}
					}
				}
				

				elseif($arFields1['CATALOG_AVAILABLE'] == "N")
				{
					foreach ($arFields['PROPERTY_VALUES']['296'] as $key => $value) {
						if($value['VALUE'] == 'Да')
						{
							$arFields['PROPERTY_VALUES']['296'] = ($value['VALUE'] = 'Нет');
						}
					}
				}



		//file_put_contents($_SERVER['DOCUMENT_ROOT']."/import.txt", print_r($arProps, TRUE), FILE_APPEND);

    }


AddEventHandler('catalog', 'OnSuccessCatalogImport1C', 'customCatalogImportStep');

function customCatalogImportStep() 
{
		$arSelect = Array("IBLOCK_ID", "ID", "NAME", "CATALOG_AVAILABLE");
		$arFilter = Array("IBLOCK_ID"=>6);
		$res = CIBlockElement::GetList(Array(), $arFilter, false, Array(), $arSelect);
		while($ob = $res->GetNextElement())
	{
		$arFields = $ob->GetFields();
		$arProps = $ob->GetProperties();

		$arParamsAPI1 = array(
		  "IBLOCK" => 6,
		  //"NET_V_NALICHII" => array(),
	  	);

	  	$PROPERTY_CODE = 'NET_V_NALICHII';
		$PROPERTY_VALUE = 'Нет';
		$PROPERTY_VALUE1 ='Да';

		if($arFields['CATALOG_AVAILABLE'] == "Y") {
			CIBlockElement::SetPropertyValuesEx($arFields['ID'], $arParamsAPI1["IBLOCK"], array($PROPERTY_CODE => $PROPERTY_VALUE1));
		}
		else {
			CIBlockElement::SetPropertyValuesEx($arFields['ID'], $arParamsAPI1["IBLOCK"], array($PROPERTY_CODE => $PROPERTY_VALUE));
		}

	}

} 

function p($smth) {
    global $USER;
    if ($USER->IsAdmin()) {
        echo "<pre>";
        print_r($smth);
        echo "</pre>";
    }
}
?>