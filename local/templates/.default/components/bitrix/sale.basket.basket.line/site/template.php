<?if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
$this->setFrameMode(true);?>
<?/*
global $USER;
if($USER->isAdmin()){
	echo "<pre>";
	print_r($arResult["ITEMS"]);
}*/
?>

<a class="small-basket" href="<?=$arParams["PATH_TO_BASKET"]?>">
	<span>В корзине</span><br><span class="small-basket__attributes">
		<!--RestartBuffer-->
		<b class="small-basket__red"><?=$arResult["PRODUCT_COUNT"];?> <?=$arResult["PRODUCT(S)"]?></b>
		<b class="small-basket__price"><?=$arResult["TOTAL_AMOUNT"];?></b>
		<!--RestartBuffer-->
	</span>
</a>

<!-- <div class="item__container" style="display: none;">
	<?/*foreach ($arResult["ITEMS"] as $key => $arItem) {?>
		<a href="<?=$arItem["DETAIL_PAGE_URL"];?>">
			<div class="item__image"><img src="<?=$arItem["SRC"];?>" alt="<?=$arItem["NAME"];?>"></div>
			<div class="item__title"><?=$arItem["NAME"];?></div>
			<div class="item__price"><?=$arItem["NUM_PRODUCTS"];?> <?=$arItem["MEASURE_NAME"]?></div>
			<div class="item__count"><?=$arItem["BASE_PRICE"];?></div>
		</a>
	<?}*/?>
</div> -->

