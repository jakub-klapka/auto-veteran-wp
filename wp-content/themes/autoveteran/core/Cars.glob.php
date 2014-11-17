<?php


namespace Lumi\Glob;


class Cars {

	public function __construct() {
	
		add_action( 'init', array( $this, 'register_cpt' ) );

		add_image_size( 'gallery_thumb', 288, 264, true );
		
		add_action( 'template_include', array( $this, 'check_for_sold_car_detail' ) );
		
		add_action( 'wpseo_typecount_where', array( $this, 'remove_sold_from_sitemaps_sql_where' ), 10, 2 );
		add_action( 'wpseo_posts_where', array( $this, 'remove_sold_from_sitemaps_sql_where' ), 10, 2 );

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

	public function check_for_sold_car_detail( $template ) {
		if( is_main_query() && is_singular( 'cars' ) ) {
			if( get_field( 'sold' ) == true ){
				global $wp_query;
				header("HTTP/1.0 404 Not Found");
				$wp_query->set_404();
				$template = locate_template( '404.php' );
			}
		}

		return $template;
	}

	public function remove_sold_from_sitemaps_sql_where( $filter, $post_type ) {
		if( $post_type === 'cars' ){
			global $wpdb;
			$filter .= ' AND ( SELECT meta_value FROM ' . $wpdb->postmeta . ' WHERE ' . $wpdb->postmeta . '.post_id = ' . $wpdb->posts . '.ID AND ' . $wpdb->postmeta . '.meta_key LIKE "sold" LIMIT 1 ) != 1';
		}

		return $filter;

	}


}