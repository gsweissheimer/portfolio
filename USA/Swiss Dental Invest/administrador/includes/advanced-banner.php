<?php

include_once '../../includes/globalVars.php';
include_once 'utils.php';
$cmdEval = $_REQUEST['cmdEval'];

switch ($cmdEval) {
  case 'addAdvancedBannerTag':
    if ($_REQUEST['bot'] == '') {
        funAddAdvancedBannerTag();
    } else {
        die();
    }
    break;

  case 'getCountryLang':
    funGetCountryLang();
    break;

  case 'addAdvancedBanner':
    if ($_REQUEST['bot'] == '') {
        funAddBanner();
    } else {
        die();
    }
    break;

  case 'getAdvancedBanners':
    funGetAdvancedBanners();
    break;

  case 'deleteAdvancedBanner':
    funDeleteAdvancedBanner();
    break;

  case 'getAdvancedBannerEdit':
    funGetAdvancedBannerEdit();
    break;

  case 'editAdvancedBanner':
    if ($_REQUEST['bot'] == '') {
        funEditAdvancedBanner();
    } else {
        die();
    }
    break;

  /*
  case 'getAdvancedBannerNew':
    funGetAdvancedBannerNew();
    break;
  case 'getBannerNew':
    funGetBannerNew();
    break;
  case 'addBannerTag':
    if($_REQUEST['bot'] == ""){funAddBannerTag();}else{die();}
    break;
  case 'addBanner':
    if($_REQUEST['bot'] == ""){funAddBanner();}else{die();}
    break;
  case 'getBanners':
    funGetBanners();
    break;
  case 'deleteBanner':
    funDeleteBanner();
    break;
  case 'getBanner':
    funGetBanner();
    break;
  case 'editBanner':
    if($_REQUEST['bot'] == ""){ funEditBanner();}else{ die();}
    break;
  case 'getBannerEdit':
    funGetBannerEdit();
    break;
  */
  default:
    // code...
    break;
}

