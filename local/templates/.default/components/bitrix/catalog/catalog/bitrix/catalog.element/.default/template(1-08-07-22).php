<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
/** @var array $arParams */
/** @var array $arResult */
/** @global CMain $APPLICATION */
/** @global CUser $USER */
/** @global CDatabase $DB */
/** @var CBitrixComponentTemplate $this */
/** @var string $templateName */
/** @var string $templateFile */
/** @var string $templateFolder */
/** @var string $componentPath */
/** @var CBitrixComponent $component */
$this->setFrameMode(true);
// echo "<pre>";
// print_r($arResult);
// echo '</pre>';
$canonical = 'https://www.usatba-texno.ru'.$arResult['SECTION']['PATH'][0]['SECTION_PAGE_URL'].''.$arResult['CODE'].'/';
$APPLICATION->SetPageProperty('canonical',$canonical);

$mainId = $this->GetEditAreaId($arResult['ID']);
$itemIds = array(
	'ID' => $mainId,
	'SUBSCRIBE_LINK' => $mainId.'_subscribe',
);
$showSubscribe = $arParams['PRODUCT_SUBSCRIPTION'] === 'Y' && ($arResult['CATALOG_SUBSCRIBE'] === 'Y' || $haveOffers);
?>

<h1 class="h2"><?=$arResult["NAME"]?></h1>


<div class="leftbar">
	<div class="menu-catalog">
		<?$APPLICATION->IncludeComponent("bitrix:menu", "menu_catalog", array(
	          "ROOT_MENU_TYPE" => "left",
	          "MENU_CACHE_TYPE" => "Y",
	          "MENU_CACHE_TIME" => "36000000",
	          "MENU_CACHE_USE_GROUPS" => "Y",
	          "MENU_CACHE_GET_VARS" => array(
	          ),
	          "MAX_LEVEL" => "3",
	          "CHILD_MENU_TYPE" => "left",
	          "USE_EXT" => "Y",
	          "DELAY" => "N",
	          "ALLOW_MULTI_SELECT" => "N"
	          ),
	          false
	        );?>
	</div>
</div>

<div class="rightbar">
<div class="catalog-detail product" data-id="<?=$arResult["ID"]?>" data-price="<?=$arResult["PRICES"]["BASE"]["VALUE"]?>">
	<div class="product-images">
	<div class="product-images__main">
			<?if($arResult["DETAIL_PICTURE"]["SRC"]!=""){?>
				<a class="lb zooming" href="<?=$arResult["DETAIL_PICTURE"]["SRC"]?>" >
					<img src="<?=$arResult["DETAIL_PICTURE"]["SRC"]?>" alt="<?=$arResult["NAME"]?>" title="<?=$arResult["DETAIL_PICTURE"]["TITLE"]?>" class="product-images__image">
				</a>
			<?} else {?>
				<a class="lb" href="/local/templates/index/images/no_photo.png" class="fancybox">
					<img src="/local/templates/index/images/no_photo.png" alt="<?=$arResult["NAME"]?>" title="<?=$arResult["DETAIL_PICTURE"]["TITLE"]?>" class="product-images__image">
				</a>
			<?}?>
		</a>
	</div>
	<ul class="product-images__list">
		<li class="product-images__item product-images__item_active" data-src="<?=$arResult["DETAIL_PICTURE"]["SRC"]?>">
			<?if($arResult["DETAIL_PICTURE"]["SRC"]!=""){$p=CFile::ResizeImageGet($arResult["DETAIL_PICTURE"], array("width" => 500, "height" => 500), BX_RESIZE_IMAGE_PROPORTIONAL_ALT);?>
				<img src="<?=$p["src"]?>" alt="<?=$arResult["NAME"]?>">
			<?} else {?>
				<img src="/local/templates/index/images/no_photo.png" alt="<?=$arResult["NAME"]?>" title="<?=$arResult["DETAIL_PICTURE"]["TITLE"]?>">
			<?}?>
		</li>
		<?foreach ($arResult["MORE_PHOTO"] as $image):?>
		<?$pp = CFile::ResizeImageGet($image, array("width" => 500, "height" => 500), BX_RESIZE_IMAGE_PROPORTIONAL_ALT);?>
		<li class="product-images__item" data-src="<?=$pp["src"]?>">
			<img src="<?=$pp["src"]?>" alt="<?=$arResult["NAME"]?>">
		</li>
		<?endforeach;?>
	</ul>
	<div class="share">
