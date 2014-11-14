<?php


namespace Lumi\Frontend;


class CarsArchive {

	public function __construct() {
	
		add_action( 'pre_get_posts', array( $this, 'no_pagination' ) );
		add_action( 'pre_get_posts', array( $this, 'exclude_sold' ) );

	}

	public function no_pagination( $query ) {
		if( $query->get( 'post_type' ) === 'cars' ) {
			$query->set( 'posts_per_page', -1 );
		}
	}

	public function exclude_sold( $query ) {
		if( $query->is_archive && $query->get( 'post_type' ) === 'cars' ){
			$query->set( 'meta_key', 'sold' );
			$query->set( 'meta_value', true );
			if( get_query_var( 'sold' ) == true ) {
				$query->set( 'meta_compare', '=' );
			} else {
				$query->set( 'meta_compare', '!=' );
			}
		}
	}



}