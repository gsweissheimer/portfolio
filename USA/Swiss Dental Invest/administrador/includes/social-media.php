<?php
include_once('../../includes/globalVars.php');
$cmdEval = $_REQUEST['cmdEval'];
switch ($cmdEval) {
  case 'GetSocialMediaGenericInfo':
      funGetSocialMediaGenericInfo();
      break;
  case 'addSocialMedia':
      funAddSocialMedia();
      break;
  case 'getSocialMedias':
      funGetSocialMedias();
      break;
  case 'deleteSocialMedia':
      funDeleteSocialMedia();
      break;
  case 'GetSocialMedia':
      funGetSocialMedia();
      break;
  case 'editSocialMedia':
      funEditSocialMedia();
      break;
  default:
    # code...
    break;
  }

function funGetSocialMediaGenericInfo(){
  include_once(PATH_DATABASE_INC);
  $db = Database::getInstance();
  $connection = $db->getConnection();

  $sqlCmdGetSocialMedias = "SELECT *
                            FROM tb_socialmedia_type";

  $socialmedia=[];
 if ($result = $connection->query($sqlCmdGetSocialMedias)){
   while($row = mysqli_fetch_assoc($result)){
     array_push($socialmedia,array($row['id'],$row['name']));
   }
 }

 $sqlCmdGetCountries = "SELECT *
                        FROM tb_country";

  $countries = [];
  if ($result1 = $connection->query($sqlCmdGetCountries)){
    while($row1 = mysqli_fetch_assoc($result1)){
      array_push($countries,array($row1['id'],$row1['country']));
    }
  }
 echo "true||".json_encode($socialmedia)."||".json_encode($countries);
}

function funAddSocialMedia(){
  include_once('session.php');
  include_once('utils.php');
  include_once(PATH_DATABASE_INC);
  $db = Database::getInstance();
  $connection = $db->getConnection();

  $idSocialMedia = $_REQUEST['socialmedia'];
  $idCountry = $_REQUEST['country'];
  $url = $_REQUEST['url'];
	$viDateC = "'" . date("Y-m-d H:i:s") . "'";

  $sqlCmd = "INSERT INTO tb_socialmedia (dateO, userO, url, idTbCountry, idTbSocialType) VALUES";
  $sqlCmd .= "($viDateC, $usr_id, '$url', $idCountry, $idSocialMedia)";

  $result = $connection->query($sqlCmd);

  if($result){
    echo "true||Operação realizada com sucesso.";
    $action = "[ADD_SOCIALMEDIA] - Success adding social media";
    funCreateLog($action, $connection);
    $db->commitAndClose();
  } else {
    $action = "[ADD_SOCIALMEDIA] - Failed to add social media";
    funCreateLog($action, $connection);
    $db->rollbackAndClose();
    die("false||Ocorreu um erro ao tentar adicionar a rede social.");
  }
}

function funGetSocialMedias(){
  include_once(PATH_DATABASE_INC);
  $db = Database::getInstance();
  $connection = $db->getConnection();

  $sqlCmd = "SELECT
              tb_country.country,
              tb_socialmedia_type.name,
              tb_socialmedia.url,
              tb_socialmedia.id
              FROM
              tb_socialmedia
              JOIN tb_country
              ON tb_socialmedia.idTbCountry = tb_country.id
              JOIN tb_socialmedia_type
              ON tb_socialmedia.idTbSocialType = tb_socialmedia_type.id
              WHERE tb_socialmedia.status = 1";

  $values = "";
  if ($result = $connection->query($sqlCmd)){
      $arrayMain = [];
    while($row = mysqli_fetch_assoc($result)){
      $urlToEdit = "location.href='redes-sociais-editar.php?id=".$row['id']."'";
      $urlToDelete = "funDeleteItem(".$row['id'].")";
      $urlToSeeMore = "location.href='utilizador-mais.php?id=".$row['id']."'";
      $values =	'<button class="fa fa-edit" style="padding:5px; margin-left:10px" onclick="'.$urlToEdit.'"></button>';
      $values .=	'<button class="fa fa-trash" style="padding:5px; margin-left:10px" onclick="'.$urlToDelete.'"></button>';
      //$values .=	'<button class="fa fa-eye" style="padding:5px; margin-left:10px" onclick="'.$urlToSeeMore.'"></button>';
      array_push($arrayMain,array($row['id'],$row['name'],$row['country'],$row['url'],$values));
    }
    echo json_encode($arrayMain);
  }
}

