<?php


namespace Lumi\Admin;


class CarsArchive {

	public function __construct() {
	
		add_action( 'admin_init', array( $this, 'add_archive_to_menu' ) );
	
	}


	public function add_archive_to_menu() {
		add_meta_box(
			'cars_archive_link',
			__('Seznam aut'),
			array( $this, 'nav_menu_link'),
			'nav-menus',
			'side',
			'low'
		);
	}

	public function nav_menu_link() {?>
		<div id="cars-archive-links" class="posttypediv">
			<div id="tabs-panel-cars-archive-links" class="tabs-panel tabs-panel-active">
				<ul id ="cars-archive-links-checklist" class="categorychecklist form-no-clear">
					<li>
						<label class="menu-item-title">
							<input type="checkbox" class="menu-item-checkbox" name="menu-item[-1][menu-item-object-id]" value="-1">Aktuální nabídka
						</label>
						<input type="hidden" class="menu-item-type" name="menu-item[-1][menu-item-type]" value="custom">
						<input type="hidden" class="menu-item-title" name="menu-item[-1][menu-item-title]"
						       value="<?= ( ICL_LANGUAGE_CODE === 'cs' ) ? 'Aktuální nabídka' : 'Current stock'; ?>">
						<input type="hidden" class="menu-item-url" name="menu-item[-1][menu-item-url]" value="<?= get_post_type_archive_link( 'cars' ); ?>">
					</li>
					<li>
						<label class="menu-item-title">
							<input type="checkbox" class="menu-item-checkbox" name="menu-item[-2][menu-item-object-id]" value="-2">Minulá nabídka
						</label>
						<input type="hidden" class="menu-item-type" name="menu-item[-2][menu-item-type]" value="custom">
						<input type="hidden" class="menu-item-title" name="menu-item[-2][menu-item-title]"
						       value="<?= ( ICL_LANGUAGE_CODE === 'cs' ) ? 'Minulá nabídka' : 'Previous stock'; ?>">
						<input type="hidden" class="menu-item-url" name="menu-item[-2][menu-item-url]"
						       value="<?= get_post_type_archive_link( 'cars' ); ?><?= ( ICL_LANGUAGE_CODE === 'cs' ) ? 'predchozi/' : 'previous/'; ?>">
					</li>

				</ul>
			</div>
			<p class="button-controls">
				<span class="add-to-menu">
				<input type="submit" class="button-secondary submit-add-to-menu right" value="Přidat do menu" name="add-post-type-menu-item" id="submit-cars-archive-links">
				<span class="spinner"></span>
				</span>
			</p>
		</div>
	<?php }


}