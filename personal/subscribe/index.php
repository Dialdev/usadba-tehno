<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("Управление рассылками");
?>
<?$APPLICATION->IncludeComponent(
	"bitrix:menu",
	"cabinet",
	Array(
		"MAX_LEVEL" => "1",
		"ROOT_MENU_TYPE" => "left"
	)
);?>
<?$APPLICATION->IncludeComponent(
	"bitrix:subscribe.index", 
	"site", 
	array(
		"CACHE_TIME" => "3600",
		"CACHE_TYPE" => "A",
		"COMPONENT_TEMPLATE" => "site",
		"PAGE" => "#SITE_DIR#personal/subscribe/subscr_edit.php",
		"SET_TITLE" => "Y",
		"SHOW_COUNT" => "N",
		"SHOW_HIDDEN" => "N"
	),
	false
);?>
<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>