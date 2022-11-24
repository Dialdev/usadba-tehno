<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
$this->setFrameMode(true);
//echo "<pre>";
//print_r($arResult);

?>

	
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
				<span class="price with_oldprice"><span class="oldprice"><?=number_format($arItem["PRICES"]["base"]["VALUE"], 0, ',', ' ');?></span><span class="oldprice__currency"> руб. за шт</span><br><?=number_format($arItem["PRICES"]["base"]["DISCOUNT_VALUE"], 0, ',', ' ');?> <span>руб. за шт</span></span>
			<?}else {?>
				<span class="price"><?=number_format($arItem["PRICES"]["base"]["VALUE"], 0, ',', ' ');?> <span>руб. за шт</span></span>
			<?}?>
		</div>
	<?}?>
	<div class="clear"></div>
	<?=$arResult["NAV_STRING"]?>
</div>
