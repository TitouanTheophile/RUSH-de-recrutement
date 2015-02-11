function textAreaAdjust(o) {
	$('.comment_area').css('height', '22px');
	$('.post_button').css('top', '45px');
	$('.comment_area').css('height',0.5+ o.scrollHeight+'px');
	$('.post_button').css('top', 11 + o.scrollHeight+'px');
}