function funEditAdvancedBanner()
{
    include_once 'session.php';
    include_once 'utils.php';
    include_once PATH_DATABASE_INC;
    $db = Database::getInstance();
    $connection = $db->getConnection();
    $viDateC = "'".date('Y-m-d H:i:s')."'";
    $inserted = false;

    $idBanner = $_REQUEST['idBanner'];
    $idBannerTag = $_REQUEST['bannerTag'];
    $idCountry = $_REQUEST['idCountry'];
    $position = $_REQUEST['position'];
    if (isset($_REQUEST['checkBox'])) {
        $viCheckBox = 1;
    } else {
        $viCheckBox = 0;
    }
    $duration = $_REQUEST['duration'];
    $images = $_REQUEST['og_img'];

    $sqlUpdBanner = "UPDATE tb_advanced_banner SET dateO=$viDateC, userO=$usr_id, position='$position', flagCta='$viCheckBox', duration='$duration'";
    $sqlUpdBanner .= ", idTbGallery='$images', idTbBannerTag = '$idBannerTag' WHERE id=$idBanner";
    if ($result = $connection->query($sqlUpdBanner)) {
        $sqlGetLang = 'SELECT
                       tb_language.id,
                       tb_language.lang,
                       tb_language.langMin,
                       tb_country.abbCountry
                   FROM tb_country_language
                   JOIN tb_language ON tb_language.id = tb_country_language.idTbLanguage
                   JOIN tb_country ON tb_country.id = tb_country_language.idTbCountry
                   WHERE tb_country_language.status = 1
                   AND tb_language.deleted = 0
                   AND
                       tb_country.id='.$idCountry;
        if ($resultLang = $connection->query($sqlGetLang)) {
            while ($rowLang = mysqli_fetch_assoc($resultLang)) {
                $idLanguage = $rowLang['id'];
                $bannerTitle = funTreatString($_REQUEST['title_banner_'.$rowLang['lang'].'_'.$rowLang['langMin']]);
                $bannerDesc = funTreatString($_REQUEST['description_banner_'.$rowLang['lang'].'_'.$rowLang['langMin']]);
                $bannerText = funTreatString($_REQUEST['text_banner_'.$rowLang['lang'].'_'.$rowLang['langMin']]);
                $bannerSubText = funTreatString($_REQUEST['sub_text_banner_'.$rowLang['lang'].'_'.$rowLang['langMin']]);
                $bannerCtaTitle = funTreatString($_REQUEST['call_title_'.$rowLang['lang'].'_'.$rowLang['langMin']]);
                $bannerCtaAction = funTreatString($_REQUEST['call_action_'.$rowLang['lang'].'_'.$rowLang['langMin']]);
                $idTrans = $_REQUEST['idTrans_'.$rowLang['lang'].'_'.$rowLang['langMin']];

                if ($idTrans) {
                    $sqlUpdBannerTrans = "UPDATE tb_advanced_banner_translation SET dateC= $viDateC, title='$bannerTitle', subtitle='$bannerDesc', text = '$bannerText'";
                    $sqlUpdBannerTrans .= ", subtext = '$bannerSubText', callTitle = '$bannerCtaTitle', callAction = '$bannerCtaAction' ";
                    $sqlUpdBannerTrans .= "WHERE id= $idTrans";
                } else {
                    $sqlUpdBannerTrans = 'INSERT INTO tb_advanced_banner_translation (dateC, title, subtitle, text, subtext, callTitle, callAction, status, idTbLanguage, idTbBanner, idTbCountry)';
                    $sqlUpdBannerTrans .= " VALUES ($viDateC, '$bannerTitle', '$bannerDesc', '$bannerText', '$bannerSubText', '$bannerCtaTitle', '$bannerCtaAction', 1, $idLanguage, $idBanner, $idCountry)";
                }

                $result2 = $connection->query($sqlUpdBannerTrans);

                if (!$result2) {
                    $action = '[UPD ADVANCED BANNER TRANS] - sql failed';
                    funCreateLog($action, $connection);
                    $db->rollbackAndClose();
                    die('false||Oppsss... ocorreu um erro ao actualizar o banner.');
                } else {
                    $inserted = true;
                }
            }
            if ($inserted) {
                $action = '[UPD ADVANCED BANNER TRANS] - Sucess added';
                funCreateLog($action, $connection);
                $db->commitAndClose();
                echo 'true||Operação realizada com sucesso.';
            }
        }
    } else {
        $action = '[UPD ADVANCED BANNER] - sql failed';
        funCreateLog($action, $connection);
        $db->rollbackAndClose();
        die('false||Ocorreu um problema actualizar o banner 1.');
    }
}

function funGetCountry($vfIdCountry = '', $isToReturn = false)
{
    include_once PATH_DATABASE_INC;
    $db = Database::getInstance();
    $connection = $db->getConnection();
    $sqlCmdCountry = 'SELECT id, country, abbCountry FROM tb_country WHERE status = 1';
    $optionCountry = "<option value=''>Select an option</option>";
    if ($result = $connection->query($sqlCmdCountry)) {
        while ($row = mysqli_fetch_assoc($result)) {
            $idCountry = $row['id'];
            $country = $row['country'];
            if ($vfIdCountry == $idCountry) {
                $select = 'selected';
            } else {
                $select = '';
            }
            $optionCountry .= "<option value='$idCountry' $select>$country</option>";
        }
    }
    if ($isToReturn) {
        return $optionCountry;
    } else {
        echo 'true||'.$optionCountry;
    }
}

function funGetAdvancedBannerTag($vfTagId = '')
{
    include_once PATH_DATABASE_INC;
    $db = Database::getInstance();
    $connection = $db->getConnection();
    $sqlCmd = 'SELECT
              id, tag
              FROM
              tb_advanced_banner_tag
              WHERE status=1
              GROUP BY
              tb_advanced_banner_tag.id';
    $values = '';
    $option = "<option value=''>Select an option</option>";
    if ($result = $connection->query($sqlCmd)) {
        while ($rsData = mysqli_fetch_assoc($result)) {
            $idTag = $rsData['id'];
            if ($vfTagId == $idTag) {
                $select = 'selected';
            } else {
                $select = '';
            }
            $option .= '<option value="'.$idTag.'" '.$select.'>'.$rsData['tag'].'</option>';
        }
    }

    return $option;
}

