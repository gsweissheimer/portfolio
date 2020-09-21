<?php include_once("includes/session.php");?>
<?php include_once("includes/notifications.php");?>
<?php include_once("../includes/globalVars.php");?>
<?php $_SESSION['mainPage'] = "utilizadores.php";?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title> | Adicionar Utilizadores</title>
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
          Adicionar Utilizador
          
        </h1>
        <ol class="breadcrumb">
          <li><a href="index.php"><i class="fa fa-dashboard"></i> Home</a></li>
          <li><a href="utilizador-adicionar.php">Utilizadores</a></li>
          <li class="active"><a href="#">Adicionar</a></li>
        </ol>
      </section>

      <!-- Main content -->
      <section class="content">

        <!-- Default box -->
        <div class="box">
          <div class="box-body">
            <form id="frmFaq" enctype="multipart/form-data" style="margin-bottom:20px;">
              <div class="col-lg-12">
        				<div class="form-group">
        				      <label>Permissões:</label>
                      <select class="form-control" id="permissionId" name="permissionId" required>
                        <option value="">Selecionar</option>
                        <?php
                          include_once(PATH_DATABASE);
                				  $db = Database::getInstance();
                				  $connection = $db->getConnection();
                          $sqlCmd = "SELECT
                  											*
                  										FROM
                  											tb_permissions
      									             WHERE
                  										deleted = 0";
                  				$values = "";
                  				if ($result = $connection->query($sqlCmd)) {
                  					while($rsData = mysqli_fetch_assoc($result)){
                              echo '<option value="'.$rsData['id'].'">'.$rsData['permission'].'</option>';
                            }
                          }
                        ?>
                      </select>
        				</div>
              </div>
              <div class="col-lg-12">
        				<div class="form-group">
        				      <label>Nome Utilizador:</label>
                      <input type="text" class="form-control" id="nameUser" name="nameUser" required>
        				</div>
              </div>
              <div class="col-lg-12">
        				<div class="form-group">
        				      <label>Pais:</label>
                      <select class="form-control" id="countryId" name="countryId" required>
                        <option value="">Selecionar</option>
                        <?php
                          include_once(PATH_DATABASE);
                				  $db = Database::getInstance();
                				  $connection = $db->getConnection();
                          $sqlCmd = "SELECT
                  											*
                  										FROM
                  											tb_country
      									             WHERE
                  										status = 1";
                  				$values = "";
                  				if ($result = $connection->query($sqlCmd)) {
                  					while($rsData = mysqli_fetch_assoc($result)){
                              echo '<option value="'.$rsData['id'].'">'.$rsData['country'].'</option>';
                            }
                          }
                        ?>
                      </select>
        				</div>
              </div>
              <div class="col-lg-12">
        				<div class="form-group">
        				      <label>Idioma:</label>
                      <select class="form-control" id="langID" name="langID" required>
                        <<option value="">Selecionar</option>
                        <?php
                          include_once(PATH_DATABASE);
                				  $db = Database::getInstance();
                				  $connection = $db->getConnection();
                          $sqlCmd = "SELECT
                  											*
                  										FROM
                  											tb_language
      									             WHERE
                  										deleted = 0";
                  				$values = "";
                  				if ($result = $connection->query($sqlCmd)) {
                  					while($rsData = mysqli_fetch_assoc($result)){
                              echo '<option value="'.$rsData['id'].'">'.$rsData['lang'].'</option>';
                            }
                          }
                        ?>
                      </select>
        				</div>
              </div>
              <div class="col-lg-12">
        				<div class="form-group">
        				      <label>Password:</label>
                      <input type="password" class="form-control" id="userPassword" name="userPassword" required>
        				</div>
              </div>
              <div class="col-lg-12">
        				<div class="form-group">
        				      <label>Repetir Password:</label>
                      <input type="password" class="form-control" id="checkPassword" name="checkPassword" required>
        				</div>
              </div>
              <button class="btn btn-right btn-primary">Guardar</button>
              <input type="hidden" name="cmdEval" value="addUser">
              <input type="hidden" name="idUser" value="">
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


      $(document).on("submit", "form", function(event) {
            event.preventDefault();
            var str = $( "form" ).serialize();
            var url = "includes/users.php";
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

    </script>
  </body>
</html>
