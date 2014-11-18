<?php


namespace Lumi\Frontend;


class NewsArchive {

	public function __construct() {
	
		add_filter( 'excerpt_length', array( $this, 'excerpt_length_cb' ) );
	
	}

	public function excerpt_length_cb() {
		return 15;
	}

}