<?php
/**
 * The template for displaying Business classic single post.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package Cesis
 */

global $cesis_data;
global $post;
get_header();
?>


<main id="cesis_main" class="site-main vc_full_width_row_container" role="main">
  <div class="cesis_container">
    <?php while ( have_posts() ) : the_post(); ?>

    <div class="article_ctn">


	<?php get_template_part( 'template-parts/content', 'page' ); ?>
	<?php endwhile; // End of the loop.  ?>

    </div>
  </div>
  <!-- .container -->
</main>
<!-- #main -->
<?php get_footer(); ?>
