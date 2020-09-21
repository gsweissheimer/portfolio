<?php
/**
 * The template for displaying the footer.
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Cesis
 */
global $cesis_data;
global $cesis_post;


$to_top = $cesis_data['cesis_to_top'];

$custom_prefooter = redux_post_meta( 'cesis_data', get_the_ID(), 'cesis_meta_prefooter');
$custom_footer = redux_post_meta( 'cesis_data', get_the_ID(), 'cesis_meta_footer');
$custom_footer_bar = redux_post_meta( 'cesis_data', get_the_ID(), 'cesis_meta_footer_bar');
$custom_footer_fixed = redux_post_meta( 'cesis_data', get_the_ID(), 'cesis_meta_footer_fixed');


if(is_404()){

$pre_footer = $cesis_data['cesis_404_prefooter'];
if(isset($cesis_data['cesis_404_pf_block_content'])){
	$blockid = $cesis_data['cesis_404_pf_block_content'];
}else{
	$blockid = "";
}
if(isset($cesis_data['cesis_404_pf_rev_slider'])){
	$sliderid = $cesis_data['cesis_404_pf_rev_slider'];
}
if(isset($cesis_data['cesis_404_pf_layer_slider'])){
$layersliderid = $cesis_data['cesis_404_pf_layer_slider'];
}
}elseif(is_search()){
$pre_footer = $cesis_data['cesis_search_prefooter'];
if(isset($cesis_data['cesis_search_pf_block_content'])){
	$blockid = $cesis_data['cesis_search_pf_block_content'];
}else{
	$blockid = "";
}
if(isset($cesis_data['cesis_search_pf_rev_slider'])){
$sliderid = $cesis_data['cesis_search_pf_rev_slider'];
}
if(isset($cesis_data['cesis_search_pf_layer_slider'])){
$layersliderid = $cesis_data['cesis_search_pf_layer_slider'];
}
}elseif(is_archive() && get_post_type() == 'post' || is_home() ){
$pre_footer = $cesis_data['cesis_post_a_prefooter'];
if(isset($cesis_data['cesis_post_a_pf_block_content'])){
	$blockid = $cesis_data['cesis_post_a_pf_block_content'];
}else{
	$blockid = "";
}
if(isset($cesis_data['cesis_post_a_pf_rev_slider'])){
$sliderid = $cesis_data['cesis_post_a_pf_rev_slider'];
}
if(isset($cesis_data['cesis_post_a_pf_layer_slider'])){
$layersliderid = $cesis_data['cesis_post_a_pf_layer_slider'];
}
}elseif(is_archive() && get_post_type() == 'portfolio'){
$pre_footer = $cesis_data['cesis_portfolio_a_prefooter'];
if(isset($cesis_data['cesis_portfolio_a_pf_block_content'])){
$blockid = $cesis_data['cesis_portfolio_a_pf_block_content'];
}else{
	$blockid = "";
}
if(isset($cesis_data['cesis_portfolio_a_pf_rev_slider'])){
$sliderid = $cesis_data['cesis_portfolio_a_pf_rev_slider'];
}
if(isset($cesis_data['cesis_portfolio_a_pf_layer_slider'])){
$layersliderid = $cesis_data['cesis_portfolio_a_pf_layer_slider'];
}
}elseif(is_archive() && get_post_type() == 'staff'){
$pre_footer = $cesis_data['cesis_staff_a_prefooter'];
if(isset($cesis_data['cesis_staff_a_pf_block_content'])){
$blockid = $cesis_data['cesis_staff_a_pf_block_content'];
}else{
	$blockid = "";
}
if(isset($cesis_data['cesis_staff_a_pf_rev_slider'])){
$sliderid = $cesis_data['cesis_staff_a_pf_rev_slider'];
}
if(isset($cesis_data['cesis_staff_a_pf_layer_slider'])){
$layersliderid = $cesis_data['cesis_staff_a_pf_layer_slider'];
}
}elseif(is_archive() && get_post_type() == 'careers'){
$pre_footer = $cesis_data['cesis_career_a_prefooter'];
if(isset($cesis_data['cesis_career_a_pf_block_content'])){
$blockid = $cesis_data['cesis_career_a_pf_block_content'];
}else{
	$blockid = "";
}
if(isset($cesis_data['cesis_career_a_pf_rev_slider'])){
$sliderid = $cesis_data['cesis_career_a_pf_rev_slider'];
}
if(isset($cesis_data['cesis_career_a_pf_layer_slider'])){
$layersliderid = $cesis_data['cesis_career_a_pf_layer_slider'];
}
}elseif(cesis_check_bbp_status() == true && is_bbpress()){
$pre_footer = $cesis_data['cesis_bbpress_prefooter'];
if(isset($cesis_data['cesis_bbpress_pf_block_content'])){
$blockid = $cesis_data['cesis_bbpress_pf_block_content'];
}else{
	$blockid = "";
}
if(isset($cesis_data['cesis_bbpress_pf_rev_slider'])){
$sliderid = $cesis_data['cesis_bbpress_pf_rev_slider'];
}
if(isset($cesis_data['cesis_bbpress_pf_layer_slider'])){
$layersliderid = $cesis_data['cesis_bbpress_pf_layer_slider'];
}
}elseif(cesis_check_bp_status() == true && is_buddypress()){
$pre_footer = $cesis_data['cesis_buddypress_prefooter'];
if(isset($cesis_data['cesis_buddypress_pf_block_content'])){
$blockid = $cesis_data['cesis_buddypress_pf_block_content'];
}else{
	$blockid = "";
}
if(isset($cesis_data['cesis_buddypress_pf_rev_slider'])){
$sliderid = $cesis_data['cesis_buddypress_pf_rev_slider'];
}
if(isset($cesis_data['cesis_buddypress_pf_layer_slider'])){
$layersliderid = $cesis_data['cesis_buddypress_pf_layer_slider'];
}
}elseif(cesis_check_woo_status() == true && is_shop() || cesis_check_woo_status() == true && is_product_category() || cesis_check_woo_status() == true && is_product_tag()){
$pre_footer = $cesis_data['cesis_product_archive_prefooter'];
if(isset($cesis_data['cesis_product_archive_pf_block_content'])){
$blockid = $cesis_data['cesis_product_archive_pf_block_content'];
}else{
	$blockid = "";
}
if(isset($cesis_data['cesis_product_archive_pf_rev_slider'])){
$sliderid = $cesis_data['cesis_product_archive_pf_rev_slider'];
}
if(isset($cesis_data['cesis_product_archive_pf_layer_slider'])){
$layersliderid = $cesis_data['cesis_product_archive_pf_layer_slider'];
}
}elseif(is_singular() && !is_page()  && get_post_type() !== 'post' && get_post_type() !== 'portfolio' && get_post_type() !== 'staff' && get_post_type() !== 'careers' && get_post_type() !== 'product'){
$pre_footer = $cesis_data['cesis_page_prefooter'];
if(isset($cesis_data['cesis_page_pf_block_content'])){
$blockid = $cesis_data['cesis_page_pf_block_content'];
}else{
	$blockid = "";
}
if(isset($cesis_data['cesis_page_pf_rev_slider'])){
$sliderid = $cesis_data['cesis_page_pf_rev_slider'];
}
if(isset($cesis_data['cesis_page_pf_layer_slider'])){
$layersliderid = $cesis_data['cesis_page_pf_layer_slider'];
}
}elseif($custom_prefooter !== 'inherit'){
$pre_footer = $custom_prefooter;
$blockid = redux_post_meta( 'cesis_data', get_the_ID(), 'cesis_meta_pf_block_content');
$sliderid = redux_post_meta( 'cesis_data', get_the_ID(), 'cesis_meta_pf_rev_slider');
$layersliderid = redux_post_meta( 'cesis_data', get_the_ID(), 'cesis_meta_pf_layer_slider');
}elseif(cesis_check_woo_status() == true && is_product()){
$pre_footer = $cesis_data['cesis_shop_prefooter'];
if(isset($cesis_data['cesis_shop_pf_block_content'])){
$blockid = $cesis_data['cesis_shop_pf_block_content'];
}else{
	$blockid = "";
}
if(isset($cesis_data['cesis_shop_pf_rev_slider'])){
$sliderid = $cesis_data['cesis_shop_pf_rev_slider'];
}
if(isset($cesis_data['cesis_shop_pf_layer_slider'])){
$layersliderid = $cesis_data['cesis_shop_pf_layer_slider'];
}
}elseif(get_post_type() == 'post'){
$pre_footer = $cesis_data['cesis_post_prefooter'];
if(isset($cesis_data['cesis_post_pf_block_content'])){
	$blockid = $cesis_data['cesis_post_pf_block_content'];
}else{
	$blockid = "";
}
if(isset($cesis_data['cesis_post_pf_rev_slider'])){
$sliderid = $cesis_data['cesis_post_pf_rev_slider'];
}
if(isset($cesis_data['cesis_post_pf_layer_slider'])){
$layersliderid = $cesis_data['cesis_post_pf_layer_slider'];
}
}elseif(get_post_type() == 'portfolio'){
$pre_footer = $cesis_data['cesis_portfolio_prefooter'];
if(isset($cesis_data['cesis_portfolio_pf_block_content'])){
	$blockid = $cesis_data['cesis_portfolio_pf_block_content'];
}else{
	$blockid = "";
}
if(isset($cesis_data['cesis_portfolio_pf_rev_slider'])){
$sliderid = $cesis_data['cesis_portfolio_pf_rev_slider'];
}
if(isset($cesis_data['cesis_portfolio_pf_layer_slider'])){
$layersliderid = $cesis_data['cesis_portfolio_pf_layer_slider'];
}
}elseif(get_post_type() == 'staff'){
$pre_footer = $cesis_data['cesis_staff_prefooter'];
if(isset($cesis_data['cesis_staff_pf_block_content'])){
	$blockid = $cesis_data['cesis_staff_pf_block_content'];
}else{
	$blockid = "";
}
if(isset($cesis_data['cesis_staff_pf_rev_slider'])){
$sliderid = $cesis_data['cesis_staff_pf_rev_slider'];
}
if(isset($cesis_data['cesis_staff_pf_layer_slider'])){
$layersliderid = $cesis_data['cesis_staff_pf_layer_slider'];
}
}elseif(get_post_type() == 'careers'){
$pre_footer = $cesis_data['cesis_career_prefooter'];
if(isset($cesis_data['cesis_career_pf_block_content'])){
	$blockid = $cesis_data['cesis_career_pf_block_content'];
}else{
	$blockid = "";
}
if(isset($cesis_data['cesis_career_pf_rev_slider'])){
$sliderid = $cesis_data['cesis_career_pf_rev_slider'];
}
if(isset($cesis_data['cesis_career_pf_layer_slider'])){
$layersliderid = $cesis_data['cesis_career_pf_layer_slider'];
}
}else{
$pre_footer = $cesis_data['cesis_page_prefooter'];
if(isset($cesis_data['cesis_page_pf_block_content'])){
	$blockid = $cesis_data['cesis_page_pf_block_content'];
}else{
	$blockid = "";
}
if(isset($cesis_data['cesis_page_pf_rev_slider'])){
$sliderid = $cesis_data['cesis_page_pf_rev_slider'];
}
if(isset($cesis_data['cesis_page_pf_layer_slider'])){
$layersliderid = $cesis_data['cesis_page_pf_layer_slider'];
}
}

