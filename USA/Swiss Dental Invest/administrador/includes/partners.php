<?php
include_once('../../includes/globalVars.php');
include_once('utils.php');
$cmdEval = $_REQUEST['cmdEval'];
switch ($cmdEval) {
  case 'getCountryLang':
    funGetCountryLang();
    break;
  case 'addPartner':
    funAddPartner();
    break;
  case 'getPartners':
    funGetPartners();
    break;
  case 'deletePartner':
    funDeletePartner();
    break;
  case 'getPartner':
    funGetPartner();
    break;
  case 'editPartner':
    funEditPartner();
    break;
  default:
    # code...
    break;
}

function funCreatePartner($vfArrayValues){
  if($vfArrayValues['flag'] == "true"){$active="active";}else{$active="";}
  $vfLangMin = $vfArrayValues['langMin'];
  $vfCountry = $vfArrayValues['country'];
  $value = '<div class="tab-pane fade '.$active.' in col-sm-12" id="'.$vfLangMin.'"> <br>';
  $value .= '		<div class="form-group">';
  $value .= '			<label>Call to  Action</label>';
  $value .= '			<input id="call_action" name="call_action_'.$vfCountry.'_'.$vfLangMin.'" class="form-control" value="'.$vfArrayValues['callAction'].'" required> ';
  $value .= '		</div>';
  $value .= '<input  type="hidden" id="idTrans" name="idTrans_'.$vfCountry.'_'.$vfLangMin.'" class="form-control" value="'.$vfArrayValues['idTrans'].'">';
  $value .= '</div>';
  return $value;
}


function funGetCountryLang(){
  include_once(PATH_DATABASE_INC);
  $db = Database::getInstance();
  $connection = $db->getConnection();
  $listFormBar = "";
  $listNavBar = "";
  $allInfo = "";

  $idCountry = $_REQUEST['countryId'];

  $sqlCmd = "SELECT
                   tb_language.id,
                   tb_language.lang,
                   tb_language.langMin,
                   tb_country.abbCountry
            FROM tb_country_language
            JOIN tb_language ON tb_language.id = tb_country_language.idTbLanguage
            JOIN tb_country ON tb_country.id = tb_country_language.idTbCountry
            WHERE tb_country_language.status =1
            AND
             tb_country.id=".$idCountry."
            ORDER BY tb_country_language.defaultLang DESC";

  $result = $connection->query($sqlCmd);

  if ($result) {
    while($row = mysqli_fetch_assoc($result)){
      if($listNavBar == ""){
        $listNavBar = '<li class="active"><a href="#'.$row['langMin'].'" data-toggle="tab" aria-expanded="true">'.$row['langMin'].'</a></li>';
      }else{
        $listNavBar .= '<li class=""><a href="#'.$row['langMin'].'" data-toggle="tab" aria-expanded="true">'.$row['langMin'].'</a></li>';
      }

      if($listFormBar != ""){$flag=false;}else{$flag=true;}
         $viArrayValues['country'] = $row['abbCountry'];
         $viArrayValues['langMin'] = $row['langMin'];
         $viArrayValues['callAction'] = "";
         $viArrayValues['idTrans'] = "";
         $viArrayValues['flag'] = $flag;
         $listFormBar .= funCreatePartner($viArrayValues);
       }
       $allInfo .= '<ul id="navBar" class="nav nav-tabs">';
       $allInfo .= $listNavBar;
       $allInfo .= '</ul>';
       $allInfo .= '<div id="tabContent" class="tab-content">';
       $allInfo .= $listFormBar;
       $allInfo .= '</div>';
     }
     echo "true||".$allInfo;
   }

