<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>
<div class="frame-wrapper">
	<div class="frame frame_small">
		<?
		ShowMessage($arParams["~AUTH_RESULT"]);
		ShowMessage($arResult["ERROR_MESSAGE"]);
		?>
		<form method="post" action="<?=$arResult["AUTH_URL"]?>" name="form_auth">
			<input type="hidden" name="AUTH_FORM" value="Y">
			<input type="hidden" name="TYPE" value="AUTH">
			<?foreach ($arResult["POST"] as $key => $value):?>
			<input type="hidden" name="<?=$key?>" value="<?=$value?>">
			<?endforeach?>
			<input type="text" name="USER_LOGIN" value="<?=$arResult["LAST_LOGIN"]?>" class="form__text" placeholder="Логин" required>
			<input type="password" name="USER_PASSWORD" class="form__text" placeholder="Пароль" required>
			<?if ($arResult["STORE_PASSWORD"] == "Y"):?>
				<input type="checkbox" name="USER_REMEMBER" value="Y" class="form__checkbox" id="user_remember"><label for="user_remember">Запомнить меня на этом компьютере</label>
			<?endif?>
			<input type="submit" name="Login" value="Войти" class="form__submit">
			<a href="/personal/?forgot_password=yes" class="form__notice">Забыли пароль?</a>
		</form>
	</div>
</div>