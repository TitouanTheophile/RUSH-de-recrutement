$(document).ready(function() {
	update_menu();
	function update_menu() {
		if ($(document).width() < 1260) {
			if ($('#header_drop').length === 0) {
				$('<div>', {id: 'header_drop'}).appendTo($('#header'));
				$('div#header_menu').children().appendTo($('#header_drop'));
				$('<a>', {html: '≡', href: '#', class: 'menu_drop'}).appendTo($('#header_menu'));
				$('div#header_menu a.menu_drop').on('click', function(event) {
					event.preventDefault();
					event.stopPropagation();
					$(this).toggleClass('active');
					$('div#header_drop').toggle();
				});
			}
		}
		else {
			if ($('#header_drop').length !== 0) {
				$('div#header_menu').children().remove();
				$('div#header_drop').children().appendTo($('#header_menu'));
				$('div#header_drop').remove();
			}
		}
	}

	$(window).on('resize', update_menu);

	$('html').on('click', function() {
		$('div#header_menu a.menu_drop').removeClass('active');
		$('div#header_drop').hide();
	});
});