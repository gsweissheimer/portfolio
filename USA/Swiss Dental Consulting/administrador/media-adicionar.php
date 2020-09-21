<?php include_once("includes/session.php");?>
<?php include_once("includes/notifications.php");?>
<?php include_once("../includes/globalVars.php");?>
<?php $_SESSION['mainPage'] = "traducoes.php";?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title> GLL | Adicionar Video</title>
    <?php include_once("includes/head.php");?>
    <link rel="stylesheet" href="assets/css/bootstrap-datepicker.css">
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
          Adicionar Video
          
        </h1>
        <ol class="breadcrumb">
          <li><a href="index.php"><i class="fa fa-dashboard"></i>Home</a></li>
          <li><a href="media.php">Media</a></li>
          <li class="active"><a href="#">Adicionar</a></li>
        </ol>
      </section>

      <!-- Main content -->
      <section class="content">

        <!-- Default box -->
        <div class="box">
          <div class="box-body">
            <form id="addTestimonial" name="addTestimonial" enctype="multipart/form-data" style="margin-bottom:20px;">
              <div class="form-group col-sm-6">
    			       <label>Country</label>
    			       <select class="form-control" id="countryBanner" name="countryBanner">
    			       </select>
        			</div>
              <div class="form-group col-sm-6">
    			       <label>Media Type</label>
    			       <select class="form-control" id="mediaType" name="mediaType">
    			       </select>
        			</div>
              <div class="form-group col-sm-12">
    			       <label>Title:</label>
    			       <input class="form-control"  id="nome" name="name" required>
        			</div>
              <div class="form-group col-sm-12">
                <label>Date:</label>
                 <div class="input-group date">
                   <div class="input-group-addon">
                     <i class="fa fa-calendar"></i>
                   </div>
                   <input type="text" class="form-control pull-right" id="datepicker" name="datepicker">
                 </div>
        			</div>
              <div class="form-group col-sm-12">
                 <label>Video</label>
                 <ul id="navBar" class="nav nav-tabs"></ul>
                 <div id="tabContent" class="tab-content"></div>
              </div>
              <button id="btnSave" class="btn btn-right btn-primary disabled">Guardar</button>
              <input type="hidden" name="cmdEval" value="addTestimonial">
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
      $('#countryBanner').on('change', function() {
        var idCountry = this.value;
        var xmlhttp = new XMLHttpRequest();
        xmlhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                var response = this.responseText;
                var viArrayValues = response.split("||");
                if(viArrayValues[0] == "true"){
                  document.getElementById("navBar").innerHTML = viArrayValues[1];
                  document.getElementById("tabContent").innerHTML = viArrayValues[2];
                  $("#btnSave").removeClass("disabled");
                }else{
                    $.notify("Oppsss... Something happens!","error");
                }
            }
        };
        var query = window.location.search.substring(1);
        xmlhttp.open("GET", "includes/testimonials.php?cmdEval=getTestimonialsNew&countryBanner=" + idCountry, true);
        xmlhttp.send();
      })

      $(document).ready(function() {
        funCreateItems();
        $('#datepicker').datepicker({
           autoclose: true
         })
      });

      function funCreateItems(){
          var xmlhttp = new XMLHttpRequest();
          xmlhttp.onreadystatechange = function() {
              if (this.readyState == 4 && this.status == 200) {
                  var response = this.responseText;
                  var viArrayValues = response.split("||");
                  if(viArrayValues[0] == "true"){
                      document.getElementById("countryBanner").innerHTML = viArrayValues[1];
                      document.getElementById("mediaType").innerHTML = viArrayValues[2];
                  }else{
                      $.notify("Oppsss... Something happens!","error");
                  }
              }
          };
          var query = window.location.search.substring(1);
          xmlhttp.open("GET", "includes/testimonials.php?cmdEval=getTestimonialsCountry&" + query, true);
          xmlhttp.send();
      }

      $('form[name=addTestimonial]').submit(function(e) {
        e.preventDefault();
        var url = "includes/testimonials.php";
        var form1 = $('#addTestimonial');
        var formData = new FormData($(this)[0]);
        $.ajax({
          type: "POST",
          url: url,
          data: formData,
          async: true,
          success: function (data) {
            var response = data.split("||");
            if(response[0] == "true"){
              $.notify(response[1],"success");
              document.getElementById("addTestimonial").reset();
            }
          },
          error: function(chr, desc, err){
            $.notify(response[1],"error");
          },
          cache: false,
          contentType: false,
          processData: false
        });
      });

    </script>

    <!-- <script src="assets/plugins/ckeditor/ckeditor.js"></script> -->
  </body>
</html>
