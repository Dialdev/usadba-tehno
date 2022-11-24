<?
if($INCLUDE_FROM_CACHE!='Y')return false;
$datecreate = '001668163982';
$dateexpire = '001670755982';
$ser_content = 'a:2:{s:7:"CONTENT";s:0:"";s:4:"VARS";a:2:{s:7:"results";a:11:{i:0;a:5:{s:5:"title";s:44:"Найдены служебные файлы";s:8:"critical";s:5:"HIGHT";s:6:"detail";s:285:"Некоторые служебные файлы не были удалены после отладки/установки/переноса проекта, они могут использоваться злоумышленниками для компрометации ресурса.";s:14:"recommendation";s:143:"Необходимо удалить все найденные файлы или корректно ограничить к ним доступ.";s:15:"additional_info";s:606:"Адрес: <a href="https://www.usatba-texno.ru/log.txt?rnd=0.4834791535964601" target="_blank">https://www.usatba-texno.ru/log.txt?rnd=0.4834791535964601</a><br>Запрос/Ответ: <pre>HEAD /log.txt?rnd=0.4834791535964601 HTTP/1.1
user-agent: BitrixCloud BitrixSecurityScanner/Robin-Scooter
accept: */*
host: www.usatba-texno.ru

HTTP/1.1 200 OK
Server: nginx
Date: Wed, 27 Oct 2021 06:10:36 GMT
Content-Type: text/plain
Content-Length: 65854
Connection: keep-alive
Vary: Accept-Encoding
Last-Modified: Wed, 25 Dec 2019 09:07:06 GMT
ETag: &quot;1013e-59a8395afa313&quot;
Accept-Ranges: bytes

<pre>";}i:1;a:5:{s:5:"title";s:61:"Включен расширенный вывод ошибок";s:8:"critical";s:5:"HIGHT";s:6:"detail";s:126:"Расширенный вывод ошибок может раскрыть важную информацию о ресурсе";s:14:"recommendation";s:63:"Выключить в файле настроек .settings.php";s:15:"additional_info";s:0:"";}i:2;a:5:{s:5:"title";s:105:"Ограничен список потенциально опасных расширений файлов";s:8:"critical";s:5:"HIGHT";s:6:"detail";s:377:"Текущий список расширений файлов, которые считаются потенциально опасными, не содержит всех рекомендованных значений. Список расширений исполняемых файлов всегда должен находится в актуальном состоянии";s:14:"recommendation";s:264:"Вы всегда можете изменить список расширений исполняемых файлов в настройках сайта: <a href="/bitrix/admin/settings.php?mid=fileman" target="_blank">Управление структурой</a>";s:15:"additional_info";s:344:"Текущие: php,php3,php4,php5,php6,phtml,pl,asp,aspx,cgi,exe,ico,shtm,shtml<br>
Рекомендованные (без учета настроек вашего сервера): php,php3,php4,php5,php6,phtml,pl,asp,aspx,cgi,dll,exe,ico,shtm,shtml,fcg,fcgi,fpl,asmx,pht,py,psp<br>
Отсутствующие: dll,fcg,fcgi,fpl,asmx,pht,py,psp";}i:3;a:5:{s:5:"title";s:101:"Не удалось проверить доступность обновлений платформы";s:8:"critical";s:5:"HIGHT";s:6:"detail";s:193:"Возможно доступно обновление системы SiteUpdate или у вашей копии продукта истек период получения обновлений";s:14:"recommendation";s:143:"Подробнее на странице: <a href="/bitrix/admin/update_system.php" target="_blank">Обновление платформы</a>";s:15:"additional_info";s:0:"";}i:4;a:4:{s:5:"title";s:109:"Статический анализ уязвимостей обнаружил 1 проблемных мест";s:8:"critical";s:5:"HIGHT";s:14:"recommendation";s:97:"Необходимо обратится к разработчику для исправления";s:6:"detail";s:3008:"<div class="checklist-dot-line"></div><div class="checklist-vulnscan-files"><div class="checklist-vulnscan-vulnscan-blocktitle">Cross-Site Scripting</div><div id="/mail-test.php"><div class="checklist-vulnscan-vulnblock"><span class="checklist-vulnscan-filename">Файл: /mail-test.php</span><div style="visibility: hidden; display:none;" class="checklist-vulnscan-helpbox" data-help="/mail-test.php"><div class="checklist-vulnscan-helpbox-description">Межсайтовый скриптинг (XSS) уязвимость возникает тогда, когда данные, принятые от пользователя, выводятся в браузер без надлежащей фильтрации. Уязвимость может быть использована для изменения вида HTML страниц уязвимого сайта в контексте браузера целевого пользователя, похищения COOKIE данных браузера целевого пользователя, с последующим внедрением в его сессию, под его учетной записью.</div><div class="checklist-vulnscan-helpbox-safe-title">Как защищаться</div><div class="checklist-vulnscan-helpbox-safe-description">Использовать <b>htmlspecialcharsbx</b>. Параметры тегов с динамическими значениями ограничивать двойными кавычками. Принудительно добавлять протокол (http), где это необходимо, для значений параметров тегов, таких как href или src.</div></div><div class="checklist-vulnscan-code"></div><div class="checklist-vulnscan-dangerous-is-here"><div style="clear:both;"><span>36:</span>&nbsp;<span style="color: #007700;">echo</span>&nbsp;<span style="color: #0000BB;"><b>$_POST</b></span><span style="color: #007700;">[</span><span style="color: #DD0000;">\'email\'</span><span style="color: #007700;">]</span></div></div><div class="checklist-vulnscan-dependecies">Необходимые условия:<div style="clear:both;"><span>35:</span>&nbsp;<span style="color: #007700;">if</span><span style="color: #007700;">(</span><span style="color: #007700;">isset</span><span style="color: #007700;">(</span><span style="color: #0000BB;">$_POST</span><span style="color: #007700;">[</span><span style="color: #DD0000;">\'email\'</span><span style="color: #007700;">]</span><span style="color: #007700;">)</span>&nbsp;<span style="color: #007700;">&&</span>&nbsp;<span style="color: #007700;">!</span><span style="color: #007700;">empty</span><span style="color: #007700;">(</span><span style="color: #0000BB;">$_POST</span><span style="color: #007700;">[</span><span style="color: #DD0000;">\'email\'</span><span style="color: #007700;">]</span><span style="color: #007700;">)</span><span style="color: #007700;">)</span></div></div></div></div></div>";}i:5;a:5:{s:5:"title";s:113:"Разрешено отображение сайта во фрейме с произвольного домена";s:8:"critical";s:6:"MIDDLE";s:6:"detail";s:307:"Запрет отображения фреймов сайта со сторонних доменов способен предотвратить целый класс атак, таких как <a href="https://www.owasp.org/index.php/Clickjacking" target="_blank">Clickjacking</a>, Framesniffing и т.д.";s:14:"recommendation";s:1875:"Скорее всего, вам будет достаточно разрешения на просмотр сайта в фреймах только на страницах текущего сайта.
Сделать это достаточно просто, достаточно добавить заголовок ответа "X-Frame-Options: SAMEORIGIN" в конфигурации вашего frontend-сервера.
</p><p>В случае использования nginx:<br>
1. Найти секцию server, отвечающую за обработку запросов нужного сайта. Зачастую это файлы в /etc/nginx/site-enabled/*.conf<br>
2. Добавить строку:
<pre>
add_header X-Frame-Options SAMEORIGIN;
</pre>
3. Перезапустить nginx<br>
Подробнее об этой директиве можно прочесть в документации к nginx: <a href="http://nginx.org/ru/docs/http/ngx_http_headers_module.html" target="_blank">Модуль ngx_http_headers_module</a>
</p><p>В случае использования Apache:<br>
1. Найти конфигурационный файл для вашего сайта, зачастую это файлы /etc/apache2/httpd.conf, /etc/apache2/vhost.d/*.conf<br>
2. Добавить строки:
<pre>
&lt;IfModule headers_module&gt;
	Header set X-Frame-Options SAMEORIGIN
&lt;/IfModule&gt;
</pre>
3. Перезапустить Apache<br>
4. Убедиться, что он корректно обрабатывается Apache и этот заголовок никто не переопределяет<br>
Подробнее об этой директиве можно прочесть в документации к Apache: <a href="http://httpd.apache.org/docs/2.2/mod/mod_headers.html" target="_blank">Apache Module mod_headers</a>
</p>";s:15:"additional_info";s:2548:"Адрес: <a href="https://www.usatba-texno.ru/" target="_blank">https://www.usatba-texno.ru/</a><br>Запрос/Ответ: <pre>GET / HTTP/1.1
user-agent: BitrixCloud BitrixSecurityScanner/Robin-Scooter
accept: */*
host: www.usatba-texno.ru

