$(document).ready( function() {
  var url = window.location.pathname;

  url = url.replace("send", "get_messages");
  get_messages();
  $("#messages").animate({ scrollTop: $(window).height() }, 200);
  setInterval(get_messages, 3000);

  function get_messages() {

    $.ajax( {
      url : url,
      success : function(data) {
        $('#messages').html(data);
      }
    });
  }
});