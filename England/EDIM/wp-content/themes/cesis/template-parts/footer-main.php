<?php
/**
 * Template part for displaying Footer top bar.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Cesis
 */

?>

<div class="footer_main">
  <div class="cesis_container">
    <div class="footer_widget_ctn">
    <?php
	global $cesis_data;

	if(isset($cesis_data['cesis_footer_columns'])) {
	$footer_columns = $cesis_data['cesis_footer_columns'];
	}
	else {
	$footer_columns = 4;
	}

	switch($footer_columns)
				        {
				        	case 1: $class = 'cesis_col-lg-12'; break;
				        	case 2: $class = 'cesis_col-lg-6'; break;
				        	case 3: $class = 'cesis_col-lg-4'; break;
				        	case 4: $class = 'cesis_col-lg-3'; break;
				        	case 5: $class = 'cesis_col-lg-2-4'; break;
				        }
    $firstCol = "first_col";
	for ($i = 1; $i <= $footer_columns; $i++)
						{
							echo "<div class='footer_widget {$class} {$firstCol}'>";
							if (function_exists('dynamic_sidebar') && dynamic_sidebar('Footer - column '.$i) ) : else : echo ''; endif;
							echo "</div>";
							$firstCol = "";
						}

					?>
      </div>
      <!-- .footer_widget_ctn -->
  </div>
  <!-- .container -->

</div>
<!-- .footer_main -->
