<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
$this->setFrameMode(true);
//echo "<pre>";
//print_r($arResult);
$this->addExternalCss("/local/templates/.default/components/bitrix/catalog.section/brands/styles.css");
?>

<?
  if($arResult['ITEMS']) {?>

<div class="catalog-sort">
	<div class="catalog-sort-text">Сортировать по:</div>
	<div class="catalog-sort__block">
		<div class="catalog-sort__input">
		<?
			if($_GET['sort_direction'] == 'asc' && $_GET['sort'] == 'price'){
				echo "Возрастанию цены";
			} elseif($_GET['sort_direction'] == 'desc' && $_GET['sort'] == 'price'){
				echo "Убыванию цены";
			} elseif($_GET['sort'] == 'nal') {
				echo "По наличию";
			}
            else {
				echo "Возрастанию цены";
			} 
		?>
		</div>
		<div class="catalog-sort__options">
			<div class="catalog-sort__option"><a href="<?=$APPLICATION->GetCurPageParam("sort=price&sort_direction=asc", array("sort","sort_direction"))?>" class="catalog-sort__link">Возрастанию цены</a></div>
			<div class="catalog-sort__option"><a href="<?=$APPLICATION->GetCurPageParam("sort=price&sort_direction=desc", array("sort","sort_direction"))?>" class="catalog-sort__link">Убыванию цены</a></div>
            <div class="catalog-sort__option"><a href="<?=$APPLICATION->GetCurPageParam("sort=nal&sort_direction=desc", array("sort","sort_direction"))?>" class="catalog-sort__link">По наличию</a></div>
		</div>
	</div>	
</div>
	
<?}?>

<div class="catalog-section catalog-section_brands">
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
				<?=$arItem["DETAIL_TEXT"]?> 
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
			<span class="price "><?=number_format($arItem["PRICES"]["base"]["VALUE"], 0, ',', ' ');?> <span>руб. за шт</span></span>
		</div>
	<?}?>
	<div class="clear"></div>
	<?=$arResult["NAV_STRING"]?>
</div>
