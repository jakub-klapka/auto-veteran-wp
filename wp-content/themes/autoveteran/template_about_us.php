<?php
/*
  * Template name: O nás
  */
$a = lumi_template( 'AboutUs' );
?>
<?php get_header(); ?>

	<article class="main_content" role="main" itemprop="mainContentOfPage">

		<h1><?php the_title(); ?></h1>

		<div class="columns">

			<section class="columns__column">
				<?php the_content(); ?>
				<?php if( get_field( 'founder_image' ) ) : ?>
					<p>
						<a class="media_object alignright" href="<?php the_field( 'founder_link' ); ?>">
							<?php $image = get_field( 'founder_image' ); ?>
							<img src="<?= $image['sizes']['about_us_founder']; ?>"
							     width="<?= $image['sizes']['about_us_founder-width']; ?>"
							     height="<?= $image['sizes']['about_us_founder-height']; ?>"
							     alt="<?= $image['alt']; ?>" title="<?= $image['caption']; ?>"
							     class="media_object__image" />
							<span class="media_object__desc">
								<?= $a->get_founder_description(); ?>
							</span>
						</a>
					</p>
				<?php endif; ?>
			</section>

			<div class="columns__column">
				<?php $image = get_field( 'right_image' ); ?>
				<?php if( $image ) : ?>
					<img src="<?= $image['sizes']['about_us']; ?>"
					     width="<?= $image['sizes']['about_us-width']; ?>"
					     height="<?= $image['sizes']['about_us-height']; ?>"
					     title="<?= $image['caption']; ?>"
					     alt="<?= $image['alt']; ?>" />
				<?php endif; ?>
			</div>

		</div>

	</article>

<?php get_footer(); ?>