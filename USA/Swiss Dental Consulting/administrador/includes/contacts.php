<?php
include_once('../../includes/globalVars.php');
$cmdEval = $_REQUEST['cmdEval'];
switch ($cmdEval) {
  case 'getContactGeneralInfo':
    funGetContactGeneral();
    break;
  case 'getCountryLang':
    funGetCountryLang();
    break;
  case 'addContact':
    if($_REQUEST['bot'] == ""){funAddContact();}else{die();}
    break;
  case 'getContacts':
    funGetContacts();
    break;
  case 'deleteContact':
    funDeleteContact();
    break;
  case 'getContact':
    funGetContact();
    break;
  case 'editContact':
    funEditContact();
    break;
  default:
    # code...
    break;
  }

  function funCreateContactItems($vfArrayValues){
    if($vfArrayValues['flag'] == "true"){$active="active";}else{$active="";}
    $vfLangMin = $vfArrayValues['langMin'];
    $vfCountry = $vfArrayValues['country'];
    $value = '<div class="tab-pane fade '.$active.' in col-sm-12" id="'.$vfLangMin.'"> <br>';
    $value .= '		<div class="form-group">';
    $value .= '			<label>Clinic Name</label>';
    $value .= '			<input id="clinic" name="clinic_'.$vfCountry.'_'.$vfLangMin.'" class="form-control" value="'.$vfArrayValues['clinicName'].'" required> ';
    $value .= '		</div>';
    $value .= '		<div class="form-group">';
    $value .= '			<label>Address</label>';
    $value .= '			<input id="address" name="address_'.$vfCountry.'_'.$vfLangMin.'" class="form-control" value="'.$vfArrayValues['address'].'" required> ';
    $value .= '		</div>';
    $value .= '		<div class="form-group">';
    $value .= '			<label>Clinic Phone</label>';
    $value .= '			<input id="clinicPhone" name="clinicPhone_'.$vfCountry.'_'.$vfLangMin.'" class="form-control" value="'.$vfArrayValues['clinicPhone'].'" required> ';
    $value .= '		</div>';
    $value .= '		<div class="form-group">';
    $value .= '			<label>Email</label>';
    $value .= '			<input id="email" name="email_'.$vfCountry.'_'.$vfLangMin.'" class="form-control" value="'.$vfArrayValues['email'].'" required> ';
    $value .= '		</div>';
    $value .= '		<div class="form-group">';
    $value .= '			<label>Office Phone</label>';
    $value .= '			<input id="officePhone" name="officePhone_'.$vfCountry.'_'.$vfLangMin.'" class="form-control" value="'.$vfArrayValues['officePhone'].'" required> ';
    $value .= '		</div>';
    $value .= '<input  type="hidden" id="idTrans" name="idTrans_'.$vfCountry.'_'.$vfLangMin.'" class="form-control" value="'.$vfArrayValues['idTrans'].'">';
    $value .= '</div>';
    return $value;
  }

