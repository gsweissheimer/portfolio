<?php
$bt1_text = __( "All", 'cesis_cp' );
$text1 = __( "Categories", 'cesis_cp' );

# Build Main Menu
$menu = "";

foreach ( cesis_wbpb_ext()->blocks->autoload_blocks as $key => $val ) {

	# Get Status Label
	$status = ( isset($val->status) ) ? "<span><p class='{$val->status->class}'>{$val->status->label}</p></span>" : '';

	# Button Markup
	$menu  .= "<a href='#' data-group-target='{$val->id}'>{$val->name}{$status}</a>";
}

return <<<HTML

	<span class="cesis_TM--close-block-overlayer"></span>
	<div class="cesis_templates">

		<div class="-main-nav">
			<p>$text1</p>
			$menu
		</div>

		<div class="cesis_templates_container">
			<div class="-header-sub-nav">
				<a href="#" id="cesis_TM--go-back-to-nav">
					<i class="fa-leftarrow-tail"></i>
					<i></i>
					<p>$bt1_text</p>
				</a>
			</div>

			<div id="cesis_TM-cesis_templates_list_wrapper" class="cesis_templates_list_wrapper"></div>

		</div>

	</div>

HTML;
