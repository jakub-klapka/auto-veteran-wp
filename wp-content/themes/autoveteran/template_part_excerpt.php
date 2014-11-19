<?php
global $post;
ob_start();
	if( strpos( $post->post_content, '<!--more-->' ) ) {
		global $more;
		$more_orig = $more;
		$more = false;
		the_content( '' );
		$more = $more_orig;
	} else {
		the_excerpt();
	}
$excerpt = ob_get_clean();
echo str_replace( '<p', '<p class="news__item__meta__excerpt"', $excerpt );