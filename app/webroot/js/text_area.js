
   	function textAreaAdjust()
	{
		var count = ($('.comment_area').val().match(/\n/g) || []).length;
		$('.comment_area').css('height', (20 + 15 * (count + Math.floor(($('.comment_area').val().length / 36)))) +'px');
	}

