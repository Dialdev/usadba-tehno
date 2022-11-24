<?if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>
<?
if (!empty($arResult["ERRORS"]["FATAL"])) {
	foreach($arResult["ERRORS"]["FATAL"] as $error)
		ShowError($error);
	return;
}
if (!empty($arResult["ERRORS"]["NONFATAL"]))
	foreach($arResult["ERRORS"]["NONFATAL"] as $error)
		ShowError($error);
?>
<?if (!empty($arResult["ORDERS"])):?>
	<?foreach($arResult["ORDERS"] as $order):?>
		<div class="orders-item">
			<div class="orders-item__title">Заказ №<?=$order["ORDER"]["ACCOUNT_NUMBER"]?> от <?=$order["ORDER"]["DATE_INSERT_FORMATED"]?></div>
			<div class="orders-item__info">
				<p><b>Сумма заказа:</b> <?=$order["ORDER"]["FORMATED_PRICE"]?></p>
				<p><b>Оплачен:</b> <?=($order["ORDER"]["PAYED"] == "Y" ? "Да" : "Нет")?></p>
				<p><b>Состав заказа:</b></p>
				<ol>
				<?foreach ($order["BASKET_ITEMS"] as $item):?>
					<li><a href="<?=$item["DETAIL_PAGE_URL"]?>" target="_blank"><?=$item["NAME"]?></a> (<?=$item["QUANTITY"]?> <?=$item["MEASURE_NAME"]?>)</li>
				<?endforeach?>
				</ol>
			</div>
			<div class="orders-item__controls">
				<a href="<?=$order["ORDER"]["URL_TO_DETAIL"]?>" class="orders-item__button">Подробнее о заказе</a>
				<span class="orders-item__status"><?=$arResult["INFO"]["STATUS"][$order["ORDER"]["STATUS_ID"]]["NAME"]?></span>
				<a href="<?=$order["ORDER"]["URL_TO_CANCEL"]?>" class="orders-item__button">Отменить заказ</a>
				<a href="<?=$order["ORDER"]["URL_TO_COPY"]?>" class="orders-item__button">Повторить заказ</a>
			</div>
		</div>
	<?endforeach;?>
	<?=$arResult["NAV_STRING"]?>
<?else:?>
	<?ShowError("Заказы не найдены.")?>
<?endif?>