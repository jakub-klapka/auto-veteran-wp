<?php


namespace Lumi\Admin;


class PluginModification {

	public function __construct() {

		/**
		 * WP SEO metabox lower prio
		 */
		add_filter( 'wpseo_metabox_prio', function() {return 'low';} );


		/**
		 * ACF cache delete
		 */
		add_filter( 'acf/save_post', function($post_id) {
			if( $post_id === 'options' || $post_id === 'options_' . ICL_LANGUAGE_CODE ) {
				if( function_exists( 'wp_cache_clear_cache' ) ){
					wp_cache_clear_cache();
				}
			}
		} );

		/*
		* AIOWPS ServerSignature Off
		*/
		add_filter( 'aiowps_htaccess_rules_before_writing', array( $this, 'aiowps_disable_server_signature' ) );

		add_action( 'after_setup_theme', array( $this, 'add_editor_style' ) );


	}

	public function aiowps_disable_server_signature( $rules ) {
		foreach( $rules as $key => $rule ) {
			if( $rule == 'ServerSignature Off' || $rule == 'LimitRequestBody 10240000' ) {
				unset( $rules[$key] );
			}
		}
		return $rules;
	}

	public function add_editor_style() {
		add_editor_style( 'assets/css/editor-style.css' );
	}


}