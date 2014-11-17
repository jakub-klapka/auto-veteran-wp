<?php
/*
  * Template name: Hlavní stránka
  */
$h = lumi_template( 'Home' );
$h->enqueue_scripts();
?>
<?php get_header(); ?>

	<div class="content_block_row" role="main">
		<section class="content_block_row__small content_block_section has-header home_about_us">
			<h1 class="content_block_section__header"><?php _e( 'O nás', LUMI_TEXTDOMAIN ); ?></h1>
			<img src="<?= get_template_directory_uri(); ?>/assets/images/logo.svg" width="200" height="44" alt="AVC Logo" class="home_about_us__logo"/>

			<?php the_content(); ?>

			<?php $links = get_field( 'about_us_links' ); ?>
			<?php if( $links ): foreach( $links as $link ) : ?>
				<a class="home_about_us__button" href="<?= $link['link']; ?>"><?= $link['text']; ?></a>
			<?php endforeach; endif ?>
		</section>

		<section class="content_block_row__big content_block_section has-header home_recent_videos" data-video-carousel>
			<script type="text/template" data-video-carousel-template>
				<iframe width="590" height="332" src="//www.youtube.com/embed/[[YT_ID]]?autoplay=1" frameborder="0" allowfullscreen></iframe>
			</script>
			<h1 class="content_block_section__header"><?php _e( 'Nejnovejší videa', LUMI_TEXTDOMAIN ); ?></h1>
			<?php $videos = $h->get_videos(); ?>
			<div class="home_recent_videos__main_video" itemscope itemtype="http://schema.org/VideoObject" data-video-carousel-main_video>
				<iframe width="590" height="332" src="//www.youtube.com/embed/<?= $videos[0]['id']; ?>" frameborder="0" allowfullscreen></iframe>
				<meta itemprop="url" content="http://www.youtube.com?watch=<?= $videos[0]['id']; ?>"/>
				<meta itemprop="name" content="<?= $videos[0]['title']; ?>"/>
				<meta itemprop="thumbnail" content="//img.youtube.com/vi/<?= $videos[0]['id']; ?>/default.jpg"/>
			</div>
			<div class="home_recent_videos__video_strip">
				<?php $i = 1; foreach( $videos as $video ) : ?>
					<button class="home_recent_videos__video_strip__button<?php if( $i === 1 ) : ?> is-active<?php endif; ?>" data-yt-id="<?= $video['id']; ?>" itemscope itemtype="http://schema.org/VideoObject" data-video-carousel-item>
						<img class="home_recent_videos__video_strip__button__image" src="//img.youtube.com/vi/<?= $video['id']; ?>/mqdefault.jpg" alt="<?= $video['title']; ?>" itemprop="thumbnail"/>
						<span class="home_recent_videos__video_strip__button__desc" itemprop="name"><?= $video['title']; ?></span>
						<meta itemprop="url" content="http://www.youtube.com?watch=<?= $video['id']; ?>"/>
					</button>
				<?php $i++; endforeach; ?>
			</div>

			<?php if( get_field( 'videos_link' ) ) : ?>
				<a class="content_block_section__more_link" href="<?php the_field( 'videos_link' ); ?>"><?php _e( 'Více', LUMI_TEXTDOMAIN ); ?></a>
			<?php endif; ?>
		</section>
	</div>

	<section class="content_block_section stock" role="main">
		<h1 class="content_block_section__header"><?php _e( 'Aktuální nabídka', LUMI_TEXTDOMAIN ); ?></h1>

		<?php $stock_query = $h->set_stock_query(); ?>
		<?php get_template_part( 'template_part_stock_items' ); ?>

		<?php if( get_field( 'stock_link' ) ) : ?>
			<a class="content_block_section__more_link" href="<?php the_field( 'stock_link' ); ?>"><?php _e( 'Více', LUMI_TEXTDOMAIN ); ?></a>
		<?php endif; ?>
	</section>

	<div class="content_block_row" role="main">

		<section class="content_block_row__big content_block_section has-header news">
			<h1 class="content_block_section__header"><?php _e( 'Novinky', LUMI_TEXTDOMAIN ); ?></h1>

			<?php $news_query = $h->set_news_query(); ?>
			<?php get_template_part( 'template_part_news_items' ); ?>

			<?php if( get_field( 'news_link' ) ) : ?>
				<a class="content_block_section__more_link" href="<?php the_field( 'news_link' ); ?>"><?php _e( 'Více', LUMI_TEXTDOMAIN ); ?></a>
			<?php endif; ?>
		</section>

		<?php $news_sidebar_header = __( 'Nevím co sem', LUMI_TEXTDOMAIN ); ?>
		<?php get_template_part( 'template_part_news_sidebar' ); ?>
		<?php $news_sidebar_header = false; ?>

	</div>

<?php get_footer(); ?>