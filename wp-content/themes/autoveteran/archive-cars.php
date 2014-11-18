<?php $c = lumi_template( 'CarsArchive' ); ?>
<?php $c->enqueue_scripts(); ?>
<?php $sold = ( get_query_var( 'sold' ) ) ? true : false; ?>
<?php get_header(); ?>

	<article class="main_content stock" role="main" itemprop="mainContentOfPage">

		<h1 class="stock__heading"><?php if( !$sold ) { _e( 'Aktuální nabídka', LUMI_TEXTDOMAIN ); } else { _e( 'Předchozí nabídka', LUMI_TEXTDOMAIN ); } ?></h1>

		<?php global $wp_query; $stock_query = $wp_query; ?>
		<?php get_template_part( 'template_part_stock_items' ); ?>

	</article>

<?php get_footer(); ?>