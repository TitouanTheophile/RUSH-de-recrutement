$(document).ready(function() {


  $('#ProfileId').keyup( function() {
    if( $(this).val().length > 1 ) {
      url = '/users/get_users';
      $.ajax( {
        type : 'GET',
        url : url ,
        data : 'q='+$(this).val() ,
        success : function(data) {
          $('#results_search').html(data);
        }
      });
      url = '/groups/get_groups';
      $.ajax( {
        type : 'GET',
        url : url ,
        data : 'q='+$(this).val() ,
        success : function(data) {
          $('#results_search').append(data);
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