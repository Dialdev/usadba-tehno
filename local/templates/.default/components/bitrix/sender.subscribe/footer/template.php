<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
$this->setFrameMode(true);
?>
<div class="footer-subscribe">
	<p>Подписаться на рассылку:</p>
	<form action="<?=$arResult["FORM_ACTION"]?>" method="POST">
		<?=bitrix_sessid_post()?>
		<input type="hidden" name="sender_subscription" value="add">
		<input type="hidden" name="SENDER_SUBSCRIBE_RUB_ID[]" value="1">
		<input type="email" name="SENDER_SUBSCRIBE_EMAIL" value="<?=$arResult["EMAIL"]?>" class="footer-subscribe__text" placeholder="Введите Ваш e-mail">
		<input type="submit" class="form__submit form__submit_red" value="Подписаться">
	</form>
</div>
<?if (isset($arResult["MESSAGE"])):?>
<div class="popup popup_subscribe">
	<div class="popup__close">×</div>
	<p class="popup__title">Подписка</p>
	<p><?=htmlspecialcharsbx($arResult["MESSAGE"]["TEXT"])?></p>
</div>
<script>
$(function(){
	$('.popup_subscribe,.popup-overlay').show();
	setTimeout(function(){ $('.popup_subscribe,.popup-overlay').fadeOut(); }, 5000);
});
</script>
<?endif?>