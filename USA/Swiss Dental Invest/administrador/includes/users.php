<?php
include_once('../../includes/globalVars.php');
include_once('utils.php');
$cmdEval = $_REQUEST['cmdEval'];
switch ($cmdEval) {
  case 'getusers':
    funCreateListUsers();
    break;
  case 'addUser':
	    if($_REQUEST['bot'] == ""){funAddUser();}else{die();}
      break;
  case 'editUser':
    if($_REQUEST['bot'] == ""){funEditUser();}else{ die();}
    break;
  case 'editPass':
    if($_REQUEST['bot'] == ""){funEditPass();}else{ die();}
    break;
  case 'editUsername':
    if($_REQUEST['bot'] == ""){funEditUsername();}else{ die();}
    break;
  default:
    # code...
    break;
}

function funCreateListUsers(){
  include_once(PATH_DATABASE_INC);
  $db = Database::getInstance();
  $connection = $db->getConnection();
  $sqlCmd = "SELECT
              tb_users.id ,
              tb_permissions.permission ,
              tb_users.userName
            FROM
              tb_users
            JOIN tb_permissions ON tb_users.idtbPermissions = tb_permissions.id
            WHERE
              tb_users.deleted = 0";
  $values = "";
  if ($result = $connection->query($sqlCmd)) {
    $arrayMain = [];
    while($rsData = mysqli_fetch_assoc($result)){
        $urlToEdit = "location.href='utilizador-editar.php?id=".$rsData['id']."'";
        $urlToDelete = "funDeleteItem(".$rsData['id'].")";
        $urlToSeeMore = "location.href='utilizador-mais.php?id=".$rsData['id']."'";
        $values =	'<button class="fa fa-edit" style="padding:5px; margin-left:10px" onclick="'.$urlToEdit.'"></button>';
        $values .=	'<button class="fa fa-trash" style="padding:5px; margin-left:10px" onclick="'.$urlToDelete.'"></button>';
        $values .=	'<button class="fa fa-eye" style="padding:5px; margin-left:10px" onclick="'.$urlToSeeMore.'"></button>';
        array_push($arrayMain,[$rsData['id'],$rsData['userName'],$rsData['permission'],$values]);
    }
  }
  echo json_encode($arrayMain);
  $db->closeConnection();
}

function funAddUser(){
  include_once('session.php');
  include_once('utils.php');
  include_once(PATH_DATABASE_INC);
  include_once("../class/class.encryption.php");
  $enc = new Encryption();
  $enc->setKey(ENC_KEY);
  $db = Database::getInstance();
  $connection = $db->getConnection();
  $viNameUser = $_REQUEST['nameUser'];
  $viPermission = $_REQUEST['permissionId'];
  $viPass = $_REQUEST['userPassword'];
  $viPasscheck = $_REQUEST['checkPassword'];
  $viCountry = $_REQUEST['countryId'];
  $viLang = $_REQUEST['langID'];
  $viDateC = "'" . date("Y-m-d H:i:s") . "'";
  $keyuser=MD5(rand());
  if($viPass != "" && $viNameUser != "" && $viPermission != "" && $viPass != "" && $viPasscheck != ""){
    if($viPass==$viPasscheck){
      $viPass = base64_encode($enc->encrypt($viPass));
      $sqlCmd = "INSERT INTO tb_users( dateC, dateU, keyuser, userName, pwd, deleted, idtbPermissions, idTbLanguage, idTbCountry)";
      $sqlCmd .= "VALUES ($viDateC,$viDateC,'$keyuser','$viNameUser','$viPass',0,$viPermission,$viLang,$viCountry)";
      $result = $connection->query($sqlCmd);
      if ($result) {
          $new_id = $connection->insert_id;
          $action = "[ADD_USER] - Sucess added #" .$new_id;
          funCreateLog($action, $connection);
          $db->commitAndClose();
          echo "true||Operação realizada com sucesso.";
      }else{
        $action = "[ADD_USER] - sql failed";
        funCreateLog($action, $connection);
        $db->rollbackAndClose();
        die("false||Oppsss... ocorreu um erro ao inserir.");
      }
    }else{
      $action = "[ADD_USER] - Failed password doesnt match";
      funCreateLog($action, $connection);
      $db->rollbackAndClose();
      die("false||Oppsss...As Passwords não coincidem.");

    }
  }else{
    $action = "[ADD_USER] - Failed values came empty";
    funCreateLog($action, $connection);
    $db->rollbackAndClose();
    die("false||Oppsss...alguns valores estão vazios.");
  }
}


	function funEditUser(){
		include_once('session.php');
		include_once('utils.php');
		include_once(PATH_DATABASE_INC);
		$db = Database::getInstance();
		$connection = $db->getConnection();
		include_once("../class/class.encryption.php");
		$enc = new Encryption();
		$enc->setKey(ENC_KEY);
		$viDateC = "'" . date("Y-m-d H:i:s") . "'";
		$viID = $_REQUEST['idUser'];
		$viNameUser = $_REQUEST['nameUser'];
		$viPermission = $_REQUEST['permissionId'];
		$viPass = $_REQUEST['userPassword'];
		$viPasscheck = $_REQUEST['checkPassword'];
    $viCountry = $_REQUEST['countryId'];
    $viLang = $_REQUEST['langID'];
		if($viNameUser!= "" && $viPermission != ""){
			if($viPass != "" && $viPasscheck != ""){
				if($viPass==$viPasscheck){
					$viPass = base64_encode($enc->encrypt($viPass));
					$sqlCmd = "UPDATE tb_users SET dateU = $viDateC, userName = '$viNameUser', pwd= '$viPass', ";
					$sqlCmd .= "idtbPermissions = $viPermission, idTbLanguage=$viLang, idTbCountry=$viCountry WHERE id = $viID";
				}else{
					$action = "[EDIT_USER] - Failed password doesnt match";
					funCreateLog($action, $connection);
					$db->rollbackAndClose();
					die("false||Oppsss...As Passwords não coincidem.");

				}
			}else{
				$sqlCmd = "UPDATE tb_users SET dateU = $viDateC, userName = '$viNameUser',";
				$sqlCmd .= "idtbPermissions = $viPermission WHERE id = $viID";
			}

			$result = $connection->query($sqlCmd);
			if ($result) {
				$action = "[EDIT_USER] - Sucess added";
				funCreateLog($action, $connection);
				$db->commitAndClose();
				echo "true||Operação realizada com sucesso.";
			}else{
				$action = "[EDIT_USER] - sql failed";
				funCreateLog($action, $connection);
				$db->rollbackAndClose();
				die("false||Oppsss... ocorreu um erro ao editar.");
			}
		}else{
			$action = "[EDIT_USER] - values empty";
			funCreateLog($action, $connection);
			$db->rollbackAndClose();
			die("false||Oppsss... Alguns valores estão vazios.");
		}

	}

