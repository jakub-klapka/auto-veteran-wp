<?php


namespace Lumi\Template;


use Lumi\Classes\MainMenuWalker;

class Layout {


	public function get_main_menu() {
		return wp_nav_menu( array(
			'theme_location'  => 'main_menu',
			'container'       => false,
			'menu_class'      => 'main_header__nav__menu',
			'echo'            => false,
			'items_wrap'      => '<ul class="%2$s" itemscope itemtype="http://schema.org/SiteNavigationElement" >%3$s</ul>',
			'depth'           => -1,
			'walker'          => new MainMenuWalker(),
			'item_class' => 'main_header__nav__menu__item'
		) );
	}

	public function get_footer_menu() {
		return wp_nav_menu( array(
			'theme_location'  => 'footer_menu',
			'container'       => false,
			'menu_class'      => 'main_footer_nav__menu',
			'echo'            => false,
			'items_wrap'      => '<ul class="%2$s" itemscope itemtype="http://schema.org/SiteNavigationElement" >%3$s</ul>',
			'depth'           => -1,
			'walker'          => new MainMenuWalker(),
			'item_class' => 'main_footer_nav__menu__item'
		) );
	}


	public function get_language_links() {
		$languages = icl_get_languages('skip_missing=0');
		if( is_post_type_archive( 'cars' ) & get_query_var( 'sold' ) == true ) {
			//fix url for sold archive
			foreach( $languages as $key => $value ) {
				$url = $value['url'];
				$append = ( $key === 'cs' ) ? 'predchozi' : 'previous';
				$languages[$key]['url'] = $url . $append . '/';
			}
		}
		return $languages;
	}

}