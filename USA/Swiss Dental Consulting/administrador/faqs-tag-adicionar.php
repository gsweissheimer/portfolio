<?php include_once("includes/session.php");?>
<?php include_once("includes/notifications.php");?>
<?php include_once("../includes/globalVars.php");?>
<?php $_SESSION['mainPage'] = "faqs.php";?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title> SDC | Adicionar FAQ's Tag</title>
    <?php include_once("includes/head.php");?>
    <link rel="stylesheet" href="assets/plugins/daterangepicker/daterangepicker.css">
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
          Adicionar FAQ's Tag
          
        </h1>
        <ol class="breadcrumb">
          <li><a href="index.php"><i class="fa fa-dashboard"></i> Home</a></li>
          <li><a href="faqs.php">FAQ's</a></li>
          <li class="active"><a href="#">Adicionar Tag</a></li>
        </ol>
      </section>

      <!-- Main content -->
      <section class="content">

        <!-- Default box -->
        <div class="box">
          <div class="box-body">
            <form id="formMain" enctype="multipart/form-data" style="margin-bottom:20px;">
              <div class="col-xs-6">
                <div class="form-group col-sm-4">
                  <label>País:</label>
                  <select id="country" name="country" class="form-control" style="width:100%" required>
                  </select>
                </div>
              </div>
              <div class="col-xs-6">
                <div class="form-group col-sm-4">
                  <label>FAQ's Tag:</label>
                  <input type="" id="tag" name="tag" value="" required>
                </div>
              </div>
              <!--<ul id="navBar" class="nav nav-tabs"></ul>
              <div id="tabContent" class="tab-content"></div>-->
              <div class="col-xs-12">
                <div id="allInfo"></div>
              </div>
              <button class="btn btn-right btn-primary">Guardar</button>
              <input type="hidden" name="cmdEval" value="addFAQTag">
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

      $('#country').on('change', function() {
        var idCountry = this.value;
        var xmlhttp = new XMLHttpRequest();
        xmlhttp.onreadystatechange = function() {
          if (this.readyState == 4 && this.status == 200) {
            var response = this.responseText;
            //console.log(response);
            //return false;
            var viArrayValues = response.split("||");
            if(viArrayValues[0] == "true"){
              //document.getElementById("navBar").innerHTML = viArrayValues[1];
              //document.getElementById("tabContent").innerHTML = viArrayValues[2];
              //document.getElementById("position").innerHTML = viArrayValues[3];
              //$("#btnSave").removeClass("disabled");
              document.getElementById("allInfo").innerHTML = viArrayValues[1];
              funStartEditor();
            }else{
                $.notify("Oppsss... Something happens!","error");
            }
          }
        };
        var query = window.location.search.substring(1);
        xmlhttp.open("GET", "includes/faqs.php?cmdEval=getFaqTranslationForm&idC=" + idCountry, true);
        xmlhttp.send();
      });

      function getCountries() {
        var xmlhttp = new XMLHttpRequest();
        xmlhttp.onreadystatechange = function() {
          if (this.readyState == 4 && this.status == 200) {
            var response = this.responseText;
            var viArrayValues = response.split("||");
            //console.log(viArrayValues);
            if(viArrayValues[0] == "true"){
              document.getElementById('country').innerHTML = viArrayValues[1];
            } else {
              //alert("ERRO");
              $.notify("Oppsss... Aconteceu um erro ao tentar ir buscar informação faq!","error");
            }
          }
        };
        var query = window.location.search.substring(1);
        xmlhttp.open("GET", "includes/faqs.php?cmdEval=getCountries&" + query, true);
        xmlhttp.send();
      }

      $(document).ready(function() {
          getCountries();
          //$('.select2').select2();
      });

      $(document).on("submit", "form", function(event) {
            event.preventDefault();
            var str = $( "form" ).serialize();
            var url = "includes/faqs.php";
            var formData = new FormData($(this)[0]);
            $.ajax({
                url: url,
                type: 'POST',
                data: formData,
                async: false,
                success: function (data) {
                    //console.log(data);
                    //return false;
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
