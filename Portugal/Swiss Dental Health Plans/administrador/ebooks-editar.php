<?php include_once 'includes/session.php'; ?>
<?php include_once 'includes/notifications.php'; ?>
<?php include_once '../includes/globalVars.php'; ?>
<?php $_SESSION['mainPage'] = 'banner.php'; ?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title> SDC | Editar Ebook</title>
    <?php include_once 'includes/head.php'; ?>
    <link rel="stylesheet" href="assets/plugins/daterangepicker/daterangepicker.css">
    <link rel="stylesheet" href="assets/plugins/select2/select2.min.css">
  </head>
  <body class="hold-transition skin-blue sidebar-mini">
    <?php include_once 'includes/header.php'; ?>
    <?php include_once 'includes/menubar.php'; ?>
    <!-- =============================================== -->

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
      <!-- Content Header (Page header) -->
      <section class="content-header">
        <h1>
          Editar Ebook
          
        </h1>
        <ol class="breadcrumb">
          <li><a href="index.php"><i class="fa fa-dashboard"></i> Home</a></li>
          <li><a href="ebooks.php">Ebooks</a></li>
          <li class="active"><a href="#">Editar</a></li>
        </ol>
      </section>

      <!-- Main content -->
      <section class="content">
        <!-- Default box -->
        <div class="box">
          <div class="box-body">
            <form id="formMain" enctype="multipart/form-data" style="margin-bottom:20px;">

              <div class="form-group col-sm-6">
                <label>Tag:</label>
                <select disabled="true" class="form-control" style="width:100%" id="tagId" name="tagId" required>
                  <option value="">Selecionar</option>
                  <?php
                    include_once PATH_DATABASE;
                    $db = Database::getInstance();
                    $connection = $db->getConnection();
                    $sqlCmd = 'SELECT
                                id, tag
                                FROM
                                tb_ebooks_tag
                                WHERE status=1
                                GROUP BY
                                tb_ebooks_tag.id';
                    $values = '';
                    if ($result = $connection->query($sqlCmd)) {
                        while ($rsData = mysqli_fetch_assoc($result)) {
                            echo '<option value="'.$rsData['id'].'">'.$rsData['tag'].'</option>';
                        }
                    }
                  ?>
                </select>
              </div>

              <div class="form-group col-sm-6">
                <label>País:</label>
                <select disabled="true" class="form-control" style="width:100%" id="countryId" name="countryId" required>
                  <option value="">Selecionar</option>
                  <?php
                    include_once PATH_DATABASE;
                    $db = Database::getInstance();
                    $connection = $db->getConnection();
                    $sqlCmd = 'SELECT
                                id, country
                                FROM
                                tb_country
                                WHERE status=1';
                    $values = '';
                    if ($result = $connection->query($sqlCmd)) {
                        while ($rsData = mysqli_fetch_assoc($result)) {
                            echo '<option value="'.$rsData['id'].'">'.$rsData['country'].'</option>';
                        }
                    }
                  ?>
                </select>
              </div>
              <div id="allInfo"></div>
              <button class="btn btn-right btn-primary">Guardar</button>
              <input type="hidden" name="id" value="<?= $_REQUEST['id']; ?>" >
              <input type="hidden" name="cmdEval" value="editEbook">
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
    <?php include_once 'includes/footer.php'; ?>
  </div>
  <!-- ./wrapper -->
    <?php include_once 'includes/mainjs.php'; ?>
    <?php include_once 'gallery.php'; ?>
    <script src="assets/plugins/select2/select2.full.min.js"></script>
    <script>
      
      $(document).ready(function() {
        //$('.select2').select2();
        var query = window.location.search.substring(1);
        var id = query.split("=").pop();
        funCreateItems(id);
      });
      

      function funCreateItems(id){
          var xmlhttp = new XMLHttpRequest();
          xmlhttp.onreadystatechange = function() {
              if (this.readyState == 4 && this.status == 200) {
                  var response = this.responseText;
                  //console.log(response);
                  //return false;
                  var viArrayValues = response.split("||");
                  if(viArrayValues[0] == "true"){
                      document.getElementById("allInfo").innerHTML = viArrayValues[1];
                      document.getElementById("countryId").value = viArrayValues[2];
                      document.getElementById("tagId").value = viArrayValues[3];
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
                  }else{
                      //alert("ERRO");
                      $.notify("Oppsss... Aconteceu um erro ao tentar ir buscar informação tradução!","error");
                  }
              }
          };
          //console.log(idCountry);
          //return false;
          xmlhttp.open("GET", "includes/ebooks.php?cmdEval=getEbookTranslationFormData&id="+id, true);
          xmlhttp.send();
      }

      $(document).on("submit", "form", function(event) {
            event.preventDefault();
            var str = $( "form" ).serialize();
            var url = "includes/ebooks.php";
            document.getElementById("countryId").removeAttribute("disabled");
            document.getElementById("tagId").removeAttribute("disabled");

            var formData = new FormData($(this)[0]);

            document.getElementById("countryId").setAttribute("disabled", true);
            document.getElementById("tagId").setAttribute("disabled", true);

            $.ajax({
                url: url,
                type: 'POST',
                data: formData,
                async: false,
                success: function (data) {
                    // alert(data);
                    var result = data.split("||");
                    //console.log(data);
                    //return false;
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
