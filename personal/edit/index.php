<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("Редактирование личных данных");
?><?$APPLICATION->IncludeComponent(
	"bitrix:main.profile",
	"edit",
	array(
		"USER_PROPERTY" => array("UF_LEGAL_ADDRESS","UF_REG_NUMBER","UF_INN","UF_OGRN","UF_SETTLEMENT","UF_BANK","UF_CORRESPONDENT","UF_BIK")
	)
);?><?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>