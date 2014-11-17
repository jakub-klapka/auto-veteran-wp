<?php
global $post;
if( strpos( $post->post_content, '<!--more-->' ) ) {
	global $more;
	$more_orig = $more;
	$more = false;
	the_content( '' );
	$more = $more_orig;
} else {
	the_excerpt();
}
