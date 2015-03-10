$(document).ready(function() {
  
  $('#ProfileId').keyup( function() {
    if ($(this).val().length > 1) {
    var url1 = $('input[name="getUsers"]').val() + '?q=';
    var url2 = $('input[name="getGroups"]').val() + '?q=';
      $.when(getResults(url1, $(this).val()),
             getResults(url2, $(this).val())
            ).done(function(users, groups) {
                var data = users[0] + groups[0];
                $('#results_search').html(data);
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

  $('#ProfileId').on('click', function(event) {
        event.stopPropagation();
  })
 
var getResults = function(url, query) {
    var url = url + query;
    return $.get(url);
};

});