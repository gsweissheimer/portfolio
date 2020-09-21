<?php
//Search related functions
if(!function_exists('cesis_search'))
{


	function cesis_search($type = null){
		global $cesis_data;
		if($type == 'cesis_s_overlay'){
			$search_content = '
			<form role="search" method="get" class="search-form" action="'.esc_url(home_url('')).'">
							<div>
								<input type="search" class="search-field" placeholder="'.esc_attr__('Search …', 'cesis').'" value="" name="s">
								<input type="submit" class="search-submit" value="">
								<i class="fa fa-search2"></i>
							</div>
			</form>';
		}
		elseif($type == 'cesis_search_dropdown'){
			$search_content = '
	  	<span class="cesis_search_icon">
	  	<ul class="sm smart_menu search-menu sm-vertical '.$type.'">
	    	<li><a href="#" class="cesis_open_s_overlay"><span><i class="fa fa-search2"></i><span>'.__('Search', 'cesis').'</span></span></a>
	    		<ul class="cesis_dropdown">
	      		<li>
	        		<form role="search" method="get" class="search-form" action="'.home_url('').'">
	          		<input type="search" class="search-field" placeholder="'.esc_attr__('Search …', 'cesis').'" value="" name="s">
	        		</form>
	      		</li>
	    		</ul>
	    	</li>
	  	</ul>
	  	</span>';
		}else{
			$search_content = '
			<span class="cesis_search_icon '.$type.'">
			<ul class="sm smart_menu search-menu sm-vertical">
				<li><a href="#" class="cesis_open_s_overlay"><i class="fa fa-search2"></i><span class="cesis_desktop_hidden"><span>'.__('Search', 'cesis').'</span></span></a>
					<ul class="cesis_dropdown cesis_desktop_hidden">
						<li>
							<form role="search" method="get" class="search-form" action="'.home_url('').'">
								<input type="search" class="search-field" placeholder="'.esc_attr__('Search …', 'cesis').'" value="" name="s">
							</form>
						</li>
					</ul>
				</li>
			</ul>
			</span>';
		}
	return $search_content;
	}

}
