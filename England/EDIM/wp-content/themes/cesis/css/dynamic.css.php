<?php //prevent direct access
 if(!is_customize_preview()){
 header( "Content-type: text/css; charset: UTF-8" );
 header("Last-Modified: ".gmdate('D, d M Y H:i:s', filemtime($_SERVER['DOCUMENT_ROOT'].$_SERVER['PHP_SELF']))." GMT");
 header("Expires: ".gmdate('D, d M Y H:i:s', (filemtime($_SERVER['DOCUMENT_ROOT'].$_SERVER['PHP_SELF']) + 691200))." GMT");


//Function for compressing the CSS as tightly as possible
function compress($buffer) {
    //Remove CSS comments
    $buffer = preg_replace('!/\*[^*]*\*+([^/][^*]*\*+)*/!', '', $buffer);
    //Remove tabs, spaces, newlines, etc.
    $buffer = str_replace(array("\r\n", "\r", "\n", "\t", '  ', '    ', '    '), '', $buffer);
    return $buffer;
}

//This GZIPs the CSS for transmission to the user
//making file size smaller and transfer rate quicker
ob_start("ob_gzhandler");

 }

 global $cesis_data;
 global $post;

?>



/*--------------------------------------------------------------
#0 Body settings
--------------------------------------------------------------*/

<?php

  $body_bg_color = $cesis_data['cesis_body_background']['background-color'];
  // Background image.
  $body_bg_image = $cesis_data['cesis_body_background']['background-image'];
  // Background image options
  $body_bg_repeat = $cesis_data['cesis_body_background']['background-repeat'];
  $body_bg_position = $cesis_data['cesis_body_background']['background-position'];
  $body_bg_size = $cesis_data['cesis_body_background']['background-size'];
  $body_bg_attachement = $cesis_data['cesis_body_background']['background-attachment'];


	$body_layout = $cesis_data['cesis_body_type'];
  $body_width = $cesis_data['cesis_body_width'];

  if($body_bg_image !== '') { ?>
  body {
  background-image:url(<?php echo esc_attr($body_bg_image);?>);
  background-repeat:<?php echo esc_attr($body_bg_repeat);?>;
  background-position:<?php echo esc_attr($body_bg_position);?>;
  background-size:<?php echo esc_attr($body_bg_size);?>;
  background-attachment:<?php echo esc_attr($body_bg_attachement);?>;
  background-color:<?php echo esc_attr($body_bg_color);?>;
  }
<?php }else{ ?>
  body{
    background-color:<?php echo esc_attr($body_bg_color);?>;
  }
<?php }
	$body_layout = $cesis_data['cesis_body_type'];

  if($body_layout == 'cesis_body_boxed') { ?>
  body.cesis_body_boxed,body.cesis_body_boxed .cesis_sticky {
    max-width:<?php echo esc_attr($body_width);?>px;
  }
<?php }?>



/*--------------------------------------------------------------
#1 Fonts / Typography
--------------------------------------------------------------*/

<?php

$site_main_font = $cesis_data["cesis_site_main_font"]['font-family'];
$site_main_font_size = $cesis_data["cesis_site_main_font"]['font-size'];
$site_main_font_weight = $cesis_data["cesis_site_main_font"]['font-weight'];
$site_main_font_lh = $cesis_data["cesis_site_main_font"]['line-height'];
$site_main_font_ls = $cesis_data["cesis_site_main_font"]['letter-spacing'];


$site_p_margin = $cesis_data["cesis_site_p_margin"];

$site_alt_font = $cesis_data["cesis_site_alt_font"]['font-family'];

$site_h1_font = $cesis_data["cesis_site_h1_font"]['font-family'];
$site_h1_font_size = $cesis_data["cesis_site_h1_font"]['font-size'];
$site_h1_font_weight = $cesis_data["cesis_site_h1_font"]['font-weight'];
$site_h1_font_lh = $cesis_data["cesis_site_h1_font"]['line-height'];
$site_h1_font_ls = $cesis_data["cesis_site_h1_font"]['letter-spacing'];
$site_h1_margin = $cesis_data["cesis_site_h1_margin"];

$site_h2_font = $cesis_data["cesis_site_h2_font"]['font-family'];
$site_h2_font_size = $cesis_data["cesis_site_h2_font"]['font-size'];
$site_h2_font_weight = $cesis_data["cesis_site_h2_font"]['font-weight'];
$site_h2_font_lh = $cesis_data["cesis_site_h2_font"]['line-height'];
$site_h2_font_ls = $cesis_data["cesis_site_h2_font"]['letter-spacing'];
$site_h2_margin = $cesis_data["cesis_site_h2_margin"];

$site_h3_font = $cesis_data["cesis_site_h3_font"]['font-family'];
$site_h3_font_size = $cesis_data["cesis_site_h3_font"]['font-size'];
$site_h3_font_weight = $cesis_data["cesis_site_h3_font"]['font-weight'];
$site_h3_font_lh = $cesis_data["cesis_site_h3_font"]['line-height'];
$site_h3_font_ls = $cesis_data["cesis_site_h3_font"]['letter-spacing'];
$site_h3_margin = $cesis_data["cesis_site_h3_margin"];

$site_h4_font = $cesis_data["cesis_site_h4_font"]['font-family'];
$site_h4_font_size = $cesis_data["cesis_site_h4_font"]['font-size'];
$site_h4_font_weight = $cesis_data["cesis_site_h4_font"]['font-weight'];
$site_h4_font_lh = $cesis_data["cesis_site_h4_font"]['line-height'];
$site_h4_font_ls = $cesis_data["cesis_site_h4_font"]['letter-spacing'];
$site_h4_margin = $cesis_data["cesis_site_h4_margin"];

$site_h5_font = $cesis_data["cesis_site_h5_font"]['font-family'];
$site_h5_font_size = $cesis_data["cesis_site_h5_font"]['font-size'];
$site_h5_font_weight = $cesis_data["cesis_site_h5_font"]['font-weight'];
$site_h5_font_lh = $cesis_data["cesis_site_h5_font"]['line-height'];
$site_h5_font_ls = $cesis_data["cesis_site_h5_font"]['letter-spacing'];
$site_h5_margin = $cesis_data["cesis_site_h5_margin"];

$site_h6_font = $cesis_data["cesis_site_h6_font"]['font-family'];
$site_h6_font_size = $cesis_data["cesis_site_h6_font"]['font-size'];
$site_h6_font_weight = $cesis_data["cesis_site_h6_font"]['font-weight'];
$site_h6_font_lh = $cesis_data["cesis_site_h6_font"]['line-height'];
$site_h6_font_ls = $cesis_data["cesis_site_h6_font"]['letter-spacing'];
$site_h6_margin = $cesis_data["cesis_site_h6_margin"];

$site_quote_font = $cesis_data["cesis_site_quote_font"]['font-family'];
$site_quote_font_size = $cesis_data["cesis_site_quote_font"]['font-size'];
$site_quote_font_weight = $cesis_data["cesis_site_quote_font"]['font-weight'];
$site_quote_font_lh = $cesis_data["cesis_site_quote_font"]['line-height'];
$site_quote_font_ls = $cesis_data["cesis_site_quote_font"]['letter-spacing'];

// if($site_main_font == "Aileron" || $site_h1_font == "Aileron" || $site_h2_font == "Aileron" || $site_h3_font == "Aileron" || $site_h4_font == "Aileron" || $site_h5_font == "Aileron" || $site_h6_font == "Aileron" || $site_alt_font == "Aileron"){
?>


@font-face {
    font-family: "Aileron";
    src: url("<?php echo get_template_directory_uri(); ?>/includes/fonts/aileron/Aileron-Italic.otf");
 }
@font-face {
    font-family: "Aileron";
    src: url("<?php echo get_template_directory_uri(); ?>/includes/fonts/aileron/Aileron-BoldItalic.otf");
    font-weight: bold;
}
@font-face {
    font-family: "Aileron";
    src: url("<?php echo get_template_directory_uri(); ?>/includes/fonts/aileron/Aileron-LightItalic.otf");
    font-weight: 300;
}
@font-face {
    font-family: "Aileron";
    src: url("<?php echo get_template_directory_uri(); ?>/includes/fonts/aileron/Aileron-Regular.otf");
}
@font-face {
    font-family: "Aileron";
    src: url("<?php echo get_template_directory_uri(); ?>/includes/fonts/aileron/Aileron-Bold.otf");
    font-weight: bold;
}
@font-face {
    font-family: "Aileron";
    src: url("<?php echo get_template_directory_uri(); ?>/includes/fonts/aileron/Aileron-SemiBold.otf");
    font-weight: 600;
}
@font-face {
    font-family: "Aileron";
    src: url("<?php echo get_template_directory_uri(); ?>/includes/fonts/aileron/Aileron-Light.otf");
    font-weight: 300;
}


<?php //} ?>

body,.cesis_header_content_block{ font-family:<?php echo esc_attr($site_main_font); ?>; font-size:<?php echo esc_attr($site_main_font_size); ?>; line-height:<?php echo esc_attr($site_main_font_lh); ?>; letter-spacing:<?php echo esc_attr($site_main_font_ls); ?>; font-weight:<?php echo esc_attr($site_main_font_weight); ?>; }
p{margin:0 0 <?php echo esc_attr($site_p_margin); ?>px 0;}
h1{ font-family:<?php echo esc_attr($site_h1_font); ?>; font-size:<?php echo esc_attr($site_h1_font_size); ?>; line-height:<?php echo esc_attr($site_h1_font_lh); ?>; letter-spacing:<?php echo esc_attr($site_h1_font_ls); ?>;  font-weight:<?php echo esc_attr($site_h1_font_weight); ?>; margin-bottom:<?php echo esc_attr($site_h1_margin); ?>px;}
h2{ font-family:<?php echo esc_attr($site_h2_font); ?>; font-size:<?php echo esc_attr($site_h2_font_size); ?>; line-height:<?php echo esc_attr($site_h2_font_lh); ?>; letter-spacing:<?php echo esc_attr($site_h2_font_ls); ?>;  font-weight:<?php echo esc_attr($site_h2_font_weight); ?>; margin-bottom:<?php echo esc_attr($site_h2_margin); ?>px;}
h3{ font-family:<?php echo esc_attr($site_h3_font); ?>; font-size:<?php echo esc_attr($site_h3_font_size); ?>; line-height:<?php echo esc_attr($site_h3_font_lh); ?>; letter-spacing:<?php echo esc_attr($site_h3_font_ls); ?>;  font-weight:<?php echo esc_attr($site_h3_font_weight); ?>; margin-bottom:<?php echo esc_attr($site_h3_margin); ?>px;}
h4{ font-family:<?php echo esc_attr($site_h4_font); ?>; font-size:<?php echo esc_attr($site_h4_font_size); ?>; line-height:<?php echo esc_attr($site_h4_font_lh); ?>; letter-spacing:<?php echo esc_attr($site_h4_font_ls); ?>;  font-weight:<?php echo esc_attr($site_h4_font_weight); ?>; margin-bottom:<?php echo esc_attr($site_h4_margin); ?>px;}
h5{ font-family:<?php echo esc_attr($site_h5_font); ?>; font-size:<?php echo esc_attr($site_h5_font_size); ?>; line-height:<?php echo esc_attr($site_h5_font_lh); ?>; letter-spacing:<?php echo esc_attr($site_h5_font_ls); ?>;  font-weight:<?php echo esc_attr($site_h5_font_weight); ?>; margin-bottom:<?php echo esc_attr($site_h5_margin); ?>px;}
h6{ font-family:<?php echo esc_attr($site_h6_font); ?>; font-size:<?php echo esc_attr($site_h6_font_size); ?>; line-height:<?php echo esc_attr($site_h6_font_lh); ?>; letter-spacing:<?php echo esc_attr($site_h6_font_ls); ?>;  font-weight:<?php echo esc_attr($site_h6_font_weight); ?>; margin-bottom:<?php echo esc_attr($site_h6_margin); ?>px;}
blockquote{ font-family:<?php echo esc_attr($site_quote_font); ?>; font-size:<?php echo esc_attr($site_quote_font_size); ?>; line-height:<?php echo esc_attr($site_quote_font_lh); ?>; letter-spacing:<?php echo esc_attr($site_quote_font_ls); ?>;  font-weight:<?php echo esc_attr($site_quote_font_weight); ?>;}

.agency_container .author-info h3,.agency_comments_ctn .author,.comments-layout-seven .author{ font-family:<?php echo esc_attr($site_h2_font); ?>;  font-weight:<?php echo esc_attr($site_h2_font_weight); ?>;}


.main_font,.cesis_pb_10 .vc_label_units,.cesis_pb_10 .vc_label_units,
input[type="text"],input[type="email"],input[type="url"],
input[type="password"],input[type="search"],input[type="number"],textarea,
select


<?php if( cesis_check_woo_status() == true) { ?>
,table.shop_table span.woocommerce-Price-amount,
.products span.woocommerce-Price-amount.amount,
.product_list_widget span.woocommerce-Price-amount.amount
<?php } ?>

<?php if( cesis_check_bbp_status() == true) { ?>
,.sidebar_ctn  a.bbp-forum-title,
.footer_main a.bbp-forum-title
<?php } ?>

 <?php if( cesis_check_bp_status() == true) { ?>
 ,div.item-list-tabs ul li a span,
 #buddypress .activity-header a.activity-time-since,
 #buddypress a.bp-primary-action span,
 #buddypress #reply-title small a span
 <?php } ?>

{ font-family:<?php echo esc_attr($site_main_font); ?>;  }
.main_font[class*="tg-item"],.main_font[class*="tg-item"] span,.main_font[class*="tg-item"] a{ font-family:<?php echo esc_attr($site_main_font); ?> !important;  }


.alt_font,legend,.comments-layout-two .author,.comments-layout-two .comment_buttons,.comments-layout-three .comment_buttons,.comments-layout-two .single_post_author,.comments-layout-two .single_post_email,.comments-layout-two .single_post_url,.comments-layout-two textarea,.comments-layout-three textarea,.comments-layout-three input,.writer_navigation a,.boxes_container .category_ctn a,.cesis_tm_1 .cesis_testimonial .tm_author,.cesis_tm_4 .cesis_testimonial .tm_author,.comments-layout-two .comment-navigation,.comments-layout-three .comment-navigation,.agency_navigation a,.agency_comments_ctn .comments-title,.agency_comments_ctn #reply-title,.comments-layout-three .author,.agency_container .author_bio_ctn h4,.agency_container .author_bio_ctn .author_posts_link,.comments-layout-four .date,.comments-layout-four .comment_buttons,.comments-layout-four input,.comments-layout-four .comment-navigation,.comments-layout-six .author,.careers_container .author_bio_ctn h4, .comments-layout-six .comments-title, .comments-layout-six #reply-title,.comments-layout-seven .comment_buttons,.cesis_tm_6 .cesis_testimonial .tm_author,.cesis_tm_10 .cesis_testimonial .tm_author,.cesis_tm_10 .cesis_testimonial .tm_info,.cesis_tm_11 .cesis_testimonial .tm_author,.cesis_tm_11 .cesis_testimonial .tm_info ,.cesis_tm_12 .cesis_testimonial .tm_author,.cesis_tm_12 .cesis_testimonial .tm_info,.cesis_tm_14 .cesis_testimonial .tm_author,.cesis_tm_14 .cesis_testimonial .tm_info,.cesis_tm_15 .cesis_testimonial .tm_author,.cesis_tm_17 .cesis_testimonial .tm_author,.cesis_tm_17 .cesis_testimonial .tm_info,.cesis_pb_5 .cesis_progress_bar_label,.cesis_pb_9 .cesis_progress_bar_label,.cesis_pb_9 .vc_label_units,.cesis_pb_10 .cesis_progress_bar_label,.cesis_pb_11 .cesis_progress_bar_label,.cesis_tabs.horizontal.cesis_tab_4 .tabs > li a,.cesis_tabs.vertical.cesis_tab_2 .tabs > li a,.cesis_acc_1 .panel-title a,.cesis_acc_3 .panel-title a,.cesis_acc_4 .panel-title a,.cesis_acc_5 .panel-title a,
.cesis_nav_style_1 .cesis_nav_prev,.cesis_nav_style_1 .cesis_nav_next,
.cesis_nav_style_3 span,
.cesis_pt_1 .cesis_price_table_title,
.cesis_pt_1 .cesis_price_feature_title,
.cesis_pt_1 .cesis_price_table_bottom a,
.cesis_pt_2 .cesis_price_table_title,
.cesis_pt_2 .cesis_price_feature_title,
.cesis_pt_2 .cesis_price_table_bottom a,
.cesis_pt_3 .cesis_price_table_title,
.cesis_pt_3 .cesis_price_feature_title,
.horizontal.cesis_tab_4 .tabs > li a,
.cesis_container:not(.business_container) .entry-footer .sp_categories_ctn a,
.cesis_container:not(.business_container) .entry-footer .sp_tags_ctn a


<?php if( cesis_check_woo_status() == true) { ?>
 ,.woocommerce div.product .woocommerce-tabs ul.tabs li a,
 .woocommerce #review_form #respond .comment-reply-title,
 .woocommerce #review_form #respond p label,
 .woocommerce div.product form.cart .variations label,
 .meta_container .meta_label,
 .woocommerce table.shop_attributes th,
 .woocommerce div.product form.cart .group_table td.label a,
 span.woocommerce-Price-amount.amount,
 .woocommerce table.cart th,
 .woocommerce .cart_totals table.shop_table .order-total th,
 .woocommerce .cart_totals table.shop_table .order-total span.woocommerce-Price-amount,
 .woocommerce-thankyou-order-received,
 .woocommerce-account .woocommerce-MyAccount-navigation ul li a,
 ul.product_list_widget li.mini_cart_item a,
 .woocommerce .widget_shopping_cart .total, .woocommerce.widget_shopping_cart .total,
 .woocommerce-grouped-product-list-item__label
 <?php } ?>


 <?php if( cesis_check_bbp_status() == true) { ?>
   ,.bbp-forum-title,a.bbp-topic-permalink,
   #bbpress-forums div.bbp-reply-author a.bbp-author-name,
   #bbpress-forums #bbp-single-user-details #bbp-user-navigation a,
   #bbpress-forums div.bbp-topic-author a.bbp-author-name,
   #bbpress-forums div.bbp-reply-author a.bbp-author-name
 <?php } ?>

 <?php if( cesis_check_bp_status() == true) { ?>
,.standard-form label,.standard-form span.label,
#item-nav div.item-list-tabs ul li a,
.activity-header a,
#buddypress div.activity-meta a,
#buddypress div.activity-comments div.acomment-meta a:first-child,
#buddypress ul.item-list li div.item-title a,
#friends-list .item-title,
#groups-list .item-title,
#members-list .item-title
<?php } ?>

{ font-family:<?php echo esc_attr($site_alt_font); ?>;  }

.alt_font[class*="tg-item"],.alt_font[class*="tg-item"] span,.alt_font[class*="tg-item"] a{ font-family:<?php echo esc_attr($site_alt_font); ?> !important;  }
/*--------------------------------------------------------------
#2 Header and Navigation
--------------------------------------------------------------*/

<?php

 /* Header settings */
 $header_height = $cesis_data["cesis_header_height"];
 $header_shrink_status = $cesis_data["cesis_header_shrink"];
 $header_shrinked_height = $cesis_data["cesis_header_shrink_height"];
 $header_shrinked_logo = $header_shrinked_height-15;
 $header_width = $cesis_data["cesis_header_width"]["width"];
 $header_units = $cesis_data["cesis_header_width"]["units"];

 if($header_units == '%'){
   $header_width = $cesis_data["cesis_header_width"]["width"];
 }else{
   $header_width = ($cesis_data["cesis_header_width"]["width"] + 80).$header_units;
 }

 $header_bg = $cesis_data["cesis_header_bg_color"];
 $header_border = $cesis_data["cesis_header_border_color"]['rgba'];
 $header_layout = $cesis_data['cesis_header_layout'];
 $header_v_width = $cesis_data["cesis_header_v_width"];
 $header_v_pos = $cesis_data["cesis_header_v_pos"];
 $header_oc_bg = $cesis_data["cesis_header_offcanvas_bg_color"];
 $header_menu_btn = $cesis_data["cesis_header_openmenu_color"];


 $header_transparent_bg_color = $cesis_data["cesis_transparent_header_bg_color"]['rgba'];
 $header_transparent_color = $cesis_data["cesis_transparent_header_color"]['rgba'];
 $header_transparent_border_color = $cesis_data["cesis_transparent_header_border_color"]['rgba'];
 $header_transparent_active_color = $cesis_data["cesis_transparent_header_active_color"]['rgba'];

($header_v_pos == 'header_v_pos_left') ? $v_pos = 'left' : $v_pos = 'right';
($header_v_pos == 'header_v_pos_left') ? $oc_pos = '' : $oc_pos = '-';

 $header_sub_height = $cesis_data["cesis_header_sub_height"];
 $header_sub_bg = $cesis_data["cesis_header_sub_bg_color"];
 $header_sub_border = $cesis_data["cesis_header_sub_border_color"]['rgba'];


 $header_overlay_bg = $cesis_data["cesis_overlay_bg_color"]['rgba'];


 $menu_type = $cesis_data["cesis_menu_type"];
 $menu_pos = $cesis_data["cesis_menu_pos"];
 $menu_space = ($cesis_data["cesis_menu_space"] / 2);


 $menu_border_pos = $cesis_data["cesis_menu_border_pos"];
 $menu_border_size = $cesis_data["cesis_menu_border_size"];
 $menu_border_radius = $cesis_data["cesis_menu_border_radius"];
 $menu_sep = $cesis_data["cesis_menu_sep_color"];
 $menu_color = $cesis_data["cesis_menu_font"]['color'];
 $menu_font = $cesis_data["cesis_menu_font"]['font-family'];
 $menu_size = $cesis_data["cesis_menu_font"]['font-size'];
 $menu_weight = $cesis_data["cesis_menu_font"]['font-weight'];
 $menu_tt = $cesis_data["cesis_menu_font"]['text-transform'];
 $menu_ls = $cesis_data["cesis_menu_font"]['letter-spacing'];
 $menu_active_color = $cesis_data["cesis_current_menu_color"];
 $menu_active_bg = $cesis_data["cesis_current_menu_bg_color"];
 $menu_border = $cesis_data["cesis_menu_border_color"];

 $logo_pos = $cesis_data["cesis_logo_pos"];
 $logo_width = $cesis_data["cesis_logo_width"];
 $logo_margin = $logo_width/2;
 $logo_padding = ($logo_width+60)/2;
 $mobile_logo_width = $cesis_data["cesis_mobile_logo_width"];

 $header_additional_style = $cesis_data["cesis_header_additional_style"];
 $header_a_space = ( $cesis_data["cesis_header_additional_space"] / 2 );
 $header_a_ctn_border = $cesis_data["cesis_header_a_ctn_border"];
 $header_a_color = $cesis_data["cesis_header_a_color"];
 $header_a_border_color = $cesis_data["cesis_header_a_border_color"];
 $header_a_bg_color = $cesis_data["cesis_header_a_bg_color"];
 $header_a_hover_color = $cesis_data["cesis_header_a_hover_color"];
 $header_a_hover_border_color = $cesis_data["cesis_header_a_hover_border_color"];
 $header_a_hover_bg_color = $cesis_data["cesis_header_a_hover_bg_color"];
 $header_sa_ctn_border = $cesis_data["cesis_header_sa_ctn_border"];
 $header_sa_color = $cesis_data["cesis_header_sa_color"];
 $header_sa_border_color = $cesis_data["cesis_header_sa_border_color"];
 $header_sa_bg_color = $cesis_data["cesis_header_sa_bg_color"];
 $header_sa_hover_color = $cesis_data["cesis_header_sa_hover_color"];
 $header_sa_hover_border_color = $cesis_data["cesis_header_sa_hover_border_color"];
 $header_sa_hover_bg_color = $cesis_data["cesis_header_sa_hover_bg_color"];


$header_a_btn_color = $cesis_data["cesis_header_a_btn_font"]['color'];
$header_a_btn_font = $cesis_data["cesis_header_a_btn_font"]['font-family'];
$header_a_btn_size = $cesis_data["cesis_header_a_btn_font"]['font-size'];
$header_a_btn_weight = $cesis_data["cesis_header_a_btn_font"]['font-weight'];
$header_a_btn_tt = $cesis_data["cesis_header_a_btn_font"]['text-transform'];
$header_a_btn_ls = $cesis_data["cesis_header_a_btn_font"]['letter-spacing'];
$header_a_btn_bg = $cesis_data["cesis_header_a_btn_bg_color"];
$header_a_btn_border = $cesis_data["cesis_header_a_btn_border_color"];
$header_a_btn_h_color = $cesis_data["cesis_header_a_btn_hover_color"];
$header_a_btn_h_bg = $cesis_data["cesis_header_a_btn_hover_bg_color"];
$header_a_btn_h_border = $cesis_data["cesis_header_a_btn_hover_border_color"];
$header_a_btn_h_border = $cesis_data["cesis_header_a_btn_hover_border_color"];
$header_a_btn_width = $cesis_data["cesis_header_a_btn_width"];
$header_a_btn_height = $cesis_data["cesis_header_a_btn_height"];
$header_a_btn_border_size = $cesis_data["cesis_header_a_btn_border"];
$header_a_btn_border_radius = $cesis_data["cesis_header_a_btn_radius"];

$header_a_btn_height = $header_a_btn_height-($header_a_btn_border_size*2);


 $header_breakpoint = $cesis_data["cesis_header_breakpoint"];


  $mobile_menu_height = $cesis_data["cesis_mobile_menu_height"];
  $mobile_menu_bg = $cesis_data["cesis_mobile_menu_bg"];
  $mobile_menu_border = $cesis_data["cesis_mobile_menu_border"];
  $mobile_menu_color = $cesis_data["cesis_mobile_menu_font"]['color'];
  $mobile_menu_font = $cesis_data["cesis_mobile_menu_font"]['font-family'];
  $mobile_menu_size = $cesis_data["cesis_mobile_menu_font"]['font-size'];
  $mobile_menu_weight = $cesis_data["cesis_mobile_menu_font"]['font-weight'];
  $mobile_menu_tt = $cesis_data["cesis_mobile_menu_font"]['text-transform'];
  $mobile_menu_ls = $cesis_data["cesis_mobile_menu_font"]['letter-spacing'];
  $mobile_menu_lh = $cesis_data["cesis_mobile_menu_font"]['line-height'];
  $mobile_submenu_color = $cesis_data["cesis_mobile_sub_menu_font"]['color'];
  $mobile_submenu_font = $cesis_data["cesis_mobile_sub_menu_font"]['font-family'];
  $mobile_submenu_size = $cesis_data["cesis_mobile_sub_menu_font"]['font-size'];
  $mobile_submenu_weight = $cesis_data["cesis_mobile_sub_menu_font"]['font-weight'];
  $mobile_submenu_tt = $cesis_data["cesis_mobile_sub_menu_font"]['text-transform'];
  $mobile_submenu_ls = $cesis_data["cesis_mobile_sub_menu_font"]['letter-spacing'];
  $mobile_submenu_lh = $cesis_data["cesis_mobile_sub_menu_font"]['line-height'];
  $mobile_open_menu = $cesis_data["cesis_mobile_open_menu"];
  $mobile_current_menu = $cesis_data["cesis_mobile_current_menu"];


$mobile_a_btn_color = $cesis_data["cesis_mobile_a_btn_font"]['color'];
$mobile_a_btn_font = $cesis_data["cesis_mobile_a_btn_font"]['font-family'];
$mobile_a_btn_size = $cesis_data["cesis_mobile_a_btn_font"]['font-size'];
$mobile_a_btn_weight = $cesis_data["cesis_mobile_a_btn_font"]['font-weight'];
$mobile_a_btn_tt = $cesis_data["cesis_mobile_a_btn_font"]['text-transform'];
$mobile_a_btn_ls = $cesis_data["cesis_mobile_a_btn_font"]['letter-spacing'];
$mobile_a_btn_bg = $cesis_data["cesis_mobile_a_btn_bg_color"];
$mobile_a_btn_border = $cesis_data["cesis_mobile_a_btn_border_color"];
$mobile_a_btn_h_color = $cesis_data["cesis_mobile_a_btn_hover_color"];
$mobile_a_btn_h_bg = $cesis_data["cesis_mobile_a_btn_hover_bg_color"];
$mobile_a_btn_h_border = $cesis_data["cesis_mobile_a_btn_hover_border_color"];
$mobile_a_btn_h_border = $cesis_data["cesis_mobile_a_btn_hover_border_color"];
$mobile_a_btn_width = $cesis_data["cesis_mobile_a_btn_width"];
$mobile_a_btn_height = $cesis_data["cesis_mobile_a_btn_height"];
$mobile_a_btn_border_size = $cesis_data["cesis_mobile_a_btn_border"];
$mobile_a_btn_border_radius = $cesis_data["cesis_mobile_a_btn_radius"];

