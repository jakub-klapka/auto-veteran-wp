<?php
global $post;
if( strpos( $post->post_content, '<!--more-->' ) ) {
	the_content( '' );
} else {
	the_excerpt();
}
