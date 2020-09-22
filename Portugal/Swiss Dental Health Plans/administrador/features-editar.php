<?php include_once 'includes/session.php'; ?>
<?php include_once 'includes/notifications.php'; ?>
<?php include_once '../includes/globalVars.php'; ?>
<?php $_SESSION['mainPage'] = 'features.php'; ?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title> GLL | Edit Features</title>
    <?php include_once 'includes/head.php'; ?>
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
          Edit Features
          
        </h1>
        <ol class="breadcrumb">
          <li><a href="index.php"><i class="fa fa-dashboard"></i> Home</a></li>
          <li><a href="features.php">Features</a></li>
          <li class="active"><a href="#">Edit</a></li>
        </ol>
      </section>

      <!-- Main content -->
      <section class="content">

        <!-- Default box -->
        <div class="box">
          <div class="box-body">
            <form id="frmFaq" enctype="multipart/form-data" style="margin-bottom:20px;">
              <div class="col-xs-12">
                <div class="form-group col-sm-3">
                  <label>Country:</label>
                  <select class="form-control color-black bo-disabled" id="countryBanner" name="countryBanner">
                  </select>
                </div>
              </div>
              <div class="col-xs-12">
                <div class="form-group col-sm-3">
                  <label>Tag:</label>
                  <select class="form-control" id="tagType" name="tagType">
                  </select>
                </div>
                <div class="form-group col-sm-3">
                  <label>Position:</label>
                  <select class="form-control" id="position" name="position">
                  </select>
                </div>
                <div class="form-group col-sm-6">
                  <div class="col-sm-4">
                   <label>Choose Image:</label>
                   <span onclick="funOpenGallery(false,og_img,<?=GALLERY_IMAGE; ?>)" class="form-control btn btn-success">Gallery</span>
                   <input type="hidden" id="og_img" name="og_image" class="form-control">
                  </div>
                  <div class="col-sm-8">
                    <img id="bg_og_img" name="bg_og_image" src=""  class="img-responsive">
                  </div>
                </div>
              </div>
              <ul id="navBar" class="nav nav-tabs"></ul>
              <div id="tabContent" class="tab-content"></div>
              <button id="btnSave" class="btn btn-right btn-primary">Guardar</button>
              <input type="hidden" name="cmdEval" value="editFeature">
              <input type="hidden" name="idAdvantage" value="<?=$_REQUEST['id']; ?>">
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
    <?php include_once 'gallery.php'; ?>
  </div>
  <!-- ./wrapper -->
    <?php include_once 'includes/mainjs.php'; ?>
    <script>
      $(document).ready(function() {
          funCreateItems();
      });

      function funCreateItems(){
          var xmlhttp = new XMLHttpRequest();
          xmlhttp.onreadystatechange = function() {
              if (this.readyState == 4 && this.status == 200) {
                  var response = this.responseText;
                  //console.log(response);
                  // true|#|$optionsCountry|#|$listNavBar|#|$listFormBar|#|$pos|#|$path|#|$galleryId|#|$optionsTag
                  var viArrayValues = response.split("|#|");
                  if(viArrayValues[0] == "true"){
                    document.getElementById("countryBanner").innerHTML = viArrayValues[1];
                    document.getElementById("navBar").innerHTML = viArrayValues[2];
                    document.getElementById("tabContent").innerHTML = viArrayValues[3];
                    document.getElementById("position").innerHTML = viArrayValues[4];
                    $("#bg_og_img").attr("src","../"+viArrayValues[5]);
                    document.getElementById("og_img").value = viArrayValues[6];
                    document.getElementById("tagType").innerHTML = viArrayValues[7];
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
                      $.notify("Oppsss... Aconteceu um erro ao tentar ir buscar informação advantage!","error");
                  }
              }
          };
          var query = window.location.search.substring(1);
          xmlhttp.open("GET", "includes/features.php?cmdEval=getFeatureEdit&" + query, true);
          xmlhttp.send();
      }

      $(document).on("submit", "form", function(event) {
            event.preventDefault();
            var str = $( "form" ).serialize();
            var url = "includes/features.php";
            var formData = new FormData();
            fields = ["countryBanner","tagType","position","og_image","vcTitulo_PT","subtitle_PT","txTexto_PT","_wysihtml5_mode","cta_PT","action_PT","idTrans_PT","lang_PT","vcTitulo_EN","subtitle_EN","txTexto_EN","cta_EN","action_EN","idTrans_EN","lang_EN","vcTitulo_FR","subtitle_FR","txTexto_FR","cta_FR","action_FR","idTrans_FR","lang_FR","cmdEval","idAdvantage","bot"]
            
            fields.map((field) => {
              formData.append(field, document.querySelector("[name='"+field+"']").value)
            })
            
            $.ajax({
                url: url,
                type: 'POST',
                data: formData,
                async: false,
                success: function (data) {
                    console.log(data);
                    var response = data.split("||");
                    if(response[0] == "true"){
                        $.notify(response[1],"success");
                        document.getElementById("frmFaq").reset();
                        setTimeout(() => {
                          window.location.reload()
                        }, 1000);
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
  </body>
</html>
