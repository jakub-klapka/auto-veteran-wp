<?php


namespace Lumi\Template;


class Contact {

	public function bold_first_line( $input ) {
		$lines = explode( '<br />', $input );
		$output = '<strong>' . $lines[0] . '</strong><br/>';
		$output .= implode( '<br/>', array_slice( $lines, 1 ) );
		return $output;
	}

	public function enqueue_styles() {
		add_action( 'wp_enqueue_scripts', array( $this, 'enqueue_styles_cb' ) );
	}

	public function enqueue_styles_cb() {
		wp_enqueue_style( 'contact' );
		wp_enqueue_script( 'contact' );

		wpcf7_enqueue_scripts();
		wpcf7_enqueue_styles();

	}

}