<?php
include_once('../../includes/globalVars.php');
$cmdEval = $_REQUEST['cmdEval'];
switch ($cmdEval) {
  case 'getCountriesInfo':
      funGetCountriesInfo();
      break;
  case 'addCountry':
      funAddCountry();
      break;
  case 'getCountries':
      funGetCountries();
      break;
  case 'deleteCountry':
      funDeleteCountry();
      break;
  case 'getCountry':
      funGetCountry();
      break;
  case 'editCountry':
      funEditCountry();
      break;
  default:
    # code...
    break;
  }

  function funGetCountriesInfo(){
    include_once(PATH_DATABASE_INC);
    $db = Database::getInstance();
    $connection = $db->getConnection();

    $sqlCmdGetTimeZone = "SELECT *
                          FROM tb_timezone
                          WHERE status = 1";

    $timezones=[];
   if ($result = $connection->query($sqlCmdGetTimeZone)){
     while($row = mysqli_fetch_assoc($result)){
       array_push($timezones,array($row['id'],$row['timezone']));
     }
   }

   $sqlCmdGetLanguage = "SELECT *
                         FROM tb_language
                         WHERE deleted = 0";

   $languages = [];
   if ($result = $connection->query($sqlCmdGetLanguage)){
     while($row = mysqli_fetch_assoc($result)){
       array_push($languages,array($row['id'],$row['lang']));
     }
   }
   $countryCode = funGetCountryCode();
   echo "true||".json_encode($timezones)."||".json_encode($languages)."||".$countryCode;
  }

  function funGetCountryCode($vfCountryCode="99999"){
    include_once(PATH_DATABASE_INC);
    $db = Database::getInstance();
    $connection = $db->getConnection();
    $sqlCmdGetCountryCode = "SELECT * FROM tb_country_codes";
    if ($resultCC = $connection->query($sqlCmdGetCountryCode)){
      $option = "<option value=''>Select an option</option>";
      while($rowCC = mysqli_fetch_assoc($resultCC)){
        $id = $rowCC['id'];
        $abb = $rowCC['country_code'];
        $country = $rowCC['country_name'];
        if($vfCountryCode == $id){$select = "selected";}else{$select="";}
        $option .= "<option value='$id' $select>$abb - $country</option>";
      }
      return $option;
    }else{die("false||Problem getting data.");}
  }

function funAddCountry(){
  include_once('session.php');
  include_once('utils.php');
  include_once(PATH_DATABASE_INC);
  $db = Database::getInstance();
  $connection = $db->getConnection();

  $viDateC = "'" . date("Y-m-d H:i:s") . "'";
  $countryName = $_REQUEST['countryName'];
  $countryAbb = $_REQUEST['countryAbb'];
  $timezone = $_REQUEST['timezone'];
  $countryCode = $_REQUEST['countryCode'];
  $total = $_REQUEST['total'];

  $sqlAddCountry = "INSERT INTO tb_country (dateO, userO, abbCountry, country, status, idTbTimezone,idTbCountryCode)";
  $sqlAddCountry .= "VALUES ($viDateC, $usr_id, '$countryAbb', '$countryName', 1, $timezone,$countryCode)";

  $result = $connection->query($sqlAddCountry);

  if($result){
    $idCountry = $connection->insert_id;

    $sqlCmdInsertCountryLang = "INSERT INTO tb_country_language (dateO, userO, defaultLang, idTbLanguage, idTbCountry) VALUES";

		for($i=1;$i<=$total;$i++){
			$idioma = $_REQUEST['idiom_'.$i];
			$default = $_REQUEST['default_'.$i];

			if($i != $total){
				$sqlCmdInsertCountryLang .= "($viDateC,'$usr_id','$default','$idioma', $idCountry),";
			}else{
				$sqlCmdInsertCountryLang .= "($viDateC,'$usr_id','$default','$idioma', $idCountry)";
			}
		}

    if($connection->query($sqlCmdInsertCountryLang)){
      $action = "[ADD COUNTRY_LANG] - Country languages added with sucess";
      funCreateLog($action, $connection);
				$db->commitAndClose();
				echo "true||Operação efectuada com sucesso.";
			} else {
				$action = "[ADD COUNTRY_LANG] - Country languages without sucess";
				funCreateLog($action, $connection);
				$db->rollbackAndClose();
				die("false||Oppsss... ocorreu um erro ao inserir as linguas do País.");
			}

  } else {
    $action = "[ADD COUNCTRY] - Add country failed";
		funCreateLog($action, $connection);
		$db->rollbackAndClose();
		die("false||Oppsss... ocorreu um erro ao inserir o País.");
  }
}

