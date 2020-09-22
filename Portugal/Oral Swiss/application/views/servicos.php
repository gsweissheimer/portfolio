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
		<?php include('servicos/structure.php'); ?>
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
	    <script type="text/javascript" src="<?php base_url('odontologia.js','js') ?>"></script>

	    </body>
    </html>

    <script type="text/javascript">
    	
    	/*-------------------------progrmamcion del formulario-----------------------------------*/
        $("#form_contato_servicos").on("submit", function(e){
          e.preventDefault();

          //alert('testando el boton');
            $.ajax({
              type:"POST",
              url: "<?=site_url("Send/sendForm")?>",
              async: true,
              dataType: "json",
              data : {
                ajax: "1",
                name:         $("#Name_servico").val(),
                email:        $("#Email_servico").val(),
                phone:        $("#Telefone_servico").val(),
                description:  $("#Mensagem_servico").val()

              },
              success : function(res) {


                  //========cmoienzo=================
                 
                  //alert(res.status);                  

                 if (res.status == 'success') {
                    Swal.fire({
                      type: res.status,
                      title: 'Sucesso!',
                      html: '<?=message_successo?>',
                      onClose: function(){

                        $('#Name_servico').val("");
                        $('#Email_servico').val("");
                        $('#Telefone_servico').val("");
                        $('#Mensagem_servico').val("");
                        $('#exampleCheck_servico').prop("checked", false);
                      }
                    });
                    
                  } else {
                    Swal.fire({
                      type: res.status,
                      title: 'Falha!',
                      html: '<?=message_falha?>'
                    });
                  }

                  //===============fin===============

                }
            });

        })

    	/*var link = window.location.href.split("/");
    	link  = link[link.length - 1];
        
        console.log(link);

    	if(link != 'servicos') {

    		var topPosition = $('#'+link).offset().top;//document.getElementById(link).offsetTop;

    		console.log(topPosition);

            $('html,body').animate({scrollTop:topPosition}, 4100);

    		//setTimeout(() => {

    			//window.scrollTo(0,topPosition);

    		//}, 700)

    	}*/

       
        /*window.addEventListener('scroll', () => {  

            var scroll = $('#carousel-servicos').offset().top;
		    if (window.scrollY > scroll-200) {
		        
		        $('#servicos-1').addClass('modo-mobil');
		        $('.owl-prev').addClass('show');
		        $('.owl-next').addClass('show');


		    } else {

		        $('#servicos-1').removeClass('modo-mobil');
		        $('.owl-prev').removeClass('show');
		        $('.owl-next').removeClass('show');

		    }


		})*/

    </script>