if(is_404()){
$footer = $cesis_data['cesis_404_footer'];
}elseif(is_search()){
$footer = $cesis_data['cesis_search_footer'];
}elseif(is_archive() && get_post_type() == 'post' || is_home() ){
$footer = $cesis_data['cesis_post_a_footer'];
}elseif(is_archive() && get_post_type() == 'portfolio'){
$footer = $cesis_data['cesis_portfolio_a_footer'];
}elseif(is_archive() && get_post_type() == 'staff'){
$footer = $cesis_data['cesis_staff_a_footer'];
}elseif(is_archive() && get_post_type() == 'careers'){
$footer = $cesis_data['cesis_career_a_footer'];
}elseif(cesis_check_bbp_status() == true && is_bbpress()){
$footer = $cesis_data['cesis_bbpress_footer'];
}elseif(cesis_check_bp_status() == true && is_buddypress()){
$footer = $cesis_data['cesis_buddypress_footer'];
}elseif(cesis_check_woo_status() == true && is_shop() || cesis_check_woo_status() == true && is_product_category() || cesis_check_woo_status() == true && is_product_tag()){
$footer = $cesis_data['cesis_product_archive_footer'];
}elseif(is_singular() && !is_page() && get_post_type() !== 'post' && get_post_type() !== 'portfolio' && get_post_type() !== 'staff' && get_post_type() !== 'careers' && get_post_type() !== 'product'){
$footer = $cesis_data['cesis_page_footer'];
}elseif($custom_footer !== 'inherit'){
$footer = $custom_footer;
}elseif(cesis_check_woo_status() == true && is_product()){
$footer = $cesis_data['cesis_shop_footer'];
}elseif(get_post_type() == 'post'){
$footer = $cesis_data['cesis_post_footer'];
}elseif(get_post_type() == 'portfolio'){
$footer = $cesis_data['cesis_portfolio_footer'];
}elseif(get_post_type() == 'staff'){
$footer = $cesis_data['cesis_staff_footer'];
}elseif(get_post_type() == 'careers'){
$footer = $cesis_data['cesis_career_footer'];
}else{
$footer = $cesis_data['cesis_page_footer'];
}

