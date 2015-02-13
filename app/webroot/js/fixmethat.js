jQuery( document ).ready(function () {
	var offsetTop = $( "#wall_infos" ).offset().top;

	$( window ).scroll(function () {
		if ( $( window ).scrollTop() > offsetTop - 80 ) {
			$("#wall_infos").addClass("fixe");
		}
		else {
			$("#wall_infos").removeClass("fixe");
		}
	});
});