<?php include_once("includes/session.php");?>
<?php include_once("includes/notifications.php");?>
<?php include_once("../includes/globalVars.php");?>
<?php $_SESSION['mainPage'] = "titlefaqs.php";?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title> CEROA | Adicionar FAQ's</title>
    <link rel="stylesheet" href="assets/plugins/select2/select2.min.css">
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
          Adicionar FAQ's
          
        </h1>
        <ol class="breadcrumb">
          <li><a href="index.php"><i class="fa fa-dashboard"></i>Home</a></li>
          <li><a href="faqs.php">FAQ's</a></li>
          <li class="active"><a href="#">Adicionar</a></li>
        </ol>
      </section>

      <!-- Main content -->
      <section class="content">

        <!-- Default box -->
        <div class="box">
          <div class="box-body">
            <form id="frmFaq" enctype="multipart/form-data" style="margin-bottom:20px;">
              <!--<div class="form-group col-sm-4">
              <label>Título:</label>
              <select class="form-control select2 select2-hidden-accessible" style="width:100%" id="title" name="title" required>
                <option value="">Selecionar</option>
                <?php /*
                  include_once(PATH_DATABASE);
                  $db = Database::getInstance();
                  $connection = $db->getConnection();
                  $sqlCmd = "SELECT
                                    tb_translations.value,
                                    tb_translations_codes.id
                              FROM
                                    tb_translations_codes
                              JOIN tb_translations ON tb_translations_codes.id = tb_translations.idTbCodeTranslations
                              JOIN tb_language ON tb_translations.idTbLanguage = tb_language.id
                              WHERE tb_language.langMin='PT'";
                  $values = "";
                  if ($result = $connection->query($sqlCmd)) {
                    while($rsData = mysqli_fetch_assoc($result)){
                      echo '<option value="'.$rsData['id'].'">'.$rsData['value'].'</option>';
                    }
                  }
                */?>
              </select>
              </div>-->
              <!--<div class="form-group col-sm-4">
              <label>País:</label>
              <select class="form-control select2 select2-hidden-accessible" style="width:100%" id="country" name="country" required>
                <?php /*
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
                */?>
              </select>
              </div>-->
              <div class="form-group col-sm-6">
              <label>Tag:</label>
              <select class="form-control" style="width:100%" id="tag" name="tag" required>
              </select>
              </div>
              <div class="form-group col-sm-6">
              <label>País:</label>
              <select class="form-control" style="width:100%" id="country" name="country" disabled="true" required>
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
              <div id="allInfo"></div>
              <button class="btn btn-right btn-primary">Guardar</button>
              <input type="hidden" name="cmdEval" value="addFaq">
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
    <?php include_once("gallery.php");?>
    <?php include_once("includes/mainjs.php");?>
    <script src="assets/plugins/select2/select2.full.min.js"></script>
    <script>
      $(document).ready(function() {
          //funCreateItems();
          //$('.select2').select2();
          getTags();
      });

      function getTags() {
        var xmlhttp = new XMLHttpRequest();
        xmlhttp.onreadystatechange = function() {
          if (this.readyState == 4 && this.status == 200) {
            var response = this.responseText;
            var viArrayValues = response.split("||");
            //console.log(viArrayValues);
            //return false;
            if(viArrayValues[0] == "true"){
                //document.getElementById('country').innerHTML = viArrayValues[1];
                document.getElementById('tag').innerHTML = viArrayValues[1];
                document.getElementById('country').innerHTML = viArrayValues[2];
                //document.getElementById("navBar").innerHTML = viArrayValues[1];
                //document.getElementById("tabContent").innerHTML = viArrayValues[2];
                //funStartEditor();
                // $("textarea").wysihtml5({
                //   toolbar: {
                //     "font-styles": false, //Font styling, e.g. h1, h2, etc. Default true
                //     "emphasis": true, //Italics, bold, etc. Default true
                //     "lists": false, //(Un)ordered lists, e.g. Bullets, Numbers. Default true
                //     "html": false, //Button which allows you to edit the generated HTML. Default false
                //     "link": true, //Button to insert a link. Default true
                //     "image": false, //Button to insert an image. Default true,
                //     "color": false, //Button to change color of font
                //     "blockquote": false
                //   }
                // });
            }else{
                //alert("ERRO");
                $.notify("Oppsss... Aconteceu um erro ao tentar ir buscar informação faq!","error");
            }
          }
        };
        var query = window.location.search.substring(1);
        xmlhttp.open("GET", "includes/faqs.php?cmdEval=initFaqTagsAndCountries&" + query, true);
        xmlhttp.send();
      }

      $('#tag').on('change', function() { 
        var idTag = this.value;
        var xmlhttp = new XMLHttpRequest();
        xmlhttp.onreadystatechange = function() {
          if (this.readyState == 4 && this.status == 200) {
            var response = this.responseText;
            //console.log(response);
            //return false;
            var viArrayValues = response.split("||");
            if(viArrayValues[0] == "true"){ 
              countryId = parseInt(viArrayValues[1]);
              document.getElementById("country").value = countryId;
              document.getElementById("idCountry").value = countryId;
              $("#country").trigger("change");
            } else {
              $.notify("Oppsss... Something happens!","error");
            }
          }
        };
        //var query = window.location.search.substring(1);
        xmlhttp.open("GET", "includes/faqs.php?cmdEval=getFaqTagCountryId&id=" + idTag, true);
        xmlhttp.send();
      });

      $("#country").on("change", function() {
        var idCountry = this.value;
        var xmlhttp = new XMLHttpRequest();
        xmlhttp.onreadystatechange = function() {
          if (this.readyState == 4 && this.status == 200) {
            var response = this.responseText;
            //console.log(response);
            //return false;
            var viArrayValues = response.split("||");
            if(viArrayValues[0] == "true"){ 
              document.getElementById("allInfo").innerHTML = viArrayValues[1];
              funStartEditor();
            } else {
              $.notify("Oppsss... Something happens!","error");
            }
          }
        };
        //var query = window.location.search.substring(1);
        xmlhttp.open("GET", "includes/faqs.php?cmdEval=getFaqFormByCountry&idC=" + idCountry, true);
        xmlhttp.send();
      });

      $(document).on("submit", "form", function(event) {
        event.preventDefault();
        $("#country").attr("disabled", "false");
        var str = $( "form" ).serialize();
        var url = "includes/faqs.php";
        var formData = new FormData($(this)[0]);
        $.ajax({
            url: url,
            type: 'POST',
            data: formData,
            async: false,
            success: function (data) {
                var response = data.split("||");
                //alert(response[0]);
                //console.log(data);
                //return false;
                if(response[0] == "true"){
                    $.notify(response[1],"success");
                    //document.getElementById("frmFaq").reset();~
                    //$("#tag").trigger("change");
                    //window.location.reload();
                    setTimeout(() => {
                      window.location.reload()
                    }, 1500);
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

        /*$('#tag').on('change', function() {
          var idTag = this.value;
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
          xmlhttp.open("GET", "includes/faqs.php?cmdEval=getFaq&idC=" + idCountry, true);
          xmlhttp.send();
        });

      function funCreateItems(){
          var xmlhttp = new XMLHttpRequest();
          xmlhttp.onreadystatechange = function() {
              if (this.readyState == 4 && this.status == 200) {
                  var response = this.responseText;
                  var viArrayValues = response.split("||");
                  //console.log(viArrayValues);
                  if(viArrayValues[0] == "true"){
                      //document.getElementById('country').innerHTML = viArrayValues[1];
                      document.getElementById('tag').innerHTML = viArrayValues[1];
                      //document.getElementById("navBar").innerHTML = viArrayValues[1];
                      //document.getElementById("tabContent").innerHTML = viArrayValues[2];
                      //funStartEditor();
                      // $("textarea").wysihtml5({
                      //   toolbar: {
                      //     "font-styles": false, //Font styling, e.g. h1, h2, etc. Default true
                      //     "emphasis": true, //Italics, bold, etc. Default true
                      //     "lists": false, //(Un)ordered lists, e.g. Bullets, Numbers. Default true
                      //     "html": false, //Button which allows you to edit the generated HTML. Default false
                      //     "link": true, //Button to insert a link. Default true
                      //     "image": false, //Button to insert an image. Default true,
                      //     "color": false, //Button to change color of font
                      //     "blockquote": false
                      //   }
                      // });
                  }else{
                      //alert("ERRO");
                      $.notify("Oppsss... Aconteceu um erro ao tentar ir buscar informação faq!","error");
                  }
              }
          };
          var query = window.location.search.substring(1);
          xmlhttp.open("GET", "includes/faqs.php?cmdEval=initFaq&" + query, true);
          xmlhttp.send();
      }

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
                  
                    var response = data.split("||");
                    alert(response[0]);
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

        function funGetLanguages(){
          var countryID = document.getElementById('country').value;
          event.preventDefault();
          var url = "includes/faqs.php?cmdEval=getCountryLang&country="+countryID;
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
        } */

    </script>
  </body>
</html>