<script src="//yastatic.net/es5-shims/0.0.2/es5-shims.min.js"></script>
<script src="//yastatic.net/share2/share.js"></script>
<div class="ya-share2" data-services="vkontakte,facebook,odnoklassniki,twitter,telegram" data-counter=""></div>
	<!-- uSocial -->
	<!--script async src="https://usocial.pro/usocial/usocial.js?v=6.1.4" data-script="usocial" charset="utf-8"></script>
	<div class="uSocial-Share" data-pid="3a4e4114b83a47ed93a46c479f0d5b0c" data-type="share" data-options="rect,style2,default,absolute,horizontal,size48,eachCounter1,counter0" data-social="fb,vk,twi,ok,telegram" data-mobile="vi,wa,sms"></div-->
	<!-- /uSocial -->
	</div>
</div>
	<div class="info">
	<?if($arResult["CATALOG_QUANTITY"]>0):?>
		<?if ( $arResult["PRICES"]["base"]["DISCOUNT_DIFF"] > 0 ) {?>
			<div class="price">
				Цена: <b><?=number_format($arResult["PRICES"]["base"]["DISCOUNT_VALUE"], 0, ',', ' ');?></b> руб. за шт.<br>
				Старая цена: <span class="oldprice"><?=number_format($arResult["PRICES"]["base"]["VALUE"], 0, ',', ' ');?> руб. за шт.</span>
				
			</div>
		
		<?}else {?>
			<div class="price">
				Цена: <b><?=number_format($arResult["PRICES"]["base"]["VALUE"], 0, ',', ' ');?></b> руб. за шт.
			</div>
		<?}?>
	<?endif;?>

			<?if($arResult["CATALOG_QUANTITY"]>0) {?>
				<span class="quantity-yes">Есть в наличии</span>
			<?} else {?>
				<span class="quantity-no">Нет в наличии</span>
			<?}?>


			


		<?/*<table>
			<?foreach ($arResult["PROPERTIES"] as $key => $arProps){
				//echo "<pre>";
				//print_r($arProps);
			?>
				<?if($arProps["ID"]!="53" && $arProps["ID"]!="54" && $arProps["ID"]!="55"){?>
					<?if($arProps["VALUE"]!="") {?>
						<tr>
							<td><?=$arProps["NAME"]?></td>
							<td><?=$arProps["VALUE"]?></td>
						</tr>
					<?}?>
				<?}?>
			<?}?>
		</table>*/?>
		<div class="icon">
			<?if($arResult["PROPERTIES"]["GUARANTEE"]["VALUE"]!="") {?>
				<span class="catalog-detail-icon-span icon-1">Гарантия от производителя</span>
			<?}?>
			<?if($arResult["PROPERTIES"]["DELIVERY"]["VALUE"]!="") {?>
				<span class="catalog-detail-icon-span icon-2">Бесплатная доставка</span>
			<?}?>
		</div>

		<?if($arResult["CATALOG_QUANTITY"]>0) {?>

				<div class="product__count">
					<div class="product__control _minus">-</div>
					<input value="1" type="text" class="product__input product-quantity__input">
					<div class="product__control _plus">+</div>
				</div>

				<a class="btn-buy product__button_buy">Добавить в корзину</a>

				<?$APPLICATION->IncludeComponent("dial:fastorder", "", array("ITEM" => $arResult))?>

				<a href="#pokupkredit" target="_blank" id="pos-credit-link">Покупки в кредит</a>
				
				<a class="btn-delivery">Условия доставки</a>
				

			<?} else {?>
				<a class="btn-buy product__button_buy">Предзаказ<b>, цену уточняйте</b></a>
			<?}?>
			

			<?if($arResult["CATALOG_QUANTITY"]>0) {?>
			<div class="subscribe">
				
			</div>
			<?}else {?>
			<div class="subscribe">
				<?
				if ($showSubscribe)
				{
					?>
							<div class="product-item-detail-info-container">
								<?
								$APPLICATION->IncludeComponent(
									'bitrix:catalog.product.subscribe',
									'',
									array(
										'CUSTOM_SITE_ID' => 's1',
										'PRODUCT_ID' => $arResult['ID'],
										'BUTTON_ID' => $itemIds['SUBSCRIBE_LINK'],
										'BUTTON_CLASS' => 'btn btn-default product-item-detail-buy-button ',
										'DEFAULT_DISPLAY' => !$actualItem['CAN_BUY'],
										'MESS_BTN_SUBSCRIBE' => $arParams['~MESS_BTN_SUBSCRIBE'],
									)
									
								);
								?>
							</div>
						<?
					}
				?>
			</div>
		<?}?>
		<? /*<a class="back_to_section" href="<?=$arResult['SECTION']['PATH'][0]['SECTION_PAGE_URL']?>">Вернуться в раздел</a>*/?>
