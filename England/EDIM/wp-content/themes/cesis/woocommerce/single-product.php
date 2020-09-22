<?php
/**
 * The Template for displaying all single products
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/single-product.php.
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
 * @version     1.6.4
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

global $cesis_data;

get_header( 'shop' );

$custom_banner = redux_post_meta( 'cesis_data', get_the_ID(), 'cesis_meta_banner');
$custom_banner_pos = redux_post_meta( 'cesis_data', get_the_ID(), 'cesis_meta_banner_pos');


if($custom_banner !== 'inherit'){
	$banner_type = $custom_banner;
	$blockid = redux_post_meta( 'cesis_data', get_the_ID(), 'cesis_meta_block_content');
	$sliderid = redux_post_meta( 'cesis_data', get_the_ID(), 'cesis_meta_rev_slider');
	$layersliderid = redux_post_meta( 'cesis_data', get_the_ID(), 'cesis_meta_layer_slider');
	if($custom_banner_pos !== 'inherit'){
		$banner_pos = $custom_banner_pos;
	}else {
		$banner_pos = $cesis_data['cesis_shop_banner_pos'];
	}
}else {
	$banner_type = $cesis_data['cesis_shop_banner'];
	$banner_pos = $cesis_data['cesis_shop_banner_pos'];
	$blockid = $cesis_data['cesis_shop_block_content'];
	$sliderid = $cesis_data['cesis_shop_rev_slider'];
	$layersliderid = $cesis_data['cesis_shop_layer_slider'];
}

if($banner_type == 'content' && $blockid !== "" && $banner_pos == 'under'){
$cp_content = get_post_field('post_content', $blockid);
visual_composer()->addPageCustomCss( $blockid );
visual_composer()->addShortcodesCustomCss( $blockid );

$post_custom_css = get_post_meta( $blockid, '_wpb_post_custom_css', true );
$post_content_custom_css = get_post_meta( $blockid, '_wpb_shortcodes_custom_css', true );
echo "<style>". $post_custom_css . $post_content_custom_css . "</style>";
echo '<div class="cesis_top_banner"><div class="cesis_container">'.do_shortcode($cp_content).'</div></div>';
}
if($banner_type == 'slider' && $sliderid !== "" && $banner_pos == 'under'){
	echo '<div class="cesis_slider_rev_ctn">'.do_shortcode('[rev_slider alias="'.$sliderid.'"]').'</div>';
}
elseif($banner_type == 'layerslider' && $layersliderid !== "" && $banner_pos == 'under'){
	echo '<div class="cesis_slider_rev_ctn">'.do_shortcode('[layerslider id="'.$layersliderid.'"]').'</div>';
}

$custom_layout = redux_post_meta( 'cesis_data', get_the_ID(), 'cesis_meta_page_custom_layout');

$custom_title = redux_post_meta( 'cesis_data', get_the_ID(), 'cesis_meta_custom_title');
if($custom_title  == 'yes'){
	$use_title = redux_post_meta( 'cesis_data', get_the_ID(), 'cesis_meta_title');
}

else{
	$use_title = $cesis_data['cesis_shop_title'];
}

if($use_title == 'yes') {
	echo cesis_title();
}

do_action( 'cesis_after_main_title' );
 ?>

 <main id="cesis_main" class="site-main vc_full_width_row_container" role="main">
	 <div class="cesis_container product_container">
	<?php
		/**
		 * woocommerce_before_main_content hook.
		 *
		 * @hooked woocommerce_output_content_wrapper - 10 (outputs opening divs for the content)
		 * @hooked woocommerce_breadcrumb - 20
		 */
		do_action( 'woocommerce_before_main_content' );
		wc_print_notices();
	?>
</div>
		<?php while ( have_posts() ) : the_post(); ?>

			<?php wc_get_template_part( 'content', 'single-product' ); ?>

		<?php endwhile; // end of the loop. ?>

	<?php
		/**
		 * woocommerce_after_main_content hook.
		 *
		 * @hooked woocommerce_output_content_wrapper_end - 10 (outputs closing divs for the content)
		 */
		do_action( 'woocommerce_after_main_content' );
	?>

	<?php
		/**
		 * woocommerce_sidebar hook.
		 *
		 * @hooked woocommerce_get_sidebar - 10
		 * Sidebar removed, added in the content part.
		 */
		// do_action( 'woocommerce_sidebar' );
	?>
</main>
<!-- #cesis_main -->
<?php get_footer( 'shop' );

/* Omit closing PHP tag at the end of PHP files to avoid "headers already sent" issues. */
