$(document).ready( function() {
  $('#ProfileId').keyup( function() {
    if( $(this).val().length > 1 ) {
      $.ajax( {
        type : 'GET',
        url : '/messages/get_users' ,
        data : 'q='+$(this).val() ,
        success : function(data) {
          $('#results_search').html(data);
        }
      });
    }
    else
      $('#results_search').html('');
  });
});