$mobile_a_btn_height = $mobile_a_btn_height-($mobile_a_btn_border_size*2);

  $dropdown_bg = $cesis_data["cesis_dropdown_bg"]['rgba'];
  $dropdown_border = $cesis_data["cesis_dropdown_border"]['rgba'];
  $dropdown_color = $cesis_data["cesis_dropdown_font"]['color'];
  $dropdown_font = $cesis_data["cesis_dropdown_font"]['font-family'];
  $dropdown_size = $cesis_data["cesis_dropdown_font"]['font-size'];
  $dropdown_weight = $cesis_data["cesis_dropdown_font"]['font-weight'];
  $dropdown_tt = $cesis_data["cesis_dropdown_font"]['text-transform'];
  $dropdown_ls = $cesis_data["cesis_dropdown_font"]['letter-spacing'];
  $dropdown_lh = $cesis_data["cesis_dropdown_font"]['line-height'];
  $dropdown_hover_color = $cesis_data["cesis_dropdown_hover_color"];
  $dropdown_hover_bg_color = $cesis_data["cesis_dropdown_hover_bg_color"];
  $dropdown_active = $cesis_data["cesis_dropdown_active"];
  $dropdown_heading_color = $cesis_data["cesis_dropdown_heading"]['color'];
  $dropdown_heading_font = $cesis_data["cesis_dropdown_heading"]['font-family'];
  $dropdown_heading_size = $cesis_data["cesis_dropdown_heading"]['font-size'];
  $dropdown_heading_weight = $cesis_data["cesis_dropdown_heading"]['font-weight'];
  $dropdown_heading_tt = $cesis_data["cesis_dropdown_heading"]['text-transform'];
  $dropdown_heading_ls = $cesis_data["cesis_dropdown_heading"]['letter-spacing'];
  $dropdown_heading_lh = $cesis_data["cesis_dropdown_heading"]['line-height'];



  $top_bar_breakpoint = $cesis_data['cesis_top_bar_breakpoint'];

  $top_bar_height = $cesis_data['cesis_top_bar_height'];
  $top_bar_bg = $cesis_data['cesis_top_bar_bg_color'];
  $top_bar_border = $cesis_data['cesis_top_bar_border_color'];
  $top_bar_color = $cesis_data['cesis_top_bar_text_color'];
  $top_bar_hl = $cesis_data['cesis_top_bar_hl_color'];
  $top_bar_hover = $cesis_data['cesis_top_bar_hover_color'];

  $top_bar_menu_font = $cesis_data["cesis_top_bar_menu_font"]['font-family'];
  $top_bar_menu_font_size = $cesis_data["cesis_top_bar_menu_font"]['font-size'];
  $top_bar_menu_font_weight = $cesis_data["cesis_top_bar_menu_font"]['font-weight'];
  $top_bar_menu_font_ls = $cesis_data["cesis_top_bar_menu_font"]['letter-spacing'];
  $top_bar_menu_font_tt = $cesis_data["cesis_top_bar_menu_font"]['text-transform'];

  $top_bar_menu_space = $cesis_data['cesis_top_bar_menu_space'];
  $top_bar_text_size = $cesis_data['cesis_top_bar_text_size'];


?>

.top_bar_phone, .top_bar_email, .top_bar_text{font-size:<?php echo esc_attr($top_bar_text_size); ?>px;}


.header_top_bar,.header_top_bar .cesis_social_icons a{ min-height:<?php echo esc_attr($top_bar_height); ?>px; line-height:<?php echo esc_attr($top_bar_height); ?>px;}
.header_top_bar { background:<?php echo esc_attr($top_bar_bg); ?>; border-color:<?php echo esc_attr($top_bar_border); ?>; color:<?php echo esc_attr($top_bar_color); ?>}
.header_top_bar a{ color:<?php echo esc_attr($top_bar_hl); ?>;}
.header_top_bar a:hover{ color:<?php echo esc_attr($top_bar_hover); ?>;}
.top_bar_cart .cesis_cart_icon .current_item_number


<?php if( cesis_check_bp_status() == true) { ?>
,.top_bar_notifications .cesis_bp_notifications_count
<?php } ?>

{background:<?php echo esc_attr($top_bar_hover); ?>;}


.header_top_bar .menu-top-bar-ct li,
.top_bar_notifications .cesis_bp_notifications > span
{ font-family:<?php echo esc_attr($top_bar_menu_font); ?>; font-size:<?php echo esc_attr($top_bar_menu_font_size); ?>; letter-spacing:<?php echo esc_attr($top_bar_menu_font_ls); ?>; text-transform:<?php echo esc_attr($top_bar_menu_font_tt); ?>;  padding:0 <?php echo esc_attr($top_bar_menu_space); ?>px;}



  <?php if($header_width !== ''){ ?>

 .header_top_bar .cesis_container,.header_main .cesis_container,.header_sub .cesis_container { max-width:<?php echo esc_attr($header_width); ?>; }

 <?php }if($header_layout  !== 'vertical_header'){ ?>

.header_main { background:<?php echo esc_attr($header_bg); ?>; height:<?php echo esc_attr($header_height); ?>px; border-color:<?php echo esc_attr($header_border); ?>;}
#header_container.cesis_opaque_header{ background:<?php echo esc_attr($header_bg); ?>;}
<?php }else{ ?>

.header_main.header_vertical { background:<?php echo esc_attr($header_bg); ?>; width:<?php echo esc_attr($header_v_width); ?>px;  border-color:<?php echo esc_attr($header_border); ?>;}

<?php }

if($header_layout == 'vertical_header' ){ ?>
body.cesis_vertical_header  .cesis_top_banner,body.cesis_vertical_header #header_container,body.cesis_vertical_header #main-content,
body.cesis_vertical_header #cesis_colophon {margin-<?php echo esc_attr($v_pos); ?>:<?php echo esc_attr($header_v_width); ?>px;}
<?php }

if($header_layout == 'vertical_offcanvas_header_b'){ ?>
body.cesis_offcanvas_header .header_logo a,.cesis_offcanvas_cart .cart-menu > li > a,
.header_main .cesis_offcanvas_notifications a{ color:<?php echo esc_attr($header_menu_btn); ?>}
.header_main .lines,.header_main .lines:after,.header_main .lines:before { background:<?php echo esc_attr($header_menu_btn); ?>}
.header_logo,.cesis_menu_button.cesis_offcanvas_switch,.cesis_offcanvas_cart,
.header_main .cesis_offcanvas_notifications a,
.header_main .cesis_offcanvas_notifications i,
.header_main .cesis_offcanvas_notifications > span{ line-height:<?php echo esc_attr($header_height); ?>px; height:<?php echo esc_attr($header_height); ?>px;}
.header_offcanvas { background:<?php echo esc_attr($header_oc_bg); ?>; width:<?php echo esc_attr($header_v_width); ?>px;}

.cesis_offcanvas_opened {-webkit-transform: translateX(<?php echo esc_attr($oc_pos.$header_v_width); ?>px); transform: translateX(<?php echo esc_attr($oc_pos.$header_v_width); ?>px);}
<?php if($header_shrink_status !== 'no'){ ?>
.cesis_header_shrink.cesis_stuck .header_logo,
.cesis_header_shrink.cesis_stuck .cesis_menu_button.cesis_offcanvas_switch,
.cesis_header_shrink.cesis_stuck .cesis_offcanvas_cart,
.cesis_header_shrink.cesis_stuck .header_main .cesis_offcanvas_notifications a,
.cesis_header_shrink.cesis_stuck .header_main .cesis_offcanvas_notifications i,
.cesis_header_shrink.cesis_stuck .header_main .cesis_offcanvas_notifications > span
{ line-height:<?php echo esc_attr($header_shrinked_height); ?>px; height:<?php echo esc_attr($header_shrinked_height); ?>px;}
.cesis_header_shrink.cesis_stuck .header_main
{height:<?php echo esc_attr($header_shrinked_height); ?>px;}
.cesis_header_shrink.cesis_stuck .header_logo #logo_img img
{ max-height:<?php echo esc_attr($header_shrinked_logo); ?>px;}


<?php } }
if($header_layout == 'overlay_header_b'){ ?>
.header_overlay { background:<?php echo esc_attr($header_overlay_bg); ?>}
body.cesis_overlay_header .header_logo a,.cesis_overlay_cart .cart-menu > li > a,
.header_main .cesis_overlay_notifications a{ color:<?php echo esc_attr($header_menu_btn); ?>}
.header_main .lines,.header_main .lines:after,.header_main .lines:before { background:<?php echo esc_attr($header_menu_btn); ?>}
.header_logo,.cesis_menu_button.cesis_menu_overlay ,.cesis_menu_overlay_close,.cesis_overlay_cart,
.header_main .cesis_overlay_notifications a,
.header_main .cesis_overlay_notifications i,
.header_main .cesis_overlay_notifications > span
{ line-height:<?php echo esc_attr($header_height); ?>px; height:<?php echo esc_attr($header_height); ?>px;}

<?php if($header_shrink_status !== 'no'){ ?>
.cesis_header_shrink.cesis_stuck .header_logo,
.cesis_header_shrink.cesis_stuck .cesis_menu_button.cesis_menu_overlay ,
.cesis_header_shrink.cesis_stuck .cesis_menu_overlay_close,
.cesis_header_shrink.cesis_stuck .cesis_overlay_cart,
.cesis_header_shrink.cesis_stuck .header_main .cesis_overlay_notifications a,
.cesis_header_shrink.cesis_stuck .header_main .cesis_overlay_notifications i,
.cesis_header_shrink.cesis_stuck .header_main .cesis_overlay_notifications > span
{ line-height:<?php echo esc_attr($header_shrinked_height); ?>px; height:<?php echo esc_attr($header_shrinked_height); ?>px;}
.cesis_header_shrink.cesis_stuck .header_main
{height:<?php echo esc_attr($header_shrinked_height); ?>px;}
.cesis_header_shrink.cesis_stuck .header_logo #logo_img img
{ max-height:<?php echo esc_attr($header_shrinked_logo); ?>px;}


  <?php } if($header_width !== '' && $header_units == '%' ){?>
      .header_main .cesis_container{ padding:0 40px; }
  <?php }



}

if($header_layout == 'one_line_header'){ ?>

.header_main:not(.header_vertical) .tt-main-navigation > div > ul > li > a,
.header_main:not(.header_vertical) .header_logo,
.header_main:not(.header_vertical) .menu_sep,
.header_main:not(.header_vertical) .tt-main-additional .cesis_social_icons,
.header_main:not(.header_vertical) .tt-main-additional .cesis_social_icons a,
.header_main:not(.header_vertical) .tt-main-additional .cesis_search_icon i,
.header_main:not(.header_vertical) .tt-main-additional .cesis_cart_icon i,
.header_main:not(.header_vertical) .tt-main-additional .cesis_menu_btn a,
.header_main:not(.header_vertical) .tt-main-additional .cesis_bp_notifications a,
.header_main:not(.header_vertical) .tt-main-additional .cesis_bp_notifications.only_icons i,
.header_main:not(.header_vertical) .tt-main-additional .cesis_bp_notifications.only_icons > span
{ line-height:<?php echo esc_attr($header_height); ?>px; height:<?php echo esc_attr($header_height); ?>px;}



.header_main:not(.header_vertical) .tt-main-additional .cesis_menu_btn a span
{ font-size:<?php echo esc_attr($header_a_btn_size); ?>;
 font-family:<?php echo esc_attr($header_a_btn_font); ?>;
font-weight:<?php echo esc_attr($header_a_btn_weight); ?>;
text-transform:<?php echo esc_attr($header_a_btn_tt); ?>;
letter-spacing:<?php echo esc_attr($header_a_btn_ls); ?>;
color:<?php echo esc_attr($header_a_btn_color); ?>;
background:<?php echo esc_attr($header_a_btn_bg); ?>;
border-color:<?php echo esc_attr($header_a_btn_border); ?>;
border-radius:<?php echo esc_attr($header_a_btn_border_radius); ?>px;
border-width:<?php echo esc_attr($header_a_btn_border_size); ?>px;
line-height:<?php echo esc_attr($header_a_btn_height); ?>px;
width:<?php echo esc_attr($header_a_btn_width); ?>px;

}
.header_main:not(.header_vertical) .tt-main-additional .cesis_menu_btn a span:hover{
color:<?php echo esc_attr($header_a_btn_h_color); ?>;
background:<?php echo esc_attr($header_a_btn_h_bg); ?>;
border-color:<?php echo esc_attr($header_a_btn_h_border); ?>;
}

<?php if($header_shrink_status !== 'no'){ ?>
.cesis_header_shrink.cesis_stuck .header_main:not(.header_vertical) .tt-main-navigation > div > ul > li > a,
.cesis_header_shrink.cesis_stuck .header_main:not(.header_vertical) .header_logo,
.cesis_header_shrink.cesis_stuck .header_main:not(.header_vertical) .menu_sep,
.cesis_header_shrink.cesis_stuck .header_main:not(.header_vertical) .tt-main-additional .cesis_social_icons,
.cesis_header_shrink.cesis_stuck .header_main:not(.header_vertical) .tt-main-additional .cesis_social_icons a,
.cesis_header_shrink.cesis_stuck .header_main:not(.header_vertical) .tt-main-additional .cesis_search_icon i,
.cesis_header_shrink.cesis_stuck .header_main:not(.header_vertical) .tt-main-additional .cesis_cart_icon i,
.cesis_header_shrink.cesis_stuck .header_main:not(.header_vertical) .tt-main-additional .cesis_menu_btn a,
.cesis_header_shrink.cesis_stuck .header_main:not(.header_vertical) .tt-main-additional .cesis_bp_notifications a,
.cesis_header_shrink.cesis_stuck .header_main:not(.header_vertical) .tt-main-additional .cesis_bp_notifications.only_icons i,
.cesis_header_shrink.cesis_stuck .header_main:not(.header_vertical) .tt-main-additional .cesis_bp_notifications.only_icons > span
{ line-height:<?php echo esc_attr($header_shrinked_height); ?>px; height:<?php echo esc_attr($header_shrinked_height); ?>px;}
.cesis_header_shrink.cesis_stuck .header_main:not(.header_vertical)
{ height:<?php echo esc_attr($header_shrinked_height); ?>px;}
.cesis_header_shrink.cesis_stuck .header_logo #logo_img img
{ max-height:<?php echo esc_attr($header_shrinked_logo); ?>px;}


<?php }
 } elseif($header_layout == 'two_line_header'){ ?>

.header_logo,.tt-main-additional .cesis_social_icons,
.tt-main-additional .cesis_social_icons a,
.tt-main-additional .cesis_search_icon i,
.tt-main-additional .cesis_cart_icon i,
.tt-main-additional .cesis_bp_notifications a,
.tt-main-additional .cesis_bp_notifications.only_icons i,
.tt-main-additional .cesis_bp_notifications.only_icons > span,
.header_main:not(.header_vertical) .tt-main-additional .cesis_menu_btn a { line-height:<?php echo esc_attr($header_height); ?>px; height:<?php echo esc_attr($header_height); ?>px;}
.header_sub .tt-main-navigation  > div > ul > li > a,.header_sub .menu_sep,
.tt-sub-additional .cesis_social_icons,
.tt-sub-additional .cesis_social_icons a,
.tt-sub-additional .cesis_search_icon i,
.tt-sub-additional .cesis_cart_icon i,
.tt-sub-additional .cesis_bp_notifications a,
.tt-sub-additional .cesis_bp_notifications.only_icons i,
.tt-sub-additional .cesis_bp_notifications.only_icons > span{ line-height:<?php echo esc_attr($header_sub_height); ?>px; height:<?php echo esc_attr($header_sub_height); ?>px; }
.header_sub {height:<?php echo esc_attr($header_sub_height); ?>px; background:<?php echo esc_attr($header_sub_bg); ?>; border-color:<?php echo esc_attr($header_sub_border); ?>;}


.header_main:not(.header_vertical) .tt-main-additional .cesis_menu_btn a span
{ font-size:<?php echo esc_attr($header_a_btn_size); ?>;
 font-family:<?php echo esc_attr($header_a_btn_font); ?>;
font-weight:<?php echo esc_attr($header_a_btn_weight); ?>;
text-transform:<?php echo esc_attr($header_a_btn_tt); ?>;
letter-spacing:<?php echo esc_attr($header_a_btn_ls); ?>;
color:<?php echo esc_attr($header_a_btn_color); ?>;
background:<?php echo esc_attr($header_a_btn_bg); ?>;
border-color:<?php echo esc_attr($header_a_btn_border); ?>;
border-radius:<?php echo esc_attr($header_a_btn_border_radius); ?>px;
border-width:<?php echo esc_attr($header_a_btn_border_size); ?>px;
line-height:<?php echo esc_attr($header_a_btn_height); ?>px;
width:<?php echo esc_attr($header_a_btn_width); ?>px;

}
.header_main:not(.header_vertical) .tt-main-additional .cesis_menu_btn a span:hover{
color:<?php echo esc_attr($header_a_btn_h_color); ?>;
background:<?php echo esc_attr($header_a_btn_h_bg); ?>;
border-color:<?php echo esc_attr($header_a_btn_h_border); ?>;
}


<?php if($header_shrink_status !== 'no'){ ?>
.cesis_header_shrink.cesis_stuck .header_sub .tt-main-navigation  > div > ul > li > a,.header_sub .menu_sep,
.cesis_header_shrink.cesis_stuck .tt-sub-additional .cesis_social_icons,
.cesis_header_shrink.cesis_stuck .tt-sub-additional .cesis_social_icons a,
.cesis_header_shrink.cesis_stuck .tt-sub-additional .cesis_search_icon i,
.cesis_header_shrink.cesis_stuck .tt-sub-additional .cesis_cart_icon i,
.cesis_header_shrink.cesis_stuck .tt-sub-additional .cesis_bp_notifications a,
.cesis_header_shrink.cesis_stuck .tt-sub-additional .cesis_bp_notifications.only_icons i,
.cesis_header_shrink.cesis_stuck .tt-sub-additional .cesis_bp_notifications.only_icons > span
{ line-height:<?php echo esc_attr($header_shrinked_height); ?>px; height:<?php echo esc_attr($header_shrinked_height); ?>px; }
.cesis_header_shrink.cesis_stuck .header_sub
{height:<?php echo esc_attr($header_shrinked_height); ?>px;}
<?php } ?>

.tt-sub-additional .cesis_social_icons a,
.tt-sub-additional .cesis_search_icon a,
.tt-sub-additional .cesis_cart_icon > ul > li > a,
.tt-sub-additional .cesis_bp_notifications a
{ color:<?php echo esc_attr($header_sa_color); ?>;}
.tt-sub-additional .cesis_social_icons a:after,
.tt-sub-additional .cesis_search_icon a i:after,
.tt-sub-additional .cesis_cart_icon > ul > li > a:after,
.tt-sub-additional .cesis_bp_notifications a:after {
  background-color:<?php echo esc_attr($header_sa_bg_color); ?>;
  border-color:<?php echo esc_attr($header_sa_border_color); ?>;
}
.tt-sub-additional .cesis_social_icons a:hover,
.tt-sub-additional .cesis_search_icon a:hover,
.tt-sub-additional .cesis_bp_notifications a:hover{ color:<?php echo esc_attr($header_sa_hover_color); ?>;}
.tt-sub-additional .cesis_social_icons a:hover::after,
.tt-sub-additional .cesis_search_icon a:hover i:after,
.tt-sub-additional .cesis_cart_icon > ul > li > a:hover::after,
.tt-sub-additional .cesis_bp_notifications a:hover::after {
  background-color:<?php echo esc_attr($header_sa_hover_bg_color); ?>;
  border-color:<?php echo esc_attr($header_sa_hover_border_color); ?>;
}

.tt-sub-additional .cesis_cart_icon .current_item_number,
.tt-sub-additional .cesis_bp_notifications_count
{ background:<?php echo esc_attr($header_sa_hover_color); ?>;}


<?php }

if($header_layout == 'two_line_header' || $header_layout  == 'one_line_header'){ ?>
.tt-main-navigation  > div > ul > li > a { padding:0 <?php echo esc_attr($menu_space); ?>px; }
.tt-main-additional.logo_left,.tt-sub-additional.menu_left{ padding-left:<?php echo esc_attr($menu_space); ?>px; }
.tt-main-additional.logo_left:not(.edge_border):not(.nav_line_separator),.tt-sub-additional.menu_left:not(.edge_border):not(.nav_line_separator)
{ padding-left:<?php echo esc_attr(2*$menu_space); ?>px; }
.tt-main-additional.logo_right,.tt-sub-additional.menu_right{ padding-right:<?php echo esc_attr($menu_space); ?>px; }
.tt-main-additional.logo_right:not(.edge_border):not(.nav_line_separator),.tt-sub-additional.menu_right:not(.edge_border):not(.nav_line_separator)
{ padding-right:<?php echo esc_attr(2*$menu_space); ?>px; }


  <?php if($menu_pos =='menu_fill'){?>
  .tt-main-additional.menu_fill,.tt-sub-additional.menu_fill{padding:0 !important;}
<?php } ?>

  <?php if($header_width !== '' && $header_units == '%' && $logo_pos =='logo_center'){?>
  .header_main .cesis_container{ padding:0px; }
  <?php } if($header_additional_style == 'additional_border' && $menu_type !== 'nav_line_separator'){ ?>
    .tt-main-additional.logo_left,.tt-sub-additional.menu_left{ margin-left:<?php echo esc_attr(2*$menu_space); ?>px; }
    .tt-main-additional.logo_right,.tt-sub-additional.menu_right{ margin-right:<?php echo esc_attr(2*$menu_space); ?>px; ?>}



    .tt-main-additional.logo_left.edge_border.additional_border,.tt-sub-additional.menu_left.edge_border.additional_border{ padding-left:<?php echo esc_attr(2*$menu_space); ?>px; }
    .tt-main-additional.logo_left.edge_border,.tt-sub-additional.menu_left.edge_border{ margin-left:<?php echo esc_attr($menu_space); ?>px;}
    .tt-main-additional.logo_right.edge_border,.tt-sub-additional.menu_right.edge_border{ margin-right:<?php echo esc_attr($menu_space); ?>px;}
    .tt-main-additional.logo_right.edge_border.additional_border,.tt-sub-additional.menu_right.edge_border.additional_border{ padding-right:<?php echo esc_attr(2*$menu_space); ?>px; }




    .tt-main-additional.logo_left,.tt-main-additional.logo_right,.tt-main-additional.logo_left.edge_border.additional_border,.tt-main-additional.logo_right.edge_border,
    .tt-main-additional.logo_center.additional_border .tt-left-additional,.tt-main-additional.logo_center.additional_border .tt-right-additional
    {border-color:<?php echo esc_attr($header_a_ctn_border); ?>}
    .tt-sub-additional.menu_left,.tt-sub-additional.menu_right,.tt-sub-additional.menu_left.edge_border.additional_border,.tt-sub-additional.menu_right.edge_border,
    .tt-sub-additional.menu_center.additional_border .cesis_social_icons,.tt-sub-additional.menu_center.additional_border .cesis_search_icon,
    .tt-sub-additional.menu_center.additional_border .tt-left-additional,.tt-sub-additional.menu_center.additional_border .tt-right-additional
    {border-color:<?php echo esc_attr($header_sa_ctn_border); ?>}


    <?php }
}else{ ?>
.tt-main-navigation.tt-vertical-navigation a,.tt-main-additional.vertical_additional > span,
.tt-main-additional .cesis_bp_notifications.vertical > span{ padding:<?php echo esc_attr($menu_space); ?>px 0; }

<?php }
if($menu_type == 'nav_line_separator' ){ ?>

.nav_line_separator  > div > ul > li { border-left:1px solid <?php echo esc_attr($menu_sep); ?> }
.nav_line_separator > div > ul,.nav_line_separator.logo_center > div > ul .cl_before_logo{ border-right:1px solid <?php echo esc_attr($menu_sep); ?> }
.cesis_parent_highlight .tt-main-navigation  > div > ul > li.current_page_parent > a,
.tt-main-navigation  > div > ul > li.current-menu-item > a,.tt-main-navigation  > div > ul > li > a:hover { background-color:<?php echo esc_attr($menu_active_bg); ?>;}

<?php }elseif($menu_type == 'nav_top_borderx' && $menu_border_pos == 'edge_border' ){ ?>
.cesis_parent_highlight .nav_top_borderx.edge_border  > div > ul > li.current_page_parent > a,
.nav_top_borderx.edge_border  > div > ul > li.current-menu-item > a,.nav_top_borderx.edge_border  > div > ul > li > a:hover {
    box-shadow: inset 0px <?php echo esc_attr($menu_border_size); ?>px <?php echo esc_attr($menu_border); ?>;
}

<?php }elseif($menu_type == 'nav_top_borderx' && $menu_border_pos == 'text_border' ){ ?>
.cesis_parent_highlight .nav_top_borderx.text_border  > div > ul > li.current_page_parent > a span,
.nav_top_borderx.text_border  > div > ul > li.current-menu-item > a span,.nav_top_borderx.text_border  > div > ul > li > a:hover span {box-shadow: inset 0px <?php echo esc_attr($menu_border_size); ?>px <?php echo esc_attr($menu_border); ?>; }
.nav_top_borderx.text_border  > div > ul > li > a span{padding-top:10px;}

<?php }elseif($menu_type == 'nav_bottom_borderx' && $menu_border_pos == 'edge_border' ){ ?>

.cesis_parent_highlight .nav_bottom_borderx.edge_border  > div > ul > li.current_page_parent > a,
.nav_bottom_borderx.edge_border  > div > ul > li.current-menu-item > a,.nav_bottom_borderx.edge_border  > div > ul > li > a:hover
{  box-shadow: inset 0px -<?php echo esc_attr($menu_border_size); ?>px <?php echo esc_attr($menu_border); ?>;}

<?php }elseif($menu_type == 'nav_bottom_borderx' && $menu_border_pos == 'text_border' ){ ?>

.cesis_parent_highlight .nav_bottom_borderx.text_border > div > ul > li.current_page_parent > a span,
.nav_bottom_borderx.text_border  > div > ul > li.current-menu-item > a span,.nav_bottom_borderx.text_border  > div > ul > li > a:hover span {box-shadow: inset 0px -<?php echo esc_attr($menu_border_size); ?>px <?php echo esc_attr($menu_border); ?>; }
.header_main .nav_bottom_borderx.text_border  > div > ul > li > a span{padding-bottom:10px;}
.header_sub .nav_bottom_borderx.text_border  > div > ul > li > a span{padding-bottom:<?php echo esc_attr(5+$menu_border_size); ?>px;}

<?php }elseif($menu_type == 'nav_boxed_border'){ ?>

.cesis_parent_highlight .nav_boxed_border  > div > ul > li.current_page_parent > a span,
.nav_boxed_border  > div > ul > li.current-menu-item > a span,.nav_boxed_border  > div > ul > li > a:hover span {border:<?php echo esc_attr($menu_border_size); ?>px solid <?php echo esc_attr($menu_border); ?>; }
.nav_boxed_border  > div > ul > li > a span{padding:<?php echo esc_attr($cesis_data['cesis_menu_span_padding']['padding-top'].' '.$cesis_data['cesis_menu_span_padding']['padding-right'].' '.$cesis_data['cesis_menu_span_padding']['padding-bottom'].' '.$cesis_data['cesis_menu_span_padding']['padding-left']); ?>;  border:<?php echo esc_attr($menu_border_size); ?>px solid rgba(0,0,0,0); border-radius:<?php echo esc_attr($menu_border_radius); ?>px;}

<?php } ?>