<a class="back_to_section" href="#" onclick="history.back();return false;">Вернуться назад</a>
        <div class="info__documents">
		    <?if($arResult['PROPERTIES']['PDF_FILES']['VALUE']){?>
			    <a href="<?=CFile::GetPath($arResult['PROPERTIES']['PDF_FILES']['VALUE'])?>" class="info__instruction" target="_blank">Инструкция</a>
		    <?}?>
		    <?if($arResult['PROPERTIES']['PDF_FILES2']['VALUE']){?>
			    <a href="<?=CFile::GetPath($arResult['PROPERTIES']['PDF_FILES2']['VALUE'])?>" class="info__instruction" target="_blank">Деталировка</a>
		    <?}?>
        </div>
	</div>

	<div class="item_btns">
		<div class="tab_btn active">
			Характеристика
		</div>
		<div class="tab_btn ">
			Описание
		</div>
		<div class="tab_btn">
			Отзывы
		</div>
	</div>

	<div class="item_tabs">
		<div class="bx_rb tab" style="display: block;">
			<div class="props">
				<table>
					<?foreach ($arResult["PROPERTIES"] as $key => $arProps) {
							//cho "<pre>";
							//print_r($arProps);
						?>
						<?if ($arProps["ID"]!="51" && $arProps["ID"]!="50" && $arProps["ID"]!="52" && $arProps["ID"]!="53" && $arProps["ID"]!="54" && $arProps["ID"]!="56" && $arProps["ID"]!="57" && $arProps["ID"]!="65" && $arProps["ID"]!="66" && $arProps["ID"]!="67"  && $arProps["ID"]!="133" && $arProps["ID"]!="134" && $arProps["ID"]!="144" && $arProps["ID"]!="143" && $arProps["ID"]!="137" && $arProps["ID"]!="248") {
							if($arProps["VALUE"]!="") {?>
								<tr>
									<td><?=$arProps["NAME"]?></td>
									<td><?=$arProps["VALUE"]?></td>
								</tr>
							<?}
						}
					}?>
				</table>
				<?/*
				<div class="props-pdf">
					<a class="props-pdf__item" href="<?=$arResult["PROPERTIES"]["INSTRUKTSIYA_SPRAVOCHNIK_NOMENKLATURA_OBSHCHIE_"]["VALUE"]?>" target="_blank">Инструкция</a>
					<a class="props-pdf__item" href="<?=$arResult["PROPERTIES"]["DETALIROVKA_SPRAVOCHNIK_NOMENKLATURA_OBSHCHIE_"]["VALUE"]?>" target="_blank">Деталировка</a>
				</div>
				*/?>
			</div>
		</div>
		<div class="bx_rb tab" >
			<div class="detail-text">
				<? echo str_replace("\n","<br>",$arResult["~DETAIL_TEXT"])?>
			</div>
		</div>
		<div class="bx_rb tab">
			<?/*$APPLICATION->IncludeComponent("bitrix:catalog.comments","",
				Array(
				        "IBLOCK_TYPE" => "catalog",
				        "IBLOCK_ID" => "6",
				        "ELEMENT_ID" => $arResult["ID"],

				        "WIDTH" => "500",
				        "COMMENTS_COUNT" => "4",
				        "BLOG_USE" => "Y",
				        "FB_USE" => "N",
				        "VK_USE" => "N",
				        "CACHE_TYPE" => "A",
				        "CACHE_TIME" => "0",
				        "BLOG_TITLE" => "тзывы",
				        "BLOG_URL" => "catalog_comments",
				        "PATH_TO_SMILE" => "/bitrix/images/blog/smile/",
				        "EMAIL_NOTIFY" => "N",
				        "AJAX_POST" => "N",
				        "SHOW_SPAM" => "Y",
				        "SHOW_RATING" => "Y",
				        "RATING_TYPE" => "like_graphic",
				        "FB_TITLE" => "Facebook",
				        "FB_USER_ADMIN_ID" => "",
				        "FB_APP_ID" => "",
				        "FB_COLORSCHEME" => "dark",
				        "FB_ORDER_BY" => "time",
				        "VK_TITLE" => "Вконтакте",
				        "VK_API_ID" => "API_ID"
				    )
				);*/?>
				<?$APPLICATION->IncludeComponent(
					"bitrix:forum.topic.reviews", 
					"site", 
					array(
						"SHOW_LINK_TO_FORUM" => "N",
						"FILES_COUNT" => "0",
						"FORUM_ID" => "1",
						"IBLOCK_TYPE" => "catalog",
						"IBLOCK_ID" => "6",
						"ELEMENT_ID" => $arResult["ID"],
						"AJAX_POST" => "Y",
						"POST_FIRST_MESSAGE" => "Y",
						"POST_FIRST_MESSAGE_TEMPLATE" => "#IMAGE#[url=#LINK#]#TITLE#[/url]#BODY#",
						"URL_TEMPLATES_READ" => "read.php?FID=#FID#&TID=#TID#",
						"URL_TEMPLATES_DETAIL" => "photo_detail.php?ID=#ELEMENT_ID#",
						"URL_TEMPLATES_PROFILE_VIEW" => "profile_view.php?UID=#UID#",
						"MESSAGES_PER_PAGE" => "3",
						"PAGE_NAVIGATION_TEMPLATE" => "round",
						"DATE_TIME_FORMAT" => "d.m.Y",
						"PATH_TO_SMILE" => "/bitrix/images/forum/smile/",
						"EDITOR_CODE_DEFAULT" => "N",
						"SHOW_AVATAR" => "N",
						"SHOW_RATING" => "N",
						"RATING_TYPE" => "like",
						"SHOW_MINIMIZED" => "N",
						"USE_CAPTCHA" => "N",
						"PREORDER" => "Y",
						"CACHE_TYPE" => "A",
						"CACHE_TIME" => "0",
						"COMPONENT_TEMPLATE" => "site",
						"NAME_TEMPLATE" => ""
					),
					false
				);?>
		</div>
