<?php


namespace Lumi\Template;


class CarsArchive {

	public function enqueue_scripts() {
		add_action( 'wp_enqueue_scripts', array( $this, 'enqueue_scripts_cb' ) );
	}

	public function enqueue_scripts_cb(){
		wp_enqueue_style( 'stock' );
	}

}