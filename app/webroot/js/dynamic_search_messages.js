$(document).ready( function() {

  url = window.location.pathname + '/get_users';

  $('#ProfileId_messages').keyup( function() {
    if( $(this).val().length > 1 ) {
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
});