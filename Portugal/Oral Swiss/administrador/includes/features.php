<?php

include_once '../../includes/globalVars.php';
include_once 'utils.php';
$cmdEval = $_REQUEST['cmdEval'];
switch ($cmdEval) {
  case 'addFeaturesTag':
      if ($_REQUEST['bot'] == '') {
          funAddFeaturesTag();
      } else {
          die();
      }
      break;
  case 'createNewFeature':
    funGetNewFeature();
    break;
  case 'initFeatures':
    funInitFeatures();
    break;
  case 'addNewFeature':
    funAddNewFeature();
    break;
  case 'getFeatureEdit':
    funGetFeatureEdit();
    break;
  case 'getAdvantage':
    funGetAdvantage();
    break;
  case 'deleteAdvantage':
    funDeleteFeature();
    break;
  case 'editFeature':
    funEditFeature();
    break;
  default:
    // code...
    break;
}

function funInitFeatures()
{
    echo 'true||'.funGetCountryAll('', true).'||'.funGetTagFeature('', true);
}
function funEditFeature()
{
    include_once 'session.php';
    include_once 'utils.php';
    include_once PATH_DATABASE_INC;
    $db = Database::getInstance();
    $connection = $db->getConnection();
    $idFeature = $_REQUEST['idAdvantage'];
    $viDateC = "'".date('Y-m-d H:i:s')."'";

    if (isset($_REQUEST['countryBanner'])) {
        $country = $_REQUEST['countryBanner'];
    } else {
        $country = '';
    }
    if (isset($_REQUEST['tagType'])) {
        $tagType = $_REQUEST['tagType'];
    } else {
        $tagType = '';
    }
    if (isset($_REQUEST['position'])) {
        $position = $_REQUEST['position'];
    } else {
        $position = '';
    }
    if (isset($_REQUEST['og_image'])) {
        $og_img = strlen($_REQUEST['og_image']) > 0 ? $_REQUEST['og_image'] : $og_img = 'NULL';
    }

    if ($tagType != '' && $position != '' && $og_img) {
        $sqlCmd = "UPDATE tb_advantage SET dateO=$viDateC, userO=$usr_id, position=$position,idTbGallery=$og_img, idTbAdvantageTag=$tagType WHERE id=$idFeature";
        if ($result = $connection->query($sqlCmd)) {
            $sqlCmdCountryLang = 'SELECT
                                   tb_language.id,
                                   tb_language.langMin,
                                   tb_language.lang
                            FROM tb_country_language
                            JOIN tb_language ON tb_language.id = tb_country_language.idTbLanguage
                            JOIN tb_country ON tb_country.id = tb_country_language.idTbCountry
                            WHERE tb_country_language.status =1
                            AND
                             tb_country.id='.$country;
            if ($result1 = $connection->query($sqlCmdCountryLang)) {
                while ($row1 = mysqli_fetch_assoc($result1)) {
                    $langMin = $row1['langMin'];
                    $langId = $row1['id'];
                    if (isset($_REQUEST['vcTitulo_'.$langMin])) {
                        $title = funTreatString($_REQUEST['vcTitulo_'.$langMin]);
                    } else {
                        $title = '';
                    }
                    if (isset($_REQUEST['subtitle_'.$langMin])) {
                        $subtitle = funTreatString($_REQUEST['subtitle_'.$langMin]);
                    } else {
                        $subtitle = '';
                    }
                    if (isset($_REQUEST['txTexto_'.$langMin])) {
                        $description = funTreatString($_REQUEST['txTexto_'.$langMin]);
                    } else {
                        $description = '';
                    }
                    if (isset($_REQUEST['cta_'.$langMin])) {
                        $cta = funTreatString($_REQUEST['cta_'.$langMin]);
                    } else {
                        $cta = '';
                    }
                    if (isset($_REQUEST['action_'.$langMin])) {
                        $action = funTreatString($_REQUEST['action_'.$langMin]);
                    } else {
                        $action = '';
                    }
                    if (isset($_REQUEST['idTrans_'.$langMin])) {
                        $idTrans = funTreatString($_REQUEST['idTrans_'.$langMin]);
                    } else {
                        $idTrans = '';
                    }

                    if ($idTrans != '') {
                        $sqlCmd1 = "UPDATE tb_advantage_translation SET dateO=$viDateC, userO=$usr_id, title='$title', subtitle='$subtitle',";
                        $sqlCmd1 .= " description='$description', cta='$cta', action='$action' WHERE id=$idTrans";
                    } else {
                        $sqlCmd1 = 'INSERT INTO tb_advantage_translation(dateO, userO, title, subtitle, description, cta, action, idTbCountry, idTbLanguage, idTbAdvantage) VALUES ';
                        $sqlCmd1 .= "($viDateC,$usr_id,'$title','$subtitle','$description','$cta','$action',$country,$langId,$idFeature)";
                    }

                    if (!$result2 = $connection->query($sqlCmd1)) {
                        $action = '[EDIT-FEATURE] - Failed add translation feature';
                        funCreateLog($action, $connection);
                        $db->rollbackAndClose();
                        die('false||Problem inserting/updating translation');
                    }
                }
                $action = '[EDIT-FEATURE] - Operation add success';
                funCreateLog($action, $connection);
                echo 'true||Operation was been successfuly done!';
                $db->commitAndClose();
            } else {
                $action = '[EDIT-FEATURE] - Failed feature';
                funCreateLog($action, $connection);
                $db->rollbackAndClose();
                die('false||Problem getting language');
            }
        } else {
            die('false||Problem inserting feature.');
        }
    } else {
        die('false||Some values are empty');
    }
}

