<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>
<?
$arResult["SUBSCRIPTION"]["CONFIRMED"]="Y";
foreach($arResult["MESSAGE"] as $itemID=>$itemValue)
	echo ShowMessage(array("MESSAGE"=>$itemValue, "TYPE"=>"OK"));
foreach($arResult["ERROR"] as $itemID=>$itemValue)
	echo ShowMessage(array("MESSAGE"=>$itemValue, "TYPE"=>"ERROR"));

if($arResult["ALLOW_ANONYMOUS"]=="N" && !$USER->IsAuthorized()):
	echo ShowMessage(array("MESSAGE"=>GetMessage("CT_BSE_AUTH_ERR"), "TYPE"=>"ERROR"));
else:
?>
<div class="subscription">

	<form action="<?=$arResult["FORM_ACTION"]?>" method="post">
	<?echo bitrix_sessid_post();?>
	<input type="hidden" name="PostAction" value="<?echo ($arResult["ID"]>0? "Update":"Add")?>" />
	<input type="hidden" name="ID" value="<?echo $arResult["SUBSCRIPTION"]["ID"];?>" />
	<input type="hidden" name="RUB_ID[]" value="0" />

	<h2><?echo GetMessage("CT_BSE_SUBSCRIPTION_FORM_TITLE")?></h2>
	<div class="rubrics">
		<?foreach($arResult["RUBRICS"] as $itemID => $itemValue):?>
			
				<input class="checkbox_input" type="checkbox" id="RUBRIC_<?echo $itemID?>" name="RUB_ID[]" value="<?=$itemValue["ID"]?>"<?if($itemValue["CHECKED"]) echo " checked"?> />
				<label for="RUBRIC_<?echo $itemID?>"><?echo $itemValue["NAME"]?><span class="checkbox_<?=$itemID?>"></span></label>
		
		<?endforeach;?>
		<div class="clear"></div><br>
					<?if($arResult["ID"]==0):?>
						<p><?echo GetMessage("CT_BSE_NEW_NOTE")?></p>
					<?else:?>
						<p><?echo GetMessage("CT_BSE_EXIST_NOTE")?></p>
					<?endif?>

					<input class="form__submit" type="submit" name="Save" value="<?echo ($arResult["ID"] > 0? GetMessage("CT_BSE_BTN_EDIT_SUBSCRIPTION"): GetMessage("CT_BSE_BTN_ADD_SUBSCRIPTION"))?>" />
	</div>

	<?if($arResult["ID"]>0 && $arResult["SUBSCRIPTION"]["CONFIRMED"] <> "Y"):?>
		<p><?echo GetMessage("CT_BSE_CONF_NOTE")?></p>
		<input name="CONFIRM_CODE" type="text" class="subscription-textbox" value="<?echo GetMessage("CT_BSE_CONFIRMATION")?>" onblur="if (this.value=='')this.value='<?echo GetMessage("CT_BSE_CONFIRMATION")?>'" onclick="if (this.value=='<?echo GetMessage("CT_BSE_CONFIRMATION")?>')this.value=''" /> <input type="submit" name="confirm" value="<?echo GetMessage("CT_BSE_BTN_CONF")?>" />
	<?endif?>

	</form>

	<?if(!CSubscription::IsAuthorized($arResult["ID"])):?>
	<form action="<?=$arResult["FORM_ACTION"]?>" method="post">
	<?echo bitrix_sessid_post();?>
	<input type="hidden" name="action" value="sendcode" />

	<div class="subscription-utility">
		<p><?echo GetMessage("CT_BSE_SEND_NOTE")?></p>
		<input name="sf_EMAIL" type="text" class="form__text" value="<?echo GetMessage("CT_BSE_EMAIL")?>" onblur="if (this.value=='')this.value='<?echo GetMessage("CT_BSE_EMAIL")?>'" onclick="if (this.value=='<?echo GetMessage("CT_BSE_EMAIL")?>')this.value=''" /> <input class="form__submit" type="submit" value="<?echo GetMessage("CT_BSE_BTN_SEND")?>" />
	</div>
	<div class="clear"></div>
	</form>
	<?endif?>
<div class="clear"></div>
</div>
<?endif;?>