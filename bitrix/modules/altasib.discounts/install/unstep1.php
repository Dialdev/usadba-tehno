<?
#################################################
#   Company developer: ALTASIB                  #
#   Developer: Toporikov Sergey                 #
#   Site: http://www.altasib.ru                 #
#   E-mail: dev@altasib.ru                   	#
#   Copyright (c) 2006-2011 ALTASIB             #
#################################################
?>
<?IncludeModuleLangFile(__FILE__);?>
<form action="<?echo $APPLICATION->GetCurPage()?>">
<?=bitrix_sessid_post()?>
	<input type="hidden" name="lang" value="<?=LANGUAGE_ID?>">
	<input type="hidden" name="id" value="altasib.discounts">
	<input type="hidden" name="uninstall" value="Y">
	<input type="hidden" name="step" value="2">

	<?echo CAdminMessage::ShowMessage(GetMessage("MOD_UNINST_WARN"))?>
	<p><?echo GetMessage("MOD_UNINST_SAVE")?></p>
	<p><input type="checkbox" name="savedata" id="savedata" value="Y" checked><label for="savedata"><?echo GetMessage("ALTASIB_MOD_UNINST_SAVE_DISCOUNTS")?></label></p>		
	<input type="submit" name="inst" value="<?echo GetMessage("MOD_UNINST_DEL")?>">
</form>
