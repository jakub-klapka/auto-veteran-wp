<?php
/*
 * Template name: Stránka s výpisem videí
 */
?>
<?php get_header(); ?>

	<div class="content_block_row is-no-stretch">

		<article class="content_block_row__big content_block_section main_content" role="main" itemprop="mainContentOfPage">

			<?php the_content(); ?>

			<h2>Video 1</h2>
			<iframe width="550" height="309" src="//www.youtube.com/embed/GyRvb6Hfzi8" frameborder="0" allowfullscreen></iframe>

			<hr/>

			<h2>Video 2</h2>
			<iframe width="550" height="309" src="//www.youtube.com/embed/GyRvb6Hfzi8" frameborder="0" allowfullscreen></iframe>

			<hr/>

			<h2>Video 3</h2>
			<iframe width="550" height="309" src="//www.youtube.com/embed/GyRvb6Hfzi8" frameborder="0" allowfullscreen></iframe>

			<hr/>

			<h2>Video 4</h2>
			<iframe width="550" height="309" src="//www.youtube.com/embed/GyRvb6Hfzi8" frameborder="0" allowfullscreen></iframe>

			<hr/>

			<h2>Video 5</h2>
			<iframe width="550" height="309" src="//www.youtube.com/embed/GyRvb6Hfzi8" frameborder="0" allowfullscreen></iframe>

			<hr/>

			<h2>Video 6</h2>
			<iframe width="550" height="309" src="//www.youtube.com/embed/GyRvb6Hfzi8" frameborder="0" allowfullscreen></iframe>



		</article>

		<aside class="content_block_row__small content_block_section main_content">
			<?php if( get_field( 'yt_channel_url' ) ) : ?>
				<a href="<?php the_field( 'yt_channel_url' ); ?>">
					<img src="<?= get_template_directory_uri(); ?>/assets//images/youtube_logo.png"
					     alt="<?php _e( 'Youtube kanál', LUMI_TEXTDOMAIN ); ?>"
					     width="170" height="71" class="aligncenter"/>
				</a>
			<?php endif; ?>
			<?php the_field( 'sidebar_teaser' ); ?>
			<?php if( get_field( 'yt_channel_url' ) ) : ?>
				<a class="button_link" href="<?php the_field( 'yt_channel_url' ); ?>"><?php _e( 'Odebírat', LUMI_TEXTDOMAIN ); ?></a>
			<?php endif; ?>
		</aside>

	</div>

<?php get_footer(); ?>