</div>
<?
	global $arrFilter;
	$arrFilter = array(
		"IBLOCK_ID" => "6",
		"ID" => $arResult["PROPERTIES"]["RELATED_PRODUCTS"]["VALUE"]

	);
?>
<?
	/***************************************** RELATED PRODUCTS FROM SECTION *****************************************************************************/
	$ar_similar = array();
	$db_list = CIBlockSection::GetList(Array(SORT=>"ASC"), $arFilter = Array("IBLOCK_ID"=>$arParams["IBLOCK_ID"], "ID"=>$arResult["IBLOCK_SECTION_ID"]), true, $arSelect=Array("IBLOCK_SECTION_ID","UF_RECOMMENDED")); 
	while($ar_result = $db_list->GetNext())
	{ 
		foreach ($ar_result["UF_RECOMMENDED"] as $sim) $ar_similar[] = $sim;
	}	
	
	global $arrSimilar;
	$arrSimilar = array("=ID" => $ar_similar);
	if (!empty($ar_similar))
	{
?>
<div class="similar">
	<p class="h2__p">Сопутствующие товары</p>
	<?$APPLICATION->IncludeComponent(
	"bitrix:catalog.section", 
	"similar", 
	array(
		"IBLOCK_TYPE" => "catalog",
		"IBLOCK_ID" => $arParams["IBLOCK_ID"],
		"SECTION_ID" => "",
		"ELEMENT_SORT_FIELD" => "name",
		"ELEMENT_SORT_ORDER" => "asc",
		"SHOW_ALL_WO_SECTION" => "Y",
		"PROPERTY_CODE" => array(
			0 => "",
			1 => "",
		),
		"SET_TITLE" => "N",
		"SET_BROWSER_TITLE" => "N",
		"BROWSER_TITLE" => "N",
		"SET_META_KEYWORDS" => "N",
		"META_KEYWORDS" => "N",
		"SET_META_DESCRIPTION" => "N",
		"META_DESCRIPTION" => "N",
		"ADD_SECTIONS_CHAIN" => "N",
		"SET_STATUS_404" => "N",
		"COMPONENT_TEMPLATE" => "",
		"SECTION_CODE" => "",
		"SECTION_USER_FIELDS" => array(
			0 => "",
			1 => "",
		),
		"ELEMENT_SORT_FIELD2" => "id",
		"ELEMENT_SORT_ORDER2" => "desc",
		"FILTER_NAME" => "arrSimilar",
		"INCLUDE_SUBSECTIONS" => "Y",
		"HIDE_NOT_AVAILABLE" => "N",
		"PAGE_ELEMENT_COUNT" => "0",
		"LINE_ELEMENT_COUNT" => "0",
		"OFFERS_LIMIT" => "5",
		"BACKGROUND_IMAGE" => "-",
		"SECTION_URL" => "",
		"DETAIL_URL" => "",
		"SECTION_ID_VARIABLE" => "",
		"SEF_MODE" => "N",
		"AJAX_MODE" => "N",
		"AJAX_OPTION_JUMP" => "N",
		"AJAX_OPTION_STYLE" => "Y",
		"AJAX_OPTION_HISTORY" => "N",
		"AJAX_OPTION_ADDITIONAL" => "undefined",
		"CACHE_TYPE" => "A",
		"CACHE_TIME" => "36000000",
		"CACHE_GROUPS" => "Y",
		"SET_LAST_MODIFIED" => "N",
		"USE_MAIN_ELEMENT_SECTION" => "N",
		"CACHE_FILTER" => "N",
		"ACTION_VARIABLE" => "action",
		"PRODUCT_ID_VARIABLE" => "id",
		"PRICE_CODE" => $arParams["PRICE_CODE"],
		"USE_PRICE_COUNT" => "N",
		"SHOW_PRICE_COUNT" => "1",
		"PRICE_VAT_INCLUDE" => "Y",
		"CONVERT_CURRENCY" => "N",
		"BASKET_URL" => "/personal/basket.php",
		"USE_PRODUCT_QUANTITY" => "N",
		"PRODUCT_QUANTITY_VARIABLE" => "undefined",
		"ADD_PROPERTIES_TO_BASKET" => "Y",
		"PRODUCT_PROPS_VARIABLE" => "prop",
		"PARTIAL_PRODUCT_PROPERTIES" => "N",
		"PRODUCT_PROPERTIES" => array(
		),
		"PAGER_TEMPLATE" => ".default",
		"DISPLAY_TOP_PAGER" => "N",
		"DISPLAY_BOTTOM_PAGER" => "Y",
		"PAGER_TITLE" => "Товары",
		"PAGER_SHOW_ALWAYS" => "N",
		"PAGER_DESC_NUMBERING" => "N",
		"PAGER_DESC_NUMBERING_CACHE_TIME" => "36000",
		"PAGER_SHOW_ALL" => "N",
		"PAGER_BASE_LINK_ENABLE" => "N",
		"SHOW_404" => "N",
		"MESSAGE_404" => "",
		"DISABLE_INIT_JS_IN_COMPONENT" => "N"
	),
	false
);?>
</div>
	<?}
	/***************************************** /RELATED PRODUCTS FROM SECTION *****************************************************************************/
	else 
	{
		if($arResult["PROPERTIES"]["RELATED_PRODUCTS"]["VALUE"]){?>
<div class="similar">
	<p class="h2__p">Сопутствующие товары</p>
	<?$APPLICATION->IncludeComponent(
	"bitrix:catalog.section", 
	"similar", 
	array(
		"IBLOCK_TYPE" => "catalog",
		"IBLOCK_ID" => "6",
		"SECTION_ID" => "",
		"ELEMENT_SORT_FIELD" => "name",
		"ELEMENT_SORT_ORDER" => "asc",
		"SHOW_ALL_WO_SECTION" => "Y",
		"PROPERTY_CODE" => array(
			0 => "",
			1 => "",
		),
		"SET_TITLE" => "N",
		"SET_BROWSER_TITLE" => "N",
		"BROWSER_TITLE" => "N",
		"SET_META_KEYWORDS" => "N",
		"META_KEYWORDS" => "N",
		"SET_META_DESCRIPTION" => "N",
		"META_DESCRIPTION" => "N",
		"ADD_SECTIONS_CHAIN" => "N",
		"SET_STATUS_404" => "N",
		"COMPONENT_TEMPLATE" => "similar",
		"SECTION_CODE" => "",
		"SECTION_USER_FIELDS" => array(
			0 => "",
			1 => "",
		),
		"ELEMENT_SORT_FIELD2" => "id",
		"ELEMENT_SORT_ORDER2" => "desc",
		"FILTER_NAME" => "arrFilter",
		"INCLUDE_SUBSECTIONS" => "Y",
		"HIDE_NOT_AVAILABLE" => "N",
		"PAGE_ELEMENT_COUNT" => "0",
		"LINE_ELEMENT_COUNT" => "0",
		"OFFERS_LIMIT" => "5",
		"BACKGROUND_IMAGE" => "-",
		"SECTION_URL" => "",
		"DETAIL_URL" => "",
		"SECTION_ID_VARIABLE" => "SECTION_ID",
		"SEF_MODE" => "N",
		"AJAX_MODE" => "N",
		"AJAX_OPTION_JUMP" => "N",
		"AJAX_OPTION_STYLE" => "Y",
		"AJAX_OPTION_HISTORY" => "N",
		"AJAX_OPTION_ADDITIONAL" => "undefined",
		"CACHE_TYPE" => "A",
		"CACHE_TIME" => "36000000",
		"CACHE_GROUPS" => "Y",
		"SET_LAST_MODIFIED" => "N",
		"USE_MAIN_ELEMENT_SECTION" => "N",
		"CACHE_FILTER" => "N",
		"ACTION_VARIABLE" => "action",
		"PRODUCT_ID_VARIABLE" => "id",
		"PRICE_CODE" => $arParams["PRICE_CODE"],
		"USE_PRICE_COUNT" => "N",
		"SHOW_PRICE_COUNT" => "1",
		"PRICE_VAT_INCLUDE" => "Y",
		"CONVERT_CURRENCY" => "N",
		"BASKET_URL" => "/personal/basket.php",
		"USE_PRODUCT_QUANTITY" => "N",
		"PRODUCT_QUANTITY_VARIABLE" => "undefined",
		"ADD_PROPERTIES_TO_BASKET" => "Y",
		"PRODUCT_PROPS_VARIABLE" => "prop",
		"PARTIAL_PRODUCT_PROPERTIES" => "N",
		"PRODUCT_PROPERTIES" => array(
		),
		"PAGER_TEMPLATE" => ".default",
		"DISPLAY_TOP_PAGER" => "N",
		"DISPLAY_BOTTOM_PAGER" => "Y",
		"PAGER_TITLE" => "Товары",
		"PAGER_SHOW_ALWAYS" => "N",
		"PAGER_DESC_NUMBERING" => "N",
		"PAGER_DESC_NUMBERING_CACHE_TIME" => "36000",
		"PAGER_SHOW_ALL" => "N",
		"PAGER_BASE_LINK_ENABLE" => "N",
		"SHOW_404" => "N",
		"MESSAGE_404" => "",
		"DISABLE_INIT_JS_IN_COMPONENT" => "N"
	),
	false
);?>
</div>
<?}
}?>
	
