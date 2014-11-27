<?php


namespace Lumi\Glob;


class News {

	public function __construct() {
	
		add_action( 'init', array( $this, 'register_cpt' ) );

		add_image_size( 'news_full_post', 586, 586 );
	
	}

	public function register_cpt() {

		$labels = array(
			'name'               => __( 'Novinky', LUMI_TEXTDOMAIN ),
			'singular_name'      => 'Novinka',
			'menu_name'          => 'Novinky',
			'name_admin_bar'     => 'Přidat novinku',
			'add_new'            => 'Přidat',
			'add_new_item'       => 'Přidat novinku',
			'new_item'           => 'Nová novinka',
			'edit_item'          => 'Upravit novinku',
			'view_item'          => 'Ukázat novinku',
			'all_items'          => 'Všechny novinky',
			'search_items'       => 'Hledat novinky',
			'parent_item_colon'  => 'Nadřazená novinka:',
			'not_found'          => 'Novinky nenalezeny.',
			'not_found_in_trash' => 'Novinky nenalezeny ani v koši.'
		);

		register_post_type( 'news', array(
			'labels' => $labels,
			'public' => true,
			'supports' => array( 'title', 'editor', 'excerpt', 'revisions' ),
			'has_archive' => true,
			'rewrite' => array(
				'slug' => _x( 'novinky', 'URL slug', LUMI_TEXTDOMAIN )
			)
		) );

	}

}