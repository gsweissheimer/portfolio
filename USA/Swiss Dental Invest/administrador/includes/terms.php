<?php

include_once '../../includes/globalVars.php';
include_once 'utils.php';
$cmdEval = $_REQUEST['cmdEval'];
switch ($cmdEval) {
  case 'getTermsNew':
    funGetTermsNew();
    break;
  case 'addTerms':
    funAddTerms();
    break;
  case 'getTerms':
    funGetTerms();
    break;
  case 'deleteTerms':
    funDeleteTerms();
    break;
  case 'getTerm':
    funGetTerm();
    break;
  case 'editTerms':
    funEditTerms();
    break;
  default:
    // code...
    break;
}

function funCreateTermsItems($vfArrayValues)
{
    if ($vfArrayValues['flag'] == 'true') {
        $active = 'active';
    } else {
        $active = '';
    }
    $vfLangMin = $vfArrayValues['langMin'];
    $vfCountry = $vfArrayValues['country'];
    $value = '<div class="tab-pane fade '.$active.' in col-sm-12" id="'.$vfLangMin.'"> <br>';
    $value .= '		<div class="form-group">';
    $value .= '			<label>Descrição Termos</label>';
    $value .= '			<textarea id="description_banner" name="terms_description_'.$vfCountry.'_'.$vfLangMin.'" class="form-control" required> '.$vfArrayValues['descTerms'].'</textarea>';
    $value .= '		</div>';
    $value .= '<input  type="hidden" id="idTrans" name="idTrans_'.$vfCountry.'_'.$vfLangMin.'" class="form-control" value="'.$vfArrayValues['idTrans'].'">';
    $value .= '</div>';

    return $value;
}

function funGetTermsNew()
{
    include_once PATH_DATABASE_INC;
    $db = Database::getInstance();
    $connection = $db->getConnection();
    $listFormBar = '';
    $listNavBar = '';
    $allInfo = '';

    $idCountry = $_REQUEST['id'];
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
              tb_country.id=$idCountry
            ORDER BY tb_country_language.defaultLang DESC";

    $result = $connection->query($sqlCmd);

    if ($result) {
        while ($row = mysqli_fetch_assoc($result)) {
            if ($listNavBar == '') {
                $listNavBar = '<li class="active"><a href="#'.$row['langMin'].'" data-toggle="tab" aria-expanded="true">'.$row['langMin'].'</a></li>';
            } else {
                $listNavBar .= '<li class=""><a href="#'.$row['langMin'].'" data-toggle="tab" aria-expanded="true">'.$row['langMin'].'</a></li>';
            }

            if ($listFormBar != '') {
                $flag = false;
            } else {
                $flag = true;
            }
            $viArrayValues['country'] = $row['abbCountry'];
            $viArrayValues['langMin'] = $row['langMin'];
            $viArrayValues['titleTerms'] = '';
            $viArrayValues['descTerms'] = '';
            $viArrayValues['idTrans'] = '';
            $viArrayValues['flag'] = $flag;
            $listFormBar .= funCreateTermsItems($viArrayValues);
        }
        $allInfo .= '<ul id="navBar" class="nav nav-tabs">';
        $allInfo .= $listNavBar;
        $allInfo .= '</ul>';
        $allInfo .= '<div id="tabContent" class="tab-content">';
        $allInfo .= $listFormBar;
        $allInfo .= '</div>';
    }
    echo 'true||'.$allInfo;
}

function funAddTerms()
{
    include_once 'session.php';
    include_once 'utils.php';
    include_once PATH_DATABASE_INC;
    $db = Database::getInstance();
    $connection = $db->getConnection();
    $viDateC = "'".date('Y-m-d H:i:s')."'";
    $inserted = false;

    $idCountry = $_REQUEST['country1'];
    $idType = $_REQUEST['typeTerms'];

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
              tb_country.id='$idCountry'
            ORDER BY tb_country_language.defaultLang DESC";

    $result = $connection->query($sqlCmd);

    if ($result) {
        while ($row = mysqli_fetch_assoc($result)) {
            $idLanguage = $row['id'];
            $termsContent = funTreatString($_REQUEST['terms_description_'.$row['abbCountry'].'_'.$row['langMin']]);

            $sqlInsertTerms = 'INSERT INTO  tb_terms_conditions (dateC, userO, information, typeTerms, idTbLanguage, idTbCountry) VALUES';
            $sqlInsertTerms .= " ($viDateC, $usr_id, '$termsContent', '$idType', $idLanguage, $idCountry)";

            $result2 = $connection->query($sqlInsertTerms);

            if (!$result2) {
                $action = '[ADD TERMS TRANS] - sql failed';
                funCreateLog($action, $connection);
                $db->rollbackAndClose();
                die('false||Oppsss... ocorreu um erro ao inserir os termos.');
            } else {
                $inserted = true;
            }
        }

        if ($inserted) {
            $action = '[ADD BANNER TRANS] - Sucess added';
            funCreateLog($action, $connection);
            $db->commitAndClose();
            echo 'true||Operação realizada com sucesso.';
        }
    }
}