<div class="clear"></div>
	<!-- recommend -->
	 <?$arPropertyRecommend = $arResult["DISPLAY_PROPERTIES"]["RECOMMEND"];?>
	<?if(count($arPropertyRecommend["DISPLAY_VALUE"]) > 0):?>
	  <h2 class="h2"><?=$arPropertyRecommend["NAME"]?>:</h2>
	    <div class="recommend">
	    <?
	    global $arRecPrFilter;
	    $arRecPrFilter["ID"] = $arPropertyRecommend["VALUE"];
	    $APPLICATION->IncludeComponent("bitrix:eshop.catalog.top", "site", array(
	        "IBLOCK_TYPE" => "",
	        "IBLOCK_ID" => $arParams["IBLOCK_ID"],
	        "ELEMENT_SORT_FIELD" => "sort",
	        "ELEMENT_SORT_ORDER" => "desc",
	        "ELEMENT_COUNT" => 3,
	        //"LINE_ELEMENT_COUNT" => $arParams["LINE_ELEMENT_COUNT"],
	        "BASKET_URL" => $arParams["BASKET_URL"],
	        "ACTION_VARIABLE" => $arParams["ACTION_VARIABLE"],
	        "PRODUCT_ID_VARIABLE" => $arParams["PRODUCT_ID_VARIABLE"],
	        "CACHE_TYPE" => $arParams["CACHE_TYPE"],
	        "CACHE_TIME" => $arParams["CACHE_TIME"],
	        "DISPLAY_COMPARE" => "N",
	        "PRICE_CODE" => $arParams["PRICE_CODE"],
	        "USE_PRICE_COUNT" => $arParams["USE_PRICE_COUNT"],
	        "SHOW_PRICE_COUNT" => $arParams["SHOW_PRICE_COUNT"],
	        "PRICE_VAT_INCLUDE" => $arParams["PRICE_VAT_INCLUDE"],
	        "FILTER_NAME" => "arRecPrFilter",
	        "DISPLAY_IMG_WIDTH"  => $arParams["DISPLAY_IMG_WIDTH"],
	        "DISPLAY_IMG_HEIGHT" => $arParams["DISPLAY_IMG_HEIGHT"],
	        "SHARPEN" => $arParams["SHARPEN"],        
	        "CONVERT_CURRENCY" => $arParams['CONVERT_CURRENCY'],
	        "CURRENCY_ID" => $arParams['CURRENCY_ID'],
	      ),
	      false,
	      Array('HIDE_ICONS' => 'Y')
	    );
	    ?>
	   </div>
	<?endif;?>
