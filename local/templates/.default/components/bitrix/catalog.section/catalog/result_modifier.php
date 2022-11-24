<?if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
// p($arResult['ITEMS']);
if ($USER->IsAdmin()) { 
	foreach ($arResult['ITEMS'] as $key => $arItem) {
		if ($arItem['CATALOG_QUANTITY']!=0) {
			$arResult['ITEMS'][$key]['CATALOG_QUANTITY'] = 1;
		}
	}
}
foreach ($arResult['ITEMS'] as &$arItem):
     $img = $arItem['DETAIL_PICTURE'];
    if (!empty($img)) {
        $arItem['RESIZED_IMAGE'] = CFile::ResizeImageGet($img, array('width'=>168, 'height'=>205), BX_RESIZE_IMAGE_PROPORTIONAL, true);
    } else {
        $arItem['RESIZED_IMAGE']['SRC'] = "/local/templates/index/images/no_photo.png";
    }
    $arItem['RESIZED_IMAGE']['ALT'] = $arItem['NAME'];
    $arItem['RESIZED_IMAGE']['TITLE'] = $arItem['NAME'];

    // if(!empty($arItem['PRICES']['base']['DISCOUNT_DIFF'])){
    //     $arItem['PROPERTIES']['SKIDKA']['VALUE_XML_ID'] = 'Y';
    // }
endforeach;


// $arSection = CIblockSection::GetById($arResult["ID"])->GetNext();
// $arResult['SECTION_PAGE_URL'] = $arSection['SECTION_PAGE_URL'];
// $cp = $this->__component; 
// if (is_object($cp))
// $cp->SetResultCacheKeys(array('SECTION_PAGE_URL'));

?>