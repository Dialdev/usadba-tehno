<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("Персональный раздел");
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
	"bitrix:main.profile",
	"profile",
	Array(
		"USER_PROPERTY" => array("UF_LEGAL_ADDRESS","UF_REG_NUMBER","UF_INN","UF_OGRN","UF_SETTLEMENT","UF_BANK","UF_CORRESPONDENT","UF_BIK")
	)
);?>
<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>
