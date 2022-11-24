<?
#################################################
#   Company developer: ALTASIB                  #
#   Developer: Toporikov Sergey                 #
#   Site: http://www.altasib.ru                 #
#   E-mail: dev@altasib.ru                   	#
#   Copyright (c) 2006-2011 ALTASIB             #
#################################################
?>
<?
global $MESS;
$PathInstall = str_replace("\\", "/", __FILE__);
$PathInstall = substr($PathInstall, 0, strlen($PathInstall)-strlen("/index.php"));
IncludeModuleLangFile(__FILE__);

Class altasib_discounts extends CModule
{
        var $MODULE_ID = "altasib.discounts";
        var $MODULE_VERSION;
        var $MODULE_VERSION_DATE;
        var $MODULE_NAME;
        var $MODULE_DESCRIPTION;
        var $MODULE_CSS;
//        var $MODULE_GROUP_RIGHTS = "Y";

        function altasib_discounts()
        {
                $arModuleVersion = array();

                $path = str_replace("\\", "/", __FILE__);
                $path = substr($path, 0, strlen($path) - strlen("/index.php"));
                include($path."/version.php");

                if (is_array($arModuleVersion) && array_key_exists("VERSION", $arModuleVersion))
                {
                        $this->MODULE_VERSION = $arModuleVersion["VERSION"];
                        $this->MODULE_VERSION_DATE = $arModuleVersion["VERSION_DATE"];
                }
                else
                {
                        $this->MODULE_VERSION = "1.0.0";
                        $this->MODULE_VERSION_DATE = "2011-08-15 11:19:59";
                }

                $this->MODULE_NAME = GetMessage("ALTASIB_DISCOUNTS_MODULE_NAME");
                $this->MODULE_DESCRIPTION = GetMessage("ALTASIB_DISCOUNTS_MODULE_DESCRIPTION");

                $this->PARTNER_NAME = "ALTASIB";
                $this->PARTNER_URI = "http://www.altasib.ru/";
        }
        function DoInstall()
        {
                global $DB, $APPLICATION, $step;
                $step = IntVal($step);
                $this->InstallFiles();
                $this->InstallDB();
                $this->InstallEvents();

                $GLOBALS["errors"] = $this->errors;
                $APPLICATION->IncludeAdminFile(GetMessage("ALTASIB_DISCOUNTS_INSTALL_TITLE"), $_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/altasib.discounts/install/step1.php");
        }
        function DoUninstall()
        {
                global $DB, $APPLICATION, $step;
                $step = IntVal($step);


		if($step<2)
		{
				$APPLICATION->IncludeAdminFile(GetMessage("ALTASIB_DISCOUNTS_UNINSTALL_TITLE"), $_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/altasib.discounts/install/unstep1.php");
		}
		elseif($step==2) 
		{

			$this->UnInstallFiles();
			if($_REQUEST["saveemails"] != "Y")
					$this->UnInstallEvents();

			$this->UnInstallDB(array(
					"savedata" => $_REQUEST["savedata"],
			));

			$GLOBALS["errors"] = $this->errors;

			$APPLICATION->IncludeAdminFile(GetMessage("ALTASIB_DISCOUNTS_UNINSTALL_TITLE"), $_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/altasib.discounts/install/unstep2.php");
		}
        }
        function InstallDB()
        {
                global $DB, $DBType, $APPLICATION, $USER_FIELD_MANAGER;
                $this->errors = false;

                if(!$DB->Query("SELECT 'x' FROM altasib_discounts_reauth", true))
                {
                        $this->errors = $DB->RunSQLBatch($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/altasib.discounts/install/db/".strtolower($DB->type)."/install.sql");
                }

                if($this->errors !== false)
                {
                        $APPLICATION->ThrowException(implode("", $this->errors));
                        return false;
                }

                RegisterModule("altasib.discounts");
                RegisterModuleDependences("main","OnProlog","altasib.discounts","CAltasibDiscounts","OnProlog", "100");
				RegisterModuleDependences("main","OnAfterUserUpdate","altasib.discounts","CAltasibDiscounts","OnAfterUserUpdate", "100");
                RegisterModuleDependences("main","OnAfterUserAuthorize","altasib.discounts","CAltasibDiscounts","OnAuthorize", "100");
                RegisterModuleDependences("sale","OnSalePayOrder","altasib.discounts","CAltasibDiscounts","OnSalePayOrder", "100");
                RegisterModuleDependences("main", "OnUserTypeBuildList", "main", "CUserTypeAltasibDiscaunt", "GetUserTypeDescription", 100, "/modules/altasib.discounts/classes/general/userpropdiscount.php");
                RegisterModuleDependences("main", "OnUserTypeBuildList", "main", "CUserTypeAltasibOrderSum", "GetUserTypeDescription", 100, "/modules/altasib.discounts/classes/general/userpropordersum.php");

                $rsData = CUserTypeEntity::GetList( array($by=>$order), array("USER_TYPE_ID" => "AltasibDiscountValue"));
                if(!$arRes = $rsData->Fetch())
                {
                        require_once($_SERVER["DOCUMENT_ROOT"].BX_ROOT."/modules/altasib.discounts/classes/general/userpropdiscount.php");
                        $USER_FIELD_MANAGER->arUserTypes["AltasibDiscountValue"] = CUserTypeAltasibDiscaunt::GetUserTypeDescription();

                        // Unstall User Prop
                        $rsLang = CLanguage::GetList($by="sort", $order="asc", Array());
                        $arAllLang = array();
                        while ($arLang = $rsLang->Fetch())
                        {
                                $arAllLang[$arLang["LID"]] = "";
                        }
                        $arFields = Array(
                                "ENTITY_ID" => "USER",
                                "FIELD_NAME" => "UF_PERS_DISCOUNT",
                                "USER_TYPE_ID" => "AltasibDiscountValue",
                                "XML_ID" => "",
                                "SORT" => "100",
                                "MULTIPLE" => "",
                                "MANDATORY" => "",
                                "SHOW_FILTER" => "N",
                                "SHOW_IN_LIST" => "",
                                "EDIT_IN_LIST" => "",
                                "IS_SEARCHABLE" => "",
                                "SETTINGS" => Array (
                                        "DAFAULT_VALUE" => Array (
                                        )
                                ),
                                "EDIT_FORM_LABEL" => array(
                                        "ru" => GetMessage("ALTASIB_DISCOUNT_UF_NAME"),
                                        "en" => GetMessage("ALTASIB_DISCOUNT_UF_NAME_EN"),
                                ),
                                "LIST_COLUMN_LABEL" => array(
                                        "ru" => GetMessage("ALTASIB_DISCOUNT_UF_NAME"),
                                        "en" => GetMessage("ALTASIB_DISCOUNT_UF_NAME_EN"),
                                ),
                                "LIST_FILTER_LABEL" => array(
                                        "ru" => GetMessage("ALTASIB_DISCOUNT_UF_NAME"),
                                        "en" => GetMessage("ALTASIB_DISCOUNT_UF_NAME_EN"),
                                ),
                                "ERROR_MESSAGE" => $arAllLang,
                                "HELP_MESSAGE" => $arAllLang
                        );

                        $obUserField  = new CUserTypeEntity();
                        $enID = $obUserField->Add($arFields);
                        $res = ($enID>0);
                        if (!$res)
                        {
                                $this->errors[] = GetMessage("ALTASIB_DISCOUNT_USER_TYPE_SAVE_ERROR");
                                if($ex =  $APPLICATION->GetException())
                                        $this->errors[] = $ex->messages[0]["text"];
                        }
                }
                $rsData = CUserTypeEntity::GetList( array($by=>$order), array("USER_TYPE_ID" => "AltasibDiscountOrdersSum"));
                if(!$arRes = $rsData->Fetch())
                {
                        require_once($_SERVER["DOCUMENT_ROOT"].BX_ROOT."/modules/altasib.discounts/classes/general/userpropordersum.php");
                        $USER_FIELD_MANAGER->arUserTypes["AltasibDiscountOrdersSum"] = CUserTypeAltasibOrderSum::GetUserTypeDescription();

                        // Unstall User Prop
                        $rsLang = CLanguage::GetList($by="sort", $order="asc", Array());
                        $arAllLang = array();
                        while ($arLang = $rsLang->Fetch())
                        {
                                $arAllLang[$arLang["LID"]] = "";
                        }
                        $arFields = Array(
                                "ENTITY_ID" => "USER",
                                "FIELD_NAME" => "UF_ORDERS_SUM",
                                "USER_TYPE_ID" => "AltasibDiscountOrdersSum",
                                "XML_ID" => "",
                                "SORT" => "100",
                                "MULTIPLE" => "",
                                "MANDATORY" => "",
                                "SHOW_FILTER" => "N",
                                "SHOW_IN_LIST" => "",
                                "EDIT_IN_LIST" => "",
                                "IS_SEARCHABLE" => "",
                                "SETTINGS" => Array (
                                        "DAFAULT_VALUE" => Array (
                                        )
                                ),
                                "EDIT_FORM_LABEL" => array(
                                        "ru" => GetMessage("ALTASIB_DISCOUNT_ORDER_UF_NAME"),
                                        "en" => GetMessage("ALTASIB_DISCOUNT_ORDER_UF_NAME_EN"),
                                ),
                                "LIST_COLUMN_LABEL" => array(
                                        "ru" => GetMessage("ALTASIB_DISCOUNT_ORDER_UF_NAME"),
                                        "en" => GetMessage("ALTASIB_DISCOUNT_ORDER_UF_NAME_EN"),
                                ),
                                "LIST_FILTER_LABEL" => array(
                                        "ru" => GetMessage("ALTASIB_DISCOUNT_ORDER_UF_NAME"),
                                        "en" => GetMessage("ALTASIB_DISCOUNT_ORDER_UF_NAME_EN"),
                                ),
                                "ERROR_MESSAGE" => $arAllLang,
                                "HELP_MESSAGE" => $arAllLang
                        );

                        $obUserField  = new CUserTypeEntity();
                        $enID = $obUserField->Add($arFields);
                        $res = ($enID>0);
                        if (!$res)
                        {
                                $this->errors[] = GetMessage("ALTASIB_DISCOUNT_USER_TYPE_SAVE_ERROR");
                                if($ex =  $APPLICATION->GetException())
                                        $this->errors[] = $ex->messages[0]["text"];
                        }
                }
                if($this->errors !== false)
                {
                        $APPLICATION->ThrowException(implode("", $this->errors));

                        UnRegisterModuleDependences("main","OnProlog","altasib.discounts","CAltasibDiscounts","OnProlog");
						UnRegisterModuleDependences("main","OnAfterUserUpdate","altasib.discounts","CAltasibDiscounts","OnAfterUserUpdate");
                        UnRegisterModuleDependences("main","OnAfterUserAuthorize","altasib.discounts","CAltasibDiscounts","OnAuthorize");
                        UnRegisterModuleDependences("sale","OnSalePayOrder","altasib.discounts","CAltasibDiscounts","OnSalePayOrder");
                        UnRegisterModuleDependences("main","OnUserTypeBuildList","main","CUserTypeAltasibDiscaunt","GetUserTypeDescription", "/modules/altasib.discounts/classes/general/userpropdiscount.php");
                        UnRegisterModuleDependences("main","OnUserTypeBuildList","main","CUserTypeAltasibOrderSum","GetUserTypeDescription", "/modules/altasib.discounts/classes/general/userpropordersum.php");

                        COption::RemoveOption("altasib_discounts");
                        UnRegisterModule("altasib.discounts");

                        return false;
                }
        }
        function UnInstallDB($arParams = array())
        {

                global $DB, $DBType, $APPLICATION;
                $this->errors = false;
		
                if(array_key_exists("savedata", $arParams) && $arParams["savedata"] != "Y")
		{
			$this->errors = $DB->RunSQLBatch($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/altasib.discounts/install/db/".$DBType."/uninstall.sql");

			if($this->errors !== false)
			{
					$APPLICATION->ThrowException(implode("", $this->errors));
					return false;
			}
		}
		
		

                $rsData = CUserTypeEntity::GetList(array($by=>$order),Array());
                $obUserField  = new CUserTypeEntity;

                while ($arRes = $rsData->Fetch())
                {
                        if ($arRes["USER_TYPE_ID"] == "AltasibDiscountOrdersSum" || $arRes["USER_TYPE_ID"] == "AltasibDiscountValue")
                        {
                                $RIGHT = $APPLICATION->GetGroupRight("altasib.discounts");
                                if ($RIGHT<"W")
                                {
                                        continue;
                                }
                                $ID = intval($arRes['ID']);
                                $DB->StartTransaction();
                                if(!$obUserField->Delete($ID))
                                {
                                        $DB->Rollback();
                                        $this->errors[] = GetMessage("ALTASIB_DISCOUNT_USER_TYPE_DEL_ERROR");
                                }
                                $DB->Commit();
                                break;

                        }
                }

                if($this->errors !== false)
                {
                        $APPLICATION->ThrowException(implode("", $this->errors));
                        return false;
                }

                UnRegisterModuleDependences("main","OnProlog","altasib.discounts","CAltasibDiscounts","OnProlog");
                UnRegisterModuleDependences("main","OnAfterUserAuthorize","altasib.discounts","CAltasibDiscounts","OnAuthorize");
                UnRegisterModuleDependences("sale","OnSalePayOrder","altasib.discounts","CAltasibDiscounts","OnSalePayOrder");
                UnRegisterModuleDependences("main","OnUserTypeBuildList","main","CUserTypeAltasibDiscaunt","GetUserTypeDescription", "/modules/altasib.discounts/classes/general/userpropdiscount.php");
                UnRegisterModuleDependences("main","OnUserTypeBuildList","main","CUserTypeAltasibOrderSum","GetUserTypeDescription", "/modules/altasib.discounts/classes/general/userpropordersum.php");
		
		if(array_key_exists("savedata", $arParams) && $arParams["savedata"] != "Y")
		{
			$group = new CGroup;
			$filter = Array
			(
				"DESCRIPTION"     => "ALTASIB_DISCOUNTS",
			);
			$rsGroups = CGroup::GetList(($by="c_sort"), ($order="desc"), $filter); // выбираем группы
			while($arGroup = $rsGroups->Fetch())
			{
				$group->Delete($arGroup["ID"]);
			}

			if(CModule::IncludeModule("catalog"))
			{
				$dbDiscount = CCatalogDiscount::GetList(
					array(),
					array("NOTES" => "ALTASIB_DISCOUNTS"),
					false,
					false,
					array("ID")
				);
				while ($arDiscount = $dbDiscount->GetNext())
				{
					CCatalogDiscount::Delete($arDiscount["ID"]);
				}
			}

			COption::RemoveOption("altasib_discounts");
		}
                UnRegisterModule("altasib.discounts");
                return true;
        }
        Function InstallEvents()
        {

        }

        Function UnInstallEvents()
        {

        }

        function InstallFiles()
        {
                CopyDirFiles($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/altasib.discounts/install/admin", $_SERVER["DOCUMENT_ROOT"]."/bitrix/admin", true, true);
                CopyDirFiles($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/altasib.discounts/install/themes", $_SERVER["DOCUMENT_ROOT"]."/bitrix/themes", true, true);
                CopyDirFiles($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/altasib.discounts/images", $_SERVER["DOCUMENT_ROOT"]."/bitrix/themes/.default/icons/altasib.discounts", true, true);
                return true;
        }

        function UnInstallFiles()
        {
                DeleteDirFiles($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/altasib.discounts/install/admin", $_SERVER["DOCUMENT_ROOT"]."/bitrix/admin");
                DeleteDirFiles($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/altasib.discounts/install/themes/.default", $_SERVER["DOCUMENT_ROOT"]."/bitrix/themes/.default");
                DeleteDirFilesEx("/bitrix/themes/.default/icons/altasib.discounts");
                return true;
        }
}
?>
