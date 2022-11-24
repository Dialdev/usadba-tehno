<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
$this->setFrameMode(true);
?>
<?foreach ($arResult['SECTIONS'] as &$arSection){?>
<a class="item" href="<?=$arSection['SECTION_PAGE_URL']?>">
	<span class="item-img__wrapper">

		<?if($arSection['PICTURE']['SRC']!="") {?>
	    	<? 
      	$renderImage = CFile::ResizeImageGet($arSection["~PICTURE"], Array("width" => 140, "height" => 100), BX_RESIZE_IMAGE_PROPORTIONAL_ALT, false); 
      	echo '<img title="'.$arSection["NAME"].'" alt="'.$arSection["NAME"].'" src="'.$renderImage["src"].'" />'; 
?>
	    <?} else {?>
	    	<img alt="<?=$arSection["NAME"]?>" title="<?=$arSection["NAME"]?>" src="/local/templates/index/images/no_photo.png">	
    <?}?>
	</span>
    <span class="name"><?=$arSection["NAME"]?></span>
    <!-- <span><?//price(2)?></span> -->
	<?if(!empty($arSection["MIN_PRICE_CUSTOM"])){?>
		<sapn>от <?=$arSection["MIN_PRICE_CUSTOM"]?> руб.</sapn>
	<?}?>
</a>
<?}?>

<?
// global $USER;
// if($USER->IsAdmin()){
//     echo '<pre>';
//     print_r($arResult);
//     echo '</pre>';
// }
?>