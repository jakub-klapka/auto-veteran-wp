<?php


namespace Lumi\Frontend;


class Layout {

	public function __construct() {
	
		add_action( 'wp_enqueue_scripts', array( $this, 'register_scripts' ) );
	
	}

	public function register_scripts() {

		wp_register_style( 'open_sans', '//fonts.googleapis.com/css?family=Open+Sans:400italic,700italic,400,700|Open+Sans+Condensed:300&subset=latin,latin-ext', array(), LUMI_CSS_JS_VER );
		wp_enqueue_style( 'layout', get_template_directory_uri() . '/assets/css/layout.css', array( 'open_sans' ), LUMI_CSS_JS_VER );

	}


}