function funGetAdvantage()
{
    include_once 'session.php';
    include_once 'utils.php';
    include_once PATH_DATABASE_INC;
    $db = Database::getInstance();
    $connection = $db->getConnection();
    $arrayMain = [];
    $sql = 'SELECT
            tb_advantage.id,
            tb_advantage_tag.tag,
          	tb_advantage_translation.title ,
          	tb_advantage.position ,
          	tb_country.country,
            tb_country.id as countryId
          FROM
          	tb_advantage_translation
          JOIN tb_advantage ON tb_advantage_translation.idTbAdvantage = tb_advantage.id
          JOIN tb_advantage_tag ON tb_advantage_tag.id = tb_advantage.idTbAdvantageTag
          JOIN tb_country ON tb_advantage_translation.idTbCountry = tb_country.id
          WHERE
          	tb_country.status = 1
          AND tb_advantage.isFeature = 1
          AND tb_advantage.status = 1
          GROUP BY
              tb_advantage.id';
    if ($result = $connection->query($sql)) {
        while ($row = mysqli_fetch_assoc($result)) {
            $urlToEdit = "location.href='features-editar.php?id=".$row['id'].'&idC='.$row['countryId']."'";
            $urlToDelete = 'funDeleteItem('.$row['id'].')';
            //$urlToSeeMore = "location.href='advantage-mais.php?id=".$rsData['id']."'";
            $values = '<button class="fa fa-edit" style="padding:5px; margin-left:10px" onclick="'.$urlToEdit.'"></button>';
            $values .= '<button class="fa fa-trash" style="padding:5px; margin-left:10px" onclick="'.$urlToDelete.'"></button>';
            //$values .=	'<button class="fa fa-eye" style="padding:5px; margin-left:10px" onclick="'.$urlToSeeMore.'"></button>';
            array_push($arrayMain, [$row['id'], $row['tag'], $row['title'], $row['position'], $row['country'], $values]);
        }
    }
    echo json_encode($arrayMain);
    $db->closeConnection();
}

