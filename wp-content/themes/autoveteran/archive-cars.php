<?php $c = lumi_template( 'CarsArchive' ); ?>
<?php $c->enqueue_scripts(); ?>
<?php get_header(); ?>

	<article class="main_content stock" role="main" itemprop="mainContentOfPage">

		<h1 class="stock__heading"><?php _e( 'Aktuální nabídka', LUMI_TEXTDOMAIN ); ?></h1>

		<?php if( have_posts() ) : while( have_posts() ) : the_post(); ?>
			<a href="<?php the_permalink(); ?>" class="stock__item" itemscope itemtype="http://schema.org/Car">
				<?php if( get_field( 'featured_image' ) ) : $image = get_field( 'featured_image' ) ?>
					<div class="stock__image">
						<img src="<?= $image['sizes']['cars_thumbnail']; ?>"
						     width="<?= $image['sizes']['cars_thumbnail-width']; ?>"
						     height="<?= $image['sizes']['cars_thumbnail-height']; ?>"
						     alt="<?php the_title(); ?>" itemprop="image"/>
					</div>
				<?php endif; ?>
				<div class="stock__name" itemprop="name"><?php the_title(); ?></div>
				<meta itemprop="url" content="<?php the_permalink(); ?>"/>
			</a>
		<?php endwhile; endif; ?>

	</article>

<?php get_footer(); ?>