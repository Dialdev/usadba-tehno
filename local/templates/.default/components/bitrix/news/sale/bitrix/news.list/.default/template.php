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
<?
//echo "<pre>";
//print_r($arResult);
//echo "</pre>";
?>
<div class="sale-list">
	<?foreach($arResult["ITEMS"] as $arItem):?>
		<?
		$this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_EDIT"));
		$this->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));
		?>
		<?$img= CFile::ResizeImageGet($arItem["PREVIEW_PICTURE"], array('width'=>591, 'height'=>397), BX_RESIZE_IMAGE_EXACT, true);?>
		<a href="<?echo $arItem["DETAIL_PAGE_URL"]?>" class="sale-item" id="<?=$this->GetEditAreaId($arItem['ID']);?>">
			<img class="sale-img" src="<?=$img["src"]?>" alt="sales"/>	
			<div class="sale-text">
				<span class="sale-text__top"><?echo $arItem["PROPERTIES"]["SALE_TEXT"]["VALUE"];?></span>
				<span class="sale-text__bottom"><?echo $arItem["PREVIEW_TEXT"];?></span>
			</div>
		</a>
	<?endforeach;?>
</div>
<?if($arParams["DISPLAY_BOTTOM_PAGER"]):?>
	<br /><?=$arResult["NAV_STRING"]?>
<?endif;?>