</div>


<!-- ****************** -->
<script>
	/*
  	var options = {
      ttCode: '0117001004364', 
      ttName: 'Г ТУЛА, УЛ ДЕМИДОВСКАЯ ПЛОТИНА, Д. 13',
      //fullName: 'Иванов Иван Иванович',
      //phone: '9251112233',
		//manualOrderInput: true,
      returnUrl: 'https://www.usatba-texno.ru/',
      order: [
         {
            category: '248',
            model: '<?=$arResult["NAME"]?>', 
            //mark: 'Tefal',
            //quantity: 1, 
            price: <?=$arResult["PRICES"]["base"]["DISCOUNT_VALUE"]?>,
         }
      ]
};;
$('#pos-credit-link').attr('href', 'https://my.pochtabank.ru/pos-credit?' + $.param(options));
*/
</script>
<!-- ****************** -->







<!-- ****************** нач новое 3.0 **************** -->
<a name="pokupkredit"></a>
<br><br><br><br>
<h2>Оформить кредит в ПочтаБанке</h2>

<!-- Забирать код НАЧАЛО --> 


<!--

<link href="https://onlypb.pochtabank.ru/PBstyles.css" rel=stylesheet type="text/css">
<script src="https://code.jquery.com/jquery-3.5.1.min.js" integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0=" crossorigin="anonymous"></script>