function funGetAdvancedBannerEdit()
{
    include_once PATH_DATABASE_INC;
    $db = Database::getInstance();
    $connection = $db->getConnection();
    $idCountry = $_REQUEST['idC'];
    $idBanner = $_REQUEST['id'];
    $countryOptions = funGetCountry($idCountry, true);
    $listFormBar = '';
    $navBar = '';
    $idGallery = null;
    $idBannerTag = null;
    $position = null;
    $flagCta = null;
    $duration = null;
    $sqlCmdCountryLang = "SELECT
                             tb_language.id,
                             tb_language.langMin,
                             tb_language.lang
                      FROM tb_country_language
                      JOIN tb_language ON tb_language.id = tb_country_language.idTbLanguage
                      JOIN tb_country ON tb_country.id = tb_country_language.idTbCountry
                      WHERE tb_country_language.status =1
                      AND tb_language.deleted = 0
                      AND
                       tb_country.id=$idCountry
                      ORDER BY tb_country_language.defaultLang DESC";
    if ($result1 = $connection->query($sqlCmdCountryLang)) {
        while ($row1 = mysqli_fetch_assoc($result1)) {
            if ($navBar == '') {
                $navBar .= '<li role="presentation" class="nabTab active"><a href="#'.$row1['langMin'].'" aria-controls="1" role="tab" data-toggle="tab">'.$row1['langMin'].'</a></li>';
            } else {
                $navBar .= '<li role="presentation" class="nabTab"><a href="#'.$row1['langMin'].'" aria-controls="1" role="tab" data-toggle="tab">'.$row1['langMin'].'</a></li>';
            }
            $sqlGetBannerTrans = "SELECT
                                  tb_advanced_banner_translation.id,
                                  tb_advanced_banner_translation.title,
                                  tb_advanced_banner_translation.subtitle,
                                  tb_advanced_banner_translation.text,
                                  tb_advanced_banner_translation.subText,
                                  tb_advanced_banner_translation.callTitle,
                                  tb_advanced_banner_translation.callAction,
                                  tb_advanced_banner.idTbGallery,
                                  tb_advanced_banner.position,
                                  tb_advanced_banner.idTbBannerTag,
                                  tb_advanced_banner.flagCta,
                                  tb_advanced_banner.duration
                            FROM
                              tb_advanced_banner_translation
                            JOIN tb_advanced_banner ON tb_advanced_banner.id = tb_advanced_banner_translation.idTbBanner
                            WHERE tb_advanced_banner_translation.idTbBanner=$idBanner
                            AND idTbLanguage=".$row1['id'];


            if ($result3 = $connection->query($sqlGetBannerTrans)) {
                $numRow = mysqli_num_rows($result3);
                if ($numRow > 0) {
                    while ($row3 = mysqli_fetch_assoc($result3)) {
                        if ($listFormBar != '') {
                            $flag = false;
                        } else {
                            $idGallery = $row3['idTbGallery'];
                            $idBannerTag = $row3['idTbBannerTag'];
                            $position = $row3['position'];
                            $flagCta = $row3['flagCta'];
                            $duration = $row3['duration'];
                            $flag = true;
                        }

                        $viArrayValues['country'] = $row1['lang'];
                        $viArrayValues['lang'] = $row1['lang'];
                        $viArrayValues['langMin'] = $row1['langMin'];
                        $viArrayValues['textBanner'] = $row3['text'];
                        $viArrayValues['subTextBanner'] = $row3['subText'];
                        $viArrayValues['callTitle'] = $row3['callTitle'];
                        $viArrayValues['callAction'] = $row3['callAction'];
                        $viArrayValues['titleBanner'] = $row3['title'];
                        $viArrayValues['descriptionBanner'] = $row3['subtitle'];
                        $viArrayValues['idTrans'] = $row3['id'];
                        $viArrayValues['flag'] = $flag;
                        $listFormBar .= funCreateAdvancedBannerNew($viArrayValues);
                    }
                } else {
                    $viArrayValues['country'] = $row1['lang'];
                    $viArrayValues['lang'] = $row1['lang'];
                    $viArrayValues['langMin'] = $row1['langMin'];
                    $viArrayValues['textBanner'] = '';
                    $viArrayValues['subTextBanner'] = '';
                    $viArrayValues['callTitle'] = '';
                    $viArrayValues['callAction'] = '';
                    $viArrayValues['titleBanner'] = '';
                    $viArrayValues['descriptionBanner'] = '';
                    $viArrayValues['idTrans'] = '';
                    $viArrayValues['flag'] = false;
                    $listFormBar .= funCreateAdvancedBannerNew($viArrayValues);
                }
            }
        }
    }
    $gallery = array();
    $arrayGallery = explode('||', $idGallery);
    //var_dump($idGallery);
    //exit();
    foreach ($arrayGallery as $key => $id) {
        $sqlCmd = 'SELECT * FROM tb_gallery WHERE id='.$id;
        if ($result4 = $connection->query($sqlCmd)) {
            while ($rowGal = mysqli_fetch_assoc($result4)) {
                array_push($gallery, array(
          'id' => $id,
          'path' => $rowGal['path'],
        ));
            }
        }
    }
    $gallery = json_encode($gallery);
    //var_dump($gallery);
    //exit(0);
    $optionBannerTag = funGetAdvancedBannerTag($idBannerTag);
    echo "true|#|$countryOptions|#|$gallery|#|$navBar|#|$listFormBar|#|$optionBannerTag|#|$position|#|$flagCta|#|$duration";
}

