<?php
global $MESS;

$MESS['PAYANYWAY_SBERBANK_TITLE'] 	= 'Сбербанк';

$MESS['PAW_INVOICE_CREATED_TTL']	= "Создано платежное поручение.";
$MESS['PAW_INVOICE_ERROR_TTL']		= "Ошибка создания платежного поручения.";
$MESS['PAW_INVOICE_CREATED']		= "<h3>Для оплаты через \"Сбербанк\" номер счета для пополнения: %transaction%</h3>
									   <p>Операция создана, но не оплачена. Для завершения операции Вам необходимо произвести перечисление средств в систему <b>МОНЕТА.РУ</b> через \"Сбербанк\", используя вместо номера счета для пополнения данный код:</p>
									   <p>%transaction%</p>
									   <p>Вы также можете перейти по <a href='https://online.sberbank.ru/PhizIC/private/payments/servicesPayments/edit.do?recipient=113368&amp;field(_TCM_IDENT_WlsZid1)=%transaction%'>ссылке</a> для оплаты с помощью системы СбербанкОнлайн.</p>
										<p>Сумма к оплате: %amount%</p>
										<p>Внешняя комиссия: %fee%</p>";


?>