function funGetTerms()
{
    include_once PATH_DATABASE_INC;
    $db = Database::getInstance();
    $connection = $db->getConnection();
    $sqlCmd = "SELECT
								tb_terms_conditions.id,
                tb_country.country,
                tb_terms_conditions.typeTerms as type,
            		case tb_terms_conditions.typeTerms
            			when '1' then 'Privacy'
            			when '0' then 'Terms'
            		end as typeTerms,
                tb_country.id as idCountry
							FROM
								tb_terms_conditions
              JOIN tb_country ON tb_country.id = tb_terms_conditions.idTbCountry

							WHERE tb_terms_conditions.status = 1
              AND tb_terms_conditions.idTbLanguage = 1
              GROUP BY tb_terms_conditions.typeTerms";

    $values = '';
    if ($result = $connection->query($sqlCmd)) {
        $arrayMain = [];
        while ($rsData = mysqli_fetch_assoc($result)) {
            $urlToEdit = "location.href='terms-editar.php?idC=".$rsData['idCountry'].'&type='.$rsData['type']."'";
            $urlToDelete = 'funDeleteItem('.$rsData['idCountry'].','.$rsData['type'].')';
            $values = '<button class="fa fa-edit" style="padding:5px; margin-left:10px" onclick="'.$urlToEdit.'"></button>';
            $values .= '<button class="fa fa-trash" style="padding:5px; margin-left:10px" onclick="'.$urlToDelete.'"></button>';
            array_push($arrayMain, [$rsData['id'], $rsData['country'], $rsData['typeTerms'], $values]);
        }
    }

    echo json_encode($arrayMain);
    $db->closeConnection();
}

function funDeleteTerms()
{
    include_once 'session.php';
    include_once 'utils.php';
    include_once PATH_DATABASE_INC;
    $db = Database::getInstance();
    $connection = $db->getConnection();
    $idC = $_REQUEST['idC'];
    $type = $_REQUEST['type'];
    $sqlCmd = "UPDATE tb_terms_conditions SET status = 0 WHERE idTbCountry=$idC and typeTerms = $type";
    $result = $connection->query($sqlCmd);
    if ($result) {
        $action = '[DELETE_TERMS] - Sucess deleting #'.$sqlCmd;
        funCreateLog($action, $connection);
        $db->commitAndClose();
        echo 'true||Operação realizada com sucesso.';
    } else {
        $action = '[DELETE_TERMS] - Error deleting #'.$sqlCmd;
        funCreateLog($action, $connection);
        $db->rollbackAndClose();
        echo 'false||Operação Falhou.';
    }
}

