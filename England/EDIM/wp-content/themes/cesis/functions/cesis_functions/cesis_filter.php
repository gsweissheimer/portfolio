<?php

// video file related functions

if (!function_exists('cesis_filter'))
	{
	function cesis_filter($type, $post_type, $filter_base, $filter_sort, $filter_space)
		{
		$filter_space = $filter_space / 2;
		if ($post_type == "blog")
			{
				if (!isset($term_list))
					{
					$term_list = '';
					}

				if ($filter_base == 'cat_tag')
					{
					$permalink = get_permalink();
					$args = array(
						'taxonomy' => array(
							'post_tag',
							'category'
						)
					);
					}

				if ($filter_base == 'tag')
					{
					$permalink = get_permalink();
					$args = array(
						'taxonomy' => array(
							'post_tag'
						)
					);
					}

				if ($filter_base == 'category')
					{
					$permalink = get_permalink();
					$args = array(
						'taxonomy' => array(
							'category'
						)
					);
					}
			}
			if ($post_type == "portfolio")
				{
					if (!isset($term_list))
						{
						$term_list = '';
						}

					if ($filter_base == 'cat_tag')
						{
						$permalink = get_permalink();
						$args = array(
							'taxonomy' => array(
								'portfolio_tag',
								'portfolio_category'
							)
						);
						}

					if ($filter_base == 'tag')
						{
						$permalink = get_permalink();
						$args = array(
							'taxonomy' => array(
								'portfolio_tag'
							)
						);
						}

					if ($filter_base == 'category')
						{
						$permalink = get_permalink();
						$args = array(
							'taxonomy' => array(
								'portfolio_category'
							)
						);
						}
				}
				if ($post_type == "staff")
					{
						if (!isset($term_list))
							{
							$term_list = '';
							}

						if ($filter_base == 'cat_tag')
							{
							$permalink = get_permalink();
							$args = array(
								'taxonomy' => array(
									'staff_tag',
									'staff_group'
								)
							);
							}

						if ($filter_base == 'tag')
							{
							$permalink = get_permalink();
							$args = array(
								'taxonomy' => array(
									'staff_tag'
								)
							);
							}

						if ($filter_base == 'category')
							{
							$permalink = get_permalink();
							$args = array(
								'taxonomy' => array(
									'staff_group'
								)
							);
							}
					}
				if ($post_type == "product")
					{
						if (!isset($term_list))
							{
							$term_list = '';
							}

						if ($filter_base == 'cat_tag')
							{
							$permalink = get_permalink();
							$args = array(
								'taxonomy' => array(
									'product_tag',
									'product_cat'
								)
							);
							}

						if ($filter_base == 'tag')
							{
							$permalink = get_permalink();
							$args = array(
								'taxonomy' => array(
									'product_tag'
								)
							);
							}

						if ($filter_base == 'category')
							{
							$permalink = get_permalink();
							$args = array(
								'taxonomy' => array(
									'product_cat'
								)
							);
							}
					}
				if ($post_type == "careers")
					{
						if (!isset($term_list))
							{
							$term_list = '';
							}


						if ($filter_base == 'category')
							{
							$permalink = get_permalink();
							$args = array(
								'taxonomy' => array(
									'career_category'
								)
							);
							}
					}
				$terms = get_terms($args);
				$count = count($terms);
				$i = 0;
				$iterm = 1;
				if ($count > 0)
					{
					if (!isset($_GET['slug'])) $all_current = 'selected';
					$cape_list = '';
					$term_list.= '<li class="' . $all_current . '" style="margin:0 ' . $filter_space . 'px ' . $filter_space*2 . 'px;">';
					$term_list.= '<a href="#filter" data-filter="*" data-type="all">' . __('All', 'cesis') . '</a></li>';
					$termcount = count($terms);
					if (is_array($terms))
						{
						foreach($terms as $term)
							{
							$i++;
							$term_list.= '<li style="margin:0 ' . $filter_space . 'px ' . $filter_space*2 . 'px;" ><a href="#filter" data-type="' . $term->taxonomy . '" data-filter=".f_' . $term->term_id . '" title="' . sprintf(__('View all post filed under %s', 'cesis') , $term->name) . '">' . $term->name . '</a></li>';
							if ($count != $i) $term_list.= '';
							  else $term_list.= '';
							if ($iterm < $termcount)
								{
								$term_list.= '';
								}

							$iterm++;
							}
						}

					if ($filter_sort == 'cesis_sorter')
						{
						if ($post_type == "product"){
							$term_list.= '<li class="cesis_sorter" style="margin:0 ' . $filter_space . 'px ' . $filter_space*2 . 'px; ">' . __('Sort by', 'cesis') . '<ul><li class="cesis_sort_default sort_selected" data-sort="original-order">' . __('Default', 'cesis') . '</li><li class="cesis_sort_price" data-sort="price">' . __('Price', 'cesis') . '</li><li class="cesis_sort_date" data-sort="date">' . __('Date', 'cesis') . '</li><li class="cesis_sort_title" data-sort="title">' . __('Title', 'cesis') . '</li><li class="cesis_sort_asc" data-order="true">' . __('Asc', 'cesis') . '</li><li class="cesis_sort_desc" data-order="false">' . __('Desc', 'cesis') . '</li></ul></li>';
						}else{
							$term_list.= '<li class="cesis_sorter" style="margin:0 ' . $filter_space . 'px ' . $filter_space*2 . 'px; ">' . __('Sort by', 'cesis') . '<ul><li class="cesis_sort_default sort_selected" data-sort="original-order">' . __('Default', 'cesis') . '</li><li class="cesis_sort_date" data-sort="date">' . __('Date', 'cesis') . '</li><li class="cesis_sort_title" data-sort="title">' . __('Title', 'cesis') . '</li><li class="cesis_sort_asc" data-order="true">' . __('Asc', 'cesis') . '</li><li class="cesis_sort_desc" data-order="false">' . __('Desc', 'cesis') . '</li></ul></li>';
						}
						}

					echo '<ul class="cesis_filter">' . $term_list . '</ul>';
					}
			else{
				$term_list.= '<li class="selected" style="margin:0 ' . $filter_space . 'px ' . $filter_space*2 . 'px;">';
				$term_list.= '<a href="#filter" data-filter="*" data-type="all">' . __('No filter tags or category found', 'cesis') . '</a></li>';
				echo '<ul class="cesis_filter">' . $term_list . '</ul>';
			}


		}
	}