function funCreateAdvancedBannerNew($vfArrayValues)
{
    if ($vfArrayValues['flag'] == 'true') {
        $active = 'active';
    } else {
        $active = '';
    }
    $vfLang = $vfArrayValues['lang'];
    $vfLangMin = $vfArrayValues['langMin'];
    $vfCountry = $vfArrayValues['country'];
    $value = '<div class="tab-pane fade '.$active.' in col-sm-12" id="'.$vfLangMin.'"> <br>';
    $value .= '		<div class="form-group">';
    $value .= '			<label>Titulo Slide</label>';
    $value .= '			<textarea id="title_banner" name="title_banner_'.$vfCountry.'_'.$vfLangMin.'" class="form-control ckeditor" required>'.$vfArrayValues['titleBanner'].'</textarea>';
    $value .= '		</div>';
    $value .= '		<div class="form-group">';
    $value .= '			<label>Sub Titulo Banner</label>';
    $value .= '			<textarea id="description_banner" name="description_banner_'.$vfCountry.'_'.$vfLangMin.'" class="form-control" required>'.$vfArrayValues['descriptionBanner'].'</textarea>';
    $value .= '		</div>';
    $value .= '		<div class="form-group">';
    $value .= '			<label>Texto Banner</label>';
    $value .= '			<textarea id="text_banner" name="text_banner_'.$vfCountry.'_'.$vfLangMin.'" class="form-control" required>'.$vfArrayValues['textBanner'].'</textarea>';
    $value .= '		</div>';
    $value .= '		<div class="form-group">';
    $value .= '			<label>Sub Texto Banner</label>';
    $value .= '			<textarea id="sub_text_banner_" name="sub_text_banner_'.$vfCountry.'_'.$vfLangMin.'" class="form-control" required>'.$vfArrayValues['subTextBanner'].'</textarea>';
    $value .= '		</div>';
    $value .= '		<div class="form-group">';
    $value .= '<hr style="background: black; height: 1px;" >';
    $value .= '		</div>';
    $value .= '		<div class="form-group">';
    $value .= '			<label>Call to Action</label>';
    $value .= '			<label>Title</label>';
    $value .= '			<input id="call_title" name="call_title_'.$vfCountry.'_'.$vfLangMin.'" class="form-control" value="'.$vfArrayValues['callTitle'].'" required> ';
    $value .= '			<label>Action</label>';
    $value .= '			<input id="call_action" name="call_action_'.$vfCountry.'_'.$vfLangMin.'" class="form-control" value="'.$vfArrayValues['callAction'].'" required> ';
    $value .= '		</div>';
    $value .= '<input  type="hidden" id="idTrans" name="idTrans_'.$vfCountry.'_'.$vfLangMin.'" class="form-control" value="'.$vfArrayValues['idTrans'].'">';
    $value .= '</div>';

    return $value;
}

