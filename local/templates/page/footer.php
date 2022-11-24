</div>
  </div>
  <?$APPLICATION->IncludeComponent( "bitrix:main.include", "", 
Array( 
"AREA_FILE_SHOW" => "sect", 
"AREA_FILE_SUFFIX" => "base_map", 
"AREA_FILE_RECURSIVE" => "Y", 
"EDIT_TEMPLATE" => "include_area.php" ), false ); 
?>
<div class="wrapper-footer"></div>  
</div>
<div class="footer">
  <div class="f-top">
    <div class="center">
		<img class="up-button" src="/local/templates/index/images/up.png" alt="up">
      <div class="subscribe">
        <span class="title">Подпишитесь! Новинки, скидки, предложения!</span>
        <?$APPLICATION->IncludeComponent(
        "bitrix:subscribe.form",
        "site",
        Array(
          "CACHE_TIME" => "3600",
          "CACHE_TYPE" => "A",
          "COMPONENT_TEMPLATE" => ".default",
          "PAGE" => "#SITE_DIR#personal/subscribe/subscr_edit.php",
          "SHOW_HIDDEN" => "N",
          "USE_PERSONALIZATION" => "Y"
        )
      );?>
      </div>
    </div>
  </div>
  <div class="f-nav">
    <div class="center">
     <?$APPLICATION->IncludeComponent("bitrix:menu", "menu_bottom", array(
            "ROOT_MENU_TYPE" => "bottom_catalog",
            "MENU_CACHE_TYPE" => "Y",
            "MENU_CACHE_TIME" => "36000000",
            "MENU_CACHE_USE_GROUPS" => "Y",
            "MENU_CACHE_GET_VARS" => array(
            ),
            "MAX_LEVEL" => "1",
            "CHILD_MENU_TYPE" => "submenu",
            "USE_EXT" => "Y",
            "DELAY" => "N",
            "ALLOW_MULTI_SELECT" => "N"
            ),
            false
          );?>
      <?$APPLICATION->IncludeComponent(
	"bitrix:menu", 
	"menu", 
	array(
		"ROOT_MENU_TYPE" => "bottom",
		"MENU_CACHE_TYPE" => "A",
		"MENU_CACHE_TIME" => "36000000",
		"MENU_CACHE_USE_GROUPS" => "Y",
		"MENU_CACHE_GET_VARS" => array(
		),
		"MAX_LEVEL" => "2",
		"CHILD_MENU_TYPE" => "left",
		"USE_EXT" => "N",
		"DELAY" => "N",
		"ALLOW_MULTI_SELECT" => "N",
		"COMPONENT_TEMPLATE" => "menu"
	),
	false
);?>
      <?$APPLICATION->IncludeComponent(
	"bitrix:menu", 
	"menu", 
	array(
		"ROOT_MENU_TYPE" => "bottom2",
		"MENU_CACHE_TYPE" => "A",
		"MENU_CACHE_TIME" => "36000000",
		"MENU_CACHE_USE_GROUPS" => "N",
		"MENU_CACHE_GET_VARS" => array(
		),
		"MAX_LEVEL" => "1",
		"CHILD_MENU_TYPE" => "left",
		"USE_EXT" => "N",
		"DELAY" => "N",
		"ALLOW_MULTI_SELECT" => "N",
		"COMPONENT_TEMPLATE" => "menu"
	),
	false
);?>
      <div class="foter_rith">
      <span class="copyright">©2009 - <?=date("Y");?> ТД "Усадьба-Техно"<br></span>
      <span class="adres_futer">ул.Демидовская плотина, 13<br><a href="tel:+74872425812"><span>+7 (4872)</span> 42-58-12</a><br>      

          <!-- ул .Одоевское шоссе, 30<br><a href="tel:+74872376746"><span>+7 (4872)</span> 37-67-46</a>      -->
          <!-- <div class="js-callback footer__callback">Обратный звонок *</div>  -->



      </span>
      <span class="dial">Создание и продвижение сайта<br><a target="_blank" href="http://dialweb.ru/">Digital Agency Dial</a></span>
    
    <!-- <p><a href="/local/templates/index/images/oferta.rtf" target="_blank">Договор оферты</a></p> -->
