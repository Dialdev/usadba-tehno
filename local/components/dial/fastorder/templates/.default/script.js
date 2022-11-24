$(function(){
	$(document)
		.on('click', '.fastorder-button', function(){
			$(this).next('.fastorder').fadeIn();
		})
		.on('click', '.fastorder__overlay,.fastorder__close', function(){
			$(this).parents('.fastorder').fadeOut();
		})
		.on('submit', '.fastorder__form', function(){
			$(this).after('<div class="fastorder__loader"></div>');
			form = $(this);
			msgbox = $(this).parents('.fastorder').find('.fastorder__message');
			data = {'ajax-fastorder': true};
			serialize = $(this).serializeArray();
			for (i in serialize)
				data[serialize[i].name] = serialize[i].value;
			$.post('', data, function(result){
				$('.fastorder__loader').remove();
				msgbox.empty();
				if (result.errors !== undefined) {
					for (i in result.errors)
						msgbox.append('<p class="fastorder__error">'+result.errors[i]+'</p>');
				} else if (result.success !== undefined) {
					for (i in result.success)
						msgbox.append('<p class="fastorder__success">'+result.success[i]+'</p>');
					form.hide();
				}
			}, 'json');
			return false;
		});
});