function funDeleteAdvancedBanner()
{
    include_once 'session.php';
    include_once 'utils.php';
    include_once PATH_DATABASE_INC;
    $db = Database::getInstance();
    $connection = $db->getConnection();
    $bannerId = $_REQUEST['id'];
    $viDateC = "'".date('Y-m-d H:i:s')."'";
    $sqlCmdDeleteImage = "UPDATE tb_advanced_banner SET dateO= $viDateC, userO = $usr_id, status = 0 WHERE id='$bannerId'";
    $result = $connection->query($sqlCmdDeleteImage);
    if ($result) {
        $action = '[DELETE ADVANCED BANNER] - Sucess deleting #'.$bannerId;
        funCreateLog($action, $connection);
        $db->commitAndClose();
        echo 'true||Operação realizada com sucesso.';
    } else {
        $action = '[DELETE ADVANCED BANNER] - Error deleting #'.$bannerId;
        funCreateLog($action, $connection);
        $db->rollbackAndClose();
        echo 'false||Operação Falhou.';
    }
}

function funGetAdvancedBanners()
{
    include_once PATH_DATABASE_INC;
    $db = Database::getInstance();
    $connection = $db->getConnection();
    $sqlCmd = 'SELECT
                  tb_advanced_banner_tag.tag,
                  tb_advanced_banner.id,
                  tb_advanced_banner.duration,
                  tb_advanced_banner_translation.title,
                  tb_country.country,
                  tb_country.id as countryID
             FROM
                  tb_advanced_banner_tag
             JOIN tb_advanced_banner ON tb_advanced_banner_tag.id = tb_advanced_banner.idTbBannerTag
             JOIN tb_advanced_banner_translation ON tb_advanced_banner.id = tb_advanced_banner_translation.idTbBanner
             JOIN tb_country ON tb_advanced_banner_translation.idTbCountry = tb_country.id
             WHERE tb_advanced_banner.status = 1
             GROUP BY tb_advanced_banner.id';

    $values = '';
    $arrayMain = [];
    //var_dump($sqlCmd);
    if ($result = $connection->query($sqlCmd)) {
        while ($rsData = mysqli_fetch_assoc($result)) {
            $urlToEdit = "location.href='advanced-banner-editar.php?id=".$rsData['id'].'&idC='.$rsData['countryID']."'";
            $urlToDelete = 'funDeleteItem('.$rsData['id'].')';
            $values = '<button class="fa fa-edit" style="padding:5px; margin-left:10px" onclick="'.$urlToEdit.'"></button>';
            $values .= '<button class="fa fa-trash" style="padding:5px; margin-left:10px" onclick="'.$urlToDelete.'"></button>';
            array_push($arrayMain, [$rsData['id'], $rsData['tag'], $rsData['title'], $rsData['country'], $values]);
        }
    }
    echo json_encode($arrayMain);
    $db->closeConnection();
}

function funAddAdvancedBannerTag()
{
    include_once 'session.php';
    include_once 'utils.php';
    include_once PATH_DATABASE_INC;
    $db = Database::getInstance();
    $connection = $db->getConnection();
    $viDateC = "'".date('Y-m-d H:i:s')."'";
    $bannerTag = $_REQUEST['bannerTag'];

    $sqlCmd = "INSERT INTO tb_advanced_banner_tag (dateO, userO, tag) VALUES ($viDateC, $usr_id, '$bannerTag')";

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
        die('false||Ocorreu um erro ao inserir a tag.');
    }
}