HTTP/1.1 200 OK
Server: nginx
Date: Wed, 27 Oct 2021 06:10:31 GMT
Content-Type: text/html; charset=UTF-8
Transfer-Encoding: chunked
Connection: keep-alive
Vary: Accept-Encoding
X-Powered-By: PHP/7.2.34
P3P: policyref=&quot;/bitrix/p3p.xml&quot;, CP=&quot;NON DSP COR CUR ADM DEV PSA PSD OUR UNR BUS UNI COM NAV INT DEM STA&quot;
X-Powered-CMS: Bitrix Site Manager (67b4ad22d30cac4cdbb3d8876c02d138)
Expires: Thu, 19 Nov 1981 08:52:00 GMT
Cache-Control: no-store, no-cache, must-revalidate
Pragma: no-cache
Set-Cookie: PHPSESSID=hbCyJviQkpuVH8Zp7Ld2jxD99vCEkXSJ; path=/; domain=www.usatba-texno.ru; HttpOnly
Set-Cookie: BITRIX_SM_SALE_UID=c5320d65f6261af49f9d1aa3e6bf1946; expires=Sat, 22-Oct-2022 06:10:31 GMT; Max-Age=31104000; path=/; domain=www.usatba-texno.ru

&lt;!DOCTYPE html&gt;
&lt;html lang=&quot;ru&quot;&gt;
&lt;head&gt;
&lt;meta name=&quot;yandex-verification&quot; content=&quot;4747282ce050b29c&quot; /&gt;
&lt;meta name=&quot;viewport&quot; content=&quot;width=device-width, initial-scale=1&quot;&gt;
&lt;meta property=&quot;og:title&quot; content=&quot;Усадьба-Техно&quot;/&gt;
&lt;meta property=&quot;og:description&quot; content=&quot;Интернет магазин садово-паркового оборудования и мототехники&quot;/&gt;
&lt;meta property=&quot;og:url&quot; content=&quot;https://www.usatba-texno.ru/&quot;/&gt;
&lt;meta property=&quot;og:image&quot; content=&quot;https://www.usatba-texno.ru/upload/logo.png&quot; /&gt;
&lt;title&gt;Техника для сада, огорода, леса и активного отдыха&lt;/title&gt;
&lt;meta name=&quot;robots&quot; content=&quot;index, follow&quot; /&gt;
&lt;link href=&quot;/bitrix/js/main/core/css/core.min.css?16146935843575&quot; type=&quot;text/css&quot; rel=&quot;stylesheet&quot; /&gt;



