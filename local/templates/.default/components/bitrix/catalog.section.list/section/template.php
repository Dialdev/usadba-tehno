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
// global $USER;
// if ($USER->IsAdmin()) {
// echo "<pre>";
// print_r($arSectionDescr);
// echo "</pre>";
// }
if ($APPLICATION->GetMeta("keywords_prop", "keywords")=='') 
{
	$APPLICATION->SetPageProperty("keywords", $arResult["SECTION"]["IPROPERTY_VALUES"]["SECTION_META_KEYWORDS"]);
	$APPLICATION->SetPageProperty("description", $arResult["SECTION"]["IPROPERTY_VALUES"]["SECTION_META_DESCRIPTION"]);
	$APPLICATION->SetPageProperty("title", $arResult["SECTION"]["IPROPERTY_VALUES"]["SECTION_META_TITLE"]);
}

?>

<div class="section-list">
	<?foreach ($arResult['SECTIONS_ALFA'] as &$arSection) {
		$this->AddEditAction($arSection['ID'], $arSection['EDIT_LINK'], $strSectionEdit);
		$this->AddDeleteAction($arSection['ID'], $arSection['DELETE_LINK'], $strSectionDelete, $arSectionDeleteParams);?>
		<div class="item" id="<? echo $this->GetEditAreaId($arSection['ID']); ?>">
			<a class="photo" href="<? echo $arSection['SECTION_PAGE_URL']; ?>">
				<? $resizeImage = CFile::ResizeImageGet($arSection["PICTURE"], array('width'=>170, 'height'=>140), BX_RESIZE_IMAGE_PROPORTIONAL, true); ?>
				<?if($arSection["PICTURE"]["SRC"]!=""){?>
					<img alt="<? echo $arSection['NAME']; ?>" src="<?=$resizeImage['src']?>">
				<?} else {?>
					<img alt="<? echo $arSection['NAME']; ?>" src="/local/templates/index/images/no_photo.png">
				<?}?>
			</a>
			<a class="name" href="<? echo $arSection['SECTION_PAGE_URL']; ?>"><span><? echo $arSection['NAME']; ?></span></a>
		</div>
	<?}?>
</div>

<?$this->SetViewTarget("print_section_name");?>
<?=$arResult["SECTION"]["NAME"];?>
<?$this->EndViewTarget();?>

<?$this->SetViewTarget("section_description");?>
<div class="catalog-section__description">
<?=$arResult["SECTION"]["~DESCRIPTION"];?>
</div>
<?$this->EndViewTarget();?>