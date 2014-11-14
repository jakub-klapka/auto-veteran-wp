<?php $a = lumi_template( 'NewsArchive' ); ?>
<?php $a->enqueue_styles(); ?>
<?php get_header(); ?>

	<div class="content_block_row is-no-stretch">

		<section class="content_block_row__big content_block_section news" role="main" itemprop="mainContentOfPage">

			<div class="typo news_heading">
				<h1><?php _e( 'Archív novinek', LUMI_TEXTDOMAIN ); ?></h1>
			</div>

			<?php if( have_posts() ) : while( have_posts() ): the_post(); ?>
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
<!--						<p class="news__item__meta__excerpt">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Amet atque autem debitis dignissimos et exercitationem fugiat fugit ipsa, maiores, nulla odio perspiciatis possimus, repellat similique sint sit ullam vero. Quasi!</p>-->
					</div>
				</article>
			<?php endwhile; endif; ?>

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