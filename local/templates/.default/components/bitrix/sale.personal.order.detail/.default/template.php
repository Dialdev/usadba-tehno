<?if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
$APPLICATION->SetAdditionalCSS('/local/templates/.default/components/bitrix/sale.basket.basket/.default/style.css');
if (!empty($arResult["ERROR_MESSAGE"])) {
	ShowError($arResult["ERROR_MESSAGE"]);
	return;
}
?>
<div class="adaptive-table">
	<table class="order">
		<tr>
			<th colspan="2">Заказ №<?=$arResult["ACCOUNT_NUMBER"]?> от <?=$arResult["DATE_INSERT_FORMATED"]?></th>
		</tr>
		<tr class="order__tr_first">
			<td>Текущий статус:</td>
			<td><?=$arResult["STATUS"]["NAME"]?> (от <?=$arResult["DATE_STATUS_FORMATED"]?>)</td>
		</tr>
		<tr>
			<td>Сумма заказа:</td>
			<td>
				<?=$arResult["PRICE_FORMATED"]?>
				<?if(floatval($arResult["SUM_PAID"])):?>
					(из них оплачено: <?=$arResult["SUM_PAID_FORMATED"]?>)
				<?endif?>
			</td>
		</tr>
		<tr>
			<td>Оплачен:</td>
			<td>
				<?if($arResult["PAYED"] == "Y"):?>
					Да (от <?=$arResult["DATE_PAYED_FORMATED"]?>)
				<?else:?>
					Нет
				<?endif?>
			</td>
		</tr>
		<tr class="order__tr_last">
			<td>Отменен:</td>
			<td>
				<?if($arResult["CANCELED"] == "Y"):?>
					Да (от <?=$arResult["DATE_CANCELED_FORMATED"]?>)
				<?else:?>
					Нет
					<?if($arResult["CAN_CANCEL"] == "Y"):?>
						(<a href="<?=$arResult["URL_TO_CANCEL"]?>">Отменить</a>)
					<?endif?>
				<?endif?>
			</td>
		</tr>
		<tr>
			<th colspan="2">Данные вашей учетной записи</th>
		</tr>
		<tr class="order__tr_first">
			<td>Пользователь:</td>
			<td><?=$arResult["USER_LAST_NAME"]?> <?=$arResult["USER_NAME"]?></td>
		</tr>
		<tr>
			<td>Логин:</td>
			<td><?=$arResult["USER"]["LOGIN"]?></td>
		</tr>
		<tr class="order__tr_last">
			<td>E-mail:</td>
			<td><?=$arResult["USER"]["EMAIL"]?></td>
		</tr>
		<tr>
			<th colspan="2">Параметры заказа</th>
		</tr>
		<?$i = 0; foreach($arResult["ORDER_PROPS"] as $prop): $i++;?>
			<tr<?=($i==1? ' class="order__tr_first"' : '')?>>
				<td><?=$prop["NAME"]?>:</td>
				<td><?=$prop["VALUE"]?></td>
			</tr>
		<?endforeach?>
		<tr class="order__tr_last">
			<td>Комментарии к заказу:</td>
			<td><?=$arResult["USER_DESCRIPTION"]?></td>
		</tr>
	</table>
</div>
<h3 class="h3">Содержимое заказа</h3>
<div class="adaptive-table">
	<table class="basket">
		<tr class="basket__header">
			<td>№</td>
			<td>Фото</td>
			<td class="basket__left">Наименование</td>
			<td>Кол-во</td>
			<td width="100">Цена за ед.</td>
			<td width="100">Сумма</td>
		</tr>
		<?
		$i = 0;
		$productSum = 0;
		foreach ($arResult["BASKET"] as $arItem):
			$i++;
			$productSum += $arItem["PRICE"]*$arItem["QUANTITY"];
		?>
		<tr>
			<td><?=$i?></td>
			<td><a href="<?=$arItem["DETAIL_PAGE_URL"]?>"><img src="<?=$arItem["PICTURE"]["SRC"]?>" alt="<?=$arItem["NAME"]?>" title="<?=$arItem["NAME"]?>" class="basket__img"></a></td>
			<td class="basket__left"><a href="<?=$arItem["DETAIL_PAGE_URL"]?>" class="basket__name"><?=$arItem["NAME"]?></a></td>
			<td><?=$arItem["QUANTITY"]?></td>
			<td><?=$arItem["PRICE"]?></td>
			<td><?=$arItem["PRICE"]*$arItem["QUANTITY"]?></td>
		</tr>
		<?endforeach?>
	</table>
	<table class="order-summary">
		<tr>
			<td>Товаров на:</td>
			<td><?=SaleFormatCurrency($productSum, $arResult["CURRENCY"])?></td>
		</tr>
		<?if(strlen($arResult["PRICE_DELIVERY_FORMATED"])):?>
			<tr>
				<td>Стоимость доставки:</td>
				<td><?=$arResult["PRICE_DELIVERY_FORMATED"]?></td>
			</tr>
		<?endif?>
		<?foreach($arResult["TAX_LIST"] as $tax):?>
			<tr>
				<td><?=$tax["TAX_NAME"]?>:</td>
				<td><?=$tax["VALUE_MONEY_FORMATED"]?></td>
			</tr>
		<?endforeach?>
		<?if(floatval($arResult["TAX_VALUE"])):?>
			<tr>
				<td>Сумма налогов:</td>
				<td><?=$arResult["TAX_VALUE_FORMATED"]?></td>
			</tr>
		<?endif?>
		<?if(floatval($arResult["DISCOUNT_VALUE"])):?>
			<tr>
				<td>Скидка:</td>
				<td><?=$arResult["DISCOUNT_VALUE_FORMATED"]?></td>
			</tr>
		<?endif?>
		<tr>
			<td><b>Итого:</b></td>
			<td><b><?=$arResult["PRICE_FORMATED"]?></b></td>
		</tr>
	</table>
</div>
<a href="<?=$arResult["URL_TO_LIST"]?>" class="more-button">← В список заказов</a>
