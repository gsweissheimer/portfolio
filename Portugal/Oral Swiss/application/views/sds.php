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
		<?php include('sds/structure.php'); ?>
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

        let count = 0;
        var xposition = $('#divAnimation').position().top - window.outerHeight + ($('#divAnimation').height());
        //var xposition = 0;
        

        window.onscroll =function(){

          //if(document.documentElement.scrollTop >1100){

            //document.querySelector('.go-top-container').classList.add('show');


              if(document.documentElement.scrollTop > xposition && count==0 ){

                var timeOUT = 300;

                     $('.changed').each(function() {

                        var changeThis = $(this);

                         setTimeout(function(){

                            doTheMagic(changeThis);

                         }, timeOUT);

                         timeOUT += 300;


                     });

                    count++;

                }         


          //}
        }


        var doTheMagic = function(_this) {

            const tempo_intervalo = 5;
            const tempo = 2000;

            _this.addClass('cambiar');
            _this.removeClass("hidded");

            let counter = _this.find('.counter-up');
            let count_to = parseInt(counter.data('countTo'));
            let intervalos = tempo / tempo_intervalo; //quantos passos de animação tem
            let incremento = count_to / intervalos; //quanto cada contador deve aumentar
            let valor = 0;
            let el = counter;

            let timer = setInterval(function() {
              if (valor >= count_to){ //se já contou tudo tem de parar o timer
                valor = count_to;
                clearInterval(timer);
              }

              let texto = valor.toFixed(0).toString().replace(/(\d)(?=(\d{3})+(?!\d))/g, "$1.");
              el.text(texto);
              valor += incremento;      
            }, tempo_intervalo);
        }




    </script>