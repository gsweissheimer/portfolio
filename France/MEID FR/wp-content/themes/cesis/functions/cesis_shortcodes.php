<?php
/*-----------------------------------------------------------------------------------




	Load the Theme Shortcodes




-----------------------------------------------------------------------------------*/

$shortcode_buttons = array();

require_once('cesis_shortcodes/cesis_blog.php');
require_once('cesis_shortcodes/cesis_button.php');
require_once('cesis_shortcodes/cesis_breadcrumb.php');
require_once('cesis_shortcodes/cesis_career.php');
require_once('cesis_shortcodes/cesis_cf7.php');
require_once('cesis_shortcodes/cesis_circular_progress_bar.php');
require_once('cesis_shortcodes/cesis_content_slider.php');
require_once('cesis_shortcodes/cesis_count_to.php');
require_once('cesis_shortcodes/cesis_flip_box.php');
require_once('cesis_shortcodes/cesis_gallery.php');
require_once('cesis_shortcodes/cesis_gmaps.php');
require_once('cesis_shortcodes/cesis_icon_box.php');
require_once('cesis_shortcodes/cesis_icon_list.php');
require_once('cesis_shortcodes/cesis_icon_paragraph.php');
require_once('cesis_shortcodes/cesis_icon.php');
require_once('cesis_shortcodes/cesis_line_divider.php');
require_once('cesis_shortcodes/cesis_partners.php');
require_once('cesis_shortcodes/cesis_portfolio.php');
require_once('cesis_shortcodes/cesis_post_info.php');
require_once('cesis_shortcodes/cesis_price_tables.php');
require_once('cesis_shortcodes/cesis_progress_bar.php');
require_once('cesis_shortcodes/cesis_share_shortcode.php');
require_once('cesis_shortcodes/cesis_staff.php');
require_once('cesis_shortcodes/cesis_testimonials.php');
require_once('cesis_shortcodes/cesis_timeline.php');

if( cesis_check_woo_status() == true) {
  require_once('cesis_shortcodes/cesis_woocommerce.php');
}


?>
