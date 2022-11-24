<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("Регистрация");
?><?$APPLICATION->IncludeComponent("bitrix:main.register","",array(
	"SHOW_FIELDS" => array("LAST_NAME", "NAME", "PERSONAL_PHONE", "WORK_COMPANY"),
	"REQUIRED_FIELDS" => array("LAST_NAME", "NAME", "PERSONAL_PHONE"),
	"USER_PROPERTY" => array("UF_USER_TYPE", "UF_COMPANY_FILE", "UF_LEGAL_ADDRESS", "UF_REG_NUMBER", "UF_INN", "UF_OGRN", "UF_SETTLEMENT", "UF_BANK", "UF_CORRESPONDENT", "UF_BIK"),
	"SUCCESS_PAGE" => "/personal/",
	"AUTH" => "Y",
));?><?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>