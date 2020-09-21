<?php

include_once '../../includes/globalVars.php';
include_once 'utils.php';
$cmdEval = $_REQUEST['cmdEval'];
switch ($cmdEval) {
  case 'addPackagesTag':
      if ($_REQUEST['bot'] == '') {
          funAddPackagesTag();
      } else {
          die();
      }
      break;
  case 'createNewPackage':
    funGetNewPackage();
    break;
  case 'initPackages':
    funInitPackages();
    break;
  case 'addNewPackage':
    funAddNewPackage();
    break;
  case 'getPackageEdit':
    funGetPackageEdit();
    break;
  case 'getPackage':
    funGetPackage();
    break;
  case 'deletePackage':
    funDeletePackage();
    break;
  case 'editPackage':
    funEditPackage();
    break;
  default:
    // code...
    break;
}

function funInitPackages()
{
    echo 'true||'.funGetCountryAll('', true).'||'.funGetTagPackage('', true);
}
function funEditPackage()
{
    include_once 'session.php';
    include_once 'utils.php';
    include_once PATH_DATABASE_INC;
    $db = Database::getInstance();
    $connection = $db->getConnection();
    $idPackage = $_REQUEST['idPackages'];

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
        $og_img = $_REQUEST['og_image'];
    } else {
        $og_img = 'NULL';
    }
    if (isset($_REQUEST['vcRecomended'])) {
        $vcRecomended = 1;
    } else {
        $vcRecomended = 0;
    }

    if ($tagType != '' && $position != '' && $og_img) {
        $sqlCmd = "UPDATE tb_packages SET dateO=$viDateC,recomended=$vcRecomended, userO=$usr_id, position=$position,idTbGallery=$og_img, idTbPackagesTag=$tagType WHERE id=$idPackage";

        if ($result = $connection->query($sqlCmd)) {
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
                    if (isset($_REQUEST['vcPreco_'.$langMin])) {
                        $price = funTreatString($_REQUEST['vcPreco_'.$langMin]);
                    } else {
                        $price = '';
                    }
                    if (isset($_REQUEST['txItens_'.$langMin])) {
                        $items = funTreatString($_REQUEST['txItens_'.$langMin]);
                    } else {
                        $items = '';
                    }
                    if (isset($_REQUEST['BtTxt_'.$langMin])) {
                        $buttontext = funTreatString($_REQUEST['BtTxt_'.$langMin]);
                    } else {
                        $buttontext = '';
                    }
                    if (isset($_REQUEST['Action_'.$langMin])) {
                        $Actiontext = funTreatString($_REQUEST['Action_'.$langMin]);
                    } else {
                        $Actiontext = '';
                    }
                    if (isset($_REQUEST['idTrans_'.$langMin])) {
                        $idTrans = funTreatString($_REQUEST['idTrans_'.$langMin]);
                    } else {
                        $idTrans = '';
                    }

                    if ($idTrans != '') {
                        $sqlCmd1 = "UPDATE tb_packages_translation SET dateO=$viDateC, userO=$usr_id, title='$title', price='$price',";
                        $sqlCmd1 .= " items='$items', buttontext='$buttontext', action='$Actiontext' WHERE id=$idTrans";
                    } else {
                        $sqlCmd1 = 'INSERT INTO tb_packages_translation(dateO, userO, title, price, items, buttontext,action, idTbCountry, idTbLanguage, idTbPackage) VALUES ';
                        $sqlCmd1 .= "($viDateC,$usr_id,'$title','$price','$items','$buttontext',$Actiontext,$country,$langId,$idPackage)";
                    }

                    if (!$result2 = $connection->query($sqlCmd1)) {
                        $action = '[EDIT-Package] - Failed add translation Package';
                        funCreateLog($action, $connection);
                        $db->rollbackAndClose();
                        die('false||Problem inserting/updating translation');
                    }
                }
                $action = '[EDIT-Package] - Operation add success';
                funCreateLog($action, $connection);
                echo 'true||Operation was been successfuly done.';
                $db->commitAndClose();
            } else {
                $action = '[EDIT-Package] - Failed Package';
                funCreateLog($action, $connection);
                $db->rollbackAndClose();
                die('false||Problem getting language');
            }
        } else {
            die('false||Problem inserting Package.');
        }
    } else {
        die('false||Some values are empty');
    }
}

