	<?

require($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/prolog_before.php");

	CModule::IncludeModule("iblock");
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

		/*	$PROPERTY_CODE = 'NET_V_NALICHII';
		$PROPERTY_VALUE = 'Нет';
		$PROPERTY_VALUE1 ='Да';

		if($arFields['CATALOG_AVAILABLE'] == "Y") {
			CIBlockElement::SetPropertyValuesEx($arFields['ID'], $arParamsAPI1["IBLOCK"], array($PROPERTY_CODE => $PROPERTY_VALUE1));
		}
		else {
			CIBlockElement::SetPropertyValuesEx($arFields['ID'], $arParamsAPI1["IBLOCK"], array($PROPERTY_CODE => $PROPERTY_VALUE));
}*/


	}

$IBLOCK_ID = 6;
$properties = CIBlockProperty::GetList(Array("sort"=>"asc", "name"=>"asc"), Array("ACTIVE"=>"Y", "IBLOCK_ID"=>$IBLOCK_ID));
while ($prop_fields = $properties->GetNext())
{
print_r($prop_fields["NAME"]);
	unset($arFields["PREVIEW_TEXT"]);
	unset($prop_fields["NAME"]);
}

	?>	