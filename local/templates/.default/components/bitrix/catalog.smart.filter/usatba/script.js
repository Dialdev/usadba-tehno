$(function(){
	var filter_waiting = false, filter_timer;
	function filter_change() {
		filter_waiting = true;
		data = {};
		data['ajax'] = "y";
		serialize = $('.filter').serializeArray();
		for (i in serialize)
			if (serialize[i].value != '')
				data[serialize[i].name] = serialize[i].value;
		BX.ajax.loadJSON(location.href, data, function(result) {
			$('.filter__submit').text('Показать ('+result.ELEMENT_COUNT+')').data('url', result.SEF_SET_FILTER_URL);
			filter_waiting = false;
			for (i in result.ITEMS)
				for (j in result.ITEMS[i].VALUES)
					if (result.ITEMS[i].VALUES[j].DISABLED)
						$('#'+result.ITEMS[i].VALUES[j].CONTROL_ID).prop('disabled', true);
					else
						$('#'+result.ITEMS[i].VALUES[j].CONTROL_ID).prop('disabled', false);
		});
	}

	$('.filter').on('change', '.filter__checkbox', filter_change);
	$('.filter').on('keyup', '.filter__input', function(){
		filter_waiting = true;
		clearTimeout(filter_timer);
		filter_timer = setTimeout(filter_change, 500);
	});
	$('.filter__submit').click(function(){
		if (!filter_waiting)
			location.href = $(this).data('url');
		return false;
	});

	$("#slider_price").slider({
		range: true,
		min: $('.filter__input_min').val(),
		max: $('.filter__input_max').val(),
		slide: function( event, ui ) {
			//Поле минимального значения
			$( "#price_min" ).val(ui.values[0]);
			//Поле максимального значения
			$("#price_max").val(ui.values[1]);			},
		stop: function( event, ui ) {
			formAjax();
		}
	});

	$("#price_min" ).val($("#slider_price").slider( "values", 0 ));
	$("#price_max").val($("#slider_price").slider( "values", 1 ));

});