$(document).ready( function() {
  get_notifications_count();
  setInterval(get_notifications_count, 3000);
  get_notifications();
  setInterval(get_notifications, 3000);

  function get_notifications() {
    var url = $('input[name="getNotifications"]').val();
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

  function get_notifications_count() {
    var url = $('input[name="getNotificationsCount"]').val();
    $.ajax( {
      url : url,
      success : function(data) {
        $('#notifications_count').html(data);
        if (!($('#notifications_count').html().length))
          $('#notifications_count').css('display', 'none');
        else
          $('#notifications_count').css('display', 'inline-block');
      }
    });
  }
});