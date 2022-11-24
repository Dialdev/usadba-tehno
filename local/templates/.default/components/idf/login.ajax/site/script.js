function PopUpShowLogin(){
    $("#popup1_login").show();
}
function PopUpHideLogin(){
    $("#popup1_login").hide();
    $("#loginForm").validate().resetForm();
}

$(function(){
  $(document).click(function(event) {
   /* if ($(event.target).closest("#content_login").length) return;
    PopUpHideLogin();
    event.stopPropagation();*/
  });
});


$(document).ready(function(){

   $("#loginForm").validate({
    rules: {
      login: {
        required: true,
      },
      password: {
        required: true,
      },
    },
    messages: {
      login: {
        required: "Введите логин",
      },
      password: {
        required: "Введите пароль"
      }
    },
    //Обработчик и отправка данных
    submitHandler: function(){
        $('#loginForm').ajaxSubmit({
        	url: '/bitrix/components/idf/login.ajax/login.php',
            target: '#loginResult', 
            success: function(data) {  
                console.log(data);
                if (data == 'ok') 
                {
	                PopUpHideLogin();
	                location.reload();
                  // $('#login_ok_hide').hide(); 
                  // $('#login_ok_show').show(); 
            	};
            } 
        }); 
    }
  }); 

});



