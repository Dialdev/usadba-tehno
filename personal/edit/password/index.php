<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("Изменение пароля");
?><?$APPLICATION->IncludeComponent(
	"bitrix:main.profile",
	"edit.password"
);?><?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>