&lt;link href=&quot;/bitrix/css/main/bootstrap.min.css?1536848823121326&quot; type=&quot;text/css&quot;  rel=&quot;stylesheet&quot; /&gt;
&lt;link href=&quot;/bitrix/js/ui/fonts/opensans/ui.font.opensans.min.css?15510853791861&quot; type=&quot;text/css&quot;  rel=&quot;stylesheet&quot; /&gt;
&lt;link href=&quot;/bitrix/js/main/popup/dist/main.popup.bundle.min.css?161469352823520&quot; type=&quot;text/css&quot;  rel=&quot;sty
----------Only 1Kb of body shown----------<pre>";}i:6;a:5:{s:5:"title";s:52:"Защита редиректов выключена";s:8:"critical";s:6:"MIDDLE";s:6:"detail";s:309:"Редирект на произвольный сторонний ресурс может служить подспорьем для множества атак, защита редиректов исключает эту возможность (при использовании стандартного API)";s:14:"recommendation";s:151:"Включить защиту редиректов: <a href="/bitrix/admin/security_redirect.php" target="_blank">Защита редиректов</a>";s:15:"additional_info";s:0:"";}i:7;a:5:{s:5:"title";s:68:"Разрешено чтение файлов по URL (URL wrappers)";s:8:"critical";s:6:"MIDDLE";s:6:"detail";s:256:"Если эта, сомнительная, возможность PHP не требуется - рекомендуется отключить, т.к. она может стать отправной точкой для различного типа атак";s:14:"recommendation";s:89:"Необходимо в настройках php указать:<br>allow_url_fopen = Off";s:15:"additional_info";s:0:"";}i:8;a:5:{s:5:"title";s:110:"Установлен не корректный порядок формирования массива _REQUEST";s:8:"critical";s:6:"MIDDLE";s:6:"detail";s:392:"Зачастую в массив _REQUEST нет необходимости добавлять любые переменные, кроме массивов _GET и _POST. В противном случае это может привести к раскрытию информации о пользователе/сайте и иным не предсказуемым последствиям.";s:14:"recommendation";s:88:"Необходимо в настройках php указать:<br>request_order = "GP"";s:15:"additional_info";s:75:"Текущее значение: ""<br>Рекомендованное: "GP"";}i:9;a:5:{s:5:"title";s:119:"Временные файлы хранятся в пределах корневой директории проекта";s:8:"critical";s:6:"MIDDLE";s:6:"detail";s:271:"Хранение временных файлов, создаваемых при использовании CTempFile, в пределах корневой директории проекта не рекомендовано и несет с собой ряд рисков.";s:14:"recommendation";s:883:"Необходимо определить константу "BX_TEMPORARY_FILES_DIRECTORY" в "bitrix/php_interface/dbconn.php" с указанием необходимого пути.<br>
Выполните следующие шаги:<br>
1. Выберите директорию вне корня проекта. Например, это может быть "/home/bitrix/tmp/www"<br>
2. Создайте ее. Для этого выполните следующую комманду:
<pre>
mkdir -p -m 700 /полный/путь/к/директории
</pre>
3. В файле "bitrix/php_interface/dbconn.php" определите соответствующую константу, чтобы система начала использовать эту директорию:
<pre>
define("BX_TEMPORARY_FILES_DIRECTORY", "/полный/путь/к/директории");
</pre>";s:15:"additional_info";s:90:"Текущая директория: /var/www/u0128361/data/www/usatba-texno.ru/upload/tmp";}i:10;a:5:{s:5:"title";s:44:"Включен Automatic MIME Type Detection";s:8:"critical";s:3:"LOW";s:6:"detail";s:248:"По умолчанию в Internet Explorer/FlashPlayer включен автоматический mime-сниффинг, что может служить источником XSS нападения или раскрытия информации.";s:14:"recommendation";s:1752:"Скорее всего, вам не нужна эта функция, поэтому её можно безболезненно отключить, добавив заголовок ответа "X-Content-Type-Options: nosniff" в конфигурации вашего веб-сервера.
</p><p>В случае использования nginx:<br>
1. Найти секцию server, отвечающую за обработку запросов нужного сайта. Зачастую это файлы в /etc/nginx/site-enabled/*.conf<br>
2. Добавить строку:
<pre>
add_header X-Content-Type-Options nosniff;
</pre>
3. Перезапустить nginx<br>
Подробнее об этой директиве можно прочесть в документации к nginx: <a href="http://nginx.org/ru/docs/http/ngx_http_headers_module.html" target="_blank">Модуль ngx_http_headers_module</a>
</p><p>В случае использования Apache:<br>
1. Найти конфигурационный файл для вашего сайта, зачастую это файлы /etc/apache2/httpd.conf, /etc/apache2/vhost.d/*.conf<br>
2. Добавить строки:
<pre>
&lt;IfModule headers_module&gt;
	Header set X-Content-Type-Options nosniff
&lt;/IfModule&gt;
</pre>
3. Перезапустить Apache<br>
4. Убедиться, что он корректно обрабатывается Apache и этот заголовок никто не переопределяет<br>
Подробнее об этой директиве можно прочесть в документации к Apache: <a href="http://httpd.apache.org/docs/2.2/mod/mod_headers.html" target="_blank">Apache Module mod_headers</a>
</p>";s:15:"additional_info";s:1925:"Адрес: <a href="https://www.usatba-texno.ru/bitrix/js/main/core/core.js?rnd=0.6323045115166229" target="_blank">https://www.usatba-texno.ru/bitrix/js/main/core/core.js?rnd=0.6323045115166229</a><br>Запрос/Ответ: <pre>GET /bitrix/js/main/core/core.js?rnd=0.6323045115166229 HTTP/1.1
user-agent: BitrixCloud BitrixSecurityScanner/Robin-Scooter
accept: */*
host: www.usatba-texno.ru