function funGetFeatureEdit()
{
    include_once 'session.php';
    include_once 'utils.php';
    include_once PATH_DATABASE_INC;
    $db = Database::getInstance();
    $connection = $db->getConnection();
    $listNavBar = '';
    $listFormBar = '';
    $pos = 1;
    $tag = '';
    $path = '';
    $galleryId = '';
    $idFeature = $_REQUEST['id'];
    $idCountry = $_REQUEST['idC'];

    $optionsCountry = funGetCountryAll($idCountry, true);

    $sqlCmd = "SELECT
                   tb_language.id,
                   tb_language.langMin,
                   tb_language.lang
            FROM tb_country_language
            JOIN tb_language ON tb_language.id = tb_country_language.idTbLanguage
            JOIN tb_country ON tb_country.id = tb_country_language.idTbCountry
            WHERE tb_country_language.status =1
            AND tb_language.deleted = 0
            AND
             tb_country.id= $idCountry";
    if ($result = $connection->query($sqlCmd)) {
        while ($row = mysqli_fetch_assoc($result)) {
            $langId = $row['id'];
            if ($listNavBar == '') {
                $listNavBar = '<li class="active"><a href="#'.$row['langMin'].'" data-toggle="tab" aria-expanded="true">'.$row['lang'].'</a></li>';
            } else {
                $listNavBar .= '<li class=""><a href="#'.$row['langMin'].'" data-toggle="tab" aria-expanded="true">'.$row['lang'].'</a></li>';
            }
            $sql = "SELECT
                tb_advantage.idTbGallery,
                tb_advantage.idTbAdvantageTag,
                tb_advantage.position,
                tb_gallery.path,
                tb_advantage_translation.id,
                tb_advantage_translation.title,
                tb_advantage_translation.subtitle,
                tb_advantage_translation.description,
                tb_advantage_translation.cta,
                tb_advantage_translation.action
              FROM
                tb_advantage
              JOIN tb_gallery
              ON tb_advantage.idTbGallery = tb_gallery.id OR tb_advantage.idTbGallery IS NULL
              JOIN tb_advantage_translation
              ON tb_advantage_translation.idTbAdvantage = tb_advantage.id
              WHERE
                tb_advantage.id = $idFeature
              AND
                tb_advantage_translation.status = 1
              AND
                tb_advantage_translation.idTbLanguage = $langId";

            if ($result3 = $connection->query($sql)) {
                $numRow = mysqli_num_rows($result3);
                if ($numRow > 0) {
                    while ($row3 = mysqli_fetch_assoc($result3)) {
                        if ($listFormBar != '') {
                            $flag = false;
                        } else {
                            $flag = true;
                            $pos = $row3['position'];
                            $galleryId = $row3['idTbGallery'];
                            $path = $row3['path'];
                            $tag = $row3['idTbAdvantageTag'];
                        }
                        $id = $row3['id'];
                        $listFormBar .= funCreateItemsAdvantage($row['langMin'], $row['id'], $row3['title'], $row3['description'], $flag, $id, $row3['subtitle'], $row3['cta'], $row3['action']);
                    }
                } else {
                    if ($listFormBar != '') {
                        $flag = false;
                    } else {
                        $flag = true;
                    }
                    $listFormBar .= funCreateItemsAdvantage($row['langMin'], $row['id'], '', '', $flag, '', '', '', '');
                }
            }
        }

        $currentPos = 0;
        $optionRank = "<option value=''>Select an option</option>";
        $select = "SELECT count(*) FROM tb_advantage_translation WHERE idTbCountry=$idCountry GROUP BY idTbAdvantage ";
        if ($result = $connection->query($select)) {
            while ($row = mysqli_fetch_assoc($result)) {
                ++$currentPos;
                if ($currentPos == $pos) {
                    $select = 'selected';
                } else {
                    $select = '';
                }
                $optionRank .= "<option value='$currentPos' $select>$currentPos</option>";
            }
        }
        $optionsTag = funGetTagFeature($tag, true);
    }

    echo "true|#|$optionsCountry|#|$listNavBar|#|$listFormBar|#|$optionRank|#|$path|#|$galleryId|#|$optionsTag";
}

function funAddFeaturesTag()
{
    include_once 'session.php';
    include_once 'utils.php';
    include_once PATH_DATABASE_INC;
    $db = Database::getInstance();
    $connection = $db->getConnection();
    $viDateC = "'".date('Y-m-d H:i:s')."'";
    $viFeaturesTag = $_REQUEST['featuresTag'];
    if ($viFeaturesTag != '') {
        $sqlCmd = 'INSERT INTO tb_advantage_tag (dateO, userO, tag, status) VALUES';
        $sqlCmd .= "($viDateC,$usr_id,'$viFeaturesTag',1)";
        $result = $connection->query($sqlCmd);
        if ($result) {
            $new_id = $connection->insert_id;
            $action = '[ADD_TAG] - Sucess added #'.$new_id;
            funCreateLog($action, $connection);
            $db->commitAndClose();
            echo 'true||Operação realizada com sucesso.';
        } else {
            $action = '[ADD_TAG] - sql failed';
            funCreateLog($action, $connection);
            $db->rollbackAndClose();
            die('false||Oppsss... ocorreu um erro ao inserir.');
        }
    } else {
        $action = '[ADD_TAG] - Failed values came empty';
        funCreateLog($action, $connection);
        $db->rollbackAndClose();
        die('false||Oppsss...alguns valores estão vazios.');
    }
}