<?php if($cesis_data['cesis_logo']['url'] !== '' ){ ?>
.header_logo{  max-width:<?php echo esc_attr($logo_width); ?>px;}.header_logo #logo_img,.header_logo #logo_img img{  max-width:<?php echo esc_attr($logo_width); ?>px;  max-height:<?php echo esc_attr($header_height); ?>px; }
.header_logo.logo_center{ width:<?php echo esc_attr($logo_width); ?>px; margin-left:-<?php echo esc_attr($logo_margin); ?>px; }
.sm .cl_before_logo{ margin-right:<?php echo esc_attr($logo_margin); ?>px; }.sm .cl_after_logo{ margin-left:<?php echo esc_attr($logo_padding); ?>px; }
body.rtl .sm .cl_before_logo{ margin-left:<?php echo esc_attr($logo_margin); ?>px; margin-right:0; }body.rtl .sm .cl_after_logo{ margin-right:<?php echo esc_attr($logo_padding); ?>px; margin-left:0; }
<?php } ?>

.tt-main-navigation  > div > ul > li > a span,.tt-main-navigation.tt-vertical-navigation span,
.tt-main-additional .cesis_search_icon span,.tt-main-additional .cesis_search_icon input,
.tt-main-additional .cesis_cart_icon.vertical, .tt-main-additional .cesis_cart_icon.vertical a,
.tt-main-additional .cesis_bp_notifications.vertical a
{ color:<?php echo esc_attr($menu_color); ?>; font-family:<?php echo esc_attr($menu_font); ?>; font-size:<?php echo esc_attr($menu_size); ?>; font-weight:<?php echo esc_attr($menu_weight); ?>; text-transform:<?php echo esc_attr($menu_tt); ?>; letter-spacing:<?php echo esc_attr($menu_ls); ?>;}
.cesis_parent_highlight .tt-main-navigation > div > ul > li.current_page_parent > a span,
.tt-main-navigation > div > ul > li.current-menu-item > a span,.tt-main-navigation  > div > ul > li > a:hover span,
.tt-main-navigation.tt-vertical-navigation li.current-menu-item > a span,.tt-main-navigation.tt-vertical-navigation a:hover span,
.tt-main-additional .cesis_cart_icon.vertical a:hover,
.tt-main-additional .cesis_search_icon span:hover
{ color:<?php echo esc_attr($menu_active_color); ?>;}
.header_logo a,.cesis_mobile_cart .cesis_cart_icon a,
.cesis_mobile_notifications a{ color:<?php echo esc_attr($menu_color); ?>; }
.cesis_menu_overlay_close .lines,.cesis_menu_overlay_close .lines:after,.cesis_menu_overlay_close .lines:before,
.cesis_mobile_menu_switch .lines, .cesis_mobile_menu_switch .lines:before, .cesis_mobile_menu_switch .lines:after{ background:<?php echo esc_attr($menu_color); ?>;}


.header_vertical .tt-main-additional .cesis_search_icon input { border-color:<?php echo esc_attr($header_border); ?>;}
.tt-main-additional	.cesis_search_icon	input::-webkit-input-placeholder { color:<?php echo esc_attr($menu_color); ?>;}

.tt-main-additional .cesis_social_icons a,
.tt-main-additional .cesis_search_icon a,
.tt-main-additional .cesis_cart_icon > ul > li > a,
.tt-main-additional .cesis_bp_notifications a { color:<?php echo esc_attr($header_a_color); ?>;}
.tt-main-additional .cesis_social_icons a:after,
.tt-main-additional .cesis_search_icon a i:after,
.tt-main-additional .cesis_cart_icon > ul > li > a:after,
.tt-main-additional .cesis_bp_notifications a:after{
    background-color:<?php echo esc_attr($header_a_bg_color); ?>;
    border-color:<?php echo esc_attr($header_a_border_color); ?>;
}


.tt-main-additional .cesis_social_icons a:hover,
.tt-main-additional .cesis_search_icon a:hover,
.tt-main-additional .cesis_cart_icon > ul > li > a:hover,
.tt-main-additional .cesis_bp_notifications a:hover
{ color:<?php echo esc_attr($header_a_hover_color); ?>;}

.tt-main-additional .cesis_cart_icon .current_item_number,
.cesis_offcanvas_cart .cesis_cart_icon .current_item_number,
.cesis_overlay_cart .cesis_cart_icon .current_item_number,
.cesis_mobile_cart .cesis_cart_icon .current_item_number
<?php if( cesis_check_bp_status() == true) { ?>
,.tt-main-additional .cesis_bp_notifications_count,
.cesis_offcanvas_notifications .cesis_bp_notifications_count,
.cesis_overlay_notifications .cesis_bp_notifications_count,
.cesis_mobile_notifications .cesis_bp_notifications_count
<?php } ?>

{ background:<?php echo esc_attr($header_a_hover_color); ?>;}
.tt-main-additional .cesis_social_icons a:hover::after,
.tt-main-additional .cesis_search_icon a:hover i:after,
.tt-main-additional .cesis_cart_icon > ul > li > a:hover::after,
.tt-main-additional .cesis_bp_notifications a:hover::after{
  background-color:<?php echo esc_attr($header_a_hover_bg_color); ?>;
  border-color:<?php echo esc_attr($header_a_hover_border_color); ?>;
}


.tt-header-additional .cesis_social_icons a,.tt-header-additional .cesis_search_icon,.tt-header-additional .cesis_cart_icon,
.tt-header-additional > span,.tt-header-additional .cesis_bp_notifications > span { margin:0 <?php echo esc_attr($header_a_space); ?>px;}
body:not(.rtl) .tt-header-additional .cesis_social_icons a:first-child,body:not(.rtl) .tt-header-additional > span:first-child,body:not(.rtl) .tt-header-additional .cesis_bp_notifications > span:first-child{ margin:0 <?php echo esc_attr($header_a_space); ?>px 0 0;}
body:not(.rtl) .tt-header-additional .cesis_social_icons a:last-child,body:not(.rtl) .tt-header-additional > span:last-child,body:not(.rtl) .tt-header-additional .cesis_bp_notifications > span:last-child { margin:0 0 0 <?php echo esc_attr($header_a_space); ?>px;}
body.rtl .tt-header-additional .cesis_social_icons a:first-child,body.rtl .tt-header-additional > span:first-child,body.rtl .tt-header-additional .cesis_bp_notifications > span:first-child { margin:0 0 0 <?php echo esc_attr($header_a_space); ?>px;}
body.rtl .tt-header-additional .cesis_social_icons a:last-child,body.rtl .tt-header-additional > span:last-child,body.rtl .tt-header-additional .cesis_bp_notifications > span:last-child { margin:0 <?php echo esc_attr($header_a_space); ?>px 0 0;}

.menu_sep{ font-family:<?php echo esc_attr($menu_font); ?>; font-size:<?php echo esc_attr($menu_size); ?>; color:<?php echo esc_attr($menu_sep); ?>; }

/* Top bar breakpoint settings */


@media only screen and (max-width: <?php echo esc_attr($top_bar_breakpoint); ?>px) {
body:not(.cesis_custom_topbar) .header_top_bar { display:none;}
}

/* Transparent header settings */


@media only screen and (min-width: <?php echo esc_attr($header_breakpoint); ?>px) {


  body:not(.cesis_custom_breakpoint) .overlay_menu_on {transform: none !important; transition:all 0s; webkit-transition:all 0s;}
  body:not(.cesis_custom_breakpoint).cesis_vertical_header .cesis_sticky {transform: none; }

<?php if($menu_type == 'nav_line_separator' ){ ?>
  body:not(.cesis_custom_breakpoint) .cesis_transparent_header .top-header:not(.cesis_stuck) .tt-main-navigation  > div > ul > li.current-menu-item > a,
  body:not(.cesis_custom_breakpoint) .cesis_transparent_header .top-header:not(.cesis_stuck) .tt-main-navigation  > div > ul > li > a:hover{ background-color:<?php echo esc_attr($header_transparent_bg_color); ?>;}
<?php } ?>

<?php if($menu_type == 'nav_top_borderx' && $menu_border_pos == 'edge_border' ){ ?>
  body:not(.cesis_custom_breakpoint) .cesis_transparent_header .top-header:not(.cesis_stuck) .nav_top_borderx.edge_border  > div > ul > li.current-menu-item > a,
  body:not(.cesis_custom_breakpoint) .cesis_transparent_header .top-header:not(.cesis_stuck) .nav_top_borderx.edge_border  > div > ul > li > a:hover
  { box-shadow: inset 0px <?php echo esc_attr($menu_border_size); ?>px <?php echo esc_attr($header_transparent_active_color); ?>;}
<?php } ?>

<?php if($menu_type == 'nav_top_borderx' && $menu_border_pos == 'text_border' ){ ?>
  body:not(.cesis_custom_breakpoint) .cesis_transparent_header .top-header:not(.cesis_stuck) .nav_top_borderx.text_border  > div > ul > li.current-menu-item > a span,
  body:not(.cesis_custom_breakpoint) .cesis_transparent_header .top-header:not(.cesis_stuck) .nav_top_borderx.text_border  > div > ul > li > a:hover span {box-shadow: inset 0px <?php echo esc_attr($menu_border_size); ?>px <?php echo esc_attr($header_transparent_active_color); ?>; }
<?php } ?>

<?php if($menu_type == 'nav_bottom_borderx' && $menu_border_pos == 'edge_border' ){ ?>
  body:not(.cesis_custom_breakpoint) .cesis_transparent_header .top-header:not(.cesis_stuck) .nav_bottom_borderx.edge_border  > div > ul > li.current-menu-item > a,
  body:not(.cesis_custom_breakpoint) .cesis_transparent_header .top-header:not(.cesis_stuck) .nav_bottom_borderx.edge_border  > div > ul > li > a:hover
  { box-shadow: inset 0px -<?php echo esc_attr($menu_border_size); ?>px <?php echo esc_attr($header_transparent_active_color); ?>;}
<?php } ?>

<?php if($menu_type == 'nav_bottom_borderx' && $menu_border_pos == 'text_border' ){ ?>
body:not(.cesis_custom_breakpoint) .cesis_transparent_header .top-header:not(.cesis_stuck) .nav_bottom_borderx.text_border  > div > ul > li.current-menu-item > a span,
body:not(.cesis_custom_breakpoint) .cesis_transparent_header .top-header:not(.cesis_stuck) .nav_bottom_borderx.text_border  > div > ul > li > a:hover span {box-shadow: inset 0px -<?php echo esc_attr($menu_border_size); ?>px <?php echo esc_attr($header_transparent_active_color); ?>; }
<?php } ?>

<?php if($menu_type == 'nav_boxed_border'){ ?>
body:not(.cesis_custom_breakpoint) .cesis_transparent_header .top-header:not(.cesis_stuck) .nav_boxed_border  > div > ul > li.current-menu-item > a span,
body:not(.cesis_custom_breakpoint) .cesis_transparent_header .top-header:not(.cesis_stuck) .nav_boxed_border  > div > ul > li > a:hover span {border:<?php echo esc_attr($menu_border_size); ?>px solid <?php echo esc_attr($header_transparent_active_color); ?>; }
<?php } ?>

body:not(.cesis_custom_breakpoint) .cesis_transparent_header .top-header:not(.cesis_stuck) .header_main:not(.header_vertical),
body:not(.cesis_custom_breakpoint) .cesis_transparent_header .top-header:not(.cesis_stuck) .header_sub,
body:not(.cesis_custom_breakpoint) .cesis_transparent_header .top-header:not(.cesis_stuck) .header_top_bar,
body:not(.cesis_custom_breakpoint):not(.full_header_sticky) .cesis_transparent_header .header_top_bar
{background-color:<?php echo esc_attr($header_transparent_bg_color); ?>; border-color:<?php echo esc_attr($header_transparent_border_color); ?>}

body:not(.cesis_custom_breakpoint) .cesis_transparent_header .top-header:not(.cesis_stuck) .header_logo:not(.vertical_logo) a,
body:not(.cesis_custom_breakpoint) .cesis_transparent_header .top-header:not(.cesis_stuck) .tt-main-navigation:not(.tt-vertical-navigation)  > div > ul > li > a span,
body:not(.cesis_custom_breakpoint) .cesis_transparent_header .top-header:not(.cesis_stuck) .menu_sep,
body:not(.cesis_custom_breakpoint) .cesis_transparent_header .top-header:not(.cesis_stuck) .tt-header-additional:not(.vertical_additional) .cesis_social_icons a,
body:not(.cesis_custom_breakpoint) .cesis_transparent_header .top-header:not(.cesis_stuck) .tt-header-additional:not(.vertical_additional) .cesis_search_icon a,
body:not(.cesis_custom_breakpoint) .cesis_transparent_header .top-header:not(.cesis_stuck) .tt-header-additional:not(.vertical_additional) .cesis_bp_notifications a,
body:not(.cesis_custom_breakpoint) .cesis_transparent_header .top-header:not(.cesis_stuck) .tt-header-additional:not(.vertical_additional) .cesis_cart_icon i,
body:not(.cesis_custom_breakpoint) .cesis_transparent_header .top-header:not(.cesis_stuck) .header_top_bar,
body:not(.cesis_custom_breakpoint) .cesis_transparent_header .top-header:not(.cesis_stuck) .header_top_bar a,
body:not(.cesis_custom_breakpoint) .cesis_transparent_header .top-header:not(.cesis_stuck) .header_top_bar .cesis_social_icons a,
body:not(.cesis_custom_breakpoint) .cesis_transparent_header .top-header:not(.cesis_stuck) .header_top_bar .cesis_cart_icon a,
body:not(.cesis_custom_breakpoint):not(.full_header_sticky) .cesis_transparent_header .header_top_bar,
body:not(.cesis_custom_breakpoint):not(.full_header_sticky) .cesis_transparent_header .header_top_bar a,
body:not(.cesis_custom_breakpoint):not(.full_header_sticky) .cesis_transparent_header .header_top_bar .cesis_social_icons a,
body:not(.cesis_custom_breakpoint):not(.full_header_sticky) .cesis_transparent_header .header_top_bar .cesis_cart_icon a,
body:not(.cesis_custom_breakpoint) .cesis_transparent_header .top-header:not(.cesis_stuck) .header_logo a,
body:not(.cesis_custom_breakpoint) .cesis_transparent_header .top-header:not(.cesis_stuck) .cesis_offcanvas_cart .cart-menu > li > a,
body:not(.cesis_custom_breakpoint) .cesis_transparent_header .top-header:not(.cesis_stuck) .header_main .cesis_offcanvas_notifications a,
body.cesis_overlay_header:not(.cesis_custom_breakpoint) .cesis_transparent_header .top-header:not(.cesis_stuck) .header_logo a,
body:not(.cesis_custom_breakpoint) .cesis_transparent_header .top-header:not(.cesis_stuck) .cesis_overlay_cart .cart-menu > li > a,
body:not(.cesis_custom_breakpoint) .cesis_transparent_header .top-header:not(.cesis_stuck) .header_main .cesis_overlay_notifications a
 {color:<?php echo esc_attr($header_transparent_color); ?>}

body:not(.cesis_custom_breakpoint) .cesis_transparent_header .top-header:not(.cesis_stuck) .nav_line_separator  > div > ul > li,
body:not(.cesis_custom_breakpoint) .cesis_transparent_header .top-header:not(.cesis_stuck) .nav_line_separator > div > ul,
body:not(.cesis_custom_breakpoint) .cesis_transparent_header .top-header:not(.cesis_stuck) .nav_line_separator.logo_center > div > ul .cl_before_logo,
body:not(.cesis_custom_breakpoint) .cesis_transparent_header .top-header:not(.cesis_stuck),
body:not(.cesis_custom_breakpoint) .cesis_transparent_header .top-header:not(.cesis_stuck) .tt-main-additional,
body:not(.cesis_custom_breakpoint) .cesis_transparent_header .top-header:not(.cesis_stuck) .tt-sub-additional,
body:not(.cesis_custom_breakpoint) .cesis_transparent_header .top-header:not(.cesis_stuck) .tt-main-additional.logo_center.additional_border .cesis_social_icons,
body:not(.cesis_custom_breakpoint) .cesis_transparent_header .top-header:not(.cesis_stuck) .tt-main-additional .cesis_social_icons a:after,
body:not(.cesis_custom_breakpoint) .cesis_transparent_header .top-header:not(.cesis_stuck) .tt-main-additional.logo_center.additional_border .cesis_search_icon,
body:not(.cesis_custom_breakpoint) .cesis_transparent_header .top-header:not(.cesis_stuck) .tt-main-additional .cesis_search_icon a i:after,
body:not(.cesis_custom_breakpoint) .cesis_transparent_header .top-header:not(.cesis_stuck) .tt-sub-additional.menu_center.additional_border .cesis_social_icons,
body:not(.cesis_custom_breakpoint) .cesis_transparent_header .top-header:not(.cesis_stuck) .tt-sub-additional .cesis_social_icons a:after,
body:not(.cesis_custom_breakpoint) .cesis_transparent_header .top-header:not(.cesis_stuck) .tt-sub-additional.menu_center.additional_border .cesis_search_icon,
body:not(.cesis_custom_breakpoint) .cesis_transparent_header .top-header:not(.cesis_stuck) .tt-sub-additional .cesis_search_icon a i:after
{border-color:<?php echo esc_attr($header_transparent_border_color); ?>}

body:not(.cesis_custom_breakpoint) .cesis_transparent_header .top-header:not(.cesis_stuck) .tt-main-navigation:not(.tt-vertical-navigation)  > div > ul > li.current-menu-item > a span,
body:not(.cesis_custom_breakpoint) .cesis_transparent_header .top-header:not(.cesis_stuck) .tt-main-navigation:not(.tt-vertical-navigation)  > div > ul > li > a:hover span,
body:not(.cesis_custom_breakpoint) .cesis_transparent_header .top-header:not(.cesis_stuck) .tt-header-additional:not(.vertical_additional) .cesis_social_icons a:hover,
body:not(.cesis_custom_breakpoint) .cesis_transparent_header .top-header:not(.cesis_stuck) .tt-header-additional:not(.vertical_additional) .cesis_search_icon:hover a,
body:not(.cesis_custom_breakpoint) .cesis_transparent_header .top-header:not(.cesis_stuck) .tt-header-additional:not(.vertical_additional) .cesis_bp_notifications a:hover,
body:not(.cesis_custom_breakpoint) .cesis_transparent_header .top-header:not(.cesis_stuck) .header_top_bar a:hover,
body:not(.cesis_custom_breakpoint) .cesis_transparent_header .top-header:not(.cesis_stuck) .header_top_bar .cesis_social_icons a:hover,
body:not(.cesis_custom_breakpoint) .cesis_transparent_header .top-header:not(.cesis_stuck) .header_top_bar .cesis_cart_icon a:hover,
body:not(.cesis_custom_breakpoint):not(.full_header_sticky)  .cesis_transparent_header .header_top_bar a:hover,
body:not(.cesis_custom_breakpoint):not(.full_header_sticky)  .cesis_transparent_header .header_top_bar .cesis_social_icons a:hover,
body:not(.cesis_custom_breakpoint):not(.full_header_sticky)  .cesis_transparent_header .header_top_bar .cesis_cart_icon a:hover
{color:<?php echo esc_attr($header_transparent_active_color); ?>}

body:not(.cesis_custom_breakpoint) .cesis_transparent_header .top-header:not(.cesis_stuck) .header_main .lines,
body:not(.cesis_custom_breakpoint) .cesis_transparent_header .top-header:not(.cesis_stuck) .header_main .lines:after,
body:not(.cesis_custom_breakpoint) .cesis_transparent_header .top-header:not(.cesis_stuck) .header_main .lines:before
{background-color:<?php echo esc_attr($header_transparent_color); ?>}




}

/* Mobile menu settings */


.cesis_mobile_btn a span{
font-size:<?php echo esc_attr($mobile_a_btn_size); ?>;
font-family:<?php echo esc_attr($mobile_a_btn_font); ?>;
font-weight:<?php echo esc_attr($mobile_a_btn_weight); ?>;
text-transform:<?php echo esc_attr($mobile_a_btn_tt); ?>;
letter-spacing:<?php echo esc_attr($mobile_a_btn_ls); ?>;
color:<?php echo esc_attr($mobile_a_btn_color); ?>;
background:<?php echo esc_attr($mobile_a_btn_bg); ?>;
border-color:<?php echo esc_attr($mobile_a_btn_border); ?>;
border-radius:<?php echo esc_attr($mobile_a_btn_border_radius); ?>px;
border-width:<?php echo esc_attr($mobile_a_btn_border_size); ?>px;
line-height:<?php echo esc_attr($mobile_a_btn_height); ?>px;
width:<?php echo esc_attr($mobile_a_btn_width); ?>px;
}
.cesis_mobile_btn a span:hover{
color:<?php echo esc_attr($mobile_a_btn_h_color); ?>;
background:<?php echo esc_attr($mobile_a_btn_h_bg); ?>;
border-color:<?php echo esc_attr($mobile_a_btn_h_border); ?>;
}
.header_mobile{ background:<?php echo esc_attr($mobile_menu_bg); ?>; }
.header_mobile span {font-family:<?php echo esc_attr($mobile_menu_font); ?>; color:<?php echo esc_attr($mobile_menu_color); ?>;
font-size:<?php echo esc_attr($mobile_menu_size); ?>; font-weight:<?php echo esc_attr($mobile_menu_weight); ?>;
text-transform:<?php echo esc_attr($mobile_menu_tt); ?>; letter-spacing:<?php echo esc_attr($mobile_menu_ls); ?>;
 line-height:<?php echo esc_attr($mobile_menu_lh); ?>;}
.header_mobile .sub-menu span {font-family:<?php echo esc_attr($mobile_submenu_font); ?>; color:<?php echo esc_attr($mobile_submenu_color); ?>;
font-size:<?php echo esc_attr($mobile_submenu_size); ?>; font-weight:<?php echo esc_attr($mobile_submenu_weight); ?>;
text-transform:<?php echo esc_attr($mobile_submenu_tt); ?>; letter-spacing:<?php echo esc_attr($mobile_submenu_ls); ?>;
 line-height:<?php echo esc_attr($mobile_submenu_lh); ?>;}
.tt-mobile-additional .cesis_social_icons a { color:<?php echo esc_attr($mobile_menu_color); ?>; line-height:<?php echo esc_attr($mobile_menu_lh); ?>;}

.header_mobile li span,.tt-mobile-additional .cesis_search_icon a,.tt-mobile-additional .cesis_social_icons,
.tt-mobile-additional .cesis_search_icon input[type="search"] { border-color:<?php echo esc_attr($mobile_menu_border); ?>; }
.header_mobile .has-submenu > span:after,.header_mobile .has-submenu > span:before,
.header_mobile li span:after,.header_mobile li span:before{background:<?php echo esc_attr($mobile_menu_color); ?>;}
.header_mobile .highlighted > span{color:<?php echo esc_attr($mobile_open_menu); ?>;}
.header_mobile .highlighted > span:after,.header_mobile .highlighted > span:before{background:<?php echo esc_attr($mobile_open_menu); ?>;}


.header_mobile .current-menu-item > a > span {color:<?php echo esc_attr($mobile_current_menu); ?>;}
.header_mobile .current-menu-item { border-color:<?php echo esc_attr($mobile_current_menu); ?>;}

/* mobile breakpoint */
@media only screen and (min-width: <?php echo esc_attr($header_breakpoint+1); ?>px) {
body:not(.cesis_custom_breakpoint) .header_mobile { display:none!important;}
body:not(.cesis_custom_breakpoint) .mega_no_heading > ul > li > a:first-child { display: none; }
}
@media only screen and (max-width: <?php echo esc_attr($header_breakpoint); ?>px) {
body:not(.cesis_custom_breakpoint) .cesis_transparent_header { position:static;}
body:not(.cesis_custom_breakpoint) .desktop_logo { display:none !important;}
body:not(.cesis_custom_breakpoint) .mobile_logo { display:inline-block !important; max-height:<?php echo esc_attr($mobile_menu_height); ?>px !important; max-width:<?php echo esc_attr($mobile_logo_width); ?>px !important;}
body:not(.cesis_custom_breakpoint) .header_logo #logo_img{ max-height:<?php echo esc_attr($mobile_menu_height); ?>px !important; max-width:<?php echo esc_attr($mobile_logo_width); ?>px !important;}
body:not(.cesis_custom_breakpoint) .header_logo { width:100%; max-width:none;}
body:not(.cesis_custom_breakpoint) .header_main,body:not(.cesis_custom_breakpoint) .header_logo,
body:not(.cesis_custom_breakpoint) .cesis_mobile_notifications .cesis_bp_notifications,
body:not(.cesis_custom_breakpoint) .cesis_mobile_notifications .cesis_bp_notifications > span,
body:not(.cesis_custom_breakpoint) .cesis_mobile_notifications a,
body:not(.cesis_custom_breakpoint) .cesis_mobile_notifications i
{height:<?php echo esc_attr($mobile_menu_height); ?>px !important; min-height: auto !important; line-height:<?php echo esc_attr($mobile_menu_height); ?>px !important}
body:not(.cesis_custom_breakpoint) #header_container.cesis_opaque_header {min-height:<?php echo esc_attr($mobile_menu_height); ?>px !important;}

body:not(.cesis_custom_breakpoint) .cesis_mobile_menu_switch,
body:not(.cesis_custom_breakpoint) .cesis_mobile_btn{ display:flex;}
body:not(.cesis_custom_breakpoint) .cesis_mobile_cart,
body:not(.cesis_custom_breakpoint) .cesis_mobile_notifications{display:block;}
body:not(.cesis_custom_breakpoint) .tt-main-additional,body:not(.cesis_custom_breakpoint) .tt-main-navigation,
body:not(.cesis_custom_breakpoint) .header_sub,body:not(.cesis_custom_breakpoint) .header_offcanvas,
body:not(.cesis_custom_breakpoint) .cesis_offcanvas_switch,body:not(.cesis_custom_breakpoint) .header_overlay,
body:not(.cesis_custom_breakpoint) .header_overlay,body:not(.cesis_custom_breakpoint) .cesis_menu_overlay,
body:not(.cesis_custom_breakpoint) .header_overlay,body:not(.cesis_custom_breakpoint) .cesis_offcanvas_cart,
body:not(.cesis_custom_breakpoint) .cesis_offcanvas_notifications,body:not(.cesis_custom_breakpoint) .cesis_overlay_cart,
body:not(.cesis_custom_breakpoint) .cesis_overlay_notifications{ display:none}

body:not(.cesis_custom_breakpoint) .logo_center .cesis_mobile_menu_switch,
body:not(.cesis_custom_breakpoint) .logo_center .cesis_mobile_btn,
body:not(.cesis_custom_breakpoint) .logo_left .cesis_mobile_menu_switch,
body:not(.cesis_custom_breakpoint) .logo_left .cesis_mobile_btn,
body:not(.cesis_custom_breakpoint) .logo_center .cesis_mobile_cart,
body:not(.cesis_custom_breakpoint) .logo_center .cesis_mobile_notifications,
body:not(.cesis_custom_breakpoint) .logo_left .cesis_mobile_cart,
body:not(.cesis_custom_breakpoint) .logo_left .cesis_mobile_notifications,
body:not(.cesis_custom_breakpoint) .logo_right .site-title,
body:not(.cesis_custom_breakpoint) .logo_right #logo_img,
body:not(.cesis_custom_breakpoint) .header_v_pos_right .cesis_mobile_menu_switch,
body:not(.cesis_custom_breakpoint) .header_v_pos_right .cesis_mobile_btn,
body:not(.cesis_custom_breakpoint) .header_v_pos_left .site-title,
body:not(.cesis_custom_breakpoint) .header_v_pos_left #logo_img,
body:not(.cesis_custom_breakpoint) .header_v_pos_right .cesis_mobile_cart{float:right;}

body:not(.cesis_custom_breakpoint) .logo_center,
body:not(.cesis_custom_breakpoint) .logo_center #logo_img,
body:not(.cesis_custom_breakpoint) .logo_right .cesis_mobile_menu_switch,
body:not(.cesis_custom_breakpoint) .logo_right .cesis_mobile_btn,
body:not(.cesis_custom_breakpoint) .logo_right .cesis_mobile_cart,
body:not(.cesis_custom_breakpoint) .logo_right .cesis_mobile_notifications,
body:not(.cesis_custom_breakpoint) .logo_left .site-title,
body:not(.cesis_custom_breakpoint) .logo_left #logo_img,
body:not(.cesis_custom_breakpoint) .header_v_pos_left .cesis_mobile_menu_switch,
body:not(.cesis_custom_breakpoint) .header_v_pos_left .cesis_mobile_btn,
body:not(.cesis_custom_breakpoint) .header_v_pos_right .site-title,
body:not(.cesis_custom_breakpoint) .header_v_pos_right #logo_img,
body:not(.cesis_custom_breakpoint) .header_v_pos_left .cesis_mobile_cart{float:left;}

body:not(.cesis_custom_breakpoint) .header_vertical.header_v_cy_justify .cesis_container { overflow:visible;}

body:not(.cesis_custom_breakpoint) .cesis_top_banner,body:not(.cesis_custom_breakpoint) #header_container,body:not(.cesis_custom_breakpoint) #main-content,
body:not(.cesis_custom_breakpoint) #cesis_colophon{margin-right:0 !important; margin-left:0 !important;}
body:not(.cesis_custom_breakpoint) .header_main.header_vertical .cesis_container,body:not(.cesis_custom_breakpoint)  .header_offcanvas .cesis_container {padding:0 40px;}
body:not(.cesis_custom_breakpoint) .header_main.header_vertical {width:100%; position:relative; top:auto!important;}

body:not(.cesis_custom_breakpoint) .header_logo.logo_center { margin:0 !important; position:static!important;}

body:not(.cesis_custom_breakpoint) .header_main .lines,
body:not(.cesis_custom_breakpoint) .header_main .lines:after,
body:not(.cesis_custom_breakpoint) .header_main .lines:before { background:<?php echo esc_attr($header_menu_btn); ?>}

}
/* end mobile breakpoint */


