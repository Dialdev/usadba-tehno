<?if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>
<?
if (!empty($arResult["ERROR_MESSAGE"])) {
	ShowError($arResult["ERROR_MESSAGE"]);
	return;
}
?>
<div class="frame-wrapper">
	<div class="frame frame_small">
		<form method="post" action="<?=POST_FORM_ACTION_URI?>">
			<?=bitrix_sessid_post()?>
			<input type="hidden" name="CANCEL" value="Y">
			<input type="hidden" name="ID" value="<?=$arResult["ID"]?>">
			<p>Вы уверены, что хотите отменить <a href="<?=$arResult["URL_TO_DETAIL"]?>">заказ №<?=$arResult["ACCOUNT_NUMBER"]?></a>?<br><b>Отмена заказа необратима.</b></p>
			<p>Укажите, пожалуйста, причину отмены заказа:</p>
			<textarea name="REASON_CANCELED" class="form__textarea"></textarea>
			<input type="submit" name="action" value="Отменить заказ" class="form__submit">
		</form>
	</div>
</div>
<a href="<?=$arResult["URL_TO_LIST"]?>" class="more-button">← В список заказов</a>