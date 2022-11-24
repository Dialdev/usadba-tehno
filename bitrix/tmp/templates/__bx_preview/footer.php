</div>
  <div class="wrapper-footer"></div>
</div>
<div class="footer">
  <div class="f-top">
    <div class="center">
      <div class="subscribe">
        <span class="title">Подпишитесь! Новинки, скидки, предложения!</span>
       <?$APPLICATION->IncludeComponent(
      	"bitrix:subscribe.form", 
      	"site", 
      	array(
      		"CACHE_TIME" => "3600",
      		"CACHE_TYPE" => "A",
      		"COMPONENT_TEMPLATE" => "site",
      		"PAGE" => "#SITE_DIR#personal/subscribe/subscr_edit.php",
      		"SHOW_HIDDEN" => "N",
      		"USE_PERSONALIZATION" => "Y"
      	),
      	false
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

     <!-- <ul class="catalog-menu">
        <li><a href="">Мотоблоки</a></li>
        <li><a href="">Мотокультиваторы</a></li>
        <li><a href="">Двигатели</a></li>
        <li><a href="">Скутеры</a></li>
        <li><a href="">Мотоциклы</a></li>
        <li><a href="">Электросамокаты</a></li>
        <li><a href="">Измельчители</a></li>
      </ul>
      <ul class="catalog-menu">
        <li><a href="">Мопеды</a></li>
        <li><a href="">Квадроциклы</a></li>
        <li><a href="">Снегоходы</a></li>
        <li><a href="">Мойки</a></li>
        <li><a href="">Бензопилы</a></li>
        <li><a href="">Электропилы</a></li>
        <li><a href="">Воздуховки</a></li>
      </ul>
      <ul class="catalog-menu">
        <li><a href="">Газонокосилки</a></li>
        <li><a href="">Триммеры</a></li>
        <li><a href="">Снегоуборщики</a></li>
        <li><a href="">Генераторы</a></li>
        <li><a href="">Сварочные аппараты</a></li>
        <li><a href="">Насосы</a></li>
        <li><a href="">Ножницы садовые</a></li>
      </ul>
      <ul class="catalog-menu">
        <li><a href="">Велогибриды</a></li>
        <li><a href="">Мотопомпы</a></li>
        <li><a href="">Бензорезы</a></li>
        <li><a href="">Мотобуры</a></li>
        <li><a href="">Сопутствующие</a></li>
        <li><a href="">Запчасти</a></li>
      </ul> -->
      <?$APPLICATION->IncludeComponent("bitrix:menu", "menu", array(
            "ROOT_MENU_TYPE" => "bottom",
            "MENU_CACHE_TYPE" => "Y",
            "MENU_CACHE_TIME" => "36000000",
            "MENU_CACHE_USE_GROUPS" => "Y",
            "MENU_CACHE_GET_VARS" => array(
            ),
            "MAX_LEVEL" => "1",
            "CHILD_MENU_TYPE" => "submenu",
            "USE_EXT" => "N",
            "DELAY" => "N",
            "ALLOW_MULTI_SELECT" => "N"
            ),
            false
          );?>
      <?$APPLICATION->IncludeComponent("bitrix:menu", "menu", array(
            "ROOT_MENU_TYPE" => "bottom2",
            "MENU_CACHE_TYPE" => "Y",
            "MENU_CACHE_TIME" => "36000000",
            "MENU_CACHE_USE_GROUPS" => "Y",
            "MENU_CACHE_GET_VARS" => array(
            ),
            "MAX_LEVEL" => "1",
            "CHILD_MENU_TYPE" => "submenu",
            "USE_EXT" => "N",
            "DELAY" => "N",
            "ALLOW_MULTI_SELECT" => "N"
            ),
            false
          );?>
      <div class="foter_rith">
      <span class="copyright">©2009 - <?=date("Y");?> ТД "Усадьба-Техно"<br></span>
      <span class="adres_futer">ул.Демидовская плотина, 13<br><a href="tel:+74872425812"><span>+7 (4872)</span> 42-58-12</a><br>      

          ул .Одоевское шоссе, 30<br><a href="tel:+74872376746"><span>+7 (4872)</span> 37-67-46</a>     



      </span>
      <span class="dial">Создание и продвижение сайта<br><a target="_blank" href="http://dialweb.ru/">Digital Agency Dial</a></span>
	  
	  <p><a href="/local/templates/index/images/oferta.rtf" target="_blank" style="color:#4d4d4d;">Договор оферты</a></p>
	  <!--noindex--> 
	  <!--Rating@Mail.ru counter--> <script language="javascript" type="text/javascript"><!-- d=document;var a=\'\';a+=\';r=\'+escape(d.referrer);js=10;//--></script> 
	  <script language="javascript1.1" type="text/javascript"><!-- a+=\';j=\'+navigator.javaEnabled();js=11;//--></script> 
	  <script language="javascript1.2" type="text/javascript"><!-- s=screen;a+=\';s=\'+s.width+\'*\'+s.height; a+=\';d=\'+(s.colorDepth?s.colorDepth:s.pixelDepth);js=12;//--></script> 
	  <script language="javascript1.3" type="text/javascript"><!-- js=13;//--></script>
	  <script language="javascript" type="text/javascript"><!-- d.write(\'<a href="http://top.mail.ru/jump?from=1633321" target="_top">\'+ \'<img src="http://dc.ce.b8.a1.top.mail.ru/counter?id=1633321;t=57;js=\'+js+ a+\';rand=\'+Math.random()+\'" alt="Рейтинг@Mail.ru" border="0" \'+ \'height="31" width="88"><\\/a>\');if(11<js)d.write(\'<\'+\'!-- \');//--></script> <noscript><a target="_top" href="http://top.mail.ru/jump?from=1633321"> <img src="http://dc.ce.b8.a1.top.mail.ru/counter?js=na;id=1633321;t=57"  height="31" width="88" border="0" alt="Рейтинг@Mail.ru"></a></noscript> <script language="javascript" type="text/javascript"><!-- if(11<js)d.write(\'--\'+\'>\');//--></script> <!--// Rating@Mail.ru counter-->  <!-- begin of Top100 logo --> <a href="http://top100.rambler.ru/home?id=1747052"><img src="https://scounter.rambler.ru/img/top100/banner-88x31-rambler-blue3.gif" alt="Rambler\'s Top100" width="88" height="31" border="0" /></a> <!-- end of Top100 logo -->  <!--LiveInternet counter--><script type="text/javascript"><!-- document.write("<a href=\'http://www.liveinternet.ru/click\' "+ "target=_blank><img src=\'http://counter.yadro.ru/hit?t12.12;r"+ escape(document.referrer)+((typeof(screen)=="undefined")?"": ";s"+screen.width+"*"+screen.height+"*"+(screen.colorDepth? screen.colorDepth:screen.pixelDepth))+";u"+escape(document.URL)+ ";"+Math.random()+ "\' alt=\'\' title=\'LiveInternet: показано число просмотров за 24"+ " часа, посетителей за 24 часа и за сегодня\' "+ "border=\'0\' width=\'88\' height=\'31\'><\\/a>") //--></script><!--/LiveInternet-->  <!-- Yandex.Metrika counter --> <script type="text/javascript"> (function (d, w, c) {     (w[c] = w[c] || []).push(function() {         try {             w.yaCounter12655633 = new Ya.Metrika({id:12655633,                     webvisor:true,                     clickmap:true,                     trackLinks:true,                     accurateTrackBounce:true});         } catch(e) { }     });      var n = d.getElementsByTagName("script")[0],         s = d.createElement("script"),         f = function () { n.parentNode.insertBefore(s, n); };     s.type = "text/javascript";     s.async = true;     s.src = (d.location.protocol == "https:" ? "https:" : "http:") + "//mc.yandex.ru/metrika/watch.js";      if (w.opera == "[object Opera]") {         d.addEventListener("DOMContentLoaded", f, false);     } else { f(); } })(document, window, "yandex_metrika_callbacks"); </script> <noscript><div><img src="//mc.yandex.ru/watch/12655633" style="position:absolute; left:-9999px;" alt="" /></div></noscript> <!-- /Yandex.Metrika counter --> 

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
    </div>
    <div class="clear_both"></div>
  </div>
  <div class="f-bottom">
    <div class="center">
      <span class="pay-title">К оплате принимается:</span><img alt="" title="" src="/local/templates/index/images/pay.png">
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
<!-- BEGIN JIVOSITE CODE {literal} --> 
<script type='text/javascript'> 
(function(){ var widget_id = 'voz56Yr0xQ';var d=document;var w=window;function l(){ 
var s = document.createElement('script'); s.type = 'text/javascript'; s.async = true; s.src = '//code.jivosite.com/script/widget/'+widget_id; var ss = document.getElementsByTagName('script')[0]; ss.parentNode.insertBefore(s, ss);}if(d.readyState=='complete'){l();}else{if(w.attachEvent){w.attachEvent('onload',l);}else{w.addEventListener('load',l,false);}}})();</script> 
<!-- {/literal} END JIVOSITE CODE -->
</body>
</html>