<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) die();?>
<div class="subscribe-index">

<p><?echo GetMessage("SUBSCR_NEW_NOTE")?></p>
<form action="<?=$arResult["FORM_ACTION"]?>" method="get">
	<div class="rubrics">
		<?foreach($arResult["RUBRICS"] as $itemID => $itemValue):?>
			<input class="checkbox_input" type="checkbox" name="sf_RUB_ID[]" id="sf_RUB_ID_<?=$itemID?>" value="<?=$itemValue["ID"]?>" checked />
			<label for="sf_RUB_ID_<?=$itemID?>"><?=$itemValue["NAME"]?><span class="checkbox_<?=$itemID?>"></span></label>
		<?endforeach;?>
	</div>
	<p><input class="form__text" placeholder="e-mail" type="text" name="sf_EMAIL" size="20" value="<?=$arResult["EMAIL"]?>" title="<?echo GetMessage("SUBSCR_EMAIL_TITLE")?>" /><input class="form__submit" type="submit" value="<?echo GetMessage("SUBSCR_BUTTON")?>" /></p>
</form>
<div class="clear"></div>
<form action="<?=$arResult["FORM_ACTION"]?>" method="get">
<?echo bitrix_sessid_post();?>
<h3>Изменить подписки</h3>
<input class="form__text" type="text" placeholder="e-mail" name="sf_EMAIL" size="20" value="<?=$arResult["EMAIL"]?>" title="<?echo GetMessage("SUBSCR_EMAIL_TITLE")?>" /></p>
<?if($arResult["SHOW_PASS"]=="Y"):?>
	<input class="form__text" type="password" placeholder="<?echo GetMessage("SUBSCR_EDIT_PASS")?>" name="AUTH_PASS" size="20" value="" title="<?echo GetMessage("SUBSCR_EDIT_PASS_TITLE")?>" /></p>
<?else:?>
	<p><span class="green"><?echo GetMessage("SUBSCR_EDIT_PASS_ENTERED")?></span><span class="starrequired">*</span></p>
<?endif;?>
	
<input class="form__submit" type="submit" value="Изменить подписку" />
<input type="hidden" name="action" value="Изменить подписку" />
<div class="clear"></div>
</form>
</div>