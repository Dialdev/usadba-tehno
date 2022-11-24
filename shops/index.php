<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetPageProperty("title", "Контакты  | Усадьба Техно");
$APPLICATION->SetPageProperty("description", "Контакты  | Усадьба Техно");
$APPLICATION->SetTitle("Контакты");
?><h1 class="h2">Контакты</h1>
<div class="contacts-block">
	<div class="shop_ shop1">
		<div class="shop__list1" style="float:left;">
	 <a href="/upload/iblock/350/3500abb615b4b7917cca8764202b01f3.JPG" class="shop__item fb" rel="fb"> <img alt="1" src="/upload/resize_cache/iblock/350/190_190_2/3500abb615b4b7917cca8764202b01f3.JPG" title="1"> </a>
		</div>
	 <address>
		<p>
	 <b>Магазин "Муравей"</b>
		</p>
		<p>
			 г. Тула, Россия
		</p>
		<p>
			 Ул. Демидовская плотина,13
		</p>
		<p>
			<a href="mailto:usatba-texno@mail.ru"><i>usatba-texno@mail.ru</i></a>
		</p>
	 </address>
		<p>
			<b>Телефон:</b> <span><a href="tel:+74872425812"><b class="red">+7 (4872)</b> 42-58-12</a></span>
		</p>
		<p>
	 <b>График работы:</b> Пн-пт 09:00-19:00, Сб-вс 09:00-17:00
		</p>
	</div>
	<div class="clear">
	</div>
	 <br>
	<p>
	 <b>Реквизиты:</b>
	</p>
	<div class="left_block">
		<table class="contact-requizit">
		<tbody>
		<tr>
			<td>
				 Полное наименование организации
			</td>
			<td>
				 Общество с ограниченной ответственностью «Дионис-II»
			</td>
		</tr>
		<tr>
			<td>
				 Сокращенное наименование организации
			</td>
			<td>
				 ООО «Дионис-II»
			</td>
		</tr>
		<tr>
			<td>
				 Фактический адрес
			</td>
			<td>
				г. Тула, ул. Демидовская плотина, 13
			</td>
		</tr>
		<tr>
			<td>
				 Телефон и факс по факт. адресу
			</td>
			<td>
				<span>Тел.<a href="tel:+74872425812"><b class="red">+7 (4872)</b> 42-58-12</a></span>
				  
			</td>
		</tr>
		<tr>
			<td>
				 Юридический адрес
			</td>
			<td>
				г. Тула, ул. Демидовская плотина, 13
			</td>
		</tr>
		<tr>
			<td>
				 Телефон и факс по юр. адресу
			</td>
			<td>
				<span>Тел.<a href="tel:+74872425812"><b class="red">+7 (4872)</b> 42-58-12</a></span>
			</td>
		</tr>
		<tr>
			<td>
				 E-mail для доставки счетов
			</td>
			<td>
	 <a href="mailto:usatba-texno@mail.ru">usatba-texno@mail.ru</a>
			</td>
		</tr>
		<tr>
			<td>
				 ИНН
			</td>
			<td>
			7104526513
			</td>
		</tr>

		<tr>
			<td>
				 КПП
			</td>
			<td>
				 710501001
			</td>
		</tr>
		<tr>
			<td>
				 Код ОГРН
			</td>
			<td>
				 1147154040065
			</td>
		</tr>
		<tr>
			<td>
				 Код отрасли по ОКВЭД
			</td>
			<td>
				47.52.6; 45.40; 46.61; 95.22; 95.29
			</td>
		</tr>
		<tr>
			<td>
				 Код организации по ОКПО
			</td>
			<td>
				24704482
			</td>
		</tr>
		<tr>
			<td>
				 Полное наименование учреждения банка
			</td>
			<td>
				 ПАО «Банк УРАЛСИБ» г. Москва
			</td>
		</tr>
		<tr>
			<td>
				 Расчетный счет
			</td>
			<td>
				 40702810700960000042
			</td>
		</tr>
		<tr>
			<td>
				 Корреспондентский счет
			</td>
			<td>
				 30101810100000000787
			</td>
		</tr>
		<tr>
			<td>
				 БИК
			</td>
			<td>
				 044525787
			</td>
		</tr>
		<tr>
			<td>
				 Руководитель организации (ФИО полностью, должность, документ, на основании которого действует)
			</td>
			<td>
				Тишкова Любовь Григорьевна, генеральный директор, действует на основании устава
			</td>
		</tr>
		</tbody>
		</table>
	</div>
	<div style="clear:both;">
</div>
</div>
<?$APPLICATION->IncludeComponent(
	"bitrix:news.list",
	"sert",
	Array(
		"ACTIVE_DATE_FORMAT" => "d.m.Y",
		"ADD_SECTIONS_CHAIN" => "N",
		"AJAX_MODE" => "Y",
		"AJAX_OPTION_ADDITIONAL" => "",
		"AJAX_OPTION_HISTORY" => "N",
		"AJAX_OPTION_JUMP" => "N",
		"AJAX_OPTION_STYLE" => "Y",
		"CACHE_FILTER" => "Y",
		"CACHE_GROUPS" => "Y",
		"CACHE_TIME" => "3600",
		"CACHE_TYPE" => "A",
		"CHECK_DATES" => "Y",
		"COMPONENT_TEMPLATE" => "sert",
		"DETAIL_URL" => "",
		"DISPLAY_BOTTOM_PAGER" => "Y",
		"DISPLAY_DATE" => "Y",
		"DISPLAY_NAME" => "Y",
		"DISPLAY_PICTURE" => "Y",
		"DISPLAY_PREVIEW_TEXT" => "Y",
		"DISPLAY_TOP_PAGER" => "Y",
		"FIELD_CODE" => array(0=>"ID",1=>"",),
		"FILE_404" => "",
		"FILTER_NAME" => "",
		"HIDE_LINK_WHEN_NO_DETAIL" => "N",
		"IBLOCK_ID" => "13",
		"IBLOCK_TYPE" => "news",
		"INCLUDE_IBLOCK_INTO_CHAIN" => "N",
		"INCLUDE_SUBSECTIONS" => "Y",
		"MESSAGE_404" => "",
		"NEWS_COUNT" => "20",
		"PAGER_BASE_LINK" => "",
		"PAGER_BASE_LINK_ENABLE" => "Y",
		"PAGER_DESC_NUMBERING" => "Y",
		"PAGER_DESC_NUMBERING_CACHE_TIME" => "36000",
		"PAGER_PARAMS_NAME" => "arrPager",
		"PAGER_SHOW_ALL" => "Y",
		"PAGER_SHOW_ALWAYS" => "Y",
		"PAGER_TEMPLATE" => "",
		"PAGER_TITLE" => "Новости",
		"PARENT_SECTION" => "",
		"PARENT_SECTION_CODE" => "",
		"PREVIEW_TRUNCATE_LEN" => "",
		"PROPERTY_CODE" => array(0=>"",1=>"DESCRIPTION",2=>"",),
		"SET_BROWSER_TITLE" => "N",
		"SET_LAST_MODIFIED" => "N",
		"SET_META_DESCRIPTION" => "N",
		"SET_META_KEYWORDS" => "N",
		"SET_STATUS_404" => "Y",
		"SET_TITLE" => "N",
		"SHOW_404" => "Y",
		"SORT_BY1" => "ACTIVE_FROM",
		"SORT_BY2" => "SORT",
		"SORT_ORDER1" => "DESC",
		"SORT_ORDER2" => "ASC"
	)
);?><?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>