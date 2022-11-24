<?if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?><h4 class="product-footer" style="margin-bottom: -20px; color: #15C174;"> Продукция </h4>
<?if (!empty($arResult)) {?>
<!-- <ul class="catalog-menu"> -->
	<?foreach($arResult as $key => $arItem):?>
 <?if ($key%10 == 0) {?></ul><ul class="catalog-menu"><?}?>
	<li><a href="<?=$arItem["LINK"]?>"><?=$arItem["TEXT"]?></a></li>
	<?endforeach?>
</ul>
<?}?>