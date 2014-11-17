<?php


namespace Lumi\Classes;


class VideosFeed {

	private $videos;
	private $yt_api_key;

	public function __construct( $force_fetch = false ) {

		$this->yt_api_key = 'AIzaSyCaesFEG9KTUQ9CMH47WZT1uF_UZAF33g8';

		$this->videos = $this->populate_videos( $force_fetch );

	}

	public function get_videos( $number = false ) {
		if( $number ){
			return array_slice( $this->videos, 0, $number );
		}
		return $this->videos;
	}

	private function log( $error ) {
		$file = fopen( dirname( LUMI_CORE_PATH ) . '/video-log.txt', 'at' );
		fwrite( $file, $error . PHP_EOL );
		fclose( $file );
	}

	private function request( $body ) {

		$ch = curl_init();
		curl_setopt_array( $ch, array(
			CURLOPT_HEADER => false,
			CURLOPT_URL => 'https://www.googleapis.com/youtube/v3/' . $body . '&key=' . $this->yt_api_key,
			CURLOPT_RETURNTRANSFER => true,
			CURLOPT_SSL_VERIFYPEER => false
		));
		$response = curl_exec( $ch );
		curl_close( $ch );
		return $response;
	}

	private function get_channel_id() {

		$url = get_field( 'youtube_channel_url', 'option' );
		preg_match( '/(?:(?:http|https):\/\/|)(?:www\.)?youtube\.com\/(?:channel\/|user\/)([a-zA-Z0-9]{1,})/', $url, $matches );

		if( $matches[1] == false ) {
			return false;
		}

		return $matches[1];

	}

	private function fetch_videos() {

		$channel_id = $this->get_channel_id();
		if( $channel_id === false ) {
			return false;
		}

		//Get playlist
		$channel_details = $this->request( 'channels?part=contentDetails&forUsername=' . $channel_id );
		if( $channel_details === false ) {
			$this->log( 'Cannot get channel details.' );
			return false;
		}
		$channel_details = json_decode( $channel_details );

		if( !isset( $channel_details->items[0]->contentDetails->relatedPlaylists->uploads ) ){
			$this->log( 'Playlist info is not there.' );
			return false;
		}
		$playlist_id = $channel_details->items[0]->contentDetails->relatedPlaylists->uploads;

		//Get videos
		$next_page_token = true;
		$video_ids = array();
		while( $next_page_token ){
			$next_page_request = ( $next_page_token !== true ) ? '&pageToken=' . $next_page_token : '';

			$video_items = $this->request( 'playlistItems?part=contentDetails&maxResults=50' . $next_page_request . '&playlistId=' . $playlist_id );
			if( $video_items === false ) {
				$this->log( 'Cannot get video items.' );
				return false;
			}
			$video_items = json_decode( $video_items );

			$next_page_token = ( isset( $video_items->nextPageToken ) ) ? $video_items->nextPageToken : false;

			foreach( $video_items->items as $item ) {
				if( !isset( $item->contentDetails->videoId ) ) {
					$this->log( 'Video ID is not there.' );
					return false;
				}
				$video_ids[] = $item->contentDetails->videoId;
			}

		}

		//Get video info
		$batches = array_chunk( $video_ids, 50 );
		$videos = array();
		foreach( $batches as $batch ) {
			$video_snippet = $this->request( 'videos?part=snippet&id=' . implode( ',', $batch ) );
			if( $video_snippet === false ) {
				$this->log( 'Cannot get video snippet' );
				return false;
			}
			$video_snippet = json_decode( $video_snippet );

			foreach( $video_snippet->items as $item ) {
				if( !isset( $item->id ) || !isset( $item->snippet->title ) ) {
					$this->log( 'Video info is not there' );
					return false;
				}
				$videos[] = array(
					'id' => $item->id,
					'title' => $item->snippet->title
				);
			}
		}

		return $videos;

	}

	private function populate_videos( $force_fetch ) {

		$data_in_db = get_option( 'lumi_videos' );

		if( $data_in_db === false || $force_fetch ) {
			//process videos
			$videos = $this->fetch_videos();
			$videos = $this->top_video( $videos );

			//check for cache
			if( $data_in_db !== $videos ) {
				if( function_exists( 'wp_cache_clear_cache' ) ){
					wp_cache_clear_cache();
				}
			}

			//save new fetch
			delete_option( 'lumi_videos' );
			add_option( 'lumi_videos', $videos, null, 'no' );
		} else {
			$videos = $data_in_db;
		}

		return $videos;

	}

	private function top_video( $videos ) {
		$toped_id = get_field( 'featured_video', 'option' );
		if( !$toped_id ) {
			return $videos;
		}

		foreach( $videos as $key => $video ) {
			if( $video['id'] === $toped_id ) {
				unset( $videos[ $key ] );
				array_unshift( $videos, $video );
			}
		}

		return $videos;
	}

}