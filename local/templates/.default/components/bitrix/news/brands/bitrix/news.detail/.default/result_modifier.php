<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>
<?
$counts = array();
$res = CIBlockElement::GetList(array(), array('GLOBAL_ACTIVE' => 'Y', "PROPERTY_BREND_VALUE" => $arResult["NAME"], 'CATALOG_AVAILABLE' => 'Y', 'IBLOCK_ID' => "6"), array("IBLOCK_SECTION_ID"), false, array("IBLOCK_SECTION_ID"));
while ($item = $res->GetNext()) {
	$counts[$item["IBLOCK_SECTION_ID"]] = $item["CNT"];
}

$sections = array();
$rsSect = CIBlockSection::GetList(array(), array('GLOBAL_ACTIVE' => 'Y', 'IBLOCK_ID' => "6", "ID" => array_keys($counts)), false, array("ID", "SECTION_PAGE_URL", "NAME", "IBLOCK_SECTION_ID"));
while ($arSect = $rsSect->GetNext())
{
	$count = $counts[$arSect["ID"]];
	$arSect["COUNT"] = $count;
	$sections[] = $arSect["IBLOCK_SECTION_ID"];
	$arResult['SECTION_LINK'][$arSect['IBLOCK_SECTION_ID']][] = $arSect;
}

$rsSect = CIBlockSection::GetList(array(), array('GLOBAL_ACTIVE' => 'Y', 'IBLOCK_ID' => "6", "ID" => $sections), false, array("ID",  "NAME"));
while ($arSect = $rsSect->GetNext())
{
	$arResult['SECTION_LINK'][$arSect['ID']][0]['PARENT_NAME'] = $arSect['NAME'];
}

// Получаем значение XML_ID для фильтра
$arFilter = array(
  'IBLOCK_ID' => '6',  
  'CODE' => 'BREND',
);

$rsProperty = CIBlockPropertyEnum::GetList(array(), $arFilter);
while($property = $rsProperty->Fetch()) {
	if ($property['VALUE'] == $arResult['NAME']) {
		$arResult['CUSTOM_FILTER_PROP'] = $property['XML_ID'];
		break;
	}
}
?>