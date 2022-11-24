<?if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>
<?ShowError($arResult["strProfileError"]);?>
<?
if ($arResult["DATA_SAVED"] == "Y")
	ShowNote("Изменения сохранены.");
?>
<?
	$rsUser = CUser::GetByID($arResult['ID']);
	$arUser = $rsUser->Fetch();
?>

<form method="post" action="<?=$arResult["FORM_TARGET"]?>" enctype="multipart/form-data" class="edit-profile">
	<?=$arResult["BX_SESSION_CHECK"]?>
	<input type="hidden" name="ID" value="<?=$arResult["ID"]?>">
	<input type="hidden" name="LOGIN" value="<?=$arResult["arUser"]["LOGIN"]?>">
	<table class="edit-profile__table">
		<tr>
			<td width="160">Логин:</td>
			<td><input type="text" value="<?=$arResult["arUser"]["LOGIN"]?>" class="form__text" disabled></td>
		</tr>
		<tr>
			<td>E-mail:</td>
			<td><input type="text" name="EMAIL" value="<?=$arResult["arUser"]["EMAIL"]?>" class="form__text"></td>
		</tr>
		<tr>
			<td>Фамилия:</td>
			<td><input type="text" name="LAST_NAME" value="<?=$arResult["arUser"]["LAST_NAME"]?>" class="form__text"></td>
		</tr>
		<tr>
			<td>Имя:</td>
			<td><input type="text" name="NAME" value="<?=$arResult["arUser"]["NAME"]?>" class="form__text"></td>
		</tr>
		<tr>
			<td>Телефон:</td>
			<td><input type="text" name="PERSONAL_PHONE" value="<?=$arResult["arUser"]["PERSONAL_PHONE"]?>" class="form__text"></td>
		</tr>
	<?if($arUser['UF_USER_TYPE'] == 1){?>
		<tr>
			<td>Название компании:</td>
			<td><input type="text" name="WORK_COMPANY" value="<?=$arResult["arUser"]["WORK_COMPANY"]?>" class="form__text"></td>
		</tr>
		<tr>
			<td>Юридический адрес:</td>
			<td><textarea name="UF_LEGAL_ADDRESS" class="form__textarea"><?=$arResult["arUser"]["UF_LEGAL_ADDRESS"]?></textarea></td>
		</tr>
	</table>
	<table class="edit-profile__table">
		<tr>
			<td width="160">Регистр. номер (ИП):</td>
			<td><input type="text" name="UF_REG_NUMBER" value="<?=$arResult["arUser"]["UF_REG_NUMBER"]?>" class="form__text"></td>
		</tr>
		<tr>
			<td>ИНН:</td>
			<td><input type="text" name="UF_INN" value="<?=$arResult["arUser"]["UF_INN"]?>" class="form__text"></td>
		</tr>
		<tr>
			<td>ОГРН:</td>
			<td><input type="text" name="UF_OGRN" value="<?=$arResult["arUser"]["UF_OGRN"]?>" class="form__text"></td>
		</tr>
		<tr>
			<td>Расчетный счет:</td>
			<td><input type="text" name="UF_SETTLEMENT" value="<?=$arResult["arUser"]["UF_SETTLEMENT"]?>" class="form__text"></td>
		</tr>
		<tr>
			<td>Банк:</td>
			<td><input type="text" name="UF_BANK" value="<?=$arResult["arUser"]["UF_BANK"]?>" class="form__text"></td>
		</tr>
		<tr>
			<td>Корр. счет:</td>
			<td><input type="text" name="UF_CORRESPONDENT" value="<?=$arResult["arUser"]["UF_CORRESPONDENT"]?>" class="form__text"></td>
		</tr>
		<tr>
			<td>БИК:</td>
			<td><input type="text" name="UF_BIK" value="<?=$arResult["arUser"]["UF_BIK"]?>" class="form__text"></td>
		</tr>
	<?}?>
	</table>
	<a href="/personal/" class="edit-profile__back">Назад</a>
	<input type="submit" name="save" value="Сохранить" class="form__submit">
</form>