<?php


namespace Lumi\Template;


use Lumi\Classes\VideosFeed;

class Home {

	public function enqueue_scripts() {
		add_action( 'wp_enqueue_scripts', array( $this, 'enqueue_scripts_cb' ) );
	}

	public function enqueue_scripts_cb() {
		wp_enqueue_style( 'home' );
		wp_enqueue_script( 'modernizr' );
		wp_enqueue_script( 'video_carousel' );
		wp_enqueue_script( 'slider' );
	}

	public function get_videos() {
		$videos = new VideosFeed();
		return $videos->get_videos( 4 );
	}

	public function set_stock_query() {
		return new \WP_Query( array(
			'post_type' => 'cars',
			'posts_per_page' => 8
		) );
	}

	public function set_news_query() {
		return new \WP_Query(array(
			'post_type' => 'news',
			'posts_per_page' => 4
		));
	}

}