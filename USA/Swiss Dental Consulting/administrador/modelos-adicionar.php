<?php include_once("includes/session.php");?>
<?php include_once("includes/notifications.php");?>
<?php include_once("../includes/globalVars.php");?>
<?php $_SESSION['mainPage'] = "modelos.php";?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title> | Adicionar modelo</title>
    <?php include_once("includes/head.php");?>
    <link href="../assets/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">
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
          Adicionar modelo
          
        </h1>
        <ol class="breadcrumb">
          <li><a href="index.php"><i class="fa fa-dashboard"></i> Home</a></li>
          <li><a href="modoelo.php">modelo</a></li>
          <li class="active"><a href="#">Adicionar</a></li>
        </ol>
      </section>

      <!-- Main content -->
      <section class="content">

        <!-- Default box -->
        <div class="box">
          <div class="box-body">

            <div class="container">
              <div class="row">

                <div class="col-md-12 tabs-checkout no-pad-later">
                    <form id="addNameModel" name="addNameModel" method="POST" enctype="multipart/form-data" style="margin-bottom:20px;">
                  <div class="checkout-tabs">
                      <ul id="tabs" class="nav nav-tabs" data-tabs="tabs">
                          <li class="active"><a href="#1passo-info" data-toggle="tab"> <img src="../assets/img/ic_billing_info.svg" class="img-billing" alt="" > Geral </a></li>
                          <li><a href="#2passo-info" data-toggle="tab" id="2passo"> <img src="../assets/img/ic_billing_info.svg" class="img-billing" alt="" > Descrição </a></li>
                          <li><a href="#3passo-info" data-toggle="tab" id="3passo"> <img src="../assets/img/ic_billing_info.svg" class="img-billing" alt="" > Especificações </a></li>
                          <li><a href="#4passo-info" data-toggle="tab" id="4passo"> <img src="../assets/img/ic_billing_info.svg" class="img-billing" alt="" > Imagens </a></li>
                          <li><a href="#5passo-info" data-toggle="tab" id="5passo"> <img src="../assets/img/ic_billing_info.svg" class="img-billing" alt="" > Desenho Tecnico </a></li>
                      </ul>
                      <div id="my-tab-content" class="tab-content" style="display: inline-block; width:100%" >
                          <div class="tab-pane active" id="1passo-info" >

                            <div class="col-xs-12 no-pad-later internal-form ">

                              <div class="col-lg-4 col-md-4">
                                <div class="form-group">
                                  <label for="name">Name:</label>
                                  <input type="name" class="form-control" id="nameModel" name="name" value="" required="">
                                </div>
                              </div>
                              <div class="col-lg-4 col-md-4">
                                <div class="form-group">
                                  <label>Posição:</label>
                                   <input type="text" class="form-control" name="position" id="position">
                                </div>
                              </div>
                              <div class="col-lg-4 col-md-4">
                                <div class="form-group col-md-12">
                                  <label for="name">default:</label><br>
                                  <input type="radio" name="default" value="0" required checked> Não
                                  <input type="radio" name="default" value="1" required> Sim<br>
                                </div>
                              </div>



                              <div class="col-xs-12 text-right"  style="padding-bottom: 5px">
                                  <a href="#2passo-info" data-toggle="tab" id="next-btn" onclick="document.getElementById('2passo').click()"><button type="button" name="button" class="btn btn-primary">Próximo</button></a>
                                <!-- <input type="hidden" name="cmdEval" value="addModelName">
                                <input type="hidden" name="idModelName" value="">
                                <input type="hidden" name="bot" value=""> -->
                              </div>

                            </div>

                          </div>

                          <div class="tab-pane" id="2passo-info">

                            <div class="col-xs-12 no-pad-later internal-form">

                            <ul id="navBar" class="nav nav-tabs"></ul>
                            <div id="tabContent" class="tab-content"></div>

                            <!-- <div class="col-lg-6 col-md-6">
                              <div class="form-group">
                                <label for="name">PDF Token:</label>
                                <input type="name" class="form-control" id="TokenModel" name="TokenModel" value="" required="">
                              </div>
                            </div> -->

                            <!-- <div class="form-group col-sm-4">
                              <label>Upload File</label>
                               <input type="file" name="fileToUpload" id="fileToUpload">
                            </div> -->

                            <div class="col-xs-12 text-right">
                              <a href="#3passo-info" data-toggle="tab" id="3passo" onclick="document.getElementById('3passo').click()"><button type="button" name="button" class="btn-next"> NEXT STEP </button></a>
                            </div>
                            <!-- <input type="hidden" name="cmdEval" value="addModule">
                            <input type="hidden" name="idModule" value="">
                            <input type="hidden" name="bot" value=""> -->

                          </div>
                          </div>
                          <div class="tab-pane" id="3passo-info">
                          <div id="otpx">
                          </div>
                        <!-- <div class="col-xs-12 text-right">
                          <input type="submit" name="button" class="btn-next" value="Complete">
                          <input type="hidden" name="cmdEval" value="addNameModel">
                          <input type="hidden" name="bot" value="">
                        </div> -->

                        <div class="col-xs-12 text-right">
                          <a href="#4passo-info" data-toggle="tab" id="4passo" onclick="document.getElementById('4passo').click()"><button type="button" name="button" class="btn-next"> NEXT STEP </button></a>
                        </div>
                          </div>

                          <div class="tab-pane" id="4passo-info">

                            <div class="col-xs-12 no-pad-later internal-form">

                            <div class="form-group col-sm-4">
                              <label>Imagem volumetrica</label>
                               <input type="file" name="fileToUploadVolu" id="fileToUploadVolu">
                            </div>

                            <div class="form-group col-sm-4">
                              <label>Imagem real</label>
                               <input type="file" name="fileToUploadReal" id="fileToUploadReal">
                            </div>

                            <div class="form-group col-sm-4">
                              <label>Imagem header</label>
                               <input type="file" name="fileToUploadHead" id="fileToUploadHead">
                            </div>


                            <div class="col-xs-12 text-right">
                                <a href="#5passo-info" data-toggle="tab" id="5passo" onclick="document.getElementById('5passo').click()"><button type="button" name="button" class="btn-next"> NEXT STEP </button></a>
                            </div>

                          </div>

                        </div>


