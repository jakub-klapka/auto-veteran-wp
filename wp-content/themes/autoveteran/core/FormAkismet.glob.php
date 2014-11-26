<?php


namespace Lumi\Glob;


class FormAkismet {

	private $akismet_key = 'e0f2cd211b08';

	public function __construct() {
	
		add_filter( 'wpcf7_spam', array( $this, 'form_akismet' ) );

	}

	public function form_akismet( $spam ) {
		if ( $spam ) return $spam;

		include_once( 'inc/akismet.class.php' );

		$comment = array(
			'author'    => $_POST['name'],
			'email'     => $_POST['email'],
			'website'   => get_bloginfo( 'url' ),
			'body'      => $_POST['message'],
			//'permalink' => get_permalink(),
		);

		$akismet = new \Lumi\Inc\Akismet( get_bloginfo( 'url' ) , $this->akismet_key, $comment);

		if($akismet->errorsExist()) {
			if($akismet->isError('AKISMET_INVALID_KEY')) {
				$this->log( 'invalid key' );
			} elseif($akismet->isError('AKISMET_RESPONSE_FAILED')) {
				$this->log( 'AKISMET_RESPONSE_FAILED' );
			} elseif($akismet->isError('AKISMET_SERVER_NOT_FOUND')) {
				$this->log( 'AKISMET_SERVER_NOT_FOUND' );
			}

			return false;
		} else {
			if($akismet->isSpam()) {
				return true;
			} else {
				return false;
			}
		}


		return false;
	}

	private function log( $message ) {
		$file = fopen( dirname( __DIR__ ) . '/akismet-log.txt', 'ab' );
		fwrite( $file, $message . PHP_EOL );
		fclose( $file );
	}

}