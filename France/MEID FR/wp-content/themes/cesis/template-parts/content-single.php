<?php
/**
 * Template part for displaying single posts.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Cesis
 */

global $cesis_data;
	$share = $post_categories = $post_tags = 'no';
	$author = '<span class="cesis_blog_m_author">'.get_the_author_link().'</span>';
	$date = '<span class="cesis_blog_m_date">'.get_the_time(get_option('date_format')).'</span>';
	$comments = '<span class="cesis_blog_m_comment">'.cesis_get_comments().'</span>';

	$custom_layout = redux_post_meta( 'cesis_data', get_the_ID(), 'cesis_meta_blog_custom_layout');
	if($custom_layout  == 'yes'){
		$blog_post_style = redux_post_meta( 'cesis_data', get_the_ID(), "cesis_meta_blog_sp_style" );
		$share = redux_post_meta( 'cesis_data', get_the_ID(), 'cesis_meta_blog_sp_share');
		if($share == 'inherit'){ $share = $cesis_data['cesis_blog_sp_share']; }
		$post_author = redux_post_meta( 'cesis_data', get_the_ID(), 'cesis_meta_blog_sp_authori');
		if($post_author == 'inherit'){ $post_author = $cesis_data['cesis_blog_sp_authori']; }
		$post_comment = redux_post_meta( 'cesis_data', get_the_ID(), 'cesis_meta_blog_sp_comment');
		if($post_comment == 'inherit'){ $post_comment = $cesis_data['cesis_blog_sp_comment']; }
		$post_date = redux_post_meta( 'cesis_data', get_the_ID(), 'cesis_meta_blog_sp_date');
		if($post_date == 'inherit'){ $post_date = $cesis_data['cesis_blog_sp_date']; }
		$post_like = redux_post_meta( 'cesis_data', get_the_ID(), 'cesis_meta_blog_sp_like');
		if($post_like == 'inherit'){ $post_like = $cesis_data['cesis_blog_sp_like']; }
		$post_categories = redux_post_meta( 'cesis_data', get_the_ID(), 'cesis_meta_blog_sp_categories');
		if($post_categories == 'inherit'){ $post_categories = $cesis_data['cesis_blog_sp_categories']; }
		$post_tags = redux_post_meta( 'cesis_data', get_the_ID(), 'cesis_meta_blog_sp_tags');
		if($post_tags == 'inherit'){ $post_tags = $cesis_data['cesis_blog_sp_tags']; }
	}
	else{
		$blog_post_style = $cesis_data["cesis_blog_sp_style"];
		$share = $cesis_data['cesis_blog_sp_share'];
		$post_author = $cesis_data['cesis_blog_sp_author'];
		$post_comment = $cesis_data['cesis_blog_sp_comment'];
		$post_date = $cesis_data['cesis_blog_sp_date'];
		$post_like = $cesis_data['cesis_blog_sp_like'];
		$post_categories = $cesis_data['cesis_blog_sp_categories'];
		$post_tags = $cesis_data['cesis_blog_sp_tags'];
	}

	  if ( cesis_check_ccp_status() == false || get_post_type() == 'portfolio' || get_post_type() == 'staff' || get_post_type() == 'careers') {
			$share = $post_author = $post_comment = $post_date = $post_like = $post_categories = $post_tags = 'no';
		}
		?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<header class="entry-header">
    	<?php the_title( '<h1 class="entry-title">', '</h1>' ); ?>

	</header><!-- .entry-header -->

	<div class="entry-content">
		<?php the_content(); ?>
		<?php
			wp_link_pages( array(
				'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'cesis' ),
				'after'  => '</div>',
			) );
		?>
	</div><!-- .entry-content -->
    <?php

	 echo '<footer class="entry-footer">';
                wp_link_pages(array('before' =>'<div class="pagination_split_post">',
                                        'after'  =>'</div>',
                                        'pagelink' => '<span>%</span>'
                                        ));



		if($blog_post_style == "single_post_layout_one"){
			if($share == 'yes') {  ?>
	    	<div class="share_ctn">
        <?php echo cesis_share('colorized'); ?>
				</div>
			<?php }
			if($post_categories == 'yes') {  ?>
				<div class="sp_categories_ctn">
					<?php $categories = get_the_category(); if (! $categories)  {  } else { ?><?php the_category(', '); ?><?php } ?>
				</div>
			<?php }
			if($post_tags == 'yes') {  ?>
		    <div class="sp_tags_ctn">
	        <?php $tag = get_the_tags(); if (! $tag)  {  } else { ?><?php the_tags('', ', ', ''); ?><?php } ?>
				</div>
			<?php }
	 	}elseif($blog_post_style == "single_post_layout_two"){
		if($post_categories == 'yes' || $post_tags == 'yes' ) {  ?>
			<div class="sp_catags_ctn">
		<?php }
		if($post_categories == 'yes') {  ?>
			<div class="sp_categories_ctn">
				<?php $categories = get_the_category(); if (! $categories)  {  } else { ?><?php the_category(''); ?><?php } ?>
			</div>
		<?php }
		if($post_tags == 'yes') {  ?>
			<div class="sp_tags_ctn">
				<?php $tag = get_the_tags(); if (! $tag)  { } else { ?><?php the_tags('','',''); ?><?php } ?>
			</div>
		<?php }
		if($post_categories == 'yes' || $post_tags == 'yes' ) {  ?>
		</div>
		<?php }
		if($share == 'yes') {  ?>
      <div class="share_ctn"><h3><?php echo __('Share', 'cesis'); ?></h3>
        <?php echo cesis_share('grey'); ?>
			</div>
		<?php } ?>
	<?php }elseif($blog_post_style == "single_post_layout_three"){
	if($post_categories == 'yes' || $post_tags == 'yes' ) {  ?>
		<div class="sp_catags_ctn">
	<?php }
	if($post_categories == 'yes') {  ?>
		<div class="sp_categories_ctn">
			<?php $categories = get_the_category(); if (! $categories)  {  } else { ?><?php the_category(''); ?><?php } ?>
		</div>
	<?php }
	if($post_tags == 'yes') {  ?>
		<div class="sp_tags_ctn">
			<?php $tag = get_the_tags(); if (! $tag)  { } else { ?><?php the_tags('','',''); ?><?php } ?>
		</div>
	<?php }
	if($post_categories == 'yes' || $post_tags == 'yes' ) {  ?>
	</div>
	<?php }
		if($share == 'yes') {  ?>
      <div class="share_ctn">
        <?php echo cesis_share('grey thin'); ?>
			</div>
		<?php } ?>
	<?php }elseif($blog_post_style == "single_post_layout_four"){
	if($post_categories == 'yes' || $post_tags == 'yes' ) {  ?>
		<div class="sp_catags_ctn">
	<?php }
	if($post_categories == 'yes') {  ?>
		<div class="sp_categories_ctn">
			<?php $categories = get_the_category(); if (! $categories)  {  } else { ?><?php the_category(''); ?><?php } ?>
		</div>
	<?php }
	if($post_tags == 'yes') {  ?>
		<div class="sp_tags_ctn">
			<?php $tag = get_the_tags(); if (! $tag)  {  } else { ?><?php the_tags('','',''); ?><?php } ?>
		</div>
	<?php }
	if($post_categories == 'yes' || $post_tags == 'yes' ) {  ?>
	</div>
	<?php }
		if($share == 'yes') {  ?>
      <div class="share_ctn"><h3><?php echo __('Share', 'cesis'); ?></h3>
        <?php echo cesis_share('grey transparent rounded'); ?>
			</div>
		<?php } ?>
	<?php }elseif($blog_post_style == "single_post_layout_five"){
	if($post_categories == 'yes' || $post_tags == 'yes' ) {  ?>
		<div class="sp_catags_ctn">
	<?php }
	if($post_categories == 'yes') {  ?>
		<div class="sp_categories_ctn">
			<?php $categories = get_the_category(); if (! $categories)  {  } else { ?><?php the_category(''); ?><?php } ?>
		</div>
	<?php }
	if($post_tags == 'yes') {  ?>
		<div class="sp_tags_ctn">
			<?php $tag = get_the_tags(); if (! $tag)  {  } else { ?><?php the_tags('','',''); ?><?php } ?>
		</div>
	<?php }
	if($post_categories == 'yes' || $post_tags == 'yes' ) {  ?>
	</div>
	<?php }
		if($share == 'yes') {  ?>
      <div class="share_ctn">
        <?php echo cesis_share('grey thin'); ?>
			</div>
		<?php } ?>
	<?php }elseif($blog_post_style == "single_post_layout_six"){
	if($post_categories == 'yes' || $post_tags == 'yes' ) {  ?>
		<div class="sp_catags_ctn">
	<?php }
	if($post_categories == 'yes') {  ?>
		<div class="sp_categories_ctn">
			<?php $categories = get_the_category(); if (! $categories)  {  } else { ?><?php the_category(''); ?><?php } ?>
		</div>
	<?php }
	if($post_tags == 'yes') {  ?>
		<div class="sp_tags_ctn">
			<?php $tag = get_the_tags(); if (! $tag)  {  } else { ?><?php the_tags('','',''); ?><?php } ?>
		</div>
	<?php }
	if($post_categories == 'yes' || $post_tags == 'yes' ) {  ?>
	</div>
	<?php }
		if($share == 'yes') {  ?>
      <div class="share_ctn"><h3><?php echo __('Share', 'cesis'); ?></h3>
        <?php echo cesis_share('grey'); ?>
			</div>
		<?php } ?>
	<?php }elseif($blog_post_style == "single_post_layout_seven"){
	if($post_categories == 'yes' || $post_tags == 'yes' ) {  ?>
		<div class="sp_catags_ctn">
	<?php }
	if($post_categories == 'yes') {  ?>
		<div class="sp_categories_ctn">
			<?php $categories = get_the_category(); if (! $categories)  {  } else { ?><?php the_category(''); ?><?php } ?>
		</div>
	<?php }
	if($post_tags == 'yes') {  ?>
		<div class="sp_tags_ctn">
			<?php $tag = get_the_tags(); if (! $tag)  {  } else { ?><?php the_tags('','',''); ?><?php } ?>
		</div>
	<?php }
	if($post_categories == 'yes' || $post_tags == 'yes' ) {  ?>
	</div>
	<?php }
		if($share == 'yes') {  ?>
      <div class="share_ctn">
        <?php echo cesis_share('grey circle'); ?>
			</div>
		<?php } ?>
	<?php }elseif($blog_post_style == "single_post_layout_eight" || $blog_post_style == "single_post_layout_nine" ){
	if($post_author == 'yes' || $post_date == 'yes' || $post_comment == 'yes' || $post_like == 'yes' ){ ?>
	<div class="sp_info_ctn">
						<?php
	if($post_author == 'yes' ){echo $author;}
	if($post_date == 'yes' ){echo $date;}
	if($post_comment == 'yes'){echo $comments;}
	if($post_like == 'yes' && function_exists('zilla_likes') ){	echo do_shortcode('[zilla_likes]');}
	?>
						</div>
	<?php }
	if($post_categories == 'yes' || $post_tags == 'yes' ) {  ?>
		<div class="sp_catags_ctn">
	<?php }
	if($post_categories == 'yes') {  ?>
		<div class="sp_categories_ctn">
			<?php $categories = get_the_category(); if (! $categories)  {  } else { ?><?php the_category(''); ?><?php } ?>
		</div>
	<?php }
	if($post_tags == 'yes') {  ?>
		<div class="sp_tags_ctn">
			<?php $tag = get_the_tags(); if (! $tag)  {  } else { ?><?php the_tags('','',''); ?><?php } ?>
		</div>
	<?php }
	if($post_categories == 'yes' || $post_tags == 'yes' ) {  ?>
	</div>
	<?php }
		if($share == 'yes') {  ?>
      <div class="share_ctn"><h3><?php echo __('Share', 'cesis'); ?></h3>
        <?php echo cesis_share('grey transparent rounded'); ?>
			</div>
		<?php } ?>
	<?php }
	echo '</footer><!-- .entry-footer -->';
	?>

</article><!-- #post-## -->
