$(document).ready( function() {

  get_notifications();
  setInterval(get_notifications, 3000);

  function get_notifications() {
    var url = '/notifications/get_notifications';
    $.ajax( {
      url : url,
      success : function(data) {
        $('#notifications_list').html(data);
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
    var url = '/notifications/get_notifications_count';
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