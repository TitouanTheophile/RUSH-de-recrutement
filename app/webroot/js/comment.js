$(document).ready(function(){
    $(".comment_button").on("click", function(){
     var url = window.location.pathname;
      url = url.substr(0, url.indexOf('users', 0));
      url = url.concat('Comments/postComment/');
      var id = $(this).val();
      var comment_area = $(this).parent().parent().parent();
      jQuery.ajax({   
        url     : url,
        type    : "POST",
        cache   : false,
        data    : "data[Comment][content_id]=" + id + "&data[Comment][content]=" + $(this).prev().val(),
        success : function()
        {
            url = url.replace("post", "get");
            url = url.concat(id);
            url = url.concat("/true");
            jQuery.ajax({
                url     : url,
                success : function(data)
                {
                   $('.post_comment').html(data);
                }
            });
        }
    });
  });
});
      $(function() {
        var txt = $('.common'),
        hiddenDiv = $(document.createElement('div')),
        content = null;

        txt.addClass('txtstuff');
        hiddenDiv.addClass('hiddendiv common');
        $('.comment_area').append(hiddenDiv);
        txt.on('keyup', function () {
          $(this).val($(this).val().replace(/<script>/g, "%thisisatmpstr") );
            content = $(this).val();
            $(this).val($(this).val().replace(/%thisisatmpstr/g, "<script>") );
            content = content.replace(/\n/g, '<br>');
            hiddenDiv.html(content + '<br class="lbr">');
            $(this).css('height', hiddenDiv.height());
            console.log(hiddenDiv.height());
        });
    });