function funGetTerm()
{
    include_once 'utils.php';
    include_once PATH_DATABASE_INC;
    $db = Database::getInstance();
    $connection = $db->getConnection();

    $idCountry = $_REQUEST['idC'];
    $type = $_REQUEST['type'];
    $listFormBar = '';
    $listNavBar = '';

    $sqlCmd = "SELECT
                   idTbLanguage,
                   idTbCountry
              FROM tb_terms_conditions
              WHERE status=1
              AND typeTerms=$type
              AND idTbCountry=$idCountry
              GROUP BY idTbCountry";

    if ($result = $connection->query($sqlCmd)) {
        while ($row = mysqli_fetch_assoc($result)) {
            $idTbLanguage = $row['idTbLanguage'];
            $idTbCountry = $row['idTbCountry'];

            $sqlCmd1 = "SELECT
                       tb_language.id,
                       tb_language.langMin,
                       tb_language.lang,
                       tb_country.abbCountry
                FROM tb_country_language
                JOIN tb_language ON tb_language.id = tb_country_language.idTbLanguage
                JOIN tb_country ON tb_country.id = tb_country_language.idTbCountry
                WHERE tb_country_language.status =1
                AND
                 tb_country.id= $idTbCountry";

            if ($result1 = $connection->query($sqlCmd1)) {
                while ($row1 = mysqli_fetch_assoc($result1)) {
                    $langId = $row1['id'];
                    if ($listNavBar == '') {
                        $listNavBar = '<li class="active"><a href="#'.$row1['langMin'].'" data-toggle="tab" aria-expanded="true">'.$row1['langMin'].'</a></li>';
                    } else {
                        $listNavBar .= '<li class=""><a href="#'.$row1['langMin'].'" data-toggle="tab" aria-expanded="true">'.$row1['langMin'].'</a></li>';
                    }

                    $sqlCmdGetInfo = "SELECT tb_terms_conditions.information,
                                  tb_country.country,
                                  tb_terms_conditions.id,
                                  tb_country.abbCountry
                           FROM tb_terms_conditions
                           JOIN tb_country ON tb_country.id = tb_terms_conditions.idTbCountry
                           JOIN tb_language ON tb_language.id = tb_terms_conditions.idTbLanguage
                           WHERE tb_terms_conditions.idTbCountry = $idTbCountry
                           AND tb_terms_conditions.status = 1
                           AND tb_terms_conditions.idTbLanguage = $langId
                           AND tb_terms_conditions.typeTerms=$type";

                    if ($result2 = $connection->query($sqlCmdGetInfo)) {
                        $numRow = mysqli_num_rows($result2);
                        if ($numRow > 0) {
                            while ($row3 = mysqli_fetch_assoc($result2)) {
                                if ($listFormBar != '') {
                                    $flag = false;
                                } else {
                                    $flag = true;
                                }
                                $viArrayValues['country'] = $row1['abbCountry'];
                                $viArrayValues['langMin'] = $row1['langMin'];
                                $viArrayValues['descTerms'] = $row3['information'];
                                $viArrayValues['idTrans'] = $row3['id'];
                                $viArrayValues['flag'] = $flag;
                                $listFormBar .= funCreateTermsItems($viArrayValues);
                            }
                        } else {
                            if ($listFormBar != '') {
                                $flag = false;
                            } else {
                                $flag = true;
                            }
                            $viArrayValues['country'] = $row1['abbCountry'];
                            $viArrayValues['langMin'] = $row1['langMin'];
                            $viArrayValues['descTerms'] = '';
                            $viArrayValues['idTrans'] = '';
                            $viArrayValues['flag'] = $flag;
                            $listFormBar .= funCreateTermsItems($viArrayValues);
                        }
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
        echo 'true||'.$allInfo.'||'.$idTbCountry.'||'.$type;
    }
}

  function funEditTerms()
  {
      include_once 'session.php';
      include_once 'utils.php';
      include_once PATH_DATABASE_INC;
      $db = Database::getInstance();
      $connection = $db->getConnection();
      $viDateC = "'".date('Y-m-d H:i:s')."'";
      $inserted = false;

      $idCountry = $_REQUEST['idC'];
      $idType = $_REQUEST['typeTerms'];

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
                tb_country.id=$idCountry
              ORDER BY tb_country_language.defaultLang DESC";

      $result = $connection->query($sqlCmd);

      // echo $sqlCmd;
      if ($result) {
          while ($row = mysqli_fetch_assoc($result)) {
              $idLanguage = $row['id'];
              $termsContent = funTreatString($_REQUEST['terms_description_'.$row['abbCountry'].'_'.$row['langMin']]);
              $idTrans = $_REQUEST['idTrans_'.$row['abbCountry'].'_'.$row['langMin']];

              if ($idTrans != '') {
                  $sqlUpdTerms = "UPDATE tb_terms_conditions SET userO = $usr_id, information = '$termsContent', typeTerms = $idType";
                  $sqlUpdTerms .= " WHERE id = $idTrans";
              } else {
                  $sqlUpdTerms = 'INSERT INTO tb_terms_conditions (dateC, userO, information, typeTerms, status, idTbLanguage, idTbCountry)';
                  $sqlUpdTerms .= " VALUES ($viDateC, $usr_id, '$termsContent', $idType, 1, $idLanguage, $idCountry)";
              }

              $result2 = $connection->query($sqlUpdTerms);

              if (!$result2) {
                  $action = '[ADD TERMS TRANS] - sql failed';
                  funCreateLog($action, $connection);
                  $db->rollbackAndClose();
                  die('false||Oppsss... ocorreu um erro ao actualizar os termos.');
              } else {
                  $inserted = true;
              }
          }
          if ($inserted) {
              $action = '[ADD BANNER TRANS] - Sucess added';
              funCreateLog($action, $connection);
              $db->commitAndClose();
              echo 'true||Operação realizada com sucesso.';
          }
      }
  }
