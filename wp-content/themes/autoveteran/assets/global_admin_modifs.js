/* global jQuery */
(function($){ $( function(){

	$('#wpseo_meta h3:first span').text('SEO nastavení');
	$('#wpseo_meta tr:has(#yoast_wpseo_focuskw)').hide();
	$('#wpseo_meta #linkdex').hide();
	$('#createuser tr:has(#url)').hide();

	$( '.icl_nav_menu_text:has(a:contains("Synchronize menus between languages."))' ).hide();

} ); })(jQuery);