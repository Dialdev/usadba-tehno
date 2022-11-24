<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
$this->setFrameMode(true);
?>
<div class="rightbar">
<h1><?$APPLICATION->ShowTitle(false);?></h1>

<div class="catalog-sort">
	<div class="catalog-sort__select">
		<div class="catalog-sort-text">Сортировать по:</div>
		<div class="catalog-sort__block">
			<div class="catalog-sort__input">
			<?
				if($_GET['price'] == 'ASC'){
					echo "Возрастанию цены";
				} elseif($_GET['price'] == 'DESC'){
					echo "Убыванию цены";
				} else {
					echo "Возрастанию цены";
				} 
			?>
			</div>
			<div class="catalog-sort__options">
				<div class="catalog-sort__option"><a href="<?=$APPLICATION->GetCurPageParam("price=ASC", array("price"))?>" class="catalog-sort__link">Возрастанию цены</a></div>
				<div class="catalog-sort__option"><a href="<?=$APPLICATION->GetCurPageParam("price=DESC", array("price"))?>" class="catalog-sort__link">Убыванию цены</a></div>
			</div>
		</div>
	</div>
</div>

<?$APPLICATION->IncludeComponent(
	  "bitrix:catalog.section.list", 
	  "section", 
	  array(
	    "IBLOCK_TYPE" => "catalog",
	    "IBLOCK_ID" => "6",
	    "SECTION_ID" => $arParams["MY_SECTION_ID"],
	    "TOP_DEPTH" => "1",
	    "SECTION_URL" => "/catalog/#SECTION_CODE_PATH#/",
	    "CACHE_TYPE" => "N",
	    "ADD_SECTIONS_CHAIN" => ($arParams["SECTION_ID"]>0)?"N":"Y"
	  ),
	  false
	);?>	

<div class="catalog-section">
	<?foreach ($arResult["ITEMS"] as $key => $arItem) {?>
		<div class="item product-item" data-id="<?=$arItem["ID"]?>" id="<?=$this->GetEditAreaId($arItem["ID"])?>">
			<a href="<?=$arItem["DETAIL_PAGE_URL"]?>">
				<div class="sale-icon">
					<ul>
						<?if($arItem["PROPERTIES"]["STOCK"]["VALUE"]!="") {?>
							<li><span class="sale"></span></li>
						<?}?>
						<?if($arItem["PROPERTIES"]["SALELEADER"]["VALUE"]!="") {?>
							<li><span class="top"></span></li>
						<?}?>
						<?if($arItem["PROPERTIES"]["NEW"]["VALUE"]!="") {?>
							<li><span class="new"></span></li>
						<?}?>
					</ul>
				</div>
                 
				<div class="image">
					<?if ($arItem["DETAIL_PICTURE"]["SRC"]!="") {?>
						<img alt="<?=$arItem["NAME"]?>" title="<?=$arItem["NAME"]?>" src="<?=$arItem["DETAIL_PICTURE"]["SRC"]?>">
					<?} else {?>
						<img alt="<?=$arItem["NAME"]?>" title="<?=$arItem["NAME"]?>" src="/local/templates/index/images/no_photo.png">
					<?}?>
				</div>
				<span class="name"><?=$arItem["NAME"]?></span>
			</a>
			<span class="preview">
				<?if ($arItem["PROPERTIES"]["OPISANIE_DLYA_TSENNIKA_SPRAVOCHNIK_NOMENKLATURA_OB"]["~VALUE"]!='') {?>
					<?=nl2br($arItem["PROPERTIES"]["OPISANIE_DLYA_TSENNIKA_SPRAVOCHNIK_NOMENKLATURA_OB"]["~VALUE"]);?>
				<?} else {?>
					<?=$arItem["DETAIL_TEXT"]?>
				<?}?>
			</span>
			<?if($arItem["CATALOG_QUANTITY"]>0) {?>
				<span class="quantity-yes">Есть в наличии</span>
			<?} else {?>
				<span class="quantity-no">Нет в наличии</span>
			<?}?>
			<?if($arItem["CATALOG_QUANTITY"]>0) {?>
				<a class="buy product-item__button_buy"></a>
			<?} else {?>
				<a class="buy product-item__button_buy no-zakaz">Предзаказ<b>, цену уточняйте</b></a>
			<?}?>
			
			<?if ( $arItem["PRICES"]["base"]["DISCOUNT_DIFF"] > 0 ) {?>
				<span class="price with_oldprice"><span class="oldprice"><?=number_format($arItem["PRICES"]["base"]["VALUE"], 0, ',', ' ');?></span><span class="oldprice__currency"> руб. за шт</span><br><?=number_format($arItem["PRICES"]["base"]["DISCOUNT_VALUE"], 0, ',', ' ');?><span>руб. за шт</span></span>
			<?}else {?>
				<span class="price"><?=number_format($arItem["PRICES"]["base"]["VALUE"], 0, ',', ' ');?> <span>руб. за шт</span></span>
			<?}?>
		</div>
	<?}?>
	<div class="clear"></div>
	<?=$arResult["NAV_STRING"]?>
</div>

<?$APPLICATION->ShowViewContent('section_description');?>

</div>