function funGetCountries(){
  include_once(PATH_DATABASE_INC);
  $db = Database::getInstance();
  $connection = $db->getConnection();

  $sqlCmd = "SELECT
              tb_timezone.timezone,
              tb_country.id,
              tb_country.country,
              tb_language.lang
            FROM
              tb_country
            JOIN tb_country_language ON tb_country.id = tb_country_language.idTbCountry
            JOIN tb_language ON tb_country_language.idTbLanguage = tb_language.id
            JOIN tb_timezone ON tb_country.idTbTimezone = tb_timezone.id
            WHERE tb_country_language.defaultLang=1
            AND tb_country.status=1
            GROUP BY tb_country.id";

  $viArrayMain=[];
 if ($result = $connection->query($sqlCmd)){
     $values = "";
   while($row = mysqli_fetch_assoc($result)){
     $urlToEdit = "location.href='paises-editar.php?id=".$row['id']."'";
     $urlToDelete = "funDeleteItem(".$row['id'].")";
     $urlToSeeMore = "location.href='utilizador-mais.php?id=".$row['id']."'";
     $values =	'<button class="fa fa-edit" style="padding:5px; margin-left:10px" onclick="'.$urlToEdit.'"></button>';
     $values .=	'<button class="fa fa-trash" style="padding:5px; margin-left:10px" onclick="'.$urlToDelete.'"></button>';
     //$values .=	'<button class="fa fa-eye" style="padding:5px; margin-left:10px" onclick="'.$urlToSeeMore.'"></button>';
     array_push($viArrayMain,array($row['id'],$row['country'],$row['timezone'],$row['lang'],$values));
   }
 }
 echo json_encode($viArrayMain);
}

function funDeleteCountry(){
  include_once('session.php');
  include_once('utils.php');
  include_once(PATH_DATABASE_INC);
  $db = Database::getInstance();
  $connection = $db->getConnection();

  $id = $_REQUEST['id'];
  $viDateC = "'" . date("Y-m-d H:i:s") . "'";

  $sqlCmd = "UPDATE tb_country SET dateO=$viDateC, userO=$usr_id, status = 0 WHERE id=$id";

  $result = $connection->query($sqlCmd);
  if ($result) {
    $action = "[DELETE COUNTRY] - Sucess deleting #" .$id;
    funCreateLog($action, $connection);
    $db->commitAndClose();
    echo "true||Operação realizada com sucesso.";
  }else{
    $action = "[DELETE COUNTRY] - Error Editing #" .$id;
    funCreateLog($action, $connection);
    $db->rollbackAndClose();
    echo "false||Operação Falhou.";
  }
}

