<?php


namespace Lumi\Admin;


class Layout {

	public function __construct() {

		if( function_exists('acf_add_options_page') ) {

			acf_add_options_page(array(
				'page_title' 	=> 'Obecná nastavení',
				'menu_title'	=> 'Obecná nastavení',
				'menu_slug' 	=> 'theme-options',
				'capability'	=> 'edit_posts',
				'redirect'		=> false
			));

		}
	
	}

}