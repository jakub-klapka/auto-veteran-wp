<?php


namespace Lumi\Glob;


class CarsArchive {

	public function __construct() {
	
		add_image_size( 'cars_thumbnail', 200, 135, true );

		add_action( 'init', array( $this, 'sold_rewrites' ) );

	
	}

	public function sold_rewrites( ){
		add_rewrite_rule( 'auta/((previous)|(predchozi))/?$', 'index.php?post_type=cars&sold=true', 'top' );
		add_rewrite_tag( '%sold%', '([^&]+)' );
	}


}