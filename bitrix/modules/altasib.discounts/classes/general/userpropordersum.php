<?
/**
 *   Company developer: ALTASIB					
 *   Developer: Toporikov Sergey					
 *   Site: http://www.altasib.ru					
 *   E-mail: dev@altasib.ru						
 *   Copyright (c) 2006-2014 ALTASIB
 */
IncludeModuleLangFile(__FILE__);

class CUserTypeAltasibOrderSum
{
        function GetUserTypeDescription()
        {
                return array(
                        "USER_TYPE_ID" => "AltasibDiscountOrdersSum",
                        "CLASS_NAME" => "CUserTypeAltasibOrderSum",
                        "DESCRIPTION" => GetMessage("ALTASIB_DISCOUNT_ORDER_PROP_USER_NAME"),
                        "BASE_TYPE" => "string",
                );
        }
        function GetDBColumnType($arUserField)
        {
                global $DB;
                switch(strtolower($DB->type))
                {
                        case "mysql":
                                return "varchar(50)";
                }
        }
        function PrepareSettings($arUserField)
        {
        }
        function GetSettingsHTML($arUserField = false, $arHtmlControl, $bVarsFromForm)
        {
        }

        function GetEditFormHTML($arUserField, $arHtmlControl)
        {
                if($arUserField["ENTITY_ID"] != "USER")
                        return;
                global $APPLICATION;
                static $cache = array();

                $USER_ID = $arUserField["VALUE_ID"];
                $sReturn = '';
                if(CModule::IncludeModuleEx('altasib.discount') === MODULE_DEMO_EXPIRED)
                {
                	$sReturn .= ShowError(GetMessage("ALTASIB_DISCOUNT_MODULE_DEMO_EXPIRED"));
                	return $sReturn;
                }
                $sReturn .= '
                <script type="text/javascript">
                        function AltasibDiscountsRecalc()
                        {
                                var __CHttpRequest = new JCHttpRequest();
                                __CHttpRequest.Action = function(result)
                                {
                                        if(result)
                                                window.location.href = "";
                                }
                                ShowWaitWindow();

                                __CHttpRequest.Send(\''.$APPLICATION->GetCurPageParam("action=AltasibDiscountReCalc&UID=".$USER_ID).'\');
                        }
                </script>
                ';
                if(CModule::IncludeModule("sale"))
                {

                $FormatSum = CurrencyFormat($arHtmlControl["VALUE"], "RUB");
                if(!$FormatSum)
                        $FormatSum = CurrencyFormat($arHtmlControl["VALUE"], "RUR");
                }
                else
                        $FormatSum = $arHtmlControl["VALUE"];
                $sReturn .= $FormatSum;
                $sReturn .= ' [<a href="#" onClick="AltasibDiscountsRecalc();return false;">'.GetMessage("ALTASIB_DISCOUNT_PROP_USER_NAME_LINK").'</a>]';
                return $sReturn;
        }

        function OnBeforeSave($arUserField, $value)
        {
                return $value;
        }
}
?>