<!--  -->
                        <div class="tab-pane" id="5passo-info">
                          <div id="otpx1">
                          </div>
                      <div class="col-xs-12 text-right">
                        <input type="submit" name="button" class="btn btn-primary" value="Complete">
                        <input type="hidden" name="cmdEval" value="addNameModel">
                        <input type="hidden" name="bot" value="">
                      </div>
                      </div>

<!--  -->



                      </div>
                  </div>
                  <input id="total_items1" type="hidden" value="" name="total1">
                  <input id="total_items" type="hidden" value="" name="total">
                </form>
                </div>


              </div>
                </div>

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

<!-- COPY -->
  <div class="col-xs-12 no-pad-later internal-form hide" style="padding:0px;"  id="goaway1" name="xpto1">
    <div class="col-lg-2 col-md-4">
      <div class="form-group">
      <label>Andar:</label>
      <select class="form-control select2 select2-hidden-accessible andar" id="andar_" name="andar_" style="width:100%">
        <option value="">Selecionar</option>
        <?php
          include_once(PATH_DATABASE);
          $db = Database::getInstance();
          $connection = $db->getConnection();
          $sqlCmd = "SELECT
                    tb_translations.value,
                    tb_translations_codes.id,
                    tb_translations_codes.code
                    FROM
                    tb_translations
                    JOIN tb_translations_codes ON tb_translations.idTbCodeTranslations = tb_translations_codes.id
                    JOIN tb_language ON tb_language.id = tb_translations.idTbLanguage
                    WHERE tb_language.langMin= 'PT'
                    AND
                    tb_translations_codes.deleted=0;
                     ";
          $values = "";
          if ($result = $connection->query($sqlCmd)) {
            while($rsData = mysqli_fetch_assoc($result)){
              echo '<option value="'.$rsData['id'].'">'.$rsData['value'].'</option>';
            }
          }
        ?>
      </select>
      </div>
    </div>


    <div class="col-lg-2 col-md-4">
      <h4>Divisão</h4>
     <select class="form-control select2 select2-hidden-accessible divi" data-placeholder="Selecionar Divisão" style="width:100%" id="selectDivisions1_" name="selectDivisions1_" multiple multiple="multiple" required>
       </select>
    </div>

    <div class="col-lg-4 col-md-4">
      <div class="form-group col-sm-4">
        <label>Imagem da Planta</label>
         <input type="file" class="form-control plant" name="fileToUploadPlanta_" id="fileToUploadPlanta_">
      </div>
    </div>
    <div class="col-lg-1 col-md-4" >
      <div class="form-group">
        <label for="">Novo</label>
      <button type="button" name="button" class="btn btn-info" onclick="funPlusSpecs1()" style="width:100%" > + </button>
      </div>
    </div>
    <div class="col-lg-1 col-md-4" >
      <div class="form-group">
      <label for="">Remover</label>
      <button type="button" name="button" class="btn btn-info btn-delete" onclick="" style="width:100%" > - </button>
      </div>
    </div>
    <div class="col-lg-2 col-md-4" >
      <div class="col-md-6">
        <div class="form-group">
        <label for="">&nbsp;</label>
        <button type="button" name="button" class="btn btn-info btn-upward" onclick="" style="width:100%" > <i class="fa fa-arrow-up" aria-hidden="true"></i> </button>
        </div>
      </div>
      <div class="col-md-6">
        <div class="form-group">
        <label for="">&nbsp;</label>
        <button type="button" name="button" class="btn btn-info btn-downward" onclick="" style="width:100%" > <i class="fa fa-arrow-down" aria-hidden="true"></i> </button>
        </div>
      </div>
    </div>

  </div>

