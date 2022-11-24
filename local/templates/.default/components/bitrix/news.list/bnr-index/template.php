<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
$this->setFrameMode(true);
?>
<?foreach($arResult["ITEMS"] as $arItem):?>
	<?
	//echo "<pre>";
	//print_r($arItem);
	?>
	<a class="slide" href="<?=$arItem["PROPERTIES"]["HREF"]["VALUE"]?>" target="_blank" rel="nofollow">
		<img alt="<?=$arItem["NAME"]?>" title="<?=$arItem["NAME"]?>" src="<?=$arItem["PREVIEW_PICTURE"]["SRC"]?>">
	</a>
<?endforeach;?>