HTTP/1.1 200 OK
Server: nginx
Date: Wed, 27 Oct 2021 06:10:40 GMT
Content-Type: application/javascript
Content-Length: 563115
Last-Modified: Tue, 02 Mar 2021 13:59:46 GMT
Connection: keep-alive
Vary: Accept-Encoding
ETag: &quot;603e44d2-897ab&quot;
Expires: Wed, 03 Nov 2021 06:10:40 GMT
Cache-Control: max-age=604800
Accept-Ranges: bytes

;(function() {

	if (typeof window.BX === \'function\')
	{
		return;
	}

/**
 * Babel external helpers
 * (c) 2018 Babel
 * @license MIT
 */
(function (global) {
  var babelHelpers = global.babelHelpers = {};

  function _typeof(obj) {
    if (typeof Symbol === &quot;function&quot; &amp;&amp; typeof Symbol.iterator === &quot;symbol&quot;) {
      babelHelpers.typeof = _typeof = function (obj) {
        return typeof obj;
      };
    } else {
      babelHelpers.typeof = _typeof = function (obj) {
        return obj &amp;&amp; typeof Symbol === &quot;function&quot; &amp;&amp; obj.constructor === Symbol &amp;&amp; obj !== Symbol.prototype ? &quot;symbol&quot; : typeof obj;
      };
    }

    return _typeof(obj);
  }

  babelHelpers.typeof = _typeof;
  var REACT_ELEMENT_TYPE;

  function _createRawReactElement(type, props, key, children) {
    if (!REACT_ELEMENT_TYPE) {
      REACT_ELEMENT_TYPE = typeof Symbol === &quot;function&quot; &amp;&amp; Symbol.for &amp;&amp; Symbol.for(&quot;react.element&quot;) || 0xeac7;
    }

    var defaultProps = type &amp;&amp; type.defaultProps;
    var childrenLength = arguments.length - 3;


----------Only 1Kb of body shown----------<pre>";}}s:9:"test_date";s:10:"27.10.2021";}}';
return true;
?>