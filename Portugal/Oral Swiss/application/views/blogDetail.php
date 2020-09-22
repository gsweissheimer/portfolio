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
		<?php include('blog/structureDetail.php'); ?>
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
        $("#form_contato_blog").on("submit", function(e){
          e.preventDefault();

           $("#btn_form_contact_blog").prop("disabled", true);
          //alert('testando el boton');
            $.ajax({
              type:"POST",
              url: "<?=site_url("Send/sendForm")?>",
              async: true,
              dataType: "json",
              data : {
                ajax: "1",
                name:         $("#Name_blog").val(),
                email:        $("#Email_blog").val(),
                phone:        $("#Telefone_blog").val(),
                description:  $("#Mensagem_blog").val()

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

                        $('#Name_blog').val("");
                        $('#Email_blog').val("");
                        $('#Telefone_blog').val("");
                        $('#Mensagem_blog').val("");
                        $('#exampleCheck_blog').prop("checked", false);
                        $("#btn_form_contact_blog").prop("disabled", false);
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