<!-- BEGIN JIVOSITE CODE {literal} --> 
<script type='text/javascript'> 
(function(){ var widget_id = 'voz56Yr0xQ';var d=document;var w=window;function l(){ 
var s = document.createElement('script'); s.type = 'text/javascript'; s.async = true; s.src = '//code.jivosite.com/script/widget/'+widget_id; var ss = document.getElementsByTagName('script')[0]; ss.parentNode.insertBefore(s, ss);}if(d.readyState=='complete'){l();}else{if(w.attachEvent){w.attachEvent('onload',l);}else{w.addEventListener('load',l,false);}}})();</script> 
<!-- {/literal} END JIVOSITE CODE -->
	   <!--noindex--> 
	  <!--LiveInternet counter--><script type="text/javascript"><!-- document.write("<a href=\'http://www.liveinternet.ru/click\' "+ "target=_blank><img src=\'http://counter.yadro.ru/hit?t12.12;r"+ escape(document.referrer)+((typeof(screen)=="undefined")?"": ";s"+screen.width+"*"+screen.height+"*"+(screen.colorDepth? screen.colorDepth:screen.pixelDepth))+";u"+escape(document.URL)+ ";"+Math.random()+ "\' alt=\'\' title=\'LiveInternet: показано число просмотров за 24"+ " часа, посетителей за 24 часа и за сегодня\' "+ "border=\'0\' width=\'88\' height=\'31\'><\\/a>") //--></script><!--/LiveInternet-->  
	  

	<!-- Google.Analytics counter -->
<script>
  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
  })(window,document,'script','https://www.google-analytics.com/analytics.js','ga');

  ga('create', 'UA-100947367-1', 'auto');
  ga('send', 'pageview');

</script>
	<!-- /Google.Analytics counter -->
  
	<!--/noindex-->

  </div>
       <div class="clear_both"></div>
    </div>
  </div>
  <div class="f-bottom">
    <div class="center">
      <span class="pay-title">К оплате принимается:</span><img alt="pay" title="" src="/local/templates/index/images/pay.png">
      <div class="footer__info">
      <p>Вся информация на сайте – собственность интернет-магазина <a href="https://www.usatba-texno.ru/">usatba-texno.ru</a>.</p>
      <p>Все права защищены.</p>
      <p>Информация на сайте <a href="https://www.usatba-texno.ru/">usatba-texno.ru</a> не является публичной офертой. Указанные цены действуют только при оформлении заказа через интернет-магазин. Цены в пунктах выдачи заказов и розничных магазинах компании  могут отличаться от указанных на сайте.</p>
      <p>Вы принимаете условия <a href="/informatsiya/politika-konfeditsialnosti/">политики конфиденциальности</a> и <a href="/informatsiya/polzovatelskoe-soglashenie/">пользовательского соглашения</a> каждый раз, когда оставляете свои данные в любой форме обратной связи на сайте <a href="https://www.usatba-texno.ru/">usatba-texno.ru</a></p>
    </div>
    </div>
  </div>
</div>

<div class="popup-overlay"></div>
<div class="popup popup_buy">
  <div class="popup__close">×</div>
  <p class="popup__title">Добавление товара</p>
  <p class="popup__answer"></p>
  <span class="popup__button">Продолжить покупки</span>
  <a href="/personal/cart/" class="popup__button popup__button_right">Перейти в корзину</a>
</div>

<!-- Yandex.Metrika counter -->
<script type="text/javascript" >
   (function(m,e,t,r,i,k,a){m[i]=m[i]||function(){(m[i].a=m[i].a||[]).push(arguments)};
   m[i].l=1*new Date();k=e.createElement(t),a=e.getElementsByTagName(t)[0],k.async=1,k.src=r,a.parentNode.insertBefore(k,a)})
   (window, document, "script", "https://mc.yandex.ru/metrika/tag.js", "ym");

   ym(12655633, "init", {
        clickmap:true,
        trackLinks:true,
        accurateTrackBounce:true,
        webvisor:true,
        ecommerce:"dataLayer"
   });
</script>
<noscript><div><img src="https://mc.yandex.ru/watch/12655633" style="position:absolute; left:-9999px;" alt="" /></div></noscript>
<!-- /Yandex.Metrika counter -->

</body>
</html>