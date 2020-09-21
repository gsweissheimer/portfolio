<?php
/**
 * The template for displaying comments.
 *
 * This is the template that displays the area of the page that contains both the current comments
 * and the comment form.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Cesis
 */

/*
 * If the current post is protected by a password and
 * the visitor has not yet entered the password we will
 * return early without loading the comments.
 */
if ( post_password_required() ) {
	return;
}

global $cesis_data;

if(redux_post_meta( 'cesis_data', get_the_ID(), 'cesis_meta_blog_custom_layout') == "yes"){
$blog_post_style = redux_post_meta( 'cesis_data', get_the_ID(), 'cesis_meta_blog_sp_style');
if($blog_post_style == 'inherit'){
	$blog_post_style = $cesis_data["cesis_blog_sp_style"];
}
}else{
$blog_post_style = $cesis_data["cesis_blog_sp_style"];
}


if($blog_post_style == "single_post_layout_one") {
$comments_style = "one" ;
}
if($blog_post_style == "single_post_layout_two") {
$comments_style = "two" ;
}
if($blog_post_style == "single_post_layout_three") {
$comments_style = "three" ;
}
if($blog_post_style == "single_post_layout_four") {
$comments_style = "four" ;
}
if($blog_post_style == "single_post_layout_five") {
$comments_style = "five" ;
}
if($blog_post_style == "single_post_layout_six") {
$comments_style = "six" ;
}
if($blog_post_style == "single_post_layout_seven") {
$comments_style = "seven" ;
}
if($blog_post_style == "single_post_layout_eight") {
$comments_style = "eight" ;
}
if($blog_post_style == "single_post_layout_nine") {
$comments_style = "eight" ;
}
?>
<?php if($comments_style == "seven"){ ?>

<a class="to_comments_button" href="#lifestyle_container">
  <?php


comments_number(  __( 'Comments <span>0</span>', 'cesis' ), __( 'Comment <span>1</span>', 'cesis' ), __( 'Comments <span>%</span>', 'cesis' ));

			?>
</a>
</div>
<div class="lifestyle_comments_ctn" id="lifestyle_container">
<div class="cesis_container">
<?php } ?>
<div id="comments" class="comments-area comments-layout-<?php echo esc_attr($comments_style); ?>">
<?php // You can start editing here -- including this comment! ?>
<?php if($comments_style == "two" || $comments_style == "three" ){ ?>
<a class="to_comment_button" href="#respond"></a>
<?php } if ( have_comments() ) : ?>
<h2 class="comments-title">
  <?php
				 comments_popup_link( __( 'Comments <span>0</span>', 'cesis' ), __( 'Comment <span>1</span>', 'cesis' ), __( 'Comments <span>%</span>', 'cesis' ), 'comments-link', 'Comments are off for this post');
			?>
</h2>
<ul class="comment-list">
<?php
				wp_list_comments( array(
					'style'      => 'ul',
					'callback'      => 'cesis_comments',
					'short_ping' => true,
				) );
			?>
</ol>
<!-- .comment-list -->

<?php if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ) : // Are there comments to navigate through? ?>
<nav id="tt-comment-nav" class="navigation comment-navigation clear" role="navigation">
  <h2 class="screen-reader-text">
    <?php esc_html_e( 'Comment navigation', 'cesis' ); ?>
  </h2>
  <div class="comments-nav-links">
    <div class="nav-previous">
      <?php previous_comments_link( esc_html__( 'Previous', 'cesis' ) ); ?>
    </div>
    <div class="nav-next">
      <?php next_comments_link( esc_html__( 'Next', 'cesis' ) ); ?>
    </div>
  </div>
  <!-- .nav-links -->
</nav>
<!-- #comment-nav-below -->
<?php endif; // Check for comment navigation. ?>
<?php endif; // Check for have_comments(). ?>
<?php
		// If comments are closed and there are comments, let's leave a little note, shall we?
		if ( ! comments_open() && get_comments_number() && post_type_supports( get_post_type(), 'comments' ) ) :
	?>
<p class="no-comments">
  <?php esc_html_e( 'Comments are closed.', 'cesis' ); ?>
</p>
<?php endif; ?>
<?php


	function alter_comment_form_fields($new_fields) {
		return $new_fields;
	}


	add_filter('comment_form_default_fields', 'alter_comment_form_fields'); //make sure to use comment_form_default_fields


	$commenter = wp_get_current_commenter();

	$req = get_option( 'require_name_email' );

	$aria_req = ( $req ? " aria-required='true'" : '' );

	if( $comments_style !== 'six' && $comments_style !== 'eight' ){

	$commentph = __('Comment*', 'cesis');

	$new_fields = array(

	'author' => ( $req ? '' : '' ) .
            '<div class="cesis_comments_fieds"><input id="author" class="single_post_author" name="author" type="text" value="' . esc_attr( $commenter['comment_author'] ) . '"  placeholder="'.esc_attr__('Name*','cesis').'"' . $aria_req . ' />',

	'email'  => ( $req ? '' : '' ) .
	            '<input id="email" class="single_post_email" name="email" type="text" value="' . esc_attr(  $commenter['comment_author_email'] ) . '" placeholder="'.esc_attr__('Email*', 'cesis').'"' . $aria_req . ' />',


	'url'    => '<input id="url" class="single_post_url" name="url" type="text" value="' . esc_attr( $commenter['comment_author_url'] ) . '" placeholder="'.esc_attr__('Website', 'cesis').'" /></div>',

	);


	$textarea_label = '';

	}else{

 	$commentph = '';

	$new_fields = array(

	'author' => ( $req ? '' : '' ) .
            '<div class="cesis_comments_fieds"><div class="single_post_author"><label for="author">'.__('Name *','cesis').'</label><input id="author"  name="author" type="text" value="' . esc_attr( $commenter['comment_author'] ) . '"  ' . $aria_req . ' /></div>',

	'email'  => ( $req ? '' : '' ) .
	            '<div class="single_post_email"><label for="email">'.__('Email *','cesis').'</label><input id="email"  name="email" type="text" value="' . esc_attr(  $commenter['comment_author_email'] ) . '" ' . $aria_req . ' /></div>',


	'url'    => '<div class="single_post_url"><label for="url">'.__('Website','cesis').'</label><input id="url" name="url" type="text" value="' . esc_attr( $commenter['comment_author_url'] ) . '"  /></div></div>',

	);

	$textarea_label = '<label for="comment">'.__('Comment *', 'cesis').'</label>';
	}

if($comments_style == "one" || $comments_style == "three" || $comments_style == "six"  || $comments_style == "seven"  || $comments_style == "eight"  || $comments_style == "nine" ){

$submit_class = "cesis_btn";

}
elseif($comments_style == "two" || $comments_style == 'four'){

$submit_class = "cesis_sub_btn";

}

$comments_args = array(


'comment_field' => $textarea_label.'<textarea id="comment" name="comment" class="single_post_comment" placeholder="'.$commentph.'"  aria-required="true" required="required"></textarea>',

'fields' => apply_filters( 'comment_form_default_fields', $new_fields ),

'title_reply' => __('Add Comment', 'cesis'),

'label_submit' => __('Post comment', 'cesis'),

'class_submit' => $submit_class,

'comment_notes_before' => '',


);

	comment_form($comments_args); ?>
</div>
<!-- #comments -->
<?php if($comments_style == "seven"){ ?>
</div>
</div>
<?php } ?>
