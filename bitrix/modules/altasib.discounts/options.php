<?
/**
*   Company developer: ALTASIB
*   Developer: Toporikov Sergey
*   Site: http://www.altasib.ru
*   E-mail: dev@altasib.ru
*   Copyright (c) 2006-2014 ALTASIB
**/
?>
<?
IncludeModuleLangFile(__FILE__);
IncludeModuleLangFile($_SERVER["DOCUMENT_ROOT"].BX_ROOT."/modules/main/options.php");

if(!$USER->IsAdmin()) return;

$module_id = "altasib.discounts";
$strWarning = "";

$bSaleModule = CModule::IncludeModule("sale");

$filter = Array
(
);
$rsGroups = CGroup::GetList(($by="id"), ($order="asc"), $filter);
while($arGroup = $rsGroups->GetNext())
{
	$arListGroups[$arGroup["ID"]] = "[".$arGroup["ID"]."] ".$arGroup["NAME"];
}

$arListUFields = array(
	0 => GetMessage("ALTASIB_DISCOUNT_SUM_OFFILNE_EMPTY")
);
global $USER_FIELD_MANAGER;
$UFields = $USER_FIELD_MANAGER->GetUserFields("USER");
foreach($UFields as $arUField)
{
	if($arUField['USER_TYPE_ID'] == 'double' || $arUField['USER_TYPE_ID'] == 'integer')
		$arListUFields[$arUField["FIELD_NAME"]] = "[".$arUField["FIELD_NAME"]."]";
}

$arAllOptions["main"][] = Array("no_group_discount", GetMessage("ALTASIB_DISCOUNT_OPTION_NO_GROUP"), false, Array("selectbox_array"), $arListGroups);
$arAllOptions["main"][] = Array("inc_price_delivery", GetMessage("ALTASIB_DISCOUNT_INC_PRICE_DELIVERY"), false, Array("checkbox"));
$arAllOptions["main"][] = Array("sum_offline", GetMessage("ALTASIB_DISCOUNT_SUM_OFFILNE"), false, Array("selectbox"), $arListUFields);

$aTabs = array(
	array("DIV" => "edit1", "TAB" => GetMessage("MAIN_TAB_SET"), "TITLE" => GetMessage("MAIN_TAB_TITLE_SET")),
	//array("DIV" => "edit3", "TAB" => GetMessage("MAIN_TAB_RIGHTS"), "ICON" => "altasib_kladr_settings", "TITLE" => GetMessage("MAIN_TAB_TITLE_RIGHTS")),
);

//Restore defaults
if ($USER->IsAdmin() && $_SERVER["REQUEST_METHOD"]=="GET" && strlen($RestoreDefaults)>0 && check_bitrix_sessid())
{
	COption::RemoveOption("altasib.discounts");
}
$tabControl = new CAdminTabControl("tabControl", $aTabs);

function ShowParamsHTMLByArray($arParams)
{
	foreach($arParams as $Option)
	{
		 __AdmSettingsDrawRow("altasib.discounts", $Option);
	}

}
//
//Save options
if($REQUEST_METHOD=="POST" && strlen($Update.$Apply.$RestoreDefaults)>0 && check_bitrix_sessid())
{

	if(strlen($RestoreDefaults)>0)
	{
		COption::RemoveOption("altasib.discounts");
	}
	else
	{

		foreach($_REQUEST as $k=>$val)
		{
			if(is_array($_REQUEST[$k]))
			{
				$_REQUEST["~".$k] = $_REQUEST[$k];
				$_REQUEST[$k] = implode(",",$_REQUEST[$k]);
			}
		}
		foreach($arAllOptions as $aOptGroup)
		{
			foreach($aOptGroup as $option)
			{
				if(!$_REQUEST[$option[0]])
					$_REQUEST[$option[0]] = false;
				if($option[0] == "no_group_discount")
				{
					if(empty($_REQUEST["~no_group_discount"]))
					{
						$rsUsers = CUser::GetList(($by="id"), ($order="desc"), array("GROUPS_ID" => $_REQUEST["~no_group_discount"]));
						while($arUser = $rsUsers->GetNext())
						{
							CAltasibDiscountReauth::Add($arUser["ID"]);
						}
					}
				}

				__AdmSettingsSaveOption($module_id, $option);
			}
		}
	}
	if(strlen($Update)>0 && strlen($_REQUEST["back_url_settings"])>0)
		LocalRedirect($_REQUEST["back_url_settings"]);
	else
		LocalRedirect($APPLICATION->GetCurPage()."?mid=".urlencode($mid)."&lang=".urlencode(LANGUAGE_ID)."&back_url_settings=".urlencode($_REQUEST["back_url_settings"])."&".$tabControl->ActiveTabParam());
}
?>

