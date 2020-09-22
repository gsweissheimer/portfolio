<?php include_once("includes/session.php");?>
<div id="divNot"><?php include_once("includes/notifications.php");?></div>
<?php $_SESSION['mainPage'] = "clinicas.php";?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title> SDC | Redes Sociais</title>
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
          Redes Sociais
          
        </h1>
        <ol class="breadcrumb">
          <li><a href="index.php"><i class="fa fa-dashboard"></i> Home</a></li>
          <li class="active"><a href="#">Redes Sociais</a></li>
        </ol>
      </section>

      <!-- Main content -->
      <section class="content">

        <!-- Default box -->
        <div class="box">
          <div class="box-body">
            <table id="mainTable" class="table table-bordered table-striped">
              <thead>
              <tr>
                <th>#</th>
                <th>Rede Social</th>
                <th>País</th>
                <th>URL</th>
                <th>Acções</th>
              </tr>
              </thead>
              <tbody id="list">

              </tbody>
              <tfoot>
              <tr>
                <th>#</th>
                <th>Rede Social</th>
                <th>País</th>
                <th>URL</th>
                <th>Acções</th>
              </tr>
              </tfoot>
            </table>
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
      function funCreateList(vfMainTable){
          var xmlhttp = new XMLHttpRequest();
          xmlhttp.onreadystatechange = function() {
              if (this.readyState == 4 && this.status == 200) {
                  var response = this.responseText;
                  response = jQuery.parseJSON(response);
                  for (var i = 0; i < response.length; i++) {
                    vfMainTable.row.add( [ response[i][0], response[i][1], response[i][2], response[i][3], response[i][4]] )
                  }
                  vfMainTable.draw();
              }
          };
          var query = window.location.search.substring(1);
          xmlhttp.open("GET", "includes/social-media.php?cmdEval=getSocialMedias", true);
          xmlhttp.send();
      }

      $(function () {
        var mainTable = $("#mainTable").DataTable({responsive: true});
        var table = $('#mainTable').DataTable();
        $('#mainTable tbody').on( 'click', 'tr', function () {
            table.$('tr.selected').removeClass('selected');
            $(this).addClass('selected');
        } );
        funCreateList(mainTable);
      });

      function funDeleteItem(vfID){
          if (confirm('Tem a certeza que pertende eliminar esta rede social?')) {
              var xmlhttp = new XMLHttpRequest();
              xmlhttp.onreadystatechange = function() {
                  if (this.readyState == 4 && this.status == 200) {
                      var response = this.responseText;
                      var result = response.split("||");
                      if(result[0] == "true"){
                          var table = $('#mainTable').DataTable();
                          table.row('.selected').remove().draw( false );
                          $.notify(result[1],"success");
                      }else{
                        $.notify(result[1],"error");
                      }
                  }
              };
              xmlhttp.open("GET", "includes/social-media.php?cmdEval=deleteSocialMedia&id=" + vfID, true);
              xmlhttp.send();
          }
      }


    </script>
  </body>
</html>
