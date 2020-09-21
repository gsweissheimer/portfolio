<?php
//Logo related functions
if(!function_exists('cesis_generate_logo'))
{


	function cesis_generate_logo(){
		global $cesis_data;

		ob_start();
		$dark_logo = $white_logo = $mobile_logo = $mobile_cart_content = $mobile_notifications_content = $has_cart = "";
		$custom_mobile = redux_post_meta( 'cesis_data', get_the_ID(), 'cesis_meta_custom_mobile');
		$custom_general_settings = redux_post_meta( 'cesis_data', get_the_ID(), 'cesis_meta_custom_general_settings');


		if($custom_mobile == 'yes' && !is_archive()){
		  $mobile_cart = redux_post_meta( 'cesis_data', get_the_ID(), 'cesis_meta_mobile_cart');
		  $mobile_notifications = redux_post_meta( 'cesis_data', get_the_ID(), 'cesis_meta_mobile_notifications');
		}else{
			$mobile_cart = $cesis_data["cesis_mobile_cart"];
			$mobile_notifications = $cesis_data["cesis_mobile_notifications"];
		  $mobile_add_btn = $cesis_data["cesis_mobile_additional_btn"];
		  $mobile_add_btn_text = $cesis_data["cesis_mobile_a_btn_text"];
		  $mobile_add_btn_link = $cesis_data["cesis_mobile_a_btn_link"];
		  $mobile_add_btn_target = $cesis_data["cesis_mobile_a_btn_target"];
		  $mobile_btn = $cesis_data["cesis_mobile_additional_btn"];

		}



		$protocol = is_ssl() ? 'https:' : 'http:';
		if($cesis_data['cesis_logo']['url'] !== ''){
			$dark_logo = $cesis_data['cesis_logo']['url'];
			$dark_logo = preg_replace("/^http:/i", $protocol, $dark_logo);
		}
		if($cesis_data['cesis_white_logo']['url'] !== '' ){
			$white_logo = $cesis_data['cesis_white_logo']['url'];
			$white_logo = preg_replace("/^http:/i", $protocol, $white_logo);
		}else{
			$white_logo = $cesis_data['cesis_logo']['url'];
			$white_logo = preg_replace("/^http:/i", $protocol, $white_logo);
		}
		if($cesis_data['cesis_mobile_logo']['url'] !== ''){
			$mobile_logo = $cesis_data['cesis_mobile_logo']['url'];
			$mobile_logo = preg_replace("/^http:/i", $protocol, $mobile_logo);
		}else{
			$mobile_logo = $cesis_data['cesis_logo']['url'];
			$mobile_logo = preg_replace("/^http:/i", $protocol, $mobile_logo);
		}


		if($custom_general_settings == 'yes' && !is_archive()){
			$cesis_logo = redux_post_meta( 'cesis_data', get_the_ID(), 'cesis_meta_logo');
			$cesis_white_logo = redux_post_meta( 'cesis_data', get_the_ID(), 'cesis_meta_white_logo');
			$cesis_mobile_logo = redux_post_meta( 'cesis_data', get_the_ID(), 'cesis_meta_mobile_logo');
			$cesis_custom_logo_link = redux_post_meta( 'cesis_data', get_the_ID(), 'cesis_meta_logo_custom_link');
			if($cesis_logo['url'] !== ''){
				$dark_logo = $cesis_logo['url'];
				$dark_logo = preg_replace("/^http:/i", $protocol, $dark_logo);
			}
			if($cesis_white_logo['url'] !== '' ){
				$white_logo = $cesis_white_logo['url'];
				$white_logo = preg_replace("/^http:/i", $protocol, $white_logo);
			}else{
				$white_logo = $cesis_logo['url'];
				$white_logo = preg_replace("/^http:/i", $protocol, $white_logo);
			}
			if($cesis_mobile_logo['url'] !== ''){
				$mobile_logo = $cesis_mobile_logo['url'];
				$mobile_logo = preg_replace("/^http:/i", $protocol, $mobile_logo);
			}else{
				$mobile_logo = $cesis_logo['url'];
				$mobile_logo = preg_replace("/^http:/i", $protocol, $mobile_logo);
			}
			if($cesis_custom_logo_link == 'yes'){
				$logo_link = redux_post_meta( 'cesis_data', get_the_ID(), 'cesis_meta_logo_link_url');
			}
			else{
				$logo_link = home_url('');
			}
		}else{
			if($cesis_data['cesis_logo']['url'] !== ''){
				$dark_logo = $cesis_data['cesis_logo']['url'];
				$dark_logo = preg_replace("/^http:/i", $protocol, $dark_logo);
			}
			if($cesis_data['cesis_white_logo']['url'] !== '' ){
				$white_logo = $cesis_data['cesis_white_logo']['url'];
				$white_logo = preg_replace("/^http:/i", $protocol, $white_logo);
			}else{
				$white_logo = $cesis_data['cesis_logo']['url'];
				$white_logo = preg_replace("/^http:/i", $protocol, $white_logo);
			}
			if($cesis_data['cesis_mobile_logo']['url'] !== ''){
				$mobile_logo = $cesis_data['cesis_mobile_logo']['url'];
				$mobile_logo = preg_replace("/^http:/i", $protocol, $mobile_logo);
			}else{
				$mobile_logo = $cesis_data['cesis_logo']['url'];
				$mobile_logo = preg_replace("/^http:/i", $protocol, $mobile_logo);
			}
			if($cesis_data['cesis_logo_custom_link'] == 'yes'){
				$logo_link = $cesis_data['cesis_logo_link_url'];
			}else{
				$logo_link = home_url('');
			}
		}
		if($mobile_cart == 'yes'){
		  $mobile_cart_content = cesis_cart('mobile');
			$has_cart = 'has_cart';
		}
		if($mobile_notifications == 'yes' && cesis_check_bp_status() == true){
		  $mobile_notifications_content = cesis_bp_notifications('i','');
		}

		if ($cesis_data['cesis_logo']['url'] !== '') { ?>
		<div id="logo_img">
			<a href="<?php echo $logo_link ?>">
				<img class="white_logo desktop_logo" src="<?php echo esc_url($white_logo); ?>" alt="<?php bloginfo( 'name' ); ?>" title="<?php bloginfo( 'name' ); ?>"/>
				<img class="dark_logo desktop_logo" src="<?php echo esc_url($dark_logo); ?>" alt="<?php bloginfo( 'name' ); ?>" title="<?php bloginfo( 'name' ); ?>"/>
				<img class="mobile_logo" src="<?php echo esc_url($mobile_logo); ?>" alt="<?php bloginfo( 'name' ); ?>" title="<?php bloginfo( 'name' ); ?>"/>
			</a>
		</div>

		<?php }else { ?>
		      <?php if ( is_front_page() && is_home() ) : ?>
		      <p class="site-title"><a href="<?php echo $logo_link ?>" rel="home">
		        <?php bloginfo( 'name' ); ?>
					</a></p>
		      <?php else : ?>
		      <p class="site-title"><a href="<?php echo $logo_link ?>" rel="home">
		        <?php bloginfo( 'name' ); ?>
		        </a></p>
		      <?php endif; ?>
		      <p class="site-description">
		        <?php bloginfo( 'description' ); ?>
		      </p>
		<?php } ?>

		  <div class="cesis_menu_button cesis_mobile_menu_switch"><span class="lines"></span></div>
			<?php if($mobile_cart !== 'no' || $mobile_notifications !== 'no' || $mobile_btn == 'yes'){ ?>
			<div class="cesis_mobile_extra">
		  <?php
			if($mobile_cart !== 'no'){ ?>
			<div class="cesis_mobile_cart"><?php echo $mobile_cart_content ?></div>
			<?php } ?>
			<?php if($mobile_notifications !== 'no'){ ?>
			<div class="cesis_mobile_notifications <?php echo esc_attr( $has_cart ); ?>"><?php echo $mobile_notifications_content ?></div>
			<?php }
			if($mobile_btn == 'yes'){
				$mobile_btn_content = '<div class="cesis_mobile_btn"><a href="'.$mobile_add_btn_link.'" target="'.$mobile_add_btn_target.'"><span>'.$mobile_add_btn_text.'</span></a></div>';
				echo $mobile_btn_content;
			}
			?>
			</div>
			<?php
			}


		$output_string = ob_get_contents();

		ob_end_clean();

		return $output_string;

	}

}
