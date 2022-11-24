$(function(){

    var HeaderTop = $('.header-wrap').offset().top;

    if( $(window).scrollTop() > HeaderTop && screen.width < 666) {
            $('.header-wrap').css({position: 'fixed', top: '0px'});
        } else {
            $('.header-wrapu').css({position: 'relative', top: '0px'});
        }
    
    $(window).scroll(function(){
        if( $(window).scrollTop() > HeaderTop && screen.width < 666) {
            $('.header-wrap').css({position: 'fixed', top: '0px'});
        } else {
            $('.header-wrap').css({position: 'relative', top: '0px'});
        }
    });


		 $('.lb').lightBox();

	 	  $(".fb").fancybox({
		       padding: 0, //убираем отступ
		       helpers: {
		           overlay: {
		               locked: false // отключаем блокировку overlay
		                }
		            }
		   });
        $('.footer').find('a[href="/informatsiya/"]').siblings('ul').append('<li><a href="/local/templates/index/images/oferta.rtf" target="_blank">Договор оферты</a></li>');
		$(".fastorder__table .fastorder__phone").inputmask("+7 (999) 999-99-99");
		$(".popup-form #form_text_2").inputmask("+7 (999) 999-99-99");

		$("#sale_order_props #ORDER_PROP_3").inputmask("+7 (999) 999-99-99");
		$("#sale_order_props #ORDER_PROP_14").inputmask("+7 (999) 999-99-99");

		$('body').on('focus', "#sale_order_props #ORDER_PROP_14", function(){
			$("#sale_order_props #ORDER_PROP_14").inputmask("+7 (999) 999-99-99");
		});

		$('body').on('focus', "#sale_order_props #ORDER_PROP_3", function(){
			$("#sale_order_props #ORDER_PROP_3").inputmask("+7 (999) 999-99-99");
		});

		$('body').on('focus', ".registration-block_first input:nth-child(3)", function(){
			$(".registration-block_first input:nth-child(3)").inputmask("+7 (999) 999-99-99");
		});

		 $('.city-open').click(function(){
		 	$('.city-block').fadeIn();
		 });

		 $('.item_btns div').click(function(){
		    obj=$(this);
		    num=obj.index();
		    obj_s=$('.tab');
		    if (obj.hasClass('active')) {
		    return;
		    }
		    else {
		    $('.item_btns div').removeClass('active');
		    obj.addClass('active');
		    obj_s.hide();
		    obj_s.eq(num).toggle();
		    }
		  });

  	count=$('.slider-top .slide').length;
	   	$('.slider-top').append('<div id="click"></div>');
	   	for(i=0;i<count;i++) $('.slider-top #click').append('<div class="knob"><span></span></div>');
		$('#click div:first').addClass('active');

	var indervalID = setInterval(swap,4000);
  		$('.slider-top').hover(function(){clearInterval(indervalID);},function(){indervalID = setInterval(swap,4000);})


  	$('#click div').click(function(){
	 	if ($(this).hasClass('active')) return;
	   		id=$(this).index();
	 	$('#click .active').removeClass('active');
	 	$(this).addClass('active');
	 	$('.slider-top .slide').fadeOut();
	 	$('.slider-top .slide:eq('+id+')').fadeIn();
  	});

	function swap(){
	  next = $('#click .active').next();
	  if (next.length) { next.click(); } else { $('#click div:first').click(); }
	  };

	$('.btn-callback,.js-callback').click(function(){
    	$(this).toggleClass('open');
    	$('#callback-form').toggle();
    	$("body").append("<div id='overlay'></div>");
    	$('#overlay').show().css({'filter' : 'alpha(opacity=80)'});
    	return false;
  	});



	$(".popup-form .close").click(function(){
    	$(".popup-form").stop().fadeOut();
    	$('#overlay').remove('#overlay');
  	});

	if ($('.popup_success').length)
		$("body").append("<div id='overlay'></div>");
		$('#overlay').show().css({'filter' : 'alpha(opacity=80)'});
		$('.popup_success').show().delay(10000).fadeOut(function(){
			$('.popup_success').remove();
			$('#overlay').remove('#overlay');
		});

  	$('.btn-auth').click(function(){
    	$(this).toggleClass('open');
    	$('.auth-form').toggle();

    	return false;
  	});

	$(".auth-form .close").click(function(){
    	$(".auth-form").stop().fadeOut();
  	});

});

