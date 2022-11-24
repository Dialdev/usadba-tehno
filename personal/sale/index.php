<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("Моя скидка");
?>
<?$APPLICATION->IncludeComponent(
	"bitrix:menu",
	"cabinet",
	Array(
		"MAX_LEVEL" => "1",
		"ROOT_MENU_TYPE" => "left"
	)
);?>

<div class="block-personal-sale">

<?
if(!CModule::IncludeModule("catalog"))
   return;

global $USER;
$userGroup=($USER->GetUserGroup($USER->GetID()));
$Diskount_max=0;
foreach($userGroup as $value)
{
   $arDiscounts=CCatalogDiscount::GetDiscountGroupsList(
      $arOrder=array("GROUP_ID" => ASC),
      $arFilter=array("GROUP_ID" => $value),
      false,
      false,
      array('')
   );
   $dist=$arDiscounts->Fetch();
   $arDisRez=CCatalogDiscount::GetByID($dist["DISCOUNT_ID"]);
   $printDiscount=(int)$arDisRez["VALUE"];
   if ($printDiscount>$Diskount_max)
      $Diskount_max=$printDiscount;
  
};
$arFilter = Array(
    "USER_ID" => $USER->GetID()
);
$db_sales = CSaleOrder::GetList(array("DATE_INSERT" => "ASC"), $arFilter);
$orders_summ = 0;
while ($ar_sales = $db_sales->Fetch()) {
 	$orders_summ += $ar_sales["PRICE"];
}
?>
	<? if ($Diskount_max > 0) {?>Сумма ваших заказов - <span class="sale_count"><?=$orders_summ?> р.</span><br>Ваша персональная скидка - <span class="sale_count"><?=$Diskount_max?>%</span><?}?>

	<table class="discount-table">
		<tr>
			<td>Величина скидки</td>
			<td>Сумма заказов</td>
		</tr>
		<tr>
			<td>3%</td>
			<td>30000 р.</td>
		</tr>
		<tr>
			<td>4%</td>
			<td>100000 р.</td>
		</tr>
		<tr>
			<td>5%</td>
			<td>150000 р.</td>
		</tr>
		<tr>
			<td>6%</td>
			<td>200000 р.</td>
		</tr>
		<tr>
			<td>7%</td>
			<td>250000 р.</td>
		</tr>
		<tr>
			<td>8%</td>
			<td>350000 р.</td>
		</tr>
		<tr>
			<td>9%</td>
			<td>500000 р.</td>
		</tr>
		<tr>
			<td>10%</td>
			<td>700000 р.</td>
		</tr>
	</table>

</div>

<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>