var product_tree = {};

$(function(){
	/*$('.product__button_buy').click(function(){
		count = parseInt($('.small-basket__red').text()) + 1;
		$('.small-basket__red').text(count + declOfNum(count, [" товар", " товара", " товаров"]));
		$.get("", {"action": "ADD2BASKET", "ajax_basket": "Y", "id": $(this).parents('.product').attr('data-id'), "quantity": $('.product-quantity__input').val()}, function(answer){
			answer = JSON.parse(answer.replace(/'/g, '"'));
			$('.popup_buy .popup__answer').text(answer.MESSAGE);
			$('.popup_buy,.popup-overlay').fadeIn();
		});
	});
	$('.popup_buy .popup__button:first').click(function(){
		$('.popup,.popup-overlay').fadeOut();
	});*/
});

function declOfNum(number, titles){  
	cases = [2, 0, 1, 1, 1, 2];
	return titles[(number % 100 > 4 && number % 100 < 20)? 2 : cases[(number % 10 < 5)? number % 10 : 5]];
}

$(document).ready(function(){
	$('.zooming').zoom();

	$('.btn-delivery').click(function(){
		$(this).toggleClass('open');
		$('.popup_delivery').toggle();
		/*$("body").append("<div id='overlay'></div>");
		$('#overlay').show().css({'filter' : 'alpha(opacity=80)'});*/
		$('.popup-overlay').fadeIn();
		return false;
	});

	$(".popup_delivery .close").click(function(){
		$(".popup_delivery").stop().fadeOut();
		$('.popup-overlay').fadeOut();
	});


	$('.product__control').click(function () {
		$input = $(this).parent().find('.product__input');
		$value = $input.val();
		if ($(this).hasClass('_minus') & $value != 0) {
			$value--;
			if ($value>0) $input.val($value);
		} else if ($(this).hasClass('_plus')) {
			$value++;
			$input.val($value);
		}
	});

});


