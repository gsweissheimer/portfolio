<?php include_once("includes/session.php");?>
<?php include_once("includes/notifications.php");?>
<?php include_once("../includes/globalVars.php");?>
<?php $_SESSION['mainPage'] = "Packages.php";?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title> GLL | Adicionar Packages</title>
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
          Adicionar Packages
          
        </h1>
        <ol class="breadcrumb">
          <li><a href="index.php"><i class="fa fa-dashboard"></i> Home</a></li>
          <li><a href="Packages.php">Packages</a></li>
          <li class="active"><a href="#">Adicionar</a></li>
        </ol>
      </section>

      <!-- Main content -->
      <section class="content">

        <!-- Default box -->
        <div class="box">
          <div class="box-body">
            <form id="frmFaq" enctype="multipart/form-data" style="margin-bottom:20px;">
              <div class="col-xs-12">
                <div class="form-group col-sm-3">
                  <label>Country:</label>
                  <select class="form-control color-black" id="country" name="country">
                  </select>
                </div>
                <div class="form-group col-sm-3" style="white-space: nowrap; margin-top: 30px;">
                      <input type="checkbox" class="form-check-input" name="vcRecomended" value="1"><label style="padding-left: 0.4em;">Make it recomended</label>
                </div>
              </div>
              <div class="col-xs-12">
                <div class="form-group col-sm-3">
                  <label>Tag:</label>
                  <select class="form-control" id="tagType" name="tagType">
                  </select>
                </div>
                <div class="form-group col-sm-3">
                  <label>Position:</label>
                  <select class="form-control" id="position" name="position">
                  </select>
                </div>
                <div class="form-group col-sm-6">
                  <div class="col-sm-4">
                   <label>Choose Image:</label>
                   <span onclick="funOpenGallery(false,og_img,<?=GALLERY_IMAGE?>)" class="form-control btn btn-success">Gallery</span>
                   <input type="hidden" id="og_img" name="og_image" class="form-control">
                  </div>
                  <div class="col-sm-8">
                    <img id="bg_og_img" name="bg_og_image" src=""  class="img-responsive">
                  </div>
                </div>
              </div>
              <ul id="navBar" class="nav nav-tabs"></ul>
              <div id="tabContent" class="tab-content"></div>
              <button id="btnSave" class="btn btn-right btn-primary disabled">Guardar</button>
              <input type="hidden" name="cmdEval" value="addNewPackage">
              <input type="hidden" name="idPackage" value="">
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
    <?php include_once("gallery.php");?>
  </div>
  <!-- ./wrapper -->
    <?php include_once("includes/mainjs.php");?>
    <script>
      $(document).ready(function() {
          funCreateItems();
      });

      $('#country').on('change', function() {
        var idCountry = this.value;
        var xmlhttp = new XMLHttpRequest();
        xmlhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                var response = this.responseText;
                var viArrayValues = response.split("||");
                if(viArrayValues[0] == "true"){
                  document.getElementById("navBar").innerHTML = viArrayValues[1];
                  document.getElementById("tabContent").innerHTML = viArrayValues[2];
                  document.getElementById("position").innerHTML = viArrayValues[3];
                  $("#btnSave").removeClass("disabled");
                  funStartEditor();
                }else{
                    $.notify("Oppsss... Something happens!","error");
                }
            }
        };
        var query = window.location.search.substring(1);
        xmlhttp.open("GET", "includes/packages.php?cmdEval=createNewPackage&idCountry=" + idCountry, true);
        xmlhttp.send();
      })

      function funCreateItems(){
          var xmlhttp = new XMLHttpRequest();
          xmlhttp.onreadystatechange = function() {
              if (this.readyState == 4 && this.status == 200) {
                  var response = this.responseText;
                  var viArrayValues = response.split("||");
                  if(viArrayValues[0] == "true"){
                    document.getElementById("country").innerHTML = viArrayValues[1];
                    document.getElementById("tagType").innerHTML = viArrayValues[2];
                      // document.getElementById("tabContent").innerHTML = viArrayValues[2];
                  }else{
                      //alert("ERRO");
                      $.notify("Oppsss... Aconteceu um erro ao tentar ir buscar informação advantage!","error");
                  }
              }
          };
          var query = window.location.search.substring(1);
          xmlhttp.open("GET", "includes/Packages.php?cmdEval=initPackages&" + query, true);
          xmlhttp.send();
      }

      $(document).on("submit", "form", function(event) {
            event.preventDefault();
            var str = $( "form" ).serialize();
            var url = "includes/packages.php";
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
                        document.getElementById("frmFaq").reset();
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

    </script>
  </body>
</html>
