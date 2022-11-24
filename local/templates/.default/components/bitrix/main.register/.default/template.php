<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>
<h1>Регистрация</h1>
<?if($USER->IsAuthorized()){?>

<p>Вы успешно зарегистрированы на сайте</p>

<?} else {?>
<?
foreach ($arResult["ERRORS"] as $error)
	ShowError($error);
?>
<form class="reg-form" method="post" action="<?=POST_FORM_ACTION_URI?>" enctype="multipart/form-data">
	<div class="registration-type">
		<input id="usertype1" type="radio" name="UF_USER_TYPE" value="1" class="registration-type__item" <?=($arResult["VALUES"]["UF_USER_TYPE"]!=2?"checked":"")?>>
		<label for="usertype1">Юридические лица и ИП</label>
		<input id="usertype2" type="radio" name="UF_USER_TYPE" value="2" class="registration-type__item" <?=($arResult["VALUES"]["UF_USER_TYPE"]==2?"checked":"")?>>
		<label for="usertype2">Частное лицо</label>
	</div>
	<div class="registration-block registration-block_first">
		<input type="text" name="REGISTER[LAST_NAME]" value="<?=$arResult["VALUES"]["LAST_NAME"]?>" class="form__text" placeholder="Фамилия *" required>
		<input type="text" name="REGISTER[NAME]" value="<?=$arResult["VALUES"]["NAME"]?>" class="form__text" placeholder="Имя *" required>
		<input type="text" name="REGISTER[PERSONAL_PHONE]" value="<?=$arResult["VALUES"]["PERSONAL_PHONE"]?>" class="form__text" placeholder="Телефон *" required>
		<input type="text" name="REGISTER[EMAIL]" value="<?=$arResult["VALUES"]["EMAIL"]?>" class="form__text" placeholder="E-mail *" required>
		<div class="company-details"><input type="text" name="REGISTER[WORK_COMPANY]" value="<?=$arResult["VALUES"]["WORK_COMPANY"]?>" class="form__text" placeholder="Название компании *" required></div>
	</div>
	<div class="registration-block">
		<input type="text" name="REGISTER[LOGIN]" value="<?=$arResult["VALUES"]["LOGIN"]?>" class="form__text" placeholder="Логин *" required>
		<input type="password" name="REGISTER[PASSWORD]" value="<?=$arResult["VALUES"]["PASSWORD"]?>" class="form__text" placeholder="Пароль *" required>
		<input type="password" name="REGISTER[CONFIRM_PASSWORD]" value="<?=$arResult["VALUES"]["CONFIRM_PASSWORD"]?>" class="form__text" placeholder="Подтверждение пароля *" required>
		<div class="company-details">
			<ul class="company-details-type">
				<li class="company-details-type__item">Прикрепить реквизиты</li>
				<li class="company-details-type__item">Заполнить реквизиты</li>
			</ul>
			<div class="company-details__file">
				<input type="file" name="UF_COMPANY_FILE" id="company_file" class="form__fileupload"><label for="company_file" data-placeholder="Прикрепить карточку компании">Прикрепить карточку компании</label>
			</div>
			<div class="company-details__inputs">
				<textarea name="UF_LEGAL_ADDRESS" class="form__textarea" placeholder="Юридический адрес *" required><?=$arResult["VALUES"]["UF_LEGAL_ADDRESS"]?></textarea>
				<input type="text" name="UF_REG_NUMBER" value="<?=$arResult["VALUES"]["UF_REG_NUMBER"]?>" class="form__text" placeholder="Регистрационный номер (ИП) *" required>
				<input type="text" name="UF_INN" value="<?=$arResult["VALUES"]["UF_INN"]?>" class="form__text" placeholder="ИНН *" required>
				<input type="text" name="UF_OGRN" value="<?=$arResult["VALUES"]["UF_OGRN"]?>" class="form__text" placeholder="ОГРН *" required>
				<input type="text" name="UF_SETTLEMENT" value="<?=$arResult["VALUES"]["UF_SETTLEMENT"]?>" class="form__text" placeholder="Расчетный счет *" required>
				<input type="text" name="UF_BANK" value="<?=$arResult["VALUES"]["UF_BANK"]?>" class="form__text" placeholder="Банк *" required>
				<input type="text" name="UF_CORRESPONDENT" value="<?=$arResult["VALUES"]["UF_CORRESPONDENT"]?>" class="form__text" placeholder="Корреспондентский счет *" required>
				<input type="text" name="UF_BIK" value="<?=$arResult["VALUES"]["UF_BIK"]?>" class="form__text" placeholder="БИК *" required>
			</div>
		</div>
		<input type="checkbox" name="AGREEMENT" value="Y" class="form__checkbox" id="agreement" <?=(isset($_POST["AGREEMENT"])?"checked":"")?> required><label for="agreement">Я принимаю условия <span class="agreement-button">соглашения о конфиденциальности персональных данных</span></label>


		<input type="submit" name="register_submit_button" value="Регистрация" class="form__submit">
		<span class="form__notice"><span class="text_red">*</span> - обязательные поля к заполнению</span>
	</div>
</form>
<?}?>
