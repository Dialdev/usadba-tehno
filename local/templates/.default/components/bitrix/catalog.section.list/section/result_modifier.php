<?if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();

function compareSec ($v1, $v2) {
   return strnatcmp($v1["NAME"], $v2["NAME"]);
}
function SortSec ($arMenu)
{
   usort($arMenu, "compareSec");
   return $arMenu;
}


$arResult["SECTIONS_ALFA"] = SortSec($arResult["SECTIONS"]);



?>