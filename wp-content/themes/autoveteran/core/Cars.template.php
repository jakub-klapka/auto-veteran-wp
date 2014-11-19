<?php


namespace Lumi\Template;


class Cars {

	public function enqueue_styles() {
		add_action( 'wp_enqueue_scripts', array( $this, 'enqueue_styles_cb' ) );
	}

	public function enqueue_styles_cb() {
		wp_enqueue_style( 'stock_detail' );
		wp_enqueue_script( 'stock_gallery' );
	}

	public function strongify_asterix( $text ) {
		$text = preg_replace( '/\*/', '<strong>', $text, 1 );
		$text = preg_replace( '/\*/', '</strong>', $text, 1 );
		return $text;
	}

}