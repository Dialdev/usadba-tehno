$(function(){
	$('.registration-type__item').click(function(){
		if ($(this).val() == 1)
			$('.company-details').show().find('input,textarea').prop({disabled: false});
		else
			$('.company-details').hide().find('input,textarea').prop({disabled: true});
	});
	$('.registration-type__item:checked').click();

	$('.company-details-type__item').click(function(){
		$('.company-details-type__item_active').removeClass('company-details-type__item_active');
		$(this).addClass('company-details-type__item_active');
		if ($(this).index() == 0) {
			$('.company-details__file').show();
			$('.company-details__inputs').hide().find('input,textarea').prop({disabled: true});
		} else {
			$('.company-details__file').hide();
			$('.company-details__inputs').show().find('input,textarea').prop({disabled: false});
		}
	});
	$('.company-details-type__item:first').click();

});