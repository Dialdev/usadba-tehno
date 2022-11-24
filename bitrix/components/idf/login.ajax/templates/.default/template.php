<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) die();?>

<script type="text/javascript" src="/bitrix/components/idf/login.ajax/js/jquery.validate.min.js"></script>
<script type="text/javascript" src="/bitrix/components/idf/login.ajax/js/jquery.form.js"></script>


    <div id='content_login' class="b-popup-content_login">
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