function funGetCountryLang()
{
    include_once PATH_DATABASE_INC;
    $db = Database::getInstance();
    $connection = $db->getConnection();
    $listFormBar = '';
    $listNavBar = '';
    $allInfo = '';

    $idCountry = $_REQUEST['countryId'];

    $sqlCmd = 'SELECT
                   tb_language.id,
                   tb_language.lang,
                   tb_language.langMin,
                   tb_country.abbCountry
            FROM tb_country_language
            JOIN tb_language ON tb_language.id = tb_country_language.idTbLanguage
            JOIN tb_country ON tb_country.id = tb_country_language.idTbCountry
            WHERE tb_country_language.status =1
            AND tb_language.deleted = 0
            AND
             tb_country.id='.$idCountry.'
            ORDER BY tb_country_language.defaultLang DESC';

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
            $viArrayValues['lang'] = $row['lang'];
            $viArrayValues['langMin'] = $row['langMin'];
            $viArrayValues['textBanner'] = '';
            $viArrayValues['subTextBanner'] = '';
            $viArrayValues['callTitle'] = '';
            $viArrayValues['callAction'] = '';
            $viArrayValues['titleBanner'] = '';
            $viArrayValues['descriptionBanner'] = '';
            $viArrayValues['idTrans'] = '';
            $viArrayValues['flag'] = $flag;
            $listFormBar .= funCreateAdvancedBannerNew($viArrayValues);
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

function funAddBanner()
{
    include_once 'session.php';
    include_once 'utils.php';
    include_once PATH_DATABASE_INC;
    $db = Database::getInstance();
    $connection = $db->getConnection();
    $viDateC = "'".date('Y-m-d H:i:s')."'";
    $inserted = false;
    $idBannerTag = $_REQUEST['bannerTag'];
    $idCountry = $_REQUEST['countryBanner'];
    $position = $_REQUEST['position'];
    if (isset($_REQUEST['checkBox'])) {
        $viCheckBox = 1;
    } else {
        $viCheckBox = 0;
    }
    $duration = $_REQUEST['duration'];
    $images = $_REQUEST['og_img'];

    $sqlInsertBanner = 'INSERT INTO tb_advanced_banner (dateO, userO, position, status, flagCta, duration , idTbGallery, idTbBannerTag)';
    $sqlInsertBanner .= " VALUES ($viDateC, $usr_id, $position, 1, $viCheckBox, $duration, '$images', $idBannerTag)";
    if ($result = $connection->query($sqlInsertBanner)) {
        $idBanner = $connection->insert_id;

        $sqlGetCountryLang = 'SELECT
                           tb_language.id,
                           tb_language.lang,
                           tb_language.langMin,
                           tb_country.abbCountry
                           FROM tb_country_language
                           JOIN tb_language ON tb_language.id = tb_country_language.idTbLanguage
                           JOIN tb_country ON tb_country.id = tb_country_language.idTbCountry
                           WHERE tb_country_language.status =1
                           AND tb_language.deleted = 0
                           AND
                           tb_country.id='.$idCountry.'
                           ORDER BY tb_country_language.defaultLang DESC';

        if ($result1 = $connection->query($sqlGetCountryLang)) {
            while ($row = mysqli_fetch_assoc($result1)) {
                $idLanguage = $row['id'];
                $bannerTitle = funTreatString($_REQUEST['title_banner_'.$row['abbCountry'].'_'.$row['langMin']]);
                $bannerDesc = funTreatString($_REQUEST['description_banner_'.$row['abbCountry'].'_'.$row['langMin']]);
                $bannerText = funTreatString($_REQUEST['text_banner_'.$row['abbCountry'].'_'.$row['langMin']]);
                $bannerSubText = funTreatString($_REQUEST['sub_text_banner_'.$row['abbCountry'].'_'.$row['langMin']]);
                $bannerCtaTitle = funTreatString($_REQUEST['call_title_'.$row['abbCountry'].'_'.$row['langMin']]);
                $bannerCtaAction = funTreatString($_REQUEST['call_action_'.$row['abbCountry'].'_'.$row['langMin']]);

                $sqlInsBannerTrans = 'INSERT INTO tb_advanced_banner_translation (dateC, title, subtitle, text, subText, callTitle, callAction, status, idTbLanguage, idTbBanner, idTbCountry)';
                $sqlInsBannerTrans .= " VALUES ($viDateC, '$bannerTitle', '$bannerDesc', '$bannerText', '$bannerSubText', '$bannerCtaTitle', '$bannerCtaAction', 1, ";
                $sqlInsBannerTrans .= " $idLanguage, $idBanner, $idCountry)";

                $result2 = $connection->query($sqlInsBannerTrans);

                if (!$result2) {
                    $action = '[ADD BANNER TRANS] - sql failed';
                    funCreateLog($action, $connection);
                    $db->rollbackAndClose();
                    die('false||Oppsss... ocorreu um erro ao inserir o banner.');
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
    } else {
        $action = '[ADD BANNER] - Failed inserting banner';
        funCreateLog($action, $connection);
        $db->rollbackAndClose();
        die('false||Ocorreu um erro ao inserir o banner');
    }
}
