$(document).ready( function() {
  $('#notifications').on('click', function(event) {
  	event.stopPropagation();
    $('#notifications_list').toggle();
  });

  $('html').on('click', function() {
  	$('#notifications_list').hide();
  });
});