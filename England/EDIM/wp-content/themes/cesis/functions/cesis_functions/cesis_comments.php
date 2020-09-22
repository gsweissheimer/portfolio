<?php
// Setup for the comments
if (!function_exists('cesis_comments')) {
function cesis_comments($comment, $args, $depth) {

	global $cesis_data;
if(redux_post_meta( 'cesis_data', get_the_ID(), 'cesis_meta_blog_custom_layout') == "yes"){
$blog_post_style = redux_post_meta( 'cesis_data', get_the_ID(), 'cesis_meta_blog_sp_style');
if($blog_post_style == 'inherit'){
	$blog_post_style = $cesis_data["cesis_blog_sp_style"];
}
}else{
$blog_post_style = $cesis_data["cesis_blog_sp_style"];
}

    $GLOBALS['comment'] = $comment;

?>
	<li <?php comment_class(); ?> id="li-comment-<?php comment_ID() ?>">

  <div id="comment-<?php comment_ID(); ?>" class="comment_ctn">

    <?php if($blog_post_style !== 'single_post_layout_ten'){ ?>
    <div class="avatar"> <?php echo get_avatar($comment,$size='150'); ?></div>

    <?php if ($comment->comment_approved == '0') : ?>
    <em>
    <?php _e('Your comment is awaiting moderation.', 'cesis') ?>
    </em> <br />
    <?php endif; ?>

    <div class="details"> <span class="author"><?php printf(__('%s','cesis'), get_comment_author_link()) ?></span><span class="date"><a href="<?php echo htmlspecialchars( get_comment_link( $comment->comment_ID ) ) ?>"><?php printf(__('%1$s at %2$s', 'cesis'), get_comment_date(),  get_comment_time()) ?></a></span>
      <div class="comment_text">

        <?php comment_text() ?>

      </div>

    <?php if($blog_post_style !== 'single_post_layout_one'){ ?>
      <div class="comment_buttons">

      <span class="reply"><?php comment_reply_link(array_merge( $args, array('depth' => $depth, 'max_depth' => $args['max_depth']))) ?></span>

      <?php edit_comment_link(__('Edit', 'cesis'),'<span class="edit">','</span>') ?></span>
      </div>


    <?php } ?>
    </div>

    <?php if($blog_post_style == 'single_post_layout_one'){ ?>
   <div class="comment_option_bar">
      <div class="comment_buttons">

      <span class="reply"><?php comment_reply_link(array_merge( $args, array('depth' => $depth, 'max_depth' => $args['max_depth']))) ?></span>

      <?php edit_comment_link(__('Edit', 'cesis'),'<span class="comment_buttons_sep">/</span><span class="edit">','</span>') ?></span>
      </div>
   </div>

<?php } } ?>

  </div>

  <?php }

}


if (!function_exists('cesis_get_comments')) {

function cesis_get_comments() {
ob_start();
	$num_comments = get_comments_number();
	if ( $num_comments == 0 ) {
		$comments = __('0 comments', 'cesis');
	} elseif ( $num_comments > 1 ) {
		$comments = $num_comments . __(' comments', 'cesis');
	} else {
		$comments = __('1 comment', 'cesis');
	}
	$write_comments = '<a href="' . get_comments_link() .'">'. $comments.'</a>';

	echo $write_comments;
$output_string = ob_get_contents();
			ob_end_clean();
			return $output_string;
}

}

?>
