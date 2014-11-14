<?php $c = lumi_template( 'Cars' ); ?>
<?php $c->enqueue_styles(); ?>
<?php get_header(); ?>

	<article class="main_content" role="main" itemprop="mainContentOfPage" itemscope itemtype="http://schema.org/Car">

		<h1 itemprop="name"><?php the_title(); ?></h1>

		<?php the_content(); ?>

		<?php if( get_field( 'cars_contact_text', 'option' ) && get_field( 'cars_contact_link', 'option' ) ) : ?>
			<p>
				<a class="button_link" href="<?php the_field( 'cars_contact_link', 'option' ); ?>"><?= $c->strongify_asterix( get_field( 'cars_contact_text', 'option' ) ); ?></a>
			</p>
		<?php endif; ?>

		<?php $gallery = get_field( 'gallery' ); ?>
		<?php if( $gallery ) : ?>
			<section class="stock_gallery">
				<?php foreach( $gallery as $item ) : ?>
					<a href="<?= $item['url']; ?>" class="stock_gallery__item" rel="gallery">
						<img src="<?= $item['sizes']['gallery_thumb']; ?>"
						     width="<?= $item['sizes']['gallery_thumb-width']; ?>"
						     height="<?= $item['sizes']['gallery_thumb-height']; ?>"
						     title="<?= $item['caption']; ?>"
						     alt="<?= $item['alt']; ?>" />
					</a>
				<?php endforeach; ?>
			</section>
		<?php endif; ?>


	</article>

<?php get_footer(); ?>