function funGetNewFeature()
{
    include_once 'session.php';
    include_once 'utils.php';
    include_once PATH_DATABASE_INC;
    $db = Database::getInstance();
    $connection = $db->getConnection();
    $idCountry = $_REQUEST['idCountry'];
    $listNavBar = '';
    $listFormBar = '';
    $id = '';
    $valueLine = '';

    $sqlCmd = "SELECT
                   tb_language.id,
                   tb_language.langMin,
                   tb_language.lang
            FROM tb_country_language
            JOIN tb_language ON tb_language.id = tb_country_language.idTbLanguage
            JOIN tb_country ON tb_country.id = tb_country_language.idTbCountry
            WHERE tb_country_language.status =1
            AND tb_language.deleted = 0
            AND
             tb_country.id= $idCountry";
    if ($result = $connection->query($sqlCmd)) {
        while ($row = mysqli_fetch_assoc($result)) {
            if ($listNavBar == '') {
                $listNavBar = '<li class="active"><a href="#'.$row['langMin'].'" data-toggle="tab" aria-expanded="true">'.$row['lang'].'</a></li>';
            } else {
                $listNavBar .= '<li class=""><a href="#'.$row['langMin'].'" data-toggle="tab" aria-expanded="true">'.$row['lang'].'</a></li>';
            }
            if ($listFormBar != '') {
                $flag = false;
            } else {
                $flag = true;
            }
            $listFormBar .= funCreateItemsAdvantage($row['langMin'], $row['id'], '', '', $flag, $id, '', '', '');
        }
        $currentPos = 0;
        $optionRank = "<option value=''>Select an option</option>";
        $select = "SELECT count(*) FROM tb_advantage_translation WHERE idTbCountry=$idCountry GROUP BY idTbAdvantage ";
        if ($result = $connection->query($select)) {
            while ($row = mysqli_fetch_assoc($result)) {
                ++$currentPos;
                $optionRank .= "<option value='$currentPos'>$currentPos</option>";
            }
            ++$currentPos;
            $optionRank .= "<option value='$currentPos' selected>$currentPos</option>";
        } else {
            die('false||Problem getting position');
        }
        echo 'true||'.$listNavBar.'||'.$listFormBar.'||'.$optionRank;
    } else {
        die('false||Error Getting Data');
    }
}

function funCreateItemsAdvantage($vfLang, $vfIdLang, $vcTitulo, $txTexto, $flag, $vfIdTrans, $vcSubTitulo = '', $cta = '', $action = '')
{
    if ($flag) {
        $active = 'active';
    } else {
        $active = '';
    }
    $value = '<div class="tab-pane fade '.$active.' in col-lg-12" id="'.$vfLang.'">    <br>';
    $value .= '	<div class="form-group">';
    $value .= '		<label>Title</label><input class="form-control" name="vcTitulo_'.$vfLang.'" value="'.$vcTitulo.'" >';
    $value .= '	</div>';
    $value .= '	<div class="form-group">';
    $value .= '		<label>Subtitle</label><input class="form-control" name="subtitle_'.$vfLang.'" value="'.$vcSubTitulo.'" >';
    $value .= '	</div>';
    $value .= '	<div class="form-group">';
    $value .= '		<label>Description</label>';
    $value .= '		<textarea id="txTexto_'.$vfLang.'" name="txTexto_'.$vfLang.'" class="form-control" >'.$txTexto.'</textarea>';
    $value .= '	</div>';
    $value .= '	<div class="form-group">';
    $value .= '		<label>Call To Action</label>';
    $value .= '		<input type="text" id="cta_'.$vfLang.'" name="cta_'.$vfLang.'" class="form-control" value="'.$cta.'">';
    $value .= '	</div>';
    $value .= '	<div class="form-group">';
    $value .= '		<label>Action</label>';
    $value .= '		<input type="text" id="action_'.$vfLang.'" name="action_'.$vfLang.'" class="form-control" value="'.$action.'">';
    $value .= '	</div>';
    $value .= '	<input type="hidden" name="idTrans_'.$vfLang.'" value="'.$vfIdTrans.'">';
    $value .= '	<input type="hidden" name="lang_'.$vfLang.'" value="'.$vfIdLang.'">';
    $value .= '	</div>';
    $value .= '</div>';

    return $value;
}

