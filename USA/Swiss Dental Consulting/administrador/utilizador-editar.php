<?php include_once("includes/session.php");?>
<?php include_once("includes/notifications.php");?>
<?php include_once("../includes/globalVars.php");?>
<?php $_SESSION['mainPage'] = "utilizadores.php";?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title> SDS | Editar Utilizador</title>
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
          Editar Utilizador
          
        </h1>
        <ol class="breadcrumb">
          <li><a href="index.php"><i class="fa fa-dashboard"></i> Home</a></li>
          <li><a href="utilizadores.php">Utilizadores</a></li>
          <li class="active"><a href="#">Editar</a></li>
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
                        <<option value="">Selecionar</option>
                        <?php
                          include_once(PATH_DATABASE);
                				  $db = Database::getInstance();
                				  $connection = $db->getConnection();
                          $iduser = $_REQUEST["id"];
                          $sqlCmd = "SELECT
                                        *
                                      FROM
                                        tb_users
                                     WHERE
                                      deleted = 0
                                    AND
                                      id=$iduser";
                          $values = "";
                          if ($result = $connection->query($sqlCmd)) {
                            while($rsData = mysqli_fetch_assoc($result)){
                              $name=$rsData["userName"];
                              $idtbPermissions=$rsData["idtbPermissions"];
                              $idtbCountry=$rsData['idTbCountry'];
                              $idtbLang = $rsData['idTbLanguage'];
                            }
                          }

                          $sqlCmd = "SELECT
                  											*
                  										FROM
                  											tb_permissions
      									             WHERE
                  										deleted = 0";
                  				$values = "";
                  				if ($result = $connection->query($sqlCmd)) {
                  					while($rsData = mysqli_fetch_assoc($result)){
                              if($idtbPermissions == $rsData["id"]){
                                echo '<option value="'.$rsData['id'].'" selected>'.$rsData['permission'].'</option>';
                              }else{
                                echo '<option value="'.$rsData['id'].'">'.$rsData['permission'].'</option>';
                              }
                            }
                          }
                        ?>
                      </select>
        				</div>
              </div>
              <div class="col-lg-12">
        				<div class="form-group">
        				      <label>Nome Utilizador:</label>
                      <input type="text" class="form-control" id="nameUser" name="nameUser" value="<?= $name ?>" required>
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
                      <input type="password" class="form-control" id="userPassword" name="userPassword">
        				</div>
              </div>
              <div class="col-lg-12">
        				<div class="form-group">
        				      <label>Repetir Password:</label>
                      <input type="password" class="form-control" id="checkPassword" name="checkPassword">
        				</div>
              </div>
              <button class="btn btn-right btn-primary">Guardar</button>
              <input type="hidden" name="cmdEval" value="editUser">
              <input type="hidden" name="idUser" value="<?= $iduser ?>">
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
    window.onload= funSetValue();

      function funSetValue(){
        document.getElementById('countryId').value = <?= $idtbCountry ?>;
        document.getElementById('langID').value = <?= $idtbLang ?> ;
      }

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
                        setTimeout(function(){ location.reload(); }, 3000);

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