<script type="text/javascript" src="https://cdn.jsdelivr.net/npm/emailjs-com@3/dist/email.min.js"></script> 
<script type="text/javascript">
(function() {
emailjs.init("user_1PBEJkILIOeNZOELgKnrJ");
})();
</script>

<div class="PBnkBox">
<div class="PBnkHead"><div class="PBnkLogo"></div>
<div class="PBnkTitle">Дионис <br>Заявка в банк</div>
<div style="clear:both;"></div></div>

<div class="PBnkForm"><div class="PBnkLine">Укажите</div>
<input type="number" class="PBnkInput" required id="chekPrice" placeholder="Стоимость товара" title="От 3 до 300 тысяч рублей" value="<?=$arResult["PRICES"]["base"]["DISCOUNT_VALUE"]?>" />
<div style="clear:both;"></div></div>

<div class="PBnkForm"><div class="PBnkLine">Срок</div>
<select id="termCredit" class="PBnkSelect">
<option value="6">Кредит 6 месяцев</option>
<option value="12">Кредит 12 месяцев</option>
<option value="18">Кредит 18 месяцев</option>
<option value="24" selected>Кредит 24 месяца</option>
<option value="36">Кредит 36 месяцев</option></select>
<div style="clear:both;"></div></div>

<div class="PBnkForm"><div class="PBnkLine">Укажите</div>
<input type="number" class="PBnkInput" required id="firstPayment" placeholder="Первоначальный взнос" title="До 40% от стоимости товара"/>
<div style="clear:both;"></div></div>

