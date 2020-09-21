<?php
/**
 * Template part for displaying results in search pages.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Cesis
 */

 global $cesis_data;

$animation = $cesis_data['cesis_search_archive_animation'];
$padding = $cesis_data['cesis_search_archive_padding'];
$new_padding = ($padding / 2);

 if ($animation !== 'none'){
   $animation = 'wpb_animate_when_almost_visible wpb_' . $animation . ' ' . $animation;
 }

?>
<div class="cesis_iso_item" style="padding:<?php echo esc_attr($new_padding) ?>px;">
<div class="inside_e <?php echo esc_attr($animation)?>">
	<header class="entry-header">
		<?php the_title( sprintf( '<h4 class="cesis_search_entry_title"><a href="%s" rel="bookmark">', esc_url( get_permalink() ) ), '</a></h4>' ); ?>
	</header><!-- .entry-header -->
<?php  if( get_post_type($post->ID) == 'post' ){ ?>
<div class="cesis_search_result_type"><span><?php echo __('Blog Post', 'cesis'); ?></span></div>
<?php }elseif( get_post_type($post->ID) == 'page' ){ ?>
<div class="cesis_search_result_type"><span><?php echo __('Page', 'cesis'); ?></span></div>
<?php }elseif( get_post_type($post->ID) == 'portfolio' ){ ?>
<div class="cesis_search_result_type"><span><?php echo __('Portfolio Post', 'cesis'); ?></span></div>
<?php }elseif( get_post_type($post->ID) == 'staff' ){ ?>
<div class="cesis_search_result_type"><span><?php echo __('Staff Post', 'cesis'); ?></span></div>
<?php }elseif( get_post_type($post->ID) == 'careers' ){ ?>
<div class="cesis_search_result_type"><span><?php echo __('Career Position', 'cesis'); ?></span></div>
<?php }elseif( get_post_type($post->ID) == 'partners' ){ ?>
<div class="cesis_search_result_type"><span><?php echo __('Partner Post', 'cesis'); ?></span></div>
<?php }elseif( get_post_type($post->ID) == 'product' ){ ?>
<div class="cesis_search_result_type"><span><?php echo __('Product', 'cesis'); ?></span></div>
<?php }else{ ?>
<div class="cesis_search_result_type"><span><?php echo __('Custom Post', 'cesis'); ?></span></div>
<?php } ?>
</div>
</div>
