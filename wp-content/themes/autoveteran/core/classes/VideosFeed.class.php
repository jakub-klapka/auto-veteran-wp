<?php


namespace Lumi\Classes;


class VideosFeed {

	private $videos;
	private $yt_api_key;

	public function __construct() {

		$this->yt_api_key = 'AIzaSyCaesFEG9KTUQ9CMH47WZT1uF_UZAF33g8';

		$this->videos = $this->fetch_videos();

	}

	public function get_videos() {
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

	private function fetch_videos() {

		//Get playlist
		$channel_details = $this->request( 'channels?part=contentDetails&forUsername=MrPrzemekPilot' );
		if( $channel_details === false ) {
			$this->log( 'Cannot get channel details.' );
			return false;
		}
		$channel_details = json_decode( $channel_details );

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
				$videos[] = array(
					'id' => $item->id,
					'title' => $item->snippet->title
				);
			}
		}

		return $videos;

	}

}