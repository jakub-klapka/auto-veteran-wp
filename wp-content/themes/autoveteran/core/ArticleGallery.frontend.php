<?php


namespace Lumi\Frontend;


class ArticleGallery {

	public function __construct() {

		add_action( 'wp', array( $this, 'check_for_gallery' ) );

	}

	public function check_for_gallery() {
		if( !is_singular( 'news' ) && !is_singular( 'page' ) ) return;

		global $post;
		if( strpos( $post->post_content, 'wp-image-' ) !== false || strpos( $post->post_content, '[gallery' ) !== false ) {
			add_action( 'wp_enqueue_scripts', array( $this, 'enqueue_script' ) );
		}

	}

	public function enqueue_script() {
		wp_enqueue_script( 'article_gallery' );

	}

}