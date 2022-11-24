<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
$this->setFrameMode(true);
$item=0;
?>
<?foreach($arResult["ITEMS"] as $arItem):
$item++;
?>
	<?
	//echo "<pre>";
	//print_r($arItem);
	?>
	<div class="news-<?=$item?> news-item">
		<a href="<?=$arItem["DETAIL_PAGE_URL"]?>">
			<div class="image">
				<img alt="<?=$arItem["NAME"]?>" title="<?=$arItem["NAME"]?>" src="<?=$arItem["PREVIEW_PICTURE"]["SRC"]?>">
			</div>
		</a>
		<div class="news-text__wrap">
			<span class="title"><?=$arItem["NAME"]?></span>
			<span class="date"><?=$arItem["ACTIVE_FROM"]?></span>
		<div class="preview"><?=$arItem["PREVIEW_TEXT"]?></div>
		<a class="about-news" href="<?=$arItem["DETAIL_PAGE_URL"]?>">Читать дальше</a>
		</div>
	</div>
<?endforeach;?>