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
?>

<?foreach ($arResult["ITEMS"] as $arItem) {?>
<a class="item_sert fb" data-fancybox-group="fb"  href="<?=$arItem["PREVIEW_PICTURE"]["SRC"]?>">
	<span class="item-img__wrapper_sert">

		<?if($arItem['PREVIEW_PICTURE']['SRC']!="") {?>
			<? $img= CFile::ResizeImageGet($arItem["PREVIEW_PICTURE"], array('width'=>110, 'height'=>163), BX_RESIZE_IMAGE_EXACT, true);?> 
      		<img alt="<?=$arItem["NAME"]?>" title="<?=$arItem["NAME"]?>" src="<?=$img["src"]?>">
	    <?} else {?>
	    	<img alt="<?=$arItem["NAME"]?>" title="<?=$arItem["NAME"]?>" src="/local/templates/index/images/no_photo.png">	
    	<?}?>
	</span>
    
</a>
<?}?>
<div style="display:none;"><pre>
<?print_r($arResult["ITEMS"])?>
</pre></div>