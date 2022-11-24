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
// print_r($arResult);
// echo "</pre>";
// }
?>

<div class="leftbar">
	<div class="menu-catalog">
		<?$APPLICATION->IncludeComponent("bitrix:menu", "menu_catalog", array(
	          "ROOT_MENU_TYPE" => "left",
	          "MENU_CACHE_TYPE" => "Y",
	          "MENU_CACHE_TIME" => "36000000",
	          "MENU_CACHE_USE_GROUPS" => "Y",
	          "MENU_CACHE_GET_VARS" => array(
	          ),
	          "MAX_LEVEL" => "3",
	          "CHILD_MENU_TYPE" => "left",
	          "USE_EXT" => "Y",
	          "DELAY" => "N",
	          "ALLOW_MULTI_SELECT" => "N"
	          ),
	          false
	        );?>
	</div>
</div>
<div class="section-list">
	<h1>Каталог товаров</h1>
	<?foreach ($arResult['SECTIONS_ALFA'] as &$arSection) {
		//$this->AddEditAction($arSection['ID'], $arSection['EDIT_LINK'], $strSectionEdit);
		//$this->AddDeleteAction($arSection['ID'], $arSection['DELETE_LINK'], $strSectionDelete, $arSectionDeleteParams);?>
		<div class="item" id="<? echo $this->GetEditAreaId($arSection['ID']); ?>">
			<a class="photo" href="<? echo $arSection['SECTION_PAGE_URL']; ?>">
				<?
				$uInfo = $arSection["PICTURE"]['ID'];
				$imageCatched = CFile::ResizeImageGet($uInfo, array('width'=>170, 'height'=>140), BX_RESIZE_IMAGE_PROPORTIONAL, true);?>
				
				<?if($arSection["PICTURE"]["SRC"]!=""){?>
					<img alt="<? echo $arSection['NAME']; ?>" title="<? echo $arSection['NAME']; ?>" src="<?=$arSection["PICTURE"]["SRC"]?>">
				<?} else {?>
					<img alt="<? echo $arSection['NAME']; ?>" title="<? echo $arSection['NAME']; ?>" src="/local/templates/index/images/no_photo.png">
				<?}?>
			</a>
			<a class="name" href="<? echo $arSection['SECTION_PAGE_URL']; ?>"><span><? echo $arSection['NAME']; ?></span></a>
		</div>
	<?}?>
</div>
