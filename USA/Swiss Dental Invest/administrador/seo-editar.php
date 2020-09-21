<?php include_once("includes/session.php");?>
<?php include_once("includes/notifications.php");?>
<?php include_once("../includes/globalVars.php");?>
<?php $_SESSION['mainPage'] = "faqs.php";?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title> CEROA | Editar SEO</title>
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
          Editar SEO
          
        </h1>
        <ol class="breadcrumb">
          <li><a href="index.php"><i class="fa fa-dashboard"></i> Home</a></li>
          <li><a href="seo.php">SEO</a></li>
          <li class="active"><a href="#">Editar</a></li>
        </ol>
      </section>

      <!-- Main content -->
      <section class="content">

        <!-- Default box -->
        <div class="box">
          <div class="box-body">
            <form enctype="multipart/form-data" style="margin-bottom:20px;">
              <div class="col-lg-12">
                <div class="form-group">
        				      <label>SEO Code:</label>
                      <select class="form-control" id="seoCode" name="seoCode" disabled required>
                        <option value="">Selecionar</option>
                        <?php
                          include_once(PATH_DATABASE);
                				  $db = Database::getInstance();
                				  $connection = $db->getConnection();
                          $sqlCmd = "SELECT
                  											*
                  										FROM
                  											tb_seo
      									             WHERE
                  										status = 1";
                  				$values = "";
                  				if ($result = $connection->query($sqlCmd)) {
                  					while($rsData = mysqli_fetch_assoc($result)){
                              echo '<option value="'.$rsData['id'].'" readonly>'.$rsData['code'].'</option>';
                            }
                          }
                        ?>
                      </select>
        				</div>
              </div>
              <ul id="navBar" class="nav nav-tabs"></ul>
              <div id="tabContent" class="tab-content"></div>
              <button class="btn btn-right btn-primary">Guardar</button>
              <input type="hidden" name="cmdEval" value="editSEO">
              <input type="hidden" name="idSeo" value="<?php echo $_REQUEST['id'] ?>">
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

      function funCreateItems(){
          var xmlhttp = new XMLHttpRequest();
          xmlhttp.onreadystatechange = function() {
              if (this.readyState == 4 && this.status == 200) {
                  var response = this.responseText;
                  var viArrayValues = response.split("||");
                  if(viArrayValues[0] == "true"){
                      document.getElementById("navBar").innerHTML = viArrayValues[1];
                      document.getElementById("tabContent").innerHTML = viArrayValues[2];
                      document.getElementById('seoCode').value = viArrayValues[3];
                      //funStartEditor();
                  }else{
                      $.notify(viArrayValues[1],"error");
                  }
              }
          };
          var query = window.location.search.substring(1);
          xmlhttp.open("GET", "includes/seo.php?cmdEval=getSEOEdit&" + query, true);
          xmlhttp.send();
      }

      $(document).on("submit", "form", function(event) {
            event.preventDefault();
            var str = $( "form" ).serialize();
            var url = "includes/seo.php";
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
    <style>
    .wysihtml5-editor{color:red}
    </style>
  </body>
</html>
