$(document).ready(function() {


  url = '/users/get_users';
  $('#ProfileId').keyup( function() {
    if( $(this).val().length > 1 ) {
      $.ajax( {
        type : 'GET',
        url : url ,
        data : 'q='+$(this).val() ,
        success : function(data) {
          $('#results_search').html(data);
        }
      });
    }
    else {
      $('#results_search').html('');
    }
  });

  $('html').on('click', function() {
    $('#ProfileId').val('');
    $('#results_search').html('');
  });

  $('#ProfileId').on('click', function() {
        event.stopPropagation();
  })
});