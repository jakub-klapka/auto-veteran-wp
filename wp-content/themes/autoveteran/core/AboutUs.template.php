<?php


namespace Lumi\Template;


class AboutUs {

	public function get_founder_description() {

		$desc = get_field( 'founder_text' );
		$desc = str_replace( '</p>', '<br/>', $desc );
		$desc = str_replace( '<p>', '', $desc );
		$desc = preg_replace( '/<\/br>(\n)?$/', '', $desc );

		return $desc;

	}
}