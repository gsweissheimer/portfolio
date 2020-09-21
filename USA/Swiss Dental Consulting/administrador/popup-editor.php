<?php include_once 'includes/session.php'; ?>
<?php include_once 'includes/notifications.php'; ?>
<?php include_once '../includes/globalVars.php'; ?>
<?php $_SESSION['mainPage'] = 'popup.php'; ?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title> | Edit Popup</title>
    <?php include_once 'includes/head.php'; ?>
    <link rel="stylesheet" href="assets/plugins/daterangepicker/daterangepicker.css">
    <style >
    ._fileupload
    {

    }
    ._fileuploadinput
    {


    }
    .shadow-textarea textarea.form-control::placeholder {
    font-weight: 300;
    }
    .shadow-textarea textarea.form-control {
        padding-left: 0.8rem;
    }
    </style>
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
          Adicionar Popup
          
        </h1>
        <ol class="breadcrumb">
          <li><a href="index.php"><i class="fa fa-dashboard"></i> Home</a></li>
          <li><a href="popup.php">Popup</a></li>
          <li class="active"><a href="#">Adicionar</a></li>
        </ol>
      </section>

      <!-- Main content -->
      <section class="content">

        <!-- Default box -->
        <div class="box">
          <div class="box-body">
            <form id="formMain" enctype="multipart/form-data" style="margin-bottom:20px;">





              <?php 
                        include_once PATH_DATABASE;
                        $db = Database::getInstance();
                        $connection = $db->getConnection();
                        $ItemToEiditId = $_REQUEST['id'];

                        $sqlCmd = 'SELECT popup_name, ';
                        $sqlCmd .= ' id_form,';
                        $sqlCmd .= 'name_form,';
                        $sqlCmd .= 'back_up,';
                        $sqlCmd .= 'back_modal,';
                        $sqlCmd .= 'back_form,';
                        $sqlCmd .= '_start_date,';
                        $sqlCmd .= 'finish_date ';
                        $sqlCmd .= ' From tb_popup_customise ';
                        $sqlCmd .= ",tb_popup_translation where tb_popup_customise.id=idTbpopup and tb_popup_customise.id=$ItemToEiditId";

                        if ($result = $connection->query($sqlCmd)) {
                            $rsData = mysqli_fetch_assoc($result);
                        }
                        $db->closeConnection();
              ?>
              
              <!--<ul id="navBar" class="nav nav-tabs"></ul> -->

                <div class="col-xs-12">
                  <div class="form-group">
                    <label for="Name">Popup Name:</label>
                    <input type="text" class="form-control" id="popupnameid1" value="<?php echo $rsData['popup_name']; ?>" name="popupname">
                  </div>
                </div>
                <div class="col-xs-6">
                  <div class="form-group">
                    <label for="formid">Form Id:</label>
                    <input type="text" class="form-control" id="Formid1" value="<?php echo $rsData['id_form']; ?>" name="formid">
                  </div>
                </div>
                <div class="col-xs-6">
                  <div class="form-group">
                    <label for="formid">Form name:</label>
                    <input type="text" class="form-control" id="Formname1" value="<?php echo $rsData['name_form']; ?>" name="formname">
                  </div>
                </div>
<!--//////////////////////////////////////////NEW/////////////////////////////////////////////////////////////-->
              <ul id="navBar" class="nav nav-tabs"></ul>
              <div id="tabContent" class="tab-content"></div>

<!--///////////////////////////////////////////////////////////////////////////////////////////////////////////-->




                <div class="col-xs-6">
                  <div class="form-group">
                    <label for="popupstartdate">Start date:</label>
                    <input type="date" class="form-control" id="popupstartdate1" value="<?php echo $rsData['_start_date']; ?>" name="popupstartdate">
                  </div>
                </div>
                <div class="col-xs-6">
                  <div class="form-group">
                    <label for="popupend date">Popup end date:</label>
                    <input type="date" class="form-control" id="popupenddate1" value="<?php echo $rsData['finish_date']; ?>" name="popupenddate">
                  </div>
                </div>

            <div class="col-xs-6" >    
                <label>Backup Image</label>
                 <input class="_fileuploadinput file btn btn-lg btn-primary _fileupload" type="file" name="backup_image" id="Backup_Image1" value="<?php echo $rsData['back_up']; ?>">
            </div>
            <div class="col-xs-6">
            <label>Current Image</label>
                  <?php
                                     $imagePath = PATH_POPUP_IMG.$rsData['back_up'];
                          $image = "<img src='../".$imagePath."' style='width:100px;height:75px'/>";
                          echo $image;
                 ?>
            </div>

            <div class="col-xs-6 ">    
                <label>Backup model</label>
                 <input class="_fileuploadinput file btn btn-lg btn-primary _fileupload" type="file" name="Backup_Model" id="Backup_Model1" value="<?php echo $rsData['back_modal']; ?>">
            </div>
            <div class="col-xs-6">
            <label>Current Image</label>
                  <?php
                                     $imagePath = PATH_POPUP_IMG.$rsData['back_modal'];
                          $image = "<img src='../".$imagePath."' style='width:100px;height:75px'/>";
                          echo $image;
                 ?>
            </div>


            <div class="col-xs-12" style="margin-top:10px"> 
                <?php 
                if ($rsData['back_form'] == 'none') {
                    $_lable1 = 'The current background is <b>Transparent</b>. But you can chenge it here';
                    $_lable2 = 'or keept it transparent';
                } else {
                    $_lable1 = 'You see the current background. you can change it by clicking on it ';
                    $_lable2 = 'or you can make it transparent';
                }
                ?>   
                <label><?php echo $_lable1; ?></label>
                <div class="btn btn-primary">
                  <input type="color" name="favcolor" id="colorselector"  value="<?php if ($rsData['back_form'] == 'none') {
                    echo '#fff';
                } else {
                    echo $rsData['back_form'];
                }?>">
                </div>
                <label> <?php echo $_lable2; ?></label>
                <div class="btn btn-info">
                  <input type="checkbox" name="istransparet" id="istransparet1" <?php if ($rsData['back_form'] == 'none') {
                    echo 'checked';
                }?>>
                </div>
            </div>

              <!--<div id="tabContent" class="tab-content"></div> -->
              <div class="col-xs-12 " style="margin-top:20px">
                  <button class="btn btn-right btn-primary"  style="width:100%">Guardar</button>
              </div>
              <input type="hidden" name="cmdEval" value="editPopup">
              <input type="hidden" name="IDPOPUP" value="<?php echo $ItemToEiditId; ?>">
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
                  //console.log(response);
                  //return false;
                  if(viArrayValues[0] == "true"){
                      document.getElementById("navBar").innerHTML = viArrayValues[1];
                      document.getElementById("tabContent").innerHTML = viArrayValues[2];
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
                      //funStartEditor();
                  }else{
                      //alert("ERRO");
                      $.notify("Oppsss... Aconteceu um erro ao tentar ir buscar informação tradução!","error");
                  }
              }
          };
          var query = window.location.search.substring(1);
          xmlhttp.open("GET", "includes/getInformation.php?cmdEval=getPopupEdit&" + query, true);
          xmlhttp.send();
      }


      $(document).on("submit", "form", function(event) {
        //alert("form" );
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
