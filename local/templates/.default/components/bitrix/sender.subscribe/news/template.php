<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
$this->setFrameMode(true);
?>
<div class="frame-wrapper">
	<form action="<?=$arResult["FORM_ACTION"]?>" method="POST" class="frame">
		<?=bitrix_sessid_post()?>
		<input type="hidden" name="sender_subscription" value="add">
		<input type="hidden" name="SENDER_SUBSCRIBE_RUB_ID[]" value="2">
		<span class="text_uppercase">Подписаться на новости:</span>
		<input type="email" name="SENDER_SUBSCRIBE_EMAIL" value="<?=$arResult["EMAIL"]?>" class="form__text form__text_inline" placeholder="Введите Ваш e-mail">
		<input type="submit" class="form__submit" value="Подписаться">
	</form>
</div>