function funAddNewFeature()
{
    include_once 'session.php';
    include_once PATH_DATABASE_INC;
    $db = Database::getInstance();
    $connection = $db->getConnection();
    $viDateC = "'".date('Y-m-d H:i:s')."'";

    if (isset($_REQUEST['country'])) {
        $country = $_REQUEST['country'];
    } else {
        $country = '';
    }
    if (isset($_REQUEST['tagType'])) {
        $tagType = $_REQUEST['tagType'];
    } else {
        $tagType = '';
    }
    if (isset($_REQUEST['position'])) {
        $position = $_REQUEST['position'];
    } else {
        $position = '';
    }
    if (isset($_REQUEST['og_image'])) {
        $og_img = strlen($_REQUEST['og_image']) > 0 ? $_REQUEST['og_image'] : 'NULL';
    }

    if ($country != '' && $tagType != '' && $position != '' && $og_img) {
        $sqlCmd = 'INSERT INTO tb_advantage(dateO, userO, position, status, isFeature,idTbGallery, idTbAdvantageTag) VALUES ';
        $sqlCmd .= "($viDateC,$usr_id,$position,1,1,$og_img,$tagType)";
        if ($result = $connection->query($sqlCmd)) {
            $idFeature = $connection->insert_id;
            $sqlCmdCountryLang = 'SELECT
                                   tb_language.id,
                                   tb_language.langMin,
                                   tb_language.lang
                            FROM tb_country_language
                            JOIN tb_language ON tb_language.id = tb_country_language.idTbLanguage
                            JOIN tb_country ON tb_country.id = tb_country_language.idTbCountry
                            WHERE tb_country_language.status =1
                            AND tb_language.deleted = 0
                            AND
                             tb_country.id='.$country;
            if ($result1 = $connection->query($sqlCmdCountryLang)) {
                while ($row1 = mysqli_fetch_assoc($result1)) {
                    $langMin = $row1['langMin'];
                    $langId = $row1['id'];
                    if (isset($_REQUEST['vcTitulo_'.$langMin])) {
                        $title = funTreatString($_REQUEST['vcTitulo_'.$langMin]);
                    } else {
                        $title = '';
                    }
                    if (isset($_REQUEST['subtitle_'.$langMin])) {
                        $subtitle = funTreatString($_REQUEST['subtitle_'.$langMin]);
                    } else {
                        $subtitle = '';
                    }
                    if (isset($_REQUEST['txTexto_'.$langMin])) {
                        $description = funTreatString($_REQUEST['txTexto_'.$langMin]);
                    } else {
                        $description = '';
                    }
                    if (isset($_REQUEST['cta_'.$langMin])) {
                        $cta = funTreatString($_REQUEST['cta_'.$langMin]);
                    } else {
                        $cta == '';
                    }
                    if (isset($_REQUEST['action_'.$langMin])) {
                        $action = funTreatString($_REQUEST['action_'.$langMin]);
                    } else {
                        $action == '';
                    }
                    $sqlCmd1 = 'INSERT INTO tb_advantage_translation(dateO, userO, title, subtitle, description, cta, action, idTbCountry, idTbLanguage, idTbAdvantage) VALUES ';
                    $sqlCmd1 .= "($viDateC,$usr_id,'$title','$subtitle','$description','$cta', '$action', $country,$langId,$idFeature)";
                    if (!$result2 = $connection->query($sqlCmd1)) {
                        $action = '[ADD-FEATURE] - Failed add translation feature';
                        funCreateLog($action, $connection);
                        $db->rollbackAndClose();
                        die('false||Problem inserting translation');
                    }
                }
                $action = '[ADD-FEATURE] - Operation add success';
                funCreateLog($action, $connection);
                echo 'true||Operation was been successfuly done.';
                $db->commitAndClose();
            } else {
                $action = '[ADD-FEATURE] - Failed feature';
                funCreateLog($action, $connection);
                $db->rollbackAndClose();
                die('false||Problem getting language');
            }
        } else {
            die('false||Problem inserting feature.');
        }
    } else {
        die('false||Some values are empty');
    }
}

function funDeleteFeature()
{
    include_once 'session.php';
    include_once PATH_DATABASE_INC;
    $db = Database::getInstance();
    $connection = $db->getConnection();
    $viDateC = "'".date('Y-m-d H:i:s')."'";
    $sql = "UPDATE tb_advantage SET dateO=$viDateC,userO=$usr_id,status=0 WHERE id=".$_REQUEST['id'];
    if (!$result2 = $connection->query($sql)) {
        $action = 'Delete-FEATURE]';
        funCreateLog($action, $connection);
        $db->rollbackAndClose();
        die('false||Problem deleting feature');
    } else {
        $action = '[Delete-FEATURE] - Operation add success';
        funCreateLog($action, $connection);
        echo 'true||Operation was been successfuly done.';
        $db->commitAndClose();
    }
}