$(function(){

	$('#ctl_arrow_right').click(function(){
	  	if ($('#ctl_move').css('left')!='0px') return;
	  	width=$('#ctl_move').children('.item:first').width();
	  	$('#ctl_move').animate({'left':-width},1000,function(){
	    	$('#ctl_move').css('left','0px');
	    	$('#ctl_move .item:first').detach().appendTo('#ctl_move');
		});
	});

	$('#ctl_arrow_left').click(function(){
	  	if ($('#ctl_move').css('left')!='0px') return;
	   	width=$('#ctl_move').children('.item:last').width();
	  	$('#ctl_move').css('left',-width);
	  	$('#ctl_move .item:last').detach().prependTo('#ctl_move');
	  	$('#ctl_move').animate({'left':'0px'},1000);
	});

});

setInterval(gallclick1,8000);
function gallclick1(){
  $('#ctl_arrow_right').click();
}

$(function(){

	$('#ctl_arrow_right_top').click(function(){
	  if ($('#ctl_move_top').css('left')!='0px') return;
	  width=$('#ctl_move_top').children('.item:first').width();
	  $('#ctl_move_top').animate({'left':-width-13},1000,function(){
	    $('#ctl_move_top').css('left','0px');
	    $('#ctl_move_top .item:first').detach().appendTo('#ctl_move_top');
	});
	});

	$('#ctl_arrow_left_top').click(function(){
	  if ($('#ctl_move_top').css('left')!='0px') return;
	   width=$('#ctl_move_top').children('.item:last').width();
	  $('#ctl_move_top').css('left',-width-13);
	  $('#ctl_move_top .item:last').detach().prependTo('#ctl_move_top');
	  $('#ctl_move_top').animate({'left':'0px'},1000);
	});

	$('#ctl_arrow_right_sert').click(function(){
		if ($('#ctl_move_sert').css('left')!='0px') return;
		width=$('#ctl_move_sert').children('.item_sert:first').width();
		$('#ctl_move_sert').animate({'left':-width},1000,function(){
		  $('#ctl_move_sert').css('left','0px');
		  $('#ctl_move_sert .item_sert:first').detach().appendTo('#ctl_move_sert');
	  });
	  });
  
	  $('#ctl_arrow_left_sert').click(function(){
		if ($('#ctl_move_sert').css('left')!='0px') return;
		 width=$('#ctl_move_sert').children('.item_sert:last').width();
		$('#ctl_move_sert').css('left',-width);
		$('#ctl_move_sert .item_sert:last').detach().prependTo('#ctl_move_sert');
		$('#ctl_move_sert').animate({'left':'0px'},1000);
	  });

});
setInterval(gallclick2,8000);
function gallclick2(){
  $('#ctl_arrow_right_top').click();
}

setInterval(gallclick4,7000);
function gallclick4(){
  $('#ctl_arrow_right_sert').click();
}

$(function(){

	$('#ctl_arrow_right_stock').click(function(){
	  if ($('#ctl_move_stock').css('left')!='0px') return;
	  width=$('#ctl_move_stock').children('.item:first').width();
	  $('#ctl_move_stock').animate({'left':-width-13},1000,function(){
	    $('#ctl_move_stock').css('left','0px');
	    $('#ctl_move_stock .item:first').detach().appendTo('#ctl_move_stock');
	});
	});

	$('#ctl_arrow_left_stock').click(function(){
	  if ($('#ctl_move_stock').css('left')!='0px') return;
	   width=$('#ctl_move_stock').children('.item:last').width();
	  $('#ctl_move_stock').css('left',-width-13);
	  $('#ctl_move_stock .item:last').detach().prependTo('#ctl_move_stock');
	  $('#ctl_move_stock').animate({'left':'0px'},1000);
	});

});
setInterval(gallclick3,8000);
function gallclick3(){
  $('#ctl_arrow_right_stock').click();
}



