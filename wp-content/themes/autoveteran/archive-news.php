<?php $a = lumi_template( 'NewsArchive' ); ?>
<?php $a->enqueue_styles(); ?>
<?php get_header(); ?>

	<div class="content_block_row is-no-stretch">

		<section class="content_block_row__big content_block_section news" role="main" itemprop="mainContentOfPage">

			<div class="typo news_heading">
				<h1><?php _e( 'Archív novinek', LUMI_TEXTDOMAIN ); ?></h1>
			</div>

			<?php global $wp_query; $news_query = $wp_query; ?>
			<?php get_template_part( 'template_part_news_items' ); ?>

			<?php $pagination = $a->get_pagination(); ?>
			<?php if( $pagination ) : ?>
				<nav class="news__pagination" role="navigation">
					<ul class="news__pagination__menu" itemscope itemtype="http://schema.org/SiteNavigationElement">
						<?php foreach( $pagination as $item ) : ?>
							<li class="news__pagination__menu__item<?php if( isset( $item['current'] ) ) : ?> is-active<?php endif; ?>">
								<a href="<?= $item['url']; ?>" itemprop="url name"><?= $item['text']; ?></a>
							</li>
						<?php endforeach; ?>
					</ul>
				</nav>
			<?php endif; ?>

		</section>

		<?php get_template_part( 'template_part_news_sidebar' ); ?>

	</div>

<?php get_footer(); ?>