function funAddPartner(){
  include_once('session.php');
  include_once('utils.php');
  include_once(PATH_DATABASE_INC);
  $db = Database::getInstance();
  $connection = $db->getConnection();
  $viDateC = "'" . date("Y-m-d H:i:s") . "'";

  $idCountry = $_REQUEST['country'];
  $idAdvantageTag = $_REQUEST['idAdvantageTag'];
  $position = $_REQUEST['position'];
  $partnerLogo = $_REQUEST['og_img'];
  $inserted = "";

  $sqlCmdAddPartner = "INSERT INTO tb_advantage (dateO, userO, position, status, idTbGallery, idTbAdvantageTag)";
  $sqlCmdAddPartner .= " VALUES ($viDateC, $usr_id, $position, 1, $partnerLogo ,$idAdvantageTag)";

  if($connection->query($sqlCmdAddPartner)){
    $idAdvantage = $connection ->insert_id;

    $sqlCmd = "SELECT
                     tb_language.id,
                     tb_language.lang,
                     tb_language.langMin,
                     tb_country.abbCountry
              FROM tb_country_language
              JOIN tb_language ON tb_language.id = tb_country_language.idTbLanguage
              JOIN tb_country ON tb_country.id = tb_country_language.idTbCountry
              WHERE tb_country_language.status =1
              AND
               tb_country.id=".$idCountry;

    if ($result = $connection->query($sqlCmd)){
      while($row = mysqli_fetch_assoc($result)){
          $cta= $_REQUEST['call_action_'.$row['abbCountry'].'_'.$row['langMin']];
          $idLanguage = $row['id'];

          $sqlCmdAddPartnerTranslation = "INSERT INTO tb_advantage_translation (dateO, userO, cta, idTbCountry, idTbLanguage, idTbAdvantage) VALUES ";
          $sqlCmdAddPartnerTranslation.= "($viDateC, $usr_id, '$cta', $idCountry, $idLanguage, $idAdvantage)";

          $result1 = $connection->query($sqlCmdAddPartnerTranslation);
          if(!$result1){
            $inserted = false;
            $action = "[ADD PARTNER] - Failed add  PARTNER TRANSLATIONS";
						funCreateLog($action, $connection);
						$db->rollbackAndClose();
						die("false||Ocorreu um problema ao inserir Parceiro #0002");
          } else {
            $inserted = true;
          }
      }
      if($inserted){
        echo "true||Operação realizada com sucesso.";
        $action = "[ADD_BANNER] - Success adding partner";
        funCreateLog($action, $connection);
        $db->commitAndClose();
      }
    }

  } else {
    $action = "[ADD PARTNER] - Failed adding partner";
    funCreateLog($action, $connection);
    $db->rollbackAndClose();
    die("false||Ocorreu um erro ao adicionar o parceiro.");
  }
}

function funGetPartners(){
  include_once(PATH_DATABASE_INC);
  $db = Database::getInstance();
  $connection = $db->getConnection();
  $arrayMain = [];

  $sqlCmd = "SELECT
                    tb_advantage_translation.cta,
                    tb_country.country,
                    tb_advantage.id
             FROM
                    tb_advantage_tag
             JOIN tb_advantage ON tb_advantage_tag.id = tb_advantage.idTbAdvantageTag
             JOIN tb_advantage_translation ON tb_advantage.id = tb_advantage_translation.idTbAdvantage
             JOIN tb_country ON tb_advantage_translation.idTbCountry = tb_country.id
             JOIN tb_country_language ON tb_country.id = tb_country_language.idTbCountry
             JOIN tb_language ON tb_country_language.idTbLanguage = tb_language.id
             WHERE tb_advantage_tag.id = 1
             AND tb_advantage.status = 1
             AND tb_advantage.isFeature = 0
             GROUP BY tb_advantage.id";

  if ($result = $connection->query($sqlCmd)) {
    while($row = mysqli_fetch_assoc($result)){
      $urlToEdit = "location.href='parceiros-editar.php?id=".$row['id']."'";
      $urlToDelete = "funDeleteItem(".$row['id'].")";
      $values =	'<button class="fa fa-edit" style="padding:5px; margin-left:10px" onclick="'.$urlToEdit.'"></button>';
      $values .=	'<button class="fa fa-trash" style="padding:5px; margin-left:10px" onclick="'.$urlToDelete.'"></button>';
      array_push($arrayMain,[$row['id'],$row['cta'],$row['country'],$values]);
    }
  }
  echo json_encode($arrayMain);
  $db->closeConnection();
}

function funDeletePartner(){
  include_once('session.php');
  include_once('utils.php');
  include_once(PATH_DATABASE_INC);
  $db = Database::getInstance();
  $connection = $db->getConnection();
  $id = $_REQUEST['id'];
  $viDateC = "'" . date("Y-m-d H:i:s") . "'";

  $sqlCmd = "UPDATE tb_advantage SET dateO=$viDateC, userO=$usr_id, status = 0 WHERE id=$id";

  if ($result = $connection->query($sqlCmd)) {
			$action = "[DELETE PARTNER] - Sucess deleting #".$id;
			funCreateLog($action, $connection);
			$db->commitAndClose();
			echo "true||Operação realizada com sucesso.";
	}else{
		$action = "[DELETE PARTNER] - Error deleting #".$id;
		funCreateLog($action, $connection);
		$db->rollbackAndClose();
		echo "false||Operação Falhou.";
	}
}

