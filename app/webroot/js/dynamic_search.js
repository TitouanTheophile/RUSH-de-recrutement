$(document).ready( function() {
  url = window.location.pathname + '/get_users';
  $('#ProfileId').keyup( function() {
    if( $(this).val().length > 1 ) {
      $.ajax( {
        type : 'GET',
        url : url ,
        data : 'q='+$(this).val() ,
        success : function(data) {
          $('#results_search').html(data);
          $('#results_search').css('border-color', 'black');
          $('#results_search').css('border-style', 'solid');
        }
      });
    }
    else {
      $('#results_search').html('');
      $('#results_search').css('border-color', '');
      $('#results_search').css('border-style', '');
    }
  });
});