<?if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();

//Обнолвение малой корзины - начало
use Bitrix\Main\Context;

$request = Context::getCurrent()->getRequest();

if ($request->get('AJAX_PAGE') && $request->isAjaxRequest()) {

    $content = ob_get_contents();
    ob_end_clean();

    $APPLICATION->RestartBuffer();

    list(, $content_html) = explode('<!--RestartBuffer-->', $content);

    echo $content_html;

    die();
}
//Обнолвение малой корзины - окончание


if (!$arParams['BUY_URL_SIGN'] && $arParams['BUY_URL_SIGN'] !== false)
	$arParams['BUY_URL_SIGN'] = 'action=ADD2BASKET';

if (
	$_REQUEST['ajax_buy']
	&& $arParams['BUY_URL_SIGN'] 
	&& (false !== strpos($_SERVER['REQUEST_URI'], $arParams['BUY_URL_SIGN']))
)
{
	$arNewParams = array();
	foreach ($arParams as $key => $value)
	{
		if (substr($key, 0, 1) == '~' && $key != '~BUY_URL_SIGN')
		{
			$arNewParams[substr($key, 1)] = $value;
		}
	}
	
	$arNewParams['BUY_URL_SIGN'] = false;
    $arNewParams["JSON_RESPONSE"]=true;
	$GLOBALS['BASKET_RESPONSE_AJAX_PARAMS'] = $arNewParams;

    if (!function_exists("BasketLineAjaxResponse")) {
        function BasketLineAjaxResponse() {
            global $APPLICATION;
            $APPLICATION->RestartBuffer();
            $APPLICATION->IncludeComponent("bitrix:sale.basket.basket.line", "products", $GLOBALS['BASKET_RESPONSE_AJAX_PARAMS'], false, array('HIDE_ICONS' => 'Y'));
            die();
        }
    }
	AddEventHandler('main', 'OnBeforeLocalRedirect', 'BasketLineAjaxResponse');
}


?>
