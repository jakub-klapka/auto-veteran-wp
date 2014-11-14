<?php $n = lumi_template( 'News' ); ?>
<?php $n->enqueue_styles(); ?>
<?php get_header(); ?>

	<div class="content_block_row is-no-stretch">

		<article class="content_block_row__big content_block_section news_detail main_content" role="main" itemprop="mainContentOfPage" itemscope itemtype="http://schema.org/NewsArticle">

			<h1 itemprop="name"><?php the_title(); ?></h1>
			<time class="news_detail__date" datetime="<?= get_the_date( 'c' ); ?>" itemprop="dateCreated"><?= get_the_date(); ?></time>

			<?php the_content(); ?>

			<?php $image = ( get_field( 'show_featured_in_news' ) ) ? get_field( 'news_featured_image' ) : get_field( 'image_in_news' ); ?>
			<?php if( $image ) : ?>
				<p><img src="<?= $image['sizes']['news_full_post']; ?>"
				        width="<?= $image['sizes']['news_full_post-width']; ?>"
				        height="<?= $image['sizes']['news_full_post-height']; ?>"
				        alt="<?= $image['alt']; ?>"
				        title="<?= $image['caption']; ?>"
				        class="aligncenter" /></p>
			<?php endif; ?>


		</article>

		<?php get_template_part( 'template_part_news_sidebar' ); ?>

	</div>

<?php get_footer(); ?>