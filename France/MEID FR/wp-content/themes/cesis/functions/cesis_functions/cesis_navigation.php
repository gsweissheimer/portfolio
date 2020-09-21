<?php
// excerpt / content related functions
if(!function_exists('cesis_navigation'))
{
function cesis_navigation($mp,$arrow){
  $nav = $output = '';
  // create page string using max page number - 1 loop, if more than 10 pagess split in two, use css to display and hide two parts
  $i = 0;
  $n = 1;
  while($i < $mp){
    if($i == 0){
      $nav .= '<span data-page_to_load="'.$i.'" class="cesis_nav_number cesis_nav_first cesis_nav_active">'.$n.'</span>';
    }elseif($n == $mp){
      $nav .= '<span data-page_to_load="'.$i.'" class="cesis_nav_number cesis_nav_last">'.$n.'</span>';
    }else{
      $nav .= '<span data-page_to_load="'.$i.'" class="cesis_nav_number">'.$n.'</span>';
    }
    $i ++;
    $n ++;
  }
  if($arrow == 'text'){
    $output .= '<span class="cesis_nav_prev cesis_nav_off" data-page_to_load="0">'.__('Previous', 'cesis').'</span><div class="cesis_nav_numbers">'.$nav.'</div><span class="cesis_nav_next" data-page_to_load="1">'.__('Next', 'cesis').'</span>';
  }

  return $output;
}
}

if(!function_exists('cesis_classic_navigation'))
{
function cesis_classic_navigation() {
	// Don't print empty markup if there's only one page.
	if ( $GLOBALS['wp_query']->max_num_pages < 2 ) {
		return;
	}

	$pagination_args = array(
		'prev_next'		=> false,
		'type'			=> 'array',
	);
	$paginate_links = paginate_links($pagination_args);
  $output = '';
	if (is_array($paginate_links)) {
		$prev = get_previous_posts_link(__('Previous', 'cesis'));
		if ($prev !== NULL) $output .= '<span class="cesis_nav_prev">'.$prev.'</span>';
		else $output .= '<span class="cesis_nav_prev cesis_nav_off">'.__('Previous', 'cesis').'</span>';

    $output .= '<div class="cesis_nav_numbers">';
		foreach ( $paginate_links as $page ) {
			$output .= '<span class="cesis_nav_number">'.$page.'</span>';
		}
    $output .= '</div>';

		$next = get_next_posts_link(__('Next', 'cesis'));
		if ($next !== NULL) $output .= '<span class="cesis_nav_next">'.$next.'</span>';
		else $output .= '<span class="cesis_nav_next cesis_nav_off">'.__('Next', 'cesis').'</span>';

	}

	return $output;
}
}
