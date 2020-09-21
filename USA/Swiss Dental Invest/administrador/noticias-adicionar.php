<?php include_once("includes/session.php");?>
<?php include_once("includes/notifications.php");?>
<?php include_once("../includes/globalVars.php");?>
<?php $_SESSION['mainPage'] = "traducoes.php";?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title> SOM | Adicionar Notícia</title>
    <?php include_once("includes/head.php");?>
    <link rel="stylesheet" href="assets/plugins/daterangepicker/daterangepicker.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
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
          Adicionar Notícia
          
        </h1>
        <ol class="breadcrumb">
          <li><a href="index.php"><i class="fa fa-dashboard"></i>Home</a></li>
          <li><a href="noticias.php">Notícia</a></li>
          <li class="active"><a href="#">Adicionar</a></li>
        </ol>
      </section>

      <!-- Main content -->
      <section class="content">

        <!-- Default box -->
        <div class="box">
          <div class="box-body">
            <form id="addClinic" name="addClinic" method="post" enctype="multipart/form-data" action="includes/news.php" target="_blank" onsubmit="funStartListen()" style="margin-bottom:20px;">
              <div class="form-group col-sm-12">
              <label>País:</label>
              <select class="form-control" id="countryBanner" name="countryBanner" onchange="funGetLanguages()" required>
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
                <div class="form-group col-sm-6">
                  <label>Date:</label>
                   <div class="input-group date">
                     <div class="input-group-addon">
                       <i class="fa fa-calendar"></i>
                     </div>
                     <input type="date" class="form-control pull-right" id="datepicker" name="datepicker">
                   </div>
          			</div>
                <div class="form-group col-sm-6">
                  <label>Highlight?</label>
                   <input type="checkbox" name="highlight" value="1"><br>
          			</div>
                <div class="form-group col-sm-12">
                <label>Tipo:</label>
                <select class="form-control" id="typeBanner" name="typeBanner" required>
                  <!-- onchange="funGetLanguages()"  -->
                  <option value="Big">Big</option>
                  <option value="Small">Small</option>
                </select>
                  </div>
                  <div class="form-group col-sm-6">
                    <label>Categoria:</label>
                       <input type="text" class="form-control pull-right" id="category" name="category" required>
            			</div>
                  <div class="form-group col-sm-6">
                    <label>Editor:</label>
                       <input type="text" class="form-control pull-right" id="editor" name="editor" required>
            			</div>
                <div class="form-group col-sm-12">
                  <label>Imagem</label>
                  <div class="col-sm-12">
                    <div class="col-sm-6">
                      <span onclick="funOpenGallery(true,og_img,'all')" class="btn btn-success">Choose Image</span>
                      <input type="hidden" id="og_img" name="og_img" class="form-control" value="">
                    </div>
                    <div class="col-sm-6" id="bg_container">
                      <!-- <img id="bg_og_img" name="bg_og_image" src="../" class="img-responsive"> -->
                    </div>
                  </div>
                </div>
                <div id="allInfo"></div>
              <button class="btn btn-right btn-primary">Guardar</button>
              <input type="hidden" id="codOper" name="codOper" value="">
              <input type="hidden" id="idNews" name="idNews" value="">
              <input type="hidden" name="cmdEval" value="addNews">
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
  <?php include_once('gallery.php'); ?>
    <?php include_once("includes/mainjs.php");?>
    <script>
      function funGetLanguages(){
        var countryID = document.getElementById('countryBanner').value;
        event.preventDefault();
        var url = "includes/news.php?cmdEval=getCountryLang&countryId="+countryID;
        $.ajax({
            url: url,
            type: 'POST',
            async: false,
            success: function (data) {
                // alert(data);
                var result = data.split("||");
                if(result[0] == "true"){
                  document.getElementById("allInfo").innerHTML = result[1];
                  funStartEditor();
                  funNewRef("idNews");
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
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.11.2/moment.min.js"></script>
    <script src="assets/plugins/daterangepicker/daterangepicker.js"></script>
    <!-- <script src="assets/plugins/ckeditor/ckeditor.js"></script> -->
  </body>
</html>