function funGetPackage()
{
    include_once 'session.php';
    include_once 'utils.php';
    include_once PATH_DATABASE_INC;
    $db = Database::getInstance();
    $connection = $db->getConnection();
    $arrayMain = [];
    $sql = 'SELECT
          	tb_packages.id ,
          	tb_packages_translation.Title ,
          	tb_packages.position ,
          	tb_country.country,
            tb_country.id as countryId
          FROM
          	tb_packages_translation
          JOIN tb_packages ON tb_packages_translation.idTbPackage = tb_packages.id
          JOIN tb_country ON tb_packages_translation.idTbCountry = tb_country.id
          WHERE
          	tb_country.status = 1
          AND tb_packages.isPackage = 1
          AND tb_packages.status = 1
          GROUP BY
            tb_packages.id';
    if ($result = $connection->query($sql)) {
        while ($row = mysqli_fetch_assoc($result)) {
            $urlToEdit = "location.href='packages-editar.php?id=".$row['id'].'&idC='.$row['countryId']."'";
            $urlToDelete = 'funDeleteItem('.$row['id'].')';
            $values = '<button class="fa fa-edit" style="padding:5px; margin-left:10px" onclick="'.$urlToEdit.'"></button>';
            $values .= '<button class="fa fa-trash" style="padding:5px; margin-left:10px" onclick="'.$urlToDelete.'"></button>';
            array_push($arrayMain, [$row['id'], $row['Title'], $row['position'], $row['country'], $values]);
        }
    }
    echo json_encode($arrayMain);
    $db->closeConnection();
}

function funGetPackageEdit()
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
    $idPackage = $_REQUEST['id'];
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
                tb_packages.idTbGallery,
                tb_packages.idTbPackagesTag,
                tb_packages.position,
                tb_packages.recomended,
                tb_gallery.path,
                tb_packages_translation.id,
                tb_packages_translation.Title,
                tb_packages_translation.price,
                tb_packages_translation.items,
                tb_packages_translation.buttontext,
                tb_packages_translation.action
              FROM
                tb_packages
              JOIN tb_gallery
              ON tb_packages.idTbGallery = tb_gallery.id
              JOIN tb_packages_translation
              ON tb_packages_translation.idTbPackage = tb_packages.id
              WHERE
                tb_packages.id = $idPackage
              AND
                tb_packages_translation.status = 1
              AND
                tb_packages_translation.idTbLanguage = $langId";
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
                            $tag = $row3['idTbPackagesTag'];
                            $recomended = $row3['recomended'];
                        }
                        $id = $row3['id'];
                        $listFormBar .= funCreateItemsPackage($row['langMin'], $row['id'], $row3['Title'], $row3['price'], $flag, $id, $row3['items'], $row3['buttontext'], $row3['action']);
                    }
                } else {
                    $listFormBar .= funCreateItemsPackage($row['langMin'], $row['id'], '', '', $flag, '', '', '', '');
                }
            }
        }

        $currentPos = 0;
        $optionRank = "<option value=''>Select an option</option>";
        $select = "SELECT count(*) FROM tb_packages_translation WHERE idTbCountry=$idCountry GROUP BY idTbPackage ";
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
        $optionsTag = funGetTagPackage($tag, true);
    }

    echo "true|#|$optionsCountry|#|$listNavBar|#|$listFormBar|#|$optionRank|#|$path|#|$galleryId|#|$optionsTag|#|$recomended";
}

function funAddPackagesTag()
{
    include_once 'session.php';
    include_once 'utils.php';
    include_once PATH_DATABASE_INC;
    $db = Database::getInstance();
    $connection = $db->getConnection();
    $viDateC = "'".date('Y-m-d H:i:s')."'";
    $viPackagesTag = $_REQUEST['PackagesTag'];
    if ($viPackagesTag != '') {
        $sqlCmd = 'INSERT INTO tb_packages_tag (dateO, userO, tag, status) VALUES';
        $sqlCmd .= "($viDateC,$usr_id,'$viPackagesTag',1)";
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

function funGetNewPackage()
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
            $listFormBar .= funCreateItemsPackage($row['langMin'], $row['id'], '', '', $flag, $id, '', '', '');
        }
        $currentPos = 0;
        $optionRank = "<option value=''>Select an option</option>";
        $select = "SELECT count(*) FROM tb_packages_translation WHERE idTbCountry=$idCountry GROUP BY idTbPackage ";
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

function funCreateItemsPackage($vfLang, $vfIdLang, $vcTitulo, $txPreco, $flag, $vfIdTrans, $vcItems = '', $vcButtonTxt = '', $vcActionTxt = '')
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
    $value .= '		<label>Price</label><input class="form-control" name="vcPreco_'.$vfLang.'" value="'.$txPreco.'" >';
    $value .= '	</div>';
    $value .= '	<div class="form-group">';
    $value .= '		<label>Description</label>';
    $value .= '		<textarea id="txItens_'.$vfLang.'" name="txItens_'.$vfLang.'" class="form-control" >'.$vcItems.'</textarea>';
    $value .= '	</div>';
    $value .= '	<div class="form-group">';
    $value .= '		<label>Button Text</label>';
    $value .= '		<input class="form-control" name="BtTxt_'.$vfLang.'" value="'.$vcButtonTxt.'" >';
    $value .= '	</div>';
    $value .= '	<div class="form-group">';
    $value .= '		<label>Action</label>';
    $value .= '		<input class="form-control" name="Action_'.$vfLang.'" value="'.$vcActionTxt.'" >';
    $value .= '	</div>';
    $value .= '	<input type="hidden" name="idTrans_'.$vfLang.'" value="'.$vfIdTrans.'">';
    $value .= '	<input type="hidden" name="lang_'.$vfLang.'" value="'.$vfIdLang.'">';
    $value .= '	</div>';
    $value .= '</div>';

    return $value;
}

