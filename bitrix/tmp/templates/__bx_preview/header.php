<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>
<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<title><?$APPLICATION->ShowTitle()?></title>
<?$APPLICATION->ShowHead();?>
<? $APPLICATION->SetAdditionalCSS("/bitrix/css/main/bootstrap.css");?> 
<script src="/local/templates/index/js/jquery-1.11.1.min.js"></script>
<script src="/local/templates/index/js/script.js"></script>
<script type="text/javascript" src="/local/templates/index/fancybox/jquery.fancybox.js"></script>
<link rel="stylesheet" type="text/css" href="/local/templates/index/fancybox/jquery.fancybox.css" media="screen">
<script type="text/javascript" src="/local/templates/index/lightbox/jquery.lightbox-0.5.js"></script>
<script type="text/javascript" src="/local/templates/index/js/jquery.inputmask.js"></script>
<link rel="stylesheet" type="text/css" href="/local/templates/index/lightbox/jquery.lightbox-0.5.css" media="screen"/>
<link rel="stylesheet" type="text/css" href="/local/templates/index/css/font-awesome.css" media="screen"/>
 <!--[if IE]>
<script src="http://html5shiv.googlecode.com/svn/trunk/html5.js"></script>
<![endif]-->
</head>
<body>
<div id="panel"><?$APPLICATION->ShowPanel();?></div>
<div class="wrapper">
	<div class="top">
		<div class="center">
			<?$APPLICATION->IncludeComponent("bitrix:menu", "menu", array(
	          "ROOT_MENU_TYPE" => "top2",
	          "MENU_CACHE_TYPE" => "Y",
	          "MENU_CACHE_TIME" => "36000000",
	          "MENU_CACHE_USE_GROUPS" => "Y",
	          "MENU_CACHE_GET_VARS" => array(
	          ),
	          "MAX_LEVEL" => "1",
	          "CHILD_MENU_TYPE" => "submenu",
	          "USE_EXT" => "N",
	          "DELAY" => "N",
	          "ALLOW_MULTI_SELECT" => "N"
	          ),
	          false
	        );?>
	        <div class="auth">
				<?if(!$USER->IsAuthorized()):?>
					<a class="btn-auth">Вход</a> / <a href="/registration/">Регистрация</a>
					<div class="auth-form" id="login-area">
						<span class="close">X</span>
						<?$APPLICATION->IncludeComponent(
							"idf:login.ajax",
							"site",
							Array(
								"COMPONENT_TEMPLATE" => ".default",
								"personal_link" => "/personal/"
							)
						);?>
					</div>
				<?else:?>
					<a href="/personal/">Кабинет</a> / <a href="?logout=yes">Выход</a>
				<?endif;?>
			</div>
		
			<span class="btn-callback">Заказать звонок</span>
			<?$APPLICATION->IncludeFile(
				$APPLICATION->GetTemplatePath("/local/includes/callback-form.php"),
				Array(),
				Array("MODE"=>"html")
			);?>
		</div>
	</div>
	<div class="header">
		<div class="center">
			<a class="logo" href="/">
				<img alt="Усадьба Техно" title="Усадьба Техно" src="/local/templates/index/images/logo.png">
			</a>
			<div class="contacts">
				<div class="item">
					<?$APPLICATION->IncludeFile(
						$APPLICATION->GetTemplatePath("/local/includes/contacts-top1.php"),
						Array(),
						Array("MODE"=>"html")
					);?>
				</div>
				<div class="item">
					<?$APPLICATION->IncludeFile(
						$APPLICATION->GetTemplatePath("/local/includes/contacts-top2.php"),
						Array(),
						Array("MODE"=>"html")
					);?>
				</div>
				<?/*
				<div class="item">
					<?$APPLICATION->IncludeFile(
						$APPLICATION->GetTemplatePath("/local/includes/contacts-top3.php"),
						Array(),
						Array("MODE"=>"html")
					);?>
				</div>
				*/?>
			</div>
			<div class="basket">
					<?$APPLICATION->IncludeComponent("bitrix:sale.basket.basket.line","site",array("PATH_TO_BASKET" => "/personal/cart/"));?>
			</div>
			<div class="search">
				<?$APPLICATION->IncludeComponent(
					"bitrix:search.title", 
					"site", 
					array(
						"CATEGORY_0" => array(
							0 => "iblock_catalog",
						),
						"CATEGORY_0_TITLE" => "Результаты",
						"CHECK_DATES" => "Y",
						"CONTAINER_ID" => "title-search",
						"INPUT_ID" => "title-search-input",
						"NUM_CATEGORIES" => "1",
						"ORDER" => "date",
						"PAGE" => "#SITE_DIR#search/",
						"SHOW_INPUT" => "Y",
						"SHOW_OTHERS" => "N",
						"TOP_COUNT" => "5",
						"USE_LANGUAGE_GUESS" => "Y",
						"COMPONENT_TEMPLATE" => "site",
						"CATEGORY_0_iblock_catalog" => array(
							0 => "6",
						)
					),
					false
				);?>
			</div>
		</div>
	</div>
	<div class="topmenu">
		<div class="center">
			<?$APPLICATION->IncludeComponent("bitrix:menu", "menu", array(
	          "ROOT_MENU_TYPE" => "top",
	          "MENU_CACHE_TYPE" => "Y",
	          "MENU_CACHE_TIME" => "36000000",
	          "MENU_CACHE_USE_GROUPS" => "Y",
	          "MENU_CACHE_GET_VARS" => array(
	          ),
	          "MAX_LEVEL" => "1",
	          "CHILD_MENU_TYPE" => "submenu",
	          "USE_EXT" => "N",
	          "DELAY" => "N",
	          "ALLOW_MULTI_SELECT" => "N"
	          ),
	          false
	        );?>
		</div>
	</div>
	<div class="slider-top">
		<div class="center">
			<?$APPLICATION->IncludeComponent(
	"bitrix:news.list", 
	"bnr-index", 
	array(
		"IBLOCK_TYPE" => "-",
		"IBLOCK_ID" => "4",
		"SORT_BY1" => "ACTIVE_FROM",
		"SORT_ORDER1" => "DESC",
		"SORT_BY2" => "SORT",
		"SORT_ORDER2" => "ASC",
		"FIELD_CODE" => array(
			0 => "",
			1 => "",
		),
		"PROPERTY_CODE" => array(
			0 => "HREF",
			1 => "",
		),
		"COMPONENT_TEMPLATE" => "bnr-index",
		"NEWS_COUNT" => "20",
		"FILTER_NAME" => "",
		"CHECK_DATES" => "Y",
		"DETAIL_URL" => "",
		"AJAX_MODE" => "N",
		"AJAX_OPTION_JUMP" => "N",
		"AJAX_OPTION_STYLE" => "Y",
		"AJAX_OPTION_HISTORY" => "N",
		"AJAX_OPTION_ADDITIONAL" => "undefined",
		"CACHE_TYPE" => "A",
		"CACHE_TIME" => "36000000",
		"CACHE_FILTER" => "N",
		"CACHE_GROUPS" => "Y",
		"PREVIEW_TRUNCATE_LEN" => "",
		"ACTIVE_DATE_FORMAT" => "d.m.Y",
		"SET_TITLE" => "Y",
		"SET_BROWSER_TITLE" => "Y",
		"SET_META_KEYWORDS" => "Y",
		"SET_META_DESCRIPTION" => "Y",
		"SET_LAST_MODIFIED" => "N",
		"INCLUDE_IBLOCK_INTO_CHAIN" => "Y",
		"ADD_SECTIONS_CHAIN" => "Y",
		"HIDE_LINK_WHEN_NO_DETAIL" => "N",
		"PARENT_SECTION" => "",
		"PARENT_SECTION_CODE" => "",
		"INCLUDE_SUBSECTIONS" => "Y",
		"PAGER_TEMPLATE" => ".default",
		"DISPLAY_TOP_PAGER" => "N",
		"DISPLAY_BOTTOM_PAGER" => "Y",
		"PAGER_TITLE" => "Новости",
		"PAGER_SHOW_ALWAYS" => "N",
		"PAGER_DESC_NUMBERING" => "N",
		"PAGER_DESC_NUMBERING_CACHE_TIME" => "36000",
		"PAGER_SHOW_ALL" => "N",
		"PAGER_BASE_LINK_ENABLE" => "N",
		"SET_STATUS_404" => "N",
		"SHOW_404" => "N",
		"MESSAGE_404" => ""
	),
	false
);?>
		</div>
	</div>
	<div class="center"><?$APPLICATION->IncludeFile($APPLICATION->GetTemplatePath("/local/includes/mainpage-text.php"),	Array(),Array("MODE"=>"html"));?></div>
	<div class="sections-index">
		<div class="center">
			<h2><a href="/catalog/">Каталог товаров</a><a class="btn-about" href="/catalog/">Все товары</a></h2>
			<div id="ctl_arrow_left" class="ctl_arrow"></div>
			<div id="ctl_arrow_right" class="ctl_arrow"></div>
			<div id="ctl_ovh"> 		
      			<div id="ctl_move">
      				<?$APPLICATION->IncludeComponent(
	"bitrix:catalog.section.list", 
	"index-menu", 
	array(
		"IBLOCK_TYPE" => "catalog",
		"IBLOCK_ID" => "6",
		"SECTION_ID" => $_REQUEST["SECTION_ID"],
		"SECTION_CODE" => "",
		"COUNT_ELEMENTS" => "N",
		"TOP_DEPTH" => "1",
		"SECTION_FIELDS" => array(
			0 => "DESCRIPTION",
			1 => "PICTURE",
			2 => "DETAIL_PICTURE",
			3 => "",
		),
		"SECTION_USER_FIELDS" => array(
			0 => "",
			1 => "",
		),
		"VIEW_MODE" => "LIST",
		"SHOW_PARENT_NAME" => "Y",
		"SECTION_URL" => "/catalog/#SECTION_CODE_PATH#/",
		"CACHE_TYPE" => "A",
		"CACHE_TIME" => "36000000",
		"CACHE_GROUPS" => "Y",
		"ADD_SECTIONS_CHAIN" => "N",
		"COMPONENT_TEMPLATE" => "index-menu"
	),
	false
);?>
      				<!--a class="item" href="">
      					<img alt="" title="" src="/local/templates/index/images/sections1.jpg">
      					<span class="name">Мотоблоки</span>
      				</a>
      				<a class="item" href="">
      					<img alt="" title="" src="/local/templates/index/images/sections2.jpg">
      					<span class="name">Мотокультиваторы</span>
      				</a>
      				<a class="item" href="">
      					<img alt="" title="" src="/local/templates/index/images/sections3.jpg">
      					<span class="name">Двигатели</span>
      				</a>
      				<a class="item" href="">
      					<img alt="" title="" src="/local/templates/index/images/sections4.jpg">
      					<span class="name">Скутеры</span>
      				</a>
      				<a class="item" href="">
      					<img alt="" title="" src="/local/templates/index/images/sections5.jpg">
      					<span class="name">Мотоциклы</span>
      				</a>
      				<a class="item" href="">
      					<img alt="" title="" src="/local/templates/index/images/sections4.jpg">
      					<span class="name">Мопеды</span>
      				</a>
      				<a class="item" href="">
      					<img alt="" title="" src="/local/templates/index/images/sections7.jpg">
      					<span class="name">Квадроциклы</span>
      				</a>
      				<a class="item" href="">
      					<img alt="" title="" src="/local/templates/index/images/sections8.jpg">
      					<span class="name">Снегоходы</span>
      				</a-->
      			</div>
      		</div>
		</div>
	</div>
	<div class="saleleader">
		<div class="center">
			<h2><a href="/catalog/saleleader/">Лидеры продаж</a><a class="btn-about" href="/catalog/saleleader/">Все товары</a></h2>
			<div id="ctl_arrow_left_top" class="ctl_arrow_top"></div>
			<div id="ctl_arrow_right_top" class="ctl_arrow_top"></div>
			<div id="ctl_ovh_top"> 		
      			<div id="ctl_move_top">
      				<?global $arrFilterSale;
						$arrFilterSale = array
						(
						   'PROPERTY_62' => 3,
						); ?> <?$APPLICATION->IncludeComponent(
	"bitrix:catalog.section", 
	"site", 
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
		"COMPONENT_TEMPLATE" => "site",
		"CONVERT_CURRENCY" => "N",
		"DETAIL_URL" => "/catalog/#SECTION_CODE_PATH#/#ELEMENT_CODE#/",
		"DISABLE_INIT_JS_IN_COMPONENT" => "N",
		"DISPLAY_BOTTOM_PAGER" => "Y",
		"DISPLAY_TOP_PAGER" => "N",
		"ELEMENT_SORT_FIELD" => "sort",
		"ELEMENT_SORT_FIELD2" => "id",
		"ELEMENT_SORT_ORDER" => "asc",
		"ELEMENT_SORT_ORDER2" => "desc",
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
		"PAGER_TEMPLATE" => "site",
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
      		</div>
		</div>
	</div>
	<div class="brands">
		<div class="center">
			<h2><a href="/brands/">Производители</a><a class="btn-about" href="/brands/">Все производители</a></h2>

			<?$APPLICATION->IncludeComponent(
	"bitrix:news.list", 
	"brands_index", 
	array(
		"ACTIVE_DATE_FORMAT" => "d.m.Y",
		"ADD_SECTIONS_CHAIN" => "N",
		"AJAX_MODE" => "N",
		"AJAX_OPTION_ADDITIONAL" => "",
		"AJAX_OPTION_HISTORY" => "N",
		"AJAX_OPTION_JUMP" => "N",
		"AJAX_OPTION_STYLE" => "Y",
		"CACHE_FILTER" => "N",
		"CACHE_GROUPS" => "Y",
		"CACHE_TIME" => "36000000",
		"CACHE_TYPE" => "A",
		"CHECK_DATES" => "Y",
		"COMPONENT_TEMPLATE" => "brands_inner",
		"DETAIL_URL" => "",
		"DISPLAY_BOTTOM_PAGER" => "Y",
		"DISPLAY_DATE" => "Y",
		"DISPLAY_NAME" => "Y",
		"DISPLAY_PICTURE" => "Y",
		"DISPLAY_PREVIEW_TEXT" => "Y",
		"DISPLAY_TOP_PAGER" => "N",
		"FIELD_CODE" => array(
			0 => "",
			1 => "",
		),
		"FILTER_NAME" => "",
		"HIDE_LINK_WHEN_NO_DETAIL" => "N",
		"IBLOCK_ID" => "8",
		"IBLOCK_TYPE" => "brands",
		"INCLUDE_IBLOCK_INTO_CHAIN" => "N",
		"INCLUDE_SUBSECTIONS" => "Y",
		"MESSAGE_404" => "",
		"NEWS_COUNT" => "100",
		"PAGER_BASE_LINK_ENABLE" => "N",
		"PAGER_DESC_NUMBERING" => "N",
		"PAGER_DESC_NUMBERING_CACHE_TIME" => "36000",
		"PAGER_SHOW_ALL" => "N",
		"PAGER_SHOW_ALWAYS" => "N",
		"PAGER_TEMPLATE" => ".default",
		"PAGER_TITLE" => "Новости",
		"PARENT_SECTION" => "",
		"PARENT_SECTION_CODE" => "",
		"PREVIEW_TRUNCATE_LEN" => "",
		"PROPERTY_CODE" => array(
			0 => "",
			1 => "",
		),
		"SET_BROWSER_TITLE" => "N",
		"SET_LAST_MODIFIED" => "N",
		"SET_META_DESCRIPTION" => "N",
		"SET_META_KEYWORDS" => "N",
		"SET_STATUS_404" => "N",
		"SET_TITLE" => "N",
		"SHOW_404" => "N",
		"SORT_BY1" => "NAME",
		"SORT_BY2" => "",
		"SORT_ORDER1" => "ASC",
		"SORT_ORDER2" => ""
	),
	false
);?>



			<div class="btn-about brands-more">Еще производители</div>
		</div>
	</div>
	<div class="stock">
		<div class="center">
			<h2><a href="/catalog/sale-items/">Акции</a><a class="btn-about" href="/catalog/sale-items/">Все товары</a></h2>
			<div id="ctl_arrow_left_stock" class="ctl_arrow_stock"></div>
			<div id="ctl_arrow_right_stock" class="ctl_arrow_stock"></div>
			<div id="ctl_ovh_stock"> 		
      			<div id="ctl_move_stock">
      				<?global $arrFilterSale;
						$arrFilterSale = array
						(
						   'PROPERTY_63' => 4,
						); ?> <?$APPLICATION->IncludeComponent(
	"bitrix:catalog.section", 
	"site", 
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
		"COMPONENT_TEMPLATE" => "site",
		"CONVERT_CURRENCY" => "N",
		"DETAIL_URL" => "/catalog/#SECTION_CODE_PATH#/#ELEMENT_CODE#/",
		"DISABLE_INIT_JS_IN_COMPONENT" => "N",
		"DISPLAY_BOTTOM_PAGER" => "Y",
		"DISPLAY_TOP_PAGER" => "N",
		"ELEMENT_SORT_FIELD" => "sort",
		"ELEMENT_SORT_FIELD2" => "id",
		"ELEMENT_SORT_ORDER" => "asc",
		"ELEMENT_SORT_ORDER2" => "desc",
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
		"PAGER_TEMPLATE" => "site",
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
      		</div>
		</div>
	</div>
	<div class="advantage">
		<div class="center">
			<h2>Наши преимущества</h2>
			<div class="blocks">
				<div class="item-advantage">
					<img alt="" src="/local/templates/index/images/ic-6.png">
					<span><b>Широчайший ассортимент техники</b> и оборудования – вы сможете выбрать именно то, что будет полно-стью удовлетворять ваши потребности</span>
				</div>
				<div class="item-advantage">
					<img alt="" src="/local/templates/index/images/ic-7.png">
					<span><b>Оптимальные цены</b> – мы делаем самые выгодные предложения</span>
				</div>
				<div class="item-advantage">
					<img alt="" src="/local/templates/index/images/ic-8.png">
					<span><b>Компетентное консультирование</b> – наши специалисты готовы ответить на любые ваши вопросы, при-чем со знанием дела</span>
				</div>
				<div class="item-advantage">
					<img alt="" src="/local/templates/index/images/ic-9.png">
					<span><b>Гарантии безупречного качества</b> – мы предлагаем вам только лучшее</span>
				</div>
				<div class="item-advantage">
					<img alt="" src="/local/templates/index/images/ic-10.png">
					<span><b>Гарантийный и послегарантийный сервис</b> – осуществляем ремонт любой техники и оборудования с максимальной оперативностью и профессионализмом</span>
				</div>
				<div class="item-advantage">
					<img alt="" src="/local/templates/index/images/ic-11.png">
					<span><b>Всегда в наличии оригинальные запчасти</b> – вы можете приобрести их отдельно</span>
				</div>
			</div>
		</div>
	</div>
	<div class="news">
		<div class="center">
			<h2><a href="/news/">Новости</a><a class="btn-about" href="/news/">Все новости</a></h2>
			<?$APPLICATION->IncludeComponent(
	"bitrix:news.list", 
	"news-index", 
	array(
		"IBLOCK_TYPE" => "news",
		"IBLOCK_ID" => "1",
		"SORT_BY1" => "ACTIVE_FROM",
		"SORT_ORDER1" => "DESC",
		"SORT_BY2" => "ID",
		"SORT_ORDER2" => "DESC",
		"FIELD_CODE" => array(
			0 => "",
			1 => "",
		),
		"PROPERTY_CODE" => array(
			0 => "",
			1 => "HREF",
			2 => "",
		),
		"COMPONENT_TEMPLATE" => "news-index",
		"NEWS_COUNT" => "3",
		"FILTER_NAME" => "",
		"CHECK_DATES" => "Y",
		"DETAIL_URL" => "",
		"AJAX_MODE" => "N",
		"AJAX_OPTION_JUMP" => "N",
		"AJAX_OPTION_STYLE" => "Y",
		"AJAX_OPTION_HISTORY" => "N",
		"AJAX_OPTION_ADDITIONAL" => "undefined",
		"CACHE_TYPE" => "A",
		"CACHE_TIME" => "36000000",
		"CACHE_FILTER" => "N",
		"CACHE_GROUPS" => "Y",
		"PREVIEW_TRUNCATE_LEN" => "",
		"ACTIVE_DATE_FORMAT" => "d.m.Y",
		"SET_TITLE" => "Y",
		"SET_BROWSER_TITLE" => "Y",
		"SET_META_KEYWORDS" => "Y",
		"SET_META_DESCRIPTION" => "Y",
		"SET_LAST_MODIFIED" => "N",
		"INCLUDE_IBLOCK_INTO_CHAIN" => "Y",
		"ADD_SECTIONS_CHAIN" => "Y",
		"HIDE_LINK_WHEN_NO_DETAIL" => "N",
		"PARENT_SECTION" => "",
		"PARENT_SECTION_CODE" => "",
		"INCLUDE_SUBSECTIONS" => "Y",
		"PAGER_TEMPLATE" => ".default",
		"DISPLAY_TOP_PAGER" => "N",
		"DISPLAY_BOTTOM_PAGER" => "Y",
		"PAGER_TITLE" => "Новости",
		"PAGER_SHOW_ALWAYS" => "N",
		"PAGER_DESC_NUMBERING" => "N",
		"PAGER_DESC_NUMBERING_CACHE_TIME" => "36000",
		"PAGER_SHOW_ALL" => "N",
		"PAGER_BASE_LINK_ENABLE" => "N",
		"SET_STATUS_404" => "N",
		"SHOW_404" => "N",
		"MESSAGE_404" => ""
	),
	false
);?>
		</div>
	</div>
	<div class="center">