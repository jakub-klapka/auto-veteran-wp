<?php


namespace Lumi\Glob;



use Lumi\Classes\VideosFeed;

class Videos {

	public function __construct() {

		add_filter( 'cron_schedules', array( $this, 'add_every_2_hours_schedule' ) );

		/*
		 * Uncomment only for one load!
		 */
		//wp_schedule_event( time(), 'every_2_hours', 'lumi_cron_force_check_new_videos' );
		add_action( 'lumi_cron_force_check_new_videos', array( $this, 'force_check_new_videos' ) );

	}

	public function add_every_2_hours_schedule( $schedules ) {
		$schedules['every_2_hours'] = array(
			'interval' => 60*60*2,
			'display' => 'Every two hours'
		);
		return $schedules;
	}

	public function force_check_new_videos() {
		$videos = new VideosFeed( true );
	}


}