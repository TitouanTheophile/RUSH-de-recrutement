$(document).ready(function() {
	update_menu();

	function change(parent, child, parent_link, parent_text) {
		$('<div>', {id: child}).appendTo($('#header'));
		$('div#' + parent).children().appendTo($('#' + child));
		$('<a>', {html: parent_text, href: '#', class: parent_link}).appendTo($('#' + parent));
		$('div#' + parent + ' a.' + parent_link).on('click', function(event) {
			event.preventDefault();
			event.stopPropagation();
			$(this).toggleClass('active');
			$('div#' + child).toggle();
		});
	}

	function restore(parent, child) {
		$('div#' + parent).children().remove();
		$('div#' + child).children().appendTo($('#' + parent));
		$('div#' + child).remove();
	}

	function update_menu() {
		if ($(window).width() < 790) {
			if ($('#search_drop').length === 0)
				change('container_search', 'search_drop', 'header_search', '⌕');
			if ($('#header_drop').length === 0)
				change('header_menu', 'header_drop', 'menu_drop', '≡');
		}
		else if ($(window).width() < 1160) {
			if ($('#header_drop').length === 0)
				change('header_menu', 'header_drop', 'menu_drop', '≡');
			if ($('#search_drop').length !== 0)
				restore('container_search', 'search_drop');
		}
		else if ($(window).width() < 1450) {
			if ($('#search_drop').length === 0)
				change('container_search', 'search_drop', 'header_search', '⌕');
			if ($('#header_drop').length !== 0)
				restore('header_menu', 'header_drop');
		}
		else {
			if ($('#header_drop').length !== 0)
				restore('header_menu', 'header_drop');
			if ($('#search_drop').length !== 0)
				restore('container_search', 'search_drop');
		}
	}

	$(window).on('resize', update_menu);

	$('html').on('click', function() {
		$('div#header_menu a.menu_drop').removeClass('active');
		$('div#header_drop').hide();
		$('div#container_search a.header_search').removeClass('active');
		$('div#search_drop').hide();
	});
});