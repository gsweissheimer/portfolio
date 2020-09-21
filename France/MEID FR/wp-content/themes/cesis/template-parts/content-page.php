<?php
/**
 * Template part for displaying page content in page.php.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Cesis
 */

?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	 <?php
                echo '<header class="entry-content-header">';
                    $thumb = get_the_post_thumbnail(get_the_ID(),'page_thumb');

                    if($thumb) echo "<div class='page-thumb'>{$thumb}</div>";
                echo '</header><!-- .entry-content-header -->';
     ?>

	<div class="entry-content">
		<?php the_content(); ?>
	</div><!-- .entry-content -->
    <?php 

	 echo '<footer class="entry-footer">';
                wp_link_pages(array('before' =>'<div class="pagination_split_post">',
                                        'after'  =>'</div>',
                                        'pagelink' => '<span>%</span>'
                                        ));
                echo '</footer><!-- .entry-footer -->' 
	?>
</article><!-- #post-## -->

