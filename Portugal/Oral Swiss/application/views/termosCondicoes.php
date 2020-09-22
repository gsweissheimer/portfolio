<!DOCTYPE html>
    <html lang="en">
		<!-- Start Headers Includes ===========
		======================================= -->
		<?php
            require_once 'includes/generateAllInfo.php';
			include('helper.php');			
			include('header.php');						
			
		?>
		<!-- ==================================
		================== End Headers Includes -->
		<!-- Start Page Struture ==============
		======================================= -->
		<?php include('termosCondicoes/structure.php'); ?>
		<!-- ==================================
		===================== End Page Struture -->	
		<!-- Start Footers Includes ===========
		======================================= -->
		<?php
			include('footer.php');
			include('commum-js.php');
		?>
		<!-- ==================================
		================== End Footers Includes -->
	    <script type="text/javascript" src="<?php base_url('produtos.js','js') ?>"></script>

	    </body>
    </html>
    
    <script>

        var lang = getCookie('lang');

        switch (lang) {
            case 'PT':
                openContent('lang-pt');
                break;
            case 'FR':
                openContent('lang-fr');
                break;
            default:
                openContent('lang-en');
                break;
        }

        function openContent(classs) {

            document.querySelector('h1.'+classs).classList.remove('neverShowMe');
            document.querySelector('div.'+classs).classList.remove('neverShowMe');
            
        }

    </script>