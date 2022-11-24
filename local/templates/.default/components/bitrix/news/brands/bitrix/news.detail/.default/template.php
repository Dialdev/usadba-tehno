<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
/** @var array $arParams */
/** @var array $arResult */
/** @global CMain $APPLICATION */
/** @global CUser $USER */
/** @global CDatabase $DB */
/** @var CBitrixComponentTemplate $this */
/** @var string $templateName */
/** @var string $templateFile */
/** @var string $templateFolder */
/** @var string $componentPath */
/** @var CBitrixComponent $component */
$this->setFrameMode(true);
?>

<div class="leftbar">
  <div class="menu-catalog">
    <ul>
		<?
		foreach ($arResult["SECTION_LINK"] as $key => $arRazd) {?>
			<? $product_count = CIBlockElement::GetList (
				Array(),
				Array('SECTION_ID' => $arRazd[0]['ID'], 'PROPERTY_BREND_VALUE' => $arResult['NAME'], 'CATALOG_AVAILABLE' => 'Y', '!CATALOG_PRICE_1' => 0),
				array(),
				false,
				Array ('ID', 'NAME', 'CATALOG_PRICE_1')
			);?>
			<?
			if (!empty($arResult['CUSTOM_FILTER_PROP'])) {
				$filter = 'filter/brend-is-' . $arResult['CUSTOM_FILTER_PROP'] . '/apply/';
			}
			?>
			<li><a href="<?=$arRazd[0]["SECTION_PAGE_URL"] . $filter?>"><?=$arRazd[0]["PARENT_NAME"]." ".$arRazd[0]["NAME"]?> (<?=$product_count?>)</a></li>
		<?}?>		      
		</ul>
	</div>
</div>

<div class="rightbar">
	<h1><?=$arResult["NAME"]?></h1>
	<?global $arrFilterSale;
	$arrFilterSale = array
	(
	   'PROPERTY_225_VALUE' => $arResult["NAME"],
	   '!CATALOG_PRICE_1' => 0
	); ?> 

	<?
	/*switch ($_GET["sort"]) {
		case "price": $sort = "catalog_PRICE_1"; break;
		case "nal": $sort = "catalog_QUANTITY_1"; break;
		default: $sort = "NAME";
	}

	switch ($_GET["sort_direction"]) {
		case "asc" : $sort_direction = "ASC"; break;
		case "desc" : $sort_direction = "DESC"; break;
		default: $sort_direction = "ASC";
	}*/

	$sort1 = ($_GET["nal"]) ? "catalog_QUANTITY_1" : '' ;
	$sort_direction1 = ($_GET["nal"]=="DESC") ? "DESC" : '';

	$sort2 = ($_GET["price"]) ? "catalog_PRICE_1" : 'NAME' ;

	if ($_GET["price"]=="ASC") {
		$sort_direction2 = "ASC";
	} elseif ($_GET["price"]=="DESC") {
		$sort_direction2 = "DESC";
	} else {
		$sort_direction2 = 'ASC';
	}
