<?php
/**
 * Template part for displaying a message that posts cannot be found.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Cesis
 */



global $cesis_data;

$search_form = $cesis_data['cesis_search_form'];

  if ( cesis_check_ccp_status() == false ) {

	$search_form = 'yes';
	}

?>

<section class="no-results not-found">

	<div class="page-content">
		<?php if ( is_home() && current_user_can( 'publish_posts' ) ) : ?>

			<p><?php printf( wp_kses( __( 'Ready to publish your first post? <a href="%1$s">Get started here</a>.', 'cesis' ), array( 'a' => array( 'href' => array() ) ) ), esc_url( admin_url( 'post-new.php' ) ) ); ?></p>

		<?php elseif ( is_search() ) : ?>

			<p><?php esc_html_e( 'Sorry, but nothing matched your search terms. Please try again with some different keywords.', 'cesis' ); ?></p>
			<?php if($search_form == 'yes'){ get_search_form(); }?>

		<?php else : ?>

			<p><?php esc_html_e( 'It seems we can&rsquo;t find what you&rsquo;re looking for. Perhaps searching can help.', 'cesis' ); ?></p>
			<?php if($search_form == 'yes'){ get_search_form(); } ?>

		<?php endif; ?>
	</div><!-- .page-content -->
</section><!-- .no-results -->
