jQuery(document).ready(function ($) {

	var para_id;
	var hash = window.location.hash;
	$(hash).addClass('active');

	$('.rs-para').hover( 
		function() {
			
			para_id = '#' + $(this).attr('id');

			if (para_id != hash) {
				$(this).addClass('rs-active');
			}
			$(this).find('.rs-anchor').show();

		}, function() {

			para_id = '#' + $(this).attr('id');

			if (para_id != hash) {
				$(this).removeClass('rs-active');
			}
			$(this).find('.rs-anchor').hide();
		}
	);

	

});