function funEditPass(){
  include_once('session.php');
  include_once('utils.php');
  include_once(PATH_DATABASE_INC);
  $db = Database::getInstance();
  $connection = $db->getConnection();
  include_once("../class/class.encryption.php");
  $enc = new Encryption();
  $enc->setKey(ENC_KEY);
  $viDateC = "'" . date("Y-m-d H:i:s") . "'";
  $newPass = $_REQUEST['pass'];
  $confirmPass = $_REQUEST['repPass'];

  if($newPass == $confirmPass){
    $viPass = base64_encode($enc->encrypt($newPass));

    $sqlCmd = "UPDATE tb_users SET dateU = $viDateC, pwd = '$viPass' WHERE id = $usr_id";

    if($connection->query($sqlCmd)){
      $action = "[EDIT_USER] - Sucess edit";
      funCreateLog($action, $connection);
      $db->commitAndClose();
      echo "true|| Password updated with sucess.";
    } else {
      $action = "[EDIT PASS] - password does not match";
      funCreateLog($action, $connection);
      $db->rollbackAndClose();
      die("false|| A problem occured during the password update.");
    }

  } else {
    $action = "[EDIT PASS] - password does not match";
    funCreateLog($action, $connection);
    $db->rollbackAndClose();
    die("false|| Both password does not match.");
  }
}

function funEditUsername(){
  include_once('session.php');
  include_once('utils.php');
  include_once(PATH_DATABASE_INC);
  $db = Database::getInstance();
  $connection = $db->getConnection();
  include_once("../class/class.encryption.php");
  $enc = new Encryption();
  $enc->setKey(ENC_KEY);
  $viDateC = "'" . date("Y-m-d H:i:s") . "'";
  $userName = $_REQUEST['user'];

  $sqlCmd = "UPDATE tb_users SET dateU = $viDateC, userName = '$userName' WHERE id = $usr_id";

  if($connection->query($sqlCmd)){
    $action = "[EDIT_USER] - Sucess edit";
    funCreateLog($action, $connection);
    $db->commitAndClose();
    echo "true|| Username updated with sucess.";
  } else {
    $action = "[EDIT PASS] - password does not match";
    funCreateLog($action, $connection);
    $db->rollbackAndClose();
    die("false|| A problem occured during the username update.");
  }
}

?>
