<?php
/*
  * Template name: Služby
  */
?>
<?php get_header(); ?>

	<article class="main_content" role="main" itemprop="mainContentOfPage">

		<h1><?php the_title(); ?></h1>

		<?php the_content(); ?>

		<?php $services = get_field( 'services' ); ?>
		<?php if( $services ) : ?>
			<?php $i = 1; foreach( $services as $service ) : ?>
				<div class="columns has-top-margin">

					<?php ob_start(); ?>
						<div class="columns__column is-small">
							<?php if( $service['image'] ) : ?>
								<img src="<?= $service['image']['sizes']['services']; ?>"
								     alt="<?= $service['image']['alt']; ?>"
								     title="<?= $service['image']['caption']; ?>"
								     width="<?= $service['image']['sizes']['services-width']; ?>"
								     height="<?= $service['image']['sizes']['services-height']; ?>" />
							<?php endif; ?>
						</div>
					<?php $image = ob_get_clean(); ?>

					<?php if( $i % 2 !== 0 ){
						echo $image;
					}; ?>

					<div class="columns__column is-big">
						<?php if( $service['title'] ) : ?><h2><?= $service['title']; ?></h2><?php endif; ?>

						<?= $service['description']; ?>

						<?php if( $service['show_link'] ) : ?>
							<a class="button_link" href="<?= $service['link_url']; ?>"><?= $service['link_text']; ?></a>
						<?php endif; ?>
					</div>

					<?php if( $i % 2 === 0 ){
						echo $image;
					}; ?>

				</div>
			<?php $i++; endforeach; ?>


		<?php endif; ?>

	</article>

<?php get_footer(); ?>