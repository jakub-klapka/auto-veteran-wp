<?php


namespace Lumi\Glob;


class ACFField {

	public function __construct() {
	
		add_filter( 'acf/load_field/name=link', array( $this, 'add_pages_to_select' ) );
		add_filter( 'acf/load_field/name=videos_link', array( $this, 'add_pages_to_select' ) );
		add_filter( 'acf/load_field/name=stock_link', array( $this, 'add_pages_to_select' ) );
		add_filter( 'acf/load_field/name=news_page', array( $this, 'add_pages_to_select' ) );
		add_filter( 'acf/load_field/name=about_us_page', array( $this, 'add_pages_to_select' ) );
		add_filter( 'acf/load_field/name=cars_contact_link', array( $this, 'add_pages_to_select' ) );

	}

	public function add_pages_to_select( $field ) {
		$choices = array();

		//Pages
		$pages = new \WP_Query( array(
			'post_type' => 'page',
			'posts_per_page' => -1
		) );

		foreach( $pages->posts as $post ) {
			$choices[ get_permalink( $post->ID ) ] = get_the_title( $post->ID );
		}

		//Archives
		$news_link = ( ICL_LANGUAGE_CODE === 'en' ) ? get_bloginfo( 'url' ) . '/news/' : get_post_type_archive_link( 'news' );
		$choices[ $news_link ] = __( 'Novinky', LUMI_TEXTDOMAIN );

		$stock_link = ( ICL_LANGUAGE_CODE === 'en' ) ? get_bloginfo( 'url' ) . '/en/stock/' : get_post_type_archive_link( 'cars' );
		$choices[ $stock_link ] = __( 'Nabídka', LUMI_TEXTDOMAIN );

		$sold_link = ( ICL_LANGUAGE_CODE === 'en' ) ? get_bloginfo( 'url' ) . '/en/stock/previous/' : get_post_type_archive_link( 'cars' ) . 'predchozi/';
		$choices[ $sold_link ] = __( 'Předchozí nabídka', LUMI_TEXTDOMAIN );

		$field['choices'] = $choices;
		return $field;
	}

}