<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
?>
<?if ($arResult["isFormErrors"] == "Y"):?><?=$arResult["FORM_ERRORS_TEXT"];?><?endif?>
<?=$arResult["FORM_HEADER"]?>
<?foreach ($arResult["QUESTIONS"] as $arQuestion):;
?>
	<?if ($arQuestion["STRUCTURE"][0]["FIELD_TYPE"]=='text'):?>
		<?/*<label class="pole_<?=$arQuestion["STRUCTURE"][0]["ID"]?>"><?=$arQuestion["CAPTION"]?><?if ($arQuestion["REQUIRED"] == "Y"):?> <span class="required">*</span><?endif?></label>*/?>
		<input placeholder="<?=$arQuestion["CAPTION"]?><?if ($arQuestion["REQUIRED"] == "Y"):?> *<?endif?>" type="text" class="form__text<?if($arQuestion["STRUCTURE"][0]["ID"]==7): echo " quantity"; endif?>" name="form_text_<?=$arQuestion["STRUCTURE"][0]["ID"]?>" id="form_text_<?=$arQuestion["STRUCTURE"][0]["ID"]?>" <?if ($arQuestion["REQUIRED"] == "Y"):?>required<?endif?> value="">
	<?elseif ($arQuestion["STRUCTURE"][0]["FIELD_TYPE"]=='textarea'):?>
		<?/*<label><?=$arQuestion["CAPTION"]?><?if ($arQuestion["REQUIRED"] == "Y"):?> <span class="required">*</span><?endif?></label>*/?>
		<textarea  placeholder="<?=$arQuestion["CAPTION"]?><?if ($arQuestion["REQUIRED"] == "Y"):?> *<?endif?>" class="form__textarea" name="form_textarea_<?=$arQuestion["STRUCTURE"][0]["ID"]?>"  <?if ($arQuestion["REQUIRED"] == "Y"):?>required<?endif?>></textarea>
	<?elseif ($arQuestion["STRUCTURE"][0]["FIELD_TYPE"] == "url"):?>
			<noscript>Для отправки сообщения включите JavaScript.</noscript>
			<div class="antibot" data-id="<?=$arQuestion["STRUCTURE"][0]["ID"]?>"></div>
		
	<?endif?>
<?endforeach;?>
<input style="display: inline;" type="checkbox" name="AGREEMENT" value="Y" class="form__checkbox" id="callback-form-agreement" required>
<label style="display: inline;" for="callback-form-agreement">Я принимаю условия<a href="/informatsiya/politika-konfeditsialnosti/" target="_blank" > соглашения о конфиденциальности персональных данных</a></label>

<div class="form__required" style="float: none;"><span class="required">*</span>  Обязательные поля</div>
<div class="g-recaptcha" data-callback="captchaSolved" data-sitekey="6LdXEhMdAAAAABGA59h4qIiFp7uL0TDwFv_IbQos"></div>
<input disabled="" class="submit-btn" type="submit" onclick=" ga('send', 'event', 'zvonok', 'click');return true;" class="form__submit" name="web_form_submit" value="Заказать звонок">
<script>
	function captchaSolved() {
		$('.submit-btn').prop('disabled', false)
	}
</script>
<?=$arResult["FORM_FOOTER"]?>