function funGetContactGeneral(){
  include_once(PATH_DATABASE_INC);
  $db = Database::getInstance();
  $connection = $db->getConnection();
  $countries = [];

  $sqlCmd = "SELECT
                  id,
                  country
             FROM tb_country
             WHERE status=1";

  if($result = $connection->query($sqlCmd)){
    while ($row = mysqli_fetch_assoc($result)) {
      array_push($countries,[$row['id'],$row['country']]);
    }
  }
  echo "true||".json_encode($countries);
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
         $viArrayValues['lang'] = $row['lang'];
         $viArrayValues['langMin'] = $row['langMin'];
         $viArrayValues['clinicName'] = "";
         $viArrayValues['address'] = "";
         $viArrayValues['clinicPhone'] = "";
         $viArrayValues['email'] = "";
         $viArrayValues['officePhone'] = "";
         $viArrayValues['idTrans'] = "";
         $viArrayValues['flag'] = $flag;
         $listFormBar .= funCreateContactItems($viArrayValues);
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

   function funAddContact(){
     include_once('session.php');
     include_once('utils.php');
     include_once(PATH_DATABASE_INC);
     $db = Database::getInstance();
     $connection = $db->getConnection();
     $viDateC = "'" . date("Y-m-d H:i:s") . "'";

     $idCountry = $_REQUEST['countryContact'];
     $clinicImage = $_REQUEST['og_img'];

     $sqlCmd = "INSERT INTO tb_contact (dateO, userO, idTbGallery, idTbCountry) VALUES ($viDateC, $usr_id, $clinicImage, $idCountry)";

     if($result = $connection->query($sqlCmd)){

       $idContact = $connection->insert_id;

       $sqlGetCountryLang = "SELECT
                                  tb_language.id,
                                  tb_language.langMin,
                                  tb_country.abbCountry
                             FROM tb_country_language
                             JOIN tb_language ON tb_language.id = tb_country_language.idTbLanguage
                             JOIN tb_country ON tb_country.id = tb_country_language.idTbCountry
                             WHERE tb_country_language.status =1
                             AND
                              tb_country.id=".$idCountry."
                             ORDER BY tb_country_language.defaultLang DESC";


      if($result2 = $connection->query($sqlGetCountryLang)){
        while ($row2 = mysqli_fetch_assoc($result2)) {
          $idLanguage = $row2['id'];
          $clinicName = funTreatString($_REQUEST['clinic_'.$row2['abbCountry'].'_'.$row2['langMin']]);
          $address = funTreatString($_REQUEST['address_'.$row2['abbCountry'].'_'.$row2['langMin']]);
          $clinicPhone = $_REQUEST['clinicPhone_'.$row2['abbCountry'].'_'.$row2['langMin']];
          $email = $_REQUEST['email_'.$row2['abbCountry'].'_'.$row2['langMin']];
          $officePhone = $_REQUEST['officePhone_'.$row2['abbCountry'].'_'.$row2['langMin']];

          $sqlInsertContacTrans = "INSERT INTO tb_contact_trans (dateO, userO, clinicName, address, clinicPhone, email, officePhone, idTbLanguage, idTbContact)";
          $sqlInsertContacTrans.= " VALUES ($viDateC, $usr_id, '$clinicName', '$address', '$clinicPhone', '$email', '$officePhone', $idLanguage, $idContact)";

          $result3= $connection->query($sqlInsertContacTrans);

            if(!$result3){
              $action = "[ADD CONTACT TRANS] - sql failed";
              funCreateLog($action, $connection);
              $db->rollbackAndClose();
              die("false||Oppsss... ocorreu um erro ao as traduções dos contactos.");
            } else {
              $inserted = true;
            }
          }
        if($inserted){
          $action = "[ADD CONTACT TRANS] - Sucess added";
          funCreateLog($action, $connection);
          $db->commitAndClose();
          echo "true||Operação realizada com sucesso.";
        }
      }

     } else {
       $action = "[ADD Contact] - Failed add contacts";
   		funCreateLog($action, $connection);
   		$db->rollbackAndClose();
   		die("false|| The contact was not added with sucess.");
     }
   }

   function funGetContacts(){
     include_once(PATH_DATABASE_INC);
     $db = Database::getInstance();
     $connection = $db->getConnection();

     $sqlCmd = "SELECT
                     tb_country.country,
                     tb_country.id as idCountry,
                     tb_contact.id,
                     tb_contact_trans.clinicName
                FROM tb_contact
                JOIN tb_country ON tb_country.id = tb_contact.idTbCountry
                JOIN tb_contact_trans ON tb_contact_trans.idTbContact = tb_contact.id
                JOIN tb_language ON tb_language.id = tb_contact_trans.idTbLanguage
                WHERE tb_contact.status = 1
                GROUP BY tb_contact.id";

      $values = "";
      if ($result = $connection->query($sqlCmd)) {
        $arrayMain = [];
        while($rsData = mysqli_fetch_assoc($result)){
            $urlToEdit = "location.href='contactos-editar.php?id=".$rsData['id']."&idC=".$rsData['idCountry']."'";
            $urlToDelete = "funDeleteItem(".$rsData['id'].")";
            $values =	'<button class="fa fa-edit" style="padding:5px; margin-left:10px" onclick="'.$urlToEdit.'"></button>';
            $values .=	'<button class="fa fa-trash" style="padding:5px; margin-left:10px" onclick="'.$urlToDelete.'"></button>';
            array_push($arrayMain,[$rsData['id'],$rsData['clinicName'],$rsData['country'],$values]);
        }
      }
      echo json_encode($arrayMain);
      $db->closeConnection();
   }

   function funDeleteContact(){
     include_once('session.php');
     include_once('utils.php');
     include_once(PATH_DATABASE_INC);
     $db = Database::getInstance();
     $connection = $db->getConnection();
     $viDateC = "'" . date("Y-m-d H:i:s") . "'";

     $id=$_REQUEST['id'];

     $sqlCmd = "UPDATE tb_contact SET dateO=$viDateC, userO=$usr_id, status = 0 WHERE id=$id";

     if($connection->query($sqlCmd)){
       $action = "[DELETE CONTACT] - Sucess added";
       funCreateLog($action, $connection);
       $db->commitAndClose();
       echo "true|| The contact was deleted.";
     } else {
       $action = "[DELETE CONTACT] - Failed delete contact";
   		funCreateLog($action, $connection);
   		$db->rollbackAndClose();
   		die("false|| The contact was not deleted.");
     }
   }

   function funGetContact(){
     include_once(PATH_DATABASE_INC);
     $db = Database::getInstance();
     $connection = $db->getConnection();

     $id=$_REQUEST['id'];
     $idTbCountry = $_REQUEST['idC'];
     $listNavBar = "";
     $listFormBar = "";

     $sqlCmdGetContactInfo = "SELECT tb_contact.*,
                                     tb_country.abbCountry
                              FROM tb_contact
                              JOIN tb_country ON tb_country.id = tb_contact.idTbCountry
                              WHERE tb_contact.id=$id";

     if($result = $connection->query($sqlCmdGetContactInfo)){
       while ($row = mysqli_fetch_assoc($result)){
         $idContact = $row['id'];
         $idCountry = $row['idTbCountry'];
         $idTbGallery = $row['idTbGallery'];
         $abbCountry = $row['abbCountry'];

         // get country language
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
                    tb_country.id=".$idTbCountry."
                   ORDER BY tb_country_language.defaultLang DESC";

         $result5 = $connection->query($sqlCmd);

         if ($result5) {
           while($row5 = mysqli_fetch_assoc($result5)){
             $idTbLanguage = $row5['id'];

             if($listNavBar == ""){
               $listNavBar = '<li class="active"><a href="#'.$row5['langMin'].'" data-toggle="tab" aria-expanded="true">'.$row5['langMin'].'</a></li>';
             }else{
               $listNavBar .= '<li class=""><a href="#'.$row5['langMin'].'" data-toggle="tab" aria-expanded="true">'.$row5['langMin'].'</a></li>';
             }

           $sqlCmdGetTrans = "SELECT
                                    tb_contact_trans.id,
                                    tb_contact_trans.clinicName,
                                    tb_contact_trans.address,
                                    tb_contact_trans.clinicPhone,
                                    tb_contact_trans.email,
                                    tb_contact_trans.officePhone,
                                    tb_language.langMin,
                                    tb_language.id as idLanguage
                              FROM tb_contact_trans
                              JOIN tb_language ON tb_language.id = tb_contact_trans.idTbLanguage
                              WHERE tb_contact_trans.idTbContact = $idContact
                              AND tb_contact_trans.idTbLanguage = $idTbLanguage";

          if($result1 = $connection->query($sqlCmdGetTrans)){
            $numRow = mysqli_num_rows($result1);
            if($numRow>0){
              while ($row1 = mysqli_fetch_assoc($result1)) {
                if($listFormBar != ""){$flag=false;}else{$flag=true;}
                   $viArrayValues['country'] = $abbCountry;
                   $viArrayValues['langMin'] = $row1['langMin'];
                   $viArrayValues['clinicName'] = $row1['clinicName'];
                   $viArrayValues['address'] = $row1['address'];
                   $viArrayValues['clinicPhone'] = $row1['clinicPhone'];
                   $viArrayValues['email'] = $row1['email'];
                   $viArrayValues['officePhone'] = $row1['officePhone'];
                   $viArrayValues['idTrans'] = $row1['id'];
                   $viArrayValues['flag'] = $flag;
                   $listFormBar .= funCreateContactItems($viArrayValues);
                 }
               } else {
                 if($listFormBar != ""){$flag=false;}else{$flag=true;}
                    $viArrayValues['country'] = $abbCountry;
                    $viArrayValues['langMin'] = $row5['langMin'];
                    $viArrayValues['clinicName'] = "";
                    $viArrayValues['address'] = "";
                    $viArrayValues['clinicPhone'] = "";
                    $viArrayValues['email'] = "";
                    $viArrayValues['officePhone'] = "";
                    $viArrayValues['idTrans'] = "";
                    $viArrayValues['flag'] = $flag;
                    $listFormBar .= funCreateContactItems($viArrayValues);
               }
             }
          }
        }
        $allInfo = '<ul id="navBar" class="nav nav-tabs">';
        $allInfo .= $listNavBar;
        $allInfo .= '</ul>';
        $allInfo .= '<div id="tabContent" class="tab-content">';
        $allInfo .= $listFormBar;
        $allInfo .= '</div>';
          $sqlCmdGetCountries = "SELECT id, country FROM tb_country WHERE status = 1";
          $countries = [];

          if($result3 = $connection->query($sqlCmdGetCountries)){
            while ($row3 = mysqli_fetch_assoc($result3)) {
              array_push($countries,[$row3['id'],$row3['country']]);
            }
          }
       }
       echo "true||".$allInfo."||".json_encode($countries)."||".$idCountry."||".$idTbGallery;
     }
   }

   function funEditContact(){
     include_once('session.php');
     include_once('utils.php');
     include_once(PATH_DATABASE_INC);
     $db = Database::getInstance();
     $connection = $db->getConnection();
     $viDateC = "'" . date("Y-m-d H:i:s") . "'";

     $idCountry = $_REQUEST['countryContact'];
     $clinicImage = $_REQUEST['og_img'];
     $idContact = $_REQUEST['idContact'];

     $sqlCmd = "UPDATE tb_contact SET dateO=$viDateC, userO=$usr_id, idTbGallery = $clinicImage WHERE id =$idContact";

     if($result = $connection->query($sqlCmd)){

       $sqlGetCountryLang = "SELECT
                                  tb_language.id,
                                  tb_language.langMin,
                                  tb_country.abbCountry
                             FROM tb_country_language
                             JOIN tb_language ON tb_language.id = tb_country_language.idTbLanguage
                             JOIN tb_country ON tb_country.id = tb_country_language.idTbCountry
                             WHERE tb_country_language.status =1
                             AND
                              tb_country.id=".$idCountry."
                             ORDER BY tb_country_language.defaultLang DESC";


      if($result2 = $connection->query($sqlGetCountryLang)){
        while ($row2 = mysqli_fetch_assoc($result2)) {
          $idLanguage = $row2['id'];
          $clinicName = funTreatString($_REQUEST['clinic_'.$row2['abbCountry'].'_'.$row2['langMin']]);
          $address = funTreatString($_REQUEST['address_'.$row2['abbCountry'].'_'.$row2['langMin']]);
          $clinicPhone = $_REQUEST['clinicPhone_'.$row2['abbCountry'].'_'.$row2['langMin']];
          $email = $_REQUEST['email_'.$row2['abbCountry'].'_'.$row2['langMin']];
          $officePhone = $_REQUEST['officePhone_'.$row2['abbCountry'].'_'.$row2['langMin']];
          $idTrans = $_REQUEST['idTrans_'.$row2['abbCountry'].'_'.$row2['langMin']];

          if($idTrans != ""){
            $sqlUpdContactTrans = "UPDATE tb_contact_trans SET dateO = $viDateC, userO=$usr_id, clinicName='$clinicName', address='$address',";
            $sqlUpdContactTrans .= " clinicPhone = '$clinicPhone', email='$email', officePhone='$officePhone' WHERE id = $idTrans";
          } else {
            $sqlUpdContactTrans = "INSERT INTO tb_contact_trans (dateO, userO, clinicName, address, clinicPhone, email, officePhone, idTbLanguage, idTbContact) ";
            $sqlUpdContactTrans .= "VALUES ($viDateC, $usr_id, '$clinicName', '$address', '$clinicPhone', '$email', '$officePhone', $idLanguage, $idContact)";
          }


          $result3= $connection->query($sqlUpdContactTrans);

            if(!$result3){
              $action = "[UPD CONTACT TRANS] - sql failed";
              funCreateLog($action, $connection);
              $db->rollbackAndClose();
              die("false||Oppsss... ocorreu um erro ao actualizar as traduções dos contactos.");
            } else {
              $inserted = true;
            }
          }
        if($inserted){
          $action = "[UPD CONTACT TRANS] - Sucess added";
          funCreateLog($action, $connection);
          $db->commitAndClose();
          echo "true||Operação realizada com sucesso.";
        }
      }

     } else {
       $action = "[ADD Contact] - Failed add contacts";
   		funCreateLog($action, $connection);
   		$db->rollbackAndClose();
   		die("false|| The contact was not updated.");
     }
   }
?>
