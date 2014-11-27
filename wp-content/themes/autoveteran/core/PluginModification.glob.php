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

		add_filter( 'rewrite_rules_array', array( $this, 'clean_rewrite' ) );

		add_filter( 'pre_option_blogname', array( $this, 'bloginfo_acf_wpml_blogname' ) );
		add_filter( 'pre_option_blogdescription', array( $this, 'bloginfo_acf_wpml_blogdescription' ) );

		add_action( 'init', array( $this, 'remove_cpt_support' ) );


		add_action( 'login_enqueue_scripts', array( $this, 'my_login_logo' ) );


		add_action('user_register', array( $this, 'set_user_metaboxes' ) );

	}

	function set_user_metaboxes($user_id=NULL) {
		$defaults = array(
			'meta-box-order_dashboard' => 'a:4:{s:6:"normal";s:14:"ga-dash-widget";s:4:"side";s:45:"dashboard_right_now,custom_dashboard_activity";s:7:"column3";s:0:"";s:7:"column4";s:0:"";}',
			'meta-box-order_page' => 'a:4:{s:15:"acf_after_title";s:95:"acf-group_5476ea2583759,acf-group_5476eeb20859a,acf-group_5476e83081834,acf-group_5476eabc12cae";s:4:"side";s:79:"submitdiv,icl_div,pageparentdiv,acf-group_5465e7a6a12a6,acf-group_5464d89f9de40";s:6:"normal";s:199:"acf-group_5469f15485660,acf-group_546367dedda4e,acf-group_5465e898f1da3,acf-group_5463527d9e158,acf-group_5464de1fcb437,acf-group_54634c15f13d2,acf-group_546241602e1df,revisionsdiv,slugdiv,wpseo_meta";s:8:"advanced";s:0:"";}',
			'screen_layout_page' => '2',
			'meta-box-order_cars' => 'a:4:{s:15:"acf_after_title";s:95:"acf-group_5476ea2583759,acf-group_5476eeb20859a,acf-group_5476e83081834,acf-group_5476eabc12cae";s:4:"side";s:65:"submitdiv,icl_div,acf-group_5465e7a6a12a6,acf-group_5464d89f9de40";s:6:"normal";s:186:"acf-group_5469f15485660,acf-group_546367dedda4e,acf-group_5465e898f1da3,acf-group_5463527d9e158,acf-group_5464de1fcb437,acf-group_54634c15f13d2,acf-group_546241602e1df,slugdiv,wpseo_meta";s:8:"advanced";s:0:"";}',
			'screen_layout_cars' => '2',
			'meta-box-order_news' => 'a:4:{s:15:"acf_after_title";s:95:"acf-group_5476ea2583759,acf-group_5476eeb20859a,acf-group_5476e83081834,acf-group_5476eabc12cae";s:4:"side";s:65:"submitdiv,icl_div,acf-group_5465e7a6a12a6,acf-group_5464d89f9de40";s:6:"normal";s:198:"acf-group_5469f15485660,acf-group_546367dedda4e,acf-group_5465e898f1da3,acf-group_5463527d9e158,acf-group_5464de1fcb437,acf-group_54634c15f13d2,acf-group_546241602e1df,postexcerpt,slugdiv,wpseo_meta";s:8:"advanced";s:0:"";}',
			'screen_layout_news' => '2',
			'closedpostboxes_news' => 'a:0:{}',
			'metaboxhidden_news' => 'a:14:{i:0;s:23:"acf-group_5476ea2583759";i:1;s:23:"acf-group_5476eeb20859a";i:2;s:23:"acf-group_5476e83081834";i:3;s:23:"acf-group_5476eabc12cae";i:4;s:23:"acf-group_5465e7a6a12a6";i:5;s:23:"acf-group_5469f15485660";i:6;s:23:"acf-group_546367dedda4e";i:7;s:23:"acf-group_5465e898f1da3";i:8;s:23:"acf-group_5463527d9e158";i:9;s:23:"acf-group_5464de1fcb437";i:10;s:23:"acf-group_54634c15f13d2";i:11;s:23:"acf-group_546241602e1df";i:12;s:7:"slugdiv";i:13;s:12:"revisionsdiv";}',
			'closedpostboxes_page' => 'a:0:{}',
			'metaboxhidden_page' => 'a:13:{i:0;s:23:"acf-group_5476eeb20859a";i:1;s:23:"acf-group_5476e83081834";i:2;s:23:"acf-group_5476eabc12cae";i:3;s:23:"acf-group_5465e7a6a12a6";i:4;s:23:"acf-group_5464d89f9de40";i:5;s:23:"acf-group_546367dedda4e";i:6;s:23:"acf-group_5465e898f1da3";i:7;s:23:"acf-group_5463527d9e158";i:8;s:23:"acf-group_5464de1fcb437";i:9;s:23:"acf-group_54634c15f13d2";i:10;s:23:"acf-group_546241602e1df";i:11;s:12:"revisionsdiv";i:12;s:7:"slugdiv";}',
			'managenav-menuscolumnshidden' => 'a:4:{i:0;s:11:"link-target";i:1;s:11:"css-classes";i:2;s:3:"xfn";i:3;s:11:"description";}',
			'metaboxhidden_nav-menus' => 'a:3:{i:0;s:8:"add-post";i:1;s:12:"add-category";i:2;s:12:"add-post_tag";}',
			'closedpostboxes_nav-menus' => 'a:0:{}'
		);

		// So this can be used without hooking into user_register
		if ( ! $user_id)
			$user_id = get_current_user_id();
		foreach( $defaults as $key => $value ){
		// Set the default order if it has not been set yet
			if ( ! get_user_meta( $user_id, $key, true) ) {
				$meta_value = unserialize( $value );
				update_user_meta( $user_id, $key, $meta_value );
			}
		}
	}


	function my_login_logo() { ?>
		<style type="text/css">
			body.login div#login h1 a {
				background-image: url(<?php echo get_stylesheet_directory_uri(); ?>/assets/images/logo.svg);
				background-size: 200px 44px;
				width: 200px;
				height: 44px;
			}
		</style>
	<?php }

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


	public function clean_rewrite( $rules ) {
		foreach( $rules as $rule => $rewrite ) {
			if(
				strpos( $rule, 'feed|' ) !== false
				|| strpos( $rule, 'category/(.+?)' ) !== false
				|| strpos( $rule, 'tag/([^/]+)' ) !== false
				|| strpos( $rule, 'type/([^/]+)' ) !== false
				|| strpos( $rule, '/trackback/' ) !== false
				|| strpos( $rule, 'feed/' ) !== false
				|| strpos( $rule, 'comment-page-' ) !== false
				|| strpos( $rule, 'comments/' ) !== false
				|| strpos( $rule, 'search/' ) !== false
				|| strpos( $rule, 'author/' ) !== false
			) {
				unset( $rules[$rule] );
			}
		}
		return $rules;
	}

	public function bloginfo_acf_wpml_blogname(  ) {
		return get_field( 'blogname', 'option' );
	}

	public function bloginfo_acf_wpml_blogdescription(  ) {
		return get_field( 'blogdescription', 'option' );
	}

	public function remove_cpt_support() {
		remove_post_type_support( 'page', 'comments' );
		remove_post_type_support( 'page', 'author' );
		remove_post_type_support( 'page', 'custom-fields' );
	}

}