/* Dropdown settings */


  .tt-main-navigation:not(.tt-vertical-navigation) .sub-menu,.cesis_cart_icon .cesis_dropdown{ background:<?php echo esc_attr($dropdown_bg); ?>; color:<?php echo esc_attr($dropdown_color); ?>;
   font-family:<?php echo esc_attr($dropdown_font); ?>; font-size:<?php echo esc_attr($dropdown_size); ?>; font-weight:<?php echo esc_attr($dropdown_weight); ?>;
  text-transform:<?php echo esc_attr($dropdown_tt); ?>; letter-spacing:<?php echo esc_attr($dropdown_ls); ?>; line-height:<?php echo esc_attr($dropdown_lh); ?>; }

.cesis_cart_icon .product_list_widget span.woocommerce-Price-amount.amount,.sm .cesis_megamenu_widget_area a{ font-family:<?php echo esc_attr($dropdown_font); ?> }

.sm .cesis_megamenu_widget_area a,
.cesis_dropdown ul.product_list_widget li.mini_cart_item a{ color:<?php echo esc_attr($dropdown_color); ?>; }

.tt-main-navigation:not(.tt-vertical-navigation) .sub-menu li > a > span,
.cesis_cart_icon .cesis_dropdown,
.cesis_cart_icon a.remove:after,
.cesis_cart_icon .product_list_widget span.woocommerce-Price-amount.amount{color:<?php echo esc_attr($dropdown_color);?>;}
.tt-main-navigation:not(.tt-vertical-navigation) .sub-menu li > a > span:hover{color:<?php echo esc_attr($dropdown_hover_color);?>; Background:<?php echo esc_attr($dropdown_hover_bg_color);?>;}

.tt-main-navigation:not(.tt-vertical-navigation) > div > ul > li .sub-menu li.current-menu-item > a > span,
.cesis_cart_icon a.remove:hover:after {color:<?php echo esc_attr($dropdown_active);?>;}
body:not(.rtl) .tt-main-navigation:not(.tt-vertical-navigation) > div > ul > li:not(.cesis_megamenu) .sub-menu li.current-menu-item > a > span {
    box-shadow: inset 5px 0 0 0 <?php echo esc_attr($dropdown_active);?>; }
body.rtl .tt-main-navigation:not(.tt-vertical-navigation) > div > ul > li:not(.cesis_megamenu) .sub-menu li.current-menu-item > a > span {
    box-shadow: inset -5px 0 0 0 <?php echo esc_attr($dropdown_active);?>; }
.cesis_cart_icon .buttons a.button:last-child{ background:<?php echo esc_attr($dropdown_active);?>; }

.tt-main-navigation:not(.tt-vertical-navigation) .cesis_megamenu > .sub-menu > li,
.cesis_cart_icon ul.product_list_widget li.mini_cart_item,
.cesis_cart_icon .buttons a.button:first-child,
.cesis_cart_icon .widget_shopping_cart_content .total,
.cesis_megamenu_widget_area section.widget_meta li,
.cesis_megamenu_widget_area section.widget_archive li,
.cesis_megamenu_widget_area section.widget_categories li,
.cesis_megamenu_widget_area section.widget_pages li a,
.cesis_megamenu_widget_area section.widget_recent_comments li,
.cesis_megamenu_widget_area section.widget_recent_entries li,
.cesis_megamenu_widget_area input,
.cesis_megamenu_widget_area ul.product_list_widget li.mini_cart_item,
.cesis_megamenu_widget_area .woocommerce-product-search input[type="search"]
{ border-color:<?php echo esc_attr($dropdown_border);?>}

.tt-main-navigation:not(.tt-vertical-navigation) .cesis_megamenu > .sub-menu > li > a > span,
.cesis_megamenu_widget_area section h2,.cesis_cart_icon a.button:first-child
{ color:<?php echo esc_attr($dropdown_heading_color); ?>;
font-family:<?php echo esc_attr($dropdown_heading_font); ?>; font-size:<?php echo esc_attr($dropdown_heading_size); ?>; font-weight:<?php echo esc_attr($dropdown_heading_weight); ?>;
text-transform:<?php echo esc_attr($dropdown_heading_tt); ?>; letter-spacing:<?php echo esc_attr($dropdown_heading_ls); ?>; line-height:<?php echo esc_attr($dropdown_heading_lh); ?>; }
.sub-menu .cesis_cart_icon a,.sub-menu .cesis_cart_icon span.woocommerce-Price-amount.amount,
.sub-menu .cesis_cart_icon .buttons a.button:first-child{ color:<?php echo esc_attr($dropdown_heading_color); ?>; }
.tt-main-navigation:not(.tt-vertical-navigation) .cesis_megamenu > .sub-menu > li > a > span:after,
.tt-main-navigation:not(.tt-vertical-navigation) > div > ul > li.cesis_megamenu .sub-menu li.current-menu-item > a > span:after,
.cesis_megamenu_widget_area section h2:after,.cesis_cart_icon a.button:first-child:hover { background:<?php echo esc_attr($dropdown_active); ?>;}


/*--------------------------------------------------------------
#3 Title and Breadcrumbs
--------------------------------------------------------------*/

<?php

if(cesis_check_bp_status() == true && cesis_is_buddypress()){
  $title_bg_color = $cesis_data['cesis_buddypress_title_background']['background-color'];
  // Background image.
  $title_bg_image = $cesis_data['cesis_buddypress_title_background']['background-image'];
  // Background image options
  $title_bg_repeat = $cesis_data['cesis_buddypress_title_background']['background-repeat'];
  $title_bg_position = $cesis_data['cesis_buddypress_title_background']['background-position'];
  $title_bg_size = $cesis_data['cesis_buddypress_title_background']['background-size'];
  $title_bg_attachement = $cesis_data['cesis_buddypress_title_background']['background-attachment'];

  $title_width_units = $cesis_data["cesis_buddypress_title_width"]["units"];
  if($title_width_units !== '%'){
    $title_width = ($cesis_data["cesis_buddypress_title_width"]["width"] + 80).$title_width_units;
  }else{
    $title_width = $cesis_data["cesis_buddypress_title_width"]["width"];
  }
  $title_height = $cesis_data["cesis_buddypress_title_height"]["height"];

  $title_height_units = $cesis_data["cesis_buddypress_title_height"]["units"];
  $title_min_height = $cesis_data["cesis_buddypress_title_minheight"]["height"];

  $title_color = $cesis_data["cesis_buddypress_title_font"]['color'];
  $title_font = $cesis_data["cesis_buddypress_title_font"]['font-family'];
  $title_size = $cesis_data["cesis_buddypress_title_font"]['font-size'];
  $title_weight = $cesis_data["cesis_buddypress_title_font"]['font-weight'];
  $title_tt = $cesis_data["cesis_buddypress_title_font"]['text-transform'];
  $title_ls = $cesis_data["cesis_buddypress_title_font"]['letter-spacing'];
  $title_border = $cesis_data["cesis_buddypress_title_border"];

  $bread_color = $cesis_data["cesis_buddypress_breadcrumbs_font"]['color'];
  $bread_font = $cesis_data["cesis_buddypress_breadcrumbs_font"]['font-family'];
  $bread_size = $cesis_data["cesis_buddypress_breadcrumbs_font"]['font-size'];
  $bread_weight = $cesis_data["cesis_buddypress_breadcrumbs_font"]['font-weight'];
  $bread_tt = $cesis_data["cesis_buddypress_breadcrumbs_font"]['text-transform'];
  $bread_ls = $cesis_data["cesis_buddypress_breadcrumbs_font"]['letter-spacing'];
  $bread_active_color = $cesis_data["cesis_buddypress_current_breadcrumbs_color"];
  $bread_bg_color = $cesis_data['cesis_buddypress_breadcrumbs_bg_color']['rgba'];

}else{
  $title_bg_color = $cesis_data['cesis_page_title_background']['background-color'];
  // Background image.
  $title_bg_image = $cesis_data['cesis_page_title_background']['background-image'];
  // Background image options
  $title_bg_repeat = $cesis_data['cesis_page_title_background']['background-repeat'];
  $title_bg_position = $cesis_data['cesis_page_title_background']['background-position'];
  $title_bg_size = $cesis_data['cesis_page_title_background']['background-size'];
  $title_bg_attachement = $cesis_data['cesis_page_title_background']['background-attachment'];

  $title_width_units = $cesis_data["cesis_page_title_width"]["units"];
  if($title_width_units !== '%'){
    $title_width = ($cesis_data["cesis_page_title_width"]["width"] + 80).$title_width_units;
  }else{
    $title_width = $cesis_data["cesis_page_title_width"]["width"];
  }
  $title_height = $cesis_data["cesis_page_title_height"]["height"];

  $title_height_units = $cesis_data["cesis_page_title_height"]["units"];
  $title_min_height = $cesis_data["cesis_page_title_minheight"]["height"];

  $title_color = $cesis_data["cesis_page_title_font"]['color'];
  $title_font = $cesis_data["cesis_page_title_font"]['font-family'];
  $title_size = $cesis_data["cesis_page_title_font"]['font-size'];
  $title_weight = $cesis_data["cesis_page_title_font"]['font-weight'];
  $title_tt = $cesis_data["cesis_page_title_font"]['text-transform'];
  $title_ls = $cesis_data["cesis_page_title_font"]['letter-spacing'];
  $title_border = $cesis_data["cesis_page_title_border"];

  $bread_color = $cesis_data["cesis_page_breadcrumbs_font"]['color'];
  $bread_font = $cesis_data["cesis_page_breadcrumbs_font"]['font-family'];
  $bread_size = $cesis_data["cesis_page_breadcrumbs_font"]['font-size'];
  $bread_weight = $cesis_data["cesis_page_breadcrumbs_font"]['font-weight'];
  $bread_tt = $cesis_data["cesis_page_breadcrumbs_font"]['text-transform'];
  $bread_ls = $cesis_data["cesis_page_breadcrumbs_font"]['letter-spacing'];
  $bread_active_color = $cesis_data["cesis_page_current_breadcrumbs_color"];
  $bread_bg_color = $cesis_data['cesis_page_breadcrumbs_bg_color']['rgba'];
}

// bbpress settings
$bbpress_title_bg_color = $cesis_data['cesis_bbpress_title_background']['background-color'];
// Background image.
$bbpress_title_bg_image = $cesis_data['cesis_bbpress_title_background']['background-image'];
// Background image options
$bbpress_title_bg_repeat = $cesis_data['cesis_bbpress_title_background']['background-repeat'];
$bbpress_title_bg_position = $cesis_data['cesis_bbpress_title_background']['background-position'];
$bbpress_title_bg_size = $cesis_data['cesis_bbpress_title_background']['background-size'];
$bbpress_title_bg_attachement = $cesis_data['cesis_bbpress_title_background']['background-attachment'];

$bbpress_title_width_units = $cesis_data["cesis_bbpress_title_width"]["units"];
if($bbpress_title_width_units !== '%'){
  $bbpress_title_width = ($cesis_data["cesis_bbpress_title_width"]["width"] + 80).$bbpress_title_width_units;
}else{
  $bbpress_title_width = $cesis_data["cesis_bbpress_title_width"]["width"];
}
$bbpress_title_height = $cesis_data["cesis_bbpress_title_height"]["height"];

$bbpress_title_height_units = $cesis_data["cesis_bbpress_title_height"]["units"];
$bbpress_title_min_height = $cesis_data["cesis_bbpress_title_minheight"]["height"];

$bbpress_title_color = $cesis_data["cesis_bbpress_title_font"]['color'];
$bbpress_title_font = $cesis_data["cesis_bbpress_title_font"]['font-family'];
$bbpress_title_size = $cesis_data["cesis_bbpress_title_font"]['font-size'];
$bbpress_title_weight = $cesis_data["cesis_bbpress_title_font"]['font-weight'];
$bbpress_title_tt = $cesis_data["cesis_bbpress_title_font"]['text-transform'];
$bbpress_title_ls = $cesis_data["cesis_bbpress_title_font"]['letter-spacing'];
$bbpress_title_border = $cesis_data["cesis_bbpress_title_border"];

$bbpress_bread_color = $cesis_data["cesis_bbpress_breadcrumbs_font"]['color'];
$bbpress_bread_font = $cesis_data["cesis_bbpress_breadcrumbs_font"]['font-family'];
$bbpress_bread_size = $cesis_data["cesis_bbpress_breadcrumbs_font"]['font-size'];
$bbpress_bread_weight = $cesis_data["cesis_bbpress_breadcrumbs_font"]['font-weight'];
$bbpress_bread_tt = $cesis_data["cesis_bbpress_breadcrumbs_font"]['text-transform'];
$bbpress_bread_ls = $cesis_data["cesis_bbpress_breadcrumbs_font"]['letter-spacing'];
$bbpress_bread_active_color = $cesis_data["cesis_bbpress_current_breadcrumbs_color"];
$bbpress_bread_bg_color = $cesis_data['cesis_bbpress_breadcrumbs_bg_color']['rgba'];

// Shop settings
$shop_title_bg_color = $cesis_data['cesis_shop_title_background']['background-color'];
// Background image.
$shop_title_bg_image = $cesis_data['cesis_shop_title_background']['background-image'];
// Background image options
$shop_title_bg_repeat = $cesis_data['cesis_shop_title_background']['background-repeat'];
$shop_title_bg_position = $cesis_data['cesis_shop_title_background']['background-position'];
$shop_title_bg_size = $cesis_data['cesis_shop_title_background']['background-size'];
$shop_title_bg_attachement = $cesis_data['cesis_shop_title_background']['background-attachment'];

$shop_title_width_units = $cesis_data["cesis_shop_title_width"]["units"];
if($shop_title_width_units !== '%'){
  $shop_title_width = ($cesis_data["cesis_shop_title_width"]["width"] + 80).$shop_title_width_units;
}else{
  $shop_title_width = $cesis_data["cesis_shop_title_width"]["width"];
}
$shop_title_height = $cesis_data["cesis_shop_title_height"]["height"];

$shop_title_height_units = $cesis_data["cesis_shop_title_height"]["units"];
$shop_title_min_height = $cesis_data["cesis_shop_title_minheight"]["height"];

$shop_title_color = $cesis_data["cesis_shop_title_font"]['color'];
$shop_title_font = $cesis_data["cesis_shop_title_font"]['font-family'];
$shop_title_size = $cesis_data["cesis_shop_title_font"]['font-size'];
$shop_title_weight = $cesis_data["cesis_shop_title_font"]['font-weight'];
$shop_title_tt = $cesis_data["cesis_shop_title_font"]['text-transform'];
$shop_title_ls = $cesis_data["cesis_shop_title_font"]['letter-spacing'];
$shop_title_border = $cesis_data["cesis_shop_title_border"];

$shop_bread_color = $cesis_data["cesis_shop_breadcrumbs_font"]['color'];
$shop_bread_font = $cesis_data["cesis_shop_breadcrumbs_font"]['font-family'];
$shop_bread_size = $cesis_data["cesis_shop_breadcrumbs_font"]['font-size'];
$shop_bread_weight = $cesis_data["cesis_shop_breadcrumbs_font"]['font-weight'];
$shop_bread_tt = $cesis_data["cesis_shop_breadcrumbs_font"]['text-transform'];
$shop_bread_ls = $cesis_data["cesis_shop_breadcrumbs_font"]['letter-spacing'];
$shop_bread_active_color = $cesis_data["cesis_shop_current_breadcrumbs_color"];
$shop_bread_bg_color = $cesis_data['cesis_shop_breadcrumbs_bg_color']['rgba'];

// Post settings
$post_title_bg_color = $cesis_data['cesis_post_title_background']['background-color'];
// Background image.
$post_title_bg_image = $cesis_data['cesis_post_title_background']['background-image'];
// Background image options
$post_title_bg_repeat = $cesis_data['cesis_post_title_background']['background-repeat'];
$post_title_bg_position = $cesis_data['cesis_post_title_background']['background-position'];
$post_title_bg_size = $cesis_data['cesis_post_title_background']['background-size'];
$post_title_bg_attachement = $cesis_data['cesis_post_title_background']['background-attachment'];

$post_title_width_units = $cesis_data["cesis_post_title_width"]["units"];
if($post_title_width_units !== '%'){
  $post_title_width = ($cesis_data["cesis_post_title_width"]["width"] + 80).$post_title_width_units;
}else{
  $post_title_width = $cesis_data["cesis_post_title_width"]["width"];
}
$post_title_height = $cesis_data["cesis_post_title_height"]["height"];

$post_title_height_units = $cesis_data["cesis_post_title_height"]["units"];
$post_title_min_height = $cesis_data["cesis_post_title_minheight"]["height"];

$post_title_color = $cesis_data["cesis_post_title_font"]['color'];
$post_title_font = $cesis_data["cesis_post_title_font"]['font-family'];
$post_title_size = $cesis_data["cesis_post_title_font"]['font-size'];
$post_title_weight = $cesis_data["cesis_post_title_font"]['font-weight'];
$post_title_tt = $cesis_data["cesis_post_title_font"]['text-transform'];
$post_title_ls = $cesis_data["cesis_post_title_font"]['letter-spacing'];
$post_title_border = $cesis_data["cesis_post_title_border"];

$post_bread_color = $cesis_data["cesis_post_breadcrumbs_font"]['color'];
$post_bread_font = $cesis_data["cesis_post_breadcrumbs_font"]['font-family'];
$post_bread_size = $cesis_data["cesis_post_breadcrumbs_font"]['font-size'];
$post_bread_weight = $cesis_data["cesis_post_breadcrumbs_font"]['font-weight'];
$post_bread_tt = $cesis_data["cesis_post_breadcrumbs_font"]['text-transform'];
$post_bread_ls = $cesis_data["cesis_post_breadcrumbs_font"]['letter-spacing'];
$post_bread_active_color = $cesis_data["cesis_post_current_breadcrumbs_color"];
$post_bread_bg_color = $cesis_data['cesis_post_breadcrumbs_bg_color']['rgba'];

// Portfolio settings
$portfolio_title_bg_color = $cesis_data['cesis_portfolio_title_background']['background-color'];
// Background image.
$portfolio_title_bg_image = $cesis_data['cesis_portfolio_title_background']['background-image'];
// Background image options
$portfolio_title_bg_repeat = $cesis_data['cesis_portfolio_title_background']['background-repeat'];
$portfolio_title_bg_position = $cesis_data['cesis_portfolio_title_background']['background-position'];
$portfolio_title_bg_size = $cesis_data['cesis_portfolio_title_background']['background-size'];
$portfolio_title_bg_attachement = $cesis_data['cesis_portfolio_title_background']['background-attachment'];

$portfolio_title_width_units = $cesis_data["cesis_portfolio_title_width"]["units"];
if($portfolio_title_width_units !== '%'){
  $portfolio_title_width = ($cesis_data["cesis_portfolio_title_width"]["width"] + 80).$portfolio_title_width_units;
}else{
  $portfolio_title_width = $cesis_data["cesis_portfolio_title_width"]["width"];
}
$portfolio_title_height = $cesis_data["cesis_portfolio_title_height"]["height"];

$portfolio_title_height_units = $cesis_data["cesis_portfolio_title_height"]["units"];
$portfolio_title_min_height = $cesis_data["cesis_portfolio_title_minheight"]["height"];

$portfolio_title_color = $cesis_data["cesis_portfolio_title_font"]['color'];
$portfolio_title_font = $cesis_data["cesis_portfolio_title_font"]['font-family'];
$portfolio_title_size = $cesis_data["cesis_portfolio_title_font"]['font-size'];
$portfolio_title_weight = $cesis_data["cesis_portfolio_title_font"]['font-weight'];
$portfolio_title_tt = $cesis_data["cesis_portfolio_title_font"]['text-transform'];
$portfolio_title_ls = $cesis_data["cesis_portfolio_title_font"]['letter-spacing'];
$portfolio_title_border = $cesis_data["cesis_portfolio_title_border"];

$portfolio_bread_color = $cesis_data["cesis_portfolio_breadcrumbs_font"]['color'];
$portfolio_bread_font = $cesis_data["cesis_portfolio_breadcrumbs_font"]['font-family'];
$portfolio_bread_size = $cesis_data["cesis_portfolio_breadcrumbs_font"]['font-size'];
$portfolio_bread_weight = $cesis_data["cesis_portfolio_breadcrumbs_font"]['font-weight'];
$portfolio_bread_tt = $cesis_data["cesis_portfolio_breadcrumbs_font"]['text-transform'];
$portfolio_bread_ls = $cesis_data["cesis_portfolio_breadcrumbs_font"]['letter-spacing'];
$portfolio_bread_active_color = $cesis_data["cesis_portfolio_current_breadcrumbs_color"];
$portfolio_bread_bg_color = $cesis_data['cesis_portfolio_breadcrumbs_bg_color']['rgba'];

// Staff settings
$staff_title_bg_color = $cesis_data['cesis_staff_title_background']['background-color'];
// Background image.
$staff_title_bg_image = $cesis_data['cesis_staff_title_background']['background-image'];
// Background image options
$staff_title_bg_repeat = $cesis_data['cesis_staff_title_background']['background-repeat'];
$staff_title_bg_position = $cesis_data['cesis_staff_title_background']['background-position'];
$staff_title_bg_size = $cesis_data['cesis_staff_title_background']['background-size'];
$staff_title_bg_attachement = $cesis_data['cesis_staff_title_background']['background-attachment'];

$staff_title_width_units = $cesis_data["cesis_staff_title_width"]["units"];
if($staff_title_width_units !== '%'){
  $staff_title_width = ($cesis_data["cesis_staff_title_width"]["width"] + 80).$staff_title_width_units;
}else{
  $staff_title_width = $cesis_data["cesis_staff_title_width"]["width"];
}
$staff_title_height = $cesis_data["cesis_staff_title_height"]["height"];

$staff_title_height_units = $cesis_data["cesis_staff_title_height"]["units"];
$staff_title_min_height = $cesis_data["cesis_staff_title_minheight"]["height"];

$staff_title_color = $cesis_data["cesis_staff_title_font"]['color'];
$staff_title_font = $cesis_data["cesis_staff_title_font"]['font-family'];
$staff_title_size = $cesis_data["cesis_staff_title_font"]['font-size'];
$staff_title_weight = $cesis_data["cesis_staff_title_font"]['font-weight'];
$staff_title_tt = $cesis_data["cesis_staff_title_font"]['text-transform'];
$staff_title_ls = $cesis_data["cesis_staff_title_font"]['letter-spacing'];
$staff_title_border = $cesis_data["cesis_staff_title_border"];

$staff_bread_color = $cesis_data["cesis_staff_breadcrumbs_font"]['color'];
$staff_bread_font = $cesis_data["cesis_staff_breadcrumbs_font"]['font-family'];
$staff_bread_size = $cesis_data["cesis_staff_breadcrumbs_font"]['font-size'];
$staff_bread_weight = $cesis_data["cesis_staff_breadcrumbs_font"]['font-weight'];
$staff_bread_tt = $cesis_data["cesis_staff_breadcrumbs_font"]['text-transform'];
$staff_bread_ls = $cesis_data["cesis_staff_breadcrumbs_font"]['letter-spacing'];
$staff_bread_active_color = $cesis_data["cesis_staff_current_breadcrumbs_color"];
$staff_bread_bg_color = $cesis_data['cesis_staff_breadcrumbs_bg_color']['rgba'];
 ?>

 /* title container */


<?php if($title_bg_image !== '') { ?>
.page_title_container {
background-image:url(<?php echo esc_attr($title_bg_image);?>);
background-repeat:<?php echo esc_attr($title_bg_repeat);?>;
background-position:<?php echo esc_attr($title_bg_position);?>;
background-size:<?php echo esc_attr($title_bg_size);?>;
background-attachment:<?php echo esc_attr($title_bg_attachement);?>;
background-color:<?php echo esc_attr($title_bg_color);?>;
}
<?php }else { ?>
.page_title_container {
background-color:<?php echo esc_attr($title_bg_color);?>;
}
<?php } if($title_border !== ''){ ?>
.page_title_container {  border-bottom:1px solid <?php echo esc_attr($title_border);?>; }
<?php } if($title_min_height !== ''){ ?>
.page_title_container { min-height:<?php echo esc_attr($title_min_height);?>; }
<?php } if($title_width !== '' ){  ?>
.page_title_container .cesis_container,.title_layout_three .breadcrumb_container ul{ max-width:<?php echo esc_attr($title_width); ?>; }
<?php }if( $title_height_units == 'px'){?>
.page_title_container { height:<?php echo esc_attr($title_height);?>; }
<?php }elseif( $title_height_units !== 'px'){
$title_height = str_replace('%','vh', $title_height);
?>
.page_title_container { height:<?php echo esc_attr($title_height);?>; }
<?php } ?>
/* title */
.main-title{ color:<?php echo esc_attr($title_color); ?>; font-family:<?php echo esc_attr($title_font); ?>; font-size:<?php echo esc_attr($title_size); ?>; text-transform:<?php echo esc_attr($title_tt); ?>; letter-spacing:<?php echo esc_attr($title_ls); ?>;  font-weight:<?php echo esc_attr($title_weight); ?>; }
.main-title a { color:<?php echo esc_attr($title_color); ?>; }

/* breadcrumb */

.breadcrumb_container{ font-family:<?php echo esc_attr($bread_font); ?>; font-size:<?php echo esc_attr($bread_size); ?>; text-transform:<?php echo esc_attr($bread_tt); ?>; letter-spacing:<?php echo esc_attr($bread_ls); ?>; font-weight:<?php echo esc_attr($bread_weight); ?>;}
.breadcrumb_container,.breadcrumb_container a{ color:<?php echo esc_attr($bread_color); ?> }
.breadcrumb_container a:hover{ color:<?php echo esc_attr($bread_active_color); ?> }
.title_layout_three .breadcrumb_container{ background:<?php echo esc_attr($bread_bg_color); ?> }


