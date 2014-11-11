<?php


namespace Lumi\Glob;


class Layout {

	public function __construct() {

		add_action( 'after_setup_theme', array( $this, 'register_nav_menu' ) );
	
	}

	public function register_nav_menu() {

		register_nav_menu( 'main_menu', 'Hlavní menu' );
		register_nav_menu( 'footer_menu', 'Menu v patičce' );

	}


}