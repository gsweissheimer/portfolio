<?php include_once("includes/session.php");?>
<?php include_once("includes/notifications.php");?>
<?php include_once("../includes/globalVars.php");?>
<?php $_SESSION['mainPage'] = "banner.php";?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title> SDC | Administrador </title>
    <?php include_once("includes/head.php");?>
    <link rel="stylesheet" href="assets/plugins/daterangepicker/daterangepicker.css">
    <link rel="stylesheet" href="assets/plugins/select2/select2.min.css">
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
          General
          
        </h1>
        <ol class="breadcrumb">
          <li><a href="index.php"><i class="fa fa-dashboard"></i> Home</a></li>
          <li><a href="config.php">General</a></li>
        </ol>
      </section>

      <!-- Main content -->
      <section class="content">

        <!-- Default box -->
        <div class="box">
          <div class="box-body">
            <form id="formMain" enctype="multipart/form-data" style="margin-bottom:20px;">
              <div class="col-sm-12">
                <div class="form-group col-sm-6">
                  <label>Favicon </label>
                   <input type="file" name="fileToUpload" id="fileToUpload">
                </div>
                <div class="form-group col-sm-6">
                  <label>Favicon Actual</label>
                   <div class="img-responsive" id="favicon">
                    <img src="../assets/img/icon/favicon.ico">
                   </div>
                </div>
                  <div class="form-group col-sm-12">
                    <label>Robots </label>
                     <input type="file" name="robots" id="robots">
                  </div>
                  <div class="form-group col-sm-12">
                    <label>Sitemap </label>
                     <input type="file" name="sitemap" id="sitemap">
                  </div>
              <ul id="navBar" class="nav nav-tabs"></ul>
              <div id="tabContent" class="tab-content"></div>
              <button class="btn btn-right btn-primary">Guardar</button>
              <input type="hidden" name="cmdEval" value="addGeneralInfo">
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
    <script src="assets/plugins/select2/select2.full.min.js"></script>
    <script>


      $(document).on("submit", "form", function(event) {
            event.preventDefault();
            var str = $( "form" ).serialize();
            var url = "includes/general.php";
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

    </script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.11.2/moment.min.js"></script>
    <script src="assets/plugins/daterangepicker/daterangepicker.js"></script>
    <!-- <script src="assets/plugins/ckeditor/ckeditor.js"></script> -->
  </body>
</html>
