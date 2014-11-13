<?php


namespace Lumi\Frontend;


class Layout {

	public function __construct() {
	
		add_action( 'wp_enqueue_scripts', array( $this, 'register_scripts' ) );
	
	}

	public function register_scripts() {

		wp_register_style( 'open_sans', '//fonts.googleapis.com/css?family=Open+Sans:400italic,700italic,400,700|Open+Sans+Condensed:300&subset=latin,latin-ext', array(), LUMI_CSS_JS_VER );
		wp_enqueue_style( 'layout', get_template_directory_uri() . '/assets/css/layout.css', array( 'open_sans' ), LUMI_CSS_JS_VER );

		wp_register_style( 'contact', get_template_directory_uri() . '/assets/css/contact_us.css', array( 'layout' ), LUMI_CSS_JS_VER );


		wp_deregister_script( 'jquery' );
		wp_register_script( 'jquery', get_template_directory_uri() . '/assets/js/libs/jquery-2.1.1.js', array(), LUMI_CSS_JS_VER, true );
		wp_register_script( 'autosize', get_template_directory_uri() . '/assets/js/libs/jquery.autosize.js', array( 'jquery' ), LUMI_CSS_JS_VER, true );
		wp_register_script( 'contact', get_template_directory_uri() . '/assets/js/contact_us.js', array( 'jquery', 'autosize' ), LUMI_CSS_JS_VER, true );

	}


}