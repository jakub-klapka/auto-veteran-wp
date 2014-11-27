<?php
/*------------------------------*/
/* ADD CUSTOM POST TYPES TO 'AT A GLANCE' WIDGET
/*------------------------------*/
add_action('dashboard_glance_items', 'add_custom_post_counts');
function add_custom_post_counts() {
	$post_types = array('news', 'cars' ); // array of custom post types to add to 'At A Glance' widget
	foreach ($post_types as $pt) :
		$pt_info = get_post_type_object($pt); // get a specific CPT's details
		$num_posts = wp_count_posts($pt); // retrieve number of posts associated with this CPT
		$num = number_format_i18n($num_posts->publish); // number of published posts for this CPT
		switch( $pt ) {
			case( 'news' ): $text = 'novinek'; break;
			case( 'cars' ): $text = 'nabídek'; break;
		}
		echo '<li class="page-count '.$pt_info->name.'-count"><a href="edit.php?post_type='.$pt.'">'.$num.' '.$text.'</a></li>';
	endforeach;
}
add_action('admin_head', 'my_custom_fonts');
function my_custom_fonts() {
	echo '<style>
.page-count.news-count a:before {content: "\f488" !important;}
.page-count.cars-count a:before {content: "\f109" !important;}
</style>';
}
