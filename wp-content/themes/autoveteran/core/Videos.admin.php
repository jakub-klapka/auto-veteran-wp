<?php


namespace Lumi\Admin;


use Lumi\Classes\VideosFeed;

class Videos {

	public function __construct() {
	
		add_filter( 'acf/load_field/name=featured_video', array( $this, 'add_featured_video_dropdown' ) );

		add_action( 'acf/save_post', array( $this, 'force_fetch_videos_on_settings_save' ) );
	
	}

	public function add_featured_video_dropdown( $field ) {
		$videos = new VideosFeed();
		$videos = $videos->get_videos();
		$values = array();
		foreach( $videos as $video ) {
			$values[ $video['id'] ] = $video['title'];
		}

		$field['choices'] = $values;

		return $field;
	}

	public function force_fetch_videos_on_settings_save( $post_id ) {
		if( $post_id == 'options' ) {
			$videos = new VideosFeed( true );
		}
	}

}