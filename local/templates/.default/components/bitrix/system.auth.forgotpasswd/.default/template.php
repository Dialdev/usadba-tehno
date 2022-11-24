<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>
<div class="frame-wrapper">
	<div class="frame frame_small">
		<?ShowMessage($arParams["~AUTH_RESULT"]);?>
		<form method="post" action="<?=$arResult["AUTH_URL"]?>" name="bform">
			<input type="hidden" name="AUTH_FORM" value="Y">
			<input type="hidden" name="TYPE" value="SEND_PWD">
			<input type="text" name="USER_LOGIN" value="<?=$arResult["LAST_LOGIN"]?>" class="form__text" placeholder="введите логин">
			<input type="text" name="USER_EMAIL" class="form__text" placeholder="или введите email">
			<input type="submit" name="send_account_info" value="Отправить" class="form__submit">
		</form>
	</div>
</div>