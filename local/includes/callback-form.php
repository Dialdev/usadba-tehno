<div id="callback-form" class="popup-form">
				<span class="close">X</span>
				<span class="h2" style="font-size: 22px;">Заказать обратный звонок</span>
				<?$APPLICATION->IncludeComponent("bitrix:form.result.new","callback",Array("WEB_FORM_ID" => 1, "LIST_URL" => ""));?>
			</div>
			<?if (($_GET['formresult']=='addok') && ($_GET['WEB_FORM_ID']=='1')):?> 
			<script>history.pushState(null, null, window.location.href.replace("&formresult=addok", ""));</script>
			<div class="popup-form popup_success">
			<span class="close">X</span>
			<h2>спасибо, ваша заявка принята</h2>

			<p>Ваша заявка отправлена, в ближайшее время<br>
			наши менеджеры свяжутся с Вами.</p>
			<p>БЛАГОДАРИМ ВАС ЗА ОБРАЩЕНИЕ!</p>
			</div>
			<?endif?>
			