<form method="post" action="<?echo $APPLICATION->GetCurPage()?>?mid=<?=htmlspecialchars($mid)?>&amp;lang=<?echo LANG?>">
<?
$tabControl->Begin();
$tabControl->BeginNextTab();?>
	<tr>
		<td colspan="2"><div style="background-color: #fff; padding: 0; border-top: 1px solid #8E8E8E; border-bottom: 1px solid #8E8E8E;  margin-bottom: 15px;">
			<div style="background-color: #8E8E8E; height: 30px; padding: 7px; border: 1px solid #fff">
				<a href="http://www.is-market.ru?param=cl" target="_blank"><img src="/bitrix/modules/<?=$module_id?>/images/is-market.gif" style="float: left; margin-right: 15px;" border="0" /></a>
				<div style="margin: 13px 0px 0px 0px">
					<a href="http://www.is-market.ru?param=cl" target="_blank" style="color: #fff; font-size: 10px; text-decoration: none"><?=GetMessage("ALTASIB_IS")?></a>
				</div>
			</div></div>
		</td>
	</tr>
	<?
	for ($i = 0; $i < count($arAllOptions["main"]); $i++):
		$Option = $arAllOptions["main"][$i];
		$val = COption::GetOptionString("altasib.discounts", $Option[0], $Option[2]);

		$type = $Option[3];
		if($type[0]=="checkbox_array" || $type[0]=="selectbox_array")
			$val = explode(",", $val);
		?>
		<tr>
			<td valign="top" width="50%"><?
				if ($type[0]=="checkbox")
					echo "<label for=\"".htmlspecialchars($Option[0])."\">".$Option[1]."</label>";
				else
					echo $Option[1];
			?>:</td>
			<td valign="middle" width="50%">
				<?if($type[0]=="checkbox"):?>
					<input type="checkbox" name="<?echo htmlspecialchars($Option[0])?>" id="<?echo htmlspecialchars($Option[0])?>" value="Y"<?if($val=="Y")echo" checked";?>>
				<?elseif($type[0]=="selectbox_array"):?>
					<select name="<?echo htmlspecialchars($Option[0])?>[]" value="<?=$v?>" multiple="multiple" size="8">
					<?foreach($Option[4] as $v => $k)
					{
						?>
						<option value="<?=$v?>"<?if(in_array($v, $val))echo" selected";?>><?=$k?></option>
						<?
					}
					?>
					</select>
				<?elseif($type[0]=="checkbox_array"):?>
					<?foreach($Option[4] as $v => $k)
					{
						?>
						<input type="checkbox" name="<?echo htmlspecialchars($Option[0])?>[]" value="<?=$v?>"<?if(in_array($v, $val))echo" checked";?>> <?=$k?>
						<?
					}
					?>
				<?elseif($type[0]=="text"):?>
					<input type="text" size="<?echo $type[1]?>" value="<?echo htmlspecialchars($val)?>" name="<?echo htmlspecialchars($Option[0])?>">
				<?elseif($type[0]=="textarea"):?>
					<textarea rows="<?echo $type[1]?>" cols="<?echo $type[2]?>" name="<?echo htmlspecialchars($Option[0])?>"><?echo htmlspecialchars($val)?></textarea>
				<?elseif($type[0]=="selectbox"):?>
					<select name="<?echo htmlspecialchars($Option[0])?>" id="<?echo htmlspecialchars($Option[0])?>">
						<?foreach($Option[4] as $v => $k)
						{
							?><option value="<?=$v?>"<?if($val==$v)echo" selected";?>><?=$k?></option><?
						}
						?>
					</select>
				<?endif?>
			</td>
		</tr>
	<?endfor;?>
<?//$tabControl->BeginNextTab();?>
<?//require_once($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/admin/group_rights.php");?>
<?$tabControl->Buttons();?>
<script language="JavaScript">
function RestoreDefaults()
{
	if(confirm('<?echo AddSlashes(GetMessage("MAIN_HINT_RESTORE_DEFAULTS_WARNING"))?>'))
		window.location = "<?echo $APPLICATION->GetCurPage()?>?RestoreDefaults=Y&lang=<?echo LANG?>&mid=<?echo urlencode($mid)?>&<?=bitrix_sessid_get()?>";
}
</script>
<div align="left">
	<input type="hidden" name="Update" value="Y">
	<input type="submit" <?if(!$USER->IsAdmin())echo " disabled ";?> name="Update" value="<?echo GetMessage("MAIN_SAVE")?>">
	<input type="reset" <?if(!$USER->IsAdmin())echo " disabled ";?> name="reset" value="<?echo GetMessage("MAIN_RESET")?>">
	<input type="button" <?if(!$USER->IsAdmin())echo " disabled ";?>  type="button" title="<?echo GetMessage("MAIN_HINT_RESTORE_DEFAULTS")?>" OnClick="RestoreDefaults();" value="<?echo GetMessage("MAIN_RESTORE_DEFAULTS")?>">
</div>
<?$tabControl->End();?>
<?=bitrix_sessid_post();?>
</form>