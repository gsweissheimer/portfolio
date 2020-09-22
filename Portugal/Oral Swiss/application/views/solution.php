		<!-- Start Headers Includes ===========
		======================================= -->
		<?php
            require_once 'includes/generateAllInfo.php';
			include('helper.php');
			include('header_sol.php');
		?>
		<!-- ==================================
		================== End Headers Includes -->
		
		<!-- Start Page Struture ==============
		======================================= -->
		<?php include('solution/structure.php'); ?>
		<!-- ==================================
		===================== End Page Struture -->	

		<!-- Start Footers Includes ===========
		======================================= -->
		<?php
			include('footer.php');
			include('commum-js-css.php');
		?>
		<!-- ==================================
		================== End Footers Includes -->
		<script type="text/javascript" src="<?php base_url('solution_custom.js','js') ?>"></script>