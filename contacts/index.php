<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetPageProperty("title", "Контакты");
$APPLICATION->SetPageProperty("keywords", "Контакты");
$APPLICATION->SetPageProperty("description", "Контакты  | Усадьба Техно");
$APPLICATION->SetTitle("Контакты");
?>
<h2>Контакты</h2>

<div class="contacts-page-block" itemscope itemtype="http://schema.org/Organization">
	<span itemprop="name" class="razmetka">Усадьба-Техно</span>
	<div class="contacts-page-block-item">
		<div class="contacts-page-block-item-image">
			<img src="/local/templates/index/images/contacts-1.jpg">
		</div>
		<div class="contacts-page-block-item-info" itemprop="address" itemscope itemtype="http://schema.org/PostalAddress">
			<p>Магазин "Муравей":<br>
			<span itemprop="streetAddress">Ул.Демидовская плотина,13</p></span>

			<p>Телефон:<br>
			<span itemprop="telephone">+7 (4872) 42-58-12</span></p>
		</div>
	</div>
	<div class="contacts-page-block-item">
		<div class="contacts-page-block-item-image">
			<img src="/local/templates/index/images/contacts-2.jpg">
		</div>
	</div>
</div>
<p><b>Реквизиты:</b></p>
<table class="contact-requizit">
	<tr>
		<td>Полное наименование организации</td>
		<td>Общество с ограниченной ответственностью «Дионис-II»</td>
	</tr>	
	<tr>
		<td>Сокращенное наименование организации</td>
		<td>ООО «Дионис-II»</td>
	</tr>
	<tr>
		<td>Фактический адрес</td>
		<td>г. Тула, ул. Демидовская плотина, 13</td>
	</tr>
	<tr>
		<td>Телефон и факс по факт. адресу</td>
		<td>Тел. (4872)42-58-12</td>
	</tr>
	<tr>
		<td>Юридический адрес</td>
		<td>г. Тула, ул. Демидовская плотина, 13</td>
	</tr>
	<tr>
		<td>Телефон и факс по юр. адресу</td>
		<td>Тел. (4872)42-58-12</td>
	</tr>
	<tr>
		<td>E-mail для доставки счетов</td>
		<td>usatba-texno@mail.ru</td>
	</tr>
	<tr>
		<td>ИНН</td>
		<td>7104526513</td>
	</tr>
	<tr>
		<td>КПП</td>
		<td>710501001</td>
	</tr>
	<tr>
		<td>Код ОГРН</td>
		<td>1147154040065</td>
	</tr>
	<tr>
		<td>Код отрасли по ОКВЭД</td>
		<td>52.46.6</td>
	</tr>
	<tr>
		<td>Код организации по ОКПО</td>
		<td>24704482</td>
	</tr>
	<tr>
		<td>Полное наименование учреждения банка</td>
		<td>ОАО «УРАЛСИБ» г. Москва</td>
	</tr>
	<tr>
		<td>Расчетный счет</td>
		<td>40702810700960000042</td>
	</tr>
	<tr>
		<td>Корреспондентский счет</td>
		<td>30101810100000000787</td>
	</tr>	
	<tr>
		<td>БИК</td>
		<td>044525787</td>
	</tr>	
	<tr>
		<td>Руководитель организации (ФИО полностью, должность, документ, на основании которого действует)</td>
		<td>Тишкова Любовь Григорьевна, генеральный директор, действует на основании устава</td>
	</tr>	
</table>
<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>