<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
$this->setFrameMode(true);
?>
<h2 class="h2">сертификаты</h2>
<div class="sert__list">
	<?foreach($arResult["ITEMS"] as $arItem):
	?>
		<?$img= CFile::ResizeImageGet($arItem["PREVIEW_PICTURE"], array('width'=>110, 'height'=>163), BX_RESIZE_IMAGE_EXACT, true);?>
		<a href="<?=$arItem["PREVIEW_PICTURE"]["SRC"]?>" class="sert__item fb" rel="fb">
			<img alt="<?=$arItem["NAME"]?>" title="<?=$arItem["NAME"]?>" src="<?=$img["src"]?>">
		</a>
	<?endforeach;?>
</div>