if(is_404()){
$footer_bar = $cesis_data['cesis_404_footer_bar'];
}elseif(is_search()){
$footer_bar = $cesis_data['cesis_search_footer_bar'];
}elseif(is_archive() && get_post_type() == 'post' || is_home() ){
$footer_bar = $cesis_data['cesis_post_a_footer_bar'];
}elseif(is_archive() && get_post_type() == 'portfolio'){
$footer_bar = $cesis_data['cesis_portfolio_a_footer_bar'];
}elseif(is_archive() && get_post_type() == 'staff'){
$footer_bar = $cesis_data['cesis_staff_a_footer_bar'];
}elseif(is_archive() && get_post_type() == 'careers'){
$footer_bar = $cesis_data['cesis_career_a_footer_bar'];
}elseif(cesis_check_bbp_status() == true && is_bbpress()){
$footer_bar = $cesis_data['cesis_bbpress_footer_bar'];
}elseif(cesis_check_bp_status() == true && is_buddypress()){
$footer_bar = $cesis_data['cesis_buddypress_footer_bar'];
}elseif(cesis_check_woo_status() == true && is_shop() || cesis_check_woo_status() == true && is_product_category() || cesis_check_woo_status() == true && is_product_tag()){
$footer_bar = $cesis_data['cesis_product_archive_footer_bar'];
}elseif(is_singular() && !is_page() && get_post_type() !== 'post' && get_post_type() !== 'portfolio' && get_post_type() !== 'staff' && get_post_type() !== 'careers' && get_post_type() !== 'product'){
$footer_bar = $cesis_data['cesis_page_footer_bar'];
}elseif($custom_footer_bar !== 'inherit'){
$footer_bar = $custom_footer_bar;
}elseif(cesis_check_woo_status() == true && is_product()){
$footer_bar = $cesis_data['cesis_shop_footer_bar'];
}elseif(get_post_type() == 'post'){
$footer_bar = $cesis_data['cesis_post_footer_bar'];
}elseif(get_post_type() == 'portfolio'){
$footer_bar = $cesis_data['cesis_portfolio_footer_bar'];
}elseif(get_post_type() == 'staff'){
$footer_bar = $cesis_data['cesis_staff_footer_bar'];
}elseif(get_post_type() == 'careers'){
$footer_bar = $cesis_data['cesis_career_footer_bar'];
}else{
$footer_bar = $cesis_data['cesis_page_footer_bar'];
}

