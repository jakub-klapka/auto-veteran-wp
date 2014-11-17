<?php global $stock_query; ?>
<?php $sold = ( get_query_var( 'sold' ) ) ? true : false; ?>
<?php $image_tag = ( $sold ) ? 'div' : 'a'; ?>
<?php if( $stock_query->have_posts() ) : while( $stock_query->have_posts() ) : $stock_query->the_post(); ?>
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
<?php endwhile; wp_reset_postdata(); endif; ?>