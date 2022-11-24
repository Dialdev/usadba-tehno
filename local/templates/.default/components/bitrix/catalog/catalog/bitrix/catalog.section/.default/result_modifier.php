<?if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();

if ($USER->IsAdmin()) { 
	foreach ($arResult['ITEMS'] as $key => $arItem) {
		if ($arItem['CATALOG_QUANTITY']!=0) {
			$arResult['ITEMS'][$key]['CATALOG_QUANTITY'] = 1;
		}
	}
}?>