$(document).ready( function() {

	function triggerNotif(event) {
		event.stopPropagation();
    	$('#notifications_list').toggle();
    	$('#notifications').children().toggleClass('active');
	}
	
	$('#notifications').on('click', triggerNotif);
	$('#notifications_count').on('click', triggerNotif);

  	$('html').on('click', function() {
  		$('#notifications_list').hide();
  		$('#notifications span').removeClass('active');
  	});
});