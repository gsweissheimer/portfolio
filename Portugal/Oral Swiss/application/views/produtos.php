<!DOCTYPE html>
    <html lang="en">
		<!-- Start Headers Includes ===========
		======================================= -->
		<?php
            require_once 'includes/generateAllInfo.php';
			include('helper.php');			
			include('header.php');
			$traducoes = array();					
			switch ($active_submenu) {
				case 'ali':
					$traducoes['texto1']	 =  alinhadores_banner_text_1;
					$traducoes['texto2']	 =  alinhadores_banner_text_2a;
					$traducoes['texto3']	 =  alinhadores_banner_text_2b;
					$traducoes['texto1a']    =  alinhadores_banner_text_1a;

					$traducoes['cta_1']      =  alinhadores_cta1;
					$traducoes['cta_2']      =  cta_sessao_2;
					$traducoes['cta_3']      =  alinhadores_cta1;
					$traducoes['fundo_s_3']  =  "background-image: url('../assets/img/produtos/banner-vermelho.png')";  

					break;
				case 'cdeo':
					$traducoes['texto1']     =  cdeo_banner_text_1;
					$traducoes['texto2']     =  cdeo_banner_text_2a;
					$traducoes['texto3']     =  cdeo_banner_text_2b;
					

					$traducoes['cta_1']      =  cdeo_cta1;
					$traducoes['cta_2']      =  cta_sessao_2;
					$traducoes['cta_3']      =  alinhadores_cta1;
					$traducoes['fundo_s_3']  =  "background-image: url('../assets/img/produtos/banner-vermelho_cdo.png')";
					break;
				case 'dsd':
					$traducoes['texto1']     =  dsd_banner_text_1;
					$traducoes['texto2']     =  dsd_banner_text_2a;
					$traducoes['texto3']     =  dsd_banner_text_2b;
					

					$traducoes['cta_1']      =  alinhadores_cta1;
					$traducoes['cta_2']      =  cta_sessao_2;
					$traducoes['cta_3']      =  alinhadores_cta1;
					$traducoes['fundo_s_3']  =  "background-image: url('../assets/img/produtos/banner-vermelho_dsd.png')";
					break;
				case 'fac':
					$traducoes['texto1']     =  fac_banner_text_1;
					$traducoes['texto2']     =  fac_banner_text_2a;
					$traducoes['texto3']     =  fac_banner_text_2b;
					

					$traducoes['cta_1']      =  alinhadores_cta1;/*cdeo_cta1;*/
					$traducoes['cta_2']      =  cta_2_fac;
					$traducoes['cta_3']      =  alinhadores_cta1;
					$traducoes['fundo_s_3']  =  "background-image: url('../assets/img/produtos/banner-vermelho_fac.png')";
					break;
				case 'cor':
					$traducoes['texto1']     =  cor_banner_text_1;
					$traducoes['texto2']     =  cor_banner_text_2a;
					$traducoes['texto3']     =  cor_banner_text_2b;
					

					$traducoes['cta_1']      =  alinhadores_cta1;/*cdeo_cta1;*/
					$traducoes['cta_2']      =  cta_2_fac;
					$traducoes['cta_3']      =  alinhadores_cta1;
					$traducoes['fundo_s_3']  =  "background-image: url('../assets/img/produtos/banner-vermelho_cor.png')";
					break;
				case 'imp':
					$traducoes['texto1']     =  imp_banner_text_1;
					$traducoes['texto2']     =  imp_banner_text_2a;
					$traducoes['texto3']     =  imp_banner_text_2b;
					

					$traducoes['cta_1']      =  alinhadores_cta1;
					$traducoes['cta_2']      =  cta_2_imp;
					$traducoes['cta_3']      =  alinhadores_cta1;
					$traducoes['fundo_s_3']  =  "background-image: url('../assets/img/produtos/banner-vermelho_imp.png')";
					break;
				case 'pro':
					$traducoes['texto1']     =  pro_banner_text_1;
					$traducoes['texto2']     =  pro_banner_text_2a;
					$traducoes['texto3']     =  pro_banner_text_2b;
					

					$traducoes['cta_1']      =  alinhadores_cta1;
					$traducoes['cta_2']      =  cta_2_imp;
					$traducoes['cta_3']      =  alinhadores_cta1;
					$traducoes['fundo_s_3']  =  "background-image: url('../assets/img/produtos/banner-vermelho_pro.png')";
					break;
				
				default:
					# code...
					break;
			}

			$this->data['traducoes']  = $traducoes;			
			
		?>
		<!-- ==================================
		================== End Headers Includes -->
		<!-- Start Page Struture ==============
		======================================= -->
		<?php include('produtos/structure.php'); ?>
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

    <script type="text/javascript">

    	var link = window.location.href.split("/");


    	if(link.length === 7) {

    		var topPosition = document.getElementById(link[6]).offsetTop;
    		
    		setTimeout(() => {

    			window.scrollTo(0,topPosition);

    		}, 500)

    	}
    </script>