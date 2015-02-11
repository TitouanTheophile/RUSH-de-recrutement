$(document).ready( function() {
  var url = window.location.pathname;
  url = url.replace("view", "get_messages");
  get_messages();
  setInterval(get_messages, 3000);

  function get_messages() {
    console.log('in');
    $.ajax( {
      url : url,
      success : function(data) {
        $('#messages').html(data);
      }
    });
  }
});