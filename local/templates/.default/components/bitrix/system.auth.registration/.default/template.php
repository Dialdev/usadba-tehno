<?if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>
<?ShowMessage($arParams["~AUTH_RESULT"]);?>
<?$APPLICATION->IncludeComponent("bitrix:main.register","",array(
	"SHOW_FIELDS" => array("LAST_NAME", "NAME", "PERSONAL_PHONE", "WORK_COMPANY"),
	"REQUIRED_FIELDS" => array("LAST_NAME", "NAME", "PERSONAL_PHONE"),
	"USER_PROPERTY" => array("UF_USER_TYPE", "UF_COMPANY_FILE", "UF_LEGAL_ADDRESS", "UF_REG_NUMBER", "UF_INN", "UF_OGRN", "UF_SETTLEMENT", "UF_BANK", "UF_CORRESPONDENT", "UF_BIK"),
	"SUCCESS_PAGE" => $arResult["BACKURL"]
));?>
<div class="separator"></div>
<br><br>
<h4 class="h4">Спасибо за желание стать нашим клиентом!</h4>
<p>После отправки информации о себе, в течении одного рабочего дня с Вами свяжется наш менеджер.</p>
<p>Вы также можете с нами связаться по телефону: <span class="text_red">+ 7 800 250-98-99</span></p>
<h4 class="h4">Хорошего Вам дня!</h4>
<br><br>
<?$APPLICATION->IncludeComponent("bitrix:form.result.new","design-email",array("WEB_FORM_ID" => 3,"LIST_URL" => "","AJAX_MODE" => "Y","AJAX_OPTION_JUMP" => "N"));?>