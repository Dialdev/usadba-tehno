<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) die();?>

<script type="text/javascript" src="/bitrix/components/idf/login.ajax/js/jquery.validate.min.js"></script>
<script type="text/javascript" src="/bitrix/components/idf/login.ajax/js/jquery.form.js"></script>

<div> 
	<?
	if (!$USER->IsAuthorized()):?>
		<a id='login_ok_hide' href="javascript:PopUpShowLogin()"><?=GetMessage('enter');?></a>  
		<span style='display:none' id='login_ok_show'><a href="<?=$arParams['personal_link']?>"><?=GetMessage('kabinet')?></a>&nbsp; [<a href="?logout=yes"><?=GetMessage('logout')?></a>]</span>   
	<?else:?>	
		<a href="<?=$arParams['personal_link']?>"><?=GetMessage('kabinet')?></a>&nbsp; [<a href="?logout=yes"><?=GetMessage('logout')?></a>]   
	<?endif;?>	
</div>

<div class="b-popup_login" id="popup1_login" style="display: none;">
    <div id='content_login' class="b-popup-content_login">
        <div class='pop_pic'>
        	<a href="javascript:PopUpHideLogin()"> <img src="/bitrix/components/idf/login.ajax/img/close_popup.png"></a>
       	</div>
        <div class='pop_title'>	
        	<h1> <?=GetMessage('enter2')?> </h1>
        </div>
        <div class='pop_content'>
        	<div class='result' id="loginResult"></div>
			<form name="loginForm" id="loginForm" method="post">
       
		        <div class='pop_element'>
		        	<div><label class="lab" for="login"><?=GetMessage('login')?> </label> </div>
		        	<div><input type="text" name="login" value=""></div>
		        </div>
		        
		        <div class='pop_element'>
		        	<div><label class="lab" for="password"><?=GetMessage('password')?> </label></div>
  					<div><input type="password" name="password" value=""></div>
		        </div>

		        <div class='pop_wrap_button'>
		        	<input class="pop_button" value='<?=GetMessage('send')?>' type='submit'/>
		        </div>	
	        </form>
	    </div>    
    </div>
</div>