<!-- COPY -->




  <div class="col-xs-12 no-pad-later internal-form my-form hide" style="padding:0px"  id="goaway" name="xpto">

    <div class="col-lg-2 col-md-4">
      <div class="form-group eraseit">
      <label>Categoria:</label>
      <select class="form-control select2 select2-hidden-accessible cat" style="width: 100%" id="pageType_" name="pageType_" required>
        <option value="">Selecionar</option>
      </select>
      </div>
    </div>

    <div class="col-lg-2 col-md-4">
      <div class="form-group eraseit">
      <label>Especificações:</label>
      <select class="form-control select2 select2-hidden-accessible spec" style="width: 100%" id="pageType1_" name="pageType1_" required>
        <option value="">Selecionar</option>
        <?php
          include_once(PATH_DATABASE);
          $db = Database::getInstance();
          $connection = $db->getConnection();
          $sqlCmd = "SELECT
                    tb_translations.value,
                    tb_specs.id
                    FROM
                    tb_specs
                    JOIN tb_translations_codes
                    ON tb_specs.idTbTransCodes = tb_translations_codes.id
                    JOIN tb_translations
                    ON tb_translations.idTbCodeTranslations = tb_translations_codes.id
                    JOIN tb_language
                    ON tb_translations.idTbLanguage = tb_language.id
                    WHERE tb_language.langMin= 'PT'
                     ";
          $values = "";
          if ($result = $connection->query($sqlCmd)) {
            while($rsData = mysqli_fetch_assoc($result)){
              echo '<option value="'.$rsData['id'].'">'.$rsData['value'].'</option>';
            }
          }
        ?>
      </select>
    </div>

    </div>

    <div class="col-lg-4 col-md-4">
      <div class="form-group">
        <label for="name">valor:</label>
        <input type="name" class="form-control valor1" id="valueModel" name="valueModel" value="" required="">
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
      <button type="button" name="button" class="btn btn-info btn-delete"  style="width:100%" > - </button>
      </div>
    </div>
    <div class="col-lg-2 col-md-4" >
      <div class="col-md-6">
        <div class="form-group">
        <label for="">&nbsp;</label>
        <button type="button" name="button" class="btn btn-info btn-upward" onclick="" style="width:100%" > <i class="fa fa-arrow-up" aria-hidden="true"></i> </button>
        </div>
      </div>
      <div class="col-md-6">
        <div class="form-group">
        <label for="">&nbsp;</label>
        <button type="button" name="button" class="btn btn-info btn-downward" onclick="" style="width:100%" > <i class="fa fa-arrow-down" aria-hidden="true"></i> </button>
        </div>
      </div>
    </div>

  </div>

  <!-- ./wrapper -->
    <?php include_once("includes/mainjs.php");?>
    <script src="assets/plugins/select2/select2.full.min.js"></script>
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

                      var categories = JSON.parse(viArrayValues[3]);

                      var catSelect = document.getElementById('pageType_');
                      for(i=0; i < categories.length; i++){
                        var optionCat = document.createElement("option");
                        optionCat.value = categories[i][0];
                        optionCat.text = categories[i][1];
                        catSelect.add(optionCat);
                      }


                      document.getElementById("selectDivisions1_").innerHTML = viArrayValues[4];
                      $("textarea").wysihtml5({
                        toolbar: {
                          "font-styles": false, //Font styling, e.g. h1, h2, etc. Default true
                          "emphasis": true, //Italics, bold, etc. Default true
                          "lists": false, //(Un)ordered lists, e.g. Bullets, Numbers. Default true
                          "html": false, //Button which allows you to edit the generated HTML. Default false
                          "link": true, //Button to insert a link. Default true
                          "image": false, //Button to insert an image. Default true,
                          "color": false, //Button to change color of font
                          "blockquote": false
                        }
                      });
                      funPlusSpecs();
                      funPlusSpecs1();
                      $('.select2').not("#pageType_, #pageType1_, #selectDivisions1_, #andar_").select2();
                  }else{
                      //alert("ERRO");
                      $.notify("Oppsss... Aconteceu um erro ao tentar ir buscar informação!","error");
                  }
              }
          };
          var query = window.location.search.substring(1);
          xmlhttp.open("GET", "includes/getInformation.php?cmdEval=getModelNew&" + query, true);
          xmlhttp.send();
      }

      $('form[name=addNameModel]').submit(function(e) {
        e.preventDefault();
        var url = "includes/addInformation.php";
        var form1 = $('#addNameModel');
        var formData = new FormData($(this)[0]);
        $.ajax({
          type: "POST",
          url: url,
          data: formData,
          async: true,
          success: function (data) {
                              alert(data)
            var response = data.split("||");
            if(response[0] == "true"){
              $.notify(response[1],"success");
              document.getElementById("addNameModel").reset();
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

    <script>
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

      viTemp.id = "spec_" + idChange ;
      viTemp.setAttribute("name", "spec_" + idChange);
      viTemp.classList.add('internal-new-form');


      // viTemp.getElementById("pageType").setAttribute("name","pageType_" + idChange) ;

      var children = viTemp.childElementCount;
      //
      // viTemp.children[0].id = "pageType_" + idChange ;
      // $(viTemp).find('#pageType_0').attr('id','ola');
      document.getElementById('otpx').appendChild(viTemp);
      $("#spec_"+idChange).find(".cat").attr("id","pageType_" + idChange);
      $("#spec_"+idChange).find(".cat").attr("name","pageType_" + idChange);
      $("#spec_"+idChange).find(".spec").attr("id","pageType1_" + idChange);
      $("#spec_"+idChange).find(".spec").attr("name","pageType1_" + idChange);
      $("#spec_"+idChange).find(".valor1").attr("id","valueModel_" + idChange);
      $("#spec_"+idChange).find(".valor1").attr("name","valueModel_" + idChange);

      $("#spec_"+idChange+' .select2').select2();
    }



      $(document).on('click', '.btn-delete', function () {

        var numItems = $('.btn-delete').length

        if (numItems > 2) {
          $(this).closest(".my-form").remove();

          var changeThisId = -1;
          $( ".internal-new-form" ).each(function() {
            changeThisId++;
            $(this).attr("id", "spec_" + changeThisId);
            $(this).attr("name", "spec_" + changeThisId);
          });

          idChange = changeThisId;
          var totalItems = document.getElementById('total_items');
          totalItems.value = (changeThisId);
        } else {
          }
      });

      var changeThisIdUp = 0 ;
      $(document).on('click', '.btn-upward', function () {

        var beforeElement = $(this).closest('.internal-new-form').prev('.internal-new-form')

        $(this).closest('.internal-new-form').insertBefore(beforeElement);
          var changeThisIdUp = -1 ;
        $( ".internal-new-form" ).each(function() {

          changeThisIdUp++;
          $(this).attr("id", "spec_" + changeThisIdUp);
          $(this).attr("name", "spec_" + changeThisIdUp);
        });


      });

      changeThisId = changeThisIdUp;

      var changeThisIdDown = 0 ;
      $(document).on('click', '.btn-downward', function () {

        var afterElement = $(this).closest('.internal-new-form').next('.internal-new-form');

        $(this).closest('.internal-new-form').insertAfter(afterElement);
          var changeThisIdDown = -1 ;
        $( ".internal-new-form" ).each(function() {

          changeThisIdDown++;
          $(this).attr("id", "spec_" + changeThisIdDown);
          $(this).attr("name", "spec_" + changeThisIdDown);
        });


      });

      changeThisId = changeThisIdDown;
    </script>

    <script>
    var idChange = 0;
    var idChangeDraw = 0;
    function funPlusSpecs1(){
      var viAddedElem = document.getElementById('goaway1');
      var viTemp = viAddedElem.cloneNode(true);
      viTemp.classList.remove("hide");
      var count = document.getElementById('otpx1').childElementCount;
      idChangeDraw++;
      var totalItems = document.getElementById('total_items1');
      totalItems.value = (idChangeDraw);
      console.log(idChangeDraw);

      viTemp.id = "draw_" + idChangeDraw ;
      viTemp.setAttribute("name", "draw_" + idChangeDraw);
      viTemp.classList.add('internal-new-form');

      var children = viTemp.childElementCount;

      document.getElementById('otpx1').appendChild(viTemp);
      $("#draw_"+idChangeDraw).find(".andar").attr("id","andar_" + idChangeDraw);
      $("#draw_"+idChangeDraw).find(".andar").attr("name","andar_" + idChangeDraw);
      $("#draw_"+idChangeDraw).find(".divi").attr("id","selectDivisions1_" + idChangeDraw);
      $("#draw_"+idChangeDraw).find(".divi").attr("name","selectDivisions1_" + idChangeDraw + "[]");
      $("#draw_"+idChangeDraw).find(".plant").attr("id","fileToUploadPlanta_" + idChangeDraw);
      $("#draw_"+idChangeDraw).find(".plant").attr("name","fileToUploadPlanta_" + idChangeDraw);

      $("#draw_"+idChangeDraw+' .select2').select2();
    }



      $(document).on('click', '.btn-delete', function () {

        var numItems = $('.btn-delete').length

        if (numItems > 2) {
          $(this).closest(".my-form").remove();

          // var changeThisId = -1;
          // $( ".internal-new-form" ).each(function() {
          //   changeThisId++;
          //   $(this).attr("id", "spec_" + changeThisId);
          //   $(this).attr("name", "spec_" + changeThisId);
          // });

          idChange = changeThisId;
          var totalItems = document.getElementById('total_items1');
          totalItems.value = (changeThisId);
        } else {
          }
      });

      $(document).on('click', '.btn-delete1', function () {

        var numItems = $('.btn-delete1').length

        if (numItems > 2) {
          $(this).closest(".my-form").remove();

          // var changeThisId = -1;
          // $( ".internal-new-form" ).each(function() {
          //   changeThisId++;
          //   $(this).attr("id", "spec_" + changeThisId);
          //   $(this).attr("name", "spec_" + changeThisId);
          // });

          idChangeDraw = changeThisId;
          var totalItems = document.getElementById('total_items1');
          totalItems.value = (changeThisId);
        } else {
          }
      });

      var changeThisIdUp = 0 ;
      $(document).on('click', '.btn-upward', function () {

        var beforeElement = $(this).closest('.internal-new-form').prev('.internal-new-form')

        $(this).closest('.internal-new-form').insertBefore(beforeElement);
          var changeThisIdUp = -1 ;
        $( ".internal-new-form" ).each(function() {

          changeThisIdUp++;
          $(this).attr("id", "spec_" + changeThisIdUp);
          $(this).attr("name", "spec_" + changeThisIdUp);
        });


      });

      changeThisId = changeThisIdUp;

      var changeThisIdDown = 0 ;
      $(document).on('click', '.btn-downward', function () {

        var afterElement = $(this).closest('.internal-new-form').next('.internal-new-form');

        $(this).closest('.internal-new-form').insertAfter(afterElement);
          var changeThisIdDown = -1 ;
        $( ".internal-new-form" ).each(function() {

          changeThisIdDown++;
          $(this).attr("id", "spec_" + changeThisIdDown);
          $(this).attr("name", "spec_" + changeThisIdDown);
        });


      });

      changeThisId = changeThisIdDown;
    </script>

  </body>
</html>