<?php if(cesis_check_woo_status() == true){ ?>

  <?php if($shop_title_bg_image !== '') { ?>
  body.woocommerce .page_title_container {
  background-image:url(<?php echo esc_attr($shop_title_bg_image);?>);
  background-repeat:<?php echo esc_attr($shop_title_bg_repeat);?>;
  background-position:<?php echo esc_attr($shop_title_bg_position);?>;
  background-size:<?php echo esc_attr($shop_title_bg_size);?>;
  background-attachment:<?php echo esc_attr($shop_title_bg_attachement);?>;
  background-color:<?php echo esc_attr($shop_title_bg_color);?>;
  }
  <?php }else { ?>
  body.woocommerce .page_title_container {
  background-color:<?php echo esc_attr($shop_title_bg_color);?>;
  }
  <?php } if($shop_title_border !== ''){ ?>
  body.woocommerce .page_title_container {  border-bottom:1px solid <?php echo esc_attr($shop_title_border);?>; }
  <?php } if($shop_title_min_height !== ''){ ?>
  body.woocommerce .page_title_container { min-height:<?php echo esc_attr($shop_title_min_height);?>; }
  <?php } if($shop_title_width !== '' ){  ?>
  body.woocommerce .page_title_container .cesis_container,body.woocommerce .title_layout_three .breadcrumb_container ul{ max-width:<?php echo esc_attr($shop_title_width); ?>; }
  <?php }if( $shop_title_height_units == 'px'){?>
  body.woocommerce .page_title_container { height:<?php echo esc_attr($shop_title_height);?>; }
  <?php }elseif( $shop_title_height_units !== 'px'){
  $shop_title_height = str_replace('%','vh', $shop_title_height);
  ?>
  body.woocommerce .page_title_container { height:<?php echo esc_attr($shop_title_height);?>; }
  <?php } ?>
  /* title */
  body.woocommerce .main-title{ color:<?php echo esc_attr($shop_title_color); ?>; font-family:<?php echo esc_attr($shop_title_font); ?>; font-size:<?php echo esc_attr($shop_title_size); ?>; text-transform:<?php echo esc_attr($shop_title_tt); ?>; letter-spacing:<?php echo esc_attr($shop_title_ls); ?>;  font-weight:<?php echo esc_attr($shop_title_weight); ?>; }
  body.woocommerce .main-title a { color:<?php echo esc_attr($shop_title_color); ?>; }

  /* breadcrumb */

  body.woocommerce .breadcrumb_container{ font-family:<?php echo esc_attr($shop_bread_font); ?>; font-size:<?php echo esc_attr($shop_bread_size); ?>; text-transform:<?php echo esc_attr($shop_bread_tt); ?>; letter-spacing:<?php echo esc_attr($shop_bread_ls); ?>; font-weight:<?php echo esc_attr($shop_bread_weight); ?>;}
  body.woocommerce .breadcrumb_container,body.woocommerce .breadcrumb_container a{ color:<?php echo esc_attr($shop_bread_color); ?> }
  body.woocommerce .breadcrumb_container a:hover{ color:<?php echo esc_attr($shop_bread_active_color); ?> }
  body.woocommerce .title_layout_three .breadcrumb_container{ background:<?php echo esc_attr($shop_bread_bg_color); ?> }


<?php } ?>

<?php if(cesis_check_bbp_status() == true){ ?>
  <?php if($bbpress_title_bg_image !== '') { ?>
  body.bbpress:not(.buddypress) .page_title_container {
  background-image:url(<?php echo esc_attr($bbpress_title_bg_image);?>);
  background-repeat:<?php echo esc_attr($bbpress_title_bg_repeat);?>;
  background-position:<?php echo esc_attr($bbpress_title_bg_position);?>;
  background-size:<?php echo esc_attr($bbpress_title_bg_size);?>;
  background-attachment:<?php echo esc_attr($bbpress_title_bg_attachement);?>;
  background-color:<?php echo esc_attr($bbpress_title_bg_color);?>;
  }
  <?php }else { ?>
  body.bbpress:not(.buddypress) .page_title_container {
  background-color:<?php echo esc_attr($bbpress_title_bg_color);?>;
  }
  <?php } if($bbpress_title_border !== ''){ ?>
  body.bbpress:not(.buddypress) .page_title_container {  border-bottom:1px solid <?php echo esc_attr($bbpress_title_border);?>; }
  <?php } if($bbpress_title_min_height !== ''){ ?>
  body.bbpress:not(.buddypress) .page_title_container { min-height:<?php echo esc_attr($bbpress_title_min_height);?>; }
  <?php } if($bbpress_title_width !== '' ){  ?>
  body.bbpress:not(.buddypress) .page_title_container .cesis_container,body.bbpress:not(.buddypress) .title_layout_three .breadcrumb_container ul{ max-width:<?php echo esc_attr($bbpress_title_width); ?>; }
  <?php }if( $bbpress_title_height_units == 'px'){?>
  body.bbpress:not(.buddypress) .page_title_container { height:<?php echo esc_attr($bbpress_title_height);?>; }
  <?php }elseif( $bbpress_title_height_units !== 'px'){
  $bbpress_title_height = str_replace('%','vh', $bbpress_title_height);
  ?>
  body.bbpress:not(.buddypress) .page_title_container { height:<?php echo esc_attr($bbpress_title_height);?>; }
  <?php } ?>
  /* title */
  body.bbpress:not(.buddypress) .main-title{ color:<?php echo esc_attr($bbpress_title_color); ?>; font-family:<?php echo esc_attr($bbpress_title_font); ?>; font-size:<?php echo esc_attr($bbpress_title_size); ?>; text-transform:<?php echo esc_attr($bbpress_title_tt); ?>; letter-spacing:<?php echo esc_attr($bbpress_title_ls); ?>;  font-weight:<?php echo esc_attr($bbpress_title_weight); ?>; }
  body.bbpress:not(.buddypress) .main-title a { color:<?php echo esc_attr($bbpress_title_color); ?>; }

  /* breadcrumb */

  body.bbpress:not(.buddypress) .breadcrumb_container{ font-family:<?php echo esc_attr($bbpress_bread_font); ?>; font-size:<?php echo esc_attr($bbpress_bread_size); ?>; text-transform:<?php echo esc_attr($bbpress_bread_tt); ?>; letter-spacing:<?php echo esc_attr($bbpress_bread_ls); ?>; font-weight:<?php echo esc_attr($bbpress_bread_weight); ?>;}
  body.bbpress:not(.buddypress) .breadcrumb_container,body.bbpress:not(.buddypress) .breadcrumb_container a{ color:<?php echo esc_attr($bbpress_bread_color); ?> }
  body.bbpress:not(.buddypress) .breadcrumb_container a:hover{ color:<?php echo esc_attr($bbpress_bread_active_color); ?> }
  body.bbpress:not(.buddypress) .title_layout_three .breadcrumb_container{ background:<?php echo esc_attr($bbpress_bread_bg_color); ?> }

  <?php } ?>

   /* post title */
  <?php if($post_title_bg_image !== '') { ?>
  body.single-post .page_title_container {
  background-image:url(<?php echo esc_attr($post_title_bg_image);?>);
  background-repeat:<?php echo esc_attr($post_title_bg_repeat);?>;
  background-position:<?php echo esc_attr($post_title_bg_position);?>;
  background-size:<?php echo esc_attr($post_title_bg_size);?>;
  background-attachment:<?php echo esc_attr($post_title_bg_attachement);?>;
  background-color:<?php echo esc_attr($post_title_bg_color);?>;
  }
  <?php }else { ?>
  body.single-post .page_title_container {
  background-color:<?php echo esc_attr($post_title_bg_color);?>;
  }
  <?php } if($post_title_border !== ''){ ?>
  body.single-post .page_title_container {  border-bottom:1px solid <?php echo esc_attr($post_title_border);?>; }
  <?php } if($post_title_min_height !== ''){ ?>
  body.single-post .page_title_container { min-height:<?php echo esc_attr($post_title_min_height);?>; }
  <?php } if($post_title_width !== '' ){  ?>
  body.single-post .page_title_container .cesis_container,body.single-post .title_layout_three .breadcrumb_container ul{ max-width:<?php echo esc_attr($post_title_width); ?>; }
  <?php }if( $post_title_height_units == 'px'){?>
  body.single-post .page_title_container { height:<?php echo esc_attr($post_title_height);?>; }
  <?php }elseif( $post_title_height_units !== 'px'){
  $post_title_height = str_replace('%','vh', $post_title_height);
  ?>
  body.single-post .page_title_container { height:<?php echo esc_attr($post_title_height);?>; }
  <?php } ?>
  /* title */
  body.single-post .main-title{ color:<?php echo esc_attr($post_title_color); ?>; font-family:<?php echo esc_attr($post_title_font); ?>; font-size:<?php echo esc_attr($post_title_size); ?>; text-transform:<?php echo esc_attr($post_title_tt); ?>; letter-spacing:<?php echo esc_attr($post_title_ls); ?>;  font-weight:<?php echo esc_attr($post_title_weight); ?>; }
  body.single-post .main-title a { color:<?php echo esc_attr($post_title_color); ?>; }

  /* breadcrumb */

  body.single-post .breadcrumb_container{ font-family:<?php echo esc_attr($post_bread_font); ?>; font-size:<?php echo esc_attr($post_bread_size); ?>; text-transform:<?php echo esc_attr($post_bread_tt); ?>; letter-spacing:<?php echo esc_attr($post_bread_ls); ?>; font-weight:<?php echo esc_attr($post_bread_weight); ?>;}
  body.single-post .breadcrumb_container,body.single-post .breadcrumb_container a{ color:<?php echo esc_attr($post_bread_color); ?> }
  body.single-post .breadcrumb_container a:hover{ color:<?php echo esc_attr($post_bread_active_color); ?> }
  body.single-post .title_layout_three .breadcrumb_container{ background:<?php echo esc_attr($post_bread_bg_color); ?> }

  /* portfolio title */
  <?php if($portfolio_title_bg_image !== '') { ?>
  body.single-portfolio .page_title_container {
  background-image:url(<?php echo esc_attr($portfolio_title_bg_image);?>);
  background-repeat:<?php echo esc_attr($portfolio_title_bg_repeat);?>;
  background-position:<?php echo esc_attr($portfolio_title_bg_position);?>;
  background-size:<?php echo esc_attr($portfolio_title_bg_size);?>;
  background-attachment:<?php echo esc_attr($portfolio_title_bg_attachement);?>;
  background-color:<?php echo esc_attr($portfolio_title_bg_color);?>;
  }
  <?php }else { ?>
  body.single-portfolio .page_title_container {
  background-color:<?php echo esc_attr($portfolio_title_bg_color);?>;
  }
  <?php } if($portfolio_title_border !== ''){ ?>
  body.single-portfolio .page_title_container {  border-bottom:1px solid <?php echo esc_attr($portfolio_title_border);?>; }
  <?php } if($portfolio_title_min_height !== ''){ ?>
  body.single-portfolio .page_title_container { min-height:<?php echo esc_attr($portfolio_title_min_height);?>; }
  <?php } if($portfolio_title_width !== '' ){  ?>
  body.single-portfolio .page_title_container .cesis_container,body.single-portfolio .title_layout_three .breadcrumb_container ul{ max-width:<?php echo esc_attr($portfolio_title_width); ?>; }
  <?php }if( $portfolio_title_height_units == 'px'){?>
  body.single-portfolio .page_title_container { height:<?php echo esc_attr($portfolio_title_height);?>; }
  <?php }elseif( $portfolio_title_height_units !== 'px'){
  $portfolio_title_height = str_replace('%','vh', $portfolio_title_height);
  ?>
  body.single-portfolio .page_title_container { height:<?php echo esc_attr($portfolio_title_height);?>; }
  <?php } ?>
  /* title */
  body.single-portfolio .main-title{ color:<?php echo esc_attr($portfolio_title_color); ?>; font-family:<?php echo esc_attr($portfolio_title_font); ?>; font-size:<?php echo esc_attr($portfolio_title_size); ?>; text-transform:<?php echo esc_attr($portfolio_title_tt); ?>; letter-spacing:<?php echo esc_attr($portfolio_title_ls); ?>;  font-weight:<?php echo esc_attr($portfolio_title_weight); ?>; }
  body.single-portfolio .main-title a { color:<?php echo esc_attr($portfolio_title_color); ?>; }

  /* breadcrumb */

  body.single-portfolio .breadcrumb_container{ font-family:<?php echo esc_attr($portfolio_bread_font); ?>; font-size:<?php echo esc_attr($portfolio_bread_size); ?>; text-transform:<?php echo esc_attr($portfolio_bread_tt); ?>; letter-spacing:<?php echo esc_attr($portfolio_bread_ls); ?>; font-weight:<?php echo esc_attr($portfolio_bread_weight); ?>;}
  body.single-portfolio .breadcrumb_container,body.single-portfolio .breadcrumb_container a{ color:<?php echo esc_attr($portfolio_bread_color); ?> }
  body.single-portfolio .breadcrumb_container a:hover{ color:<?php echo esc_attr($portfolio_bread_active_color); ?> }
  body.single-portfolio .title_layout_three .breadcrumb_container{ background:<?php echo esc_attr($portfolio_bread_bg_color); ?> }


  /* staff title */
  <?php if($staff_title_bg_image !== '') { ?>
  body.single-staff .page_title_container {
  background-image:url(<?php echo esc_attr($staff_title_bg_image);?>);
  background-repeat:<?php echo esc_attr($staff_title_bg_repeat);?>;
  background-position:<?php echo esc_attr($staff_title_bg_position);?>;
  background-size:<?php echo esc_attr($staff_title_bg_size);?>;
  background-attachment:<?php echo esc_attr($staff_title_bg_attachement);?>;
  background-color:<?php echo esc_attr($staff_title_bg_color);?>;
  }
  <?php }else { ?>
  body.single-staff .page_title_container {
  background-color:<?php echo esc_attr($staff_title_bg_color);?>;
  }
  <?php } if($staff_title_border !== ''){ ?>
  body.single-staff .page_title_container {  border-bottom:1px solid <?php echo esc_attr($staff_title_border);?>; }
  <?php } if($staff_title_min_height !== ''){ ?>
  body.single-staff .page_title_container { min-height:<?php echo esc_attr($staff_title_min_height);?>; }
  <?php } if($staff_title_width !== '' ){  ?>
  body.single-staff .page_title_container .cesis_container,body.single-staff .title_layout_three .breadcrumb_container ul{ max-width:<?php echo esc_attr($staff_title_width); ?>; }
  <?php }if( $staff_title_height_units == 'px'){?>
  body.single-staff .page_title_container { height:<?php echo esc_attr($staff_title_height);?>; }
  <?php }elseif( $staff_title_height_units !== 'px'){
  $staff_title_height = str_replace('%','vh', $staff_title_height);
  ?>
  body.single-staff .page_title_container { height:<?php echo esc_attr($staff_title_height);?>; }
  <?php } ?>
  /* title */
  body.single-staff .main-title{ color:<?php echo esc_attr($staff_title_color); ?>; font-family:<?php echo esc_attr($staff_title_font); ?>; font-size:<?php echo esc_attr($staff_title_size); ?>; text-transform:<?php echo esc_attr($staff_title_tt); ?>; letter-spacing:<?php echo esc_attr($staff_title_ls); ?>;  font-weight:<?php echo esc_attr($staff_title_weight); ?>; }
  body.single-staff .main-title a { color:<?php echo esc_attr($staff_title_color); ?>; }

  /* breadcrumb */

  body.single-staff .breadcrumb_container{ font-family:<?php echo esc_attr($staff_bread_font); ?>; font-size:<?php echo esc_attr($staff_bread_size); ?>; text-transform:<?php echo esc_attr($staff_bread_tt); ?>; letter-spacing:<?php echo esc_attr($staff_bread_ls); ?>; font-weight:<?php echo esc_attr($staff_bread_weight); ?>;}
  body.single-staff .breadcrumb_container,body.single-staff .breadcrumb_container a{ color:<?php echo esc_attr($staff_bread_color); ?> }
  body.single-staff .breadcrumb_container a:hover{ color:<?php echo esc_attr($staff_bread_active_color); ?> }
  body.single-staff .title_layout_three .breadcrumb_container{ background:<?php echo esc_attr($staff_bread_bg_color); ?> }

/*--------------------------------------------------------------
#4 Main Content
--------------------------------------------------------------*/

<?php

$main_area_bg = $cesis_data["cesis_main_content_bg"];
$main_area_border = $cesis_data["cesis_main_content_border"];
$main_area_heading = $cesis_data["cesis_main_content_heading"];
$main_area_color = $cesis_data["cesis_main_content_color"];
$main_area_light_color = $cesis_data["cesis_main_content_light_color"];
$main_area_one_acolor = $cesis_data["cesis_main_content_accent_one"];
$main_area_two_acolor = $cesis_data["cesis_main_content_accent_two"];
$main_area_three_acolor = $cesis_data["cesis_main_content_accent_three"];


$main_area_alt_bg = $cesis_data["cesis_main_content_alt_bg"];
$main_area_alt_border = $cesis_data["cesis_main_content_alt_border"];
$main_area_alt_heading = $cesis_data["cesis_main_content_alt_heading"];
$main_area_alt_color = $cesis_data["cesis_main_content_alt_color"];
$main_area_alt_light_color = $cesis_data["cesis_main_content_alt_light_color"];
$main_area_alt_one_acolor = $cesis_data["cesis_main_content_alt_accent_one"];
$main_area_alt_two_acolor = $cesis_data["cesis_main_content_alt_accent_two"];
$main_area_alt_three_acolor = $cesis_data["cesis_main_content_alt_accent_three"];

$main_button_font = $cesis_data["cesis_main_content_button_font"]['font-family'];
$main_button_size = $cesis_data["cesis_main_content_button_font"]['font-size'];
$main_button_weight = $cesis_data["cesis_main_content_button_font"]['font-weight'];
$main_button_tt = $cesis_data["cesis_main_content_button_font"]['text-transform'];
$main_button_ls = $cesis_data["cesis_main_content_button_font"]['letter-spacing'];
$main_button_lh = $cesis_data["cesis_main_content_button_font"]['line-height'];
$main_button_shadow = $cesis_data["cesis_main_content_button_shadow"];
$main_button_text = $cesis_data["cesis_main_content_button_text"];
$main_button_bg = $cesis_data["cesis_main_content_button_background"]["rgba"];
$main_button_border = $cesis_data["cesis_main_content_button_border"]["rgba"];
$main_button_hover_text = $cesis_data["cesis_main_content_button_hover_text"];
$main_button_hover_bg = $cesis_data["cesis_main_content_button_hover_background"]["rgba"];
$main_button_hover_border = $cesis_data["cesis_main_content_button_hover_border"]["rgba"];


$main_alt_button_font = $cesis_data["cesis_main_content_alt_button_font"]['font-family'];
$main_alt_button_size = $cesis_data["cesis_main_content_alt_button_font"]['font-size'];
$main_alt_button_weight = $cesis_data["cesis_main_content_alt_button_font"]['font-weight'];
$main_alt_button_tt = $cesis_data["cesis_main_content_alt_button_font"]['text-transform'];
$main_alt_button_ls = $cesis_data["cesis_main_content_alt_button_font"]['letter-spacing'];
$main_alt_button_lh = $cesis_data["cesis_main_content_alt_button_font"]['line-height'];
$main_alt_button_shadow = $cesis_data["cesis_main_content_alt_button_shadow"];
$main_alt_button_text = $cesis_data["cesis_main_content_alt_button_text"];
$main_alt_button_bg = $cesis_data["cesis_main_content_alt_button_background"]["rgba"];
$main_alt_button_border = $cesis_data["cesis_main_content_alt_button_border"]["rgba"];
$main_alt_button_hover_text = $cesis_data["cesis_main_content_alt_button_hover_text"];
$main_alt_button_hover_bg = $cesis_data["cesis_main_content_alt_button_hover_background"]["rgba"];
$main_alt_button_hover_border = $cesis_data["cesis_main_content_alt_button_hover_border"]["rgba"];


$main_sub_button_font = $cesis_data["cesis_main_content_sub_button_font"]['font-family'];
$main_sub_button_size = $cesis_data["cesis_main_content_sub_button_font"]['font-size'];
$main_sub_button_weight = $cesis_data["cesis_main_content_sub_button_font"]['font-weight'];
$main_sub_button_tt = $cesis_data["cesis_main_content_sub_button_font"]['text-transform'];
$main_sub_button_ls = $cesis_data["cesis_main_content_sub_button_font"]['letter-spacing'];
$main_sub_button_lh = $cesis_data["cesis_main_content_sub_button_font"]['line-height'];
$main_sub_button_shadow = $cesis_data["cesis_main_content_sub_button_shadow"];
$main_sub_button_text = $cesis_data["cesis_main_content_sub_button_text"];
$main_sub_button_bg = $cesis_data["cesis_main_content_sub_button_background"]["rgba"];
$main_sub_button_border = $cesis_data["cesis_main_content_sub_button_border"]["rgba"];
$main_sub_button_hover_text = $cesis_data["cesis_main_content_sub_button_hover_text"];
$main_sub_button_hover_bg = $cesis_data["cesis_main_content_sub_button_hover_background"]["rgba"];
$main_sub_button_hover_border = $cesis_data["cesis_main_content_sub_button_hover_border"]["rgba"];



?>

/* background */

.site-main input[type="text"],.site-main input[type="email"],.site-main input[type="url"],
.site-main input[type="password"],.site-main input[type="search"],.site-main input[type="number"],.site-main textarea,
.site-main select,

.main-container,.comments-layout-two textarea,.comments-layout-two .single_post_author, .comments-layout-two .single_post_email, .comments-layout-two .single_post_url,.comments-layout-three,.comments-layout-three textarea,.comments-layout-three .single_post_author, .comments-layout-three .single_post_email, .comments-layout-three .single_post_url,.boxes_container article,.boxes_container .author_bio_ctn,.boxes_container .writer_navigation,.writer_container .author_bio_ctn,.comments-layout-four div.avatar,.comments-layout-one input, .comments-layout-one textarea,.comments-layout-two textarea, .comments-layout-two .single_post_author, .comments-layout-two .single_post_email, .comments-layout-two .single_post_url,.comments-layout-three textarea, .comments-layout-three .single_post_author, .comments-layout-three .single_post_email, .comments-layout-three .single_post_url,.comments-layout-four .single_post_author, .comments-layout-four .single_post_email, .comments-layout-four .single_post_url,.comments-layout-six input,.comments-layout-six textarea,.comments-layout-seven .comment_ctn,.comments-layout-seven input,.comments-layout-seven textarea,.lifestyle_container .author_bio_ctn,
.cesis_tabs.horizontal.cesis_tab_1 .tabs > li,
.cesis_tabs.horizontal.cesis_tab_1 .tabs-container,
.cesis_tabs.horizontal.cesis_tab_2 .tabs > li,
.cesis_tabs.horizontal.cesis_tab_2 .tabs-container,
.cesis_tabs.horizontal.cesis_tab_3 .tabs > li,
.cesis_tabs.horizontal.cesis_tab_3 .tabs-container,
.cesis_tabs.horizontal.cesis_tab_5 .tabs > li,
.cesis_tabs.horizontal.cesis_tab_5 .tabs-container,

.cesis_acc_1 .panel-title.active,
.cesis_acc_1 .panel-collapse.collapse.in,
.cesis_acc_3 .panel-title.active,
.cesis_acc_4 .panel-title.active,
.cesis_acc_5 .panel-title.active,

.cesis_blog_style_6 .cesis_blog_m_content,
.cesis_blog_style_7 .cesis_blog_m_content,
.cesis_blog_style_8 .cesis_blog_m_content,
.cesis_blog_style_15 .cesis_blog_m_content,
.cesis_sorter ul,
.cesis_filter_style_4 .cesis_sorter,
.cesis_filter_style_5 .cesis_sorter,
.cesis_filter_style_6 .cesis_sorter,
.cesis_filter_style_7 .cesis_sorter,
.cesis_filter_style_4 .cesis_filter > li a,
.cesis_filter_style_5 .cesis_filter > li a,
.cesis_filter_style_6 .cesis_filter > li a,
.cesis_filter_style_7 .cesis_filter > li a,

.cesis_nav_style_0 span,
.cesis_nav_style_1 span,
.cesis_nav_style_3 span,

.cesis_blog_style_6 .inside_e,
.cesis_blog_style_7 .inside_e,
.cesis_blog_style_8 .inside_e,
.cesis_blog_style_15 .inside_e,

.cesis_portfolio_style_4 .inside_e,
.cesis_portfolio_style_5 .inside_e,
.cesis_portfolio_style_6 .inside_e,
.cesis_portfolio_style_12 .inside_e,
.cesis_portfolio_style_13 .inside_e,
.classic_container_boxed

<?php if( cesis_check_woo_status() == true) { ?>
,.select2-container--default .select2-selection,
.woocommerce-checkout #payment ul.payment_methods,
.cesis_product_thumbnail_container .cesis_add_to_cart a.button,
.cesis_product_thumbnail_container .added_to_cart,
.item_current_status,
.woocommerce div.product .woocommerce-tabs .panel
<?php } ?>


<?php if( cesis_check_bbp_status() == true) { ?>
,#bbpress-forums #new-post fieldset.bbp-form,
div.bbp-template-notice, div.indicator-hint,
#bbpress-forums ul.bbp-lead-topic,
#bbpress-forums ul.bbp-topics,
#bbpress-forums ul.bbp-forums,
#bbpress-forums ul.bbp-replies,
#bbpress-forums ul.bbp-search-results,
#bbp-search-form #bbp_search
<?php } ?>


<?php if( cesis_check_bp_status() == true) { ?>
,#buddypress .activity-list .activity-avatar,
div#item-nav,
#buddypress #item-body form#whats-new-form,
#buddypress ul.item-list li,
#buddypress .profile,
body.activity #buddypress #whats-new-form,
#buddypress div.item-list-tabs,
#buddypress table.notifications,
#buddypress table.notifications-settings,
#buddypress table.profile-settings,
#buddypress table.profile-fields,
#buddypress table.wp-profile-fields,
#buddypress table.messages-notices,
#buddypress table.forum,
#buddypress .messages-options-nav,
#buddypress .notifications-options-nav,
body.settings:not(.profile) #settings-form,
#group-settings-form,
#buddypress div#message p, #sitewide-notice p,
#buddypress div.bp-avatar-status p.success,
#buddypress div.bp-cover-image-status p.success,
#buddypress p.warning,
body.profile_page_bp-profile-edit.modal-open #buddypress #TB_ajaxContent p.warning,
body.users_page_bp-profile-edit.modal-open #buddypress #TB_ajaxContent p.warning,
#buddypress div#invite-list
<?php } ?>

{ background-color:<?php echo esc_attr($main_area_bg); ?>; }

.cesis_blog_style_6 .cesis_blog_gallery_packery span
{ box-shadow: inset 0 0 0 3px <?php echo esc_attr($main_area_bg); ?>; }

/* border */
fieldset,.site-main input[type="checkbox"],.site-main input[type="radio"],.site-main select,.site-main input[type="text"],.site-main input[type="email"],.site-main input[type="url"],.site-main input[type="password"],.site-main input[type="search"],.site-main input[type="number"],.site-main input[type="tel"],.site-main input[type="date"],.site-main textarea,

.site-main,.comments-layout-one .comment.depth-1,.comments-layout-one .pingback.depth-1,.comments-layout-one .comment_ctn,.comments-layout-one .comment_option_bar,.comments-layout-one input,.comments-layout-one textarea,.writer_navigation,.comments-layout-three,.comments-layout-three .comments-title,.comments-layout-three .comment_ctn,.comments-layout-three textarea, .comments-layout-three .single_post_author, .comments-layout-three .single_post_email, .comments-layout-three .single_post_url,
.boxes_container article,.boxes_container .author_bio_ctn,.boxes_container .writer_navigation,.boxes_container .entry-header .entry-meta,.writer_container .has_sidebar .author_bio_ctn,.business_container .author_bio_ctn,.business_navigation,.business_container article,.agency_navigation,.comments-layout-six .comment_ctn,.comments-layout-six,.comments-layout-six input,.comments-layout-six textarea,

.cesis_container:not(.business_container) .entry-footer .sp_categories_ctn a,
.cesis_container:not(.business_container) .entry-footer .sp_tags_ctn a,

.cesis_tabs.horizontal.cesis_tab_1 .tabs > li,
.cesis_tabs.horizontal.cesis_tab_1 .tabs > li:first-child,
.cesis_tabs.horizontal.cesis_tab_2 .tabs > li,
.cesis_tabs.horizontal.cesis_tab_2 .tabs > li:first-child,
.cesis_tabs.horizontal.cesis_tab_3 .tabs > li,
.cesis_tabs.horizontal.cesis_tab_3 .tabs > li:first-child,
.cesis_tabs.horizontal.cesis_tab_5 .tabs > li,
.cesis_tabs.horizontal.cesis_tab_5 .tabs > li:first-child,
.cesis_tabs.horizontal .tabs-container,
.cesis_tabs.horizontal.cesis_tab_4 .tabs,
.tab-holder.cesis_tabs.vertical.cesis_tab_1 .tabs-container,
.tab-holder.cesis_tabs.vertical.cesis_tab_1 .tabs,
.cesis_acc_3 .panel-title,
.cesis_acc_4 .panel-title,
.cesis_acc_5 .panel-title,
.cesis_acc_5.cesis_accordion .plus-minus-toggle,
.cesis_partners_ctn.cesis_partners_2 .owl-item,
.cesis_partners_2 .cesis_partners_col_ctn div,
.cesis_partners_2 .cesis_iso_item,
.cesis_blog_style_1 .cesis_blog_m_top_info .cesis_blog_m_author,
.cesis_blog_style_1 .inside_e,
.cesis_blog_style_3 .cesis_blog_m_top_info,
.cesis_blog_style_4 .cesis_blog_m_top_info,
.cesis_blog_style_6 .inside_e,
.cesis_blog_style_6 .cesis_blog_m_bottom_info,
.cesis_blog_style_7 .cesis_blog_m_content,
.cesis_blog_style_8 .cesis_blog_m_content,
.cesis_blog_style_15 .cesis_blog_m_content,
.cesis_sorter ul,
.cesis_filter_style_3 .cesis_filter,
.cesis_filter_style_4 .cesis_filter > li a,
.cesis_filter_style_4 .cesis_sorter,
.cesis_filter_style_5 .cesis_filter > li a,
.cesis_filter_style_5 .cesis_sorter,
.cesis_filter_style_6 .cesis_filter > li a,
.cesis_filter_style_6 .cesis_sorter,
.cesis_filter_style_7 .cesis_filter > li a,
.cesis_filter_style_7 .cesis_sorter,

