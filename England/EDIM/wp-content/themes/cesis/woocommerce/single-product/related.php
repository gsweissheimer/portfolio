<?php
/**
 * Related Products
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/single-product/related.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see 	    https://docs.woocommerce.com/document/template-structure/
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     3.0.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

if ( $related_products ) : ?>

	<section class="related products">
	<div class="cesis_container product_container">
		<h5 class="cesis_related_heading"><?php esc_html_e( 'Related products', 'woocommerce' ); ?></h5>

		<ul class="cesis_carousel_products cesis_owl_carousel cesis_owl_pag_1" data-margin="40" data-col="4" data-col_tablet="2" data-scroll="no" data-col_mobile="1" data-margin="0" data-loop="yes" data-pag="yes" data-pag_tablet="yes" data-pag_mobile="yes" >

			<?php foreach ( $related_products as $related_product ) : ?>

				<?php
				 	$post_object = get_post( $related_product->get_id() );

					setup_postdata( $GLOBALS['post'] =& $post_object );

					wc_get_template_part( 'content', 'product' ); ?>

			<?php endforeach; ?>

		<?php woocommerce_product_loop_end(); ?>
	</div>
	</section>

<?php endif;

wp_reset_postdata();
