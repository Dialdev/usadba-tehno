<?php if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die(); ?>

<?php

CSalePaySystemAction::InitParamArrays($arOrder, $arOrder['ID']);

$MNT_PAYMENT_SERVER = "www.payanyway.ru";
$action = "https://".$MNT_PAYMENT_SERVER."/assistant.htm";

$MNT_ID = trim( CSalePaySystemAction::GetParamValue("MNT_ID", 0) );
$MNT_TRANSACTION_ID = $arOrder['ID'];
$MNT_CURRENCY_CODE = $arOrder['CURRENCY'];
$MNT_AMOUNT = number_format($arOrder['PRICE'], 2, ".", "");
$MNT_TEST_MODE = CSalePaySystemAction::GetParamValue("MNT_TEST_MODE", "0") == "1" ? "1" : "0";
$MNT_SIGNATURE = md5($MNT_ID . $MNT_TRANSACTION_ID . $MNT_AMOUNT . $MNT_CURRENCY_CODE . $MNT_TEST_MODE . CSalePaySystemAction::GetParamValue("DATA_INTEGRITY_CODE", ""));

$host = COption::GetOptionString("main", "server_name", $_SERVER["HTTP_HOST"]);
if($host == "") $host = $_SERVER["HTTP_HOST"];
$host = $_SERVER['HTTPS'] == 'on' ? 'https://'.$host : 'http://'.$host;

?>
<title>PayAnyWay ссылка</title>

<p>Заказ номер <b>#<?= $MNT_TRANSACTION_ID?></b></p>
<p>Сумма заказа: <b><?= $MNT_AMOUNT?> <?= $MNT_CURRENCY_CODE?></b></p>
<p>Покупатель: <a href="mailto:<?= $arUser['EMAIL']?>"><?= $arUser['EMAIL']?></a></p>

<br/>
<p>Кнопка PayAnyWay для оплаты:</p>
<form action="<?= $action?>" method="post" accept-charset="utf-8">
	<font class="tablebodytext">
		<input type="hidden" name="MNT_ID" value="<?= $MNT_ID?>">
		<input type="hidden" name="MNT_TRANSACTION_ID" value="<?= $MNT_TRANSACTION_ID?>">
		<input type="hidden" name="MNT_CURRENCY_CODE" value="<?= $MNT_CURRENCY_CODE?>">
		<input type="hidden" name="MNT_AMOUNT" value="<?= $MNT_AMOUNT?>">
		<input type="hidden" name="MNT_TEST_MODE" value="<?= $MNT_TEST_MODE?>">
		<input type="hidden" name="MNT_SIGNATURE" value="<?= $MNT_SIGNATURE?>">
		<input type="hidden" name="MNT_DESCRIPTION" value="Заказ номер #<?= $MNT_TRANSACTION_ID?>">
		<input type="hidden" name="paymentSystem" value="<?= $payment_system?>">
		<input type="hidden" name="MNT_SUCCESS_URL" value="<?= $host . "/personal/order/"?>">
		<input type="hidden" name="MNT_FAIL_URL" value="<?= $host. "/personal/order/"?>">
			
		<? foreach($extraParameters as $name=>$value):?>
		<input type="hidden" name="<?= $name?>" value="<?= $value?>">
		<?endforeach;?>
			
		<? if ($invoice):?>
		<input type="hidden" name="action" value="invoice">
		<? endif;?>
			
		<? if ($unit_id):?>
		<input type="hidden" name="paymentSystem.unitId" value="<?= $unit_id?>">
		<? endif;?>
			
		<? if ($account_id):?>
		<input type="hidden" name="paymentSystem.accountId" value="<?= $account_id?>">
		<? endif;?>
			
		<? if ($payment_system !== 'payanyway'):?>
		<input type="hidden" name="followup" value="true">
		<input type="hidden" name="javascriptEnabled" value="true">
		<? endif;?>
			
		<input type="submit" value="Оплатить">
	</font>
</form>

<br/>
<p>Ссылка PayAnyWay для оплаты:</p>
<a href="<?= $action?>?MNT_ID=<?= $MNT_ID?>&MNT_TRANSACTION_ID=<?= $MNT_TRANSACTION_ID?>&MNT_CURRENCY_CODE=<?= $MNT_CURRENCY_CODE?>&MNT_AMOUNT=<?= $MNT_AMOUNT?>&MNT_TEST_MODE=<?= $MNT_TEST_MODE?>&MNT_SIGNATURE=<?= $MNT_SIGNATURE?>&MNT_DESCRIPTION=Заказ%20номер%20#<?= $MNT_TRANSACTION_ID?>&paymentSystem=<?= $payment_system?>&MNT_SUCCESS_URL=<?= $host . "/personal/order/"?>&MNT_FAIL_URL=<?= $host. "/personal/order/"?><? foreach($extraParameters as $name=>$value):?>&<?= $name?>=<?= $value?><?endforeach;?><? if ($invoice):?>&action=invoice<? endif;?><? if ($unit_id):?>&paymentSystem.unitId=<?= $unit_id?><? endif;?><? if ($account_id):?>&paymentSystem.accountId=<?= $account_id?><? endif;?><? if ($payment_system !== 'payanyway'):?>&followup=true&javascriptEnabled=true<? endif;?>" target="_blank"><?= $action?>?MNT_ID=<?= $MNT_ID?>&MNT_TRANSACTION_ID=<?= $MNT_TRANSACTION_ID?>&MNT_CURRENCY_CODE=<?= $MNT_CURRENCY_CODE?>&MNT_AMOUNT=<?= $MNT_AMOUNT?>&MNT_TEST_MODE=<?= $MNT_TEST_MODE?>&MNT_SIGNATURE=<?= $MNT_SIGNATURE?>&MNT_DESCRIPTION=Заказ%20номер%20#<?= $MNT_TRANSACTION_ID?>&paymentSystem=<?= $payment_system?>&MNT_SUCCESS_URL=<?= $host . "/personal/order/"?>&MNT_FAIL_URL=<?= $host. "/personal/order/"?><? foreach($extraParameters as $name=>$value):?>&<?= $name?>=<?= $value?><?endforeach;?><? if ($invoice):?>&action=invoice<? endif;?><? if ($unit_id):?>&paymentSystem.unitId=<?= $unit_id?><? endif;?><? if ($account_id):?>&paymentSystem.accountId=<?= $account_id?><? endif;?><? if ($payment_system !== 'payanyway'):?>&followup=true&javascriptEnabled=true<? endif;?></a>

