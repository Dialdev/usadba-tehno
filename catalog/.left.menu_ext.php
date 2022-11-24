<?
if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();

global $APPLICATION;
$aMenuLinksExt = array();

function compare ($v1, $v2) {
   return strnatcmp($v1[0], $v2[0]);
}
function SortMenu ($arMenu)
{
   usort($arMenu, "compare");
   return $arMenu;
}

if(CModule::IncludeModule('iblock'))
{
	$arFilter = array(
		"TYPE" => "catalog",
		"SITE_ID" => SITE_ID,
	);

	$dbIBlock = CIBlock::GetList(array('SORT' => 'ASC', 'ID' => 'ASC'), $arFilter);
	$dbIBlock = new CIBlockResult($dbIBlock);

	if ($arIBlock = $dbIBlock->GetNext())
	{
		if(defined("BX_COMP_MANAGED_CACHE"))
			$GLOBALS["CACHE_MANAGER"]->RegisterTag("iblock_id_".$arIBlock["ID"]);

		if($arIBlock["ACTIVE"] == "Y")
		{
			$aMenuLinksExt = $APPLICATION->IncludeComponent("bitrix:menu.sections", "", array(
				"IS_SEF" => "Y",
				"SEF_BASE_URL" => "/catalog/",
  				 "SECTION_PAGE_URL" => "#SECTION_CODE_PATH#/",
   				"DETAIL_PAGE_URL" => "#SECTION_CODE_PATH#/#ELEMENT_CODE#",
				"IBLOCK_TYPE" => $arIBlock['IBLOCK_TYPE_ID'],
				"IBLOCK_ID" => "6",
				"DEPTH_LEVEL" => "1",
				"CACHE_TYPE" => "N",
			), false, Array('HIDE_ICONS' => 'Y'));
			$aMenuLinksExt = SortMenu($aMenuLinksExt);
		}
	}

	if(defined("BX_COMP_MANAGED_CACHE"))
		$GLOBALS["CACHE_MANAGER"]->RegisterTag("iblock_id_new");
}

$aMenuLinks = array_merge($aMenuLinks, $aMenuLinksExt);
?>