<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
$this->setFrameMode(true);
?>
<?
	// echo "<pre>";
	// print_r($arResult);
	// echo "</pre>";
?>
<form class="filter">
	<?foreach($arResult["ITEMS"] as $arItem):
		if (!isset($arItem["PRICE"]))
			continue;
	?>
		<div class="filter-field">
			<div class="filter-field__title"><?=$arItem["NAME"]?>:</div>
				<div class="filter-field__block-column">
					<span class="filter-field__from">от</span>
					<input type="text" class="filter__input filter__input_max"
						name="<?=$arItem["VALUES"]["MIN"]["CONTROL_NAME"]?>"
						value="<?=$arItem["VALUES"]["MIN"]["HTML_VALUE"]?>"
						placeholder="От <?=floor($arItem["VALUES"]["MIN"]["VALUE"])?>"
					>
				</div>
				<div class="filter-field__block-column">
					<span class="filter-field__from">до</span>
					<input type="text" class="filter__input filter__input_max"
						name="<?=$arItem["VALUES"]["MAX"]["CONTROL_NAME"]?>"
						value="<?=$arItem["VALUES"]["MAX"]["HTML_VALUE"]?>"
						placeholder="До <?=ceil($arItem["VALUES"]["MAX"]["VALUE"])?>"
					>
				</div>
				<div id="slider_price"></div>
		</div>
	<?endforeach?>
	<?foreach($arResult["ITEMS"] as $arItem):
		if (isset($arItem["PRICE"]) || empty($arItem["VALUES"]))
			continue;
		if (isset($arItem["VALUES"]["MIN"]) && ($arItem["VALUES"]["MIN"]["VALUE"] == $arItem["VALUES"]["MAX"]["VALUE"]))
			continue;
	?>
		<div class="filter-field">
			<span class="filter-field__title"><?=$arItem["NAME"]?>:</span>
			<?switch ($arItem["DISPLAY_TYPE"]):
				case "A":
				case "B":
			?>
			<div class="filter-field__block">
				<div class="filter-field__block-column">
					<span class="filter-field__from">от</span>
					<input type="text" class="filter__input"
						name="<?=$arItem["VALUES"]["MIN"]["CONTROL_NAME"]?>"
						value="<?=$arItem["VALUES"]["MIN"]["HTML_VALUE"]?>"
						placeholder="От <?=floor($arItem["VALUES"]["MIN"]["VALUE"])?>"
					>					
				</div>
				<div class="filter-field__block-column">
					<span class="filter-field__from">до</span>
					<input type="text" class="filter__input"
						name="<?=$arItem["VALUES"]["MAX"]["CONTROL_NAME"]?>"
						value="<?=$arItem["VALUES"]["MAX"]["HTML_VALUE"]?>"
						placeholder="До <?=ceil($arItem["VALUES"]["MAX"]["VALUE"])?>"
					>
				</div>
			</div>
			<?break;
				case "G":
				case "H":
			?>
				<?foreach($arItem["VALUES"] as $variant):?>
					<input type="checkbox" class="filter__checkbox"
						id="<?=$variant["CONTROL_ID"]?>"
						name="<?=$variant["CONTROL_NAME"]?>"
						value="<?=$variant["HTML_VALUE"]?>"
						<?=($variant["CHECKED"]? 'checked': '')?>
						<?=($variant["DISABLED"]? 'disabled': '')?>
					>
					<label for="<?=$variant["CONTROL_ID"]?>"><img src="<?=$variant["FILE"]["SRC"]?>" alt="<?=$variant["VALUE"]?>" title="<?=$variant["VALUE"]?>"></label>
				<?endforeach?>
			<?break;
				default:
			?>
				<?foreach($arItem["VALUES"] as $variant):?>
					<input type="checkbox" class="filter__checkbox"
						id="<?=$variant["CONTROL_ID"]?>"
						name="<?=$variant["CONTROL_NAME"]?>"
						value="<?=$variant["HTML_VALUE"]?>"
						<?=($variant["CHECKED"]? 'checked': '')?>
						<?=($variant["DISABLED"]? 'disabled': '')?>
					>
					<label for="<?=$variant["CONTROL_ID"]?>"><?=$variant["VALUE"]?></label>
				<?endforeach?>
			<?endswitch?>
		</div>
	<?endforeach?>
	<button data-url="<?=$arResult["FORM_ACTION"]?>" class="filter__submit">Показать</button>
	<a href="<?=$arResult["SEF_DEL_FILTER_URL"]?>" class="filter__reset">Сбросить</a>
</form>