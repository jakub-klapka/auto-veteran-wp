<?php $l = lumi_template( 'Layout' ); ?>
<!doctype html>
<html <?php language_attributes(); ?> itemscope itemtype="http://schema.org/WebPage">
<head>
	<meta charset="UTF-8">
	<title itemprop="name"><?php wp_title(); ?></title>

	<link rel="shortcut icon" href="<?= get_template_directory_uri(); ?>/assets/images/favicons/favicon.ico">
	<link rel="apple-touch-icon" sizes="57x57" href="<?= get_template_directory_uri(); ?>/assets/images/favicons/apple-touch-icon-57x57.png">
	<link rel="apple-touch-icon" sizes="114x114" href="<?= get_template_directory_uri(); ?>/assets/images/favicons/apple-touch-icon-114x114.png">
	<link rel="apple-touch-icon" sizes="72x72" href="<?= get_template_directory_uri(); ?>/assets/images/favicons/apple-touch-icon-72x72.png">
	<link rel="apple-touch-icon" sizes="144x144" href="<?= get_template_directory_uri(); ?>/assets/images/favicons/apple-touch-icon-144x144.png">
	<link rel="apple-touch-icon" sizes="60x60" href="<?= get_template_directory_uri(); ?>/assets/images/favicons/apple-touch-icon-60x60.png">
	<link rel="apple-touch-icon" sizes="120x120" href="<?= get_template_directory_uri(); ?>/assets/images/favicons/apple-touch-icon-120x120.png">
	<link rel="apple-touch-icon" sizes="76x76" href="<?= get_template_directory_uri(); ?>/assets/images/favicons/apple-touch-icon-76x76.png">
	<link rel="apple-touch-icon" sizes="152x152" href="<?= get_template_directory_uri(); ?>/assets/images/favicons/apple-touch-icon-152x152.png">
	<link rel="apple-touch-icon" sizes="180x180" href="<?= get_template_directory_uri(); ?>/assets/images/favicons/apple-touch-icon-180x180.png">
	<link rel="icon" type="image/png" href="<?= get_template_directory_uri(); ?>/assets/images/favicons/favicon-192x192.png" sizes="192x192">
	<link rel="icon" type="image/png" href="<?= get_template_directory_uri(); ?>/assets/images/favicons/favicon-160x160.png" sizes="160x160">
	<link rel="icon" type="image/png" href="<?= get_template_directory_uri(); ?>/assets/images/favicons/favicon-96x96.png" sizes="96x96">
	<link rel="icon" type="image/png" href="<?= get_template_directory_uri(); ?>/assets/images/favicons/favicon-16x16.png" sizes="16x16">
	<link rel="icon" type="image/png" href="<?= get_template_directory_uri(); ?>/assets/images/favicons/favicon-32x32.png" sizes="32x32">
	<meta name="msapplication-TileColor" content="#ffffff">
	<meta name="msapplication-TileImage" content="<?= get_template_directory_uri(); ?>/assets/images/favicons/mstile-144x144.png">
	<meta name="msapplication-config" content="<?= get_template_directory_uri(); ?>/assets/images/favicons/browserconfig.xml">

	<?php wp_head(); ?>

</head>
<body>

<div class="page_wrap">

	<header class="main_header" itemscope itemtype="http://schema.org/WPHeader">
		<?php //if( basename( get_page_template() ) === 'template_home.php' ) : ?>
			<?php $slider = get_field( 'slider', 'option' ); ?>
			<div id="nivo_slider" class="nivoSlider main_header__image" data-timeout="<?php the_field( 'slider_timeout', 'option' ); ?>">
				<?php $i = 1; foreach( $slider as $item ) : ?>
					<img <?php if( $i !== 1 ) : ?>data-<?php endif; ?>src="<?= $item['sizes']['slider']; ?>"
					     width="<?= $item['sizes']['slider-width']; ?>"
					     height="<?= $item['sizes']['slider-height']; ?>"
					     title="<?= $item['caption']; ?>"
					     alt="<?= $item['alt']; ?>" />
				<?php $i++; endforeach; ?>
			</div>
			<a href="<?php bloginfo('url'); ?>" class="main_header__logo">
				<img src="<?= get_template_directory_uri(); ?>/assets/images/header_logo.png" alt="AVC Logo" width="260" height="60"/>
			</a>
		<?php/* else : ?>
			<?php $image = get_field( 'header_image', 'option' ); ?>
			<img src="<?= $image['sizes']['header_image']; ?>"
			     width="<?= $image['sizes']['header_image-width']; ?>"
			     height="<?= $image['sizes']['header_image-height']; ?>"
			     alt="Auto Veteran" class="main_header__image" itemprop="image"/>
		<?php endif; */?>

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