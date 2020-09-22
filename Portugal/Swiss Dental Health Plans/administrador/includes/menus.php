<?php

include_once '../../includes/globalVars.php';
include_once 'utils.php';
$cmdEval = $_REQUEST['cmdEval'];
switch ($cmdEval) {
  case 'addMenusTag':
    if ($_REQUEST['bot'] == '') {
        funAddMenusTag();
    } else {
        die();
    }
    break;
  case 'initMenus':
    funInitMenus();
    break;
  case 'createNewMenu':
    funGetNewMenu();
    break;
  case 'addNewMenu':
    funAddNewMenu();
    break;
  case 'getMenu':
    funGetMenu();
    break;
  case 'deleteMenu':
    funDeleteMenu();
    break;
  case 'getMenuEdit':
    funGetMenuEdit();
    break;
  case 'editMenu':
    funEditMenu();
    break;
  default:
    // code...
    break;
}

function funInitMenus()
{
    echo 'true||'.funGetCountryAll('', true).'||'.funGetTagMenu('', true);
}

function funAddMenusTag()
{
    include_once 'session.php';
    include_once 'utils.php';
    include_once PATH_DATABASE_INC;
    $db = Database::getInstance();
    $connection = $db->getConnection();
    $viDateC = "'".date('Y-m-d H:i:s')."'";
    $viPackagesTag = $_REQUEST['PackagesTag'];
    if ($viPackagesTag != '') {
        $sqlCmd = 'INSERT INTO tb_menus_tag (dateO, userO, tag, status) VALUES';
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

function funGetNewMenu()
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
            $listFormBar .= funCreateItemsMenu($row['langMin'], $row['id'], '', '', $flag, $id);
        }
        $currentPos = 0;
        $optionRank = "<option value=''>Select an option</option>";
        $select = "SELECT count(*) FROM tb_menus_translation WHERE idTbCountry=$idCountry GROUP BY idTbMenu ";
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

function funCreateItemsMenu($vfLang, $vfIdLang, $vcUrl, $vcText, $flag, $vfIdTrans)
{
    if ($flag) {
        $active = 'active';
    } else {
        $active = '';
    }
    $value = '<div class="tab-pane fade '.$active.' in col-lg-12" id="'.$vfLang.'">    <br>';
    $value .= '	<div class="form-group">';
    $value .= '		<label>Url</label><input class="form-control" name="vcUrl_'.$vfLang.'" value="'.$vcUrl.'" >';
    $value .= '	</div>';
    $value .= '	<div class="form-group">';
    $value .= '		<label>Text</label><input class="form-control" name="vcText_'.$vfLang.'" value="'.$vcText.'" >';
    $value .= '	</div>';
    $value .= '	<input type="hidden" name="idTrans_'.$vfLang.'" value="'.$vfIdTrans.'">';
    $value .= '	<input type="hidden" name="lang_'.$vfLang.'" value="'.$vfIdLang.'">';
    $value .= '	</div>';
    $value .= '</div>';

    return $value;
}

function funAddNewMenu()
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
    if (isset($_REQUEST['vcRecomended'])) {
        $vcRecomended = $_REQUEST['vcRecomended'];
    } else {
        $vcRecomended = 0;
    }

    if ($country != '' && $tagType != '' && $position != '') {
        $sqlCmd = 'INSERT INTO tb_menus(dateO, userO, position, status, IsMenu, idTbMenusTag,recomended) VALUES ';
        $sqlCmd .= "($viDateC,$usr_id,$position,1,1,$tagType,$vcRecomended)";
        if ($result = $connection->query($sqlCmd)) {
            $idMenu = $connection->insert_id;
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

                    if (isset($_REQUEST['vcUrl_'.$langMin])) {
                        $url = funTreatString($_REQUEST['vcUrl_'.$langMin]);
                    } else {
                        $url = '';
                    }
                    if (isset($_REQUEST['vcText_'.$langMin])) {
                        $text = funTreatString($_REQUEST['vcText_'.$langMin]);
                    } else {
                        $text = '';
                    }
                    //if(isset($_REQUEST['txItens_'.$langMin])){$items=funTreatString($_REQUEST['txItens_'.$langMin]);}else{$items="";}
                    //if(isset($_REQUEST['BtTxt_'.$langMin])){$BtTxt=funTreatString($_REQUEST['BtTxt_'.$langMin]);}else{$BtTxt="";}
                    //if(isset($_REQUEST['Action_'.$langMin])){$ActionTxt=funTreatString($_REQUEST['Action_'.$langMin]);}else{$ActionTxt="";}

                    $sqlCmd1 = 'INSERT INTO tb_menus_translation(dateO, userO, url, text, idTbCountry, idTbLanguage, idTbMenu,status) VALUES ';
                    $sqlCmd1 .= "($viDateC,$usr_id,'$url','$text',$country,$langId,$idMenu,1)";

                    if (!$result2 = $connection->query($sqlCmd1)) {
                        $action = '[ADD-Menu] - Failed add translation Package';
                        funCreateLog($action, $connection);
                        $db->rollbackAndClose();
                        die('false||Problem inserting translation');
                    }
                }
                $action = '[ADD-Menu] - Operation add success';
                funCreateLog($action, $connection);
                echo 'true||Operation was been successfuly done.';
                $db->commitAndClose();
            } else {
                $action = '[ADD-Menu] - Failed Package';
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

function funGetMenu()
{
    include_once 'session.php';
    include_once 'utils.php';
    include_once PATH_DATABASE_INC;
    $db = Database::getInstance();
    $connection = $db->getConnection();
    $arrayMain = [];
    $sql = 'SELECT
          	tb_menus.id,
            tb_menus_tag.tag,
          	tb_menus_translation.url ,
            tb_menus_translation.text ,
          	tb_menus.position,
          	tb_country.country,
            tb_country.id as countryId
          FROM
          	tb_menus_translation
          JOIN tb_menus ON tb_menus_translation.idTbMenu = tb_menus.id
          JOIN tb_menus_tag ON tb_menus_tag.id = tb_menus.idTbMenusTag
          JOIN tb_country ON tb_menus_translation.idTbCountry = tb_country.id
          WHERE
          	tb_country.status = 1
          AND tb_menus.isMenu = 1
          AND tb_menus.status = 1
          GROUP BY
            tb_menus.id';
    if ($result = $connection->query($sql)) {
        while ($row = mysqli_fetch_assoc($result)) {
            $urlToEdit = "location.href='menus-editar.php?id=".$row['id'].'&idC='.$row['countryId']."'";
            $urlToDelete = 'funDeleteItem('.$row['id'].')';
            $values = '<button class="fa fa-edit" style="padding:5px; margin-left:10px" onclick="'.$urlToEdit.'"></button>';
            $values .= '<button class="fa fa-trash" style="padding:5px; margin-left:10px" onclick="'.$urlToDelete.'"></button>';
            array_push($arrayMain, [$row['id'], $row['tag'], $row['url'], $row['text'], $row['position'], $values]);
        }
    }
    //var_dump($arrayMain);
    //die();
    echo json_encode($arrayMain);
    $db->closeConnection();
}

function funDeleteMenu()
{
    include_once 'session.php';
    include_once PATH_DATABASE_INC;
    $db = Database::getInstance();
    $connection = $db->getConnection();
    $viDateC = "'".date('Y-m-d H:i:s')."'";
    $sql = "UPDATE tb_menus SET dateO=$viDateC,userO=$usr_id,status=0 WHERE id=".$_REQUEST['id'];
    if (!$result2 = $connection->query($sql)) {
        $action = '[Delete-Menu]';
        funCreateLog($action, $connection);
        $db->rollbackAndClose();
        die('false||Problem deleting Menu');
    } else {
        $action = '[Delete-Menu] - Operation add success';
        funCreateLog($action, $connection);
        echo 'true||Operation was been successfuly done.';
        $db->commitAndClose();
    }
}

function funGetMenuEdit()
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
    $idMenu = $_REQUEST['id'];
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
                tb_menus.idTbSubmenusTag,
                tb_menus.idTbMenusTag,
                tb_menus.position,
                tb_menus.recomended,
                tb_menus_translation.id,
                tb_menus_translation.url,
                tb_menus_translation.text
              FROM
              tb_menus
              JOIN tb_menus_translation
              ON tb_menus_translation.idTbMenu = tb_menus.id
              WHERE
              tb_menus.id = $idMenu
              AND
              tb_menus_translation.status = 1
              AND
              tb_menus_translation.idTbLanguage = $langId";
            if ($result3 = $connection->query($sql)) {
                $numRow = mysqli_num_rows($result3);
                if ($numRow > 0) {
                    while ($row3 = mysqli_fetch_assoc($result3)) {
                        if ($listFormBar != '') {
                            $flag = false;
                        } else {
                            $flag = true;
                            $submenuTag = $row3['idTbSubmenusTag'];
                            $tag = $row3['idTbMenusTag'];
                            $pos = $row3['position'];
                            $recomended = $row3['recomended'];
                        }
                        $id = $row3['id'];
                        $listFormBar .= funCreateItemsMenu($row['langMin'], $row['id'], $row3['url'], $row3['text'], $flag, $id);
                    }
                } else {
                    $listFormBar .= funCreateItemsMenu($row['langMin'], $row['id'], '', '', $flag, '');
                }
            }
        }

        $currentPos = 0;
        $optionRank = "<option value=''>Select an option</option>";
        $select = "SELECT count(*) FROM tb_menus_translation WHERE idTbCountry=$idCountry GROUP BY idTbMenu ";
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
        $optionsTag = funGetTagMenu($tag, true);
        $optionsSubmenuTag = funGetTagMenu($submenuTag, true);
    }

    echo "true|#|$optionsCountry|#|$listNavBar|#|$listFormBar|#|$optionRank|#|$optionsTag|#|$optionsSubmenuTag|#|$recomended";
}

