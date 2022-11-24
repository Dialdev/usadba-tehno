<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
$this->setFrameMode(true);
$item=0;
?>	
<h1 class="h2">Производители</h1>
<ul class="brand-page">
<?foreach($arResult["ITEMS"] as $arItem):
$item++;
?>
	<?
	// echo "<pre>";
	// print_r($arItem);
	?>
<li class="brand-page__item brand-page__item_inner">
	<a href="<?=$arItem['DETAIL_PAGE_URL']?>">
		<span class="brand-page__logo"><img src='<?=$arItem["PREVIEW_PICTURE"]["SRC"]?>' alt="<?=$arItem["NAME"]?>"></span>
		<span><?=$arItem["NAME"]?></span>
	</a>
	
</li>	
<?endforeach;?>
</ul>