function funDeleteSocialMedia(){
  include_once('session.php');
  include_once('utils.php');
  include_once(PATH_DATABASE_INC);
  $db = Database::getInstance();
  $connection = $db->getConnection();

  $id = $_REQUEST['id'];
  $viDateC = "'" . date("Y-m-d H:i:s") . "'";

  $sqlCmd = "UPDATE tb_socialmedia SET dateO=$viDateC, userO=$usr_id, status = 0 WHERE id=$id";

  $result = $connection->query($sqlCmd);
  if ($result) {
    $action = "[DELETE SOCIAL_MEDIA] - Sucess deleting #" .$id;
    funCreateLog($action, $connection);
    $db->commitAndClose();
    echo "true||Operação realizada com sucesso.";
  }else{
    $action = "[DELETE SOCIAL_MEDIA] - Error Editing #" .$id;
    funCreateLog($action, $connection);
    $db->rollbackAndClose();
    echo "false||Operação Falhou.";
  }
}

function funGetSocialMedia(){
  include_once(PATH_DATABASE_INC);
  $db = Database::getInstance();
  $connection = $db->getConnection();

  $id=$_REQUEST['id'];

  $sqlCmd = "SELECT
              url,
              idTbCountry,
              idTbSocialType
              FROM
              tb_socialmedia
              WHERE status = 1
              AND id = $id";

  if ($result = $connection->query($sqlCmd)){
      $arrayMain = [];
    while($row = mysqli_fetch_assoc($result)){
      array_push($arrayMain,array($row['idTbSocialType'],$row['idTbCountry'],$row['url']));
    }

    $sqlCmdGetSocialMedias = "SELECT *
                              FROM tb_socialmedia_type";

    $socialmedia=[];
   if ($result = $connection->query($sqlCmdGetSocialMedias)){
     while($row = mysqli_fetch_assoc($result)){
       array_push($socialmedia,array($row['id'],$row['name']));
     }
   }

   $sqlCmdGetCountries = "SELECT *
                          FROM tb_country";

    $countries = [];
    if ($result1 = $connection->query($sqlCmdGetCountries)){
      while($row1 = mysqli_fetch_assoc($result1)){
        array_push($countries,array($row1['id'],$row1['country']));
      }
    }
   echo "true||".json_encode($socialmedia)."||".json_encode($countries)."||".json_encode($arrayMain);
  }
}

function funEditSocialMedia(){
  include_once('session.php');
  include_once('utils.php');
  include_once(PATH_DATABASE_INC);
  $db = Database::getInstance();
  $connection = $db->getConnection();

  $id = $_REQUEST['idSocialMedia'];
  $idSocialMedia = $_REQUEST['socialmedia'];
  $idCountry = $_REQUEST['country'];
  $url = $_REQUEST['url'];
  $viDateC = "'" . date("Y-m-d H:i:s") . "'";

  $sqlCmd = "UPDATE tb_socialmedia SET dateO=$viDateC, userO=$usr_id, url='$url',";
  $sqlCmd .= " idTbCountry=$idCountry, idTbSocialType=$idSocialMedia WHERE id=$id";


  if($result = $connection->query($sqlCmd)){
    $action = "[UPDATE SOCIAL_MEDIA] - Sucess updating #" .$id;
    funCreateLog($action, $connection);
    $db->commitAndClose();
    echo "true||Operação realizada com sucesso.";
  } else {
    $action = "[UPDATE SOCIAL_MEDIA] - Error updating #" .$id;
    funCreateLog($action, $connection);
    $db->rollbackAndClose();
    echo "false||Operação Falhou.";
  }
}

?>
