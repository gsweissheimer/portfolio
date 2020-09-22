<?php
/*-----------------------------------------------------------------------------------

	Load Woocommerce additional / modified functions

-----------------------------------------------------------------------------------*/

if ( ! function_exists( 'woocommerce_review_display_gravatar' ) ) {
    /**
     * Display the review authors gravatar
     *
     * @param array $comment WP_Comment.
     * @return void
     */
    function woocommerce_review_display_gravatar( $comment ) {
        echo get_avatar( $comment, apply_filters( 'woocommerce_review_gravatar_size', '150' ), '' );
    }
}


if ( ! function_exists( 'cesis_woocommerce_product_layout' ) ) {
    /**
     * Change the product display
    */
    function cesis_woocommerce_product_layout() {

    }
}

if ( ! function_exists( 'cesis_woocommerce_share' ) ) {
    /**
     * Add the share icons
    */
    function cesis_woocommerce_share() {
      global $cesis_data;
      $share = $cesis_data['cesis_shop_sp_share'];

      if ( cesis_check_ccp_status() == false ) {
        $share = "no";
      }
      if($share == 'yes' && cesis_check_ccp_status() !== false){
        echo '<div class="product_share"><span class="meta_container"><span class="meta_label">'.__('Share', 'cesis').'</span>';
        echo cesis_share('simple');
        echo '</span></div>';
      }

    }

add_action( 'woocommerce_share', 'cesis_woocommerce_share' );
}



if ( ! function_exists( 'cesis_woocommerce_header_dropdown_cart_fragment' ) ) {

function cesis_woocommerce_header_dropdown_cart_fragment( $fragments ) {
	global $woocommerce;

	ob_start();?>
  <span class="current_item_number"><?php echo $woocommerce->cart->cart_contents_count;?></span>
  <?php $fragments['span.current_item_number'] = ob_get_clean();
	return $fragments;

}

add_filter('woocommerce_add_to_cart_fragments', 'cesis_woocommerce_header_dropdown_cart_fragment');

}



function cesis_woo_thumbnail()
{
	global $product;
	$rating = wc_get_rating_html($product->get_average_rating()); //get rating

	$id = get_the_ID();
	$size = 'woocommerce_thumbnail';

  ob_start();
	echo "<div class='cesis_product_thumbnail_container'>";
  echo woocommerce_template_loop_product_link_open();
	echo cesis_woo_gallery_first_thumb( $id , $size);
	echo get_the_post_thumbnail( $id , $size );
  echo woocommerce_template_loop_product_link_close();
  echo '<div class="cesis_add_to_cart">';
  echo woocommerce_template_loop_add_to_cart();
  echo '</div>';
	if($product->get_type() == 'simple') echo "<div class='item_current_status'><span class='icon_status_inner'></span></div>";
	echo "</div>";
	$output_string = ob_get_contents();
	ob_end_clean();
	echo $output_string;
}


function cesis_woo_gallery_first_thumb($id, $size)
{
	$active_hover = redux_post_meta( 'cesis_data', get_the_ID(),  'cesis_meta_product_hover' );

	if($active_hover == 'yes')
	{
		$product_gallery = get_post_meta( $id, '_product_image_gallery', true );

		if(!empty($product_gallery))
		{
			$gallery	= explode(',',$product_gallery);
			$image_id 	= $gallery[0];
			$image 		= wp_get_attachment_image( $image_id, $size, false, array( 'class' => "attachment-$size woo_product_hover" ));

			if(!empty($image)) return $image;
		}
	}
}

remove_action ('woocommerce_before_shop_loop_item', 'woocommerce_template_loop_product_link_open', 10);
remove_action( 'woocommerce_after_shop_loop_item', 'woocommerce_template_loop_add_to_cart', 10 );
remove_action( 'woocommerce_before_shop_loop_item_title', 'woocommerce_template_loop_product_thumbnail', 10);
remove_action( 'woocommerce_before_main_content', 'woocommerce_output_content_wrapper', 10);
remove_action( 'woocommerce_after_main_content', 'woocommerce_output_content_wrapper_end', 10);


add_action( 'woocommerce_before_shop_loop_item_title', 'cesis_woo_thumbnail', 10);
add_action ('woocommerce_before_shop_loop_item_title', 'woocommerce_template_loop_product_link_open', 15);

?>