function funGetPartner(){
  include_once('utils.php');
  include_once(PATH_DATABASE_INC);
  $db = Database::getInstance();
  $connection = $db->getConnection();
  $listFormBar = "";
  $listNavBar = "";

  $id=$_REQUEST['id'];

  $sqlCmdGET="SELECT
              tb_country.id,
              tb_advantage.position,
              tb_advantage.idTbGallery
              FROM
              tb_advantage
              JOIN tb_advantage_translation ON tb_advantage.id = tb_advantage_translation.idTbAdvantage
              JOIN tb_country ON tb_advantage_translation.idTbCountry = tb_country.id
              WHERE tb_advantage.id=$id";

  $result = $connection->query($sqlCmdGET);

  if ($result) {
    while($row = mysqli_fetch_assoc($result)){
      $idCountry = $row['id'];
      $postion = $row['position'];
      $idTbGallery = $row['idTbGallery'];

      $sqlCmd1 = "SELECT
                       tb_language.id,
                       tb_language.lang,
                       tb_language.langMin,
                       tb_country.abbCountry
                FROM tb_country_language
                JOIN tb_language ON tb_language.id = tb_country_language.idTbLanguage
                JOIN tb_country ON tb_country.id = tb_country_language.idTbCountry
                WHERE tb_country_language.status =1
                AND
                 tb_country.id=".$idCountry."
                ORDER BY tb_country_language.defaultLang DESC";

      $result1 = $connection->query($sqlCmd1);

      if ($result1) {
        while($row1 = mysqli_fetch_assoc($result1)){
          $idLang = $row1['id'];
          if($listNavBar == ""){
            $listNavBar = '<li class="active"><a href="#'.$row1['langMin'].'" data-toggle="tab" aria-expanded="true">'.$row1['langMin'].'</a></li>';
          }else{
            $listNavBar .= '<li class=""><a href="#'.$row1['langMin'].'" data-toggle="tab" aria-expanded="true">'.$row1['langMin'].'</a></li>';
          }

          $sqlCmdGetCTAValue = "SELECT
                                      tb_advantage_translation.cta,
                                      tb_advantage_translation.id
                                FROM tb_advantage_translation
                                WHERE tb_advantage_translation.idTbAdvantage = $id
                                AND tb_advantage_translation.idTbLanguage = $idLang";

          $result2 = $connection->query($sqlCmdGetCTAValue);

          if ($result2) {
            while($row2 = mysqli_fetch_assoc($result2)){
              if($listFormBar != ""){$flag=false;}else{$flag=true;}
                 $viArrayValues['country'] = $row1['abbCountry'];
                 $viArrayValues['langMin'] = $row1['langMin'];
                 $viArrayValues['callAction'] = $row2['cta'];
                 $viArrayValues['idTrans'] = $row2['id'];
                 $viArrayValues['flag'] = $flag;

                 $listFormBar .= funCreatePartner($viArrayValues);
            }
          }
           }
           $allInfo = '<ul id="navBar" class="nav nav-tabs">';
           $allInfo .= $listNavBar;
           $allInfo .= '</ul>';
           $allInfo .= '<div id="tabContent" class="tab-content">';
           $allInfo .= $listFormBar;
           $allInfo .= '</div>';
         }
         echo "true||".$allInfo."||".$idCountry."||".$postion."||".$idTbGallery;
       }
    }
  }

function funEditPartner(){
  include_once('session.php');
  include_once('utils.php');
  include_once(PATH_DATABASE_INC);
  $db = Database::getInstance();
  $connection = $db->getConnection();
  $update = false;

  $viDateC = "'" . date("Y-m-d H:i:s") . "'";
  $idCountry = $_REQUEST['country'];
  $idPartner = $_REQUEST['idAdvantage'];
  $position = $_REQUEST['position'];
  $idImage = $_REQUEST['og_img'];

  $sqlUpdPartner = "UPDATE tb_advantage SET dateO=$viDateC, userO = $usr_id, position = $position, idTbGallery = $idImage WHERE id = $idPartner";

  echo $sqlUpdPartner;
  die();

  if($connection->query($sqlUpdPartner)){
    $sqlGetCountryLang = "SELECT
                          tb_language.id,
                          tb_language.lang,
                          tb_language.langMin,
                          tb_country.abbCountry
                          FROM tb_country_language
                          JOIN tb_language ON tb_language.id = tb_country_language.idTbLanguage
                          JOIN tb_country ON tb_country.id = tb_country_language.idTbCountry
                          WHERE tb_country_language.status =1
                          AND
                           tb_country.id=".$idCountry;

     if ($result = $connection->query($sqlGetCountryLang)){
       while($row = mysqli_fetch_assoc($result)){
           $cta = $_REQUEST['call_action_'.$row['abbCountry'].'_'.$row['langMin']];
           $idTranslation = $_REQUEST['idTrans_'.$row['abbCountry'].'_'.$row['langMin']];

           $sqlUpdTrans = "UPDATE tb_advantage_translation SET dateO = $viDateC, userO = $usr_id, cta = '$cta' ";
           $sqlUpdTrans .= "WHERE id = $idTranslation and idTbAdvantage = $idPartner";

           $result1 = $connection->query($sqlUpdTrans);
           if(!$result1){
             $inserted = false;
             $action = "[UPDATE PARTNER] - Failed add  PARTNER TRANSLATIONS";
             funCreateLog($action, $connection);
             $db->rollbackAndClose();
             die("false||Ocorreu um problema ao actualizar Parceiro #0002");
           } else {
             $inserted = true;
           }
       }
       if($inserted){
         echo "true||Operação realizada com sucesso.";
         $action = "[UPDATE PARTNER] - Success adding partner";
         funCreateLog($action, $connection);
         $db->commitAndClose();
       }
     }
   }
}
?>