.cesis_navigation_ctn.cesis_nav_style_0 span,
.cesis_navigation_ctn.cesis_nav_style_1 span,


.cesis_portfolio_style_1 .cesis_portfolio_m_bottom_info,
.cesis_portfolio_style_4 .inside_e,
.cesis_portfolio_style_4 .cesis_portfolio_m_bottom_info,
.cesis_portfolio_style_5 .cesis_portfolio_m_content,
.cesis_portfolio_style_6 .cesis_portfolio_m_content,
.cesis_portfolio_style_12 .inside_e,
.cesis_portfolio_style_13 .inside_e,

.cesis_staff_ctn:not(.cesis_staff_style_5):not(.cesis_staff_style_6):not(.cesis_staff_style_7) .cesis_staff_m_info,
.cesis_staff_style_3 .cesis_staff_m_content,.cesis_staff_style_4 .cesis_staff_m_content,

.boxes_container .entry-footer,
.agency_container .entry-footer,

.cesis_share_ctn.cesis_share_transparent span a,

.cesis_career_style_2 .cesis_career_m_content,

.cesis_search_style_2 .inside_e,

.comments-layout-eight .comment_ctn,
.classic_container .author_bio_ctn,
.classic_navigation,
.classic_container .entry-content,
.classic_navigation a:not(.main_posts_page_icon),
.comments-layout-eight textarea,
.comments-layout-eight .single_post_author input,
.comments-layout-eight .single_post_email input,
.comments-layout-eight .single_post_url input,
.classic_container_boxed,
.sidebar_layout_one .widget_categories .children


<?php if( cesis_check_woo_status() == true) { ?>
,.woocommerce .quantity .qty,
.woocommerce div.product .woocommerce-tabs ul.tabs::before,
section.related.products,
section.upsells.products,
.woocommerce table.shop_table td,
.woocommerce-cart table.cart td.actions .coupon .input-text,
.select2-container--default .select2-selection,
.woocommerce-checkout #payment ul.payment_methods,
.woocommerce-checkout #payment div.form-row,
.woocommerce table.shop_table.woocommerce-checkout-review-order-table,
.woocommerce table.shop_table tbody th, .woocommerce table.shop_table tfoot td,
.woocommerce table.shop_table tfoot th,
.woocommerce form.checkout_coupon, .woocommerce form.login, .woocommerce form.register,
.woocommerce table.shop_table.order_details,.woocommerce table.shop_table.customer_details,
.woocommerce-page .woocommerce ul.order_details li,
.woocommerce-page.woocommerce-account .woocommerce-MyAccount-navigation ul,
.woocommerce-account .woocommerce-MyAccount-navigation ul li,
.woocommerce .widget_price_filter .price_slider_wrapper .ui-widget-content,
.site-main .widget_product_categories li a,
.site-main .woocommerce ul.product_list_widget li.mini_cart_item,
.site-main ul.product_list_widget li.mini_cart_item,
.product_meta
<?php } ?>

<?php if( cesis_check_bbp_status() == true) { ?>
,#bbpress-forums fieldset.bbp-form,
#bbpress-forums li.bbp-body ul.forum,
#bbpress-forums li.bbp-body ul.topic,
#bbpress-forums ul.bbp-lead-topic,
#bbpress-forums ul.bbp-topics,
#bbpress-forums ul.bbp-forums,
#bbpress-forums ul.bbp-replies,
#bbpress-forums ul.bbp-search-results,
div.bbp-forum-header,
div.bbp-topic-header,
div.bbp-reply-header
<?php } ?>


<?php if( cesis_check_bp_status() == true) { ?>
,#buddypress div.activity-comments ul li,
#buddypress div.activity-comments ul,
.bp-avatar-nav ul,
.bp-avatar-nav ul.avatar-nav-items li.current,
#drag-drop-area,
#buddypress form fieldset,
div#item-nav,
#buddypress #item-body form#whats-new-form,
#buddypress ul.item-list li,
#buddypress div.activity-comments form .ac-textarea,
#buddypress .activity-meta,
#buddypress .profile,
body.activity #buddypress #whats-new-form,
#buddypress div.item-list-tabs,
#buddypress table.notifications,
#buddypress table.notifications-settings,
#buddypress table.profile-settings,
#buddypress table.profile-fields,
#buddypress table.wp-profile-fields,
#buddypress table.messages-notices,
#buddypress table.forum,
div.item-list-tabs#subnav ul li.last,
div.item-list-tabs#subnav  div.message-search form,
#buddypress .messages-options-nav,
#buddypress .notifications-options-nav,
#buddypress table.profile-settings,
body.settings:not(.profile) #settings-form,
#group-settings-form,
#buddypress div#invite-list
<?php } ?>

{ border-color:<?php echo esc_attr($main_area_border); ?>; }


.comments-layout-one .comment_ctn:after{ background:<?php echo esc_attr($main_area_border); ?>; }


.cesis_tabs.horizontal.cesis_tab_2 .tabs > li.active,
.cesis_tabs.horizontal.cesis_tab_3 .tabs > li.active

{ border-bottom-color:<?php echo esc_attr($main_area_bg); ?>!important; }


.cesis_tabs.vertical.cesis_tab_1.cesis_tab_left .tabs > li:after

{ background-image: -webkit-linear-gradient(left, transparent, <?php echo esc_attr($main_area_border); ?>);
    background-image: -moz-linear-gradient(left, transparent, <?php echo esc_attr($main_area_border); ?>);
    background-image: -o-linear-gradient(left, transparent, <?php echo esc_attr($main_area_border); ?>);

}

.cesis_tabs.vertical.cesis_tab_1.cesis_tab_right .tabs > li:after

{ background-image: -webkit-linear-gradient(right, transparent, <?php echo esc_attr($main_area_border); ?>);
    background-image: -moz-linear-gradient(right, transparent, <?php echo esc_attr($main_area_border); ?>);
    background-image: -o-linear-gradient(right, transparent, <?php echo esc_attr($main_area_border); ?>);

}





/* heading */

h1,h2,h3,h4,h5,h6,h1 a,h2 a,h3 a,h4 a,h5 a,h6 a,legend,.comments-layout-one .author,.comments-layout-one .author a,.writer_navigation a:hover,.comments-layout-three .author a,.comments-layout-three .comment-navigation .nav-previous a,.comments-layout-three .comment-navigation .nav-next a,.agency_navigation a,.agency_container .author_bio_ctn .author_posts_link,.comments-layout-six .author a,.comments-layout-seven .author a,.comments-layout-seven .comment_buttons a,
.cesis_tabs.horizontal.cesis_tab_1 .tabs > li a,
.cesis_tabs.horizontal.cesis_tab_3 .tabs > li:hover:not(.active) a,
.cesis_tabs.horizontal.cesis_tab_5 .tabs > li a,
.cesis_tabs.vertical.cesis_tab_2 .tabs > li.active a,

.cesis_acc_1 .panel-title.active a,
.cesis_acc_2 .panel-title.active a,
.cesis_acc_3 .panel-title a,
.cesis_acc_4 .panel-title a,
.cesis_acc_5 .panel-title a,
.cesis_m_more_link a:not(.cesis_btn):not(.cesis_alt_btn):not(.cesis_sub_btn),

.cesis_nav_style_2 span,
.cesis_nav_style_3 span,

.cesis_share_box.simple span a,
.cesis_share_ctn.cesis_share_transparent span a,
.comments-layout-eight .author,.comments-layout-eight .author a,
.classic_navigation a,
.site-main .comments-layout-eight textarea,
.site-main .comments-layout-eight .single_post_author,
.site-main .comments-layout-eight .single_post_email,
.site-main .comments-layout-eight .single_post_url,
.comments-layout-eight label

<?php if( cesis_check_woo_status() == true) { ?>
,.woocommerce .woocommerce-product-rating .star-rating,
.woocommerce div.product form.cart .reset_variations,
.meta_container .meta_label,
.woocommerce #reviews #comments ol.commentlist li .comment-text .woocommerce-review__author,
.woocommerce div.product form.cart .variations label,
.woocommerce table.shop_attributes th,
.woocommerce div.product form.cart .group_table td.label a,
.woocommerce-thankyou-order-received,
.woocommerce-checkout .woocommerce-form-login a,
.woocommerce-lost-password .lost_reset_password p:first-child,
.woocommerce-account .woocommerce-MyAccount-navigation ul li a,
.woocommerce-account .woocommerce-MyAccount-content a,
p.woocommerce-LostPassword.lost_password a,
.cesis_product_thumbnail_container .cesis_add_to_cart a.button,
.cesis_product_thumbnail_container .added_to_cart,
.item_current_status,
.woocommerce-error a.button,
.woocommerce-info a.button,
.woocommerce-message a.button,
.woocommerce-grouped-product-list-item__label a

<?php } ?>

<?php if( cesis_check_bbp_status() == true) { ?>
,#cesis_main a.bbp-forum-title,
#cesis_main #bbpress-forums li.bbp-header ul,
#cesis_main a.bbp-topic-permalink,
#cesis_main .bbp-template-notice a.bbp-author-name,
#cesis_main #bbpress-forums div.bbp-reply-author a.bbp-author-name,
#cesis_main #bbpress-forums #bbp-single-user-details #bbp-user-navigation a,
#cesis_main .bbp-topic-title-meta a,
#cesis_main #bbpress-forums div.bbp-topic-author a.bbp-author-name,
#cesis_main #bbpress-forums div.bbp-reply-author a.bbp-author-name
<?php } ?>


<?php if( cesis_check_bp_status() == true) { ?>
,#buddypress a:not(.button):not(.add):not(.remove):not(.requested):not(.group-button),
#buddypress .standard-form label, #buddypress .standard-form span.label,
div#item-nav div.item-list-tabs ul li.selected a,
div#item-nav div.item-list-tabs ul li.current a,
#item-nav div.item-list-tabs ul li a:hover,
#buddypress div.activity-meta a:hover,
#buddypress .activity-comments .acomment-options a:hover

<?php } ?>

{ color:<?php echo esc_attr($main_area_heading); ?>; }

.cesis_acc_1 .panel-title.active .plus-minus-toggle:after,.cesis_acc_1 .panel-title.active .plus-minus-toggle:before,
.cesis_acc_2 .panel-title.active .plus-minus-toggle:after,.cesis_acc_2 .panel-title.active .plus-minus-toggle:before


{ background:<?php echo esc_attr($main_area_heading); ?>; }


/* text color */

body,
.site-main input[type="checkbox"],.site-main input[type="radio"],.site-main select,.site-main input[type="text"],
.site-main input[type="email"],.site-main input[type="url"],.site-main input[type="password"],.site-main input[type="search"],
.site-main input[type="number"],.site-main input[type="tel"],.site-main input[type="date"],.site-main textarea,
.writer_navigation a,.comments-layout-three .comment_buttons span,.comments-layout-three .comment_buttons a,
.comments-layout-three .to_comment_button,.boxes_container .author_bio_ctn .author_posts_link,
.boxes_container .entry-meta .single_post_title_author a,.boxes_container .entry-meta .single_post_title_comment a,
.writer_container .author_bio_ctn .author_posts_link,.comments-layout-one input, .comments-layout-one textarea,
.comments-layout-seven .date a,.comments-layout-seven .comment_ctn,.cesis_tabs.horizontal.cesis_tab_3 .tabs > li a,
.cesis_tabs.horizontal.cesis_tab_4 .tabs > li:hover:not(.active) a,.cesis_tabs.vertical.cesis_tab_2 .tabs > li:hover:not(.active) a,
.cesis_filter li a,.cesis_nav_style_4 .cesis_nav_active.cesis_nav_number:after,.cesis_nav_style_4 .cesis_nav_number:hover::after,
.cesis_staff_sp_info .cesis_staff_social a,
.cesis_nav_number a,
.cesis_nav_prev a,
.cesis_nav_next a,
.cesis_share_ctn.cesis_share_grey span a,
.cesis_link_ctn a,
.sp_info_ctn a


<?php if( cesis_check_woo_status() == true) { ?>
,.meta_container a,.woocommerce p.stars.selected a,
.woocommerce table.shop_table td,
.woocommerce table.shop_table td a,
table.shop_table span.woocommerce-Price-amount.amount,
.select2-container--default .select2-selection--single .select2-selection__rendered,
.woocommerce-error a, .woocommerce-info a, .woocommerce-message a,
.about_paypal,
.products span.woocommerce-Price-amount.amount,
.woocommerce div.product span.price del,
.woocommerce .products li.product span.price,
.woocommerce-product-search label:after,
.woocommerce a.remove:after
<?php } ?>

<?php if( cesis_check_bbp_status() == true) { ?>
,li.bbp-forum-freshness a,
li.bbp-topic-freshness a,
div.bbp-breadcrumb a,
.bbp-template-notice a,
#subscription-toggle a,
#bbpress-forums div.bbp-topic-content a,
#bbpress-forums div.bbp-reply-content a,
.bbp-pagination-links a
<?php } ?>


<?php if( cesis_check_bp_status() == true) { ?>
,#item-nav div.item-list-tabs ul li a,
#buddypress .activity-comments .acomment-options a
<?php } ?>

{ color:<?php echo esc_attr($main_area_color); ?>; }

.site-main textarea::-webkit-input-placeholder,.site-main input::-webkit-input-placeholder

{ color:<?php echo esc_attr($main_area_color); ?>; }

.main_posts_page_icon:before,.main_posts_page_icon:after


{ background:<?php echo esc_attr($main_area_color); ?>; }





/* light text color */

.cesis_not_found_sub,.comments-layout-one .date a,.comments-layout-three .date a,.comments-layout-one a.comments-link,.comments-layout-one #reply-title,.agency_container .author_bio_ctn h4,.comments-layout-three textarea, .comments-layout-three .single_post_author, .comments-layout-three .single_post_email, .comments-layout-three .single_post_url,.comments-layout-six .date a,.comments-layout-six input,.comments-layout-six textarea,
.cesis_tabs.horizontal.cesis_tab_2 .tabs > li a,.cesis_tabs.horizontal.cesis_tab_4 .tabs > li a,.cesis_tabs.vertical.cesis_tab_2 .tabs > li a,
.cesis_blog_m_bt_info,
.cesis_blog_m_bt_info a,
.cesis_blog_m_top_info,
.cesis_blog_m_top_info a,
.cesis_blog_m_bottom_info,
.cesis_blog_m_bottom_info a,
.cesis_portfolio_m_top_info,
.cesis_portfolio_m_top_info a,
.cesis_portfolio_m_bottom_info,
.cesis_portfolio_m_bottom_info a,


.cesis_container:not(.business_container) .entry-footer .sp_categories_ctn a,
.cesis_container:not(.business_container) .entry-footer .sp_tags_ctn a,

.cesis_staff_ctn .cesis_staff_m_content .cesis_staff_social a,

.cesis_staff_sp_info .cesis_staff_sp_position,

.agency_container .share_ctn h3,
.cesis_search_result_type,
.comments-layout-eight .date a,
.comments-layout-eight .comment_buttons .reply a,
.comments-layout-eight .comment_buttons .edit a,
.cesis_portfolio_m_bt_info a

<?php if( cesis_check_woo_status() == true) { ?>
,.cesis_widget span.woocommerce-Price-amount.amount
<?php } ?>


<?php if( cesis_check_bbp_status() == true) { ?>
,.bbp-pagination-links span.current
<?php } ?>

<?php if( cesis_check_bp_status() == true) { ?>
,#buddypress a.activity-time-since,
#buddypress .time-since,
#buddypress div.activity-meta a,
#buddypress .activity-comments .acomment-options a
<?php } ?>


{ color:<?php echo esc_attr($main_area_light_color); ?>; }

.comments-layout-six input::-webkit-input-placeholder,.comments-layout-six textarea::-webkit-input-placeholder

{ color:<?php echo esc_attr($main_area_light_color); ?>; }


.cesis_acc_3 .panel-title .plus-minus-toggle:after,.cesis_acc_3 .panel-title .plus-minus-toggle:before,
.cesis_acc_4 .panel-title .plus-minus-toggle:after,.cesis_acc_4 .panel-title .plus-minus-toggle:before,
.cesis_acc_5 .panel-title .plus-minus-toggle:after,.cesis_acc_5 .panel-title .plus-minus-toggle:before

{ background:<?php echo esc_attr($main_area_light_color); ?>; }


/* accent color one */

a,.site-main input[type="checkbox"]:checked:before,.comments-layout-one .author a:hover,.comments-layout-one .date a:hover,.sidebar_layout_one .widget_archive li:before, .sidebar_layout_one .widget_meta li:before, .sidebar_layout_one .widget_categories li:before, .sidebar_layout_one .widget_pages li a:before, .sidebar_layout_one .widget_recent_comments li:before, .sidebar_layout_one .widget_recent_entries li:before,.boxes_container .entry-meta .single_post_title_author a:hover,.boxes_container .entry-meta .single_post_title_comment a:hover,.comments-layout-three .comment-navigation .nav-previous a:hover,.comments-layout-three .comment-navigation .nav-next a:hover,.comments-layout-two .author a:hover,.comments-layout-three .comment_buttons span:hover,.comments-layout-three .comment_buttons span:hover a,.comments-layout-three .author a:hover,.comments-layout-six .author a:hover,.comments-layout-six .date a:hover,.comments-layout-six .comment_buttons,.comments-layout-six .comment_buttons a,.careers_container .author_bio_ctn .author-info h3 a:hover,.comments-layout-seven .author a:hover,.comments-layout-seven .comment_buttons a:hover,.comments-layout-seven .date a:hover,.lifestyle_container .author_bio_ctn .author-info h3 a:hover,
.cesis_tabs.horizontal.cesis_tab_2 .tabs > li.active a,
.cesis_tabs.horizontal.cesis_tab_3 .tabs > li.active a,
.cesis_tabs.horizontal.cesis_tab_4 .tabs > li.active a,
.cesis_acc_3 .panel-title.active a,
.cesis_acc_4 .panel-title.active a,
.cesis_acc_5 .panel-title.active a,
.cesis_blog_m_title a:hover,
.cesis_blog_m_bt_info a:hover,
.cesis_blog_m_top_info a:hover,
.cesis_blog_m_bottom_info a:hover,
.cesis_portfolio_m_title a:hover,
.cesis_portfolio_m_top_info a:hover,
.cesis_portfolio_m_bottom_info a:hover,
.cesis_m_more_link a:not(.cesis_btn):not(.cesis_alt_btn):not(.cesis_sub_btn):hover,
.cesis_filter_style_1 .cesis_filter li.selected a,.cesis_filter_style_1 .cesis_filter li a:hover,
.cesis_filter_style_1 .cesis_sorter li:hover,.cesis_filter_style_1 .sort_selected,
.cesis_filter_style_2 .cesis_filter li.selected a,.cesis_filter_style_2 .cesis_filter li a:hover,
.cesis_filter_style_2 .cesis_sorter li:hover,.cesis_filter_style_2 .sort_selected,
.cesis_filter_style_3 .cesis_filter li.selected a,.cesis_filter_style_3 .cesis_filter li a:hover,
.cesis_filter_style_3 .cesis_sorter li:hover,.cesis_filter_style_3 .sort_selected,
.cesis_filter_style_4 .cesis_filter li a:hover,
.cesis_filter_style_4 .cesis_sorter li:hover,
.cesis_filter_style_5 .cesis_filter li a:hover,
.cesis_filter_style_5 .cesis_sorter li:hover,
.cesis_filter_style_6 .cesis_filter li a:hover,
.cesis_filter_style_6 .cesis_sorter li:hover,
.cesis_filter_style_7 .cesis_filter li a:hover,
.cesis_filter_style_7 .cesis_sorter li:hover,

.cesis_nav_style_4 span:hover,.cesis_nav_style_4 span.cesis_nav_active,
.cesis_nav_style_4 .current,.cesis_nav_style_4 span:hover a,


.cesis_staff_sp_info .cesis_staff_social a:hover,
.cesis_share_ctn.cesis_share_grey.cesis_share_io span a:hover,
.cesis_share_ctn.cesis_share_transparent.cesis_share_io span a:hover,

.cesis_search_results_text strong,

.comments-layout-eight .date a:hover,
.comments-layout-eight .comment_buttons .reply a:hover,
.comments-layout-eight .comment_buttons .edit a:hover,
.comments-layout-eight .author:hover,
.comments-layout-eight .author a:hover,
.classic_container .author_bio_ctn .author-info a:hover,
.sp_info_ctn a:hover,
.classic_navigation .main_posts_page_icon:hover

<?php if( cesis_check_woo_status() == true) { ?>
,.woocommerce div.product p.price, .woocommerce div.product span.price,
.meta_container a:hover,
.woocommerce div.product form.cart .reset_variations:hover,
.woocommerce div.product form.cart .group_table td.label a:hover,
span.woocommerce-Price-amount.amount,
.woocommerce table.shop_table td a:hover,
.woocommerce-account .woocommerce-MyAccount-navigation ul li a:hover,
.woocommerce-account .woocommerce-MyAccount-content a:hover,
p.woocommerce-LostPassword.lost_password a:hover,
.site-main .woocommerce a.remove:hover:after
<?php } ?>


<?php if( cesis_check_bbp_status() == true) { ?>
,a.bbp-forum-title:hover,
li.bbp-forum-freshness a:hover,
a.bbp-topic-permalink:hover,
li.bbp-topic-freshness a:hover,
div.bbp-breadcrumb a:hover,
.bbp-template-notice a:hover,
#subscription-toggle a:hover,
#bbpress-forums div.bbp-reply-author a.bbp-author-name:hover,
#bbpress-forums div.bbp-topic-content a:hover,
#bbpress-forums div.bbp-reply-content a:hover,
.bbp-pagination-links a:hover,
.bbp-template-notice a.bbp-author-name:hover,
#bbpress-forums #bbp-single-user-details #bbp-user-navigation a:hover,
#bbpress-forums #bbp-single-user-details #bbp-user-navigation li.current a,
.bbp-topic-title-meta a:hover,
#bbpress-forums div.bbp-topic-author a.bbp-author-name:hover,
#bbpress-forums div.bbp-reply-author a.bbp-author-name:hover
<?php } ?>

<?php if( cesis_check_bp_status() == true) { ?>
,#buddypress a:not(.button):not(.add):not(.remove):not(.requested):not(.group-button):hover
<?php } ?>

{ color:<?php echo esc_attr($main_area_one_acolor); ?>; }
.tg-cesis-coffee-products .tg-element-3.tg-item-rating .star-rating span:before
{ color:<?php echo esc_attr($main_area_one_acolor); ?> !important; }

.site-main input[type=radio]:checked:before,.comments-layout-three .comments-title span:before,.writer_container .author_bio_ctn .author-info h3:after,.boxes_container .author_bio_ctn .author-info h3:after,.agency_container .author_bio_ctn .author-info h3:after,.comments-layout-seven .author:after,.lifestyle_container .author_bio_ctn .author-info h3:after,
.cesis_tabs.horizontal.cesis_tab_1 .tabs > li.active,
.cesis_tabs.horizontal.cesis_tab_2 .tabs > li.active:before,
.cesis_tabs.horizontal.cesis_tab_5 .tabs > li.active,
.cesis_tabs.cesis_tab_4 .tab_moving_line,
.cesis_tabs.vertical.cesis_tab_2 .tabs > li a:after,
.cesis_acc_3 .panel-title.active .plus-minus-toggle:after,.cesis_acc_3 .panel-title.active .plus-minus-toggle:before,
.cesis_acc_4 .panel-title.active .plus-minus-toggle:after,.cesis_acc_4 .panel-title.active .plus-minus-toggle:before,
.cesis_acc_5 .panel-title.active .plus-minus-toggle:after,.cesis_acc_5 .panel-title.active .plus-minus-toggle:before,
.cesis_audio_ctn .mejs-controls .mejs-time-rail .mejs-time-handle,
.cesis_container .mejs-controls .mejs-time-rail .mejs-time-current,
.cesis_container .mejs-controls .mejs-horizontal-volume-slider .mejs-horizontal-volume-current,
.filter_moving_line,
.cesis_filter_style_4 .cesis_filter > li.selected a,
.cesis_filter_style_4 .sort_selected,
.cesis_filter_style_5 .cesis_filter > li.selected a,
.cesis_filter_style_5 .sort_selected,
.cesis_filter_style_6 .cesis_filter > li.selected a,
.cesis_filter_style_6 .sort_selected,
.cesis_filter_style_7 .cesis_filter > li.selected a,
.cesis_filter_style_7 .sort_selected,
.cesis_nav_style_0 > span:hover,.cesis_nav_style_0 .cesis_nav_numbers > span:hover,.cesis_nav_style_0 span.cesis_nav_active,.cesis_nav_style_0 .cesis_nav_number .current,
.cesis_nav_style_1 > span:hover,.cesis_nav_style_1 .cesis_nav_numbers > span:hover,.cesis_nav_style_1 span.cesis_nav_active,.cesis_nav_style_1 .cesis_nav_number .current,
.cesis_nav_style_2 > span:hover,.cesis_nav_style_2 .cesis_nav_numbers > span:hover,.cesis_nav_style_2 span.cesis_nav_active,.cesis_nav_style_2 .cesis_nav_number .current,
.cesis_nav_style_3 > span:hover,.cesis_nav_style_3 .cesis_nav_numbers > span:hover,.cesis_nav_style_3 span.cesis_nav_active,.cesis_nav_style_3 .cesis_nav_number .current,

.cesis_share_box.grey span a:hover,
.cesis_share_ctn.cesis_share_grey:not(.cesis_share_io) span a:hover,
.cesis_share_ctn.cesis_share_transparent:not(.cesis_share_io) span a:hover,
.cesis_quote_icon,
.cesis_link_icon,
.cesis_container:not(.business_container) .entry-footer .sp_categories_ctn a:hover,
.cesis_container:not(.business_container) .entry-footer .sp_tags_ctn a:hover,
.classic_navigation a:not(.main_posts_page_icon):hover


<?php if( cesis_check_woo_status() == true) { ?>
,.wc-tabs .tab_moving_line,
.article_ctn span.onsale,
.woocommerce li.product span.onsale,
.woocommerce .widget_price_filter .ui-slider .ui-slider-range
<?php } ?>

<?php if( cesis_check_bp_status() == true) { ?>
,div.item-list-tabs ul li a span,
#buddypress a.bp-primary-action span,
#buddypress #reply-title small a span
<?php } ?>

{ background:<?php echo esc_attr($main_area_one_acolor); ?>; }


::selection{ background:<?php echo esc_attr($main_area_one_acolor); ?>; color:white; }


input[type="text"]:focus, input[type="email"]:focus, input[type="url"]:focus,
input[type="password"]:focus, input[type="search"]:focus, input[type="number"]:focus,
input[type="tel"]:focus,input[type="date"]:focus, textarea:focus,
.cesis_filter_style_4 .cesis_filter > li.selected a,
.cesis_filter_style_5 .cesis_filter > li.selected a,
.cesis_filter_style_6 .cesis_filter > li.selected a,
.cesis_filter_style_7 .cesis_filter > li.selected a,

.cesis_nav_style_1 > span:hover,.cesis_nav_style_1 .cesis_nav_numbers > span:hover,.cesis_nav_style_1 span.cesis_nav_active,
.cesis_nav_style_2 > span:hover,.cesis_nav_style_2 .cesis_nav_numbers > span:hover,.cesis_nav_style_2 span.cesis_nav_active,
.cesis_nav_style_3 > span:hover,.cesis_nav_style_3 .cesis_nav_numbers > span:hover,.cesis_nav_style_3 span.cesis_nav_active,

