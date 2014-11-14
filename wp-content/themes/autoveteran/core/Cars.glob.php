<?php


namespace Lumi\Glob;


class Cars {

	public function __construct() {
	
		add_action( 'init', array( $this, 'register_cpt' ) );

		add_image_size( 'gallery_thumb', 288, 264, true );
	
	}

	public function register_cpt() {

		$labels = array(
			'name'               => 'Auta',
			'singular_name'      => 'Auto',
			'menu_name'          => 'Auta',
			'name_admin_bar'     => 'Přidat auto',
			'add_new'            => 'Přidat',
			'add_new_item'       => 'Přidat auto',
			'new_item'           => 'Nové auto',
			'edit_item'          => 'Upravit auto',
			'view_item'          => 'Ukázat auto',
			'all_items'          => 'Všechny auta',
			'search_items'       => 'Hledat auta',
			'parent_item_colon'  => 'Nadřazená auta:',
			'not_found'          => 'Auta nenalezeny.',
			'not_found_in_trash' => 'Auta nenalezeny ani v koši.'
		);

		register_post_type( 'cars', array(
			'labels' => $labels,
			'public' => true,
			'supports' => array( 'title', 'editor', 'revisions' ),
			'has_archive' => true,
			'rewrite' => array(
				'slug' => _x( 'auta', 'URL slug', LUMI_TEXTDOMAIN ),
				'pages' => false
			)
		) );

	}
}