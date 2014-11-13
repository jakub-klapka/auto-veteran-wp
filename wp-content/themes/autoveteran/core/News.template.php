<?php


namespace Lumi\Template;


class News {

	public function enqueue_styles() {
		add_action( 'wp_enqueue_scripts', array( $this, 'enqueue_styles_cb' ) );
	}

	public function enqueue_styles_cb() {
		wp_enqueue_style( 'news' );
		wp_enqueue_script( 'modernizr' );
	}

}