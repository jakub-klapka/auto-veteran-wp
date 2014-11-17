<?php global $news_query; ?>
<?php if( $news_query->have_posts() ) : while( $news_query->have_posts() ): $news_query->the_post(); ?>
	<article class="news__item" itemscope itemtype="http://schema.org/NewsArticle">
		<?php if( get_field( 'news_featured_image' ) ) : $image = get_field( 'news_featured_image' ); ?>
			<a href="<?php the_permalink(); ?>" class="news__item__image" itemprop="url">
				<img src="<?= $image['sizes']['news_thumbnail']; ?>"
				     width="<?= $image['sizes']['news_thumbnail-width']; ?>"
				     height="<?= $image['sizes']['news_thumbnail-height']; ?>"
				     title="<?= $image['caption']; ?>"
				     alt="<?php the_title(); ?>" itemprop="image" />
			</a>
		<?php endif; ?>
		<div class="news__item__meta">
			<a href="<?php the_permalink(); ?>" class="news__item__meta__heading">
				<h2 itemprop="name"><?php the_title(); ?></h2>
			</a>
			<time class="news__item__meta__date" datetime="<?= get_the_date( 'c' ); ?>" itemprop="dateCreated"><?= get_the_date(); ?></time>
			<?php get_template_part( 'template_part_excerpt' ); ?>
		</div>
	</article>
<?php endwhile; wp_reset_postdata(); endif; ?>