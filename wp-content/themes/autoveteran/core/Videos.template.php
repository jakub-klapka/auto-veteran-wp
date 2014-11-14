<?php


namespace Lumi\Template;


use Lumi\Classes\VideosFeed;

class Videos {

	public function get_all_videos() {

		$videos = new VideosFeed();
		return $videos->get_videos();

	}

}