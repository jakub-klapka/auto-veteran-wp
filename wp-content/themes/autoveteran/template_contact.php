<?php
/*
  * Template name: Kontaktní stránka
  */
$c = lumi_template( 'Contact' );
$c->enqueue_styles();
?>
<?php get_header(); ?>

	<article class="main_content" role="main" itemprop="mainContentOfPage" itemscope itemtype="http://schema.org/ContactPage">

		<h1><?php the_title(); ?></h1>

		<div class="columns">

			<section class="columns__column">

				<table class="contact_us__address_table" itemscope itemtype="http://schema.org/Organization">
					<?php if( get_field( 'address' ) ) : ?>
						<tr>
							<td class="contact_us__label"><?php _e( 'Adresa', LUMI_TEXTDOMAIN ); ?>:</td>
							<td><address itemprop="address"><?= $c->bold_first_line( get_field( 'address' ) ); ?></address></td>
						</tr>
					<?php endif; ?>
					<?php if( get_field( 'tel' ) ) : ?>
						<tr>
							<td class="contact_us__label"><?php _e( 'Telefon', LUMI_TEXTDOMAIN ); ?>:</td>
							<td><tel itemprop="telephone"><?php the_field( 'tel' ); ?></tel></td>
						</tr>
					<?php endif; ?>
					<?php if( get_field( 'mobile' ) ) : ?>
						<tr>
							<td class="contact_us__label"><?php _e( 'Mobilní telefon', LUMI_TEXTDOMAIN ); ?>:</td>
							<td><tel itemprop="telephone"><?php the_field( 'mobile' ); ?></tel></td>
						</tr>
					<?php endif; ?>
					<?php if( get_field( 'email' ) ) : ?>
						<tr>
							<td class="contact_us__label"><?php _e( 'E-mail', LUMI_TEXTDOMAIN ); ?>:</td>
							<td itemprop="email"><?= do_shortcode( '[lumi-email]' . get_field( 'email' ) . '[/lumi-email]' ); ?></td>
						</tr>
					<?php endif; ?>
				</table>

				<table class="contact_us__ident_table">
					<tr>
						<?php if( get_field( 'ic' ) || get_field( 'dic' ) ) : ?>
							<td>
								<?php if( get_field( 'ic' ) ) : ?><span class="contact_us__label"><?php _e( 'IČ', LUMI_TEXTDOMAIN ); ?>:</span> <?php the_field( 'ic' ); ?><br/><?php endif; ?>
								<?php if( get_field( 'dic' ) ) : ?><span class="contact_us__label"><?php _e( 'DIČ', LUMI_TEXTDOMAIN ); ?>:</span> <?php the_field( 'dic' ); ?><?php endif; ?>
							</td>
						<?php endif; ?>
						<?php if( get_field( 'ident_info' ) ) : ?>
							<td>
								<?php the_field( 'ident_info' ); ?>
							</td>
						<?php endif; ?>
					</tr>
				</table>

				<?php if( get_field( 'position_title' ) ) : ?>
					<h2><?php the_field( 'position_title' ); ?></h2>
				<?php endif; ?>

				<table class="contact_us__address_table">
					<?php if( get_field( 'position_name' ) ) : ?>
						<tr>
							<td class="contact_us__label"><?php _e( 'Jméno', LUMI_TEXTDOMAIN ); ?>:</td>
							<td><strong><?php the_field( 'position_name' ); ?></strong></td>
						</tr>
					<?php endif; ?>
					<?php if( get_field( 'position_tel' ) ) : ?>
						<tr>
							<td class="contact_us__label"><?php _e( 'Mobilní telefon', LUMI_TEXTDOMAIN ); ?>:</td>
							<td><?php the_field( 'position_tel' ); ?></td>
						</tr>
					<?php endif; ?>
					<?php if( get_field( 'position_email' ) ) : ?>
						<tr>
							<td class="contact_us__label"><?php _e( 'E-mail', LUMI_TEXTDOMAIN ); ?>:</td>
							<td><?= do_shortcode( '[lumi-email]' . get_field( 'position_email' ) . '[/lumi-email]' ); ?></td>
						</tr>
					<?php endif; ?>
				</table>

			</section>

			<section class="columns_column">

				<h2><?php _e( 'Pošlete nám zprávu', LUMI_TEXTDOMAIN ); ?></h2>

				<?php if( ICL_LANGUAGE_CODE === 'cs' ) : ?>
					<?= do_shortcode( '[contact-form-7 id="109" title="Kontaktní formulář CZ" html_class="contact_us__form"]' ); ?>
				<?php endif; ?>
				<?php if( ICL_LANGUAGE_CODE === 'en' ) : ?>
					<?= do_shortcode( '[contact-form-7 id="853" title="Kontaktní formulář EN" html_class="contact_us__form"]' ); ?>
				<?php endif; ?>


			</section>

		</div>

		<a class="contact_us__map" href="<?php the_field( 'map_link' ); ?>" target="_blank">
			<img src="<?= get_template_directory_uri(); ?>/assets/images/contact_map_<?= ICL_LANGUAGE_CODE; ?>.png" alt="<?php _e( 'AVC na mapě', LUMI_TEXTDOMAIN ); ?>"/>
			<div class="contact_us__map__button"><?php _e( 'Zvětšit mapu', LUMI_TEXTDOMAIN ); ?></div>
		</a>

	</article>

<?php get_footer(); ?>