blockquote,.cesis_quote_ctn,
.classic_navigation a:not(.main_posts_page_icon):hover



<?php if( cesis_check_bp_status() == true) { ?>
,div#subnav.item-list-tabs ul li.selected a,
div#subnav.item-list-tabs ul li.current a
<?php } ?>

{ border-color:<?php echo esc_attr($main_area_one_acolor); ?> !important; }



/* accent color two */

a:hover,.comments-layout-six .comment_buttons span:hover,.comments-layout-six .comment_buttons span:hover a
{ color:<?php echo esc_attr($main_area_two_acolor); ?>; }





/* alternative background */

.comments-layout-one .comment_option_bar,.writer_comments_ctn,.agency_comments_ctn,.lifestyle_comments_ctn,

.cesis_acc_1 .panel-title,.cesis_acc_2 .panel-title,


.cesis_nav_style_2 .cesis_nav_prev,.cesis_nav_style_2 .cesis_nav_next,
#cesis_main .quicktags-toolbar,

.cesis_share_box.grey span a,
.cesis_share_ctn.cesis_share_grey:not(.cesis_share_io) span a

<?php if( cesis_check_woo_status() == true) { ?>
,
.woocommerce-checkout #payment div.payment_box,
.woocommerce-checkout #payment div.form-row,
.woocommerce .widget_price_filter .ui-slider .ui-slider-handle
<?php } ?>

<?php if( cesis_check_bbp_status() == true) { ?>
,div.bbp-forum-header, div.bbp-topic-header, div.bbp-reply-header
<?php if($cesis_data["cesis_bbpress_bg_style"] == 'yes'){ ?>
,body.bbpress #cesis_main
<?php } } ?>


<?php if( cesis_check_bp_status() == true) { ?>
,#buddypress table.notifications thead tr, #buddypress table.notifications-settings thead tr,
#buddypress table.profile-settings thead tr, #buddypress table.profile-fields thead tr,
#buddypress table.wp-profile-fields thead tr, #buddypress table.messages-notices thead tr,
#buddypress table.forum thead tr
<?php if($cesis_data["cesis_buddypress_bg_style"] == 'yes'){ ?>
,body.buddypress #cesis_main
<?php } } ?>

{ background:<?php echo esc_attr($main_area_alt_bg); ?>; }

<?php if( cesis_check_woo_status() == true) { ?>
.woocommerce-page .cart-collaterals .cart_totals,
#add_payment_method #payment div.payment_box:before, .woocommerce-cart #payment div.payment_box:before, .woocommerce-checkout #payment div.payment_box:before,
.woocommerce .widget_price_filter .ui-slider .ui-slider-handle
{ border-color:<?php echo esc_attr($main_area_alt_bg); ?>; }
<?php } ?>


/* alternative border */

.comments-layout-two .comment_ctn,.comments-layout-two textarea,.comments-layout-two .single_post_author, .comments-layout-two .single_post_email, .comments-layout-two .single_post_url,.comments-layout-four .comment_ctn,.comments-layout-four textarea,

.cesis_acc_1 .panel-title,
.cesis_acc_1 .panel-collapse,
.cesis_acc_2 .panel-title,

.cesis_nav_style_2 .cesis_nav_prev,.cesis_nav_style_2 .cesis_nav_next,

#cesis_main .quicktags-toolbar,


.cesis_share_box.grey span a,
.cesis_share_ctn.cesis_share_grey:not(.cesis_share_io) span a


 { border-color:<?php echo esc_attr($main_area_alt_border); ?>; }





/* alternative heading */

.comments-layout-two .author a,.comments-layout-two .to_comment_button:hover,.comments-layout-two .comment-navigation a:hover,.comments-layout-two .logged-in-as a,.writer_comments_ctn .comments-title a, .writer_comments_ctn #reply-title,.comments-layout-four .author a,.comments-layout-four .comment_buttons a,.comments-layout-four .comment-navigation a,.comments-layout-four .logged-in-as a,.agency_comments_ctn .comments-title a, .agency_comments_ctn #reply-title,.comments-layout-seven .comments-title a, .comments-layout-seven #reply-title



{ color:<?php echo esc_attr($main_area_alt_heading); ?>; }





/* alternative text */

.writer_comments_ctn,.agency_comments_ctn,.lifestyle_comments_ctn,.comments-layout-seven input,.comments-layout-seven textarea,

.cesis_share_box.grey span a,
.cesis_share_ctn.cesis_share_grey:not(.cesis_share_io) span a

<?php if( cesis_check_woo_status() == true) { ?>
,.woocommerce-checkout #payment div.payment_box
<?php } ?>

<?php if( cesis_check_bbp_status() == true) { ?>
,div.bbp-forum-header, div.bbp-topic-header, div.bbp-reply-header,
span.bbp-admin-links a,
.bbp-forum-header a.bbp-forum-permalink, .bbp-topic-header a.bbp-topic-permalink, .bbp-reply-header a.bbp-reply-permalink
<?php } ?>


{ color:<?php echo esc_attr($main_area_alt_color); ?>; }






/* alternative light text color */

.comments-layout-one .comment_option_bar a,.comments-layout-two .comment-navigation a,.comments-layout-one .comment_option_bar .reply:before,.comments-layout-one .comment_buttons .edit:before,.comments-layout-two .date a,.comments-layout-two .comment_buttons .reply a,.comments-layout-two .comment_buttons .edit a,.comments-layout-two .comment_buttons .edit:before,.comments-layout-two .comment_buttons .reply:before,.comments-layout-two .to_comment_button,.comments-layout-four .date a,.comments-layout-two textarea,.comments-layout-two .single_post_author, .comments-layout-two .single_post_email, .comments-layout-two .single_post_url,.comments-layout-four .single_post_author, .comments-layout-four .single_post_email, .comments-layout-four .single_post_url,.comments-layout-four textarea,.comments-layout-seven .logged-in-as a,

.cesis_acc_1 .panel-title a,
.cesis_acc_2 .panel-title a

{ color:<?php echo esc_attr($main_area_alt_light_color); ?>; }


.comments-layout-two textarea::-webkit-input-placeholder,.comments-layout-two input::-webkit-input-placeholder,
.comments-layout-four textarea::-webkit-input-placeholder,.comments-layout-four input::-webkit-input-placeholder,
.comments-layout-seven input::-webkit-input-placeholder,.comments-layout-seven textarea::-webkit-input-placeholder

{ color:<?php echo esc_attr($main_area_alt_light_color); ?>; }


.cesis_acc_1 .panel-title .plus-minus-toggle:after,.cesis_acc_1 .panel-title .plus-minus-toggle:before,
.cesis_acc_2 .panel-title .plus-minus-toggle:after,.cesis_acc_2 .panel-title .plus-minus-toggle:before

{ background:<?php echo esc_attr($main_area_alt_light_color); ?>; }

/* alternative accent color */

.comments-layout-one .comment_option_bar .reply:hover a,.comments-layout-one .comment_option_bar .reply:hover::before,
.comments-layout-one .comment_option_bar .edit:hover a,.comments-layout-one .comment_option_bar .edit:hover::before,
.comments-layout-two .comment_buttons .reply:hover a,.comments-layout-two .comment_buttons .reply:hover::before,
.comments-layout-two .comment_buttons .edit:hover a,.comments-layout-two .comment_buttons .edit:hover::before,
.comments-layout-two .author a:hover,.comments-layout-two .logged-in-as a:hover,
.comments-layout-four .author a:hover,.comments-layout-four .logged-in-as a:hover,.comments-layout-four .comment_buttons a:hover,.comments-layout-four .comment-navigation a:hover,.comments-layout-seven .logged-in-as a:hover
{ color:<?php echo esc_attr($main_area_alt_one_acolor); ?>; }

.comments-layout-two .comments-title span:before,.comments-layout-four .date:after


{ background:<?php echo esc_attr($main_area_alt_one_acolor); ?>; }




/* buttons settings */

.comments-layout-one input[type="submit"].cesis_btn,.cesis_btn,.comments-layout-three input[type="submit"].cesis_btn,
.boxes_container .category_ctn a,.comments-layout-six input[type="submit"].cesis_btn,.comments-layout-seven input[type="submit"].cesis_btn,
.comments-layout-seven .comment-navigation .nav-previous a, .comments-layout-seven .comment-navigation .nav-next a,.lifestyle_container .to_comments_button,
.cesis_cf7_btn input[type="submit"],.post-password-form input[type="submit"]


<?php if( cesis_check_woo_status() == true) { ?>
,.woocommerce button.button.alt,
.woocommerce #review_form #respond .form-submit input,
.woocommerce-cart .wc-proceed-to-checkout a.checkout-button,
.woocommerce #payment #place_order, .woocommerce-page #payment #place_order,
.site-main .woocommerce.widget_shopping_cart .buttons a:last-child,
.cesis_cart_icon a.button,
.woocommerce.single-product a.button.alt
<?php } ?>


<?php if( cesis_check_bbp_status() == true) { ?>
,.bbp-submit-wrapper button,
#bbpress-forums #bbp-your-profile fieldset.submit button
<?php } ?>

<?php if( cesis_check_bp_status() == true) { ?>
, .generic-button .friendship-button.add,
 .standard-form button,
 #buddypress a.button:not(.acomment-reply):not(.view):not(.fav):not(.delete-activity):not(.unfav):not(.delete-activity-single),
 input[type=submit],
 input[type=button],
 input[type=reset],
 #buddypress ul.button-nav li a,
 .generic-button a,
 #buddypress .comment-reply-link,
a.bp-title-button
<?php } ?>



{color:<?php echo esc_attr($main_button_text); ?>; background:<?php echo esc_attr($main_button_bg); ?>; border-color:<?php echo esc_attr($main_button_border); ?>;  font-family:<?php echo esc_attr($main_button_font); ?>; font-size:<?php echo esc_attr($main_button_size); ?>; font-weight:<?php echo esc_attr($main_button_weight); ?>; text-transform:<?php echo esc_attr($main_button_tt); ?>; letter-spacing:<?php echo esc_attr($main_button_ls); ?>;  }

.comments-layout-one input[type="submit"].cesis_btn:hover,.cesis_btn:hover,.comments-layout-three input[type="submit"].cesis_btn:hover,
.boxes_container .category_ctn a:hover,.comments-layout-six input[type="submit"].cesis_btn:hover,.comments-layout-seven input[type="submit"].cesis_btn:hover,
.comments-layout-seven .comment-navigation .nav-previous a:hover, .comments-layout-seven .comment-navigation .nav-next a:hover,.lifestyle_container .to_comments_button:hover,
.cesis_cf7_btn input[type="submit"]:hover


<?php if( cesis_check_woo_status() == true) { ?>
,.woocommerce button.button.alt:hover,
.woocommerce #review_form #respond .form-submit input:hover,
.woocommerce-cart .wc-proceed-to-checkout a.checkout-button:hover,
.woocommerce #payment #place_order:hover, .woocommerce-page #payment #place_order:hover,
.site-main .woocommerce.widget_shopping_cart .buttons a:last-child:hover,
.cesis_cart_icon .buttons a.button:last-child:hover,
.woocommerce.single-product a.button.alt:hover
<?php } ?>

<?php if( cesis_check_bbp_status() == true) { ?>
,.bbp-submit-wrapper button:hover,
#bbpress-forums #bbp-your-profile fieldset.submit button:hover
<?php } ?>


<?php if( cesis_check_bp_status() == true) { ?>
, .generic-button .friendship-button.add:hover,
 .standard-form button:hover,
 #buddypress a.button:hover,
 #buddypress a.button:focus,
 input[type=submit]:hover,
 input[type=button]:hover,
 input[type=reset]:hover,
 #buddypress ul.button-nav li a:hover,
 #buddypress  ul.button-nav li.current a,
 div.generic-button a:hover,
 #buddypress .comment-reply-link:hover
<?php } ?>

{ color:<?php echo esc_attr($main_button_hover_text); ?>; background:<?php echo esc_attr($main_button_hover_bg); ?>; border-color:<?php echo esc_attr($main_button_hover_border); ?>;}

<?php if ($main_button_shadow == "yes" ) { ?>
.cesis_btn {
	-webkit-box-shadow: 0 0 20px rgba(46,47,57,.25);
	-moz-box-shadow: 0 0 20px rgba(46,47,57,.25);
	box-shadow: 0 0 20px rgba(46,47,57,.25);
}
<?php } ?>

.cesis_alt_btn,.comments-layout-one .comment-navigation .nav-previous a,.comments-layout-one .comment-navigation .nav-next a,
.business_navigation .nav-previous a,.business_navigation .nav-next a,.comments-layout-six .comment-navigation .nav-previous a,
.comments-layout-six .comment-navigation .nav-next a,.careers_navigation a,
.cesis_cf7_alt_btn input[type="submit"]

<?php if( cesis_check_woo_status() == true) { ?>
,.woocommerce input.button,
.woocommerce .cart .button, .woocommerce .cart input.button,
section.shipping-calculator-form button.button,
p.return-to-shop .wc-backward,
.woocommerce form.checkout_coupon input.button,
.woocommerce-checkout .woocommerce-form-login input[type="submit"],
.woocommerce-lost-password .woocommerce form .form-row input[type="submit"],
.woocommerce .woocommerce-MyAccount-content table.my_account_orders .button,
.woocommerce .woocommerce-MyAccount-content input.button,
.woocommerce .order-again .button,
.woocommerce .widget_price_filter .price_slider_amount .button,
.site-main .woocommerce.widget_shopping_cart .buttons a:first-child

<?php } ?>


<?php if( cesis_check_bp_status() == true) { ?>
,.generic-button .friendship-button.remove,
#profile-edit-form.standard-form button,
.generic-button .leave-group
<?php } ?>

{color:<?php echo esc_attr($main_alt_button_text); ?>; background:<?php echo esc_attr($main_alt_button_bg); ?>; border-color:<?php echo esc_attr($main_alt_button_border); ?>;  font-family:<?php echo esc_attr($main_alt_button_font); ?>; font-size:<?php echo esc_attr($main_alt_button_size); ?>; font-weight:<?php echo esc_attr($main_alt_button_weight); ?>; text-transform:<?php echo esc_attr($main_alt_button_tt); ?>; letter-spacing:<?php echo esc_attr($main_alt_button_ls); ?>;}

.cesis_alt_btn:hover,.comments-layout-one .comment-navigation .nav-previous a:hover,.comments-layout-one .comment-navigation .nav-next a:hover,.business_navigation .nav-previous a:hover,.business_navigation .nav-next a:hover,
.comments-layout-two input[type="submit"].cesis_sub_btn:hover,.comments-layout-six .comment-navigation .nav-previous a:hover, .comments-layout-six .comment-navigation .nav-next a:hover,.careers_navigation a:hover,
.cesis_cf7_alt_btn input[type="submit"]:hover

<?php if( cesis_check_woo_status() == true) { ?>
,.woocommerce input.button:hover,.woocommerce .cart .button:hover
, .woocommerce .cart input.button:hover,
section.shipping-calculator-form button.button:hover,
p.return-to-shop .wc-backward:hover,
.woocommerce form.checkout_coupon input.button:hover,
.woocommerce-checkout .woocommerce-form-login input[type="submit"]:hover,
.woocommerce-lost-password .woocommerce form .form-row input[type="submit"]:hover,
.woocommerce .woocommerce-MyAccount-content table.my_account_orders .button:hover,
.woocommerce .woocommerce-MyAccount-content input.button:hover,
.woocommerce .order-again .button:hover,
.woocommerce .widget_price_filter .price_slider_amount .button:hover,
.site-main .woocommerce.widget_shopping_cart .buttons a:first-child:hover

<?php } ?>


<?php if( cesis_check_bp_status() == true) { ?>
,.generic-button .friendship-button.remove:hover,
#profile-edit-form.standard-form button:hover,
.generic-button .leave-group:hover
<?php } ?>

{ color:<?php echo esc_attr($main_alt_button_hover_text); ?>; background:<?php echo esc_attr($main_alt_button_hover_bg); ?>; border-color: <?php echo esc_attr($main_alt_button_hover_border); ?>;}
<?php if ($main_alt_button_shadow == "yes" ) { ?>
.cesis_alt_btn {
	-webkit-box-shadow: 0 0 20px rgba(46,47,57,.25);
	-moz-box-shadow: 0 0 20px rgba(46,47,57,.25);
	box-shadow: 0 0 20px rgba(46,47,57,.25);
}
<?php } ?>

.cesis_alt_btn[class*="tg-"]{color:<?php echo esc_attr($main_alt_button_text); ?> !important; background:<?php echo esc_attr($main_alt_button_bg); ?> !important; border-color:<?php echo esc_attr($main_alt_button_border); ?> !important;  font-family:<?php echo esc_attr($main_alt_button_font); ?> !important; font-size:<?php echo esc_attr($main_alt_button_size); ?> !important; font-weight:<?php echo esc_attr($main_alt_button_weight); ?> !important; text-transform:<?php echo esc_attr($main_alt_button_tt); ?> !important; letter-spacing:<?php echo esc_attr($main_alt_button_ls); ?> !important;}
.cesis_alt_btn[class*="tg-"]:hover{color:<?php echo esc_attr($main_alt_button_hover_text); ?> !important; background:<?php echo esc_attr($main_alt_button_hover_bg); ?> !important; border-color: <?php echo esc_attr($main_alt_button_hover_border); ?> !important;}


.cesis_sub_btn,.comments-layout-two input[type="submit"].cesis_sub_btn,.comments-layout-four input[type="submit"].cesis_sub_btn,
.cesis_cf7_sub_btn input[type="submit"]
{color:<?php echo esc_attr($main_sub_button_text); ?>; background:<?php echo esc_attr($main_sub_button_bg); ?>; border-color:<?php echo esc_attr($main_sub_button_border); ?>;  font-family:<?php echo esc_attr($main_sub_button_font); ?>; font-size:<?php echo esc_attr($main_sub_button_size); ?>; font-weight:<?php echo esc_attr($main_sub_button_weight); ?>; text-transform:<?php echo esc_attr($main_sub_button_tt); ?>; letter-spacing:<?php echo esc_attr($main_sub_button_ls); ?>;}

.cesis_sub_btn:hover,.comments-layout-two input[type="submit"].cesis_sub_btn:hover,.comments-layout-four input[type="submit"].cesis_sub_btn:hover,
.cesis_cf7_sub_btn input[type="submit"]:hover
{ color:<?php echo esc_attr($main_sub_button_hover_text); ?>; background:<?php echo esc_attr($main_sub_button_hover_bg); ?>; border-color:<?php echo esc_attr($main_sub_button_hover_border); ?>;}


<?php if ($main_sub_button_shadow == "yes" ) { ?>
.cesis_sub_btn,.comments-layout-two .cesis_sub_btn,.comments-layout-four .cesis_sub_btn{
	-webkit-box-shadow: 0 0 20px rgba(46,47,57,.25);
	-moz-box-shadow: 0 0 20px rgba(46,47,57,.25);
	box-shadow: 0 0 20px rgba(46,47,57,.25);
}
<?php } ?>

/*--------------------------------------------------------------
#5 Footer main and sub area
--------------------------------------------------------------*/

<?php

$footer_main_width_units = $cesis_data["cesis_footer_width"]["units"];

if($footer_main_width_units !== '%'){
$footer_main_width = ($cesis_data["cesis_footer_width"]["width"] + 80).$footer_main_width_units;
}else{
$footer_main_width = $cesis_data["cesis_footer_width"]["width"];
}



$footer_top_padding = $cesis_data["cesis_footer_top_padding"]["height"];
$footer_bottom_padding = $cesis_data["cesis_footer_bottom_padding"]["height"];
$footer_widget_padding = $cesis_data["cesis_footer_widget_padding"]["height"];
$footer_heading_space = $cesis_data["cesis_footer_heading_space"]["height"];
$footer_main_bg = $cesis_data["cesis_footer_bg_color"];
$footer_main_border = $cesis_data["cesis_footer_border_color"];
$footer_main_heading = $cesis_data["cesis_footer_heading_color"];
$footer_main_color = $cesis_data["cesis_footer_text_color"];
$footer_main_acolor = $cesis_data["cesis_footer_hl_color"];
$footer_main_hover_color = $cesis_data["cesis_footer_hover_color"];


$footer_heading_font = $cesis_data["cesis_footer_widget_font"]['font-family'];
$footer_heading_font_size = $cesis_data["cesis_footer_widget_font"]['font-size'];
$footer_heading_font_weight = $cesis_data["cesis_footer_widget_font"]['font-weight'];
$footer_heading_font_ls = $cesis_data["cesis_footer_widget_font"]['letter-spacing'];
$footer_heading_font_tt = $cesis_data["cesis_footer_widget_font"]['text-transform'];




$footer_sub_width_units = $cesis_data["cesis_footer_bar_width"]["units"];

if($footer_sub_width_units !== '%'){
$footer_sub_width = ($cesis_data["cesis_footer_bar_width"]["width"] + 80).$footer_sub_width_units;
}else{
$footer_sub_width = $cesis_data["cesis_footer_bar_width"]["width"];
}


$footer_sub_height = $cesis_data["cesis_footer_bar_height"]["height"];
$footer_sub_bg = $cesis_data["cesis_footer_bar_bg_color"];
$footer_sub_color = $cesis_data["cesis_footer_bar_text_color"];
$footer_sub_acolor = $cesis_data["cesis_footer_bar_hl_color"];
$footer_sub_hover_color = $cesis_data["cesis_footer_bar_hover_color"];

$footer_sub_menu_font = $cesis_data["cesis_footer_menu_font"]['font-family'];
$footer_sub_menu_font_size = $cesis_data["cesis_footer_menu_font"]['font-size'];
$footer_sub_menu_font_weight = $cesis_data["cesis_footer_menu_font"]['font-weight'];
$footer_sub_menu_font_ls = $cesis_data["cesis_footer_menu_font"]['letter-spacing'];
$footer_sub_menu_font_tt = $cesis_data["cesis_footer_menu_font"]['text-transform'];

$footer_sub_menu_space = $cesis_data['cesis_footer_menu_space'];
$footer_sub_font_size = $cesis_data['cesis_footer_text_size'];


?>
/*--------
  MAIN
-------*/


/* container settings */
.footer_main .cesis_container { max-width:<?php echo esc_attr($footer_main_width); ?>; padding-top:<?php echo esc_attr($footer_top_padding); ?>; padding-bottom:<?php echo esc_attr($footer_bottom_padding); ?>; }

/* Footer main settings */
.footer_main,
.footer_main input[type="checkbox"],.footer_main input[type="radio"],.footer_main select,.footer_main input[type="text"],
.footer_main input[type="email"],.footer_main input[type="url"],.footer_main input[type="password"],.footer_main input[type="search"],.footer_main input[type="tel"],.footer_main input[type="date"]
,.footer_main textarea,.footer_main select,.footer_main #bbp-search-form #bbp_search{ background-color:<?php echo esc_attr($footer_main_bg); ?>; color:<?php echo esc_attr($footer_main_color); ?>;}


.footer_main .product_list_widget span.woocommerce-Price-amount.amount,
.footer_main .woocommerce.widget_shopping_cart .total .amount
 { color:<?php echo esc_attr($footer_main_color); ?>;}


/* heading */

.footer_main h1,.footer_main h2,.footer_main h3,.footer_main h4,.footer_main h5,.footer_main h6,.footer_main h1 a,.footer_main h2 a,.footer_main h3 a,.footer_main h4 a,.footer_main h5 a,.footer_main h6 a,
.footer_main .widget_search .cesis_search_widget input[type="search"],
.footer_main .cesis_search_widget label:after

<?php if( cesis_check_woo_status() == true) { ?>
,.footer_main .woocommerce ul.product_list_widget li .star-rating, .footer_main .woocommerce ul.product_list_widget li .star-rating:before,
.footer_main .woocommerce-product-search label:after,
.footer_main .woocommerce-product-search input[type="search"],
.footer_main .woocommerce.widget_shopping_cart .total,
.footer_main .woocommerce a.remove:after
<?php } ?>
{ color:<?php echo esc_attr($footer_main_heading); ?>; }
.footer_main input::-webkit-input-placeholder,.footer_main textarea::-webkit-input-placeholder
{ color:<?php echo esc_attr($footer_main_heading); ?>; }

.cesis_f_widget_title { font-family:<?php echo esc_attr($footer_heading_font); ?>; font-size:<?php echo esc_attr($footer_heading_font_size); ?>; letter-spacing:<?php echo esc_attr($footer_heading_font_ls); ?>; text-transform:<?php echo esc_attr($footer_heading_font_tt); ?>; margin-bottom:<?php echo esc_attr($footer_heading_space); ?>; }

.footer_widget .tagcloud a { font-family:<?php echo esc_attr($footer_heading_font); ?>;}

/* widget space */

.cesis_f_widget { padding-bottom:<?php echo esc_attr($footer_widget_padding); ?>; }

/* accent color */

.footer_main a,.footer_widget .tagcloud a:hover


<?php if( cesis_check_woo_status() == true) { ?>
,.footer-main .woocommerce a.remove:hover:after
<?php } ?>
{ color:<?php echo esc_attr($footer_main_acolor); ?>; }

.footer-main input[type=radio]:checked:before,.footer_main input[type="checkbox"]:checked:before
{ background:<?php echo esc_attr($footer_main_acolor); ?>; }

/* hover color */

.footer_main a:hover,.footer_main h1 a:hover,.footer_main h2 a:hover,.footer_main h3 a:hover,.footer_main h4 a:hover,.footer_main h5 a:hover,.footer_main h6 a:hover{ color:<?php echo esc_attr($footer_main_hover_color); ?>; }

.footer_widget .tagcloud a:hover{ background:<?php echo esc_attr($footer_main_hover_color); ?>; }

.footer_widget .tagcloud a:hover{ border-color:<?php echo esc_attr($footer_main_hover_color); ?>; }

/* border color */

.footer_main input[type="checkbox"],.footer_main input[type="radio"],.footer_main select,.footer_main input[type="text"],.footer_main input[type="email"],.footer_main input[type="url"],.footer_main input[type="password"],.footer_main input[type="search"],.footer_main input[type="tel"],.footer_main textarea,
.footer_widget .widget_meta li,.footer_widget .widget_archive li,.footer_widget .widget_categories li,.footer_widget .widget_pages li a,.footer_widget .widget_recent_comments li,.footer_widget .widget_recent_entries li,
.footer_widget .tagcloud a

<?php if( cesis_check_woo_status() == true) { ?>
,.woocommerce .footer_main  .widget_price_filter .price_slider_wrapper .ui-widget-content,
.footer_main .widget_search .cesis_search_widget input[type="search"],
.footer_main .woocommerce ul.product_list_widget li.mini_cart_item, .footer_main ul.product_list_widget li.mini_cart_item
<?php } ?>


<?php if( cesis_check_bbp_status() == true) { ?>
,.footer_widget .widget_display_forums li a,.footer_widget .widget_display_topics li a,
.footer_widget .widget_display_replies li a,.footer_widget .widget_display_views li a
<?php } ?>

{ border-color:<?php echo esc_attr($footer_main_border); ?>; }


/*--------
   SUB
-------*/

/* container settings */

.footer_sub { min-height:<?php echo esc_attr($footer_sub_height); ?>; }

.footer_sub .cesis_container { max-width:<?php echo esc_attr($footer_sub_width); ?>;  }

/* Footer sub main settings */

.footer_sub {  background:<?php echo esc_attr($footer_sub_bg); ?>; color:<?php echo esc_attr($footer_sub_color); ?>; }

/* accent color */

.footer_sub a{ color:<?php echo esc_attr($footer_sub_acolor); ?>; }

/* hover color */

.footer_sub a:hover{ color:<?php echo esc_attr($footer_sub_hover_color); ?>; }

/* footer menu settings */


.footer_sub .menu-footer-ct li { font-family:<?php echo esc_attr($footer_sub_menu_font); ?>; font-size:<?php echo esc_attr($footer_sub_menu_font_size); ?>; letter-spacing:<?php echo esc_attr($footer_sub_menu_font_ls); ?>; text-transform:<?php echo esc_attr($footer_sub_menu_font_tt); ?>; font-weight:<?php echo esc_attr($footer_sub_menu_font_weight); ?>; padding:0 <?php echo esc_attr($footer_sub_menu_space); ?>px;}
.f_text_one, .f_text_two, .f_text_three{font-size:<?php echo esc_attr($footer_sub_font_size); ?>px;}

