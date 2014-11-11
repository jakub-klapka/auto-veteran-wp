<?php


namespace Lumi\Glob;


class PluginModification {

	public function __construct() {

		/*
		* Disable WPSEO page score functions and marker
		*/
		add_filter( 'wpseo_use_page_analysis', function () {
				return false;
			} );

		add_action( 'init', function () {
			remove_action( 'wpseo_head', array( $GLOBALS['wpseo_front'], 'debug_marker' ), 2 );
		} );

		/*
		* Disable WPSEO search json
		*/
		add_filter( 'disable_wpseo_json_ld_search', '__return_true' );

		/*
Update Nag
*/
		add_action('admin_menu', function() {
			remove_action( 'admin_notices', 'update_nag', 3 );
		});

		/**
		 * Disable WPML generator tag
		 */
		global $sitepress;
		remove_action('wp_head', array($sitepress, 'meta_generator_tag'));


		add_action( 'widgets_init', array( $this, 'unregister_widgets' ) );

	}

	public function unregister_widgets()
	{
		unregister_widget('WP_Widget_Pages');
		unregister_widget('WP_Nav_Menu_Widget');
		unregister_widget('WP_Widget_Calendar');
		unregister_widget('WP_Widget_Archives');
		unregister_widget('WP_Widget_Meta');
		unregister_widget('WP_Widget_Links');
		unregister_widget('WP_Widget_Search');
		unregister_widget('WP_Widget_Text');
		unregister_widget('WP_Widget_Categories');
		unregister_widget('WP_Widget_Recent_Posts');
		unregister_widget('WP_Widget_Recent_Comments');
		unregister_widget('WP_Widget_RSS');
		unregister_widget('WP_Widget_Tag_Cloud');
	}
}