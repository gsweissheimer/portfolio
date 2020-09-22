<?php include_once("includes/session.php");?>
<?php include_once("includes/notifications.php");?>
<?php include_once("../includes/globalVars.php");?>
<?php $_SESSION['mainPage'] = "faqs.php";?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title> SDC | Editar FAQ's Tag</title>
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
          Editar FAQ's Tag
          
        </h1>
        <ol class="breadcrumb">
          <li><a href="index.php"><i class="fa fa-dashboard"></i> Home</a></li>
          <li><a href="faqs.php">FAQ's</a></li>
          <li class="active"><a href="#">Editar Tag</a></li>
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
              <input type="hidden" name="cmdEval" value="editFaqTag">
              <input type="hidden" id="idTag" name="idTag" value="">
              <input type="hidden" id="idCountry" name="idCountry" value="">
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
        //console.log("ONchange", idCountry);
        //return false;
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
        var id = query.split("&").shift().split("=").pop();
        //console.log(query, id);
        //return false;
        xmlhttp.open("GET", "includes/faqs.php?cmdEval=editFaqTranslationForm&id="+id+"&idC=" + idCountry, true);
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
              var query = window.location.search.substring(1);
              var idC = query.split("&").pop().split("=").pop();
              var elem = document.getElementById("country");
              elem.value = idC;
              $(elem).trigger("change");
              $(elem).attr("disabled", true);
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

      function getTagById() {
        var xmlhttp = new XMLHttpRequest();
        xmlhttp.onreadystatechange = function() {
          if (this.readyState == 4 && this.status == 200) {
            var response = this.responseText;
            var viArrayValues = response.split("||");
            //console.log(viArrayValues);
            //return false;
            if(viArrayValues[0] == "true"){
              document.getElementById('tag').value = viArrayValues[1];
            } else {
              //alert("ERRO");
              $.notify("Oppsss... Aconteceu um erro ao tentar ir buscar informação faq!","error");
            }
          }
        };
        var query = window.location.search.substring(1);
        xmlhttp.open("GET", "includes/faqs.php?cmdEval=getFaqTagText&" + query, true);
        xmlhttp.send();
      }

      function setHiddenInputs() {
        var query = window.location.search.substring(1);
        var idTag = query.split("&").shift().split("=").pop();
        var idCountry = query.split("&").pop().split("=").pop();
        //console.log(query, idTag, idCountry);
        document.getElementById("idTag").value = idTag;
        document.getElementById("idCountry").value = idCountry;
      }

      $(document).ready(function() {
          getCountries();
          getTagById();
          setHiddenInputs();
          //$('.select2').select2();
          
          
          //$("#country").select2('val', idC);
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