function funEditMenu()
{
    include_once 'session.php';
    include_once 'utils.php';
    include_once PATH_DATABASE_INC;
    $db = Database::getInstance();
    $connection = $db->getConnection();
    $idMenu = $_REQUEST['idMenus'];

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
    if (isset($_REQUEST['submenuTagType'])) {
        $submenuTagType = $_REQUEST['submenuTagType'];
    } else {
        $submenuTagType = 'NULL';
    }
    if (isset($_REQUEST['position'])) {
        $position = $_REQUEST['position'];
    } else {
        $position = '';
    }
    //if(isset($_REQUEST['og_image'])){$og_img = $_REQUEST['og_image'];}else{$og_img = "NULL";}
    if (isset($_REQUEST['vcRecomended'])) {
        $vcRecomended = 1;
    } else {
        $vcRecomended = 0;
    }

    if ($tagType != '' && $position != '') {
        $submenuTagType = $submenuTagType == '' ? 'NULL' : $submenuTagType;
        $sqlCmd = "UPDATE tb_menus SET dateO=$viDateC,recomended=$vcRecomended, userO=$usr_id, position=$position,idTbSubmenusTag=$submenuTagType, idTbMenusTag=$tagType WHERE id=$idMenu";
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

                    if (isset($_REQUEST['vcUrl_'.$langMin])) {
                        $url = funTreatString($_REQUEST['vcUrl_'.$langMin]);
                    } else {
                        $url = '';
                    }
                    if (isset($_REQUEST['vcText_'.$langMin])) {
                        $text = funTreatString($_REQUEST['vcText_'.$langMin]);
                    } else {
                        $text = '';
                    }
                    if (isset($_REQUEST['idTrans_'.$langMin])) {
                        $idTrans = funTreatString($_REQUEST['idTrans_'.$langMin]);
                    } else {
                        $idTrans = '';
                    }

                    if ($idTrans != '') {
                        $sqlCmd1 = "UPDATE tb_menus_translation SET dateO=$viDateC, userO=$usr_id, url='$url', text='$text'";
                        $sqlCmd1 .= " WHERE id=$idTrans";
                    } else {
                        $sqlCmd1 = 'INSERT INTO tb_menus_translation(dateO, userO, url, text, idTbCountry, idTbLanguage, idTbMenu) VALUES ';
                        $sqlCmd1 .= "($viDateC,$usr_id,'$url','$text',$country,$langId,$idMenu)";
                    }

                    if (!$result2 = $connection->query($sqlCmd1)) {
                        $action = '[EDIT-Menu] - Failed add translation Menu';
                        funCreateLog($action, $connection);
                        $db->rollbackAndClose();
                        die('false||Problem inserting/updating translation');
                    }
                }
                $action = '[EDIT-Menu] - Operation add success';
                funCreateLog($action, $connection);
                echo 'true||Operation was been successfuly done.';
                $db->commitAndClose();
            } else {
                $action = '[EDIT-Menu] - Failed Menu';
                funCreateLog($action, $connection);
                $db->rollbackAndClose();
                die('false||Problem getting language');
            }
        } else {
            die('false||Problem inserting Menu.');
        }
    } else {
        die('false||Some values are empty');
    }
}
