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
		<?php include('suporte/structure.php'); ?>
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

    	let aberto_ageng=0;
    	let aberto_fale =0;

    	$('.form-agendamento').show();
        aberto_ageng = 1;
       

        $(document).on('click', '#ageng', function(){

            if(aberto_fale){

               $('.form-fale-conosco').hide();
               aberto_fale = 0; 
               $('#ico2').removeClass('icom-opem');
               $('#ico2').addClass('icom-closed');  

               $('#fale').removeClass('item-fale-aberto');
               $('#fale').addClass('item-fale-fechado'); 

               $('.animatio-div').removeClass('entry');
               $('.animatio-div').addClass('invisible');                        

        	}
        	
        	if(aberto_ageng){

               $('.form-agendamento').hide();
               aberto_ageng = 0;

               $('#ico1').removeClass('icom-opem');
               $('#ico1').addClass('icom-closed');
               $('#ageng').removeClass('item-agend-aberto');
               $('#ageng').addClass('item-agend-fechado');
               

        	}else{

        		$('.form-agendamento').show();
        		aberto_ageng = 1;
        		$('#ico1').addClass('icom-opem');

            $('#ico1').removeClass('icom-closed');
            $('#ageng').removeClass('item-agend-fechado');
            $('#ageng').addClass('item-agend-aberto');

            var timeOUT = 600;
            $('.animatio-div').each(function() {
            
              var changeThis = $(this);

              setTimeout(function(){

                Animar(changeThis);

              }, timeOUT);

              timeOUT += 600;


            });



        	}

        	if(aberto_ageng ==0 && aberto_fale==0){

        		$('.btn-container').addClass('spacing');
            $('.animatio-div').removeClass('entry');
            $('.animatio-div').addClass('invisible');


        	}else {
        		$('.btn-container').removeClass('spacing');
        	}

        });

        $(document).on('click', '#fale', function(){

        	if(aberto_ageng){
               
               $('.form-agendamento').hide();
               aberto_ageng = 0;
               $('#ico1').removeClass('icom-opem');
               $('#ico1').addClass('icom-closed');

               $('#ageng').removeClass('item-agend-aberto');
               $('#ageng').addClass('item-agend-fechado');

               $('.animatio-div').removeClass('entry');
               $('.animatio-div').addClass('invisible');


        	}

        	if(aberto_fale){

               $('.form-fale-conosco').hide();
               aberto_fale = 0;
               $('#ico2').removeClass('icom-opem');
               $('#ico2').addClass('icom-closed');

               $('#fale').removeClass('item-fale-aberto');
               $('#fale').addClass('item-fale-fechado');
               

        	}else{

        		$('.form-fale-conosco').show();
        		aberto_fale = 1;
        		$('#ico2').addClass('icom-opem');
            $('#ico2').removeClass('icom-closed');

            $('#fale').removeClass('item-fale-fechado');
            $('#fale').addClass('item-fale-aberto');

             var timeOUTs = 300;
            $('.animatio-div').each(function() {
            
              var changeThis = $(this);

              setTimeout(function(){

                Animar(changeThis);

              }, timeOUTs);

              timeOUTs += 300;


            });



        	}

        	if(aberto_ageng ==0 && aberto_fale==0){

        		$('.btn-container').addClass('spacing');
            $('.animatio-div').removeClass('entry');
            $('.animatio-div').addClass('invisible');

        	}else {
        		$('.btn-container').removeClass('spacing');
        	}

        });

        var timeOUT = 600;

         $('.animatio-div').each(function() {
            
            var changeThis = $(this);

            setTimeout(function(){

              Animar(changeThis);

            }, timeOUT);

            timeOUT += 600;


          });


         var Animar = function(_this) {

            _this.addClass('entry');
            _this.removeClass('invisible');   
            
        }


        /*----------------codigo pais contanto fale connosco-------------------------*/
        $('#pais').on("change",function(ev){
           var cod = $(this).val();
           $('#cod').val(cod);
          
        });

        /*-------------------------progrmamcion del formulario-----------------------------------*/
        $("#form_fale_connosco").on("submit", function(e){
          e.preventDefault();

          console.log("<?=site_url('Send/sendForm')?>");

          //alert('testando el boton');
            $.ajax({
              type:"POST",
              url: "<?=site_url("Send/sendForm")?>",
              async: true,
              dataType: "json",
              data : {
                ajax: "1",
                name:         $("#name").val(),
                email:        $("#email").val(),
                phone:        $("#phone").val(),
                description:  $("#description").val()

              },
              success : function(res) {


                  //========cmoienzo=================
                 
                  //alert(res.status);                  

                 if (res.status == 'success') {
                    Swal.fire({
                      type: res.status,
                      title: '<?=message_successo2?>',
                      html: '<?=message_successo?>',
                      onClose: function(){

                        $('#name').val("");
                        $('#email').val("");
                        $('#phone').val("");
                        $('#description').val("");
                        $('#exampleCheck_fc').prop("checked", false);
                      }
                    });
                    
                  } else {
                    Swal.fire({
                      type: res.status,
                      title: '<?=message_falha3?>',
                      html: '<?=message_falha2?>'
                    });
                  }

                  //===============fin===============

                }
            });

        })


    </script>