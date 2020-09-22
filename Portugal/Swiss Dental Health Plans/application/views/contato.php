		<!-- Start Headers Includes ===========
		======================================= -->
		<?php
			include('helper.php');
			include('header.php');
		?>
		<!-- ==================================
		================== End Headers Includes -->
		
		<!-- Start Page Struture ==============
		======================================= -->
		<?php include('contato/structure.php'); ?>
		<!-- ==================================
		===================== End Page Struture -->	

		<!-- Start Footers Includes ===========
		======================================= -->
		<?php
			include('footer.php');
			include('commum-js-css.php');
			include('lastScript.php');
		?>
		<!-- ==================================
		================== End Footers Includes -->
		<script type="text/javascript" src="<?php base_url('js/solutions.js','js') ?>"></script>

		<script>

			document.querySelector('body').classList.add('wall');

			document.getElementById('contact-area').style.marginTop = document.getElementById('header').offsetHeight/2 + 'px';

		</script>

		
<script>

	if (window.innerWidth < 999) {	

		setTimeout(() => {

			var Headder = document.getElementById('header'); 

			var Offset = document.getElementById('offset'); 

			Headder.querySelector('.icon-bar .fa-bars').addEventListener('click', () => {
				
				document.getElementById('primary-menu').classList.toggle('closed');

			});

			Offset.style.height = Headder.offsetHeight  + 'px';
			
		}, 500);
		
	}

</script>