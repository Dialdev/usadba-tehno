<?
#################################################
#   Company developer: ALTASIB                  #
#   Developer: Toporikov Sergey                 #
#   Site: http://www.altasib.ru                 #
#   E-mail: scorpx@altasib.ru                   #
#   Copyright (c) 2006-2011 ALTASIB             #
#################################################

require_once($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/prolog_admin_before.php");

if (!($USER->CanDoOperation('catalog_read') || $USER->CanDoOperation('catalog_discount')))
        $APPLICATION->AuthForm(GetMessage("ACCESS_DENIED"));

$RIGHT = $APPLICATION->GetGroupRight("altasib.discount");
if($RIGHT=="D")
        $APPLICATION->AuthForm(GetMessage("ACCESS_DENIED"));

$bReadOnly = !$USER->CanDoOperation('catalog_discount');

if(CModule::IncludeModuleEx('altasib.discount') === MODULE_DEMO_EXPIRED)
{
	$APPLICATION->SetTitle(GetMessage("ALTASIB_DISCOUNT_TITLE"));
	require($_SERVER["DOCUMENT_ROOT"].BX_ROOT."/modules/main/include/prolog_admin_after.php");
	CAdminMessage::ShowMessage(
		array(
			"MESSAGE" => GetMessage("ALTASIB_DISCOUNT_ERR_TITLE"),
			"DETAILS" => GetMessage("ALTASIB_DISCOUNT_MODULE_DEMO_EXPIRED"),
			"TYPE" => "ERROR",
			"HTML" => true
		)
	);
	require($_SERVER["DOCUMENT_ROOT"].BX_ROOT."/modules/main/include/epilog_admin.php");
	die();
}

require_once($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/catalog/include.php");

if ($ex = $APPLICATION->GetException())
{
        require($DOCUMENT_ROOT."/bitrix/modules/main/include/prolog_admin_after.php");

        $strError = $ex->GetString();
        ShowError($strError);

        require($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/epilog_admin.php");
        die();
}

IncludeModuleLangFile(__FILE__);
IncludeModuleLangFile($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/catalog/admin/cat_discount_admin.php");

require_once($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/catalog/prolog.php");

$arPeriodsVal = Array(
        "1" => GetMessage("ALTASIB_DISCOUNTS_PERIOD_LIST_1"),
        "3" => GetMessage("ALTASIB_DISCOUNTS_PERIOD_LIST_3"),
        "6" => GetMessage("ALTASIB_DISCOUNTS_PERIOD_LIST_6"),
        "12" => GetMessage("ALTASIB_DISCOUNTS_PERIOD_LIST_12")
        );

$sTableID = "tbl_altasib_discount";

$oSort = new CAdminSorting($sTableID, "ID", "asc");
$lAdmin = new CAdminList($sTableID, $oSort);

$arFilterFields = array(
        "filter_site_id",
        "filter_active",
        "filter_date_active_from",
        "filter_date_active_to",
        "filter_name",
        "filter_coupon",
        "filter_renewal"
);

$lAdmin->InitFilter($arFilterFields);

$arFilter = array(
        "NOTES" => "ALTASIB_DISCOUNTS",
);

if (strlen($filter_site_id) > 0 && $filter_site_id != "NOT_REF") $arFilter["SITE_ID"] = $filter_site_id;
if (strlen($filter_active) > 0) $arFilter["ACTIVE"] = $filter_active;
if (strlen($filter_date_active_from) > 0) $arFilter["!>ACTIVE_FROM"] = $filter_date_active_from;
if (strlen($filter_date_active_to) > 0) $arFilter["!<ACTIVE_TO"] = $filter_date_active_to;
if (strlen($filter_name) > 0) $arFilter["~NAME"] = $filter_name;
if (strlen($filter_coupon) > 0) $arFilter["COUPON"] = $filter_coupon;
if (strlen($filter_renewal) > 0) $arFilter["RENEWAL"] = $filter_renewal;

if (!$bReadOnly && $lAdmin->EditAction()/* && $catalogModulePermissions >= "W"*/)
{
        foreach ($FIELDS as $ID => $arFields)
        {
                $DB->StartTransaction();
                $ID = IntVal($ID);

                if (!$lAdmin->IsUpdated($ID))
                        continue;

                if (!CCatalogDiscount::Update($ID, $arFields))
                {
                        if ($ex = $APPLICATION->GetException())
                                $lAdmin->AddUpdateError($ex->GetString(), $ID);
                        else
                                $lAdmin->AddUpdateError(str_replace("#ID#", $ID, GetMessage("ERROR_UPDATE_DISCOUNT")), $ID);

                        $DB->Rollback();
                }

                $DB->Commit();
        }
}


if (!$bReadOnly && ($arID = $lAdmin->GroupAction())/* && $catalogModulePermissions >= "W"*/)
{
        if ($_REQUEST['action_target']=='selected')
        {
                $arID = array();
                $dbResultList = CCatalogDiscount::GetList(
                        array($by => $order),
                        $arFilter,
                        false,
                        false,
                        array("ID")
                );
                while ($arResult = $dbResultList->Fetch())
                        $arID[] = $arResult['ID'];
        }

        foreach ($arID as $ID)
        {
                if (strlen($ID) <= 0)
                        continue;

                switch ($_REQUEST['action'])
                {
                        case "delete":
                                @set_time_limit(0);

                                $DB->StartTransaction();

                                //      Delete Group Users Discounts
                                $valGroup = COption::GetOptionInt("altasib.discounts", "group_for_discount_".$ID);

                                if (!CCatalogDiscount::Delete($ID))
                                {
                                        $DB->Rollback();

                                        if ($ex = $APPLICATION->GetException())
                                                $lAdmin->AddGroupError($ex->GetString(), $ID);
                                        else
                                                $lAdmin->AddGroupError(str_replace("#ID#", $ID, GetMessage("ERROR_DELETE_DISCOUNT")), $ID);
                                }


                                if($valGroup)
                                {
                                        $group = new CGroup;
                                        if(!$group->Delete($valGroup))
                                        {
                                                $lAdmin->AddGroupError(GetMessage("ALTASIB_DISCOUNTS_ERR_DEL_GROUP").$valGroup, $ID);
                                        }
                                }

                                COption::RemoveOption("altasib.discounts", "group_for_discount_".$ID);
                                COption::RemoveOption("altasib.discounts", "period_for_discount_".$ID);
                                COption::RemoveOption("altasib.discounts", "limit_for_discount_".$ID);

                                $DB->Commit();

                                break;

                        case "activate":
                        case "deactivate":

                                $arFields = array(
                                        "ACTIVE" => (($_REQUEST['action']=="activate") ? "Y" : "N")
                                );

                                if (!CCatalogDiscount::Update($ID, $arFields))
                                {
                                        if ($ex = $APPLICATION->GetException())
                                                $lAdmin->AddGroupError($ex->GetString(), $ID);
                                        else
                                                $lAdmin->AddGroupError(str_replace("#ID#", $ID, GetMessage("ERROR_UPDATE_DISCOUNT")), $ID);
                                }

                                break;
                }
        }
}

$dbResultList = CCatalogDiscount::GetList(
        array($by => $order),
        $arFilter,
        false,
        false,
        array("ID", "SITE_ID", "ACTIVE", "ACTIVE_FROM", "ACTIVE_TO", "RENEWAL", "NAME", "MAX_USES", "COUNT_USES", "SORT", "MAX_DISCOUNT", "VALUE_TYPE", "VALUE", "CURRENCY", "MIN_ORDER_SUM", "TIMESTAMP_X", "NOTES")
);

$dbResultList = new CAdminResult($dbResultList, $sTableID);
$dbResultList->NavStart();

$lAdmin->NavText($dbResultList->GetNavPrint(GetMessage("DSC_NAV")));

$lAdmin->AddHeaders(array(
        array("id"=>"ID", "content"=>"ID", "sort"=>"id", "default"=>true),
        array("id"=>"SITE_ID","content"=>GetMessage("DSC_SITE"), "sort"=>"site_id", "default"=>true),
        array("id"=>"ACTIVE", "content"=>GetMessage("DSC_ACT"), "sort"=>"active", "default"=>true),
        array("id"=>"NAME", "content"=>GetMessage("DSC_NAME"), "sort"=>"name", "default"=>true),
        array("id"=>"SORT", "content"=>GetMessage("DSC_SORT"), "sort"=>"sort", "default"=>true),
        array("id"=>"VALUE", "content"=>GetMessage("DSC_VALUE"), "sort"=>"", "default"=>true),
        array("id"=>"PERIOD", "content"=>GetMessage("ALTASIB_DISCOUNTS_HEAD_PERIOD"), "sort"=>"", "default"=>true),
        array("id"=>"LIMIT", "content"=>GetMessage("ALTASIB_DISCOUNTS_HEAD_LIMIT"), "sort"=>"", "default"=>true),
));

$arVisibleColumns = $lAdmin->GetVisibleHeaderColumns();

while ($arDiscount = $dbResultList->NavNext(true, "f_"))
{
        $arDiscount["PERIOD"] = COption::GetOptionString("altasib.discounts", "period_for_discount_".$f_ID, "Y");
        $arDiscount["LIMIT"] = COption::GetOptionInt("altasib.discounts", "limit_for_discount_".$f_ID, "");

        //p($arDiscount);

        $row =& $lAdmin->AddRow($f_ID, $arDiscount);

        $row->AddField("ID", $f_ID);
        $row->AddField("SITE_ID", $f_SITE_ID);

        if ($bReadOnly)
        {
                $row->AddViewField("ACTIVE", $f_ACTIVE);
                $row->AddViewField("NAME", $f_NAME);
                $row->AddViewField("SORT", $f_SORT);
        }
        else
        {
                $row->AddCheckField("ACTIVE");
                $row->AddInputField("NAME", array("size" => "30"));
                $row->AddInputField("SORT", array("size" => "3"));
        }

        $row->AddField("VALUE", (($arDiscount["VALUE_TYPE"]=="P") ? $arDiscount["VALUE"]."%" : FormatCurrency($arDiscount["VALUE"], $arDiscount["CURRENCY"])));
        $row->AddField("RENEWAL", ($arDiscount["RENEWAL"]=="Y" ? GetMessage("DSC_YES_P") : GetMessage("DSC_NO_P")));

        $row->AddField("PERIOD", $arPeriodsVal[$arDiscount["PERIOD"]]);
        $row->AddField("LIMIT", $arDiscount["LIMIT"]);

        $arActions = Array();
        $arActions[] = array("ICON"=>"edit", "TEXT"=>GetMessage("DSC_UPDATE_ALT"), "ACTION"=>$lAdmin->ActionRedirect("altasib_discounts_edit.php?ID=".$f_ID."&lang=".LANG.GetFilterParams("filter_", false).""), "DEFAULT"=>true);
        //if ($catalogModulePermissions >= "U")
        if (!$bReadOnly)
        {
                $arActions[] = array("SEPARATOR" => true);
                $arActions[] = array("ICON"=>"delete", "TEXT"=>GetMessage("DSC_DELETE_ALT"), "ACTION"=>"if(confirm('".GetMessage('DSC_DELETE_CONF')."')) ".$lAdmin->ActionDoGroup($f_ID, "delete"));
        }

        $row->AddActions($arActions);
}

$lAdmin->AddFooter(
        array(
                array(
                        "title" => GetMessage("MAIN_ADMIN_LIST_SELECTED"),
                        "value" => $dbResultList->SelectedRowsCount()
                ),
                array(
                        "counter" => true,
                        "title" => GetMessage("MAIN_ADMIN_LIST_CHECKED"),
                        "value" => "0"
                ),
        )
);

if (!$bReadOnly)
{
        $lAdmin->AddGroupActionTable(
                array(
                        "delete" => GetMessage("MAIN_ADMIN_LIST_DELETE"),
                        "activate" => GetMessage("MAIN_ADMIN_LIST_ACTIVATE"),
                        "deactivate" => GetMessage("MAIN_ADMIN_LIST_DEACTIVATE"),
                )
        );
}

//if ($catalogModulePermissions >= "W")
if (!$bReadOnly)
{
        $aContext = array(
                array(
                        "TEXT" => GetMessage("CDAN_ADD_NEW"),
                        "ICON" => "btn_new",
                        "LINK" => "altasib_discounts_edit.php?lang=".LANG,
                        "TITLE" => GetMessage("CDAN_ADD_NEW_ALT")
                ),
        );
        $lAdmin->AddAdminContextMenu($aContext);

}

$lAdmin->CheckListMode();


/****************************************************************************/
/***********  MAIN PAGE  ****************************************************/
/****************************************************************************/
$APPLICATION->SetTitle(GetMessage("ALTASIB_DISCOUNT_TITLE"));

require($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/prolog_admin_after.php");
?>
<form name="find_form" method="GET" action="<?echo $APPLICATION->GetCurPage()?>?">
<?
$oFilter = new CAdminFilter(
        $sTableID."_filter",
        array(
                GetMessage("DSC_ACTIVE"),
                GetMessage("DSC_NAME"),
        )
);

$oFilter->Begin();
?>
        <tr>
                <td><?= GetMessage("DSC_SITE") ?>:</td>
                <td>
                        <?echo CSite::SelectBox("filter_site_id", $filter_site_id, "(".GetMessage("DSC_ALL").")"); ?>
                </td>
        </tr>
        <tr>
                <td><?= GetMessage("DSC_ACTIVE") ?>:</td>
                <td>
                        <select name="filter_active">
                                <option value=""><?= htmlspecialcharsex("(".GetMessage("DSC_ALL").")") ?></option>
                                <option value="Y"<?if ($filter_active=="Y") echo " selected"?>><?= htmlspecialcharsex(GetMessage("DSC_YES")) ?></option>
                                <option value="N"<?if ($filter_active=="N") echo " selected"?>><?= htmlspecialcharsex(GetMessage("DSC_NO")) ?></option>
                        </select>
                </td>
        </tr>
        <tr>
                <td><?= GetMessage("DSC_NAME") ?>:</td>
                <td>
                   <input type="text" name="filter_name" size="50" value="<?echo htmlspecialcharsex($filter_name)?>" size="30">&nbsp;<?=ShowFilterLogicHelp()?>
                </td>
        </tr>
<?
$oFilter->Buttons(
        array(
                "table_id" => $sTableID,
                "url" => $APPLICATION->GetCurPage(),
                "form" => "find_form"
        )
);
$oFilter->End();
?>
</form>

<?
$lAdmin->DisplayList();
?>

<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/epilog_admin.php");
?>
