<?php


namespace Lumi\Glob;


class Layout {

	public function __construct() {

		add_action( 'after_setup_theme', array( $this, 'register_nav_menu' ) );
		add_action( 'after_setup_theme', array( $this, 'load_textdomain' ) );

		add_image_size( 'header_image', 960, 150, true );
	
	}

	public function register_nav_menu() {

		register_nav_menu( 'main_menu', 'Hlavní menu' );
		register_nav_menu( 'footer_menu', 'Menu v patičce' );

	}

	public function load_textdomain() {
		load_theme_textdomain( LUMI_TEXTDOMAIN , get_template_directory() );
	}


}