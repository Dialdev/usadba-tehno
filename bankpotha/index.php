<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetPageProperty("title", "Почта банк");
$APPLICATION->SetPageProperty("keywords", "Почта банк");
$APPLICATION->SetPageProperty("description", "Почта банк  | Усадьба Техно");
$APPLICATION->SetTitle("Почта банк");
?><h1>Почта банк</h1>
<div class="clear">
</div>
<div id="pos-credit-container"></div>
<script src="https://my.pochtabank.ru/sdk/v1/pos-credit.js"></script>
<script>
   var options = {
      ttCode: '0117001004364',
      ttName: 'Г ТУЛА, УЛ ДЕМИДОВСКАЯ ПЛОТИНА, Д. 13',
      fullName: '',
      phone: '',
      category: '248',
      manualOrderInput: true      
};
window.PBSDK.posCredit.mount('#pos-credit-container', options);

   // подписка на событие завершения заполнения заявки
   window.PBSDK.posCredit.on('done', function(id){
      console.log('Id заявки: ' + id)
  });

   // При необходимости можно убрать виджет вызвать unmount
   // window.PBSDK.posCredit.unmount('#pos-credit-container');
</script>


</script><?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>