<button class="PBnkButton" onClick="credit_form()">Перейти к оформлению заявки</button>
</div>

<div id="pos-credit-container"></div>
<script src="https://my.pochtabank.ru/sdk/v2/pos-credit.js"></script>

-->

<script>
/*
function uuidv4() {
  return 'xxxxxxxx-xxxx-4xxx-yxxx-xxxxxxxxxxxx'.replace(/[xy]/g, function(c) {
    var r = Math.random() * 16 | 0, v = c == 'x' ? r : (r & 0x3 | 0x8);
    return v.toString(16);
  });
}
 
function credit_form() {
var chekPrice = $('#chekPrice').val();
var termCredit = $('#termCredit').val();
var firstPayment = $('#firstPayment').val();

var ttName = "Дионис"; 
var email = "usatba-texno@mail.ru";
var operId = uuidv4();
var srok = termCredit;
var chekprice2 = chekPrice - firstPayment;

var amountCredit = chekPrice - firstPayment;
var firstPaymentMax = chekPrice * 0.4;

if( amountCredit > 300000 || amountCredit < 3000 || amountCredit == '') {
alert("Сумма кредита должна быть не менее 3'000 и не более 300'000 рублей");
return false;
}

if( firstPayment > firstPaymentMax ) {
alert("Первый взнос должен быть не более 40% от суммы заявки");
return false;
}


var options = {
operId: operId,
productCode: 'EXP_MP_PP_23,9', // код тарифа
ttCode: '0117001008892', // код ТТ
toCode: '011700100889', // код ТО
ttName: '', // адрес пункта выдачи товара
amountCredit: '',
termCredit: termCredit,  
firstPayment: Number.parseInt(firstPayment),
extAppId: '',  
brokerAgentId: 'NON_BROKER',
returnUrl: ' https://onlypb.pochtabank.ru/razdel/', //ссылка на страницу на которую возвращаемся после заполнения анкеты.
order: [{
category: '245', 
mark: '', // название товара или услуги
model: '<?=$arResult["NAME"]?>',  // название товара или услуги
quantity: 1, // количество
price: Number.parseInt(<?=$arResult["PRICES"]["base"]["DISCOUNT_VALUE"]?>), // Сумма заявки
}]
};


window.PBSDK.posCreditV2.mount('#pos-credit-container', options);
document.getElementById('pos-credit-container').scrollIntoView(); 
window.PBSDK.posCreditV2.on('done', function(id) {
var templateParams = {
    e_site: ttName,
    e_id: id,
    e_summ: Number.parseInt(chekprice2),
    e_srok: srok,
    e_operid: operId,
    e_mail: email,
};
emailjs.send('service_f147e9c', 'template_e13tj4p', templateParams);
});
}
*/
</script>

<!-- Забирать код КОНЕЦ -->


<!-- ****************** конец новое 3.0 **************** -->





<div class="clear"></div>

	<div class="popup popup_delivery">
		<div class="popup__close">×</div>
		<p class="popup__title">Условия доставки</p>
		<div class="popup__textinner">
			<?$APPLICATION->IncludeFile(
				$APPLICATION->GetTemplatePath("/local/includes/delivery_text.php"),
				Array(),
				Array("MODE"=>"html")
			);?>
		</div>
	</div>
</div>
