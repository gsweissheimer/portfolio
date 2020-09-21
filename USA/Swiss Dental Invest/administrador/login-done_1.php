<!-- PHP -->
<?php
  include_once("includes/session.php");
	// user is not logged in.

    if (isset($_REQUEST['nameUser'])){
        include_once("../includes/globalVars.php");
        include_once(PATH_DATABASE);
        include_once('includes/utils.php');
        include_once("class/class.encryption.php");

        $enc = new Encryption();
        $enc->setKey(ENC_KEY);
        $db = Database::getInstance();
        $connection = $db->getConnection();

        $viLogin = $_REQUEST['nameUser'];
        $viPass = $_REQUEST['pwUser'];
        $viBot = $_REQUEST['bot'];

        if($viBot == ""){
          $sqlCmd = "SELECT id, userName, pwd,keyuser,idTbPermissions FROM tb_users WHERE deleted= 0 AND userName = '$viLogin'";
          if ($result = $connection->query($sqlCmd)) {
  			      if(mysqli_num_rows($result)!= 1) {
                  header("location:login.php");
              }else{
                  $row = mysqli_fetch_assoc($result);
              		$decryptedData = base64_decode($row['pwd']);
                  if($enc->compareStrings($viPass,$decryptedData) == 'true'){
                    setcookie("usr_ck_name",$row['userName'],time()+3600);
                    setcookie("usr_ck_user",$row['keyuser'],time()+3600);
                    setcookie("usr_id",$row['id'],time()+3600);
                    setcookie("usr_per",$row['idTbPermissions'],time()+3600);
                    $_SESSION['nameUser'] = $row['userName'];
                    $_SESSION['title'] = "Login";
                    $_SESSION['description'] = "Bem-vindo";
                    $_SESSION['typeError'] = "success";
                    header("location:dashboard.php");
                  }else{
                    $_SESSION['title'] = "Dados Errados";
                    $_SESSION['description'] = "Dados Errados";
                    $_SESSION['typeError'] = "error";
                    header("location:login.php");
                  }
              }
          }
        }else{
          $_SESSION['title'] = "Dados Errados";
          $_SESSION['description'] = "Dados Errados";
          $_SESSION['typeError'] = "error";
          header("location:login.php");
        }
    } else {
        $_SESSION['title'] = "Dados Errados";
        $_SESSION['description'] = "Dados Errados";
        $_SESSION['typeError'] = "error";
        header("location:login.php");
    }
 ?>