?>
	
	<?$APPLICATION->IncludeComponent(
		"bitrix:catalog.section", 
		"catalog", 
		array(
			"ACTION_VARIABLE" => "action",
			"ADD_PICT_PROP" => "-",
			"ADD_PROPERTIES_TO_BASKET" => "Y",
			"ADD_SECTIONS_CHAIN" => "N",
			"ADD_TO_BASKET_ACTION" => "ADD",
			"AJAX_MODE" => "N",
			"AJAX_OPTION_ADDITIONAL" => "",
			"AJAX_OPTION_HISTORY" => "N",
			"AJAX_OPTION_JUMP" => "N",
			"AJAX_OPTION_STYLE" => "Y",
			"BACKGROUND_IMAGE" => "-",
			"BASKET_URL" => "/cabinet/basket/",
			"BROWSER_TITLE" => "-",
			"CACHE_FILTER" => "N",
			"CACHE_GROUPS" => "Y",
			"CACHE_TIME" => "36000000",
			"CACHE_TYPE" => "A",
			"COMPONENT_TEMPLATE" => "site-page",
			"CONVERT_CURRENCY" => "N",
			"DETAIL_URL" => "/catalog/#SECTION_CODE_PATH#/#ELEMENT_CODE#/",
			"DISABLE_INIT_JS_IN_COMPONENT" => "N",
			"DISPLAY_BOTTOM_PAGER" => "Y",
			"DISPLAY_TOP_PAGER" => "N",
			"ELEMENT_SORT_FIELD" => $sort1,
			"ELEMENT_SORT_ORDER" => $sort_direction1,
			"ELEMENT_SORT_FIELD2" => $sort2,
			"ELEMENT_SORT_ORDER2" => $sort_direction2,
			"FILTER_NAME" => "arrFilterSale",
			"HIDE_NOT_AVAILABLE" => "N",
			"IBLOCK_ID" => "6",
			"IBLOCK_TYPE" => "catalog",
			"INCLUDE_SUBSECTIONS" => "Y",
			"LABEL_PROP" => "-",
			"LINE_ELEMENT_COUNT" => "",
			"MESSAGE_404" => "",
			"MESS_BTN_ADD_TO_BASKET" => "В корзину",
			"MESS_BTN_BUY" => "Купить",
			"MESS_BTN_DETAIL" => "Подробнее",
			"MESS_BTN_SUBSCRIBE" => "Подписаться",
			"MESS_NOT_AVAILABLE" => "Нет в наличии",
			"META_DESCRIPTION" => "-",
			"META_KEYWORDS" => "-",
			"OFFERS_CART_PROPERTIES" => array(
				0 => "CML2_BAR_CODE",
			),
			"OFFERS_FIELD_CODE" => array(
				0 => "",
				1 => "",
			),
			"OFFERS_LIMIT" => "5",
			"OFFERS_PROPERTY_CODE" => array(
				0 => "CML2_ARTICLE",
				1 => "CML2_BASE_UNIT",
				2 => "MORE_PHOTO",
				3 => "CML2_MANUFACTURER",
				4 => "CML2_TRAITS",
				5 => "CML2_TAXES",
				6 => "FILES",
				7 => "CML2_ATTRIBUTES",
				8 => "CML2_BAR_CODE",
				9 => "",
			),
			"OFFERS_SORT_FIELD" => "sort",
			"OFFERS_SORT_FIELD2" => "id",
			"OFFERS_SORT_ORDER" => "asc",
			"OFFERS_SORT_ORDER2" => "desc",
			"PAGER_BASE_LINK_ENABLE" => "N",
			"PAGER_DESC_NUMBERING" => "N",
			"PAGER_DESC_NUMBERING_CACHE_TIME" => "36000",
			"PAGER_SHOW_ALL" => "Y",
			"PAGER_SHOW_ALWAYS" => "N",
			"PAGER_TEMPLATE" => "round",
			"PAGER_TITLE" => "Товары",
			"PAGE_ELEMENT_COUNT" => "12",
			"PARTIAL_PRODUCT_PROPERTIES" => "N",
			"PRICE_CODE" => array(
				0 => "base",
			),
			"PRICE_VAT_INCLUDE" => "Y",
			"PRODUCT_DISPLAY_MODE" => "N",
			"PRODUCT_ID_VARIABLE" => "id",
			"PRODUCT_PROPERTIES" => array(
			),
			"PRODUCT_PROPS_VARIABLE" => "prop",
			"PRODUCT_QUANTITY_VARIABLE" => "",
			"PRODUCT_SUBSCRIPTION" => "N",
			"PROPERTY_CODE" => array(
				0 => "STOCK",
				1 => "CML2_ARTICLE",
				2 => "CML2_BASE_UNIT",
				3 => "CML2_MANUFACTURER",
				4 => "CML2_TRAITS",
				5 => "CML2_TAXES",
				6 => "CML2_ATTRIBUTES",
				7 => "CML2_BAR_CODE",
				8 => "OLD_PRICE",
				9 => "",
			),
			"SECTION_CODE" => "",
			"SECTION_CODE_PATH" => "",
			"SECTION_ID" => "",
			"SECTION_ID_VARIABLE" => "SECTION_ID",
			"SECTION_URL" => "/catalog/#SECTION_CODE_PATH#/",
			"SECTION_USER_FIELDS" => array(
				0 => "",
				1 => "",
			),
			"SEF_MODE" => "N",
			"SEF_RULE" => "",
			"SET_BROWSER_TITLE" => "Y",
			"SET_LAST_MODIFIED" => "N",
			"SET_META_DESCRIPTION" => "Y",
			"SET_META_KEYWORDS" => "Y",
			"SET_STATUS_404" => "N",
			"SET_TITLE" => "Y",
			"SHOW_404" => "N",
			"SHOW_ALL_WO_SECTION" => "Y",
			"SHOW_CLOSE_POPUP" => "N",
			"SHOW_DISCOUNT_PERCENT" => "N",
			"SHOW_OLD_PRICE" => "N",
			"SHOW_PRICE_COUNT" => "1",
			"TEMPLATE_THEME" => "blue",
			"USE_MAIN_ELEMENT_SECTION" => "N",
			"USE_PRICE_COUNT" => "N",
			"USE_PRODUCT_QUANTITY" => "Y"
		),
		false
	);?>
</div>