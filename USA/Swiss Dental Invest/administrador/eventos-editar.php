<?php include_once("includes/session.php");?>
<?php include_once("includes/notifications.php");?>
<?php include_once("../includes/globalVars.php");?>
<?php $_SESSION['mainPage'] = "traducoes.php";?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title> GLL | Editar Evento</title>
    <?php include_once("includes/head.php");?>
    <link rel="stylesheet" href="assets/plugins/daterangepicker/daterangepicker.css">
    <link rel="stylesheet" href="assets/plugins/select2/select2.min.css">
        <style>
      .select2-container--default .select2-selection--single .select2-selection__rendered{line-height: 22px;}
      .marg-top-20{margin-top: 10px;}
      .marg-bottom-20{margin-bottom: 10px;}
      .pad-none{padding: 0px;}
      .f-left{float: left;}
      .f-right{float: right;}
      /*.img {width:auto;max-height:140px;overflow:hidden;}*/
    </style>
    <script src="https://cloud.tinymce.com/stable/tinymce.min.js"></script>
  <script>tinymce.init({ selector:'textarea' });</script>
  </head>
  <body class="hold-transition skin-blue sidebar-mini">
    <?php include_once("includes/header.php");?>
    <?php include_once("includes/menubar.php");?>
    <!-- =============================================== -->

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
      <!-- Content Header (Page header) -->
      <section class="content-header">
        <h1>
          Editar Evento
          
        </h1>
        <ol class="breadcrumb">
          <li><a href="index.php"><i class="fa fa-dashboard"></i> Home</a></li>
          <li><a href="slides.php">Eventos</a></li>
          <li class="active"><a href="#">Editar Clinica</a></li>
        </ol>
      </section>

      <!-- Main content -->
      <section class="content">

        <!-- Default box -->
        <div class="box">
          <div class="box-body">
            <form id="addEvent1" name="addEvent1" enctype="multipart/form-data" style="margin-bottom:20px;">
              <div class="form-group">
                <label>Imagem</label>
                <input type="file" name="fileToUpload" id="fileToUpload">
              </div>
                <div class="col-xs-12">
                  <div class="form-group">
                    <label>Data</label>
                    <input type="date" class="form-group form-control" name="eventDate" id="eventDate">
                  </div>
                </div>
                <div class="col-xs-12">
                  <div class="form-group">
                	   <label>Localização: </label>
                     <select  id="transcode" name="transcode" class="form-control select2 select2-hidden-accessible" style="width: 65%;" aria-hidden="true" id="client" name="client" required>
                     <option value="">Localização</option><?php
                      include_once(PATH_DATABASE);
                      $db = Database::getInstance();
                      $connection = $db->getConnection();
                      $sqlCmd = "SELECT
                                tb_translations.value,
                                tb_translations_codes.id
                                FROM
                                tb_translations
                                JOIN tb_translations_codes ON tb_translations.idTbCodeTranslations = tb_translations_codes.id
                                JOIN tb_language ON tb_language.id = tb_translations.idTbLanguage
                                WHERE tb_language.langMin= 'PT'";
                      $values = "";
                      if ($result = $connection->query($sqlCmd)) {
                        while($rsData = mysqli_fetch_assoc($result)){
                          echo '<option value="'.$rsData['id'].'">'.$rsData['value'].'</option>';
                        }
                      }
                    ?>
                  </select>
                  <!-- <button id="btnModalTrans" class="btn btn-primary">+</button> -->
                </div>
              </div>
              <ul id="navBar" class="nav nav-tabs"></ul>
              <div id="tabContent" class="tab-content"></div>
              <button class="btn btn-right btn-primary">Guardar</button>
              <input type="hidden" name="idEvent" value="<?= $_REQUEST['id'] ?>">
              <input type="hidden" name="cmdEval" value="editEvent">
              <input type="hidden" name="bot" value="">
            </form>
          </div>
          <!-- /.box-body -->
        </div>
        <!-- /.box -->

      </section>
      <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->
    <?php include_once("includes/footer.php");?>
  </div>
  <!-- ./wrapper -->
    <?php include_once("includes/mainjs.php");?>
    <script>
      $(document).ready(function() {
        funCreateItems();
      });

      function funCreateItems(){
          var xmlhttp = new XMLHttpRequest();
          xmlhttp.onreadystatechange = function() {
              if (this.readyState == 4 && this.status == 200) {
                  var response = this.responseText;
                  var viArrayValues = response.split("||");
                  if(viArrayValues[0] == "true"){
                      document.getElementById("navBar").innerHTML = viArrayValues[1];
                      document.getElementById("tabContent").innerHTML = viArrayValues[2];
                      document.getElementById("eventDate").value = viArrayValues[3];
                      document.getElementById("transcode").value = viArrayValues[4];
                      $(function () {
                        $(".select2").select2();
                      });
                      funStartEditor();
                      // $("textarea").wysihtml5({
                      //   toolbar: {
                      //     "font-styles": false, //Font styling, e.g. h1, h2, etc. Default true
                      //     "emphasis": true, //Italics, bold, etc. Default true
                      //     "lists": false, //(Un)ordered lists, e.g. Bullets, Numbers. Default true
                      //     "html": true, //Button which allows you to edit the generated HTML. Default false
                      //     "link": true, //Button to insert a link. Default true
                      //     "image": false, //Button to insert an image. Default true,
                      //     "color": false, //Button to change color of font
                      //     "blockquote": false
                      //   }
                      // });
                  }else{
                      //alert("ERRO");
                      $.notify("Oppsss... Aconteceu um erro ao tentar ir buscar informação tradução!","error");
                  }
              }
          };
          var query = window.location.search.substring(1);
          xmlhttp.open("GET", "includes/getInformation.php?cmdEval=eventInfo&" + query, true);
          xmlhttp.send();
      }

      $(document).on("submit", "form", function(event) {
            event.preventDefault();
            var str = $( "form" ).serialize();
            var url = "includes/editInformation.php";
            var formData = new FormData($(this)[0]);
            $.ajax({
                url: url,
                type: 'POST',
                data: formData,
                async: false,
                success: function (data) {
                    // alert(data);
                    var result = data.split("||");
                    if(result[0] == "true"){
                        $.notify(result[1],"success");
                        setTimeout(function(){ location.reload(); }, 2000);
                    }else{
                        $.notify(result[1],"error");
                    }
                },
                error: function(chr, desc, err){
                  $.notify("Oppsss... Aconteceu um erro ao tentar adicionar tradução!","error");
                },
                cache: false,
                contentType: false,
                processData: false
            });

            return false;
        });

        function funDeleteImage(vfID){
            if (confirm('Tem a certeza que pertende eliminar esta clinica')) {
                var xmlhttp = new XMLHttpRequest();
                xmlhttp.onreadystatechange = function() {
                    if (this.readyState == 4 && this.status == 200) {
                        var response = this.responseText;
                        var result = response.split("||");
                        if(result[0] == "true"){
                            $.notify(result[1],"success");
                            location.reload();
                        }else{
                          $.notify(result[1],"error");
                        }
                    }
                };
                xmlhttp.open("GET", "includes/deleteInformation.php?cmdEval=deleteImage&id=" + vfID, true);
                xmlhttp.send();
            }
        }



    </script>
    <script src="assets/plugins/select2/select2.full.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.11.2/moment.min.js"></script>
    <script src="assets/plugins/daterangepicker/daterangepicker.js"></script>
    <!-- <script src="assets/plugins/ckeditor/ckeditor.js"></script> -->
  </body>
</html>
