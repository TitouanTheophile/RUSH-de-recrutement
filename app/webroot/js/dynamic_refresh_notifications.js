$(document).ready( function() {

  get_notifications();
  setInterval(get_notifications, 3000);

  function get_notifications() {
    var url = $('input[name="get_notifications"]').val();
    $.ajax( {
      url : url,
      success : function(data) {
        $('#notifications_list').html(data);
      },
      error : function() {
        window.location.replace($('input[name="home"]').val());
      }
    });
  }


  get_notifications_count();
  if (!($('#notifications_count').html().length))
    $('#notifications_count').hide();
  else
    $('#notifications_count').show();
  setInterval(get_notifications_count, 3000);

  function get_notifications_count() {
    var url = $('input[name="get_notifications_count"]').val();
    $.ajax( {
      url : url,
      success : function(data) {
        $('#notifications_count').html(data);
        if (!($('#notifications_count').html().length))
          $('#notifications_count').hide();
        else
          $('#notifications_count').show();
      }
    });
  }
});