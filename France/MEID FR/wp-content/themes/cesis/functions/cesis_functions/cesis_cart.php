<?php
//Cart dropdown
if(!function_exists('cesis_cart'))
{

	function cesis_cart($type = null){
		if(cesis_check_woo_status() == 'true') {
		global $cesis_data;
		global $woocommerce;
		if($type == 'mobile'){
			$cart_content = '
			<span class=" cesis_cart_icon '.$type.'">
			 <a href="'.	esc_url(wc_get_cart_url()).'" class="tcart-content"><i class="fa fa-bag2 "><span class="current_item_number">'.$woocommerce->cart->cart_contents_count.'</span></i>
			 </a>
			</span>';
		}
		elseif($type == 'vertical'){
			$cart_content = '
			<span class=" cesis_cart_icon '.$type.'">
			 <a href="'.	esc_url(wc_get_cart_url()).'" class="tcart-content"><i class="fa fa-bag2 "><span class="current_item_number">'.$woocommerce->cart->cart_contents_count.'</span></i><span>'.__('Cart', 'cesis').'</span>

			 </a>
			</span>';
		}
		else{
			$cart_content = '
			<span class=" cesis_cart_icon '.$type.'">
			<ul class="sm cart-menu">
				<li><a href="'.	esc_url(wc_get_cart_url()).'" class="tcart-content"><i class="fa fa-bag2 "><span class="current_item_number">'.$woocommerce->cart->cart_contents_count.'</span></a></i>
					<ul class="cesis_dropdown">
						<div class="widget_shopping_cart_content"></div>
					</ul>
				</li>
			</ul>
			</span>';
		}
	}else {
		$cart_content = '';
	}
	return $cart_content;
	}

}
