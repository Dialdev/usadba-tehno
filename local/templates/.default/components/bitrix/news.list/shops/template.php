<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
$this->setFrameMode(true);
?>
<div class="shop__list">
	<?foreach($arResult["ITEMS"] as $arItem):
	?>
		<?$img= CFile::ResizeImageGet($arItem["PREVIEW_PICTURE"], array('width'=>190, 'height'=>190), BX_RESIZE_IMAGE_EXACT, true);?>
		<a href="<?=$arItem["PREVIEW_PICTURE"]["SRC"]?>" class="shop__item fb" rel="fb">
			<img alt="<?=$arItem["NAME"]?>" title="<?=$arItem["NAME"]?>" src="<?=$img["src"]?>">
		</a>
	<?endforeach;?>
</div>