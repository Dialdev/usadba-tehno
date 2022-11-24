<?
/**
*   Company developer: ALTASIB
*   Developer: Toporikov Sergey
*   Site: http://www.altasib.ru
*   E-mail: dev@altasib.ru
*   Copyright (c) 2006-2016 ALTASIB
**/

global $DBType;
IncludeModuleLangFile(__FILE__);

$arClassesList = array(
	// main classes
	"CAltasibDiscountReauth" => "classes/mysql/class.php",
	// API classes
);
// fix strange update bug
if (method_exists(CModule, "AddAutoloadClasses"))
{
	CModule::AddAutoloadClasses(
		"altasib.discounts",
		$arClassesList
	);
}
else
{
	foreach ($arClassesList as $sClassName => $sClassFile)
	{
		require_once($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/altasib.discounts/".$sClassFile);
	}
}
Class CAltasibDiscounts
{	
	Function RecalcDiscountGroup($USER_ID)
	{
		if($GLOBALS["NO_RECALC_DISCOUNT"] || $USER_ID <= 0)
			return;
	
		$arGroups = CUser::GetUserGroup($USER_ID);
	
		// Groups No Discounts
		$sGrNoDiscounts = COption::GetOptionString("altasib.discounts", "no_group_discount");
		$arGrNoDiscounts = explode(",", $sGrNoDiscounts);
	
		$result = array_intersect ($arGroups, $arGrNoDiscounts);
	
		$bSkip = false;
		if(!empty($result))
		{
			$bSkip = true;
		}
		global $APPLICATION, $USER, $DB, $USER_FIELD_MANAGER;
		if(CModule::IncludeModule("catalog") && CModule::IncludeModule("sale"))
		{
			$bIncPriceDelivery  = COption::GetOptionString("altasib.discounts", "inc_price_delivery", "N") == 'Y';
			
			$arFilter = array(
				'ACTIVE' => 'Y',
				"NOTES" => "ALTASIB_DISCOUNTS",
			);
			$dbResultList = CCatalogDiscount::GetList(
				array("VALUE" => "DESC"),
				$arFilter,
				false,
				false,
				array("ID", "SITE_ID", "ACTIVE", "NAME", "VALUE", "CURRENCY")
			);
			while ($arDiscount = $dbResultList->GetNext())
			{
				$arDiscount["PERIOD"] = COption::GetOptionString("altasib.discounts", "period_for_discount_".$arDiscount["ID"], "Y");
				$arDiscount["LIMIT"] = COption::GetOptionInt("altasib.discounts", "limit_for_discount_".$arDiscount["ID"], "");
				$arDiscount["GROUP"] = COption::GetOptionInt("altasib.discounts", "group_for_discount_".$arDiscount["ID"], "");
				$arDiscount["PAYS"] = explode(";",COption::GetOptionString("altasib.discounts", "pays_for_discount_".$arDiscount["ID"], ""));
				TrimArr($arDiscount["PAYS"]);
				
				$arDiscounts[$arDiscount["ID"]] = $arDiscount;
			}
			
			if(!empty($arDiscounts))
				usort($arDiscounts, create_function('$a, $b', 'if($a["LIMIT"] == $b["LIMIT"]) return 0; return ($a["LIMIT"] > $b["LIMIT"])? 1 : -1;'));
							
			$UFields = $USER_FIELD_MANAGER->GetUserFields("USER", $USER_ID);
			
			$UF_OFFLINE_SUM = COption::GetOptionString("altasib.discounts", "sum_offline");
			
			$OFFLINE_SUM = 0;
			if($UF_OFFLINE_SUM)
			{
				$arUField = $UFields[$UF_OFFLINE_SUM];
				
				$OFFLINE_SUM = $arUField['VALUE']; 
			}
			
			$USER_PERSONAL_DISCOUNT = $USER_PERSONAL_ORDER_SUM = 0;
			$lastDiscount = $maxDiscountGroup = false;
			$arMaxDiscountGroups = array();
	
			foreach($arDiscounts as $ID=>$arDiscount)
			{	
				if($bSkip && $arDiscount["GROUP"])
				{
					$pos = array_search($arDiscount["GROUP"], $arGroups);
					if($pos !== false)
						unset($arGroups[$pos]);
				}
				else
				{
					$sumPrice = 0;
					$arFilter = Array(
						"USER_ID" => $USER_ID,
						"PAYED" => "Y",
						//">=DATE_INSERT" => date($DB->DateFormatToPHP(CSite::GetDateFormat("SHORT")), mktime(0, 0, 0, date("m")-$arDiscount["PERIOD"], date("d"), date("Y")))
					);
					if($arDiscount["PERIOD"] > 0)
					{
						$arFilter[">=DATE_INSERT"] = date($DB->DateFormatToPHP(CSite::GetDateFormat("SHORT")), mktime(0, 0, 0, date("m")-$arDiscount["PERIOD"], date("d"), date("Y")));
					}
					if(!empty($arDiscount["PAYS"]) && is_array($arDiscount['PAYS']))
					{
						$arFilter['PAY_SYSTEM_ID'] = $arDiscount["PAYS"];
					}
					$db_sales = CSaleOrder::GetList(array("DATE_INSERT" => "ASC"), $arFilter, false, false,array("ID","PRICE", "PRICE_DELIVERY"));
					while ($ar_sales = $db_sales->Fetch())
					{
						if($bIncPriceDelivery)
							$sumPrice += $ar_sales["PRICE"];
						else
							$sumPrice += $ar_sales["PRICE"] - $ar_sales["PRICE_DELIVERY"];
					}
					
					
					if(($OFFLINE_SUM + $sumPrice) >= $arDiscount["LIMIT"] && $arDiscount["LIMIT"] > 0 && $arDiscount["GROUP"])
					{
						// New Discount Group Link
						//$arGroups[] = $arDiscount["GROUP"];
	
						//if($arDiscount["ACTIVE"] == "Y" && $arDiscount["VALUE"] > $USER_PERSONAL_DISCOUNT)
						//$USER_PERSONAL_DISCOUNT = $arDiscount["VALUE"];
						
						// New Discount Group Link
// 						if($arDiscount["VALUE"] >= $USER_PERSONAL_DISCOUNT)
// 						{
						
						
							if($arDiscount["GROUP"] != $maxDiscountGroup && $USER_PERSONAL_DISCOUNT == $arDiscount["VALUE"])
							{
								// more_site
								if(!isset($arMaxDiscountGroups[$USER_PERSONAL_DISCOUNT][$maxDiscountGroup]))
									$arMaxDiscountGroups[$USER_PERSONAL_DISCOUNT][$maxDiscountGroup] = $maxDiscountGroup;
								$arMaxDiscountGroups[$USER_PERSONAL_DISCOUNT][$arDiscount["GROUP"]] = $arDiscount["GROUP"];
							}
						
							if($lastDiscount && $lastDiscount["LIMIT"] && $arDiscount["LIMIT"] < $lastDiscount["LIMIT"])
							{
								$maxDiscountGroup = $lastDiscount["GROUP"];
								//if($lastDiscount["ACTIVE"] == "Y")
								$USER_PERSONAL_DISCOUNT = $lastDiscount["VALUE"];
							}
							else
							{
								$maxDiscountGroup = $arDiscount["GROUP"];
								//if($arDiscount["ACTIVE"] == "Y")
								$USER_PERSONAL_DISCOUNT = $arDiscount["VALUE"];
							}
						//}
					}
					//elseif($arDiscount["GROUP"])
					if($arDiscount["GROUP"])
					{
						$pos = array_search($arDiscount["GROUP"], $arGroups);
						if($pos !== false)
						unset($arGroups[$pos]);
					}
					$USER_PERSONAL_ORDER_SUM = $sumPrice;
				}
				$lastDiscount = $arDiscount;
			}
			 
			if(!empty($arMaxDiscountGroups) && !empty($arMaxDiscountGroups[$USER_PERSONAL_DISCOUNT]) && Is_array($arMaxDiscountGroups[$USER_PERSONAL_DISCOUNT]))
				$arGroups = array_merge($arGroups, $arMaxDiscountGroups[$USER_PERSONAL_DISCOUNT]);
			elseif($maxDiscountGroup)
				$arGroups[] = $maxDiscountGroup;
			
			$arGroups = array_unique($arGroups);
		
			CUser::SetUserGroup($USER_ID, $arGroups);
		
			$newUserFieldValues = array();
			foreach($UFields as $uKey=>$uField)
			{
				if($uField["USER_TYPE_ID"] == 'AltasibDiscountValue')
				{
					$newUserFieldValues[$uField["FIELD_NAME"]] = $USER_PERSONAL_DISCOUNT;
				}
				if($uField["USER_TYPE_ID"] == 'AltasibDiscountOrdersSum')
				{
					$newUserFieldValues[$uField["FIELD_NAME"]] = $USER_PERSONAL_ORDER_SUM;
				}
			}
			if(count($newUserFieldValues) > 0)
			{
				$USER_FIELD_MANAGER->Update("USER", $USER_ID, $newUserFieldValues);
			}
	
			$GLOBALS["NO_RECALC_DISCOUNT"] = true;
	
			if($USER->IsAuthorized() && $USER_ID == $USER->GetID())
			$USER->Authorize($USER_ID);
			else
			{
				if(CModule::IncludeModule("altasib.reauth") && class_exists("CAltasibReAuthBase"))
				{
					CAltasibReAuthBase::Add($USER_ID, 1);
				}
				elseif(CModule::IncludeModule("altasib.discounts"))
				{
					CAltasibDiscountReauth::Add($USER_ID);
				}
			}
		}
	}

	Function OnAuthorize()
	{
		CAltasibDiscounts::RecalcDiscountGroup($GLOBALS["USER"]->GetID());
	}
	Function OnSalePayOrder($ID, $val)
	{
		if($ID && CModule::IncludeModule("sale"))
		{
			$arFilter = Array(
				"ID" => $ID,
			);
			$db_sales = CSaleOrder::GetList(array(), $arFilter, false, false,array("ID","USER_ID"));
			if ($ar_sales = $db_sales->Fetch())
			{
				CAltasibDiscounts::RecalcDiscountGroup($ar_sales["USER_ID"]);
			}
		}
	}


	Function OnProlog()
	{
		global $USER, $APPLICATION;
		if($_REQUEST["action"] == 'AltasibDiscountReCalc' && $_REQUEST["UID"]>0)
		{
			$APPLICATION->RestartBuffer();
			CAltasibDiscounts::RecalcDiscountGroup(intval($_REQUEST["UID"]));
			echo "OK!";
			die();
		}
		if($USER->IsAuthorized())
		{
			if(CModule::IncludeModule("altasib.reauth"))
			{
				// continue; do CAltasibReauth::DoReauth
			}
			elseif(CModule::IncludeModule("altasib.discounts"))
			{

				$USER_ID = $USER->GetID();

				if(CAltasibDiscountReauth::Get($USER_ID))
				{
					$USER->Authorize($USER_ID);
					//print_r($USER_ID);
					CAltasibDiscountReauth::Delete($USER_ID);
				}
			}
		}
	}
	
	Function OnAfterUserUpdate(&$arFields)
	{
		$UF_OFFLINE_SUM = COption::GetOptionString("altasib.discounts", "sum_offline");
		if($UF_OFFLINE_SUM)
			CAltasibDiscounts::RecalcDiscountGroup(intval($arFields["ID"]));
	}
}?>