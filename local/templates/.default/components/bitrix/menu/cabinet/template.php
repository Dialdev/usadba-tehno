<?if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>
<ul class="cabinet-menu">
	<?foreach($arResult as $arItem):?>
	<li class="cabinet-menu__item"><a href="<?=$arItem["LINK"]?>" class="cabinet-menu__link<?if ($arItem["SELECTED"]):?> cabinet-menu__link_selected<?endif?>"><?=$arItem["TEXT"]?></a>
	<?endforeach?>
</ul>