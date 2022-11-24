<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?><!DOCTYPE html>
<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta property="og:title" content="Усадьба-Техно"/>
<meta property="og:description" content="Интернет магазин садово-паркового оборудования и мототехники"/>
<meta property="og:url" content="https://<?=$_SERVER['HTTP_HOST'].$APPLICATION->GetCurPage(false)?>"/>
<meta property="og:image" content="https://www.usatba-texno.ru/upload/logo.png" />



<title><?$APPLICATION->ShowTitle();?></title>
<? $APPLICATION->ShowMeta("description");?>
<?/*$APPLICATION->ShowHead();*/?>

<? /* nigje dobavleno */?>
<? $APPLICATION->ShowCSS();?>
<? $APPLICATION->ShowHeadStrings();?>
<? $APPLICATION->ShowHeadScripts();?>
<? /* vishe dobavleno */?>

<? $APPLICATION->SetAdditionalCSS("/bitrix/css/main/bootstrap.css");?>
<link rel="stylesheet" type="text/css" href="/local/templates/index/js/jquery-ui.min.css" media="screen"/>
<link href="/local/templates/index/styles.css" rel="stylesheet" type="text/css" >
<link href="/local/templates/index/media.css" rel="stylesheet" type="text/css" >
<?$APPLICATION->AddHeadScript("/local/templates/index/js/jquery-1.11.1.min.js");?>
<?$APPLICATION->AddHeadScript("/local/templates/index/js/jquery-ui.js");?>
<?$APPLICATION->AddHeadScript("/local/templates/index/fancybox//jquery.fancybox.js");?>
<?$APPLICATION->AddHeadScript("/local/templates/index/js/jquery.inputmask.js");?>
<?$APPLICATION->AddHeadScript("/local/templates/index/lightbox/jquery.lightbox-0.5.js");?>
<?$APPLICATION->AddHeadScript("/local/templates/index/js/jquery.zoom.js");?>
<script src="https://www.google.com/recaptcha/api.js" async defer></script>

<?$APPLICATION->AddHeadScript("/local/templates/index/js/script.js");?>
<!-- <script type='text/javascript' src='/local/templates/index/js/snow.js'></script>
<script type='text/javascript'>
var aaSnowConfig = {snowflakes: '600'};
</script> -->
<link rel="stylesheet" type="text/css" href="/local/templates/index/fancybox/jquery.fancybox.css" media="screen">
<link rel="stylesheet" type="text/css" href="/local/templates/index/lightbox/jquery.lightbox-0.5.css" media="screen"/>
<link rel="stylesheet" type="text/css" href="/local/templates/index/css/font-awesome.css" media="screen"/>
<link rel="stylesheet" type="text/css" href="/local/templates/index/css/custom_for_all_site.css" media="screen"/>


<?/* global $USER;
if (!$USER->IsAdmin()) {?>
    <script type="text/javascript">
	imageDir = "/local/templates/index/images/snow/";
	sflakesMax = 50;
	sflakesMaxActive = 50;
	svMaxX = 2;
	svMaxY = 6;
	ssnowStick = 1;
	ssnowCollect = 0;
	sfollowMouse = 1;
	sflakeBottom = 0;
	susePNG = 1;
	sflakeTypes = 5;
	sflakeWidth = 15;
	sflakeHeight = 15;
	</script>
	<script type="text/javascript" src="/local/templates/index/js/snow.js"></script>
<?}*/?>
 <!--[if IE]>
<script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
<script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
<![endif]-->
</head>
<body>
	
<div id="panel"><?$APPLICATION->ShowPanel();?></div>
<div class="wrapper">
    <div class="header-wrap">
    	<div class="top">
    		<div class="center">
    			<?$APPLICATION->IncludeComponent("bitrix:menu", "menu", array(
    	          "ROOT_MENU_TYPE" => "top2",
    	          "MENU_CACHE_TYPE" => "Y",
    	          "MENU_CACHE_TIME" => "36000000",
    	          "MENU_CACHE_USE_GROUPS" => "Y",
    	          "MENU_CACHE_GET_VARS" => array(
    	          ),
    	          "MAX_LEVEL" => "1",
    	          "CHILD_MENU_TYPE" => "submenu",
    	          "USE_EXT" => "N",
    	          "DELAY" => "N",
    	          "ALLOW_MULTI_SELECT" => "N"
    	          ),
    	          false
    	        );?>
    	        <div class="auth">
    				<?if(!$USER->IsAuthorized()):?>
    					<a class="btn-auth">Вход</a> / <a href="/registration/">Регистрация</a>
    					<div class="auth-form" id="login-area">
    						<span class="close">X</span>
    						<?$APPLICATION->IncludeComponent(
    							"idf:login.ajax",
    							"site",
    							Array(
    								"COMPONENT_TEMPLATE" => ".default",
    								"personal_link" => "/personal/"
    							)
    						);?>
    					</div>
    				<?else:?>
    					<a href="/personal/">Кабинет</a> / <a href="?logout=yes">Выход</a>
    				<?endif;?>
    			</div>
				<div class="btn-ciaman">
					<a href="https://usatba-texno.caiman.ru/" target="_blank">CAIMAN</a>
				</div>
