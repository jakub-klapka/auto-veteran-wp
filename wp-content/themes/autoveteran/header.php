<?php $l = lumi_template( 'Layout' ); ?>
<!doctype html>
<html <?php language_attributes(); ?> itemscope itemtype="http://schema.org/WebPage">
<head>
	<meta charset="UTF-8">
	<title itemprop="name"><?php wp_title(); ?></title>

	<?php wp_head(); ?>

</head>
<body>

<div class="page_wrap">

	<header class="main_header" itemscope itemtype="http://schema.org/WPHeader">
		<img src="<?= $l->header_logo_url(); ?>" alt="Auto Veteran" class="main_header__image" itemprop="image"/>

		<nav class="main_header__nav" role="navigation">
			<?= $l->get_main_menu(); ?>
			<ul class="main_header__nav__language" itemscope itemtype="http://schema.org/SiteNavigationElement" >
				<?php $langs = $l->get_language_links(); ?>
				<?php foreach( $langs as $lang ) : ?>
					<li class="main_header__nav__language__item"><a href="<?= $lang['url']; ?>" itemprop="url name"><?= strtoupper( $lang['language_code'] ); ?></a></li>
				<?php endforeach; ?>
			</ul>
		</nav>

	</header>