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
		<?php include('solutions/structure.php'); ?>
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

				window.onload = function() {

					var logoButtons = document.querySelectorAll('#process-flow-solutions .process-flow-nav li a');

					

					var contentElTop = document.querySelector('#process-flow-solutions .tab-content').offsetTop;

					for(const button of logoButtons) {
				
						button.addEventListener('click', function(e) {
							
							window.scrollTo(0,contentElTop);
							
						})

					}

					document.querySelector('body').classList.add('wall');

					var tableHeader = document.getElementById("tableHeader");

					var tableElHeight = tableHeader.parentNode.offsetHeight;

					var buttonsEl = document.getElementById('tablefixed');

					var mobButton = document.getElementById('mobileContratar');

					buttonsEl.style.width = buttonsEl.offsetWidth + 'px';

					tableHeader.style.width = buttonsEl.offsetWidth + 'px';

					var tableHeaderTop = tableHeader.offsetTop - 3;

					var stopPointButtons = tableHeaderTop + (tableElHeight/2);

					var stopPointHeader = tableHeaderTop + (tableElHeight * 0.8);

					window.onscroll = function() {
						
						if (window.scrollY >= tableHeaderTop && window.scrollY <= stopPointButtons) {

							buttonsEl.classList.add('float');

							mobButton.classList.add('float');
							
						} else {

							buttonsEl.classList.remove('float');

						}
						
						if (window.scrollY >= tableHeaderTop && window.scrollY <= stopPointHeader) {

							tableHeader.classList.add('float');
							
						} else {

							tableHeader.classList.remove('float');

							mobButton.classList.remove('float');

						}

					};

				}

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