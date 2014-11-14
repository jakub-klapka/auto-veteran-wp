<?php


namespace Lumi\Admin;


class News {

	public function __construct() {
	
		add_action( 'admin_init', array( $this, 'add_archive_menu' ) );
	
	}


	public function add_archive_menu() {
		add_meta_box(
			'news-archive-menu',
			'Archív novinek',
			array( $this, 'nav_menu_link'),
			'nav-menus',
			'side',
			'low'
		);
	}
	public function nav_menu_link() {
		$url = ( ICL_LANGUAGE_CODE === 'cs' ) ? get_post_type_archive_link( 'news' ) : get_bloginfo( 'url' ) . '/en/news/';
		?>
		<div id="news-archive-menu" class="posttypediv">
			<div id="tabs-panel-news-archive-menu" class="tabs-panel tabs-panel-active">
				<ul id ="news-archive-menu-checklist" class="categorychecklist form-no-clear">
					<li>
						<label class="menu-item-title">
							<input type="checkbox" class="menu-item-checkbox" name="menu-item[-1][menu-item-object-id]" value="-1" checked>Archív novinek
						</label>
						<input type="hidden" class="menu-item-type" name="menu-item[-1][menu-item-type]" value="custom">
						<input type="hidden" class="menu-item-title" name="menu-item[-1][menu-item-title]"
						       value="<?= ( ICL_LANGUAGE_CODE === 'cs' ) ? 'Novinky' : 'News'; ?>">
						<input type="hidden" class="menu-item-url" name="menu-item[-1][menu-item-url]"
						       value="<?= $url; ?>">
					</li>
				</ul>
			</div>
			<p class="button-controls">
				<span class="add-to-menu">
				<input type="submit" class="button-secondary submit-add-to-menu right" value="Přidat do menu" name="add-post-type-menu-item" id="submit-news-archive-menu">
				<span class="spinner"></span>
				</span>
			</p>
		</div>
	<?php }


}