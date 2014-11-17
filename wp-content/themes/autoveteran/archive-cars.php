<?php $c = lumi_template( 'CarsArchive' ); ?>
<?php $c->enqueue_scripts(); ?>
<?php $sold = ( get_query_var( 'sold' ) ) ? true : false; ?>
<?php get_header(); ?>

	<article class="main_content stock" role="main" itemprop="mainContentOfPage">

		<h1 class="stock__heading"><?php if( !$sold ) { _e( 'Aktuální nabídka', LUMI_TEXTDOMAIN ); } else { _e( 'Minulá nabídka', LUMI_TEXTDOMAIN ); } ?></h1>

		<?php $image_tag = ( $sold ) ? 'div' : 'a'; ?>
		<?php if( have_posts() ) : while( have_posts() ) : the_post(); ?>
			<<?= $image_tag; ?><?php if( !$sold ) : ?> href="<?php the_permalink(); ?>"<?php endif; ?>
				class="stock__item" itemscope itemtype="http://schema.org/Car">
				<?php if( get_field( 'featured_image' ) ) : $image = get_field( 'featured_image' ) ?>
					<div class="stock__image">
						<img src="<?= $image['sizes']['cars_thumbnail']; ?>"
						     width="<?= $image['sizes']['cars_thumbnail-width']; ?>"
						     height="<?= $image['sizes']['cars_thumbnail-height']; ?>"
						     alt="<?php the_title(); ?>" itemprop="image"/>
					</div>
				<?php endif; ?>
				<div class="stock__name" itemprop="name"><?php the_title(); ?></div>
				<?php if( !$sold ) : ?><meta itemprop="url" content="<?php the_permalink(); ?>"/><?php endif; ?>
			</<?= $image_tag; ?>>
		<?php endwhile; endif; ?>

	</article>

<?php get_footer(); ?>