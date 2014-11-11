<?php $l = lumi_template( 'Layout' ); ?>
	<footer class="main_footer" role="contentinfo" itemscope itemtype="http://schema.org/WPFooter">

		<div class="main_footer__copyright">
			Created by <a href="http://www.pixia.cz">Pixia.cz</a>
		</div>

		<nav class="main_footer_nav" role="navigation">
			<?= $l->get_footer_menu(); ?>
		</nav>

	</footer>


</div>
<?php wp_footer(); ?>
</body>
</html>