/*--------------------------------------------------------------
#6 Sidebar
--------------------------------------------------------------*/

<?php

$sidebar_width = $cesis_data["cesis_sidebar_size"];
$content_width = 100 - $cesis_data["cesis_sidebar_size"];
$sidebar_space = $cesis_data["cesis_sidebar_space"] / 2;

$sidebar_bottom_padding = $cesis_data["cesis_sidebar_bottom_padding"]["height"];
$sidebar_heading_space = $cesis_data["cesis_sidebar_heading_space"]["height"];

$sidebar_heading_font = $cesis_data["cesis_sidebar_widget_font"]['font-family'];
$sidebar_heading_font_size = $cesis_data["cesis_sidebar_widget_font"]['font-size'];
$sidebar_heading_font_weight = $cesis_data["cesis_sidebar_widget_font"]['font-weight'];
$sidebar_heading_font_ls = $cesis_data["cesis_sidebar_widget_font"]['letter-spacing'];
$sidebar_heading_font_lh = $cesis_data["cesis_sidebar_widget_font"]['line-height'];
$sidebar_heading_font_tt = $cesis_data["cesis_sidebar_widget_font"]['text-transform'];


$sidebar_heading = $cesis_data["cesis_sidebar_heading_color"];
$sidebar_text = $cesis_data["cesis_sidebar_text_color"];


$sidebar_background = $cesis_data["cesis_sidebar_bg_color"];

$sidebar_expand_background = $cesis_data["cesis_sidebar_expand_bg_color"];



?>

/* Sidebar and Content size settings */

.sidebar_ctn { width:calc( <?php echo esc_attr($sidebar_width); ?>% - <?php echo esc_attr($sidebar_space); ?>px ); }
.article_ctn.has_sidebar { width:calc( <?php echo esc_attr($content_width); ?>% - <?php echo esc_attr($sidebar_space); ?>px ); }

aside.main-sidebar section,.wpb_widgetised_column section { color: <?php echo esc_attr($sidebar_text); ?>}


aside.main-sidebar h1,.wpb_widgetised_column h1,aside.main-sidebar h2,
.wpb_widgetised_column h2,aside.main-sidebar h3,.wpb_widgetised_column h3,aside.main-sidebar h4,
.wpb_widgetised_column h4,aside.main-sidebar h5,.wpb_widgetised_column h5,aside.main-sidebar h6,
.wpb_widgetised_column h6 { color: <?php echo esc_attr($sidebar_heading); ?>}
.sidebar_expanded:after { background: <?php echo esc_attr($sidebar_expand_background); ?>}
.sidebar_expanded.r_sidebar:after { left:-<?php echo esc_attr($sidebar_space); ?>px;}
.sidebar_expanded.l_sidebar:after { right:-<?php echo esc_attr($sidebar_space); ?>px;}

/* Sidebar Widget Default settings / Mutual settings between sidebar type  */


aside.main-sidebar section,.wpb_widgetised_column section{ margin-bottom:<?php echo esc_attr($sidebar_bottom_padding); ?>; }

aside.main-sidebar section > h2,.wpb_widgetised_column section > h2{ font-family:<?php echo esc_attr($sidebar_heading_font); ?>; font-size:<?php echo esc_attr($sidebar_heading_font_size); ?>; letter-spacing:<?php echo esc_attr($sidebar_heading_font_ls); ?>; text-transform:<?php echo esc_attr($sidebar_heading_font_tt); ?>; margin-bottom:<?php echo esc_attr($sidebar_heading_space); ?>; line-height:<?php echo esc_attr($sidebar_heading_font_lh); ?>; }


.sidebar_layout_one .widget_archive li,.sidebar_layout_one .widget_meta li,.sidebar_layout_one .widget_categories li,.sidebar_layout_one .widget_pages li a,.sidebar_layout_one .widget_recent_comments li,.sidebar_layout_one .widget_recent_entries li,.sidebar_layout_two .widget_meta li,.sidebar_layout_two .widget_archive li,.sidebar_layout_two .widget_categories li,.sidebar_layout_two .widget_pages li a,.sidebar_layout_two .widget_recent_comments li,.sidebar_layout_two .widget_recent_entries li,.sidebar_layout_three .widget_meta li,.sidebar_layout_three .widget_archive li,.sidebar_layout_three .widget_categories li,.sidebar_layout_three .widget_pages li a,.sidebar_layout_three .widget_recent_comments li,.sidebar_layout_three .widget_recent_entries li

<?php if( cesis_check_bbp_status() == true) { ?>
,.sidebar_layout_one .widget_display_forums li a,.sidebar_layout_one .widget_display_topics li a,
.sidebar_layout_one .widget_display_replies li a,.sidebar_layout_one .widget_display_views li a,
.sidebar_layout_two  .widget_display_forums li a,.sidebar_layout_two  .widget_display_topics li a,
.sidebar_layout_two  .widget_display_replies li a,.sidebar_layout_two  .widget_display_views li a,
.sidebar_layout_three  .widget_display_forums li a,.sidebar_layout_three  .widget_display_topics li a,
.sidebar_layout_three  .widget_display_replies li a,.sidebar_layout_three  .widget_display_views li a
<?php } ?>

{ border-color:<?php echo esc_attr($main_area_border); ?>; }


.no-results .cesis_search_widget input[type="search"],.sidebar_layout_one .widget_search input[type="search"],.sidebar_layout_two .widget_search input[type="search"],.sidebar_layout_three .widget_search input[type="search"]

{ border-color:<?php echo esc_attr($main_area_border); ?>; color:<?php echo esc_attr($main_area_color); ?>;  }

.no-results .cesis_search_widget input[type="search"]:focus,.sidebar_layout_one .widget_search input[type="search"]:focus,.sidebar_layout_two .widget_search input[type="search"]:focus,.sidebar_layout_three .widget_search input[type="search"]:focus

 { outline:1px solid <?php echo esc_attr($main_area_one_acolor); ?>; }


.sidebar_layout_one .widget_search .search-submit,.sidebar_layout_two .widget_search .search-submit ,.sidebar_layout_three .widget_search .search-submit

{ color:<?php echo esc_attr($main_area_heading); ?>; }


.sidebar_layout_one section a,.sidebar_layout_two section a,.sidebar_layout_three section a{ color: <?php echo esc_attr($sidebar_text); ?>}

.sidebar_layout_one section a:hover,.sidebar_layout_two section a:hover,.sidebar_layout_three section a:hover{ color:<?php echo esc_attr($main_area_one_acolor); ?>; }



/* layout one */

.sidebar_layout_one .tagcloud a { color:<?php echo esc_attr($main_area_alt_one_acolor); ?>; background:<?php echo esc_attr($main_area_alt_bg); ?>; border:1px solid <?php echo esc_attr($main_area_alt_border); ?>;}
.sidebar_layout_one .tagcloud a:hover { color:#ffffff; background:<?php echo esc_attr($main_area_alt_one_acolor); ?>; border:1px solid <?php echo esc_attr($main_area_alt_one_acolor); ?>;}

/* layout two */

.sidebar_layout_two section{  background:<?php echo esc_attr($sidebar_background); ?>; }
.sidebar_layout_two .tagcloud a{border:1px solid <?php echo esc_attr($main_area_border); ?>; font-family:<?php echo esc_attr($sidebar_heading_font); ?>; }
.sidebar_layout_two .tagcloud a:hover { background:<?php echo esc_attr($main_area_one_acolor); ?>; border-color:<?php echo esc_attr($main_area_one_acolor); ?>; color:<?php echo esc_attr($sidebar_background); ?>; }

/* layout three */


.sidebar_layout_three .tagcloud a{border:1px solid <?php echo esc_attr($main_area_border); ?>; font-family:<?php echo esc_attr($sidebar_heading_font); ?>;  color:<?php echo esc_attr($sidebar_text); ?>; background:<?php echo esc_attr($main_area_bg); ?>;}
.sidebar_layout_three .tagcloud a:hover { background:<?php echo esc_attr($main_area_one_acolor); ?>; border-color:<?php echo esc_attr($main_area_one_acolor); ?>; color:<?php echo esc_attr($main_area_bg); ?>; }

.sidebar_layout_three .cesis_widget_title:after { background:<?php echo esc_attr($main_area_one_acolor); ?>; }



/*--------------------------------------------------------------
#7 Page Settings
--------------------------------------------------------------*/
<?php

$page_content_width_units = $cesis_data["cesis_page_content_width"]["units"];
if($page_content_width_units !== '%'){
$page_area_width = ($cesis_data["cesis_page_content_width"]["width"] + 80).$page_content_width_units;
}else{
$page_area_width = $cesis_data["cesis_page_content_width"]["width"];
}


$page_area_top_padding = $cesis_data["cesis_page_content_top_padding"]["height"];
$page_area_bottom_padding = $cesis_data["cesis_page_content_bottom_padding"]["height"];

?>

/* width settings */
.page .site-main .cesis_container,.page .cesis_top_banner .cesis_container { max-width:<?php echo esc_attr($page_area_width); ?>; }

/* top and bottom padding settings */


.page .article_ctn,.page .sidebar_ctn { padding-top:<?php echo esc_attr($page_area_top_padding); ?>; padding-bottom:<?php echo esc_attr($page_area_bottom_padding); ?>; }


/*--------------------------------------------------------------
#8 Blog Settings
--------------------------------------------------------------*/

<?php

$blog_content_width_units = $cesis_data["cesis_blog_content_width"]["units"];
if($blog_content_width_units !== '%'){
$blog_area_width = ($cesis_data["cesis_blog_content_width"]["width"] + 80).$blog_content_width_units;
}else{
$blog_area_width = $cesis_data["cesis_blog_content_width"]["width"];
}

$blog_area_top_padding = $cesis_data["cesis_blog_content_top_padding"]["height"];
$blog_area_bottom_padding = $cesis_data["cesis_blog_content_bottom_padding"]["height"];

$blog_gallery_space = $cesis_data["cesis_blog_gallery_space"];


$blog_a_content_width_units = $cesis_data["cesis_blog_archive_content_width"]["units"];
if($blog_a_content_width_units !== '%'){
$blog_a_area_width = ($cesis_data["cesis_blog_archive_content_width"]["width"] + 80).$blog_a_content_width_units;
}else{
$blog_a_area_width = $cesis_data["cesis_blog_archive_content_width"]["width"];
}

$blog_a_area_top_padding = $cesis_data["cesis_blog_archive_top_padding"]["height"];
$blog_a_area_bottom_padding = $cesis_data["cesis_blog_archive_bottom_padding"]["height"];

?>


/* width settings */
.single-post .site-main .cesis_container,
.single-post .cesis_top_banner .cesis_container{ max-width:<?php echo esc_attr($blog_area_width); ?>; }

/* top and bottom padding settings */
.single-post .article_ctn,.single-post .sidebar_ctn { padding-top:<?php echo esc_attr($blog_area_top_padding); ?>; padding-bottom:<?php echo esc_attr($blog_area_bottom_padding); ?>; }

/* stacked gallery */

.single-post .cesis_blog_gallery_stacked .cesis_gallery_img img { margin-bottom:<?php echo esc_attr($blog_gallery_space); ?>px;}

/* width settings */
.home.blog .site-main .cesis_container,.archive.category .site-main .cesis_container,.archive.tag .site-main .cesis_container,
.home.blog .cesis_top_banner .cesis_container,.archive.category .cesis_top_banner .cesis_container,.archive.tag .cesis_top_banner .cesis_container { max-width:<?php echo esc_attr($blog_a_area_width); ?>; }

/* top and bottom padding settings */
.home.blog .article_ctn,.home.blog .sidebar_ctn,.archive.category .article_ctn,.archive.category .sidebar_ctn,.archive.tag .article_ctn,.archive.tag .sidebar_ctn,.archive.date .article_ctn,.archive.date .sidebar_ctn{ padding-top:<?php echo esc_attr($blog_a_area_top_padding); ?>; padding-bottom:<?php echo esc_attr($blog_a_area_bottom_padding); ?>; }





/*--------------------------------------------------------------
#9 Portfolio Settings
--------------------------------------------------------------*/


<?php

$portfolio_content_width_units = $cesis_data["cesis_portfolio_content_width"]["units"];
if($portfolio_content_width_units !== '%'){
$portfolio_area_width = ($cesis_data["cesis_portfolio_content_width"]["width"] + 80).$portfolio_content_width_units;
}else{
$portfolio_area_width = $cesis_data["cesis_portfolio_content_width"]["width"];
}

$portfolio_area_top_padding = $cesis_data["cesis_portfolio_content_top_padding"]["height"];
$portfolio_area_bottom_padding = $cesis_data["cesis_portfolio_content_bottom_padding"]["height"];

$portfolio_gallery_space = $cesis_data["cesis_portfolio_gallery_space"];

$portfolio_a_content_width_units = $cesis_data["cesis_portfolio_archive_content_width"]["units"];
if($portfolio_a_content_width_units !== '%'){
$portfolio_a_area_width = ($cesis_data["cesis_portfolio_archive_content_width"]["width"] + 80).$portfolio_a_content_width_units;
}else{
$portfolio_a_area_width = $cesis_data["cesis_portfolio_archive_content_width"]["width"];
}

$portfolio_a_area_top_padding = $cesis_data["cesis_portfolio_archive_top_padding"]["height"];
$portfolio_a_area_bottom_padding = $cesis_data["cesis_portfolio_archive_bottom_padding"]["height"];

?>


/* width settings */
.single-portfolio .site-main .cesis_container,
.single-portfolio .cesis_top_banner .cesis_container { max-width:<?php echo esc_attr($portfolio_area_width); ?>; }

/* top and bottom padding settings */

.single-portfolio .article_ctn,.single-portfolio .sidebar_ctn { padding-top:<?php echo esc_attr($portfolio_area_top_padding); ?>; padding-bottom:<?php echo esc_attr($portfolio_area_bottom_padding); ?>; }


/* stacked gallery */

.single-portfolio .cesis_portfolio_gallery_stacked .cesis_gallery_img img { margin-bottom:<?php echo esc_attr($portfolio_gallery_space); ?>px;}

/* width settings */
.archive.tax-portfolio_category .site-main .cesis_container,
.archive.tax-portfolio_category .cesis_top_banner .cesis_container { max-width:<?php echo esc_attr($portfolio_a_area_width); ?>; }

/* top and bottom padding settings */

.archive.tax-portfolio_category .article_ctn,.archive.tax-portfolio_category .sidebar_ctn,
.archive.tax-portfolio_tag .article_ctn,.archive.tax-portfolio_tag .sidebar_ctn{ padding-top:<?php echo esc_attr($portfolio_a_area_top_padding); ?>; padding-bottom:<?php echo esc_attr($portfolio_a_area_bottom_padding); ?>; }


/*--------------------------------------------------------------
#10 Staff Settings
--------------------------------------------------------------*/


<?php

$staff_content_width_units = $cesis_data["cesis_staff_content_width"]["units"];
if($staff_content_width_units !== '%'){
$staff_area_width = ($cesis_data["cesis_staff_content_width"]["width"] + 80).$staff_content_width_units;
}else{
$staff_area_width = $cesis_data["cesis_staff_content_width"]["width"];
}

$staff_area_top_padding = $cesis_data["cesis_staff_content_top_padding"]["height"];
$staff_area_bottom_padding = $cesis_data["cesis_staff_content_bottom_padding"]["height"];


$staff_a_content_width_units = $cesis_data["cesis_staff_archive_content_width"]["units"];
if($staff_a_content_width_units !== '%'){
$staff_a_area_width = ($cesis_data["cesis_staff_archive_content_width"]["width"] + 80).$staff_a_content_width_units;
}else{
$staff_a_area_width = $cesis_data["cesis_staff_archive_content_width"]["width"];
}

$staff_a_area_top_padding = $cesis_data["cesis_staff_archive_top_padding"]["height"];
$staff_a_area_bottom_padding = $cesis_data["cesis_staff_archive_bottom_padding"]["height"];

?>


/* width settings */
.single-staff .site-main .cesis_container,
.single-staff .cesis_top_banner .cesis_container { max-width:<?php echo esc_attr($staff_area_width); ?>; }

/* top and bottom padding settings */

.single-staff .article_ctn,.single-staff .sidebar_ctn { padding-top:<?php echo esc_attr($staff_area_top_padding); ?>; padding-bottom:<?php echo esc_attr($staff_area_bottom_padding); ?>; }


/* width settings */
.archive.tax-staff_group .site-main .cesis_container,
.archive.tax-staff_tag .site-main .cesis_container,
.archive.tax-staff_group .cesis_top_banner .cesis_container,
.archive.tax-staff_tag .cesis_top_banner .cesis_container { max-width:<?php echo esc_attr($staff_a_area_width); ?>; }

/* top and bottom padding settings */

.archive.tax-staff_group .article_ctn,.archive.tax-staff_group .sidebar_ctn,
.archive.tax-staff_tag .article_ctn,.archive.tax-staff_tag .sidebar_ctn { padding-top:<?php echo esc_attr($staff_a_area_top_padding); ?>; padding-bottom:<?php echo esc_attr($staff_a_area_bottom_padding); ?>; }




/*--------------------------------------------------------------
#11 Career Position Settings
--------------------------------------------------------------*/
<?php

$career_content_width_units = $cesis_data["cesis_career_content_width"]["units"];
if($career_content_width_units !== '%'){
$career_area_width = ($cesis_data["cesis_career_content_width"]["width"] + 80).$career_content_width_units;
}else{
$career_area_width = $cesis_data["cesis_career_content_width"]["width"];
}


$career_area_top_padding = $cesis_data["cesis_career_content_top_padding"]["height"];
$career_area_bottom_padding = $cesis_data["cesis_career_content_bottom_padding"]["height"];


$career_a_content_width_units = $cesis_data["cesis_career_archive_content_width"]["units"];
if($career_a_content_width_units !== '%'){
$career_a_area_width = ($cesis_data["cesis_career_archive_content_width"]["width"] + 80).$career_a_content_width_units;
}else{
$career_a_area_width = $cesis_data["cesis_career_archive_content_width"]["width"];
}

$career_a_area_top_padding = $cesis_data["cesis_career_archive_top_padding"]["height"];
$career_a_area_bottom_padding = $cesis_data["cesis_career_archive_bottom_padding"]["height"];


?>

/* width settings */
.single-careers .site-main .cesis_container,
.single-careers .cesis_top_banner .cesis_container { max-width:<?php echo esc_attr($career_area_width); ?>; }

/* top and bottom padding settings */

.single-careers .article_ctn,.single-careers .sidebar_ctn { padding-top:<?php echo esc_attr($career_area_top_padding); ?>; padding-bottom:<?php echo esc_attr($career_area_bottom_padding); ?>; }

/* width settings */
.archive.tax-career_category .site-main .cesis_container,
.archive.tax-career_category .cesis_top_banner .cesis_container
 { max-width:<?php echo esc_attr($career_a_area_width); ?>; }

/* top and bottom padding settings */

.archive.tax-career_category .article_ctn,.archive.tax-career_category .sidebar_ctn{ padding-top:<?php echo esc_attr($career_a_area_top_padding); ?>; padding-bottom:<?php echo esc_attr($career_a_area_bottom_padding); ?>; }




/*--------------------------------------------------------------
#12 Woocommerce Settings
--------------------------------------------------------------*/


<?php if( cesis_check_woo_status() == true) {

$shop_content_width_units = $cesis_data["cesis_shop_content_width"]["units"];
if($shop_content_width_units !== '%'){
$shop_area_width = ($cesis_data["cesis_shop_content_width"]["width"] + 80).$shop_content_width_units;
}else{
$shop_area_width = $cesis_data["cesis_shop_content_width"]["width"];
}

$shop_area_top_padding = $cesis_data["cesis_shop_content_top_padding"]["height"];
$shop_area_bottom_padding = $cesis_data["cesis_shop_content_bottom_padding"]["height"];


$shop_archive_width_units = $cesis_data["cesis_product_archive_content_width"]["units"];
if($shop_archive_width_units !== '%'){
$shop_a_area_width = ($cesis_data["cesis_product_archive_content_width"]["width"] + 80).$shop_archive_width_units;
}else{
$shop_a_area_width = $cesis_data["cesis_product_archive_content_width"]["width"];
}

$shop_a_area_top_padding = $cesis_data["cesis_product_archive_top_padding"]["height"];
$shop_a_area_bottom_padding = $cesis_data["cesis_product_archive_bottom_padding"]["height"];

$shop_a_col = $cesis_data["cesis_product_archive_col"];
$shop_a_padding = $cesis_data["cesis_product_archive_padding"];


?>


/* width settings */
.single-product .site-main .cesis_container,
.single-product .cesis_top_banner .cesis_container { max-width:<?php echo esc_attr($shop_area_width); ?>; }

/* top and bottom padding settings */

.single-product .article_ctn,.single-product .sidebar_ctn{ padding-top:<?php echo esc_attr($shop_area_top_padding); ?>; padding-bottom:<?php echo esc_attr($shop_area_bottom_padding); ?>; }
.article_ctn span.onsale{ top:<?php echo esc_attr($shop_area_top_padding); ?>; }

/* width settings */
.post-type-archive-product .site-main .cesis_container,
.archive.tax-product_cat .site-main .cesis_container,
.archive.tax-product_tag .site-main .cesis_container,
.post-type-archive-product .cesis_top_banner .cesis_container,
.archive.tax-product_cat .cesis_top_banner .cesis_container,
.archive.tax-product_tag .cesis_top_banner .cesis_container{ max-width:<?php echo esc_attr($shop_a_area_width); ?>; }

/* top and bottom padding settings */
.post-type-archive-product .article_ctn,.post-type-archive-product .sidebar_ctn,
.archive.tax-product_cat .article_ctn,.archive.tax-product_cat .sidebar_ctn,
.archive.tax-product_tag .article_ctn,.archive.tax-product_tag .sidebar_ctn
{ padding-top:<?php echo esc_attr($shop_a_area_top_padding); ?>; padding-bottom:<?php echo esc_attr($shop_a_area_bottom_padding); ?>; }

/* Shop archive page layout settings */
.woocommerce-page.post-type-archive ul.products li.product,
.woocommerce-page.tax-product_cat ul.products li.product,
.woocommerce-page.tax-product_tag ul.products li.product
{
  width:calc(100% / <?php echo esc_attr($shop_a_col); ?>);
  padding:calc(<?php echo esc_attr($shop_a_padding); ?>px / 2);
}
.woocommerce-page.post-type-archive ul.products,
.woocommerce-page.tax-product_cat ul.products,
.woocommerce-page.tax-product_tag ul.products{
  margin:0 calc(-<?php echo esc_attr($shop_a_padding); ?>px / 2);
}

<?php } ?>


/*--------------------------------------------------------------
#13 Buddypress Settings
--------------------------------------------------------------*/

<?php if( cesis_check_bp_status() == true) {

$buddypress_content_width_units = $cesis_data["cesis_buddypress_content_width"]["units"];
if($buddypress_content_width_units !== '%'){
$buddypress_area_width = ($cesis_data["cesis_buddypress_content_width"]["width"] + 80).$buddypress_content_width_units;
}else{
$buddypress_area_width = $cesis_data["cesis_buddypress_content_width"]["width"];
}

$buddypress_area_top_padding = $cesis_data["cesis_buddypress_content_top_padding"]["height"];
$buddypress_area_bottom_padding = $cesis_data["cesis_buddypress_content_bottom_padding"]["height"];
?>

/* width settings */
.buddypress .site-main .cesis_container,.buddypress .cesis_top_banner .cesis_container,#item-header-cover-image,div.item-list-tabs { max-width:<?php echo esc_attr($buddypress_area_width); ?>; }

/* top and bottom padding settings */

.buddypress .article_ctn,.buddypress .sidebar_ctn{ padding-top:<?php echo esc_attr($buddypress_area_top_padding); ?>; padding-bottom:<?php echo esc_attr($buddypress_area_bottom_padding); ?>; }
<?php } ?>

/*--------------------------------------------------------------
#14 bbpress Settings
--------------------------------------------------------------*/

<?php if( cesis_check_bbp_status() == true) {

$bbpress_content_width_units = $cesis_data["cesis_bbpress_content_width"]["units"];
if($bbpress_content_width_units !== '%'){
$bbpress_area_width = ($cesis_data["cesis_bbpress_content_width"]["width"] + 80).$bbpress_content_width_units;
}else{
$bbpress_area_width = $cesis_data["cesis_bbpress_content_width"]["width"];
}

$bbpress_area_top_padding = $cesis_data["cesis_bbpress_content_top_padding"]["height"];
$bbpress_area_bottom_padding = $cesis_data["cesis_bbpress_content_bottom_padding"]["height"];
?>

/* width settings */
.bbpress .site-main .cesis_container,.bbpress .cesis_top_banner .cesis_container { max-width:<?php echo esc_attr($bbpress_area_width); ?>; }

/* top and bottom padding settings */

.bbpress .article_ctn,.bbpress .sidebar_ctn{ padding-top:<?php echo esc_attr($bbpress_area_top_padding); ?>; padding-bottom:<?php echo esc_attr($bbpress_area_bottom_padding); ?>; }

<?php } ?>



/*--------------------------------------------------------------
#15 404 Page Settings
--------------------------------------------------------------*/
<?php

$page404_content_width_units = $cesis_data["cesis_404_content_width"]["units"];
if($page404_content_width_units !== '%'){
$page404_area_width = ($cesis_data["cesis_404_content_width"]["width"] + 80).$page404_content_width_units;
}else{
$page404_area_width = $cesis_data["cesis_404_content_width"]["width"];
}


$page404_area_top_padding = $cesis_data["cesis_404_content_top_padding"]["height"];
$page404_area_bottom_padding = $cesis_data["cesis_404_content_bottom_padding"]["height"];

?>

/* width settings */
.error404 .site-main .cesis_container,.error404 .cesis_top_banner .cesis_container { max-width:<?php echo esc_attr($page404_area_width); ?>; }

/* top and bottom padding settings */


.error404 .article_ctn,.error404 .sidebar_ctn { padding-top:<?php echo esc_attr($page404_area_top_padding); ?>; padding-bottom:<?php echo esc_attr($page404_area_bottom_padding); ?>; }



/*--------------------------------------------------------------
#16 Search Settings
--------------------------------------------------------------*/


<?php

$search_content_width_units = $cesis_data["cesis_search_content_width"]["units"];
if($search_content_width_units !== '%'){
$search_area_width = ($cesis_data["cesis_search_content_width"]["width"] + 80).$search_content_width_units;
}else{
$search_area_width = $cesis_data["cesis_search_content_width"]["width"];
}


$search_area_top_padding = $cesis_data["cesis_search_content_top_padding"]["height"];
$search_area_bottom_padding = $cesis_data["cesis_search_content_bottom_padding"]["height"];

$search_overlay_color = $cesis_data["cesis_search_overlay_color"];
$search_overlay_bg = $cesis_data["cesis_search_overlay_bg"]["rgba"];
$search_overlay_border = $cesis_data["cesis_search_overlay_border"]["rgba"];

?>


/* width settings */
body.search .site-main .cesis_container,body.search .cesis_top_banner .cesis_container { max-width:<?php echo esc_attr($page404_area_width); ?>; }

/* top and bottom padding settings */


body.search .article_ctn,body.search .sidebar_ctn { padding-top:<?php echo esc_attr($page404_area_top_padding); ?>; padding-bottom:<?php echo esc_attr($page404_area_bottom_padding); ?>; }



.cesis_search_overlay{ background:<?php echo esc_attr($search_overlay_bg); ?>; }
.cesis_search_overlay,.cesis_search_overlay .cesis_search_container input{ color:<?php echo esc_attr($search_overlay_color); ?>; }
.cesis_search_close .lines{ background:<?php echo esc_attr($search_overlay_color); ?>; }
.cesis_search_overlay .cesis_search_container input{ border:1px solid <?php echo esc_attr($search_overlay_border); ?>; background:none;}

.cesis_search_overlay .cesis_search_container input::-webkit-input-placeholder{ color:<?php echo esc_attr($search_overlay_color); ?>;}




/*--------------------------------------------------------------
#17 Custom css
--------------------------------------------------------------*/

<?php


	$custom_css = $cesis_data['cesis_custom_css'];
	if ($custom_css <> '') {
		echo ' '.$custom_css.' ';
	}


 if(!is_customize_preview()){
ob_end_flush();
}
 ?>
