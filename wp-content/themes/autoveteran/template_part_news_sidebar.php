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