function funAddNewPackage()
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
    if (isset($_REQUEST['og_image']) && !empty($_REQUEST['og_image'])) {
        $og_img = $_REQUEST['og_image'];
    } else {
        $og_img = 'NULL';
    }
    if (isset($_REQUEST['vcRecomended'])) {
        $vcRecomended = $_REQUEST['og_image'];
    } else {
        $vcRecomended = 0;
    }
    if ($country != '' && $tagType != '' && $position != '' && $og_img != 'NULL') {
        $sqlCmd = 'INSERT INTO tb_packages(dateO, userO, position, status, IsPackage,idTbGallery, idTbPackagesTag,recomended) VALUES ';
        $sqlCmd .= "($viDateC,$usr_id,$position,1,1,$og_img,$tagType,$vcRecomended)";
        if ($result = $connection->query($sqlCmd)) {
            $idPackage = $connection->insert_id;
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
                    if (isset($_REQUEST['vcPreco_'.$langMin])) {
                        $price = funTreatString($_REQUEST['vcPreco_'.$langMin]);
                    } else {
                        $price = '';
                    }
                    if (isset($_REQUEST['txItens_'.$langMin])) {
                        $items = funTreatString($_REQUEST['txItens_'.$langMin]);
                    } else {
                        $items = '';
                    }
                    if (isset($_REQUEST['BtTxt_'.$langMin])) {
                        $BtTxt = funTreatString($_REQUEST['BtTxt_'.$langMin]);
                    } else {
                        $BtTxt = '';
                    }
                    if (isset($_REQUEST['Action_'.$langMin])) {
                        $ActionTxt = funTreatString($_REQUEST['Action_'.$langMin]);
                    } else {
                        $ActionTxt = '';
                    }

                    $sqlCmd1 = 'INSERT INTO tb_packages_translation(dateO, userO, Title, price, items, idTbCountry, idTbLanguage, idTbPackage,buttontext,action,status) VALUES ';
                    $sqlCmd1 .= "($viDateC,$usr_id,'$title','$price','$items',$country,$langId,$idPackage,'$BtTxt','$ActionTxt',1)";

                    if (!$result2 = $connection->query($sqlCmd1)) {
                        $action = '[ADD-Package] - Failed add translation Package';
                        funCreateLog($action, $connection);
                        $db->rollbackAndClose();
                        die('false||Problem inserting translation');
                    }
                }
                $action = '[ADD-Package] - Operation add success';
                funCreateLog($action, $connection);
                echo 'true||Operation was been successfuly done.';
                $db->commitAndClose();
            } else {
                $action = '[ADD-Package] - Failed Package';
                funCreateLog($action, $connection);
                $db->rollbackAndClose();
                die('false||Problem getting language');
            }
        } else {
            die('false||Problem inserting Package.');
        }
    } else {
        die('false||Some values are empty');
    }
}

function funDeletePackage()
{
    include_once 'session.php';
    include_once PATH_DATABASE_INC;
    $db = Database::getInstance();
    $connection = $db->getConnection();
    $viDateC = "'".date('Y-m-d H:i:s')."'";
    $sql = "UPDATE tb_packages SET dateO=$viDateC,userO=$usr_id,status=0 WHERE id=".$_REQUEST['id'];
    if (!$result2 = $connection->query($sql)) {
        $action = 'Delete-Package]';
        funCreateLog($action, $connection);
        $db->rollbackAndClose();
        die('false||Problem deleting Package');
    } else {
        $action = '[Delete-Package] - Operation add success';
        funCreateLog($action, $connection);
        echo 'true||Operation was been successfuly done.';
        $db->commitAndClose();
    }
}
