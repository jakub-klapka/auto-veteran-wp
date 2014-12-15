<?php


namespace Lumi\Frontend;


class Layout {

	public function __construct() {
	
		add_action( 'wp_enqueue_scripts', array( $this, 'register_scripts' ) );

		add_filter( 'excerpt_more', array( $this, 'excerpt_more' ) );

		add_action( 'init', function(){
			add_action( 'wp_print_scripts', array( $this, 'move_wpml_to_footer' ) );
		} );

		add_action( 'wp_head', array( $this, 'admin_bar_links' ) );

	}

	public function register_scripts() {

		wp_register_style( 'open_sans', '//fonts.googleapis.com/css?family=Open+Sans:400italic,700italic,400,700|Open+Sans+Condensed:300&subset=latin,latin-ext', array(), LUMI_CSS_JS_VER );
		wp_enqueue_style( 'layout', get_template_directory_uri() . '/assets/css/layout.css', array( 'open_sans' ), LUMI_CSS_JS_VER );

		wp_register_style( 'contact', get_template_directory_uri() . '/assets/css/contact_us.css', array( 'layout' ), LUMI_CSS_JS_VER );
		wp_register_style( 'news', get_template_directory_uri() . '/assets/css/news.css', array( 'layout' ), LUMI_CSS_JS_VER );
		wp_register_style( 'stock', get_template_directory_uri() . '/assets/css/stock.css', array( 'layout' ), LUMI_CSS_JS_VER );
		wp_register_style( 'stock_detail', get_template_directory_uri() . '/assets/css/stock_detail.css', array( 'layout' ), LUMI_CSS_JS_VER );
		wp_register_style( 'slider', get_template_directory_uri() . '/assets/css/slider.css', array( 'layout' ), LUMI_CSS_JS_VER );
		wp_register_style( 'home', get_template_directory_uri() . '/assets/css/home.css', array( 'layout', 'stock', 'news', 'slider' ), LUMI_CSS_JS_VER );


		wp_deregister_script( 'jquery' );
		wp_register_script( 'jquery', get_template_directory_uri() . '/assets/js/libs/jquery-2.1.1.js', array(), LUMI_CSS_JS_VER, true );
		wp_register_script( 'autosize', get_template_directory_uri() . '/assets/js/libs/jquery.autosize.js', array( 'jquery' ), LUMI_CSS_JS_VER, true );
		wp_register_script( 'modernizr', get_template_directory_uri() . '/assets/js/libs/modernizr.js', array(), LUMI_CSS_JS_VER, true );
		wp_register_script( 'fancybox', get_template_directory_uri() . '/assets/js/libs/jquery.fancybox.js', array( 'jquery' ), LUMI_CSS_JS_VER, true );
		wp_register_script( 'trunk8', get_template_directory_uri() . '/assets/js/libs/trunk8.js', array( 'jquery' ), LUMI_CSS_JS_VER, true );
		wp_register_script( 'nivo_slider', get_template_directory_uri() . '/assets/js/libs/jquery.nivo.slider.js', array( 'jquery' ), LUMI_CSS_JS_VER, true );

		wp_register_script( 'stock_gallery', get_template_directory_uri() . '/assets/js/stock_gallery.js', array( 'jquery', 'fancybox' ), LUMI_CSS_JS_VER, true );
		wp_register_script( 'contact', get_template_directory_uri() . '/assets/js/contact_us.js', array( 'jquery', 'autosize' ), LUMI_CSS_JS_VER, true );
		wp_register_script( 'video_carousel', get_template_directory_uri() . '/assets/js/video_carousel.js', array( 'jquery', 'trunk8' ), LUMI_CSS_JS_VER, true );
		wp_register_script( 'slider', get_template_directory_uri() . '/assets/js/slider.js', array( 'jquery', 'nivo_slider' ), LUMI_CSS_JS_VER, true );

		//slider on every page:
		wp_enqueue_style( 'slider' );
		wp_enqueue_script( 'slider' );

	}

	public function excerpt_more( $more ) {
		return '...';
	}

	public function move_wpml_to_footer() {
		global $wp_scripts;
		if( isset( $wp_scripts->registered['wpml-browser-redirect'] ) && isset( $wp_scripts->registered['jquery.cookie'] ) ) {
			$wp_scripts->registered['jquery.cookie']->extra['group'] = 1;
			$wp_scripts->registered['wpml-browser-redirect']->extra['group'] = 1;
		}
	}

	public function admin_bar_links() {
		if( !is_user_logged_in() ) return;
		?>
		<style type="text/css">#wp-admin-bar-themes,#wp-admin-bar-customize,#wp-admin-bar-menus{display: none;}</style>
		<?php
	}

}