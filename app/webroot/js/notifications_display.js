$(document).ready( function() {
  $('#notifications').on('click', function(event) {
  	event.stopPropagation();
    $('#notifications_list').toggle();
    $(this).children().toggleClass('active');
  });

  $('html').on('click', function() {
  	$('#notifications_list').hide();
  	$('#notifications span').removeClass('active');
  });
});