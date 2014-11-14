<?php


namespace Lumi\Template;


class NewsArchive {

	public function enqueue_styles() {
		add_action( 'wp_enqueue_scripts', array( $this, 'enqueue_styles_cb' ) );
	}

	public function enqueue_styles_cb() {
		wp_enqueue_style( 'news' );
		wp_enqueue_script( 'modernizr' );
	}

	public function get_pagination() {

		global $wp_query, $wp_rewrite;

		$defaults = array(
			'base'         => get_post_type_archive_link( 'news' ) . '%_%',
			'format'       => 'page/%#%/',
			'total'        => $wp_query->max_num_pages,
			'current'      => ( get_query_var( 'paged' ) ) ? get_query_var( 'paged' ) : 1,
			'show_all'     => false,
			'end_size'     => 1,
			'mid_size'     => 3,
			'prev_next'    => true,
			'prev_text'    => __('«'),
			'next_text'    => __('»'),
			'type'         => 'array',
			'add_args'     => False,
			'add_fragment' => '',
			'before_page_number' => ''
		);

		$args = $defaults;

		// Who knows what else people pass in $args
		$total = (int) $args['total'];
		if ( $total < 2 ) {
			return false;
		}
		$current  = (int) $args['current'];
		$end_size = (int) $args['end_size']; // Out of bounds?  Make it the default.
		if ( $end_size < 1 ) {
			$end_size = 1;
		}
		$mid_size = (int) $args['mid_size'];
		if ( $mid_size < 0 ) {
			$mid_size = 2;
		}
		$add_args = is_array( $args['add_args'] ) ? $args['add_args'] : false;
		$r = array();
		$page_links = array();
		$dots = false;

		if ( $args['prev_next'] && $current && 1 < $current ) :
			$link = str_replace( '%_%', 2 == $current ? '' : $args['format'], $args['base'] );
			$link = str_replace( '%#%', $current - 1, $link );


			$r[] = array(
				'is_prev' => true,
				'url' => $link,
				'text' => $args['prev_text']
			);

		endif;
		for ( $n = 1; $n <= $total; $n++ ) :
			if ( $n == $current ) :
				$link = str_replace( '%_%', 1 == $n ? '' : $args['format'], $args['base'] );
				$link = str_replace( '%#%', $n, $link );

				$r[] = array(
					'current' => true,
					'url' => esc_url( apply_filters( 'paginate_links', $link ) ),
					'text' => $n
				);

			else :
				if ( $args['show_all'] || ( $n <= $end_size || ( $current && $n >= $current - $mid_size && $n <= $current + $mid_size ) || $n > $total - $end_size ) ) :
					$link = str_replace( '%_%', 1 == $n ? '' : $args['format'], $args['base'] );
					$link = str_replace( '%#%', $n, $link );

					$r[] = array(
						'url' => esc_url( apply_filters( 'paginate_links', $link ) ),
						'text' => $n
					);

				endif;
			endif;
		endfor;
		if ( $args['prev_next'] && $current && ( $current < $total || -1 == $total ) ) :
			$link = str_replace( '%_%', $args['format'], $args['base'] );
			$link = str_replace( '%#%', $current + 1, $link );

			$r[] = array(
				'next' => true,
				'url' => esc_url( apply_filters( 'paginate_links', $link ) ),
				'text' => $args['next_text']
			);
		endif;

		return $r;

	}

}