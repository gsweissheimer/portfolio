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
		<?php include('nossas-clinicas/structure.php'); ?>
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
	    <script type="text/javascript" src="<?php base_url('clinicas.js','js') ?>"></script>

	    </body>
    </html>
    <script type="text/javascript">
    	
    	/*-------------------------progrmamcion del formulario-----------------------------------*/
        $("#form_contato_nosas_clinicas").on("submit", function(e){
          e.preventDefault();

          //alert('testando el boton');
            $.ajax({
              type:"POST",
              url: "<?=site_url("Send/sendForm")?>",
              async: true,
              dataType: "json",
              data : {
                ajax: "1",
                name:         $("#Name_nosas_clinicas").val(),
                email:        $("#Email_nosas_clinicas").val(),
                phone:        $("#Telefone_nosas_clinicas").val(),
                description:  $("#Mensagem_nosas_clinicas").val()

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

                        $('#Name_nosas_clinicas').val("");
                        $('#Email_nosas_clinicas').val("");
                        $('#Telefone_nosas_clinicas').val("");
                        $('#Mensagem_nosas_clinicas').val("");
                        $('#exampleCheck_nosas_clinicas').prop("checked", false);
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