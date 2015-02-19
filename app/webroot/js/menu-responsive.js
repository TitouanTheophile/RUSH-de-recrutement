$(document).ready(function() {

	$(window).on('resize', function() {
		if ($(document).width() < 1240) {
			if ($('#header_drop').length === 0) {
				$('<div>', {id: 'header_drop'}).appendTo($('#header'));
				$('div#header_menu').children().appendTo($('#header_drop'));
				$('<a>', {html: '≡', href: '#', class: 'menu_drop'}).appendTo($('#header_menu'));
				$('div#header_menu a.menu_drop').on('click', function() {
					event.preventDefault();
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
	});

});