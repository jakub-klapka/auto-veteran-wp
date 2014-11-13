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

		<aside class="content_block_row__small content_block_section news_sidebar">

			<div class="news_sidebar__text">
				<?php the_field( 'news_sidebar_text', 'option' ); ?>
			</div>

			<?php if( get_field( 'news_sidebar_fb_link', 'option' ) ) : ?>
				<div id="fb-root"></div>
				<script>(function(d, s, id) {
						var js, fjs = d.getElementsByTagName(s)[0];
						if (d.getElementById(id)) return;
						js = d.createElement(s); js.id = id;
						js.src = "//connect.facebook.net/cs_CZ/sdk.js#xfbml=1&version=v2.0";
						fjs.parentNode.insertBefore(js, fjs);
					}(document, 'script', 'facebook-jssdk'));</script>
				<div class="fb-like-box" data-href="<?php the_field( 'news_sidebar_fb_link', 'option' ); ?>" data-width="310" data-colorscheme="light" data-show-faces="false" data-header="true" data-stream="true" data-show-border="false"></div>
			<?php endif; ?>

		</aside>

	</div>

<?php get_footer(); ?>