<?

if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();

if (!empty($arResult['ERROR']))
{
	echo $arResult['ERROR'];
	return false;
}

//$GLOBALS['APPLICATION']->SetTitle('Highloadblock List');
?>
<ul class="brand-page">
<?foreach ($arResult["rows"] as $key => $arBrand) {?>
	<li class="brand-page__item">
		<?/*if($arBrand["UF_FILE"] != '&nbsp;'){?><span class="brand-page__logo"><?=$arBrand["UF_FILE"]?></span><?}*/?>
		<a href="/brands/<?=$arBrand["UF_XML_ID"]?>/"><?=$arBrand["UF_NAME"]?></a>
	</li>

<?}?>
</ul>