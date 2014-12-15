<?php


namespace Lumi\Admin;


class Cars {

	public function __construct() {
	
		add_action( 'manage_cars_posts_columns', array( $this, 'add_sold_columns' ), 20 );
		add_action( 'manage_cars_posts_custom_column', array( $this, 'add_columns_content' ), 10, 2 );

		add_action( 'restrict_manage_posts', array( $this, 'add_filter_dropdown' ) );
		add_action( 'parse_query', array( $this, 'filter_cars' ) );
	
	}

	public function add_sold_columns( $columns ) {
		$new = array( 'sold' => 'Stav nabídky' );
		$before = array_slice( $columns, 0, 2 );
		$after = array_slice( $columns, 2 );
		return array_merge( $before, $new, $after );
	}

	public function add_columns_content( $column_name, $post_id ) {
		if( $column_name !== 'sold' ) return;

		$sold = get_field( 'sold', $post_id );
		if( $sold ) {
			echo '<span style="color: grey; font-weight: bold;">Předchozí</span>';
		} else {
			echo '<span style="color: green; font-weight: bold;">Aktivní</span>';
		}
	}

	public function add_filter_dropdown() {
		$type = 'post';
		if (isset($_GET['post_type'])) {
			$type = $_GET['post_type'];
		}

		//only add filter to post type you want
		if ('cars' == $type){
			//change this to the list of values you want to show
			//in 'label' => 'value' format
			$values = array(
				'Aktivní' => 'active',
				'Předchozí' => 'sold'
			);
			?>
			<select name="filter_status">
				<option value="">- Filtrovat dle stavu nabídky -</option>
				<?php
				$current_v = isset($_GET['filter_status'])? $_GET['filter_status']:'';
				foreach ($values as $label => $value) {
					printf
					(
						'<option value="%s"%s>%s</option>',
						$value,
						$value == $current_v ? ' selected="selected"':'',
						$label
					);
				}
				?>
			</select>
		<?php
		}
	}

	public function filter_cars( $query ) {
		global $pagenow;
		$type = 'post';
		if (isset($_GET['post_type'])) {
			$type = $_GET['post_type'];
		}
		if ( 'cars' == $type && is_admin() && $pagenow=='edit.php' && isset($_GET['filter_status']) && $_GET['filter_status'] != '') {
			$query->query_vars['meta_key'] = 'sold';
			$query->query_vars['meta_value'] = ( $_GET['filter_status'] == 'active' ) ? 0 : 1;
		}
	}

}