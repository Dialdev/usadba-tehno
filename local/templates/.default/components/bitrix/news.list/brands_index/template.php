<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
$this->setFrameMode(true);
$item=0;
?>	
<ul class="brand-page">
<?foreach($arResult["ITEMS"] as $arItem):
$item++;
?>
	<?
	// echo "<pre>";
	// print_r($arItem);
	?>
<li class="brand-page__item">
	<a href="<?=$arItem['DETAIL_PAGE_URL']?>"><?=$arItem["NAME"]?></a>
</li>	
<?endforeach;?>
</ul>