<!--
				<span class="btn-callback">Заказать звонок</span>
<? /* $APPLICATION->IncludeFile(
    				$APPLICATION->GetTemplatePath("/local/includes/callback-form.php"),
    				Array(),
    				Array("MODE"=>"html")
); */?>
-->
    		</div>
    	</div>
    	<div class="header">
    		<div class="center">
    			<a class="logo" href="/">
    				<img alt="Усадьба Техно" title="Усадьба Техно" src="/local/templates/index/images/logo.png">
    			</a>
                <button class="mobile-menu-btn" type="button"><span></span></button>
    			<div class="contacts">
    				<div class="item">
    					<?$APPLICATION->IncludeFile(
    						$APPLICATION->GetTemplatePath("/local/includes/contacts-top1.php"),
    						Array(),
    						Array("MODE"=>"html")
    					);?>
    				</div>
    				<div class="item">
    					<?$APPLICATION->IncludeFile(
    						$APPLICATION->GetTemplatePath("/local/includes/contacts-top2.php"),
    						Array(),
    						Array("MODE"=>"html")
    					);?>
    				</div>
    				<?/*
    				<div class="item">
    					<?$APPLICATION->IncludeFile(
    						$APPLICATION->GetTemplatePath("/local/includes/contacts-top3.php"),
    						Array(),
    						Array("MODE"=>"html")
    					);?>
    				</div>
    				*/?>
					</div>
					
    			<div class="basket">
    					<?$APPLICATION->IncludeComponent(
	"bitrix:sale.basket.basket.line", 
	"site", 
	array(
		"PATH_TO_BASKET" => "/personal/cart/",
		"COMPONENT_TEMPLATE" => "site",
		"PATH_TO_ORDER" => SITE_DIR."personal/order/make/",
		"SHOW_NUM_PRODUCTS" => "Y",
		"SHOW_TOTAL_PRICE" => "Y",
		"SHOW_EMPTY_VALUES" => "Y",
		"SHOW_PERSONAL_LINK" => "N",
		"PATH_TO_PERSONAL" => SITE_DIR."personal/",
		"SHOW_AUTHOR" => "N",
		"PATH_TO_REGISTER" => SITE_DIR."login/",
		"PATH_TO_PROFILE" => SITE_DIR."personal/",
		"SHOW_PRODUCTS" => "N",
		"POSITION_FIXED" => "N",
		"HIDE_ON_BASKET_PAGES" => "N",
		"PATH_TO_AUTHORIZE" => "",
		"SHOW_REGISTRATION" => "N",
	),
	false
);?>
					</div>
					<div class="work_hours">
						<span>Пн-пт 09:00-19:00, Сб-вс 09:00-17:00</span>
					</div>
    			<div class="search">
    				<?$APPLICATION->IncludeComponent(
    					"bitrix:search.title",
    					"site",
    					array(
    						"CATEGORY_0" => array(
    							0 => "iblock_catalog",
    						),
    						"CATEGORY_0_TITLE" => "Результаты",
    						"CHECK_DATES" => "Y",
    						"CONTAINER_ID" => "title-search",
    						"INPUT_ID" => "title-search-input",
    						"NUM_CATEGORIES" => "1",
    						"ORDER" => "date",
    						"PAGE" => "#SITE_DIR#search/",
    						"SHOW_INPUT" => "Y",
    						"SHOW_OTHERS" => "N",
    						"TOP_COUNT" => "5",
    						"USE_LANGUAGE_GUESS" => "Y",
    						"COMPONENT_TEMPLATE" => "site",
    						"CATEGORY_0_iblock_catalog" => array(
    							0 => "6",
    						)
    					),
    					false
    				);?>
    			</div>
    		</div>
    	</div>
    	<div class="topmenu">
    		<div class="center">
    			<?$APPLICATION->IncludeComponent("bitrix:menu", "menu", array(
    	          "ROOT_MENU_TYPE" => "top",
    	          "MENU_CACHE_TYPE" => "Y",
    	          "MENU_CACHE_TIME" => "36000000",
    	          "MENU_CACHE_USE_GROUPS" => "Y",
    	          "MENU_CACHE_GET_VARS" => array(
    	          ),
    	          "MAX_LEVEL" => "1",
    	          "CHILD_MENU_TYPE" => "submenu",
    	          "USE_EXT" => "N",
    	          "DELAY" => "N",
    	          "ALLOW_MULTI_SELECT" => "N"
    	          ),
    	          false
    	        );?>
    		</div>
    	</div>
    </div>
	<div class="breadcrumb">
		<div class="center">
			<?$APPLICATION->IncludeComponent(
			  "bitrix:breadcrumb",
			  "site",
			  Array(
			    "START_FROM" => "0",
			    "PATH" => "",
			    "SITE_ID" => "s1"
			  )
			);?>
		</div>
	</div>


	<div class="content">
		<div class="center">