var sku_tree = {};

$(function(){
	$('.product-item').each(function(){
		$(this).find('.select__item').first().click();
	});

	$('.product-images__item').click(function(){
		$('.product-images__item_active').removeClass('product-images__item_active');
		src = $(this).addClass('product-images__item_active').data('src');
		$('.product-images__image').attr('src', src).parent().attr('href', src);

		$('.zooming').zoom();
		console.log($('.zooming img[role=presentation]'));
		$('.zooming img[role=presentation]').remove();
	});

	$('.product-item__button_buy').click(function(){
		count = parseInt($('.small-basket__red').text()) + 1;
		$('.small-basket__red').text(count + declOfNum(count, [" товар", " товара", " товаров"]));
		$.get("/catalog/add2basket.php", {"id": $(this).parents('.product-item').attr('data-id'), "quantity": $(this).parents('.product-item').attr('data-ratio')}, function(answer){
			$('.popup_buy .popup__answer').text(answer);
			$('.popup_buy,.popup-overlay').fadeIn();
		});
	});

	$('.product__button_buy').click(function(){

		if ($('.product-quantity__input').val() > 1) count = parseInt($('.small-basket__red').text()) + parseInt($('.product-quantity__input').val());
		else count = parseInt($('.small-basket__red').text()) + 1;

		//var price;
		// var cur_price = $('.info .price b').html();
		// 	cur_price = cur_price.replace(/\s+/g, "");
		// var cur_price_num = parseInt(cur_price);
		// if (count > 1) price = cur_price_num * count;
		
		$('.small-basket__red').text(count + declOfNum(count, [" товар", " товара", " товаров"]));
		//$('.small-basket__price').text(price + ' руб.');

		//console.log($('.small-basket__price').text());
		console.log($('.product-quantity__input').val());
		$.get("", {"action": "ADD2BASKET", "ajax_basket": "Y", "id": $(this).parents('.product').attr('data-id'), "quantity": $('.product-quantity__input').val()}, function(answer){
			//answer = JSON.parse(answer.replace(/'/g, '"'));
			$('.popup_buy .popup__answer').text(answer.MESSAGE);
			$('.popup_buy,.popup-overlay').fadeIn();
			BX.onCustomEvent('OnBasketChange');
		});
		//Запрос для обновления малой корзины
		$.get($('.product-quantity__input').attr('href'), {'AJAX_PAGE': 'Y'}, function (data) {
			var ab = $('.small-basket__attributes').html(data);
			//console.log(ab);
		});
	});

	$('.popup_buy .popup__button:first').click(function(){
		$('.popup,.popup-overlay').fadeOut();
	});
	$('.popup__close').click(function(){
		$('.popup,.popup-overlay').fadeOut();
	});

	$(".popup-overlay").on('click', function (e) {
		if (e.target == this) $(".popup, .popup-overlay").fadeOut('fast');
	})

	$ul_height = Math.ceil($('.brand-page__item').length / 10);

	$('.brands-more').click(function(){
		/*if($(window).width() <= 480) {
			if ($('.brands-more').hasClass('brands-show')) {
				$('.brands').animate({height: "171px"}, 500 );
				$('.brands ul').animate({height: "70px"}, 500 );
				$('.brands-more').removeClass('brands-show');
			} else {
				$('.brands').animate({height: ($ul_height*35) + 101}, 500 );
				$('.brands ul').animate({height: $ul_height*35}, 500 );
				$('.brands-more').addClass('brands-show');
			}
		} else {
			if ($('.brands-more').hasClass('brands-show')) {
				$('.brands').animate({height: "160px"}, 500 );
				$('.brands ul').animate({height: "70px"}, 500 );
				$('.brands-more').removeClass('brands-show');
			} else {
				$('.brands').animate({height: ($ul_height*35) + 90}, 500 );
				$('.brands ul').animate({height: $ul_height*35}, 500 );
				$('.brands-more').addClass('brands-show');
			}
		}*/
		$('.brand-page, .brands').toggleClass('_open');
	});
	$('.product-quantity__input').bind('input propertychange', function(){
                if ($('.item-page-guantity').length > 0) {
                    max = parseInt($('.item-page-guantity').text());
                } else {
                    max = parseInt($(this).parent().parent().prev().prev().text());
                }
                if ($(this).val() > max) {
                    $(this).val(max).trigger('change');

                }
        })
	 $('.product-quantity__minus').click(function(){
                input = $(this).next();
                count = parseInt(input.val()) - 1;
                if (count < 1) count = 1;
                input.val(count).trigger('propertychange');

        });

        $('.product-quantity__input').change(function(){
                count = parseInt($(this).val());
                if ((count < 1) || isNaN(count)) count = 1;
                $(this).val(count);

        });
        $('.product-quantity__plus').click(function(){
                input = $(this).prev();
                count = parseInt(input.val()) + 1;
                input.val(count).trigger('propertychange');

        });

        $('.catalog-sort__input').click(function(){
        	$('.catalog-sort__options').slideToggle('fast');
        });

        $("#company_file").change(function(){
        	$('.company-details__file label').html($(this).val());
		});
		$( "body" ).on( "submit", "#callback-form form", function() {
				yaCounter12655633.reachGoal('zakazat_zvonok');
				console.log("zakazat_zvonok ok");
		});
		$( "body" ).on( "click", "input[name='register_submit_button']", function() {
				yaCounter12655633.reachGoal('vhod');
				console.log("vhod ok");
		});
		$( "body" ).on( "click", ".product__button_buy", function() {
				yaCounter12655633.reachGoal('dobavit_v_korzinu');
				console.log("dobavit_v_korzinu ok");
		});
		$( "body" ).on( "click", "#basket_form .checkout", function() {
				yaCounter12655633.reachGoal('zakaz_v_korzine');
				console.log("zakaz_v_korzine ok");
		});
		$( "body" ).on( "click", "#ORDER_FORM .checkout", function() {
				yaCounter12655633.reachGoal('oformlenir_zakaza');
				console.log("oformlenir_zakaza ok");
		});



});

