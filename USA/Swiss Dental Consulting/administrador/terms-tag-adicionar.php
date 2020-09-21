<?php include_once("includes/session.php");?>
<?php include_once("includes/notifications.php");?>
<?php include_once("../includes/globalVars.php");?>
<?php $_SESSION['mainPage'] = "banner.php";?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>SDE | Adicionar Terms Tag</title>
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
          Adicionar Terms TAG
          
        </h1>
        <ol class="breadcrumb">
          <li><a href="index.php"><i class="fa fa-dashboard"></i> Home</a></li>
          <li><a href="banner.php">Terms</a></li>
          <li class="active"><a href="#">Adicionar Tag</a></li>
        </ol>
      </section>

      <!-- Main content -->
      <section class="content">

        <!-- Default box -->
        <div class="box">
          <div class="box-body">
            <form id="formMain" enctype="multipart/form-data" style="margin-bottom:20px;">
              <div class="col-xs-12">
                <div class="form-group col-sm-4">
                <label>Adicione Tag:</label>
                <!-- <br> -->
                <input type="" id="page" name="page" value="">
                </div>
              </div>
              <ul id="navBar" class="nav nav-tabs"></ul>
              <div id="tabContent" class="tab-content"></div>
              <button class="btn btn-right btn-primary">Guardar</button>
              <input type="hidden" name="cmdEval" value="addTermsTag">
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
      // $(document).ready(function() {
      //   funCreateItems();
      // });

        // function funCreateItems(){
        //     var xmlhttp = new XMLHttpRequest();
        //     xmlhttp.onreadystatechange = function() {
        //         if (this.readyState == 4 && this.status == 200) {
        //             var response = this.responseText;
        //             var viArrayValues = response.split("||");
        //             if(viArrayValues[0] == "true"){
        //                 document.getElementById("navBar").innerHTML = viArrayValues[1];
        //                 document.getElementById("tabContent").innerHTML = viArrayValues[2];
        //                 // document.getElementById("pageType").value = viArrayValues[3];
        //
        //                 $("textarea").wysihtml5({
        //                   toolbar: {
        //                     "font-styles": false, //Font styling, e.g. h1, h2, etc. Default true
        //                     "emphasis": true, //Italics, bold, etc. Default true
        //                     "lists": false, //(Un)ordered lists, e.g. Bullets, Numbers. Default true
        //                     "html": true, //Button which allows you to edit the generated HTML. Default false
        //                     "link": true, //Button to insert a link. Default true
        //                     "image": false, //Button to insert an image. Default true,
        //                     "color": false, //Button to change color of font
        //                     "blockquote": false
        //                   }
        //                 });
        //             }else{
        //                 //alert("ERRO");
        //                 $.notify("Oppsss... Aconteceu um erro ao tentar ir buscar informação tradução!","error");
        //             }
        //         }
        //     };
        //     var query = window.location.search.substring(1);
        //     xmlhttp.open("GET", "includes/getInformation.php?cmdEval=getSlideSimpleNew&" + query, true);
        //     xmlhttp.send();
        // }

      $(document).on("submit", "form", function(event) {
            event.preventDefault();
            var str = $( "form" ).serialize();
            var url = "includes/addInformation.php";
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
                  $.notify("Oppsss... Aconteceu um erro ao tentar adicionar Tag para os Termos!","error");
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
