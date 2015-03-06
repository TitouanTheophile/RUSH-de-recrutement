$(document).ready( function() {

  $('#ProfileId_messages').keyup( function() {
    if( $(this).val().length > 1 ) {
      url = window.location.pathname + '/searchUsersMessages';
      $.ajax( {
        type : 'GET',
        url : url ,
        data : 'q='+$(this).val() ,
        success : function(data) {
          $('#results_search_messages').html(data);
          $('#results_search_messages').css('border-color', 'black');
          $('#results_search_messages').css('border-style', 'solid');
        }
      });
    }
    else {
      $('#results_search_messages').html('');
      $('#results_search_messages').css('border-color', '');
      $('#results_search_messages').css('border-style', '');
    }
  });

  $('html').on('click', function() {
    $('#ProfileId_messages').val('');
    $('#results_search_messages').html('');
  });
  $('#ProfileId_messages').on('click', function(event) {
        event.stopPropagation();
  })
});