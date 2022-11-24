<?if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>
<?
	//echo "<pre>";
	//print_r($arResult);
	$rsUser = CUser::GetByID($arResult['ID']);
	$arUser = $rsUser->Fetch();
?>
<div class="profile">
	<table class="profile__table">
		<tr>
			<td width="160">Логин:</td>
			<td><?=$arResult["arUser"]["LOGIN"]?></td>
		</tr>
		<tr>
			<td>E-mail:</td>
			<td><?=$arResult["arUser"]["EMAIL"]?></td>
		</tr>
		<tr>
			<td>Фамилия:</td>
			<td><?=$arResult["arUser"]["LAST_NAME"]?></td>
		</tr>
		<tr>
			<td>Имя:</td>
			<td><?=$arResult["arUser"]["NAME"]?></td>
		</tr>
		<tr>
			<td>Телефон:</td>
			<td><?=$arResult["arUser"]["PERSONAL_PHONE"]?></td>
		</tr>
	<?if($arUser['UF_USER_TYPE'] == 1){?>
		<tr>
			<td>Название компании:</td>
			<td><?=$arResult["arUser"]["WORK_COMPANY"]?></td>
		</tr>
		<tr>
			<td>Юридический адрес:</td>
			<td><?=$arResult["arUser"]["UF_LEGAL_ADDRESS"]?></td>
		</tr>
	</table>
	<?}?>
	<div class="profile__separator"></div>
	<?if($arUser['UF_USER_TYPE'] == 1){?>
	<table class="profile__table">
		<tr>
			<td width="160">Регистр. номер (ИП):</td>
			<td><?=$arResult["arUser"]["UF_REG_NUMBER"]?></td>
		</tr>
		<tr>
			<td>ИНН:</td>
			<td><?=$arResult["arUser"]["UF_INN"]?></td>
		</tr>
		<tr>
			<td>ОГРН:</td>
			<td><?=$arResult["arUser"]["UF_OGRN"]?></td>
		</tr>
		<tr>
			<td>Расчетный счет:</td>
			<td><?=$arResult["arUser"]["UF_SETTLEMENT"]?></td>
		</tr>
		<tr>
			<td>Банк:</td>
			<td><?=$arResult["arUser"]["UF_BANK"]?></td>
		</tr>
		<tr>
			<td>Корр. счет:</td>
			<td><?=$arResult["arUser"]["UF_CORRESPONDENT"]?></td>
		</tr>
		<tr>
			<td>БИК:</td>
			<td><?=$arResult["arUser"]["UF_BIK"]?></td>
		</tr>
	<?}?>
	</table>
</div>
<div class="profile-links">
	<a href="/personal/edit/" class="profile-links__link">Редактировать личные данные</a>
	<a href="/personal/edit/password/" class="profile-links__link">Изменить пароль</a>
</div>