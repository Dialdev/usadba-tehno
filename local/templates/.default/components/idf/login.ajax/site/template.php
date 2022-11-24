<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) die();?>

<script type="text/javascript" src="/bitrix/components/idf/login.ajax/js/jquery.validate.min.js"></script>
<script type="text/javascript" src="/bitrix/components/idf/login.ajax/js/jquery.form.js"></script>

    <div id='content_login' class="b-popup-content_login">
        <div class='pop_content'>
        	<div class='result' id="loginResult"></div>
			<form name="loginForm" id="loginForm" method="post">
       
		        <div class='pop_element'>
		        	<input class="text" placeholder="<?=GetMessage('login')?>" type="text" name="login" value="">
		        </div>
		        
		        <div class='pop_element'>
  					<input class="text" placeholder="<?=GetMessage('password')?>" type="password" name="password" value="">
		        </div>

		        <div class='pop_wrap_button'>
		        	<input class="pop_button" value='Войти' type='submit'/>
		        </div>
		        <a class="pass-return" href="login/?forgot_password=yes&backurl=%2F">Забыли пароль?</a>	
	        </form>
	    </div>    
    </div>
