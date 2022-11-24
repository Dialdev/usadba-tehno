<?php

//echo "ref=".$_SERVER['HTTP_REFERER']."<br>";
//echo "serv=".$_SERVER['SERVER_NAME']."<br>";

/*
echo "<pre>";
print_r($_GET);
echo "</pre>";
*/

$start=0;
$pos=strpos($_SERVER['HTTP_REFERER'],$_SERVER['SERVER_NAME']);
if ($pos===false) {
    //нет
} else {
    $start=1;
}


$cena_ok=0;
$cena=0;
if( (isset($_GET['cena']))&&(strlen($_GET['cena'])>=3)&&(is_numeric($_GET['cena'])) ){
	$cena_ok=1;
	$cena=$_GET['cena'];
}
$price_ok=0;
$price=0;
if( (isset($_GET['price']))&&(strlen($_GET['price'])>=3)&&(is_numeric($_GET['price'])) ){
	$price_ok=1;
	$price=$_GET['price'];
}
$tovar_ok=0;
$tovar='';
if(isset($_GET['tovar'])){
	$str=str_ireplace("/\W/u","",$_GET['tovar']);
	if(strlen($str)>=3){
		$tovar_ok=1;
		$tovar=$str;
	}
}


/*
echo "start=".$start."<br>";
echo "cena_ok=".$cena_ok."<br>";
echo "cena_ok=".$price_ok."<br>";
echo "tovar_ok=".$tovar_ok."<br>";

echo "tovar=".$tovar."<br>";
echo "cena=".$cena."<br>";
echo "price=".$price."<br>";
*/

//urlencode
//urldecode
//

?>
<?php
if( ($start==1)&&($cena_ok==1)&&($price_ok==1)&&($tovar_ok==1) ){
?>
<!DOCTYPE html>
<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta property="og:title" content="Усадьба-Техно"/>
<meta property="og:description" content="Интернет магазин садово-паркового оборудования и мототехники"/>
<meta property="og:url" content="https://www.usatba-texno.ru/kredit.php"/>
<meta property="og:image" content="https://www.usatba-texno.ru/upload/logo.png" />
<title>Покупка в кредит</title>

<base href="https://www.usatba-texno.ru/"> 

<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<meta name="robots" content="index, nofollow" />
<link href="/bitrix/css/main/bootstrap.css?1536848823141508" type="text/css"  rel="stylesheet" />
</head>
<body>


<div class="container">
	<div class="row">
        	<div class="col-12 ">
			<h1>Покупка в кредит</h1>
		</div>
	</div>
	
    <div class="row">
        <div class="col-12 ">
           




<!-- ****************** нач новое 3.0 **************** -->
<h2>Оформить кредит в ПочтаБанке</h2>

<!-- Забирать код НАЧАЛО --> 




<link href="https://onlypb.pochtabank.ru/PBstyles.css" rel=stylesheet type="text/css">
<script src="https://code.jquery.com/jquery-3.5.1.min.js" integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0=" crossorigin="anonymous"></script>


<script type="text/javascript" src="https://cdn.jsdelivr.net/npm/emailjs-com@3/dist/email.min.js"></script> 
<script type="text/javascript">
(function() {
emailjs.init("user_1PBEJkILIOeNZOELgKnrJ");
})();
</script>

<div class="PBnkBox">
<div class="PBnkHead"><div class="PBnkLogo"></div>
<div class="PBnkTitle">Дионис <br>Заявка в банк</div>
<div style="clear:both;"></div></div>

<div class="PBnkForm"><div class="PBnkLine">Укажите</div>
<input type="number" class="PBnkInput" required id="chekPrice" placeholder="Стоимость товара" title="От 3 до 300 тысяч рублей" value="<?php echo $cena; ?>" />
<div style="clear:both;"></div></div>

<div class="PBnkForm"><div class="PBnkLine">Срок</div>
<select id="termCredit" class="PBnkSelect">
<option value="6">Кредит 6 месяцев</option>
<option value="12">Кредит 12 месяцев</option>
<option value="18">Кредит 18 месяцев</option>
<option value="24" selected>Кредит 24 месяца</option>
<option value="36">Кредит 36 месяцев</option></select>
<div style="clear:both;"></div></div>

<div class="PBnkForm"><div class="PBnkLine">Укажите</div>
<input type="number" class="PBnkInput" required id="firstPayment" placeholder="Первоначальный взнос" title="До 40% от стоимости товара"/>
<div style="clear:both;"></div></div>

<button class="PBnkButton" onClick="credit_form()">Перейти к оформлению заявки</button>
</div>

<div id="pos-credit-container"></div>
<script src="https://my.pochtabank.ru/sdk/v2/pos-credit.js"></script>



<script>

function uuidv4() {
  return 'xxxxxxxx-xxxx-4xxx-yxxx-xxxxxxxxxxxx'.replace(/[xy]/g, function(c) {
    var r = Math.random() * 16 | 0, v = c == 'x' ? r : (r & 0x3 | 0x8);
    return v.toString(16);
  });
}
 
function credit_form() {
var chekPrice = $('#chekPrice').val();
var termCredit = $('#termCredit').val();
var firstPayment = $('#firstPayment').val();

var ttName = "Дионис"; 
var email = "usatba-texno@mail.ru";
var operId = uuidv4();
var srok = termCredit;
var chekprice2 = chekPrice - firstPayment;

var amountCredit = chekPrice - firstPayment;
var firstPaymentMax = chekPrice * 0.4;

if( amountCredit > 300000 || amountCredit < 3000 || amountCredit == '') {
alert("Сумма кредита должна быть не менее 3'000 и не более 300'000 рублей");
return false;
}

if( firstPayment > firstPaymentMax ) {
alert("Первый взнос должен быть не более 40% от суммы заявки");
return false;
}


var options = {
operId: operId,
productCode: 'EXP_MP_PP_23,9', // код тарифа
ttCode: '0117001008892', // код ТТ
toCode: '011700100889', // код ТО
ttName: '', // адрес пункта выдачи товара
amountCredit: '',
termCredit: termCredit,  
firstPayment: Number.parseInt(firstPayment),
extAppId: '',  
brokerAgentId: 'NON_BROKER',
returnUrl: 'https://onlypb.pochtabank.ru/razdel/', //ссылка на страницу на которую возвращаемся после заполнения анкеты.
order: [{
category: '245', 
mark: '', // название товара или услуги
model: '<? echo $tovar; ?>',  // название товара или услуги
quantity: 1, // количество
price: Number.parseInt(<?php echo $price; ?>), // Сумма заявки
}]
};


window.PBSDK.posCreditV2.mount('#pos-credit-container', options);
document.getElementById('pos-credit-container').scrollIntoView(); 
window.PBSDK.posCreditV2.on('done', function(id) {
var templateParams = {
    e_site: ttName,
    e_id: id,
    e_summ: Number.parseInt(chekprice2),
    e_srok: srok,
    e_operid: operId,
    e_mail: email,
};
emailjs.send('service_f147e9c', 'template_e13tj4p', templateParams);
});
}

</script>

<!-- Забирать код КОНЕЦ -->


<!-- ****************** конец новое 3.0 **************** -->




        </div>
    </div>
</div>

</body>
</html>

<?php
}else{
	echo "<h1>Хм...</h1>";
}

?>