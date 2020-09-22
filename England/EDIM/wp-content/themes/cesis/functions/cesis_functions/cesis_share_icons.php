<?php
//video file related functions
if(!function_exists('cesis_share'))
{


	function cesis_share($style){

   	ob_start();
	global $cesis_data;
	$post_title = get_the_title();
	$post_title = str_replace('|','-' , $post_title);
	$facebook = $cesis_data["cesis_share_facebook"];
	$twitter = $cesis_data["cesis_share_twitter"];
	$google = $cesis_data["cesis_share_google"];
	$pinterest = $cesis_data["cesis_share_pinterest"];
	$linkedin = $cesis_data["cesis_share_linkedin"];
	$reddit = $cesis_data["cesis_share_reddit"];
	$tumblr = $cesis_data["cesis_share_tumblr"];
	$xing = $cesis_data["cesis_share_xing"];
	$vk = $cesis_data["cesis_share_vk"];
	$mail = $cesis_data["cesis_share_mail"];
	$i = 0;
	if($facebook !== 'no'){ $i ++;}
	if($twitter !== 'no'){ $i ++;}
	if($google !== 'no'){ $i ++;}
	if($pinterest !== 'no'){ $i ++;}
	if($linkedin !== 'no'){ $i ++;}
	if($reddit !== 'no'){ $i ++;}
	if($tumblr !== 'no'){ $i ++;}
	if($xing !== 'no'){ $i ++;}
	if($vk !== 'no'){ $i ++;}
	if($mail !== 'no'){ $i ++;}

	if($style == "grey"){
		$share_style = 'style="width:calc((100%/'.($i).') - ('.(10*($i - 1)/$i).'px))"';
	}elseif($style == "colorized" || $style == "grey thin" || $style == "grey transparent rounded" ){
		$share_style = 'style="width:calc((100%/'.($i).') - ('.(10*($i - 1)/$i).'px))"';
	}else{
		$share_style = '';
	}



	?>
   <div class="cesis_share_box <?php echo esc_attr($style); ?>">
   <?php if($facebook !== 'no'){ ?>
        <span class="cesis_share_facebook" <?php echo $share_style; ?> > <a target="_blank" onClick="popup = window.open('http://www.facebook.com/sharer.php?u=<?php echo urlencode(the_permalink()); ?>&amp;t=<?php echo esc_attr($post_title); ?>', 'PopupPage', 'height=450,width=500,scrollbars=yes,resizable=yes'); return false" href="#"><i class="fa fa-facebook"></i></a>
         </span>

   <?php } if($twitter !== 'no'){ ?>
        <span class="cesis_share_twitter" <?php echo $share_style; ?>> <a target="_blank" onClick="popup = window.open('https://twitter.com/intent/tweet?text=<?php echo esc_attr($post_title); ?> <?php echo urlencode(the_permalink()); ?>', 'PopupPage', 'height=450,width=500,scrollbars=yes,resizable=yes'); return false" href="#"><i class="fa fa-twitter"></i></a>
         </span>

   <?php } if($google !== 'no'){ ?>
        <span class="cesis_share_google" <?php echo $share_style; ?>> <a target="_blank" onClick="popup = window.open('https://plus.google.com/share?url=<?php echo urlencode(the_permalink()); ?>&amp;title=<?php echo esc_attr($post_title); ?>', 'PopupPage', 'height=450,width=500,scrollbars=yes,resizable=yes'); return false" href="#"><i class="fa fa-google-plus"></i></a>
         </span>

   <?php } if($pinterest !== 'no'){ ?>
        <span class="cesis_share_pinterest" <?php echo $share_style; ?>> <a target="_blank" onClick="popup = window.open('https://pinterest.com/pin/create/bookmarklet/?url=<?php echo urlencode(the_permalink()); ?>&amp;title=<?php echo esc_attr($post_title); ?>', 'PopupPage', 'height=450,width=500,scrollbars=yes,resizable=yes'); return false" href="#"><i class="fa fa-pinterest"></i></a>
         </span>

   <?php } if($linkedin !== 'no'){ ?>
        <span class="cesis_share_linkedin" <?php echo $share_style; ?>> <a target="_blank" onClick="popup = window.open('http://linkedin.com/shareArticle?mini=true&amp;url=<?php echo urlencode(the_permalink()); ?>&amp;title=<?php echo esc_attr($post_title); ?>', 'PopupPage', 'height=450,width=500,scrollbars=yes,resizable=yes'); return false" href="#"><i class="fa fa-linkedin"></i></a>
         </span>

   <?php } if($reddit !== 'no'){ ?>
        <span class="cesis_share_reddit" <?php echo $share_style; ?>> <a target="_blank" onClick="popup = window.open('http://reddit.com/submit?url=<?php echo urlencode(the_permalink()); ?>&amp;title=<?php echo esc_attr($post_title); ?>', 'PopupPage', 'height=450,width=500,scrollbars=yes,resizable=yes'); return false" href="#"><i class="fa fa-reddit"></i></a>
         </span>

   <?php } if($tumblr !== 'no'){ ?>
        <span class="cesis_share_tumblr" <?php echo $share_style; ?>> <a target="_blank" onClick="popup = window.open('https://www.tumblr.com/widgets/share/tool?posttype=link&amp;title=<?php echo esc_attr($post_title); ?>&amp;caption=<?php echo esc_attr($post_title); ?>&amp;content=<?php echo urlencode(the_permalink()); ?>&amp;canonicalUrl=<?php echo urlencode(the_permalink()); ?>&amp;shareSource=tumblr_share_button', 'PopupPage', 'height=450,width=500,scrollbars=yes,resizable=yes'); return false" href="#"><i class="fa fa-tumblr"></i></a>
         </span>

   <?php } if($xing !== 'no'){ ?>
        <span class="cesis_share_xing" <?php echo $share_style; ?>> <a target="_blank" onClick="popup = window.open('https://www.xing.com/app/user?op=share&url=<?php echo urlencode(the_permalink()); ?>', 'PopupPage', 'height=450,width=500,scrollbars=yes,resizable=yes'); return false" href="#"><i class="fa fa-xing"></i></a>
         </span>

   <?php } if($vk !== 'no'){ ?>
        <span class="cesis_share_vk" <?php echo $share_style; ?>> <a target="_blank" onClick="popup = window.open('http://vk.com/share.php?url=<?php echo urlencode(the_permalink()); ?>', 'PopupPage', 'height=450,width=500,scrollbars=yes,resizable=yes'); return false" href="#"><i class="fa fa-vk"></i></a>
         </span>

   <?php } if($mail !== 'no'){ ?>
        <span class="cesis_share_mail" <?php echo $share_style; ?>> <a target="_blank" onClick="popup = window.open('mailto:?subject=<?php echo esc_attr($post_title); ?>&amp;body=<?php echo urlencode(the_permalink()); ?>', 'PopupPage', 'height=450,width=500,scrollbars=yes,resizable=yes'); return false" href="#"><i class="fa fa-paper-plane-o"></i></a>
          </span>

   <?php } ?>
    </div>

	<?php $output_string = ob_get_contents();
ob_end_clean();
return $output_string;

	}

}
