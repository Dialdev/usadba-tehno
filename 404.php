<?
include_once($_SERVER['DOCUMENT_ROOT'].'/bitrix/modules/main/include/urlrewrite.php');

CHTTP::SetStatus("404 Not Found");
@define("ERROR_404","Y");

require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");

$APPLICATION->SetTitle("404 Not Found");
?>

<h2 class="h2">Ошибка. Страница не найдена</h2>
<div class="sitemap-page">
<img alt="" src="/local/templates/index/images/404.png">
<p>К сожалению, запрашиваемая Вами страница не найдена на сайте нашей компании.</p>

<p>Мы просим прощение за доставленные неудобства, чтобы найти интересующие Вас материалы предлагаем следующие пути:</p>

<p>- перейти на <a href="/">главную страницу</a> сайта</p>

<p>- воспользоваться <a href="/search/map/">картой сайта</a></p>
</div>
<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>