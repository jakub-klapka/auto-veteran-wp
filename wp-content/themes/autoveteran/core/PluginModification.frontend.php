<?php


namespace Lumi\Frontend;


class PluginModification {

	public function __construct() {

		add_action( 'init', function () {
			remove_action( 'wpseo_head', array( $GLOBALS['wpseo_front'], 'debug_marker' ), 2 );
		} );
	
	}

}