function declOfNum(number, titles){
	cases = [2, 0, 1, 1, 1, 2];
	return titles[(number % 100 > 4 && number % 100 < 20)? 2 : cases[(number % 10 < 5)? number % 10 : 5]];
}

/*заменяем сылку*/
$(function(){
    $("#bx_3218110189_11617").attr("href","https://www.usatba-texno.ru/catalog/kvadrotsikly/");
	$("#bx_3218110189_11658").attr("href","https://www.usatba-texno.ru/catalog/generatory/");
	$("#bx_3218110189_11659").attr("href","https://www.usatba-texno.ru/catalog/moyki/");



	  function up() {
		 var scroll = $(window).scrollTop();
		 if (scroll > 150) {
			 $(".up-button").addClass("_active");
			 if  (scroll == $(document).height() - $(window).height()) {
				 $(".up-button").addClass("_bottom");
			 } else {
				 $(".up-button").removeClass("_bottom");
			 }
		 } else {
			 $(".up-button").removeClass("_active");
		 }
     }
	up();
    // Swimming Logo
    $(window).scroll(function() {
		up();
    });
	$('.up-button').click(function(){
		 $('html,body').animate({'scrollTop' : 0}, 300);
	});
});

$(function(){
	/* Адаптивное меню */
	$('.mobile-menu-btn').click(function(){
        if($(".header-wrap").hasClass("_open")){
            $('.header-wrap').css('overflow' ,'hidden').animate({height : '180px' }, 700);
        }else{
            let el = $('.header-wrap'),
            curHeight = el.height(),
            autoHeight = el.css('height', 'auto').height();
            el.height(curHeight).animate({height: autoHeight}, 700, function(){
                el.css('overflow','scroll');
                el.css('height','100%');
            });
        }
		$(this).toggleClass('_open');
		$('.header-wrap').toggleClass('_open');
        
	});

	/* Сайдбар в каталоге */
	$('.mobile-filter').click(function(){
		$('.menu-catalog').toggleClass('_open');
	});

	/* Таблицы в контенте */
	$('.news-detail table').each(function(){
		$(this).wrap('<div class="adaptive-table"></div>');
	});
});
