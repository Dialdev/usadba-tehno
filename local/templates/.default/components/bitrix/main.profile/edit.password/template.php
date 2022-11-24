<?if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>
<?ShowError($arResult["strProfileError"]);?>
<?
if ($arResult["DATA_SAVED"] == "Y")
	ShowNote("Пароль изменен.");
?>
<form method="post" action="<?=$arResult["FORM_TARGET"]?>" enctype="multipart/form-data" class="edit-password">
	<?=$arResult["BX_SESSION_CHECK"]?>
	<input type="hidden" name="ID" value="<?=$arResult["ID"]?>">
	<input type="hidden" name="LOGIN" value="<?=$arResult["arUser"]["LOGIN"]?>">
	<input type="hidden" name="EMAIL" value="<?=$arResult["arUser"]["EMAIL"]?>">

	<input type="password" name="NEW_PASSWORD" value="" autocomplete="off" class="form__text" placeholder="Новый пароль">
	<input type="password" name="NEW_PASSWORD_CONFIRM" value="" autocomplete="off" class="form__text" placeholder="Подтверждение нового пароля">

	<a href="/personal/" class="edit-password__back">Назад</a>
	<input type="submit" name="save" value="Сохранить" class="form__submit">
</form>