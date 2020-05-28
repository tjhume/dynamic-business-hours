jQuery(document).ready(function($){
	$('.dbh-admin.daily .radios').each(function(){
		$(this).on('click', function(){
			var day = $(this).attr('data-day');
			if($(this).find('.different-times').is(':checked')){
				$('.dbh_' + day + '_typical_open select').removeAttr('disabled', 'disabled');
				$('.dbh_' + day + '_typical_close select').removeAttr('disabled', 'disabled');
			}else{
				$('.dbh_' + day + '_typical_open select').attr('disabled', 'disabled');
				$('.dbh_' + day + '_typical_close select').attr('disabled', 'disabled');
			}
		});
	});
	$('.dbh-admin.daily .radios').click();
});