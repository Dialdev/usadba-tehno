<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>
<div class="frame-wrapper">
	<div class="frame frame_small">
		<?ShowMessage($arParams["~AUTH_RESULT"]);?>
		<form method="post" action="<?=$arResult["AUTH_FORM"]?>" name="bform">
			<input type="hidden" name="AUTH_FORM" value="Y">
			<input type="hidden" name="TYPE" value="CHANGE_PWD">
			<input type="text" name="USER_LOGIN" value="<?=$arResult["LAST_LOGIN"]?>" class="form__text" placeholder="Логин" required>
			<input type="text" name="USER_CHECKWORD" value="<?=$arResult["USER_CHECKWORD"]?>" class="form__text" placeholder="Контрольная строка" required>
			<input type="password" name="USER_PASSWORD" value="<?=$arResult["USER_PASSWORD"]?>" class="form__text" placeholder="Новый пароль" required>
			<input type="password" name="USER_CONFIRM_PASSWORD" value="<?=$arResult["USER_CONFIRM_PASSWORD"]?>" class="form__text" placeholder="Подтверждение пароля" required>
			<input type="submit" name="change_pwd" value="Изменить пароль" class="form__submit">
		</form>
	</div>
</div>