if(is_404()){
$footer_fixed = $cesis_data['cesis_404_footer_fixed'];
}elseif(is_search()){
$footer_fixed = $cesis_data['cesis_search_footer_fixed'];
}elseif(is_archive() && get_post_type() == 'post' || is_home() ){
$footer_fixed = $cesis_data['cesis_post_a_footer_fixed'];
}elseif(is_archive() && get_post_type() == 'portfolio'){
$footer_fixed = $cesis_data['cesis_portfolio_a_footer_fixed'];
}elseif(is_archive() && get_post_type() == 'staff'){
$footer_fixed = $cesis_data['cesis_staff_a_footer_fixed'];
}elseif(is_archive() && get_post_type() == 'careers'){
$footer_fixed = $cesis_data['cesis_career_a_footer_fixed'];
}elseif(cesis_check_bbp_status() == true && is_bbpress()){
$footer_fixed = $cesis_data['cesis_bbpress_footer_fixed'];
}elseif(cesis_check_bp_status() == true && is_buddypress()){
$footer_fixed = $cesis_data['cesis_buddypress_footer_fixed'];
}elseif(cesis_check_woo_status() == true && is_shop() || cesis_check_woo_status() == true && is_product_category() || cesis_check_woo_status() == true && is_product_tag()){
$footer_fixed = $cesis_data['cesis_product_archive_footer_fixed'];
}elseif(is_singular() && !is_page()  && get_post_type() !== 'post' && get_post_type() !== 'portfolio' && get_post_type() !== 'staff' && get_post_type() !== 'careers' && get_post_type() !== 'product'){
$footer_fixed = $cesis_data['cesis_page_footer_fixed'];
}elseif($custom_footer_fixed !== 'inherit'){
$footer_fixed = $custom_footer_fixed;
}elseif(cesis_check_woo_status() == true && is_product()){
$footer_fixed = $cesis_data['cesis_shop_footer_fixed'];
}elseif(get_post_type() == 'post'){
$footer_fixed = $cesis_data['cesis_post_footer_fixed'];
}elseif(get_post_type() == 'portfolio'){
$footer_fixed = $cesis_data['cesis_portfolio_footer_fixed'];
}elseif(get_post_type() == 'staff'){
$footer_fixed = $cesis_data['cesis_staff_footer_fixed'];
}elseif(get_post_type() == 'careers'){
$footer_fixed = $cesis_data['cesis_career_footer_fixed'];
}else{
$footer_fixed = $cesis_data['cesis_page_footer_fixed'];
}



