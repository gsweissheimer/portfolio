<?php
include_once('../../includes/globalVars.php');
$cmdEval = $_REQUEST['cmdEval'];
switch ($cmdEval) {
  case 'addLanguage':
      funAddLanguage();
      break;
  case 'getLanguages':
      funGetLanguages();
      break;
  case 'deleteLanguage':
      funDeleteLanguage();
      break;
  case 'getLanguage':
      funGetLanguage();
      break;
  case 'editLanguage':
      funEditLanguage();
      break;
  default:
    # code...
    break;
  }

function funAddLanguage(){
  include_once('session.php');
  include_once('utils.php');
  include_once(PATH_DATABASE_INC);
  $db = Database::getInstance();
  $connection = $db->getConnection();

  $viDateC = "'" . date("Y-m-d H:i:s") . "'";
  $language = $_REQUEST['idiom'];
  $langMin = $_REQUEST['idiomAbr'];

  $sqlCmd = "INSERT INTO tb_language (dateC, userC, dateU, userU, lang, langMin, statusLang, deleted)";
  $sqlCmd.= " VALUES ($viDateC, $usr_id, $viDateC, $usr_id, '$language', '$langMin', 1,0)";

  $result = $connection->query($sqlCmd);

  if($result){
    echo "true||Operação realizada com sucesso.";
    $action = "[ADD LANGUAGE] - Success adding language";
    funCreateLog($action, $connection);
    $db->commitAndClose();
  } else {
    $action = "[ADD LANGUAGE] - Failed to add language";
    funCreateLog($action, $connection);
    $db->rollbackAndClose();
    die("false||Ocorreu um erro ao tentar adicionar o idioma.");
  }

}

function funGetLanguages(){
  include_once(PATH_DATABASE_INC);
  $db = Database::getInstance();
  $connection = $db->getConnection();

  $sqlCmd = "SELECT *
             FROM tb_language
             WHERE deleted = 0";

 $values = "";
 if ($result = $connection->query($sqlCmd)){
     $arrayMain = [];
   while($row = mysqli_fetch_assoc($result)){
     $urlToEdit = "location.href='idiomas-editar.php?id=".$row['id']."'";
     $urlToDelete = "funDeleteItem(".$row['id'].")";
     $urlToSeeMore = "location.href='utilizador-mais.php?id=".$row['id']."'";
     $values =	'<button class="fa fa-edit" style="padding:5px; margin-left:10px" onclick="'.$urlToEdit.'"></button>';
     $values .=	'<button class="fa fa-trash" style="padding:5px; margin-left:10px" onclick="'.$urlToDelete.'"></button>';
     //$values .=	'<button class="fa fa-eye" style="padding:5px; margin-left:10px" onclick="'.$urlToSeeMore.'"></button>';
     array_push($arrayMain,array($row['id'],$row['lang'],$row['langMin'],$values));
   }
   echo json_encode($arrayMain);
 }
}


function funDeleteLanguage(){
  include_once('session.php');
  include_once('utils.php');
  include_once(PATH_DATABASE_INC);
  $db = Database::getInstance();
  $connection = $db->getConnection();

  $id = $_REQUEST['id'];
  $viDateC = "'" . date("Y-m-d H:i:s") . "'";

  $sqlCmd = "UPDATE tb_language SET dateU=$viDateC, userU=$usr_id, deleted = 1 WHERE id=$id";

  $result = $connection->query($sqlCmd);
  if ($result) {
    $action = "[DELETE LANGUAGE] - Sucess deleting #" .$id;
    funCreateLog($action, $connection);
    $db->commitAndClose();
    echo "true||Operação realizada com sucesso.";
  }else{
    $action = "[DELETE LANGUAGE] - Error Editing #" .$id;
    funCreateLog($action, $connection);
    $db->rollbackAndClose();
    echo "false||Operação Falhou.";
  }
}

function funGetLanguage(){
  include_once(PATH_DATABASE_INC);
  $db = Database::getInstance();
  $connection = $db->getConnection();

  $id=$_REQUEST['id'];

   $sqlCmd = "SELECT *
              FROM tb_language
              WHERE id=$id";

    $viArrayValues = [];
    if ($result1 = $connection->query($sqlCmd)){
      while($row1 = mysqli_fetch_assoc($result1)){
        array_push($viArrayValues,array($row1['lang'],$row1['langMin']));
      }
    }
   echo "true||".json_encode($viArrayValues);
  }

function funEditLanguage(){
  include_once('session.php');
  include_once('utils.php');
  include_once(PATH_DATABASE_INC);
  $db = Database::getInstance();
  $connection = $db->getConnection();

  $id = $_REQUEST['id'];
  $language = $_REQUEST['idiom'];
  $langMin = $_REQUEST['idiomAbr'];
  $viDateC = "'" . date("Y-m-d H:i:s") . "'";

  $sqlCmd = "UPDATE tb_language SET dateU=$viDateC, userU=$usr_id, lang='$language', langMin='$langMin'";
  $sqlCmd.= "WHERE id=$id";

  $result = $connection->query($sqlCmd);

  if($result){
    echo "true||Operação realizada com sucesso.";
    $action = "[UPDATE LANGUAGE] - Success updating language";
    funCreateLog($action, $connection);
    $db->commitAndClose();
  } else {
    $action = "[UPDATE LANGUAGE] - Failed to update language";
    funCreateLog($action, $connection);
    $db->rollbackAndClose();
    die("false||Ocorreu um erro ao tentar actualizar o idioma.");
  }
}
