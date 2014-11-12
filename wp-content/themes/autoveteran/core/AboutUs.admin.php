<?php


namespace Lumi\Admin;


class AboutUs {

	public function __construct() {
	
		add_filter( 'acf/fields/wysiwyg/toolbars', array( $this, 'founder_toolbar' ) );
	
	}

	public function founder_toolbar( $toolbars ) {
		$toolbars['About Us Founder'] = array(
			1 => array( 'bold', 'italic', 'underline', 'bullist', 'numlist', 'undo', 'redo', 'subscript', 'superscript' )
		);
		return $toolbars;
	}

}