<?php include_once("includes/session.php");?>
<?php include_once("includes/notifications.php");?>
<?php include_once("../includes/globalVars.php");?>
<?php $_SESSION['mainPage'] = "features.php";?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title> SDC | Editar Parceiros</title>
    <?php include_once("includes/head.php");?>
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
          Editar Parceiros
          
        </h1>
        <ol class="breadcrumb">
          <li><a href="index.php"><i class="fa fa-dashboard"></i> Home</a></li>
          <li><a href="parceiros.php">Parceiros</a></li>
          <li class="active"><a href="#">Editar</a></li>
        </ol>
      </section>

      <!-- Main content -->
      <section class="content">

        <!-- Default box -->
        <div class="box">
          <div class="box-body">
            <form id="frmFaq" enctype="multipart/form-data" style="margin-bottom:20px;">
              <div class="col-xs-12">
                <div class="form-group col-sm-12">
                <label>País:</label>
                <select class="form-control bo-disabled" id="country" name="country" onchange="funGetLanguages()"  required>
                  <option value="">Selecionar</option>
                  <?php
                    include_once(PATH_DATABASE);
                    $db = Database::getInstance();
                    $connection = $db->getConnection();
                    $sqlCmd = "SELECT
                                id, country
                                FROM
                                tb_country
                                WHERE status=1";
                    $values = "";
                    if ($result = $connection->query($sqlCmd)) {
                      while($rsData = mysqli_fetch_assoc($result)){
                        echo '<option value="'.$rsData['id'].'">'.$rsData['country'].'</option>';
                      }
                    }
                  ?>
                </select>
                  </div>

                  <div class="form-group col-sm-12">
                    <label>Imagem</label>
                    <div class="col-sm-12">
                      <div class="col-sm-6">
                        <span onclick="funOpenGallery(false,og_img,'image')" class="btn btn-success">Choose Image</span>
                        <input type="hidden" id="og_img" name="og_img" class="form-control" value="">
                      </div>
                      <div class="col-sm-6">
                        <img id="bg_og_img" name="bg_og_image" src="../" class="img-responsive">
                      </div>
                    </div>
                  </div>

                <div class="form-group col-sm-12">
                  <label>Posição:</label>
                  <input type="text" name="position" id="position">
                </div>
              </div>



              <div id="allInfo"></div>
              <button class="btn btn-right btn-primary">Guardar</button>
              <input type="hidden" name="cmdEval" value="editPartner">
              <input type="hidden" name="idAdvantage" value="<?= $_REQUEST['id'] ?>">
              <input type="hidden" name="idAdvantageTag" value="1">
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
  <?php include_once ("gallery.php"); ?>
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
                    document.getElementById("allInfo").innerHTML = viArrayValues[1];
                    document.getElementById("country").value = viArrayValues[2];
                    document.getElementById("position").value = viArrayValues[3];
                    document.getElementById("og_img").value = viArrayValues[4];

                  }else{
                      //alert("ERRO");
                      $.notify("Oppsss... Aconteceu um erro ao tentar ir buscar informação advantage!","error");
                  }
              }
          };
          var query = window.location.search.substring(1);
          xmlhttp.open("GET", "includes/partners.php?cmdEval=getPartner&" + query, true);
          xmlhttp.send();
      }

      $(document).on("submit", "form", function(event) {
            event.preventDefault();
            var str = $( "form" ).serialize();
            var url = "includes/partners.php";
            var formData = new FormData($(this)[0]);
            $.ajax({
                url: url,
                type: 'POST',
                data: formData,
                async: false,
                success: function (data) {
                    var response = data.split("||");
                    if(response[0] == "true"){
                        $.notify(response[1],"success");
                        setTimeout(function(){location.href="parceiros.php"} , 2000);
                    }else{
                        $.notify(response[1],"error");
                    }
                },
                error: function(chr, desc, err){
                  $.notify("Oppsss... Aconteceu um problema!","error");
                },
                cache: false,
                contentType: false,
                processData: false
            });

            return false;
        });

        function funGetLanguages(){
          var countryID = document.getElementById('country').value;
          event.preventDefault();
          var url = "includes/partners.php?cmdEval=getCountryLang&countryId="+countryID;
          $.ajax({
              url: url,
              type: 'POST',
              async: false,
              success: function (data) {
                  // alert(data);
                  var result = data.split("||");
                  if(result[0] == "true"){
                    document.getElementById("allInfo").innerHTML = result[1];
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
        }

    </script>
  </body>
</html>
