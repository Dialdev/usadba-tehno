<?if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();


$price = array();
foreach($arResult['SECTIONS'] as $key => $arSection){
	$arSelect = Array();
$arFilter2 = Array("IBLOCK_ID"=> 6, "SECTION_ID"=> $arSection['ID'], "ACTIVE"=>"Y");
$res = CIBlockElement::GetList(Array('CATALOG_PRICE_1' => 'ASC'), $arFilter2, false, Array(), $arSelect);

while($ob = $res->GetNextElement())
{
$arFields = $ob->GetFields();
$arRes[] = $arFields;
// цена
$price['sec'][] = CPrice::GetBasePrice($arFields['ID']);

}
$arResult['SECTIONS'][$key]['MIN_PRICE_CUSTOM'] = $price[0]['PRICE'];
$arSection['min_price'] = $price[0]['PRICE'];

}

/* Получение цены для элементов - начало */
/*
$Sections = array();

foreach($arResult['SECTIONS'] as $key => $arSection){
	$res = CIBlockElement::GetList(
		array('CATALOG_PRICE_1'=>'ASC'),
		Array(
			"IBLOCK_ID" => 6,
			"ACTIVE_DATE" => "Y",
			"ACTIVE" => "Y",
			"SECTION_GLOBAL_ACTIVE" => "Y",
			"SECTION_ID" => $arSection['ID'],
			"!IBLOCK_SECTION_ID" => array(840, 847, 839, 843, 841, 353, 1236, 848, 413, 844, 842, 878, 838, 852, 851, 837, 815, 845, 846, 850, 797, 849, 367, 335, 336, 337, 448, 857, 1248, 905, 890, 1247, 1236, 811, 898, 900, 842, 415, 418, 421, 559),// Исключение разделов с запчастями и доп оборудованием
			
			"INCLUDE_SUBSECTIONS" => "Y",
			">CATALOG_PRICE_1" => "0",
			"!SECTION_ID" => array(545),
			">CATALOG_QUANTITY" => "0",
			
		),
		false,
		false,
		array(
			"ID",
			"NAME",
			"IBLOCK_SECTION_ID",
			"DETAIL_PAGE_URL",
			"TIMESTAMP_X",
			"ACTIVE",
			"CATALOG_GROUP_1",
		)
	)->Fetch();
	$Sections[$arSection['ID']] = $res;
	$arResult['SECTIONS'][$key]['MIN_PRICE_CUSTOM'] = $res['CATALOG_PRICE_1'];
 	
}*/
/* Получение цены для элементов - окончание */
// global $USER;
// if($USER->isAdmin()){
// 	echo "<pre>";
// 	print_r($arResult['SECTIONS']);
// 	echo "</pre>";
// }
?>