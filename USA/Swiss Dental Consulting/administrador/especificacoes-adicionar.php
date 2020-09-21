<?php include_once("includes/session.php");?>
<?php include_once("includes/notifications.php");?>
<?php include_once("../includes/globalVars.php");?>
<?php $_SESSION['mainPage'] = "traducoes.php";?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title> | Adicionar Especificações</title>
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
          Adicionar Especificação
          
        </h1>
        <ol class="breadcrumb">
          <li><a href="index.php"><i class="fa fa-dashboard"></i>Home</a></li>
          <li><a href="especificacoes.php">Especificações</a></li>
          <li class="active"><a href="#">Adicionar</a></li>
        </ol>
      </section>

      <!-- Main content -->
      <section class="content">

        <!-- Default box -->
        <div class="box">
          <div class="box-body">
            <form id="addSpec1" name="addSpec1" enctype="multipart/form-data" style="margin-bottom:20px;">

              <div class="form-group col-sm-12">
        			       <label>Código da Especificação</label>
        			       <input class="form-control"  id="specCode" name="specCode" required>
        			</div>
              <div class="form-group col-sm-12">
        			       <label>Default</label>
        			       <input type="checkbox" name="specDef" value="1">
        			</div>
              <div class="form-group col-sm-12">
        			       <label>Categoria</label>
                     <select class="form-control select2 select2-hidden-accessible" style="width: 100%" id="categories" name="categories" required>
                       <option value="">Selecionar</option>
                     </select>
        			</div>
              <ul id="navBar" class="nav nav-tabs"></ul>
              <div id="tabContent" class="tab-content"></div>
              <button class="btn btn-right btn-primary">Guardar</button>
              <input type="hidden" name="cmdEval" value="addSpec">
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
      $(document).ready(function() {
        funCreateItems();
        $('.select2').select2();
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

                      var catSelect = document.getElementById('categories');

                      for(i=0; i < categories.length; i++){
                        var optionCat = document.createElement("option");
                        optionCat.value = categories[i][0];
                        optionCat.text = categories[i][1];
                        catSelect.add(optionCat);
                      }

                      $("textarea").wysihtml5({
                        toolbar: {
                          "font-styles": false, //Font styling, e.g. h1, h2, etc. Default true
                          "emphasis": true, //Italics, bold, etc. Default true
                          "lists": false, //(Un)ordered lists, e.g. Bullets, Numbers. Default true
                          "html": true, //Button which allows you to edit the generated HTML. Default false
                          "link": true, //Button to insert a link. Default true
                          "image": false, //Button to insert an image. Default true,
                          "color": false, //Button to change color of font
                          "blockquote": false
                        }
                      });
                  }else{
                      //alert("ERRO");
                      $.notify("Oppsss... Aconteceu um erro ao tentar ir buscar informação tradução!","error");
                  }
              }
          };
          var query = window.location.search.substring(1);
          xmlhttp.open("GET", "includes/getInformation.php?cmdEval=specNew&" + query, true);
          xmlhttp.send();
      }

      $('form[name=addSpec1]').submit(function(e) {
        e.preventDefault();
        var url = "includes/addInformation.php";
        var form1 = $('#addSpec1');
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
              document.getElementById("addSpec1").reset();
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
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.11.2/moment.min.js"></script>
    <script src="assets/plugins/daterangepicker/daterangepicker.js"></script>
    <!-- <script src="assets/plugins/ckeditor/ckeditor.js"></script> -->
  </body>
</html>