if(is_404() || is_search()){
	$header_search = $cesis_data["cesis_header_additional_search"];
}elseif(redux_post_meta( 'cesis_data', get_the_ID(), 'cesis_meta_header_option') == 'yes'){
	$header_search = redux_post_meta( 'cesis_data', get_the_ID(), 'cesis_meta_header_additional_search');
}else{
	$header_search = $cesis_data["cesis_header_additional_search"];
}

?>

	</div><!-- #content -->

	<footer id="cesis_colophon" class="site-footer scrollmagic-pin-spacer <?php echo esc_attr($footer_fixed); ?>">


<?php

if($pre_footer == 'content' && $blockid !== ""){
$cp_content = get_post_field('post_content', $blockid);
$post_custom_css = get_post_meta( $blockid, '_wpb_post_custom_css', true );
$post_content_custom_css = get_post_meta( $blockid, '_wpb_shortcodes_custom_css', true );
echo "<style>". $post_custom_css . $post_content_custom_css . "</style>";
echo '<div class="footer_content_block"><div class="cesis_container">'.do_shortcode($cp_content).'</div></div>';
}elseif($pre_footer == 'slider' && $sliderid !== "" ){
	echo '<div class="cesis_slider_rev_ctn">'.do_shortcode('[rev_slider alias="'.$sliderid.'"]').'</div>';
}
elseif($pre_footer == 'layerslider' && $layersliderid !== "" ){
	echo '<div class="cesis_slider_rev_ctn">'.do_shortcode('[layerslider id="'.$layersliderid.'"]').'</div>';
}

if($footer == "yes"){
	get_template_part( 'template-parts/footer', 'main' );
}

if($footer_bar == "yes"){
	get_template_part( 'template-parts/footer', 'subbar' );
}

?>

	</footer><!-- #cesis_colophon -->
 <?php if($to_top == true){ ?>
	 <a id="cesis_to_top"><i class="fa-angle-up"></i></a>
 <?php } ?>
</div><!-- #wrapp_all -->
<div class="cesis_search_overlay">
	<div class="cesis_menu_button cesis_search_close open"><span class="lines"></span></div>
	<div class="cesis_search_container">

		<?php echo cesis_search('cesis_s_overlay'); ?>
	</div>
</div>
<?php
wp_footer(); ?>

<!-- Global site tag (gtag.js) - Google Analytics -->
<script async src="https://www.googletagmanager.com/gtag/js?id=UA-167813522-1"></script>
<script>
  window.dataLayer = window.dataLayer || [];
  function gtag(){dataLayer.push(arguments);}
  gtag('js', new Date());

  gtag('config', 'UA-167813522-1');
</script>

</body>
</html>
