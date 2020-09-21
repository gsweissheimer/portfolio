<?php include_once("includes/session.php");?>
<?php include_once("includes/notifications.php");?>
<?php $_SESSION['mainPage'] = "about.php";?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title> | Sobre nós</title>
    <link rel="stylesheet" href="components/tags/bootstrap-tagsinput.css">
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
          Sobre Nós
          
        </h1>
        <ol class="breadcrumb">
          <li><a href="index.php"><i class="fa fa-dashboard"></i> Home</a></li>
          <li class="active"><a href="#">Informação</a></li>
        </ol>
      </section>

      <!-- Main content -->
      <section class="content">

        <!-- Default box -->
        <div class="box">
          <div class="box-body">
            <form id="formMain" enctype="multipart/form-data" style="margin-bottom:20px;">
              <ul id="navBar" class="nav nav-tabs"></ul>
              <div id="tabContent" class="tab-content"></div>
              <button id="btn-save" class="btn btn-right btn-primary hide">Guardar</button>
              <a id="btn-edit" class="btn btn-warning" style="float: right;margin-right:10px" onclick="funActiveEdit(false,'formMain')">Editar</a>
              <a id="btn-cancel" class="btn btn-danger hide" style="float: right;margin-right:10px" onclick="funActiveEdit(true,'formMain')">Cancelar</a>
              <input type="hidden" name="cmdEval" value="editAbout">
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
      $(document).ready(function() {
          funCreateItems();
      });

      function funCreateItems(){
          var xmlhttp = new XMLHttpRequest();
          xmlhttp.onreadystatechange = function() {
              if (this.readyState == 4 && this.status == 200) {
                  var response = this.responseText;
                  //alert(response);
                  var viArrayValues = response.split("||");
                  if(viArrayValues[0] == "true"){
                      document.getElementById("navBar").innerHTML = viArrayValues[1];
                      document.getElementById("tabContent").innerHTML = viArrayValues[2];
                      $("textarea").wysihtml5({
                        toolbar: {
                          "font-styles": false, //Font styling, e.g. h1, h2, etc. Default true
                          "emphasis": true, //Italics, bold, etc. Default true
                          "lists": false, //(Un)ordered lists, e.g. Bullets, Numbers. Default true
                          "html": false, //Button which allows you to edit the generated HTML. Default false
                          "link": true, //Button to insert a link. Default true
                          "image": false, //Button to insert an image. Default true,
                          "color": false, //Button to change color of font
                          "blockquote": false,
                          "useLineBreaks":  false
                        }
                      });
                      funEnabledOrDisabled(true,'formMain');
                  }else{
                      $.notify("Oppsss... Aconteceu um erro ao tentar ir buscar informação categoria!","error");
                  }
              }
          };
          var query = window.location.search.substring(1);
          xmlhttp.open("GET", "includes/getInformation.php?cmdEval=getAbout&" + query, true);
          xmlhttp.send();
      }

      $(document).on("submit", "form", function(event) {
            event.preventDefault();
            var str = $( "form" ).serialize();
            var url = "includes/editInformation.php";
            var formData = new FormData($(this)[0]);
            $.ajax({
                url: url,
                type: 'POST',
                data: formData,
                async: false,
                success: function (data) {
                  //alert(data);
                  var result = data.split("||");
                    if(result[0] == "true"){
                        $.notify(result[1],"success");
                        funActiveEdit(true,'formMain');
                    }else{
                        $.notify(result[1],"error");
                    }
                },
                error: function(chr, desc, err){
                  $.notify("Oppsss... Aconteceu um erro ao tentar editar about!","error");
                },
                cache: false,
                contentType: false,
                processData: false
            });

            return false;
        });
        $(window).load(function(){
          checkloadjscssfile("components/tags/bootstrap-tagsinput.js", "js")
        })
    </script>
  </body>
</html>
