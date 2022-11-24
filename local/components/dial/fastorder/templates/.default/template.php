<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
	if ($arParams["ITEM"]["PREVIEW_PICTURE"]!='') $image = CFile::ResizeImageGet($arParams["ITEM"]["PREVIEW_PICTURE"], array("width"=>150,"height"=>150), BX_RESIZE_IMAGE_EXACT);
	else {$image["src"]="/local/templates/index/images/no_photo.png";}
?>﻿<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
	if ($arParams["ITEM"]["PREVIEW_PICTURE"]!='') $image = CFile::ResizeImageGet($arParams["ITEM"]["PREVIEW_PICTURE"], array("width"=>150,"height"=>150), BX_RESIZE_IMAGE_EXACT);
	else {$image["src"]="/local/templates/index/images/no_photo.png";}
?>
<button type="button" class="fastorder-button">Купить в один клик</button>
<div class="fastorder">
	<div class="fastorder__overlay"></div>
	<div class="fastorder__popup">
		<div class="fastorder__close">×</div>
		<h4 class="fastorder__title"><?=$arParams["ITEM"]["~NAME"]?></h4>
		<div class="fastorder__item">
			<p><img src="<?=$image["src"]?>" alt="<?=$arParams["ITEM"]["~NAME"]?>" title="<?=$arParams["ITEM"]["~NAME"]?>"></p>
			<p class="fastorder__price"><?=$arParams["ITEM"]["MIN_PRICE"]["PRINT_DISCOUNT_VALUE"]?></p>
		</div>
		<div class="fastorder__main">
			<div class="fastorder__message"></div>
			<form method="POST" class="fastorder__form" onsubmit = "yaCounter12655633.reachGoal('odin-click'); return true;">
				<input type="hidden" name="id" value="<?=$arParams["ITEM"]["ID"]?>">
				<table class="fastorder__table">
					<tr>
						<td>Количество:</td>
						<td><input type="number" name="quantity" min="1" value="1" class="fastorder__text"></td>
					</tr>
					<?if(!$USER->IsAuthorized()):?>
						<tr>
							<td>* Ф.И.О.:</td>
							<td><input type="text" name="name" class="fastorder__text" required></td>
						</tr>
						<tr>
							<td>* E-mail:</td>
							<td><input type="text" name="email" class="fastorder__text" required></td>
						</tr>
						<tr>
							<td>* Телефон:</td>
							<td><input type="text" name="phone" class="fastorder__text fastorder__phone" required></td>
						</tr>
					<?endif?>
					<tr>
						<td>Комментарии:</td>
						<td><textarea name="comments" class="fastorder__textarea"></textarea></td>
					</tr>
					<tr>
						<td><input type="checkbox" name="AGREEMENT" value="Y" class="form__checkbox" id="order-form-agreement" required></td>
						<td><label for="order-form-agreement">Я принимаю условия<a href="/informatsiya/politika-konfeditsialnosti/" target="_blank" > соглашения о конфиденциальности персональных данных</a></label></td>
					</tr>
					<tr>
						<td></td>
						<td><input type="submit" onclick=" ga('send', 'event', 'one', 'click');return true;" value="Заказать" class="fastorder__submit"></td>
					</tr>
				</table>
			</form>
		</div>
	</div>
</div>