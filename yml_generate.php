<?/*
//Save UTF-8 без BOM
//Отключаем статистику Bitrix
define("NO_KEEP_STATISTIC", true);
//Подключаем движок
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/prolog_before.php");
// Тип документа
header('Content-Type: text/xml; charset="utf-8"');
//header('Content-Type: text/html; charset=utf-8');
CModule::IncludeModule("catalog") ;
$site = "https://www.usatba-texno.ru";

$array_iblocks_id = array('6'); 
if(CModule::IncludeModule("iblock")) {
	foreach($array_iblocks_id as $iblock_id)
	{
		// Список разделов
   		$res = CIBlockSection::GetList(
	      	array(),
	      	Array(
	         	"IBLOCK_ID" => $iblock_id,
	         	"ACTIVE" => "Y"
	      	),
      		false,
    		array(
    		"ID",
    		"NAME",
    		"SECTION_PAGE_URL",
    		"TIMESTAMP_X"
    	));
      
   		while($ob = $res->GetNext())
   		{
			$arrCategory[] = array(
			   	'NAME' => $ob['NAME'],
			   	'URL' => $ob['SECTION_PAGE_URL'],
			   	'LASTMOD' => $ob['TIMESTAMP_X'],
                'ID' => $ob['ID'],
                'IBLOCK_ID' => $ob['IBLOCK_ID']
			);
   		}

		//Список элементов
   		$res = CIBlockElement::GetList(
	      	array(),
	      	Array(
	         	"IBLOCK_ID" => $iblock_id,
	         	"ACTIVE_DATE" => "Y",
	         	"ACTIVE" => "Y"
	      	),
      		false,
      		false,
    		array(
    		"ID",
    		"NAME",
    		"DETAIL_PAGE_URL",
    		"TIMESTAMP_X",
    		"PREVIEW_TEXT",
    		"DETAIL_PICTURE",
    		"CATALOG_GROUP_1",
    	));
        
   		while($ob = $res->GetNext())
   		{
			$arrElement[] = array(
			   	'NAME' => $ob['NAME'],
			   	'URL' => $site.$ob['DETAIL_PAGE_URL'],
			   	'LASTMOD' => $ob['TIMESTAMP_X'],
                'ID' => $ob['ID'],
                'IBLOCK_ID' => $ob['IBLOCK_ID'],
                'PREVIEW_TEXT' => $ob['PREVIEW_TEXT'],
                'DETAIL_PICTURE' => $site.$arFile,
                'PRICE' => $arPrice["PRICE"],
			);
            
          $arFile = CFile::GetPath($ob["DETAIL_PICTURE"]);
          $rsPrices = CPrice::GetList(array(),array('PRODUCT_ID' => $ob['ID']),array('CATALOG_GROUP_ID' => 1)); //Получаем массив свойств товара
          if($arPrice = $rsPrices->Fetch());

   		}
	}
}

//echo '<pre>'; print_r($arrElement); echo '</pre>';


foreach ($arrCategory as $v) {
    $name = str_replace('&','&amp;',$v['NAME']); // Исключаем из заголовков амперсанды
    $xml_content_iblock.='<category id="'.$v['ID'].'" parentId="'.$v['IBLOCK_ID'].'">'.$name.'</category>';
    // echo "<p>";
    //  echo $xml_content_iblock;
    //echo "</p>";
    //unset($xml_content_iblock);
}

foreach ($arrElement as $v) {
    $name = str_replace('&','&amp;',$v['NAME']); // Исключаем из заголовков амперсанды
    $xml_content_element.='
        <offer id="'.$v['ID'].'" available="true">
            <url>'.$v['URL'].'</url>
            <price>'.$v['PRICE'].'</price>
            <currencyId>RUR</currencyId>
            <categoryId type="Own">'.$v['IBLOCK_ID'].'</categoryId>
            <picture>'.$v['DETAIL_PICTURE'].'</picture>
            <name>'.$name.'</name>
            <language>rus</language>
            <description>'.$name.'</description>
            <downloadable>false</downloadable>
        </offer>';
}



$today = date("Y-m-d H:i:s"); 
echo '<?xml version="1.0" encoding="utf-8"?>
<yml_catalog date="'.$today.'">
    <shop>
        <name>Усадьба техно</name>
        <company>Усадьба техно</company>
        <url>'.$site.'</url>
        <currencies>
            <currency id="RUR" rate="1" plus="0"/>
        </currencies>
        <categories>
        '.$xml_content_iblock.'
        </categories>
        <offers>
        '.$xml_content_element.'
        </offers>  
    </shop>
</yml_catalog>';
*/?>