<!DOCTYPE html>
    <html lang="en">
		<!-- Start Headers Includes ===========
		======================================= -->
		<?php
            require_once 'includes/generateAllInfo.php';
			include('helper.php');
			//print_r('el idioma por defecto es: ' . lang);
			include('header.php');
		?>
		<!-- ==================================
		================== End Headers Includes -->
		<!-- Start Page Struture ==============
		======================================= -->
		<?php include('home/structure.php'); ?>
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
	    <script type="text/javascript" src="<?php base_url('home.js','js') ?>"></script>

	    </body>
    </html>
    <script type="text/javascript">
    	
    	/*-------------------------progrmamcion del formulario-----------------------------------*/
        $("#formContact_home").on("submit", function(e){
          e.preventDefault();

          //alert('testando el boton');
            $.ajax({
              type:"POST",
              url: "<?=site_url("Send/sendForm")?>",
              async: true,
              dataType: "json",
              data : {
                ajax: "1",
                name:         $("#name_home").val(),
                email:        $("#email_home").val(),
                phone:        $("#telefone_home").val(),
                description:  $("#description_home").val()

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

                        $('#name_home').val("");
                        $('#email_home').val("");
                        $('#telefone_home').val("");
                        $('#description_home').val("");
                        $('#exampleCheck_home').prop("checked", false);
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

    </script>