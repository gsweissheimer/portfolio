<?php include_once("includes/session.php");?>
<?php include_once("includes/notifications.php");?>
<?php include_once("../includes/globalVars.php");?>
<?php $_SESSION['mainPage'] = "banner.php";?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title> CEROA | Adicionar Paises</title>
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
          Adicionar Paises
          
        </h1>
        <ol class="breadcrumb">
          <li><a href="index.php"><i class="fa fa-dashboard"></i> Home</a></li>
          <li><a href="paises.php">Paises</a></li>
          <li class="active"><a href="#">Adicionar</a></li>
        </ol>
      </section>

      <!-- Main content -->
      <section class="content">

        <!-- Default box -->
        <div class="box">
          <div class="box-body">
            <form id="formMain" enctype="multipart/form-data" style="margin-bottom:20px;">
              <div class="col-sm-12">
                <div class="form-group col-sm-12">
                <label>Nome:</label>
                <input type="text" name="countryName" id="countryName" style="width:100%">
                  </div>
                  <div class="form-group col-sm-4">
                  <label>Abreviatura:</label>
                  <input type="text" name="countryAbb" id="countryAbb" style="width:100%">
                    </div>
                  <div class="form-group col-sm-4">
                  <label>TimeZone:</label>
                  <select class="form-control select2 select2-hidden-accessible" style="width:100%"  id="timezone" name="timezone">
                    <option value="">Selecionar</option>
                  </select>
                  </div>
                  <div class="form-group col-sm-4">
                    <label>Country Code:</label>
                    <select class="form-control select2 select2-hidden-accessible" style="width:100%"  id="countryCode" name="countryCode">
                      <option value="">Selecionar</option>
                    </select>
                  </div>
                  <div id="otpx">
                  </div>
                </div>
              <ul id="navBar" class="nav nav-tabs"></ul>
              <div id="tabContent" class="tab-content"></div>
              <button class="btn btn-right btn-primary">Guardar</button>
              <input type="hidden" name="cmdEval" value="addCountry">
              <input type="hidden" name="bot" value="">
              <input id="total_items" type="hidden" value="" name="total">
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

  <div class="col-xs-12 no-pad-later internal-form my-form hide" style="padding:0px;"  id="goaway" name="xpto">
    <div class="col-lg-4 col-md-6">
      <div class="form-group">
      <label>Idioma:</label>
      <select class="form-control select2 select2-hidden-accessible idiom" id="idiom_" name="idiom_" style="width:100%">
        <option value="">Selecionar</option>
      </select>
      </div>
    </div>

    <div class="col-lg-4 col-md-6">
      <div class="form-group">
        <label>Default</label>
        <select class="form-control select2 select2-hidden-accessible default" id="default_" name="default_" style="width:100%">
          <option value="">Selecionar</option>
          <option value="0">Não</option>
          <option value="1">Sim</option>
        </select>
      </div>
    </div>
    <div class="col-lg-1 col-md-4" >
      <div class="form-group">
        <label for="">Novo</label>
      <button type="button" name="button" class="btn btn-info" onclick="funPlusSpecs()" style="width:100%" > + </button>
      </div>
    </div>
    <div class="col-lg-1 col-md-4" >
      <div class="form-group">
      <label for="">Remover</label>
      <button type="button" name="button" class="btn btn-info btn-delete" onclick="" style="width:100%" > - </button>
      </div>
    </div>
  </div>

  <!-- ./wrapper -->
    <?php include_once("includes/mainjs.php");?>
    <script src="assets/plugins/select2/select2.full.min.js"></script>
    <script>
      $(document).ready(function() {
        $('.select2').not("#idiom_, #default_").select2();
        funCreateItems();
      });

      function funCreateItems(){
          var xmlhttp = new XMLHttpRequest();
          xmlhttp.onreadystatechange = function() {
              if (this.readyState == 4 && this.status == 200) {
                  var response = this.responseText;
                  var viArrayValues = response.split("||");
                  if(viArrayValues[0] == "true"){
                    var timezones = JSON.parse(viArrayValues[1]);
                    var languages = JSON.parse(viArrayValues[2]);

                    var timezone = document.getElementById("timezone");
                    for (i=0; i<timezones.length; i++){
                      var option = document.createElement("option");
                      option.text = timezones[i][1];
                      option.value = timezones[i][0];
                      timezone.appendChild(option);
                    }

                    var idiom = document.getElementById("idiom_");
                    for (i=0; i<languages.length; i++){
                      var option = document.createElement("option");
                      option.text = languages[i][1];
                      option.value = languages[i][0];
                      idiom.appendChild(option);
                    }
                    document.getElementById("countryCode").innerHTML = viArrayValues[3];
                    funPlusSpecs();
                  }else{
                      //alert("ERRO");
                      $.notify("Oppsss... Aconteceu um erro ao tentar ir buscar informação tradução!","error");
                  }
              }
          };
          var query = window.location.search.substring(1);
          xmlhttp.open("GET", "includes/country.php?cmdEval=getCountriesInfo&" + query, true);
          xmlhttp.send();
      }

      $(document).on("submit", "form", function(event) {
            event.preventDefault();
            var str = $( "form" ).serialize();
            var url = "includes/country.php";
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
        var idChange = 0;
        function funPlusSpecs(){
          var viAddedElem = document.getElementById('goaway');
          var viTemp = viAddedElem.cloneNode(true);
          viTemp.classList.remove("hide");
          var count = document.getElementById('otpx').childElementCount;
          idChange++;
          var totalItems = document.getElementById('total_items');
          totalItems.value = (idChange);
          console.log(idChange);

          viTemp.id = "lang_" + idChange ;
          viTemp.setAttribute("name", "lang_" + idChange);
          viTemp.classList.add('internal-new-form');

          var children = viTemp.childElementCount;

          document.getElementById('otpx').appendChild(viTemp);
          $("#lang_"+idChange).find(".idiom").attr("id","idiom_" + idChange);
          $("#lang_"+idChange).find(".idiom").attr("name","idiom_" + idChange);
          $("#lang_"+idChange).find(".default").attr("id","default_" + idChange);
          $("#lang_"+idChange).find(".default").attr("name","default_" + idChange);

          $("#lang_"+idChange+' .select2').select2();
        }

        $(document).on('click', '.btn-delete', function () {

          var numItems = $('.btn-delete').length

          if (numItems > 2) {
            $(this).closest(".my-form").remove();

            var changeThisId = 0;
            $( ".internal-new-form" ).each(function() {
              changeThisId++;
              $(this).attr("id", "lang_" + changeThisId);
              $(this).attr("name", "lang_" + changeThisId);
              $("#lang_"+changeThisId).find(".idiom").attr("id","idiom_" + changeThisId);
              $("#lang_"+changeThisId).find(".idiom").attr("name","idiom_" + changeThisId);
              $("#lang_"+changeThisId).find(".default").attr("id","default_" + changeThisId);
              $("#lang_"+changeThisId).find(".default").attr("name","default_" + changeThisId);
            });

            idChange = changeThisId;
            var totalItems = document.getElementById('total_items');
            totalItems.value = (changeThisId);
          } else {
            }
        });

    </script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.11.2/moment.min.js"></script>
    <script src="assets/plugins/daterangepicker/daterangepicker.js"></script>
    <!-- <script src="assets/plugins/ckeditor/ckeditor.js"></script> -->
  </body>
</html>