function funGetCountry(){
  include_once(PATH_DATABASE_INC);
  $db = Database::getInstance();
  $connection = $db->getConnection();

  $id=$_REQUEST['id'];

  $sqlCmdGetTimeZone = "SELECT *
                        FROM tb_timezone
                        WHERE status = 1";

  $timezones=[];
 if ($result = $connection->query($sqlCmdGetTimeZone)){
   while($row = mysqli_fetch_assoc($result)){
     array_push($timezones,array($row['id'],$row['timezone']));
   }
 }

 $sqlCmdGetLanguage = "SELECT *
                       FROM tb_language
                       WHERE deleted = 0";

 $languages = [];
 if ($result = $connection->query($sqlCmdGetLanguage)){
   while($row = mysqli_fetch_assoc($result)){
     array_push($languages,array($row['id'],$row['lang']));
   }
 }

  $sqlGetCountryInfo = "SELECT
                        tb_country.id,
                        tb_country.abbCountry,
                        tb_country.country,
                        tb_country.idTbTimezone,
                        tb_country.idTbCountryCode
                        FROM
                        tb_country
                        WHERE tb_country.id=$id";

  $countryInfo = [];
  if($result = $connection->query($sqlGetCountryInfo)){
     while($row = mysqli_fetch_assoc($result)){
       $countryCode = $row['idTbCountryCode'];
       array_push($countryInfo,array($row['id'],$row['country'],$row['abbCountry'],$row['idTbTimezone']));
     }
  }

  $sqlGetCountryLang = "SELECT *
                        FROM tb_country_language
                        WHERE tb_country_language.idTbCountry = $id
                        AND tb_country_language.status=1";

  $countryLang=[];
  if($result1 = $connection->query($sqlGetCountryLang)){
     while($row1 = mysqli_fetch_assoc($result1)){
       array_push($countryLang,array($row1['idTbLanguage'],$row1['defaultLang']));
     }
  }
  $countryCode = funGetCountryCode($countryCode);
  echo "true||".json_encode($timezones)."||".json_encode($languages)."||".json_encode($countryInfo)."||".json_encode($countryLang)."||".$countryCode;
}

function funEditCountry(){
  include_once('session.php');
  include_once('utils.php');
  include_once(PATH_DATABASE_INC);
  $db = Database::getInstance();
  $connection = $db->getConnection();

  $viDateC = "'" . date("Y-m-d H:i:s") . "'";
  $countryName = $_REQUEST['countryName'];
  $countryAbb = $_REQUEST['countryAbb'];
  $timezone = $_REQUEST['timezone'];
  $total = $_REQUEST['total'];
  $countryCode = $_REQUEST['countryCode'];
  $id=$_REQUEST['id'];
  $sqlCountry = "UPDATE tb_country SET dateO=$viDateC, userO=$usr_id, abbCountry='$countryAbb',";
  $sqlCountry .= "country='$countryName',idTbTimezone='$timezone',idTbCountryCode='$countryCode' WHERE id=$id";
  if($resultCountry = $connection->query($sqlCountry)){
    $sqlDeleteLangCountry = "UPDATE tb_country_language SET dateO=$viDateC, userO=$usr_id, status=0 WHERE idTbCountry=$id";

    $result = $connection->query($sqlDeleteLangCountry);

    if($result){
      $sqlCmdInsertCountryLang = "INSERT INTO tb_country_language (dateO, userO, defaultLang, idTbLanguage, idTbCountry) VALUES";

      for($i=1;$i<=$total;$i++){
        $idioma = $_REQUEST['idiom_'.$i];
        $default = $_REQUEST['default_'.$i];

        if($i != $total){
          $sqlCmdInsertCountryLang .= "($viDateC,'$usr_id','$default','$idioma', $id),";
        }else{
          $sqlCmdInsertCountryLang .= "($viDateC,'$usr_id','$default','$idioma', $id)";
        }
      }

      if($connection->query($sqlCmdInsertCountryLang)){
        $action = "[DELETE COUNTRY_LANGUAGE] - Country languages added with sucess";
        funCreateLog($action, $connection);
          $db->commitAndClose();
          echo "true||Operação efectuada com sucesso.";
        } else {
          $action = "[DELETE COUNTRY_LANGUAGE] - Country languages without sucess";
          funCreateLog($action, $connection);
          $db->rollbackAndClose();
          die("false||Oppsss... ocorreu um erro ao actualizar as linguas do País.");
        }

    } else {
      $action = "[DELETE COUNTRY_LANGUAGE] - Delete country failed";
      funCreateLog($action, $connection);
      $db->rollbackAndClose();
      die("false||Oppsss... ocorreu um erro ao actualizar as línguas do País.");
    }
  }else{
    $action = "[UPDATE COUNTRY] - Update Country failed";
    funCreateLog($action, $connection);
    $db->rollbackAndClose();
    die("false||Oppsss... Something went wrong.");
  }
}

?>
