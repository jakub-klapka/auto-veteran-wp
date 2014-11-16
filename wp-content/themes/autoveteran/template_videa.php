<?php
/*
 * Template name: Stránka s výpisem videí
 */
$v = lumi_template( 'Videos' );
?>
<?php get_header(); ?>

	<div class="content_block_row is-no-stretch">

		<article class="content_block_row__big content_block_section main_content" role="main" itemprop="mainContentOfPage">

			<h1><?php the_title(); ?></h1>

			<?php the_content(); ?>

			<?php $videos = $v->get_all_videos(); ?>
			<?php $i = 1; foreach( $videos as $video ) : ?>
				<?php if( $i !== 1 ) : ?><hr/><?php endif; ?>
				<h2><?= $video['title']; ?></h2>
				<iframe width="550" height="309" src="//www.youtube.com/embed/<?= $video['id']; ?>" frameborder="0" allowfullscreen></iframe>
			<?php $i++; endforeach; ?>

		</article>

		<aside class="content_block_row__small content_block_section main_content">
			<?php if( get_field( 'youtube_channel_url', 'option' ) ) : ?>
				<a href="<?php the_field( 'youtube_channel_url', 'option' ); ?>">
					<img src="<?= get_template_directory_uri(); ?>/assets//images/youtube_logo.png"
					     alt="<?php _e( 'Youtube kanál', LUMI_TEXTDOMAIN ); ?>"
					     width="170" height="71" class="aligncenter"/>
				</a>
			<?php endif; ?>
			<?php the_field( 'sidebar_teaser' ); ?>
			<?php if( get_field( 'youtube_channel_url', 'option' ) ) : ?>
				<a class="button_link" href="<?php the_field( 'youtube_channel_url', 'option' ); ?>"><?php _e( 'Odebírat', LUMI_TEXTDOMAIN ); ?></a>
			<?php endif; ?>
		</aside>

	</div>

<?php get_footer(); ?>